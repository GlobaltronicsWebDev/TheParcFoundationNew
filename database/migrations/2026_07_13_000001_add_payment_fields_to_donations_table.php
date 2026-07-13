<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add new payment & donation fields to the donations table.
     */
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            // Drop unique constraint on email to allow same donor to donate multiple times
            $table->dropUnique(['email']);

            // Donation amount and frequency
            $table->string('amount', 20)->nullable()->after('email');
            $table->enum('give_type', ['once', 'monthly'])->default('once')->after('amount');

            // Payment method selection
            $table->string('payment_method', 20)->nullable()->after('give_type');

            // PayPal email (for PayPal method)
            $table->string('paypal_email')->nullable()->after('cvv');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->unique('email');
            $table->dropColumn(['amount', 'give_type', 'payment_method', 'paypal_email']);
        });
    }
};
