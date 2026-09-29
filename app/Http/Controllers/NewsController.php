<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsArticle;
use Illuminate\Support\Facades\Schema;

class NewsController extends Controller
{
    /**
     * Display the News listing page.
     */
    public function index()
    {
        $hasTable = Schema::hasTable('news_articles');
        $allArticles = collect();

        if ($hasTable) {
            $allArticles = NewsArticle::where('status', 'published')
                ->orderBy('is_featured', 'desc')
                ->orderBy('published_date', 'desc')
                ->orderBy('id', 'desc')
                ->get();
        }

        // If no articles exist in DB yet, use default fallback articles
        if ($allArticles->isEmpty()) {
            $allArticles = $this->getDefaultArticles();
        }

        // Featured article is either the one marked is_featured, or the first article
        $featuredArticle = $allArticles->firstWhere('is_featured', true) ?: $allArticles->first();
        
        // Remaining articles excluding the featured one
        $remaining = $allArticles->reject(function ($item) use ($featuredArticle) {
            return ($item->id ?? null) === ($featuredArticle->id ?? null) && ($item->title ?? '') === ($featuredArticle->title ?? '');
        });

        // Visible initial grid (up to 9 items)
        $articles = $remaining->take(9);
        // Extra articles revealed by "MORE" button
        $extraArticles = $remaining->slice(9);

        return view('news', compact('featuredArticle', 'articles', 'extraArticles'));
    }

    /**
     * Display a dedicated News Article detail page.
     */
    public function show($id)
    {
        $hasTable = Schema::hasTable('news_articles');
        $article = null;

        if ($hasTable) {
            $article = NewsArticle::where('slug', $id)->orWhere('id', $id)->first();
        }

        if (!$article) {
            // Check default list if not in DB
            $defaults = $this->getDefaultArticles();
            $article = $defaults->first(function ($item) use ($id) {
                return (string)($item->id ?? '') === (string)$id || ($item->slug ?? '') === (string)$id;
            });

            if (!$article) {
                abort(404, 'News article not found.');
            }
        } else {
            // Safely increment views count
            try {
                $article->increment('views_count');
            } catch (\Throwable $e) {}
        }

        // Related articles
        $relatedArticles = collect();
        if ($hasTable) {
            $relatedArticles = NewsArticle::where('status', 'published')
                ->where('id', '!=', $article->id ?? 0)
                ->orderBy('published_date', 'desc')
                ->take(3)
                ->get();
        }
        if ($relatedArticles->isEmpty()) {
            $relatedArticles = $this->getDefaultArticles()->reject(fn($a) => ($a->title ?? '') === ($article->title ?? ''))->take(3);
        }

        return view('news_detail', compact('article', 'relatedArticles'));
    }

