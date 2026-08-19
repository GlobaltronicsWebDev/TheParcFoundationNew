<?php

namespace App\Http\Controllers;

use App\Helpers\GoogleSheetsExporter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Adoption;
use Exception;

class AdoptionController extends Controller
{
    // Show the adoption form
    public function create()
    {
        return view('adopt');
    }

    // Handle form submission — save to DB then push row to Google Sheets
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname'           => 'required|string|max:255',
            'lname'           => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'phone'           => 'nullable|string|max:50',
            'country_code'    => 'nullable|string|max:10',
            'country'         => 'nullable|string|max:255',
            'province'        => 'nullable|string|max:255',
            'city'            => 'nullable|string|max:255',
            'city_custom'     => 'nullable|string|max:255',
            'barangay'        => 'nullable|string|max:255',
            'barangay_custom' => 'nullable|string|max:255',
            'street'          => 'nullable|string|max:255',
            'postal'          => 'nullable|string|max:255',
            'package'         => 'required|string|max:255',
            'amount'          => 'required|string|max:255',
            'payment_method'  => 'nullable|string|max:50',
            'receipt'         => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // Resolve city & barangay custom inputs
        $cityVal = ($validated['city'] ?? '') === 'Other'
            ? ($validated['city_custom'] ?? 'Other')
            : ($validated['city'] ?? '');

        $barangayVal = ($validated['barangay'] ?? '') === 'Other'
            ? ($validated['barangay_custom'] ?? 'Other')
            : ($validated['barangay'] ?? '');

        $phoneVal = '';
        if (!empty($validated['phone'])) {
            $code = $validated['country_code'] ?? '+63';
            $phoneVal = str_starts_with($validated['phone'], '+')
                ? $validated['phone']
                : $code . ' ' . $validated['phone'];
        }

        $validated['city']     = $cityVal;
        $validated['barangay'] = $barangayVal;
        $validated['phone']    = $phoneVal;

        // Handle receipt file upload — stored in public/receipts/ with randomized name
        if ($request->hasFile('receipt')) {
            $file      = $request->file('receipt');
            $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
            $filename  = time() . '_' . \Illuminate\Support\Str::random(24) . '.' . $extension;
            $file->move(public_path('receipts'), $filename);
            $validated['receipt_path'] = 'receipts/' . $filename;
        }

        $validated['payment_method'] = $request->input('payment_method', 'ewallet');

        // ── Save to database ───────────────────────────────────────────────
        $adoption = Adoption::create($validated);

        // ── Append to Google Sheets ("Adoptions" tab) ─────────────────────────
        try {
            $sheetId  = env('GOOGLE_SHEET_ADOPTIONS_ID') ?: (env('GOOGLE_SHEET_DONATIONS_ID') ?: '1INqiJMGp8JZQzRksA3WPgCPVAMPkJgKiqbzN7iGkPIk');
            $sheetTab = env('GOOGLE_SHEET_ADOPTIONS_TAB') ?: 'Adoptions';

            $headers = [
                'Adoption ID', 'First Name', 'Last Name', 'Email',
                'Phone Number', 'Country', 'Province', 'City', 'Barangay', 'Street', 'Postal Code',
                'Package', 'Amount', 'Payment Method',
                'Receipt Uploaded', 'Date Submitted',
            ];

            $phoneDisplay = !empty($adoption->phone) ? $adoption->phone : 'N/A';
            if ($phoneDisplay && str_starts_with($phoneDisplay, '+')) {
                $phoneDisplay = "'" . $phoneDisplay;
            }

            $baseUrl = config('app.url');
            if (empty($baseUrl) || str_contains($baseUrl, 'localhost')) {
                $baseUrl = 'https://theparcfoundation.ph';
            }

            if (!empty($adoption->receipt_path)) {
                $receiptFullUrl = str_starts_with($adoption->receipt_path, 'http')
                    ? $adoption->receipt_path
                    : rtrim($baseUrl, '/') . '/' . ltrim($adoption->receipt_path, '/');
            } else {
                $receiptFullUrl = rtrim($baseUrl, '/') . '/adoptions/' . $adoption->id . '/receipt';
            }
            $receiptCell = '=HYPERLINK("' . $receiptFullUrl . '", "View Receipt")';

            $row = [
                'ADPT-ID-' . str_pad($adoption->id, 3, '0', STR_PAD_LEFT),
                $adoption->fname,
                $adoption->lname,
                $adoption->email,
                $phoneDisplay,
                $adoption->country              ?? 'Philippines',
                $validated['province']          ?? '',
                $adoption->city                 ?? '',
                $validated['barangay']          ?? '',
                $adoption->street               ?? '',
                $adoption->postal               ?? '',
                $adoption->package              ?? '',
                $adoption->amount               ?? '',
                $adoption->payment_method       ?? 'ewallet',
                $receiptCell,
                "'" . ($adoption->created_at ? $adoption->created_at->setTimezone('Asia/Manila')->format('m/d/Y h:i A') : now()->setTimezone('Asia/Manila')->format('m/d/Y h:i A')),
            ];

            GoogleSheetsExporter::append(
                spreadsheetId: $sheetId,
                tab:           $sheetTab,
                headers:       $headers,
                row:           $row
            );
            Log::info('Google Sheets (Adoptions) append SUCCESS for adoption #' . $adoption->id);
        } catch (\Throwable $e) {
            Log::error('Google Sheets (Adoptions) append failed: ' . $e->getMessage(), [
                'adoption_id' => $adoption->id,
                'trace'       => $e->getTraceAsString(),
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success'      => true,
                'message'      => 'Thank you! Your adoption application has been submitted successfully.',
                'adoption_id'  => $adoption->id,
                'receipt_url'  => route('adoptions.receipt', $adoption->id),
                'download_url' => route('adoptions.downloadReceipt', $adoption->id),
            ]);
        }

        return redirect()->back()->with(
            'success',
            'Thank you! Your adoption form has been submitted successfully. We will be in touch soon.'
        );
    }

    /**
     * Show official adoption receipt for viewing/printing.
     */
    public function receipt($id)
    {
        $adoption = Adoption::findOrFail($id);
        return view('adoption_receipt', compact('adoption'));
    }

    /**
     * Download official adoption receipt file directly.
     */
    public function downloadReceipt($id)
    {
        $adoption = Adoption::findOrFail($id);
        $html = view('adoption_receipt', compact('adoption'))->render();
        $fileName = 'PARC_Adoption_Receipt_ADPT_ID_' . str_pad($adoption->id, 3, '0', STR_PAD_LEFT) . '.html';

        return response($html)
            ->header('Content-Type', 'text/html; charset=utf-8')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }
}
