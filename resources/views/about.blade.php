<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us — PARC Foundation</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('cssfolder/mainnavbar.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/about.css') }}" />
</head>
<body>

  @include('layouts.navbar')

  <!-- ── Hero Banner ── -->
  <section class="about-hero">
    <div class="about-hero-overlay">
      <h1 class="about-hero-title">About <span>Us</span></h1>
    </div>
  </section>

  <!-- ── About Intro ── -->
  <section class="about-intro">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-9 text-center">
          <h2 class="about-section-heading">About <span>Us</span></h2>
          <p class="about-intro-text">
            The Performing Arts and Recreation Center (PARC) Foundation is a registered, non-stock,
            non-profit organization founded in December 2015 which is committed to harnessing the
            power of performing arts to transform lives - especially the youth.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- ── Mission & Vision ── -->
  <section class="about-mv">
    <div class="container">
      <div class="row g-4 justify-content-center">
        <div class="col-md-5">
          <div class="mv-card">
            <div class="mv-icon"><i class="bi bi-bullseye"></i></div>
            <h3>Our Mission</h3>
            <p>To harness the power of performing arts in transforming the lives of underprivileged children and youth by providing them with world-class training, values formation, and pathways to a brighter future.</p>
          </div>
        </div>
        <div class="col-md-5">
          <div class="mv-card">
            <div class="mv-icon"><i class="bi bi-eye"></i></div>
            <h3>Our Vision</h3>
            <p>A society where every child, regardless of economic status, has access to the transformative power of the arts — enabling them to become confident, compassionate, and productive citizens.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ── Video 1: Our Story ── -->
  <section class="about-video">
    <div class="container">
      <h2 class="about-section-heading text-center">Our <span>Story</span></h2>
      <div class="row justify-content-center mb-4">
        <div class="col-lg-9 text-center">
          <p class="about-intro-text">The Performing Arts and Recreation Center (PARC) Foundation is a registered, non-stock, non-profit organization founded in December 2015 which is committed to harnessing the power of performing arts to transform lives - especially the youth.</p>
        </div>
      </div>

      <div class="about-video-wrapper">
        <div class="vimeo-embed-container">
          <iframe
            src="https://player.vimeo.com/video/1200286268?badge=0&autopause=0&player_id=0&app_id=58479"
            frameborder="0"
            allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media; web-share"
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen
            title="PARC_AVP">
          </iframe>
        </div>
      </div>
    </div>
  </section>

  <!-- ── Video 2: Balik-JAM ── -->
  <section class="about-video about-video-alt">
    <div class="container">
      <h2 class="about-section-heading text-center">Balik-JAM Sa <span>PARCaralan</span></h2>
      <div class="row justify-content-center mb-4">
        <div class="col-lg-9 text-center">
          <p class="about-intro-text">Get ready for our first video vlog! Let's recall the stories and inspirations of music, the performing arts, and celebration of talents among our PARCaralan scholars.</p>
        </div>
      </div>

      <div class="about-video-wrapper">
        <div class="vimeo-embed-container">
          <iframe
            src="https://player.vimeo.com/video/1200289526?badge=0&autopause=0&player_id=0&app_id=58479"
            frameborder="0"
            allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media; web-share"
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen
            title="PARC Foundation 10 years Milestone">
          </iframe>
        </div>
      </div>
    </div>
  </section>

  <!-- ── Core Values ── -->
  <section class="about-values">
    <div class="container">
      <h2 class="about-section-heading text-center">Our Core Values</h2>
      <div class="row g-4 justify-content-center mt-2">

        <div class="col-md-6 col-lg-5">
          <div class="value-card text-center">
            <div class="value-icon"><i class="bi bi-heart-fill"></i></div>
            <h5>Compassion</h5>
            <p>We put the welfare of our scholars first in everything we do.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-5">
          <div class="value-card text-center">
            <div class="value-icon"><i class="bi bi-stars"></i></div>
            <h5>Excellence</h5>
            <p>We strive for the highest standards in performing arts education.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-5">
          <div class="value-card text-center">
            <div class="value-icon"><i class="bi bi-people-fill"></i></div>
            <h5>Community</h5>
            <p>We build lasting relationships with our scholars, families, and supporters.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-5">
          <div class="value-card text-center">
            <div class="value-icon"><i class="bi bi-lightbulb-fill"></i></div>
            <h5>Innovation</h5>
            <p>We continuously evolve our programs to meet the needs of the youth.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ── Stats Strip ── -->
  <section class="about-stats">
    <div class="container">
      <div class="row g-0 justify-content-center text-center">
        <div class="col-6 col-md-3 stat-item">
          <span class="stat-number count-up" data-target="80">0</span><span class="stat-plus">+</span>
          <p class="stat-label">Scholars Trained</p>
        </div>
        <div class="col-6 col-md-3 stat-item">
          <span class="stat-number count-up" data-target="30">0</span><span class="stat-plus">+</span>
          <p class="stat-label">Community Outreach Programs</p>
        </div>
        <div class="col-6 col-md-3 stat-item">
          <span class="stat-number count-up" data-target="9">0</span><span class="stat-plus">+</span>
          <p class="stat-label">Years of Impact</p>
        </div>
        <div class="col-6 col-md-3 stat-item">
          <span class="stat-number count-up" data-target="100">0</span><span class="stat-plus">+</span>
          <p class="stat-label">Partner Organizations</p>
        </div>
      </div>
    </div>
  </section>

  @include('layouts.contacts')
  @include('layouts.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://player.vimeo.com/api/player.js"></script>

  <script>
    /* ── Count-up on scroll ── */
    function animateCount(el) {
      var target = parseInt(el.getAttribute('data-target'), 10);
      var duration = 1800, step = 16;
      var increment = target / (duration / step);
      var current = 0;
      var timer = setInterval(function () {
        current += increment;
        if (current >= target) { current = target; clearInterval(timer); }
        el.textContent = Math.floor(current);
      }, step);
    }

    var countEls = document.querySelectorAll('.count-up');
    var countObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          animateCount(entry.target);
          countObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });
    countEls.forEach(function (el) { countObserver.observe(el); });
  </script>

</body>
</html>
