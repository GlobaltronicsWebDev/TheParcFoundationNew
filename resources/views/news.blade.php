<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PARC Foundation</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('cssfolder/mainnavbar.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/news.css') }}" />

</head>
<body>
  <!-- Include Navbar -->
  @include('layouts.navbar')

<!-- Latest News Section -->
<section class="latest-news-section">
  <div class="container text-center">

    <!-- Section Header -->
    <div class="news-header text-center">
      <h2 class="fw-bold">
        <span class="anim-left">Latest</span> <span class="highlight anim-right">News</span>
      </h2>
      <p class="subtitle">latest posts</p>
    </div>

    <!-- Featured News Card -->
    <div class="news-card shadow-sm">
      <div class="row align-items-center g-0">
        <!-- Image -->
        <div class="col-md-5 news-image">
          <img src="{{ asset('./assets/image/WTG2.webp') }}"
               alt="Globaltronics Award"
               class="img-fluid rounded-start">
        </div>
        <!-- Content -->
        <div class="col-md-7 p-4 text-start">
          <h4 class="fw-bold text-highlight mb-3">
            Chairman and CEO of Globaltronics was awarded the KDR Icon of Music and
            Philanthropy during the 9th WISH Music Awards.
          </h4>
          <p class="date mb-2">January 14, 2024</p>
          <p class="text-dark mb-2">
            Mr. William Guido, the Chairman and CEO of Globaltronics, was awarded the
            KDR Icon of Music and Philanthropy during the 9th WISH Music Awards.
          </p>
          <p class="text-dark mb-4">
            The 9th Wish Music Awards happened on January 14, 2024 at the Araneta Coliseum.
          </p>
          <a href="#" class="btn btn-learn">LEARN MORE</a>
        </div>
      </div>
    </div>

    <!--
      INSTRUCTIONS FOR FUTURE UPDATES:
      - Add new cards at the TOP of the "visible-cards" section below.
      - Move the LAST card from "visible-cards" to the TOP of "extra-cards" to keep only 9 visible.
    -->

    <!-- Visible cards (always shown — keep 9 max) -->
    <div class="section-container" id="visible-cards">
         <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/dartchamps.jpg') }}">
            </div>
            <div class="card-content">
                <h3>Calling All Aspiring Musicians</h3>
                <p>The PARC Foundation is now welcoming aspiring scholars for Violin, Cello, and Contrabass classes.</p>
                <span class="event-date">June 10, 2026</span>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/NEWS/CALLING.webp') }}">
            </div>
            <div class="card-content">
                <h3>Calling All Aspiring Musicians</h3>
                <p>The PARC Foundation is now welcoming aspiring scholars for Violin, Cello, and Contrabass classes.</p>
                <span class="event-date">June 10, 2026</span>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/NEWS/HIYAS.png') }}">
            </div>
            <div class="card-content">
                <h3>HIYAS Fashion Charity Gala</h3>
                <p>The PARC Foundation joins LYOPERA in celebrating our Asian heritage in HIYAS Charity Fundraising Gala. A20 Productions' Sherwin Sozon met with The PARC Foundation Chairman, William Guido, to deliver the funds raised for the Parcaralan Scholars program.</p>
                <span class="event-date">April 30, 2026</span>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/NEWS/KRYSTEL GO.png') }}">
            </div>
            <div class="card-content">
                <h3>A TRIUMPH FOR INCLUSION!</h3>
                <p>From her training grounds at Kidz Groove TV in partnership with The PARC Foundation Krystel has risen as a powerful neurodivergent star.</p>
                <span class="event-date">December 29, 2025</span>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/card1.webp') }}">
            </div>
            <div class="card-content">
                <h3>Corey Koh - A Night of Melodies</h3>
                <p>Get ready for an enchanting evening as Corey Koh brings his incredible voice to the stage at the upcoming "A Night of Melodies" concert on 15th February 2025.</p>
                <span class="event-date">February 15, 2025</span>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/card2.webp') }}">
            </div>
            <div class="card-content">
                <h3>Corey Koh's Latest Release - "Heartstrings"</h3>
                <p>Corey Koh has just released his newest single, "Heartstrings". Available for streaming on all platforms. Don't miss out on this soulful track!</p>
                <span class="release-date">January 30, 2025</span>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/WTG2.webp') }}">
            </div>
            <div class="card-content">
                <h3>The PARC Foundation kicked off the year in style as Wish 107.5</h3>
                <p>Chairman and CEO of Globaltronics was awarded the KDR Icon of Music and Philanthropy during the 9th WISH Music Awards. The 9th Wish Music Awards happened on January 14, 2024 at the Araneta Coliseum.</p>
                <span class="event-date">January 14, 2024</span>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/spiritgiving.webp') }}">
            </div>
            <div class="card-content">
                <h3>What do Love, Hope, and Music have in common</h3>
                <p>Last December 3, 2022, our very own PARCaralan Scholars and "Singaporean Tenor" Corey Koh, along with some of the most amazing talents from Lyric Opera of the Philippines.</p>
                <span class="event-date">December 15, 2022</span>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/SOGPOSTER2022.webp') }}">
            </div>
            <div class="card-content">
                <h3>Spirit of Giving 2022: A Celebration of Love, Hope, and Music</h3>
                <p>More than just a concert, an opportunity to transform lives through performing arts is close to reaching. Show your support!</p>
                <span class="event-date">December 8, 2022</span>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/card3.webp') }}">
            </div>
            <div class="card-content">
                <h3>The young and talented Mr. Corey Kho, a "Singaporean Tenor"</h3>
                <p>The young and talented Mr. Corey Kho, a "Singaporean Tenor", brought the holiday cheer early this year, much to the delight of our Scholars.</p>
                <span class="event-date">December 20, 2024</span>
            </div>
        </div>
    </div>

    <!-- Extra cards — hidden by default, revealed by More button -->
    <!-- When adding new cards above, move the last visible card to the TOP of this section -->
    <div class="section-container" id="extra-cards" style="display: none;">
        <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/sog2021part1.webp') }}">
            </div>
            <div class="card-content">
                <h3>Spirit of Giving 2021: Smile behind the Mask | 1 Day to Go</h3>
                <p>1 DAY TO GO… and we will soon celebrate love and generosity with Spirit of Giving 2021: Smile Behind The Mask, a charity online concert for the benefit of Philippine General Hospital ...</p>
                <span class="event-date">December 3, 2021</span>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/sog2021_DRMS.webp') }}">
            </div>
            <div class="card-content">
                <h3>Spirit of Giving 2021: Smile Behind The Mask | Dr. Raul M. Sunico</h3>
                <p>Dr. Raul M. Sunico, multi-awarded international concert pianist and music author, former president of the Cultural Center of the Philippines, dean of the College of Music and the Performing Arts of ...</p>
                <span class="event-date">November 26, 2021</span>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/Slider_MG.webp') }}">
            </div>
            <div class="card-content">
                <h3>Spirit of Giving 2021: Smile behind the Mask | Mary Grace Khu</h3>
                <p>Mary Grace Khu will be joining as our main host in Spirit of Giving 2021: Smile Behind The Mask, a charity online concert for the benefit of Philippine General Hospital (PGH)</p>
                <span class="event-date">November 26, 2021</span>
            </div>
        </div>
          <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/sog2021_NLA.webp') }}">
            </div>
            <div class="card-content">
                <h3>Spirit of Giving 2021: Smile behind the Mask | Nicole Asensio</h3>
                <p>Award-winning singer-songwriter Nicole Laurel Asensio is pleased to invite everyone to watch Spirit of Giving 2021: Smile Behind The Mask, a charity online concert for the benefit of Philippine General Hospital (PGH) Medical Frontliners and PARCaralan Scholars, on December 4, 2021, Saturday, 7:30 PM (GMT +8).</p>
                 <p>It will be streamed live via Globaltronics’ YouTube account and Facebook page from DigiPARC, the first “Truly Digital Events Place” in the country..</p>
                <span class="event-date">November 12, 2021</span>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/sog2021_CK.webp') }}">
            </div>
            <div class="card-content">
                <h3>Spirit of Giving 2021: Smile behind the Mask | Corey Koh</h3>
                <p>Singaporean classical tenor Corey Koh cordially invites everyone to watch Spirit of Giving 2021: Smile Behind The Mask, a charity online concert for the benefit of Philippine General Hospital (PGH) Medical Frontliners and PARCaralan Scholars, on December 4, 2021, Saturday, 7:30 PM (GMT +8).</p>
                 <p>It will be streamed live via Globaltronics’ YouTube account and Facebook page from DigiPARC, the first “Truly Digital Events Place” in the country.</p>
                <span class="event-date">November 10, 2021</span>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/sog2021_kids_invite.webp') }}">
            </div>
            <div class="card-content">
                <h3>Spirit of Giving 2021: Smile Behind The Mask | PARCaralan Scholars</h3>
                <p>When COVID-19 hit, the PARCaralan Scholars had to rely on meager resources raised through previous fundraising activities of The PARC Foundation to be able to continue getting free educational assistance and life skills training programs in music, arts, and theatre.
                <br> 
               </p>
                <span class="event-date">August 3, 2024</span>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/sog2021_gigi.webp') }}">
            </div>
            <div class="card-content">
                <h3>Spirit of Giving 2021: Smile Behind The Mask | Gigi De Lana and The Gigi Vibes</h3>
                <p>Some of the finest talents here in the Philippines like “Asia’s Phoenix” Morisette Amon and “The Country’s Premier Wedding Band” 3rd Avenue, impressed us with their musical talents in Spirit of Giving 2019 at Conrad Hotel and Spirit of Giving 202o at DigiPARC, respectively.</p>
                                <p>This December, get ready for Gigi De Lana and The Gigi Vibes in Spirit of Giving 2021: Smile Behind The Mask, a charity online concert for the benefit of Philippine General Hospital (PGH) Medical Frontliners and PARCaralan Scholars.</p>
                <span class="event-date">November 26, 2021</span>
            </div>
        </div>
         <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/Capture.webp') }}">
            </div>
            <div class="card-content">
                <h3>Project Tempo</h3>
                <p>UPDATE! Here's a #ProjectTEMPO Fundraiser Update! Over the past month, we have now raised Php 45,015! It's slow and steady progress and we would like to thank all our generous donors for helping our #PARCaralan scholars!..</p>
                <span class="event-date">July 15, 2020</span>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/Capture1.webp') }}">
            </div>
            <div class="card-content">
                <h3>The 4th Foundation Day</h3>
                <p>🙌 THANK YOU 👏 for joining us in The 4th PARC Foundation Day: Relive the Passion! 🎶💃</p>
                <span class="event-date">July 15, 2020</span>
            </div>
        </div>
         <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/Capture3.webp') }}">
            </div>
            <div class="card-content">
                <h3>Projectt Tempo</h3>
                <p>🙌 Catch the Prince of Broadway Jon Joven Uy LIVE on Zoom and Facebook Live TONIGHT at 6:30 pm! 🤩🎤</p>
                <span class="event-date">July 15, 2020</span>
            </div>
        </div>
           <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/wtg1.webp') }}">
            </div>
            <div class="card-content">
                <h3>Carrying the Torch</h3>
                <p>In the natural order of things, we’ll often read about how a foundation or a notable endeavor is dedicated to the memory of a father or mother, how the children are carrying on a tradition set by their parents.🎤</p>
