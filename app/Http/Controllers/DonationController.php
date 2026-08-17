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

        // Resolve city & barangay cleanly
        $city = ($request->input('city') === 'Other' || !$request->input('city'))
            ? ($request->input('city_custom') ?? '')
            : $request->input('city');
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

        // ── Save to database ───────────────────────────────────────────────
        $donation = Donation::create($validated);

        // ── Append to Google Sheets (non-blocking: errors are logged, not thrown) ──
        try {
            $headers = [
                'Donation ID',
                'First Name',
                'Last Name',
                'Email Address',
                'Amount',
                'Frequency',
                'Payment Method',
                'Country',
                'Province / Region',
                'City / Municipality',
                'Barangay',
                'Street Address',
                'Postal Code',
                'Receipt Attachment URL',
                'Stripe Status',
                'Date Submitted',
            ];

            $pm = strtolower($donation->payment_method ?? '');
            $paymentMethodFormatted = match($pm) {
                'gcash'     => 'e-Wallet (GCash)',
                'maya'      => 'e-Wallet (Maya)',
                'grabpay'   => 'e-Wallet (GrabPay)',
                'shopeepay'  => 'e-Wallet (ShopeePay)',
                'paypal'    => 'e-Wallet (PayPal)',
                'visa'      => 'Credit / Debit Card',
                'card'      => 'Credit / Debit Card',
                'bank'      => 'e-Wallet / QR Code',
                default     => $donation->payment_method ? ('e-Wallet (' . strtoupper($donation->payment_method) . ')') : 'e-Wallet'
            };

            $amountRaw = str_replace([',', '₱', ' '], '', $donation->amount ?? '0');
            $amountFormatted = is_numeric($amountRaw) && (float)$amountRaw > 0
                ? ('₱' . number_format((float)$amountRaw))
                : ($donation->amount ?? 'N/A');

            $receiptUrl = $donation->receipt_path
                ? url($donation->receipt_path)
                : 'No Receipt Attached';

            $barangay = ($request->input('barangay') === 'Other' || !$request->input('barangay'))
                ? ($request->input('barangay_custom') ?? '')
                : $request->input('barangay');

            $row = [
                $donation->id,
                $donation->fname,
                $donation->lname,
                $donation->email,
                $amountFormatted,
                $donation->give_type === 'monthly' ? 'Monthly' : 'One-Time',
                $paymentMethodFormatted,
                $donation->country        ?? 'Philippines',
                $request->input('province') ?? '',
                $city                     ?? '',
                $barangay                 ?? '',
                $donation->street         ?? '',
                $donation->postal         ?? '',
                $receiptUrl,
                ucfirst($donation->stripe_status ?? 'pending'),
                $donation->created_at ? $donation->created_at->format('Y-m-d H:i:s') : date('Y-m-d H:i:s'),
            ];

            GoogleSheetsExporter::append(
                spreadsheetId: env('GOOGLE_SHEET_DONATIONS_ID'),
                tab:           env('GOOGLE_SHEET_DONATIONS_TAB', 'Donations'),
                headers:       $headers,
                row:           $row
            );
        } catch (\Throwable $e) {
            // Log the error but do NOT fail the user's submission —
            // data is already safely saved in the database.
            Log::error('Google Sheets (Donations) append failed: ' . $e->getMessage(), [
                'donation_id' => $donation->id,
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