    /**
     * Fallback collection of standard PARC news articles.
     */
    private function getDefaultArticles()
    {
        $data = [
            [
                'id'             => 1,
                'title'          => 'Beyond The Game: A Journey of Purpose and Unity.',
                'slug'           => 'beyond-the-game-a-journey-of-purpose-and-unity',
                'category'       => 'Featured Story',
                'excerpt'        => 'The man behind the success of GGC — Mr. William Guido. This feature is more than an achievement—it is a reminder that when you lead with vision, purpose, and determination, the hard work will eventually speak for itself.',
                'content'        => "The man behind the success of GGC — Mr. William Guido.\n\nThis feature is more than an achievement—it is a reminder that when you lead with vision, purpose, and determination, the hard work will eventually speak for itself. In a world full of noise, those who stay grounded and committed to their mission are the ones who truly make an impact.\n\nThrough initiatives that empower our youth, The PARC Foundation continues to carry this legacy forward, giving wings to talented dreamers and building an inclusive stage for all.",
                'image_path'     => 'assets/image/NEWS/WTG.jpg',
                'youtube_url'    => 'https://www.youtube.com/live/1sqDa6Uyvug',
                'external_link'  => 'https://www.facebook.com/reel/1758232722186837',
                'published_date' => \Carbon\Carbon::parse('2026-08-23'),
                'is_featured'    => true,
            ],
            [
                'id'             => 2,
                'title'          => 'A Gift of Voice and Vision',
                'slug'           => 'a-gift-of-voice-and-vision',
                'category'       => 'Collaboration',
                'excerpt'        => 'For their 2nd collaboration episode with an artist, PARC Kids gets to share a beautiful performance with the one and only Angeline Quinto featuring her trending song Patuloy ang Pangarap.',
                'content'        => "For their 2nd collaboration episode with an artist, PARC Kids gets to share a beautiful performance with the one and only Angeline Quinto featuring her trending song 'Patuloy ang Pangarap'.\n\nMusic has the incredible power to unite hearts and uplift the spirit. Our scholars poured their souls into this heartfelt rendition, showcasing the passion and skill cultivated through the Parcaralan program. We are endlessly grateful to Ms. Angeline Quinto for her boundless warmth and mentorship.",
                'image_path'     => 'assets/image/NEWS/AQ.png',
                'youtube_url'    => 'https://www.youtube.com/watch?v=NAnJbEVWnLo',
                'external_link'  => null,
                'published_date' => \Carbon\Carbon::parse('2026-08-08'),
                'is_featured'    => false,
            ],
            [
                'id'             => 3,
                'title'          => 'A Dream. A Stage. A Legacy.',
                'slug'           => 'a-dream-a-stage-a-legacy',
                'category'       => 'Special Event',
                'excerpt'        => 'PARC Kids gets a special visit from one of the most iconic bands in OPM history, the one and only Mayonnaise.',
                'content'        => "PARC Kids gets a special visit from one of the most iconic bands in OPM history, the one and only Mayonnaise.\n\nThe energy in the studio was electric as Monty and the band shared stories of resilience, musicianship, and the raw dedication required to stay true to one's craft. The scholars had the once-in-a-lifetime opportunity to jam side-by-side with living rock legends!",
                'image_path'     => 'assets/image/NEWS/MAYONAISE_BAND.jpg',
                'youtube_url'    => 'https://www.youtube.com/watch?v=iuxoo8Jxi2Q',
                'external_link'  => null,
                'published_date' => \Carbon\Carbon::parse('2026-07-20'),
                'is_featured'    => false,
            ],
            [
                'id'             => 4,
                'title'          => 'Exciting & Competitive — Ready, Aim, Win!',
                'slug'           => 'exciting-competitive-ready-aim-win',
                'category'       => 'Tournament',
                'excerpt'        => 'Another successful Soft Tip Dart Tournament has come to an end, creating new champions and unforgettable memories.',
                'content'        => "Another successful Soft Tip Dart Tournament has come to an end, creating new champions and unforgettable memories. Congratulations to all participants, and see you at the Battle of the Champions!\n\nSports and recreation build discipline, camaraderie, and focus—values that run parallel to the performing arts.",
                'image_path'     => 'assets/image/dartchamps.jpg',
                'youtube_url'    => null,
                'external_link'  => 'https://www.facebook.com/reel/1371132058230225',
                'published_date' => \Carbon\Carbon::parse('2026-06-22'),
                'is_featured'    => false,
            ],
            [
                'id'             => 5,
                'title'          => 'Calling All Aspiring Musicians',
                'slug'           => 'calling-all-aspiring-musicians',
                'category'       => 'Auditions & Scholarships',
                'excerpt'        => 'The PARC Foundation is now welcoming aspiring scholars for Violin, Cello, and Contrabass classes.',
                'content'        => "The PARC Foundation is now welcoming aspiring scholars for Violin, Cello, and Contrabass classes under our signature Parcaralan initiative.\n\nIf you have the passion to learn string instruments under world-class instructors with zero financial burden, your journey begins here.",
                'image_path'     => 'assets/image/NEWS/CALLING.webp',
                'youtube_url'    => null,
                'external_link'  => 'https://www.facebook.com/photo/?fbid=1414804034010364',
                'published_date' => \Carbon\Carbon::parse('2026-06-10'),
                'is_featured'    => false,
            ],
            [
                'id'             => 6,
                'title'          => 'HIYAS Fashion Charity Gala',
                'slug'           => 'hiyas-fashion-charity-gala',
                'category'       => 'Fundraiser',
                'excerpt'        => 'The PARC Foundation joins LYOPERA in celebrating our Asian heritage in HIYAS Charity Fundraising Gala.',
                'content'        => "The PARC Foundation joins LYOPERA in celebrating our Asian heritage in HIYAS Charity Fundraising Gala. A20 Productions' Sherwin Sozon met with The PARC Foundation Chairman, William Guido, to deliver the funds raised for the Parcaralan Scholars program.",
                'image_path'     => 'assets/image/NEWS/HIYAS.png',
                'youtube_url'    => null,
                'external_link'  => 'https://www.facebook.com/photo/?fbid=122123669025211806',
                'published_date' => \Carbon\Carbon::parse('2026-04-30'),
                'is_featured'    => false,
            ],
            [
                'id'             => 7,
                'title'          => 'A TRIUMPH FOR INCLUSION!',
                'slug'           => 'a-triumph-for-inclusion',
                'category'       => 'Inclusion & Advocacy',
                'excerpt'        => 'From her training grounds at Kidz Groove TV in partnership with The PARC Foundation, Krystel has risen as a powerful neurodivergent star.',
                'content'        => "From her training grounds at Kidz Groove TV in partnership with The PARC Foundation, Krystel has risen as a powerful neurodivergent star. Her journey proves that inclusivity and specialized artistic support cultivate unprecedented talent.",
                'image_path'     => 'assets/image/NEWS/KRYSTEL GO.png',
                'youtube_url'    => null,
                'external_link'  => 'https://www.facebook.com/photo/?fbid=1309606077863665',
                'published_date' => \Carbon\Carbon::parse('2025-12-29'),
                'is_featured'    => false,
            ],
            [
                'id'             => 8,
                'title'          => 'Corey Koh - A Night of Melodies',
                'slug'           => 'corey-koh-a-night-of-melodies',
                'category'       => 'Concert',
                'excerpt'        => 'Get ready for an enchanting evening as Corey Koh brings his incredible voice to the stage at the upcoming "A Night of Melodies" concert.',
                'content'        => "Get ready for an enchanting evening as Corey Koh brings his incredible voice to the stage at the upcoming 'A Night of Melodies' concert. A celebration of international vocal mastery benefiting our music scholarship funds.",
                'image_path'     => 'assets/image/card1.webp',
                'youtube_url'    => null,
                'external_link'  => 'https://www.facebook.com/parcph',
                'published_date' => \Carbon\Carbon::parse('2025-02-15'),
                'is_featured'    => false,
            ],
            [
                'id'             => 9,
                'title'          => 'Corey Koh\'s Latest Release - "Heartstrings"',
                'slug'           => 'corey-koh-latest-release-heartstrings',
                'category'       => 'Music Release',
                'excerpt'        => 'Corey Koh has just released his newest single, "Heartstrings". Available for streaming on all platforms. Don\'t miss out on this soulful track!',
                'content'        => "Corey Koh has just released his newest single, 'Heartstrings'. Available for streaming on all platforms. Don't miss out on this soulful track!",
                'image_path'     => 'assets/image/card2.webp',
                'youtube_url'    => null,
                'external_link'  => 'https://www.facebook.com/parcph',
                'published_date' => \Carbon\Carbon::parse('2024-11-20'),
                'is_featured'    => false,
            ],
        ];

        return collect($data)->map(function ($item) {
            $obj = new NewsArticle($item);
            $obj->id = $item['id'];
            $obj->published_date = $item['published_date'];
            return $obj;
        });
    }
}
