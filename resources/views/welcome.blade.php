<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PARC Foundation</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/logo/parclogosquare.png') }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('cssfolder/main.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/mainnavbar.css?vr=2') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/contacts.css') }}" />
  <link rel="stylesheet" href="{{ asset('cssfolder/carousel.css') }}" />

  <style>
    /* ── Preloader ── */
    #preloader {
      position: fixed;
      inset: 0;
      background: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      z-index: 99999;
      transition: opacity 0.6s ease, visibility 0.6s ease;
    }
    #preloader.hide {
      opacity: 0;
      visibility: hidden;
    }
    #preloader img {
      width: 110px;
      animation: pulse 1.2s ease-in-out infinite;
    }
    #preloader .loading-bar-wrap {
      width: 180px;
      height: 4px;
      background: #e0e0e0;
      border-radius: 4px;
      margin-top: 22px;
      overflow: hidden;
    }
    #preloader .loading-bar {
      height: 100%;
      width: 0%;
      background: linear-gradient(90deg, #f7581e, #f7af1e);
      border-radius: 4px;
      animation: loadbar 5s linear forwards;
    }
    #preloader p {
      margin-top: 14px;
      font-size: 0.85rem;
      color: #aaa;
      letter-spacing: 1px;
    }
    @keyframes pulse {
      0%, 100% { transform: scale(1); opacity: 1; }
      50%       { transform: scale(1.08); opacity: 0.85; }
    }
    @keyframes loadbar {
      from { width: 0%; }
      to   { width: 100%; }
    }

    /* ── Date & Time Widget ── */
    #datetime-widget {
      position: fixed;
      bottom: 80px;
      left: 18px;
      background: rgba(0, 0, 0, 0.65);
      backdrop-filter: blur(8px);
      color: #fff;
      border-radius: 12px;
      padding: 10px 16px;
      z-index: 9000;
      text-align: center;
      min-width: 130px;
      box-shadow: 0 4px 14px rgba(0,0,0,0.25);
      line-height: 1.3;
    }
    #datetime-widget .dt-time {
      font-size: 1.3rem;
      font-weight: 700;
      color: #f7af1e;
      letter-spacing: 1px;
    }
    #datetime-widget .dt-date {
      font-size: 0.7rem;
      color: #ddd;
      margin-top: 2px;
    }

    @media (max-width: 576px) {
      #datetime-widget {
        bottom: 70px;
        left: 12px;
        padding: 8px 12px;
        min-width: 110px;
      }
      #datetime-widget .dt-time { font-size: 1.1rem; }
      #datetime-widget .dt-date { font-size: 0.65rem; }
    }
  </style>

</head>
<body>

  <audio id="bgMusic" loop>
    <source src="{{ asset('assets/audio/violinbg.mp3') }}" type="audio/mpeg">
  </audio>

  <div id="preloader">
    <img src="{{ asset('assets/logo/logo2.png') }}" alt="PARC Foundation">
    <div class="loading-bar-wrap">
      <div class="loading-bar"></div>
    </div>
    <p>Loading...</p>
  </div>

  <div id="datetime-widget">
    <div class="dt-time" id="dt-time">--:--:--</div>
    <div class="dt-date" id="dt-date">--- --, ----</div>
  </div>

  @include('layouts.navbar')

  @include('layouts.carousel')

  <div class="container parcaralan">
        <h1 class="title partitle">PARCaralan</h1>
        <p class="paragraph parcdetails">
            We harness the power of performing arts to transform the lives of
            underprivileged children & youth through our flagship program.
        </p>
        <button class="cta-button">Learn More</button>
    </div>
  <div class="main-flex">
  <div class="image-container">
    <img src="{{ asset('assets/image/groupphoto.png') }}" alt="Orchestra" class="main-image">
  </div>
  <div class="info-section">
    <h2>Who we serve?</h2>
    <p class="info-title"><b class="emoji">🧑‍🎤Who We Help:</b> Artistically gifted children (ages 7-12) from<br> underserved communities, accepted as scholars.</p>
    <p class="info-title"><b class="emoji">📚What They Receive:</b> Free training in music, dance, and theater, plus<br> school supplies, transportation, and meal allowances.</p>
    <p class="info-title"><b class="emoji">🌱Beyond the Arts:</b> Values formation, character-building, and cultural<br> immersions to nurture ambition and appreciation for the arts.</p>
    <p class="info-title"><b class="emoji">🚀Future-Ready:</b> By age 17, we connect them with top art schools,<br> mentors, and career opportunities—on stage, behind the scenes, or in<br> other fields where they can apply their skills.</p>
  </div>
</div>

<div class="second-section">
<div class="row justify-content-center">
  <div class="col-auto">
    <img src="{{ asset('assets/image/PARC SOG Event-6879 1.png') }}" alt="img1" class="img1">
    <div class="sectitle">
    <p class="p1">STORY</p>
    <p class="p2">Changing the Tune of Tomorrow</p><hr class="divider1">
    <p>We partner with communities to<br> uplift lives and build brighter futures<br> through music and education.</p>
    </div>
  </div>
  <div class="col-auto">
    <img src="{{ asset('assets/image/PARC SOG Event-6879 2.png') }}" alt="img2" class="img2">
    <div class="sectitle">
    <p class="p1">FEATURE</p>
    <p class="p2">Where Impact comes to Life</p><hr class="divider1">
    <p>We partner with communities to<br> uplift lives and build brighter futures<br> through music and education.</p>
    </div>
  </div>
  <div class="col-auto">
    <img src="{{ asset('assets/image/PARC SOG Event-6879 3.png') }}" alt="img3" class="img3">
    <div class="sectitle">
    <p class="p1">EXPLORE</p>
    <p class="p2">Changing Lives, One Note at a Time</p><hr class="divider1">
    <p>We partner with communities to<br> uplift lives and build brighter futures<br> through music and education.</p>
    </div>
  </div>
