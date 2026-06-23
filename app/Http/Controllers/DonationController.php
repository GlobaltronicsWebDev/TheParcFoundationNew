<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Store a new donation in the database.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'fname'   => 'required|string|max:50',
            'lname'   => 'required|string|max:50',
            'email'   => 'required|email|unique:donations,email',
            'country' => 'nullable|string|max:100',
            'street'  => 'nullable|string|max:100',
            'city'    => 'nullable|string|max:50',
            'postal'  => 'nullable|string|max:50',
            'emailUpdates' => 'in:yes,no',
            'textUpdates'  => 'in:yes,no',
            'card_number'  => 'nullable|string|max:19',
            'expiration_month' => 'nullable|string|max:5',
            'expiration_year'  => 'nullable|string|max:5',
            'cvv' => 'nullable|string|max:5',
            'cover_processing_fee' => 'boolean',
        ]);

        // Handle defaults for checkboxes and optional fields
        $validated['emailUpdates'] = $request->input('emailUpdates', 'no');
        $validated['textUpdates']  = $request->input('textUpdates', 'no');
        $validated['cover_processing_fee'] = $request->has('cover_processing_fee');

        // Save the donation into DB
        Donation::create($validated);

        // Redirect back with success message
        return redirect()->back()->with('success', '✅ Thank you for your donation!');
    }
}
