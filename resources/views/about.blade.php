<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us — PARC Foundation</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/logo/parclogosquare.png') }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('cssfolder/mainnavbar.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/contacts.css') }}" />
  <link rel="stylesheet" href="{{ asset('cssfolder/about.css') }}" />
</head>
<body>

  @include('layouts.navbar')
    <!-- <audio id="bgMusic" loop>
    <source src="{{ asset('assets/audio/violinbg.mp3') }}" type="audio/mpeg">
   </audio> -->
  <!-- ── About Intro ── -->
   <br><br>
  <section class="about-intro">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-9 text-center">
          <h2 class="about-section-heading fade-right">About <span>Us</span></h2>
          <p class="about-intro-text">
            The Performing Arts and Recreation Center (PARC) Foundation is a registered, non-stock,
            non-profit organization founded in December 2015 which is committed to harnessing the
            power of performing arts to transform lives - especially the youth.
          </p>
        </div>
      </div>
      <br><br>
      <!-- ── 2 Videos side by side ── -->
      <div class="row g-4 justify-content-center mt-4">
        <div class="col-md-6">
          <p class="about-video-label text-center"></p>
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
        <div class="col-md-6">
          <p class="about-video-label text-center"></p>
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

    </div>
  </section>

  <section class="about-intro">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-9 text-center">
          <h2 class="about-section-heading fade-left">The PARC Foundation marks <span>Its 10th year celebration</span></h2>
          <p class="about-intro-text">
            The PARC Foundation marks Its 10th year celebration. 
            The Performing Arts and Recreation Center (PARC) Foundation is a registered, 
            non-stock, non-profit organization founded in 
            December 2015 which is committed to harnessing the power of p
            erforming arts to transform lives - especially the youth.
          </p>
        </div>
      </div>

     <!-- 3rd video -->
      <div class="row g-4 justify-content-center mt-4">
         <div class="col-md-6">
          <p class="about-video-label text-center"></p>
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
            <h3 class="fade-right">Our Mission</h3>
            <p>To harness the power of performing arts in transforming the lives of underprivileged children and youth by providing them with world-class training, values formation, and pathways to a brighter future.</p>
          </div>
        </div>
        <div class="col-md-5">
          <div class="mv-card">
            <div class="mv-icon"><i class="bi bi-eye"></i></div>
            <h3 class="fade-left">Our Vision</h3>
            <p>A society where every child, regardless of economic status, has access to the transformative power of the arts — enabling them to become confident, compassionate, and productive citizens.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ── Core Values ── -->
  <section class="about-values">
    <div class="container">
      <h2 class="about-section-heading text-center fade-right">Our Core Values</h2>
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
          <span class="stat-number count-up" data-target="10">0</span><span class="stat-plus">+</span>
          <p class="stat-label">Years of Impact</p>
        </div>
        <div class="col-6 col-md-3 stat-item">
          <span class="stat-number count-up" data-target="10">0</span><span class="stat-plus">+</span>
          <p class="stat-label">Partner Organizations</p>
        </div>
      </div>
    </div>
  </section>

   <!-- ── Founder Quote ── -->
  <section class="founder-quote">
    <div class="founder-quote-overlay">
      <div class="founder-content">
        <img src="{{ asset('assets/image/wimer.webp') }}" alt="Wilmer Guido" class="founder-photo" />
        <blockquote class="founder-text fade-left">
          "Everytime we get to help someone,<br>it's the best feeling in the world."
        </blockquote>
        <p class="founder-name fade-right">Wilmer Guido (1992 – 2017), Founder</p>
      </div>
    </div>
  </section>

  
  <!-- ── Our Story ── -->
  <section class="our-story">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-9 text-center">
          <h2 class="about-section-heading fade-right">Our <span>Story</span></h2>
          <p class="about-intro-text">
            The PARC Foundation was established as a non-stock, non-profit organization in December 2015. It was founded
            by Wilmer Guido, a passionate 23-year old whose dream was to put up a performing arts center to help people,
            especially the underprivileged youth and struggling local artists, fulfill their passions as well.
          </p>
          <p class="about-intro-text">
            Determined to achieve his dream, Wilmer formed his core team with like-minded friends Samsam Santiago and
            Issay Nodalo. As a first move, they repurposed an old office building into a performing arts hub. On June 1, 2016,
            they officially opened their doors to the public. Since then, The PARC Foundation has been a second home to
            numerous performing artists and groups who enjoy our creative spaces at the friendliest rates.
          </p>
          <p class="about-intro-text">
            In response to the stigma that the performing arts is only for well-off individuals, the foundation launched
            PARCaralan in December 2017. The aim of the program is to bring free quality arts education to some of the
            most talented and promising children from underserved communities near PARC.
          </p>
          <p class="about-intro-text">
            Unfortunately, it was during the same month when PARC lost its founder due to a sudden illness. But with the
            support of his family and the Guido Group of Companies, Wilmer's spirit lives on and his legacy continues
            through The PARC Foundation and its mission to enable and support the Filipino performing arts community.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- ── Board of Trustees ── -->
  <section class="about-bot">
    <div class="container">
      <h2 class="about-section-heading text-center fade-left">2021 BOARD <span>OF TRUSTEES</span></h2>

      <div class="row justify-content-center g-4 mt-3">

        <div class="col-6 col-md-3 text-center">
          <div class="bot-member">
            <img src="{{ asset('assets/image/bot/William T. Guido.png') }}" alt="William T. Guido" class="bot-photo">
            <p class="bot-name">William T. Guido</p>
          </div>
        </div>

        <div class="col-6 col-md-3 text-center">
          <div class="bot-member">
            <img src="{{ asset('assets/image/bot/Raul M. Sunico.png') }}" alt="Dr. Raul M. Sunico" class="bot-photo">
            <p class="bot-name">Dr. Raul M. Sunico</p>
          </div>
        </div>

        <div class="col-6 col-md-3 text-center">
          <div class="bot-member">
            <img src="{{ asset('assets/image/bot/Macy G Lee.png') }}" alt="Macy G. Lee" class="bot-photo">
            <p class="bot-name">Macy G. Lee</p>
          </div>
        </div>

        <div class="col-6 col-md-3 text-center">
          <div class="bot-member">
            <img src="{{ asset('assets/image/bot/Rodel Colmenar.png') }}" alt="Maestro Rodel Colmenar" class="bot-photo">
            <p class="bot-name">Maestro Rodel Colmenar</p>
          </div>
        </div>

        <div class="col-6 col-md-3 text-center">
          <div class="bot-member">
            <img src="{{ asset('assets/image/bot/IOG.png') }}" alt="Imelda O. Guido" class="bot-photo">
            <p class="bot-name">Imelda O. Guido</p>
          </div>
        </div>

        <div class="col-6 col-md-3 text-center">
          <div class="bot-member">
            <img src="{{ asset('assets/image/bot/AKT.png') }}" alt="Alvin Kingson Tan" class="bot-photo">
            <p class="bot-name">Alvin Kingson Tan</p>
          </div>
        </div>

        <div class="col-6 col-md-3 text-center">
          <div class="bot-member">
            <img src="{{ asset('assets/image/bot/JG.png') }}" alt="William TI, Jr" class="bot-photo">
            <p class="bot-name">William TI, Jr</p>
          </div>
        </div>

        <div class="col-6 col-md-3 text-center">
          <div class="bot-member">
            <img src="{{ asset('assets/image/bot/LG.png') }}" alt="Luzviminda Gatmaitan" class="bot-photo">
            <p class="bot-name">Luzviminda Gatmaitan</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ── Advisors ── -->
  <section class="about-advisors">
    <div class="container">
      <h2 class="about-section-heading text-center fade-right">ADV<span>ISORS</span></h2>

      <div class="row justify-content-center g-4 mt-3">

        <div class="col-6 col-md-3 text-center">
          <div class="bot-member">
            <img src="{{ asset('assets/image/bot/CG.png') }}" alt="Colin Goh" class="bot-photo">
            <p class="bot-name">Colin Goh</p>
          </div>
        </div>

        <div class="col-6 col-md-3 text-center">
          <div class="bot-member">
            <img src="{{ asset('assets/image/bot/ATL.png') }}" alt="Antonio (Tony) Lopez" class="bot-photo">
            <p class="bot-name">Antonio (Tony) Lopez</p>
          </div>
        </div>

        <div class="col-6 col-md-3 text-center">
          <div class="bot-member">
            <img src="{{ asset('assets/image/bot/JG.png') }}" alt="John Gan" class="bot-photo">
            <p class="bot-name">John Gan</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ── Executive Management Team ── -->
  <section class="about-emt">
    <div class="container">
      <h2 class="emt-heading fade-left">EXECUTIVE <span>MANAGEMENT TEAM</span></h2>

      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <ul class="emt-list">
            <li>
              <span class="emt-role">Chairman</span>
              <span class="emt-name">William T. Guido</span>
            </li>
            <li>
              <span class="emt-role">Vice Chairman</span>
              <span class="emt-name">Dr. Raul M. Sunico</span>
            </li>
            <li>
              <span class="emt-role">Corporate Sec</span>
              <span class="emt-name">Luzviminda Gatmaitan</span>
            </li>
            <li>
              <span class="emt-role">Treasurer</span>
              <span class="emt-name">Nekka Verches</span>
            </li>
            <li>
              <span class="emt-role">Auditor</span>
              <span class="emt-name">Virginia Besa (CPA)</span>
            </li>
          </ul>
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

    /* ── Heading slide animations ── */
    var slideEls = document.querySelectorAll('.fade-left, .fade-right');
    var slideObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          slideObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.2 });
    slideEls.forEach(function (el) { slideObserver.observe(el); });

        /* ── 🎻 Intelligent Multi-page Background Music Logic ── */
    const music = document.getElementById('bgMusic');

    function tryToPlay() {
      music.play().then(() => {
        // Safe play achieved, lock it into memory
        localStorage.setItem('parcMusicPlaying', 'true');
      }).catch(() => {
        // Autoplay blocked by browser. Hook into the first click anywhere on the site
        document.addEventListener('click', forcePlay, { once: true });
      });
    }

    function forcePlay() {
      music.play();
      localStorage.setItem('parcMusicPlaying', 'true');
    }

    // Attempt audio stream initialization as soon as window loads
    window.addEventListener('load', () => {
      if (localStorage.getItem('parcMusicPlaying') === 'true' || !localStorage.getItem('parcMusicPlaying')) {
        tryToPlay();
      }
    });
  </script>

</body>
</html>
