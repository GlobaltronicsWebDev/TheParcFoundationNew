<div class="wholenavbar">
<!-- Top Bar -->
  <div class="top-bar">
    <div class="w-100 d-flex align-items-center justify-content-center" id="topbar">
      <div class="contactlink"> +639 17623 2840 |  program.director@foundation.com.ph</div>
    </div>
  </div>

  <!-- Logo  -->
   <a href="{{ url('/welcome') }}">
            <img class="logo" src="./assets/logo/logo2.png" alt="" />
   </a>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container-fluid">
    <img class="logo1" src="./assets/logo/logo2.png" alt="Logo">

      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menu -->
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item {{ request()->is('welcome') || request()->is('/') ? 'active' : '' }}"><a href="{{ url('/welcome') }}" class="nav-link">Home</a></li>
          <li class="nav-item {{ request()->is('about') ? 'active' : '' }}"><a href="{{ url('/about') }}" class="nav-link">About</a></li>
          <li class="nav-item {{ request()->is('events*') ? 'active' : '' }}"><a href="{{ url('/events') }}" class="nav-link">Events</a></li>
          <li class="nav-item {{ request()->is('news*') ? 'active' : '' }}"><a href="{{ url('/news') }}" class="nav-link">News</a></li>
          <li class="nav-item {{ request()->is('contacts*') || request()->is('contact*') ? 'active' : '' }}"><a href="{{ url('/contacts') }}" class="nav-link">Contact</a></li>
          <li class="nav-item d-lg-none text-center my-2">
            <button id="theme-toggle-mobile" class="btn btn-outline-warning btn-sm px-3 rounded-pill" type="button">
              <i class="bi bi-moon-stars-fill" id="theme-toggle-mobile-icon"></i> Switch Theme
            </button>
          </li>
        </ul>
      </div>

      <!-- Social Icons & Theme Toggle -->
      <div class="social-icons d-none d-lg-flex align-items-center me-3">
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
        <button id="theme-toggle" class="btn btn-theme-toggle ms-2" title="Toggle Dark/Light Mode" type="button">
          <i class="bi bi-moon-stars-fill" id="theme-toggle-icon"></i>
        </button>
      </div>
    </div>
  </nav>

  
      <div class="mainbuttons">
        <a href="{{ url('/donate') }}" class="btn btn-donate px-3" target="_blank">DONATE</a>
        <a href="{{ url('/adopt') }}" class="btn btn-adopt px-3" target="_blank">ADOPT A SCHOLAR</a>
      </div>

</div>

<!-- 🎈 Floating Messenger-style Theme Toggle Button (Left Side, Desktop & Mobile) -->
<button id="theme-toggle-floating" class="floating-theme-toggle" title="Toggle Dark/Light Mode" aria-label="Toggle Theme" type="button">
  <i class="bi bi-moon-stars-fill" id="theme-toggle-floating-icon"></i>
</button>

<!-- Theme Toggle Script -->
<script>
  (function () {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
      document.documentElement.classList.add('dark-theme');
      document.body.classList.add('dark-theme');
    }
  })();

  document.addEventListener('DOMContentLoaded', function () {
    const toggleBtnHeader = document.getElementById('theme-toggle');
    const toggleIconHeader = document.getElementById('theme-toggle-icon');
    const toggleBtnFloat = document.getElementById('theme-toggle-floating');
    const toggleIconFloat = document.getElementById('theme-toggle-floating-icon');
    const toggleBtnMobile = document.getElementById('theme-toggle-mobile');
    const toggleIconMobile = document.getElementById('theme-toggle-mobile-icon');

    const updateIcons = (isDark) => {
      const iconClass = isDark ? 'bi bi-sun-fill' : 'bi bi-moon-stars-fill';
      if (toggleIconHeader) toggleIconHeader.className = iconClass;
      if (toggleIconFloat) toggleIconFloat.className = iconClass;
      if (toggleIconMobile) toggleIconMobile.className = iconClass;
    };

    if (document.body.classList.contains('dark-theme')) {
      updateIcons(true);
    }

    const toggleTheme = () => {
      const isDark = document.body.classList.toggle('dark-theme');
      document.documentElement.classList.toggle('dark-theme', isDark);
      localStorage.setItem('theme', isDark ? 'dark' : 'light');
      updateIcons(isDark);
    };

    if (toggleBtnHeader) toggleBtnHeader.addEventListener('click', toggleTheme);
    if (toggleBtnFloat) toggleBtnFloat.addEventListener('click', toggleTheme);
    if (toggleBtnMobile) toggleBtnMobile.addEventListener('click', toggleTheme);
  });
</script>