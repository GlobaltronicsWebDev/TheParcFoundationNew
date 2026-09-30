<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'excerpt',
        'content',
        'image_path',
        'youtube_url',
        'facebook_url',
        'external_link',
        'published_date',
        'is_featured',
        'status',
        'views_count',
    ];

    protected $casts = [
        'published_date' => 'date',
        'is_featured'    => 'boolean',
        'views_count'    => 'integer',
    ];

    /**
     * Auto-generate slug when saving title if slug not provided.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($article) {
            if (empty($article->slug) && !empty($article->title)) {
                $base = Str::slug($article->title);
                $slug = $base;
                $count = 1;
                while (static::where('slug', $slug)->where('id', '!=', $article->id ?? 0)->exists()) {
                    $slug = $base . '-' . $count++;
                }
                $article->slug = $slug;
            }
        });
    }

    /**
     * Extract clean YouTube video ID from various URL formats.
     */
    public function getYoutubeIdAttribute(): ?string
    {
        if (empty($this->youtube_url)) {
            return null;
        }

        $url = trim($this->youtube_url);

        $patterns = [
            '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|live|shorts)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }

    /**
     * Get responsive YouTube Embed URL for iframes.
     */
    public function getYoutubeEmbedUrlAttribute(): ?string
    {
        $id = $this->youtube_id;
        if (!$id) {
            return null;
        }
        return "https://www.youtube-nocookie.com/embed/{$id}?rel=0&enablejsapi=1";
    }

    /**
     * Get responsive Facebook Reel / Video embed URL for iframes.
     */
    public function getFacebookEmbedUrlAttribute(): ?string
    {
        if (empty($this->facebook_url)) {
            return null;
        }
        return "https://www.facebook.com/plugins/video.php?href=" . urlencode($this->facebook_url) . "&show_text=false&t=0";
    }

    /**
     * Get maximum high-definition YouTube thumbnail (1280x720 HD).
     */
    public function getYoutubeThumbnailUrlAttribute(): ?string
    {
        $id = $this->youtube_id;
        if (!$id) {
            return null;
        }
        return "https://img.youtube.com/vi/{$id}/maxresdefault.jpg";
    }

    /**
     * Get display image URL: uploaded image, or auto YouTube thumbnail, or default fallback.
     */
    public function getDisplayImageAttribute(): string
    {
        if (!empty($this->image_path)) {
            if (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://')) {
                return $this->image_path;
            }
            return asset(ltrim($this->image_path, '/'));
        }

        if ($this->youtube_thumbnail_url) {
            return $this->youtube_thumbnail_url;
        }

        return asset('assets/image/NEWS/WTG.jpg');
    }

    /**
     * Format display date string.
     */
    public function getFormattedDateAttribute(): string
    {
        if ($this->published_date) {
            return $this->published_date->format('F d, Y');
        }
        if ($this->created_at) {
            return $this->created_at->format('F d, Y');
        }
        return '';
    }
}
