<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Drop unique constraint on email for both adoptions and donations tables,
     * allowing multiple donations/adoptions from the same donor or anonymous supporters.
     */
    public function up(): void
    {
        if (Schema::hasTable('adoptions')) {
            Schema::table('adoptions', function (Blueprint $table) {
                try {
                    $table->dropUnique('adoptions_email_unique');
                } catch (\Throwable $e) {
                    // Index may already be dropped or named differently
                }
            });
        }

        if (Schema::hasTable('donations')) {
            Schema::table('donations', function (Blueprint $table) {
                try {
                    $table->dropUnique('donations_email_unique');
                } catch (\Throwable $e) {
                    // Index may already be dropped or named differently
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Intentionally left blank: repeat donations and adoptions are standard business logic.
    }
};
