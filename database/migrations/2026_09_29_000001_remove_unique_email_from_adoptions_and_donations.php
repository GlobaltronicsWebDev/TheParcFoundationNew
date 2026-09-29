<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Drop unique constraint on email for both adoptions and donations tables,
     * allowing multiple donations/adoptions from the same donor or anonymous supporters.
     */
    public function up(): void
    {
        // Safe check and drop for adoptions table
        if (Schema::hasTable('adoptions')) {
            try {
                $indexes = collect(DB::select('SHOW INDEXES FROM adoptions'))->pluck('Key_name')->all();
                if (in_array('adoptions_email_unique', $indexes)) {
                    DB::statement('ALTER TABLE `adoptions` DROP INDEX `adoptions_email_unique`');
                }
            } catch (\Throwable $e) {
                // Ignore if index does not exist or already dropped
            }
        }

        // Safe check and drop for donations table
        if (Schema::hasTable('donations')) {
            try {
                $indexes = collect(DB::select('SHOW INDEXES FROM donations'))->pluck('Key_name')->all();
                if (in_array('donations_email_unique', $indexes)) {
                    DB::statement('ALTER TABLE `donations` DROP INDEX `donations_email_unique`');
                }
            } catch (\Throwable $e) {
                // Ignore if index does not exist or already dropped
            }
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
