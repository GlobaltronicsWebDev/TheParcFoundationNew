<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewsArticle;
use Carbon\Carbon;

class NewsArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title'          => 'Beyond The Game: A Journey of Purpose and Unity.',
                'slug'           => 'beyond-the-game-a-journey-of-purpose-and-unity',
                'category'       => 'Featured Story',
                'excerpt'        => 'The man behind the success of GGC — Mr. William Guido. This feature is more than an achievement—it is a reminder that when you lead with vision, purpose, and determination, the hard work will eventually speak for itself.',
                'content'        => "The man behind the success of GGC — Mr. William Guido.\n\nThis feature is more than an achievement—it is a reminder that when you lead with vision, purpose, and determination, the hard work will eventually speak for itself. In a world full of noise, those who stay grounded and committed to their mission are the ones who truly make an impact.\n\nThrough initiatives that empower our youth, The PARC Foundation continues to carry this legacy forward, giving wings to talented dreamers and building an inclusive stage for all.",
                'image_path'     => 'assets/image/NEWS/WTG.jpg',
                'youtube_url'    => 'https://www.youtube.com/watch?v=NAnJbEVWnLo',
                'external_link'  => 'https://www.facebook.com/reel/1758232722186837',
                'published_date' => Carbon::parse('2026-08-23'),
                'is_featured'    => true,
                'status'         => 'published',
            ],
            [
                'title'          => 'A Gift of Voice and Vision',
                'slug'           => 'a-gift-of-voice-and-vision',
                'category'       => 'Collaboration',
                'excerpt'        => 'For their 2nd collaboration episode with an artist, PARC Kids gets to share a beautiful performance with the one and only Angeline Quinto featuring her trending song Patuloy ang Pangarap.',
                'content'        => "For their 2nd collaboration episode with an artist, PARC Kids gets to share a beautiful performance with the one and only Angeline Quinto featuring her trending song 'Patuloy ang Pangarap'.\n\nMusic has the incredible power to unite hearts and uplift the spirit. Our scholars poured their souls into this heartfelt rendition, showcasing the passion and skill cultivated through the Parcaralan program. We are endlessly grateful to Ms. Angeline Quinto for her boundless warmth and mentorship.",
                'image_path'     => 'assets/image/NEWS/AQ.png',
                'youtube_url'    => 'https://www.youtube.com/watch?v=NAnJbEVWnLo',
                'external_link'  => null,
                'published_date' => Carbon::parse('2026-08-08'),
                'is_featured'    => false,
                'status'         => 'published',
            ],
            [
                'title'          => 'A Dream. A Stage. A Legacy.',
                'slug'           => 'a-dream-a-stage-a-legacy',
                'category'       => 'Special Event',
                'excerpt'        => 'PARC Kids gets a special visit from one of the most iconic bands in OPM history, the one and only Mayonnaise.',
                'content'        => "PARC Kids gets a special visit from one of the most iconic bands in OPM history, the one and only Mayonnaise.\n\nThe energy in the studio was electric as Monty and the band shared stories of resilience, musicianship, and the raw dedication required to stay true to one's craft. The scholars had the once-in-a-lifetime opportunity to jam side-by-side with living rock legends!",
                'image_path'     => 'assets/image/NEWS/MAYONAISE_BAND.jpg',
                'youtube_url'    => 'https://www.youtube.com/watch?v=iuxoo8Jxi2Q',
                'external_link'  => null,
                'published_date' => Carbon::parse('2026-07-20'),
                'is_featured'    => false,
                'status'         => 'published',
            ],
            [
                'title'          => 'Exciting & Competitive — Ready, Aim, Win!',
                'slug'           => 'exciting-competitive-ready-aim-win',
                'category'       => 'Tournament',
                'excerpt'        => 'Another successful Soft Tip Dart Tournament has come to an end, creating new champions and unforgettable memories.',
                'content'        => "Another successful Soft Tip Dart Tournament has come to an end, creating new champions and unforgettable memories. Congratulations to all participants, and see you at the Battle of the Champions!\n\nSports and recreation build discipline, camaraderie, and focus—values that run parallel to the performing arts.",
                'image_path'     => 'assets/image/dartchamps.jpg',
                'youtube_url'    => null,
                'external_link'  => 'https://www.facebook.com/reel/1371132058230225',
                'published_date' => Carbon::parse('2026-06-22'),
                'is_featured'    => false,
                'status'         => 'published',
            ],
            [
                'title'          => 'Calling All Aspiring Musicians',
                'slug'           => 'calling-all-aspiring-musicians',
                'category'       => 'Auditions & Scholarships',
                'excerpt'        => 'The PARC Foundation is now welcoming aspiring scholars for Violin, Cello, and Contrabass classes.',
                'content'        => "The PARC Foundation is now welcoming aspiring scholars for Violin, Cello, and Contrabass classes under our signature Parcaralan initiative.\n\nIf you have the passion to learn string instruments under world-class instructors with zero financial burden, your journey begins here.",
                'image_path'     => 'assets/image/NEWS/CALLING.webp',
                'youtube_url'    => null,
                'external_link'  => 'https://www.facebook.com/photo/?fbid=1414804034010364',
                'published_date' => Carbon::parse('2026-06-10'),
                'is_featured'    => false,
                'status'         => 'published',
            ],
            [
                'title'          => 'HIYAS Fashion Charity Gala',
                'slug'           => 'hiyas-fashion-charity-gala',
                'category'       => 'Fundraiser',
                'excerpt'        => 'The PARC Foundation joins LYOPERA in celebrating our Asian heritage in HIYAS Charity Fundraising Gala.',
                'content'        => "The PARC Foundation joins LYOPERA in celebrating our Asian heritage in HIYAS Charity Fundraising Gala. A20 Productions' Sherwin Sozon met with The PARC Foundation Chairman, William Guido, to deliver the funds raised for the Parcaralan Scholars program.",
                'image_path'     => 'assets/image/NEWS/HIYAS.png',
                'youtube_url'    => null,
                'external_link'  => 'https://www.facebook.com/photo/?fbid=122123669025211806',
                'published_date' => Carbon::parse('2026-04-30'),
                'is_featured'    => false,
                'status'         => 'published',
            ],
            [
                'title'          => 'A TRIUMPH FOR INCLUSION!',
                'slug'           => 'a-triumph-for-inclusion',
                'category'       => 'Inclusion & Advocacy',
                'excerpt'        => 'From her training grounds at Kidz Groove TV in partnership with The PARC Foundation, Krystel has risen as a powerful neurodivergent star.',
                'content'        => "From her training grounds at Kidz Groove TV in partnership with The PARC Foundation, Krystel has risen as a powerful neurodivergent star. Her journey proves that inclusivity and specialized artistic support cultivate unprecedented talent.",
                'image_path'     => 'assets/image/NEWS/KRYSTEL GO.png',
                'youtube_url'    => null,
                'external_link'  => 'https://www.facebook.com/photo/?fbid=1309606077863665',
                'published_date' => Carbon::parse('2025-12-29'),
                'is_featured'    => false,
                'status'         => 'published',
            ],
        ];

        foreach ($articles as $data) {
            NewsArticle::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
