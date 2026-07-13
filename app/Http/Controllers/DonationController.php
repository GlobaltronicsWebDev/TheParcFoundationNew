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
     * Store a new donation in the database.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'fname'            => 'required|string|max:50',
            'lname'            => 'required|string|max:50',
            'email'            => 'required|email|max:100',
            'country'          => 'nullable|string|max:100',
            'street'           => 'nullable|string|max:100',
            'city'             => 'nullable|string|max:50',
            'postal'           => 'nullable|string|max:20',
            'emailUpdates'     => 'nullable|in:yes,no',
            'textUpdates'      => 'nullable|in:yes,no',
            'amount'           => 'nullable|string|max:20',
            'give_type'        => 'nullable|in:once,monthly',
            'payment_method'   => 'nullable|string|max:20',
            'card_number'      => 'nullable|string|max:25',
            'expiration_month' => 'nullable|string|max:5',
            'expiration_year'  => 'nullable|string|max:5',
            'cvv'              => 'nullable|string|max:5',
            'paypal_email'     => 'nullable|email|max:100',
            'cover_processing_fee' => 'nullable|boolean',
        ]);

        // Defaults for optional fields
        $validated['emailUpdates']         = $request->input('emailUpdates', 'no');
        $validated['textUpdates']          = $request->input('textUpdates', 'no');
        $validated['cover_processing_fee'] = $request->has('cover_processing_fee');

        // Save the donation into DB
        Donation::create($validated);

        // Return JSON for AJAX (JS fetch) or redirect for standard form POST
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => '✅ Thank you for your donation!',
            ]);
        }

        return redirect()->back()->with('success', '✅ Thank you for your donation!');
    }
}
