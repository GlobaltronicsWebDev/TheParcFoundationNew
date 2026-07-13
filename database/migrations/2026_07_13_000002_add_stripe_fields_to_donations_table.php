<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add Stripe payment tracking columns to the donations table.
     */
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            // Stripe PaymentIntent ID (e.g. pi_3PxxxxxxxxxxxxxxxxxxxxXX)
            $table->string('stripe_payment_intent_id')->nullable()->after('cover_processing_fee');

            // Payment status as confirmed by Stripe webhook
            // Possible values: pending, succeeded, failed
            $table->string('stripe_status', 20)->default('pending')->after('stripe_payment_intent_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn(['stripe_payment_intent_id', 'stripe_status']);
        });
    }
};
