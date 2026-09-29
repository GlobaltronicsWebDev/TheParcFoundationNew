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
        if (!Schema::hasTable('news_articles')) {
            Schema::create('news_articles', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->nullable();
                $table->string('category')->default('News & Updates');
                $table->text('excerpt')->nullable();
                $table->longText('content')->nullable();
                $table->string('image_path')->nullable();
                $table->string('youtube_url')->nullable();
                $table->string('external_link')->nullable();
                $table->date('published_date')->nullable();
                $table->boolean('is_featured')->default(false);
                $table->string('status', 20)->default('published');
                $table->unsignedInteger('views_count')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_articles');
    }
};
