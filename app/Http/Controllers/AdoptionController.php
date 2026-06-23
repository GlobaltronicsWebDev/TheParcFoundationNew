<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adoption;

class AdoptionController extends Controller
{
    // Show the adoption form
    public function create()
    {
        return view('adoptions.create'); // We'll create this view next
    }

    // Handle form submission
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:adoptions,email',
            'country' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'postal' => 'nullable|string|max:255',
            'emailUpdates' => 'in:yes,no',
            'textUpdates' => 'in:yes,no',
            'card_number' => 'nullable|string|max:255',
            'expiration_month' => 'nullable|string|max:2',
            'expiration_year' => 'nullable|string|max:4',
            'cvv' => 'nullable|string|max:4',
            'cover_processing_fee' => 'boolean',
        ]);

        Adoption::create($validated);

        return redirect()->back()->with('success', 'Adoption form submitted successfully!');
    }
}
