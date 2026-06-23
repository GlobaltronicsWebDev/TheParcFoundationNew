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

  <!-- ── Vimeo Video ── -->
  <section class="about-video">
    <div class="container">
      <h2 class="about-section-heading text-center">Our Story</h2>
      <p class="about-video-sub text-center">Watch how PARC Foundation is changing lives through the arts.</p>

      <div class="about-video-wrapper">
        <!-- Replace the Vimeo video ID below with your actual video ID -->
        <div class="vimeo-embed-container">
          <iframe
            id="vimeo-player"
            src="https://player.vimeo.com/video/YOUR_VIMEO_ID?badge=0&autopause=0&player_id=0&app_id=58479"
            frameborder="0"
            allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media"
            allowfullscreen
            title="PARC Foundation — Our Story">
          </iframe>
        </div>

        <!-- Vimeo ID input for easy updating -->
        <div class="vimeo-id-form text-center mt-4">
          <p class="vimeo-hint">Enter a Vimeo Video ID to update the player:</p>
          <div class="vimeo-input-row">
            <input type="text" id="vimeo-id-input" class="vimeo-input" placeholder="e.g. 123456789" />
            <button class="vimeo-load-btn" id="vimeo-load-btn">Load Video</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ── Core Values ── -->
  <section class="about-values">
    <div class="container">
      <h2 class="about-section-heading text-center">Our Core Values</h2>
      <div class="row g-4 justify-content-center mt-2">

        <div class="col-6 col-md-3">
          <div class="value-card text-center">
            <div class="value-icon"><i class="bi bi-heart-fill"></i></div>
            <h5>Compassion</h5>
            <p>We put the welfare of our scholars first in everything we do.</p>
          </div>
        </div>

        <div class="col-6 col-md-3">
          <div class="value-card text-center">
            <div class="value-icon"><i class="bi bi-stars"></i></div>
            <h5>Excellence</h5>
            <p>We strive for the highest standards in performing arts education.</p>
          </div>
        </div>

        <div class="col-6 col-md-3">
          <div class="value-card text-center">
            <div class="value-icon"><i class="bi bi-people-fill"></i></div>
            <h5>Community</h5>
            <p>We build lasting relationships with our scholars, families, and supporters.</p>
          </div>
        </div>

        <div class="col-6 col-md-3">
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
      const target = parseInt(el.getAttribute('data-target'), 10);
      const duration = 1800;
      const step = 16;
      const increment = target / (duration / step);
      let current = 0;
      const timer = setInterval(function () {
        current += increment;
        if (current >= target) { current = target; clearInterval(timer); }
        el.textContent = Math.floor(current);
      }, step);
    }

    const countEls = document.querySelectorAll('.count-up');
    const countObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          animateCount(entry.target);
          countObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });
    countEls.forEach(function (el) { countObserver.observe(el); });

    /* ── Vimeo ID loader ── */
    document.getElementById('vimeo-load-btn').addEventListener('click', function () {
      const id = document.getElementById('vimeo-id-input').value.trim();
      if (!id) return;
      const iframe = document.getElementById('vimeo-player');
      iframe.src = 'https://player.vimeo.com/video/' + id + '?badge=0&autopause=0&player_id=0&app_id=58479';
    });
  </script>

</body>
</html>
