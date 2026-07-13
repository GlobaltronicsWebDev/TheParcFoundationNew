<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use App\Models\Donation;

class StripeController extends Controller
{
    /**
     * Create a Stripe PaymentIntent.
     *
     * Called via AJAX from the donate page when the user clicks "Donate Now".
     * Returns a client_secret the frontend uses to confirm the payment.
     *
     * POST /stripe/create-intent
     */
    public function createIntent(Request $request)
    {
        $request->validate([
            'amount'    => 'required|numeric|min:50',   // min ₱50
            'give_type' => 'nullable|in:once,monthly',
            'currency'  => 'nullable|string|size:3',
        ]);

        $rawAmount  = (float) $request->input('amount');
        $currency   = strtolower($request->input('currency', config('services.stripe.currency', 'php')));
        $giveType   = $request->input('give_type', 'once');

        // Stripe amounts are in the smallest currency unit.
        // PHP (Philippine Peso) is a zero-decimal currency — use centavos (×100).
        $stripeAmount = (int) round($rawAmount * 100);

        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $intent = PaymentIntent::create([
                'amount'               => $stripeAmount,
                'currency'             => $currency,
                'payment_method_types' => ['card'],
                'description'          => 'PARC Foundation Donation – ' . ucfirst($giveType),
                'metadata'             => [
                    'give_type'  => $giveType,
                    'source'     => 'donate_page',
                    'app_url'    => config('app.url'),
                ],
            ]);

            return response()->json([
                'success'       => true,
                'client_secret' => $intent->client_secret,
                'intent_id'     => $intent->id,
            ]);

        } catch (\Stripe\Exception\CardException $e) {
            return response()->json(['success' => false, 'error' => $e->getUserMessage()], 422);
        } catch (\Exception $e) {
            Log::error('Stripe createIntent error: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Payment setup failed. Please try again.'], 500);
        }
    }

    /**
     * Handle Stripe Webhook events.
     *
     * Verifies the webhook signature and processes:
     *   - payment_intent.succeeded  → mark donation as paid
     *   - payment_intent.payment_failed → log failure
     *
     * POST /stripe/webhook
     * (CSRF excluded — Stripe sends raw POST)
     */
    public function webhook(Request $request)
    {
        $payload   = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret    = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $secret);
        } catch (\UnexpectedValueException $e) {
            Log::warning('Stripe webhook: invalid payload');
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (SignatureVerificationException $e) {
            Log::warning('Stripe webhook: invalid signature');
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $intent = $event->data->object;
                $this->handlePaymentSuccess($intent);
                break;

            case 'payment_intent.payment_failed':
                $intent = $event->data->object;
                Log::info('Stripe: payment failed for intent ' . $intent->id);
                // Optionally update donation record status
                Donation::where('stripe_payment_intent_id', $intent->id)
                    ->update(['stripe_status' => 'failed']);
                break;

            default:
                // Unhandled event type — ignore
                break;
        }

        return response()->json(['received' => true]);
    }

    /**
     * Mark a donation as paid after webhook confirmation.
     */
    private function handlePaymentSuccess($intent): void
    {
        Donation::where('stripe_payment_intent_id', $intent->id)
            ->update(['stripe_status' => 'succeeded']);

        Log::info('Stripe: payment succeeded for intent ' . $intent->id);
    }
}
