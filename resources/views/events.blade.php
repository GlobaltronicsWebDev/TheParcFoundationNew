<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PARC Foundation — Events</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/logo/parclogosquare.png') }}">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('cssfolder/mainnavbar.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/contacts.css') }}" />
  <link rel="stylesheet" href="{{ asset('cssfolder/events.css') }}" />
</head>
<body>
  @include('layouts.navbar')

  <section class="events-section">
    <div class="container">

      <!-- Header -->
      <div class="events-header text-center">
        <h2 class="fw-bold">
          <span class="ev-anim-left">Our</span>
          <span class="ev-highlight ev-anim-right">Events</span>
        </h2>
        <p class="ev-subtitle">Check it out!</p>
      </div>

      <!-- Filter Tabs -->
      <div class="events-filter text-center">
        <label class="filter-option active" data-filter="all">
          <span class="filter-dot"></span> ALL EVENTS
        </label>
        <label class="filter-option" data-filter="upcoming">
          <span class="filter-dot"></span> UPCOMING
        </label>
        <label class="filter-option" data-filter="previous">
          <span class="filter-dot"></span> PREVIOUS
        </label>
      </div>

      <!-- Events Grid -->
      <div class="events-grid" id="events-grid">

        <!-- Card: Spirit of Giving 2022 -->
        <div class="ev-card" data-category="previous">
          <img src="{{ asset('./assets/image/SOGPOSTER2022.webp') }}" alt="Spirit of Giving 2022">
          <div class="ev-overlay">
            <h4>Spirit of Giving 2022</h4>
            <p>A Celebration of Love, Hope, and Music</p>
          </div>
        </div>

        <!-- Card: ARTiPARC -->
        <div class="ev-card" data-category="previous">
          <img src="{{ asset('./assets/image/Artiparc.webp') }}" alt="ARTiPARC">
          <div class="ev-overlay">
            <h4>ARTiPARC</h4>
            <p>A Fundraising Visual Arts Exhibit</p>
          </div>
        </div>

        <!-- Card: Balik-JAM sa PARCaralan -->
        <div class="ev-card" data-category="previous">
          <img src="{{ asset('./assets/image/spiritgiving.webp') }}" alt="Balik-JAM sa PARCaralan">
          <div class="ev-overlay">
            <h4>Balik-JAM sa PARCaralan</h4>
            <p>Kickoff Event 2022</p>
          </div>
        </div>

        <!-- Card: Spirit of Giving 2021 -->
        <div class="ev-card" data-category="previous">
          <img src="{{ asset('./assets/image/sog2021part1.webp') }}" alt="Spirit of Giving 2021">
          <div class="ev-overlay">
            <h4>Spirit of Giving 2021</h4>
            <p>Smile Behind the Mask</p>
          </div>
        </div>

        <!-- Card: Spirit of Giving 2020 -->
        <div class="ev-card" data-category="previous">
          <img src="{{ asset('./assets/image/Capture.webp') }}" alt="Spirit of Giving 2020">
          <div class="ev-overlay">
            <h4>Spirit of Giving 2020</h4>
            <p>A Charity Online Concert</p>
          </div>
        </div>

        <!-- Card: Project TEMPO -->
        <div class="ev-card" data-category="previous">
          <img src="{{ asset('./assets/image/Capture3.webp') }}" alt="Project TEMPO">
          <div class="ev-overlay">
            <h4>Project TEMPO</h4>
            <p>Fundraiser for PARCaralan Scholars</p>
          </div>
        </div>

        <!-- Card: 4th Foundation Day -->
        <div class="ev-card" data-category="previous">
          <img src="{{ asset('./assets/image/Capture1.webp') }}" alt="4th Foundation Day">
          <div class="ev-overlay">
            <h4>4th Foundation Day</h4>
            <p>Relive the Passion</p>
          </div>
        </div>

        <!-- Card: REISE Mixed Voices -->
        <div class="ev-card" data-category="previous">
          <img src="{{ asset('./assets/image/Capture4.webp') }}" alt="REISE Mixed Voices">
          <div class="ev-overlay">
            <h4>REISE: Mixed Voices in Manila</h4>
            <p>Choral Workshop & Concert</p>
          </div>
        </div>

        <!-- Card: Calling All Aspiring Musicians (Upcoming) -->
        <div class="ev-card" data-category="upcoming">
          <img src="{{ asset('./assets/image/card1.webp') }}" alt="Calling All Aspiring Musicians">
          <div class="ev-overlay">
            <h4>Calling All Aspiring Musicians</h4>
            <p>June 10, 2026 — Scholar Auditions</p>
          </div>
        </div>

        <!-- Card: HIYAS Fashion Charity Gala (Upcoming) -->
        <div class="ev-card" data-category="upcoming">
          <img src="{{ asset('./assets/image/card2.webp') }}" alt="HIYAS Fashion Charity Gala">
          <div class="ev-overlay">
            <h4>HIYAS Fashion Charity Gala</h4>
            <p>April 30, 2026 — Charity Fundraising</p>
          </div>
        </div>

        <!-- Card: A Night of Melodies (Upcoming) -->
        <div class="ev-card" data-category="upcoming">
          <img src="{{ asset('./assets/image/card3.webp') }}" alt="A Night of Melodies">
          <div class="ev-overlay">
            <h4>A Night of Melodies</h4>
            <p>Corey Koh Live in Concert</p>
          </div>
        </div>

        <!-- Card: 9th WISH Music Awards -->
        <div class="ev-card" data-category="previous">
          <img src="{{ asset('./assets/image/WTG2.webp') }}" alt="KDR Icon Award">
          <div class="ev-overlay">
            <h4>9th WISH Music Awards</h4>
            <p>KDR Icon of Music and Philanthropy</p>
          </div>
        </div>

        <!-- Card: GoVol 2019 -->
        <div class="ev-card" data-category="previous">
          <img src="{{ asset('./assets/image/Copy of GoVol 2019 Poster.webp') }}" alt="GoVol 2019">
          <div class="ev-overlay">
            <h4>GoVol 2019</h4>
            <p>Volunteerism & Community Event</p>
          </div>
        </div>

        <!-- Card: May Isang Sundalo -->
        <div class="ev-card" data-category="previous">
          <img src="{{ asset('./assets/image/Copy of May Isang Sundalo poster final.webp') }}" alt="May Isang Sundalo">
          <div class="ev-overlay">
            <h4>May Isang Sundalo</h4>
            <p>A PARC Foundation Production</p>
          </div>
        </div>

        <!-- Card: Spring Awakening -->
        <div class="ev-card" data-category="previous">
          <img src="{{ asset('./assets/image/Copy of Spring Awakening blueREP Main Poster.webp') }}" alt="Spring Awakening">
          <div class="ev-overlay">
            <h4>Spring Awakening</h4>
            <p>blueREP Main Production</p>
          </div>
        </div>

        <!-- Card: Lucinda's Big Opening -->
        <div class="ev-card" data-category="previous">
          <img src="{{ asset('./assets/image/Copy of Lucindas Big Opening poster final.webp') }}" alt="Lucinda's Big Opening">
          <div class="ev-overlay">
            <h4>Lucinda's Big Opening</h4>
            <p>A PARC Foundation Production</p>
          </div>
        </div>

      </div>
      <!-- /events-grid -->

      <!-- Full View Button -->
      <div class="text-center mt-5">
        <a href="{{ url('/events-gallery') }}" class="btn btn-full-view">FULL VIEW OF EVENTS</a>
      </div>

    </div>
  </section>

  @include('layouts.contacts')
  @include('layouts.footer')

  <script src="{{ asset('jsfolder/packages.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Filter logic
    const filterOptions = document.querySelectorAll('.filter-option');
    const evCards = document.querySelectorAll('.ev-card');

    filterOptions.forEach(option => {
      option.addEventListener('click', function () {
        filterOptions.forEach(o => o.classList.remove('active'));
        this.classList.add('active');

        const filter = this.dataset.filter;
        evCards.forEach(card => {
          if (filter === 'all' || card.dataset.category === filter) {
            card.style.display = 'block';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });

    // Scroll animation
    const animEls = document.querySelectorAll('.ev-anim-left, .ev-anim-right');
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
