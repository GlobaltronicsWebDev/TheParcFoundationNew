<?php

namespace App\Http\Controllers;

use App\Helpers\GoogleSheetsExporter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Adoption;

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
            'fname'               => 'required|string|max:255',
            'lname'               => 'required|string|max:255',
            'email'               => 'required|email|max:255',
            'country'             => 'nullable|string|max:255',
            'street'              => 'nullable|string|max:255',
            'city'                => 'nullable|string|max:255',
            'postal'              => 'nullable|string|max:255',
            'package'             => 'nullable|string|max:255',
            'amount'              => 'nullable|string|max:255',
            'emailUpdates'        => 'nullable|in:yes,no',
            'textUpdates'         => 'nullable|in:yes,no',
            'cover_processing_fee'=> 'nullable|boolean',
            'receipt'             => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // Handle receipt file upload — stored in public/receipts/
        if ($request->hasFile('receipt')) {
            $file     = $request->file('receipt');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('receipts'), $filename);
            $validated['receipt_path'] = 'receipts/' . $filename;
        }

        // Default boolean
        $validated['cover_processing_fee'] = $request->boolean('cover_processing_fee');

        // Default radio values if not provided
        $validated['emailUpdates'] = $request->input('emailUpdates', 'no');
        $validated['textUpdates']  = $request->input('textUpdates', 'no');

        // ── Save to database ───────────────────────────────────────────────
        $adoption = Adoption::create($validated);

        // ── Append to Google Sheets (non-blocking: errors are logged, not thrown) ──
        try {
            $headers = [
                'Adoption ID', 'First Name', 'Last Name', 'Email',
                'Country', 'City', 'Street', 'Postal Code',
                'Package', 'Amount',
                'Email Updates', 'Text Updates', 'Cover Processing Fee',
                'Receipt Uploaded', 'Date Submitted',
            ];

            $row = [
                $adoption->id,
                $adoption->fname,
                $adoption->lname,
                $adoption->email,
                $adoption->country              ?? '',
                $adoption->city                 ?? '',
                $adoption->street               ?? '',
                $adoption->postal               ?? '',
                $adoption->package              ?? '',
                $adoption->amount               ?? '',
                $adoption->emailUpdates         ?? 'no',
                $adoption->textUpdates          ?? 'no',
                $adoption->cover_processing_fee ? 'Yes' : 'No',
                $adoption->receipt_path         ? asset($adoption->receipt_path) : 'No Receipt',
                $adoption->created_at->format('Y-m-d H:i:s'),
            ];

            GoogleSheetsExporter::append(
                spreadsheetId: env('GOOGLE_SHEET_ADOPTIONS_ID'),
                tab:           env('GOOGLE_SHEET_ADOPTIONS_TAB', 'Adoptions'),
                headers:       $headers,
                row:           $row
            );
        } catch (\Throwable $e) {
            // Log the error but do NOT fail the user's submission —
            // data is already safely saved in the database.
            Log::error('Google Sheets (Adoptions) append failed: ' . $e->getMessage(), [
                'adoption_id' => $adoption->id,
                'trace'       => $e->getTraceAsString(),
            ]);
        }

        return redirect()->back()->with(
            'success',
            'Thank you! Your adoption form has been submitted successfully. We will be in touch soon.'
        );
    }
}
