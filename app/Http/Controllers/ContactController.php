<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Exception;

class ContactController extends Controller
{
    /**
     * Display the Contact Us page.
     */
    public function index()
    {
        return view('contacts');
    }

    /**
     * Handle the contact form submission.
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'email'         => 'required|email|max:255',
            'phone'         => 'nullable|string|max:50',
            'subject'       => 'required|string|max:150',
            'message'       => 'required|string|max:3000',
            'email_updates' => 'nullable|string|in:yes,no',
            'text_updates'  => 'nullable|string|in:yes,no',
        ]);

        $emailUpdates = $request->input('email_updates', 'yes');
        $textUpdates  = $request->input('text_updates', 'no');

        $validated['email_updates'] = $emailUpdates;
        $validated['text_updates']  = $textUpdates;

        // Store inquiry locally as backup
        try {
            $backupFile = 'contact_inquiries.json';
            $inquiries = [];
            if (Storage::exists($backupFile)) {
                $inquiries = json_decode(Storage::get($backupFile), true) ?: [];
            }

            $inquiries[] = array_merge($validated, [
                'phone'        => $validated['phone'] ?? 'N/A',
                'submitted_at' => now()->toDateTimeString(),
            ]);

            Storage::put($backupFile, json_encode($inquiries, JSON_PRETTY_PRINT));
        } catch (Exception $e) {
            Log::error('Contact form storage failed. Error: ' . $e->getMessage());
        }

        // Send email to designated receiving email address
        $receiverEmail = env('CONTACT_RECEIVER_EMAIL', env('MAIL_FROM_ADDRESS', 'jose.jalandoni@theparcfoundation.ph'));


        try {
            Mail::send('emails.contact', ['data' => $validated], function ($message) use ($validated, $receiverEmail) {
                $senderName = $validated['first_name'] . ' ' . $validated['last_name'];
                $message->to($receiverEmail)
                        ->replyTo($validated['email'], $senderName)
                        ->subject('New Contact Form Submission: ' . $validated['subject']);
            });
        } catch (Exception $e) {
            Log::error('Contact email dispatch failed: ' . $e->getMessage());
        }

        return back()->with('contact_success', 'Thank you! Your message has been sent successfully. We will get back to you soon.');
    }
}

