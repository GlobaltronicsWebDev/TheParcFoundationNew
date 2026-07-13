<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

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
     * Store a confirmed donation in the database.
     *
     * This is called after Stripe successfully processes the card payment.
     * The stripe_payment_intent_id is passed from the frontend after
     * stripe.confirmCardPayment() resolves with a 'succeeded' status.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname'                    => 'required|string|max:50',
            'lname'                    => 'required|string|max:50',
            'email'                    => 'required|email|max:100',
            'country'                  => 'nullable|string|max:100',
            'street'                   => 'nullable|string|max:100',
            'city'                     => 'nullable|string|max:50',
            'postal'                   => 'nullable|string|max:20',
            'emailUpdates'             => 'nullable|in:yes,no',
            'textUpdates'              => 'nullable|in:yes,no',
            'amount'                   => 'nullable|string|max:20',
            'give_type'                => 'nullable|in:once,monthly',
            'payment_method'           => 'nullable|string|max:20',
            'paypal_email'             => 'nullable|email|max:100',
            'cover_processing_fee'     => 'nullable|boolean',
            'stripe_payment_intent_id' => 'nullable|string|max:255',
            'stripe_status'            => 'nullable|string|max:20',
        ]);

        // Defaults
        $validated['emailUpdates']         = $request->input('emailUpdates', 'no');
        $validated['textUpdates']          = $request->input('textUpdates', 'no');
        $validated['cover_processing_fee'] = $request->has('cover_processing_fee');
        $validated['stripe_status']        = $request->input('stripe_status', 'pending');

        // For card payments: we never store raw card data — Stripe handles that.
        // card_number, expiration_month, expiration_year, cvv are not stored.

        $donation = Donation::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success'     => true,
                'message'     => '✅ Thank you for your donation!',
                'donation_id' => $donation->id,
            ]);
        }

        return redirect()->back()->with('success', '✅ Thank you for your donation!');
    }
}
