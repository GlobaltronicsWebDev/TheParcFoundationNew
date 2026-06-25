<!-- ── Page Loader ── -->
<div id="page-loader">
  <div class="loader-inner">
    <img src="{{ asset('assets/logo/parclogosquare.png') }}" alt="PARC Foundation" class="loader-logo">
    <div class="loader-spinner"></div>
  </div>
</div>

<style>
  #page-loader {
    position: fixed;
    inset: 0;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 99999;
    transition: opacity 0.5s ease, visibility 0.5s ease;
  }

  #page-loader.hidden {
    opacity: 0;
    visibility: hidden;
  }

  .loader-inner {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
  }

  .loader-logo {
    width: 90px;
    height: 90px;
    object-fit: contain;
    animation: loader-pulse 1.2s ease-in-out infinite;
  }

  @keyframes loader-pulse {
    0%, 100% { transform: scale(1);   opacity: 1; }
    50%       { transform: scale(0.9); opacity: 0.7; }
  }

  .loader-spinner {
    width: 36px;
    height: 36px;
    border: 4px solid #f0e0d0;
    border-top-color: #f78f1e;
    border-radius: 50%;
    animation: loader-spin 0.75s linear infinite;
  }

  @keyframes loader-spin {
    to { transform: rotate(360deg); }
  }
</style>

<script>
  window.addEventListener('load', function () {
    var loader = document.getElementById('page-loader');
    loader.classList.add('hidden');
    setTimeout(function () { loader.style.display = 'none'; }, 500);
  });
</script>

<div class="wholenavbar">
<!-- Top Bar -->
  <div class="top-bar">
    <div class="w-100 d-flex align-items-center justify-content-center" id="topbar">
      <div class="contactlink">(02) 8350 6350  |  program.director@foundation.com.ph</div>
      <div class="topbar-datetime" id="topbar-datetime"></div>
    </div>
  </div>

  <!-- Logo  -->
   <a href="{{ url('/welcome') }}">
            <img class="logo" src="{{ asset('assets/logo/logo2.png') }}" alt="" />
   </a>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container-fluid">
    <img class="logo1" src="{{ asset('assets/logo/logo2.png') }}" alt="Logo">

      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menu -->
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item active"><a href="{{ url('/welcome') }}" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="{{ url('/about') }}" class="nav-link">About</a></li>
          <li class="nav-item"><a href="{{ url('/events') }}" class="nav-link">Events</a></li> 
          <li class="nav-item"><a href="{{ url('/news') }}" class="nav-link">News</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
        </ul>
      </div>

      <!-- Social Icons -->
      <div class="social-icons d-none d-lg-block me-3">
      <a href="https://www.facebook.com/parcph" class="text-decoration-none">
        <i class="bi bi-facebook"></i>
      </a>
      <a href="https://www.linkedin.com/company/globaltronicsphl/" class="text-decoration-none">
        <i class="bi bi-linkedin"></i>
      </a>
      <a href="https://www.youtube.com/@ThePARCFoundation" class="text-decoration-none">
        <i class="bi bi-youtube"></i>
      </a>
      <a href="https://www.instagram.com/theparcfoundation.ph?igsh=N3dteGZ5c242NnEz" class="text-decoration-none">
        <i class="bi bi-instagram"></i>
      </a>
      </div>
    </div>
  </nav>

  
      <div class="d-none d-md-flex mainbuttons">
        <a href="{{ url('/donate') }}" class="btn btn-donate px-3" target="_blank" rel="noopener noreferrer">DONATE</a>
        <a href="{{ url('/adopt') }}" class="btn btn-adopt px-3" target="_blank" rel="noopener noreferrer">ADOPT A SCHOLAR</a>
      </div>

</div>

<style>
  .topbar-datetime {
    font-size: 0.78rem;
    color: #fff;
    margin-left: 24px;
    letter-spacing: 0.03em;
    white-space: nowrap;
    opacity: 0.9;
  }
</style>

<script>
  (function () {
    function updateClock() {
      var el = document.getElementById('topbar-datetime');
      if (!el) return;
      var now = new Date();
      var days   = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
      var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
      var day    = days[now.getDay()];
      var date   = now.getDate();
      var month  = months[now.getMonth()];
      var year   = now.getFullYear();
      var h      = now.getHours();
      var m      = String(now.getMinutes()).padStart(2, '0');
      var s      = String(now.getSeconds()).padStart(2, '0');
      var ampm   = h >= 12 ? 'PM' : 'AM';
      h = h % 12 || 12;
      el.textContent = day + ', ' + month + ' ' + date + ', ' + year + '  |  ' + h + ':' + m + ':' + s + ' ' + ampm;
    }
    updateClock();
    setInterval(updateClock, 1000);
  })();
</script>