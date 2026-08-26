<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            if (!Schema::hasColumn('donations', 'province')) {
                $table->string('province')->nullable()->after('country');
            }
            if (!Schema::hasColumn('donations', 'barangay')) {
                $table->string('barangay')->nullable()->after('city');
            }
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            if (Schema::hasColumn('donations', 'province')) {
                $table->dropColumn('province');
            }
            if (Schema::hasColumn('donations', 'barangay')) {
                $table->dropColumn('barangay');
            }
        });
    }
};
