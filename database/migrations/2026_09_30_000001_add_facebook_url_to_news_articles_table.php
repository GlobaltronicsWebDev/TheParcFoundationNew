<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('news_articles') && !Schema::hasColumn('news_articles', 'facebook_url')) {
            Schema::table('news_articles', function (Blueprint $table) {
                $table->string('facebook_url', 500)->nullable()->after('youtube_url');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('news_articles') && Schema::hasColumn('news_articles', 'facebook_url')) {
            Schema::table('news_articles', function (Blueprint $table) {
                $table->dropColumn('facebook_url');
            });
        }
    }
};
