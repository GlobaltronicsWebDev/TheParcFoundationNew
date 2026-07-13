<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adoption;

class AdoptionController extends Controller
{
    // Show the adoption form
    public function create()
    {
        return view('adopt');
    }

    // Handle form submission
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

        Adoption::create($validated);

        return redirect()->back()->with('success', 'Thank you! Your adoption form has been submitted successfully. We will be in touch soon.');
    }
}
