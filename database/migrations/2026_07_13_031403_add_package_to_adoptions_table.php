<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('adoptions', function (Blueprint $table) {
            $table->string('package')->nullable()->after('postal');   // e.g. Patron, Silver, Gold, Platinum, Share
            $table->string('amount')->nullable()->after('package');   // e.g. ₱15,000
        });
    }

    public function down(): void
    {
        Schema::table('adoptions', function (Blueprint $table) {
            $table->dropColumn(['package', 'amount']);
        });
    }
};
