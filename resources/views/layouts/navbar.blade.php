<div class="wholenavbar">
<!-- Top Bar -->
  <div class="top-bar">
    <div class="w-100 d-flex align-items-center justify-content-center" id="topbar">
      <div class="contactlink">(02) 8350 6350  |  program.director@foundation.com.ph</div>
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
          <li class="nav-item active"><a href="{{ url('/welcome') }}" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link">About</a></li>
          <li class="nav-item"><a href="{{ url('/parcform') }}" class="nav-link">Causes</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Pages</a></li> 
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
        <a href="{{ url('/donate') }}" class="btn btn-donate px-3">DONATE</a>
        <a href="{{ url('/adopt') }}" class="btn btn-adopt px-3">ADOPT A SCHOLAR</a>
      </div>

</div>