</p>In the case of PARC, the Performing Arts and Recreation Center Foundation, found on Lt. Artiaga St. in San Juan City, there’s a unique reversal of order an exemplary vision started by a son, and now carried on by his father, due to the son’s untimely demise..</p>
                <span class="event-date">May 31, 2019</span>
            </div>
        </div>
           <div class="card">
            <div class="card-image">
                <img src="{{ asset('./assets/image/Capture4.webp') }}">
            </div>
            <div class="card-content">
                <h3>REISE: Mixed Voices in Manila</h3>
                <p>Here's a wunderbar picture of Mixed Voices with our #PARCaralan Music Scholars after their choral workshop last Sunday! Listen to this wonderful collaboration TONIGHT!....</p>
                <span class="event-date">Febraury 27, 2020, 2020</span>
            </div>
        </div>
      </div>

    <!-- More / Back Button -->
    <div class="text-center mt-4 mb-2">
      <button id="more-btn" class="btn btn-more">MORE</button>
    </div>

  </div>
</section>

<script>
  document.getElementById('more-btn').addEventListener('click', function () {
    var extraCards = document.getElementById('extra-cards');
    if (extraCards.style.display === 'none' || extraCards.style.display === '') {
      extraCards.style.display = 'flex';
      this.textContent = 'BACK';
    } else {
      extraCards.style.display = 'none';
      this.textContent = 'MORE';
    }
  });
</script>

  @include('layouts.contacts')

  <!-- Include Footer -->
  @include('layouts.footer')

  <!-- JS -->
  <script src="{{ asset('jsfolder/packages.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Scroll animation observer -->
  <script>
    const animEls = document.querySelectorAll('.anim-left, .anim-right');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.2 });
    animEls.forEach(el => observer.observe(el));
  </script>

</body>
</html>
