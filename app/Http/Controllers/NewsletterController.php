<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|max:255',
        ]);

        $apiKey     = env('MAILCHIMP_API_KEY');
        $listId     = env('MAILCHIMP_LIST_ID');
        $dataCenter = env('MAILCHIMP_DATA_CENTER', 'us21');

        $response = Http::withBasicAuth('anystring', $apiKey)
            ->post("https://{$dataCenter}.api.mailchimp.com/3.0/lists/{$listId}/members", [
                'email_address' => $request->email,
                'status'        => 'subscribed',
                'merge_fields'  => [
                    'FNAME' => $request->first_name,
                    'LNAME' => $request->last_name,
                ],
                'tags' => array_filter([
                    $request->email_updates === 'yes' ? 'email-updates' : null,
                    $request->text_updates  === 'yes' ? 'text-updates'  : null,
                ]),
            ]);

        if ($response->successful()) {
            return back()->with('newsletter_success', 'You\'ve been signed up! Thank you for joining.');
        }

        // Already subscribed — treat as success
        if ($response->status() === 400 && str_contains($response->body(), 'Member Exists')) {
            return back()->with('newsletter_success', 'You\'re already subscribed. Thank you!');
        }

        return back()->with('newsletter_error', 'Something went wrong. Please try again.');
    }
}
