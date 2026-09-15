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
     * Handle the contact form submission with multi-layer anti-spam protection.
     */
    public function send(Request $request)
    {
        // ── 1. Anti-Spam: Honeypot Check ────────────────────────────────
        // Invisible to humans. Bots automatically fill this input.
        if (!empty($request->input('b_website'))) {
            Log::warning('Spam inquiry blocked [Honeypot filled] from IP: ' . $request->ip());
            return $this->fakeSuccessResponse($request);
        }

        // ── 2. Anti-Spam: Fast Submission Check ────────────────────────
        // Bots submit forms instantaneously (< 3 seconds).
        $formLoadedAt = (int) $request->input('form_loaded_at', 0);
        if ($formLoadedAt > 0 && (time() - $formLoadedAt) < 3) {
            Log::warning('Spam inquiry blocked [Submitted too fast: ' . (time() - $formLoadedAt) . 's] from IP: ' . $request->ip());
            return $this->fakeSuccessResponse($request);
        }

        // ── 3. Anti-Spam: Identical First & Last Name Check ─────────────
        // Bots often duplicate the name field (e.g., LarryBlonoPA LarryBlonoPA).
        $firstName = trim((string) $request->input('first_name', ''));
        $lastName  = trim((string) $request->input('last_name', ''));
        if (strlen($firstName) > 3 && strcasecmp($firstName, $lastName) === 0) {
            Log::warning('Spam inquiry blocked [Identical First/Last Name: ' . $firstName . '] from IP: ' . $request->ip());
            return $this->fakeSuccessResponse($request);
        }

        // ── 4. Anti-Spam: Known Spam Keywords & Promo Domains ──────────
        $messageContent = (string) $request->input('message', '');
        $combinedText   = strtolower($firstName . ' ' . $lastName . ' ' . $messageContent . ' ' . $request->input('subject', ''));

        $spamKeywords = [
            'telegra.ph', 'freeb2b', 'b2bdata', 'promo code', 'jackpot',
            'playstation 5', 'ps5 pro', 'casino', 'slots', 'crypto',
            'whatsapp business', 'seo ranking', 'backlinks', 'forex',
            'adult dating', 'escort', 'viagra', 'cialis', 'telegram'
        ];

        foreach ($spamKeywords as $keyword) {
            if (str_contains($combinedText, $keyword)) {
                Log::warning("Spam inquiry blocked [Keyword match: '{$keyword}'] from IP: " . $request->ip());
                return $this->fakeSuccessResponse($request);
            }
        }

        // ── 5. Anti-Spam: Block External URLs / Links in Message ────────
        // Real inquiries rarely require links, while 100% of spam submissions blast links.
        if (preg_match('/https?:\/\/|www\.|[a-zA-Z0-9-]+\.(?:org|com|net|ph|ru|xyz|top|site|club|biz|online|info|link|io)\b/i', $messageContent)) {
            Log::warning('Inquiry rejected [Contains external link in message] from IP: ' . $request->ip());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'To protect against automated spam, external links and web addresses are not permitted in contact messages. Please remove any URLs and try again.',
                ], 422);
            }

            return back()->withInput()->with('contact_error', 'To protect against automated spam, external links and web addresses are not permitted in contact messages. Please remove any URLs and try again.');
        }

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

        // 1. Store inquiry in DB & backup
        try {
            if (class_exists(\App\Models\ContactMessage::class)) {
                \App\Models\ContactMessage::create([
                    'first_name' => $validated['first_name'],
                    'last_name'  => $validated['last_name'],
                    'email'      => $validated['email'],
                    'phone'      => $validated['phone'] ?? null,
                    'subject'    => $validated['subject'] ?? null,
                    'message'    => $validated['message'],
                ]);
            }

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

    /**
     * Return a fake successful response to fool automated spambots so they do not retry or adapt.
     */
    private function fakeSuccessResponse(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for reaching out to The PARC Foundation. We have received your inquiry and our team will get back to you soon!',
            ]);
        }

        return back()->with('contact_success', 'Thank you! Your message has been sent successfully. We will get back to you soon.');
    }
}

