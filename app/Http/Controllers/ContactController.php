<?php

namespace App\Http\Controllers;

use App\Helpers\GoogleSheetsExporter;
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

        // 1. Store inquiry locally as backup
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

        // 2. Append inquiry data to Google Sheets (Contacts_Inquiry tab)
        try {
            $sheetId  = env('GOOGLE_SHEET_CONTACTS_ID') ?: (env('GOOGLE_SHEET_DONATIONS_ID') ?: '1INqiJMGp8JZQzRksA3WPgCPVAMPkJgKiqbzN7iGkPIk');
            $sheetTab = env('GOOGLE_SHEET_CONTACTS_TAB') ?: 'Contacts_Inquiry';

            $headers = [
                'First Name',
                'Last Name',
                'Email Address',
                'Phone Number',
                'Subject / Inquiry Type',
                'Message',
                'Date Submitted',
            ];

            $phoneDisplay = !empty($validated['phone']) ? $validated['phone'] : 'N/A';
            if ($phoneDisplay && str_starts_with($phoneDisplay, '+')) {
                $phoneDisplay = "'" . $phoneDisplay;
            }

            $row = [
                $validated['first_name'],
                $validated['last_name'],
                $validated['email'],
                $phoneDisplay,
                $validated['subject'],
                $validated['message'],
                "'" . now()->setTimezone('Asia/Manila')->format('m/d/Y h:i A'),
            ];

            GoogleSheetsExporter::append(
                spreadsheetId: $sheetId,
                tab:           $sheetTab,
                headers:       $headers,
                row:           $row
            );

            Log::info('Google Sheets (Contacts_Inquiry) append SUCCESS for ' . $validated['email']);
        } catch (Exception $e) {
            Log::error('Google Sheets (Contacts_Inquiry) append FAILED: ' . $e->getMessage());
        }

        // 3. Send email to designated receiving email address
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

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for reaching out to The PARC Foundation. We have received your inquiry and our team will get back to you soon!',
            ]);
        }

        return back()->with('contact_success', 'Thank you! Your message has been sent successfully. We will get back to you soon.');
    }
}

