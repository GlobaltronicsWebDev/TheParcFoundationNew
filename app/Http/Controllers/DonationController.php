<?php

namespace App\Http\Controllers;

use App\Helpers\GoogleSheetsExporter;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DonationController extends Controller
{
    /**
     * Show the donation form.
     */
    public function create()
    {
        return view('donate');
    }

    /**
     * Store a confirmed donation in the database and push a row to Google Sheets.
     *
     * For Stripe card payments (AJAX/JSON), we still return JSON because
     * the frontend handles the Stripe flow asynchronously.
     * For bank-transfer submissions (regular form POST), we save to DB,
     * append to Google Sheets, then redirect with a success message.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname'                    => 'required|string|max:50',
            'lname'                    => 'required|string|max:50',
            'email'                    => 'required|email|max:100',
            'country'                  => 'nullable|string|max:100',
            'province'                 => 'nullable|string|max:100',
            'city'                     => 'nullable|string|max:100',
            'city_custom'              => 'nullable|string|max:100',
            'barangay'                 => 'nullable|string|max:100',
            'barangay_custom'          => 'nullable|string|max:100',
            'street'                   => 'nullable|string|max:100',
            'postal'                   => 'nullable|string|max:20',
            'emailUpdates'             => 'nullable|in:yes,no',
            'textUpdates'              => 'nullable|in:yes,no',
            'amount'                   => 'nullable|string|max:20',
            'give_type'                => 'nullable|in:once,monthly',
            'payment_method'           => 'nullable|string|max:50',
            'paypal_email'             => 'nullable|email|max:100',
            'cover_processing_fee'     => 'nullable|boolean',
            'receipt'                  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'stripe_payment_intent_id' => 'nullable|string|max:255',
            'stripe_status'            => 'nullable|string|max:20',
        ]);

        // Resolve location fields cleanly
        $province = $request->input('province', '');
        $city = ($request->input('city') === 'Other' || !$request->input('city'))
            ? ($request->input('city_custom') ?? '')
            : $request->input('city');
        $barangay = ($request->input('barangay') === 'Other' || !$request->input('barangay'))
            ? ($request->input('barangay_custom') ?? '')
            : $request->input('barangay');

        $validated['city'] = $city;

        // Handle receipt file upload — stored in public/receipts/
        if ($request->hasFile('receipt')) {
            $file     = $request->file('receipt');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('receipts'), $filename);
            $validated['receipt_path'] = 'receipts/' . $filename;
        }

        // Defaults
        $validated['emailUpdates']         = $request->input('emailUpdates', 'no');
        $validated['textUpdates']          = $request->input('textUpdates', 'no');
        $validated['cover_processing_fee'] = $request->has('cover_processing_fee');
        $validated['stripe_status']        = $request->input('stripe_status', 'pending');

        // Prepare database array (only existing columns in donations table)
        $dbData = $validated;
        unset($dbData['province'], $dbData['barangay'], $dbData['city_custom'], $dbData['barangay_custom']);

        // ── Save to database ───────────────────────────────────────────────
        $donation = Donation::create($dbData);

        // ── Append to Google Sheets (non-blocking: errors are logged, not thrown) ──
        try {
            $headers = [
                'Donation ID',
                'First Name',
                'Last Name',
                'Email',
                'Country',
                'City',
                'Street',
                'Postal Code',
                'Amount',
                'Give Type',
                'Payment Method',
                'Receipt',
                'Date Submitted',
            ];

            $row = [
                $donation->id,
                $donation->fname,
                $donation->lname,
                $donation->email,
                $donation->country         ?? 'Philippines',
                $city                      ?? '',
                $donation->street          ?? '',
                $donation->postal          ?? '',
                $donation->amount          ?? '',
                $donation->give_type       ?? 'once',
                $donation->payment_method  ?? 'bank',
                $donation->receipt_path ? url($donation->receipt_path) : 'No Receipt',
                $donation->created_at ? $donation->created_at->format('Y-m-d H:i:s') : date('Y-m-d H:i:s'),
            ];

            $sheetId  = env('GOOGLE_SHEET_DONATIONS_ID') ?: '1INqiJMGp8JZQzRksA3WPgCPVAMPkJgKiqbzN7iGkPIk';
            $sheetTab = env('GOOGLE_SHEET_DONATIONS_TAB') ?: 'Donations';

            GoogleSheetsExporter::append(
                spreadsheetId: $sheetId,
                tab:           $sheetTab,
                headers:       $headers,
                row:           $row
            );
            Log::info('Google Sheets (Donations) append SUCCESS for donation #' . $donation->id);
        } catch (\Throwable $e) {
            // Log the error but do NOT fail the user's submission —
            // data is already safely saved in the database.
            Log::error('Google Sheets (Donations) append FAILED: ' . $e->getMessage(), [
                'donation_id' => $donation->id,
                'error_msg'   => $e->getMessage(),
                'trace'       => $e->getTraceAsString(),
            ]);
        }

        // ── JSON (Stripe AJAX) path ────────────────────────────────────────
        if ($request->expectsJson()) {
            return response()->json([
                'success'     => true,
                'message'     => '✅ Thank you for your donation!',
                'donation_id' => $donation->id,
            ]);
        }

        // ── Regular form POST (Bank Transfer) ─────────────────────────────
        return redirect()->back()->with('success', '✅ Thank you for your donation! Your information has been recorded.');
    }
}