</div>
</div>
<div class="container-fluid main-tsection">
  <div class="row third-section flex-column flex-md-row">
    <div class="col-md-7 col1 fade-in-right">
      <h1>Beyond the Arts</h1>
      <p class="tpg">We empower underprivileged children and youth through<br>
      PARCaralan, our flagship program blending the performing arts<br> 
      with education and career development.</p>

      <div class="center-btn">
        <a href="{{ url('/donate') }}" class="btn1">Donate now&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<p class="arrow">›</p></a>
        <a href="#" class="btn2">More ways you can help</a>
      </div>
    </div>

    <div class="col-md-5 col2">
      <p class="ttitle"><span class="count-up" data-target="80">0</span>+</p>
      <p class="pbody">Scholars trained and supported</p><hr class="hrtitle">
      <p class="ttitle"><span class="count-up" data-target="30">0</span>+</p>
      <p class="pbody">Community outreach program<br> conducted</p>
    </div>
  </div>
</div>
<style>
  /* Fade-in from right animation */
  .fade-in-right {
    opacity: 0;
    transform: translateX(60px);
    transition: opacity 0.8s ease, transform 0.8s ease;
  }
  .fade-in-right.visible {
    opacity: 1;
    transform: translateX(0);
  }

  /* Fade-in from top animation */
  .fade-in-top {
    opacity: 0;
    transform: translateY(-40px);
    transition: opacity 0.7s ease, transform 0.7s ease;
  }
  .fade-in-top.visible {
    opacity: 1;
    transform: translateY(0);
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {

    /* ── Fade-in from right ── */
    const fadeEls = document.querySelectorAll('.fade-in-right, .fade-in-top');
    const fadeObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          fadeObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.2 });

    fadeEls.forEach(function (el) { fadeObserver.observe(el); });

    /* ── Count-up animation ── */
    function animateCount(el) {
      const target = parseInt(el.getAttribute('data-target'), 10);
      const duration = 1800;
      const step = 16;
      const increment = target / (duration / step);
      let current = 0;

      const timer = setInterval(function () {
        current += increment;
        if (current >= target) {
          current = target;
          clearInterval(timer);
        }
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

  });
</script>

<div class="frsection">
  <img src="{{ asset('assets/image/1 (1) 2.png') }}" alt="img4" class="img4">
  <img src="{{ asset('assets/image/1 (1) 4.png') }}" alt="img5" class="img5">

  <div class="text-overlay">
    <h2>What you need to know about<br> our scholars  ›</h2>
    <p>A flagship scholarship program offering free training<br>
       in music, dance, and theater.</p>
  </div>
</div>
<div class="container-fluid py-5 fifth-section text-center">
  <h2 class="fw-bold mb-2 ft1 fade-in-top">Get Involved</h2>
  <p class="mb-5 ft2 fade-in-top" style="animation-delay:0.2s;">Ways to support the PARC Foundation</p>

  <div class="container">
    <div class="row g-4 justify-content-center">
      <div class="col-md-3 d-flex">
        <div class="card shadow-sm h-100 border-0">
          <div class="card-body">
            <div class="icon-circle mb-3 mx-auto">
              <img src="{{ asset('assets/icons/Heart.png') }}" alt="Adopt a Scholar" class="icon-img">
            </div>
            <h5 class="fw-bold text-orange">Adopt a Scholar</h5>
            <hr class="divider2">
            <p class="mb-0">Support a scholar’s journey as their benefactor</p>
          </div>
        </div>
      </div>

      <div class="col-md-3 d-flex">
        <div class="card shadow-sm h-100 border-0">
          <div class="card-body">
            <div class="icon-circle mb-3 mx-auto">
              <img src="{{ asset('assets/icons/Care.png') }}" alt="Volunteer" class="icon-img">
            </div>
            <h5 class="fw-bold text-orange">Volunteer</h5>
            <hr class="divider2">
            <p class="mb-0">Share your expertise, mentor scholars, or assist in events</p>
          </div>
        </div>
      </div>

      <div class="col-md-3 d-flex">
        <div class="card shadow-sm h-100 border-0">
          <div class="card-body">
            <div class="icon-circle mb-3 mx-auto">
              <img src="{{ asset('assets/icons/Social.png') }}" alt="Be a PARCner" class="icon-img">
            </div>
            <h5 class="fw-bold text-orange">Be a PARCner</h5>
            <hr class="divider2">
            <p class="mb-0">Collaborate through sponsorships or corporate social responsibility initiatives</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  @include('layouts.contacts')

  @include('layouts.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    /* ── Preloader: hide after 5 seconds ── */
    window.addEventListener('load', function () {
      setTimeout(function () {
        var preloader = document.getElementById('preloader');
        preloader.classList.add('hide');
        preloader.addEventListener('transitionend', function () {
          preloader.remove();
        });
      }, 5000);
    });

    /* ── Live Date & Time Widget ── */
    function updateClock() {
      var now  = new Date();
      var h    = String(now.getHours()).padStart(2, '0');
      var m    = String(now.getMinutes()).padStart(2, '0');
      var s    = String(now.getSeconds()).padStart(2, '0');
      var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
      var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
      var dateStr = days[now.getDay()] + ', ' + months[now.getMonth()] + ' ' + now.getDate() + ', ' + now.getFullYear();
      document.getElementById('dt-time').textContent = h + ':' + m + ':' + s;
      document.getElementById('dt-date').textContent = dateStr;
    }
    updateClock();
    setInterval(updateClock, 1000);

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