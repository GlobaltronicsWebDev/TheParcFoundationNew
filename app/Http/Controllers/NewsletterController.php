<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\NewsletterSubscriber;
use Exception;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'first_name'     => 'required|string|max:100',
            'last_name'      => 'required|string|max:100',
            'email'          => 'required|email|max:255',
            'email_updates'  => 'nullable|string|in:yes,no',
            'text_updates'   => 'nullable|string|in:yes,no',
        ]);

        $emailUpdates = $request->input('email_updates', 'yes');
        $textUpdates = $request->input('text_updates', 'no');

        // 1. Save to database with JSON file backup fallback
        $savedToDb = false;
        try {
            NewsletterSubscriber::updateOrCreate(
                ['email' => $validated['email']],
                [
                    'first_name'    => $validated['first_name'],
                    'last_name'     => $validated['last_name'],
                    'email_updates' => $emailUpdates,
                    'text_updates'  => $textUpdates,
                ]
            );
            $savedToDb = true;
        } catch (Exception $dbEx) {
            Log::warning('Newsletter database save failed, falling back to local file. Error: ' . $dbEx->getMessage());
            
            // Backup fallback to JSON file
            try {
                $backupFile = 'newsletter_subscribers.json';
                $subscribers = [];
                if (Storage::exists($backupFile)) {
                    $subscribers = json_decode(Storage::get($backupFile), true) ?: [];
                }
                
                $subscribers[$validated['email']] = [
                    'first_name'    => $validated['first_name'],
                    'last_name'     => $validated['last_name'],
                    'email_updates' => $emailUpdates,
                    'text_updates'  => $textUpdates,
                    'subscribed_at' => now()->toDateTimeString(),
                ];

                Storage::put($backupFile, json_encode($subscribers, JSON_PRETTY_PRINT));
            } catch (Exception $fileEx) {
                Log::error('Newsletter file backup save failed. Error: ' . $fileEx->getMessage());
            }
        }

        // 2. Subscribe to Mailchimp if configured and not placeholder
        $apiKey     = env('MAILCHIMP_API_KEY');
        $listId     = env('MAILCHIMP_LIST_ID');
        $dataCenter = env('MAILCHIMP_DATA_CENTER', 'us21');

        $hasMailchimpConfig = $apiKey && 
                              $listId && 
                              !str_contains($apiKey, 'your-mailchimp-api-key') && 
                              !str_contains($listId, 'your-audience-id');

        if ($hasMailchimpConfig) {
            try {
                $response = Http::withBasicAuth('anystring', $apiKey)
                    ->post("https://{$dataCenter}.api.mailchimp.com/3.0/lists/{$listId}/members", [
                        'email_address' => $validated['email'],
                        'status'        => 'subscribed',
                        'merge_fields'  => [
                            'FNAME' => $validated['first_name'],
                            'LNAME' => $validated['last_name'],
                        ],
                        'tags' => array_filter([
                            $emailUpdates === 'yes' ? 'email-updates' : null,
                            $textUpdates  === 'yes' ? 'text-updates'  : null,
                        ]),
                    ]);

                if ($response->successful()) {
                    return back()->with('newsletter_success', 'You\'ve been signed up! Thank you for joining.');
                }

                // Already subscribed — treat as success
                if ($response->status() === 400 && str_contains($response->body(), 'Member Exists')) {
                    return back()->with('newsletter_success', 'You\'re already subscribed. Thank you!');
                }

                Log::error('Mailchimp subscription failed. Response: ' . $response->body());
            } catch (Exception $mcEx) {
                Log::error('Mailchimp communication exception. Error: ' . $mcEx->getMessage());
            }
        }

        // If Mailchimp is not configured or failed, but we successfully saved the data locally, treat as success.
        if ($savedToDb || Storage::exists('newsletter_subscribers.json')) {
            return back()->with('newsletter_success', 'You\'ve been signed up! Thank you for joining.');
        }

        return back()->with('newsletter_error', 'Something went wrong. Please try again.');
    }
}
