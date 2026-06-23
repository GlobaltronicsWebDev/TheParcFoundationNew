<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PARC Foundation</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('cssfolder/main.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/mainnavbar.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/contacts.css') }}" />
  <link rel="stylesheet" href="{{ asset('cssfolder/carousel.css') }}" />


</head>
<body>

  <!-- Include Navbar -->
  @include('layouts.navbar')
  
  <!-- Include Carousel -->
  @include('layouts.carousel')

  <!-- PARCaralan starts here -->
    <div class="container parcaralan">
        <h1 class="title partitle">PARCaralan</h1>
        <p class="paragraph parcdetails">
            We harness the power of performing arts to transform the lives of
            underprivileged children & youth through our flagship program.
        </p>
        <button class="cta-button">Learn More</button>
    </div>
  <!-- PARCaralan ends here -->

<div class="main-flex">
  <div class="image-container">
    <img src="assets\image\groupphoto.png" alt="Orchestra" class="main-image">
  </div>
  <div class="info-section">
    <h2>Who we serve?</h2>
    <p class="info-title"><b class="emoji">🧑‍🎤Who We Help:</b> Artistically gifted children (ages 7-12) from<br> underserved communities, accepted as scholars.</p>
    <p class="info-title"><b class="emoji">📚What They Receive:</b> Free training in music, dance, and theater, plus<br> school supplies, transportation, and meal allowances.</p>
    <p class="info-title"><b class="emoji">🌱Beyond the Arts:</b> Values formation, character-building, and cultural<br> immersions to nurture ambition and appreciation for the arts.</p>
    <p class="info-title"><b class="emoji">🚀Future-Ready:</b> By age 17, we connect them with top art schools,<br> mentors, and career opportunities—on stage, behind the scenes, or in<br> other fields where they can apply their skills.</p>
  </div>
</div>

<!-- second section starts here -->
<div class="second-section">
<div class="row justify-content-center">
  <div class="col-auto">
    <img src="assets/image/PARC SOG Event-6879 1.png" alt="img1" class="img1">
    <div class="sectitle">
    <p class="p1">STORY</p>
    <p class="p2">Changing the Tune of Tomorrow</p><hr class="divider1">
    <p>We partner with communities to<br> uplift lives and build brighter futures<br> through music and education.</p>
    </div>
  </div>
  <div class="col-auto">
    <img src="assets/image/PARC SOG Event-6879 2.png" alt="img2" class="img2">
    <div class="sectitle">
    <p class="p1">FEATURE</p>
    <p class="p2">Where Impact comes to Life</p><hr class="divider1">
    <p>We partner with communities to<br> uplift lives and build brighter futures<br> through music and education.</p>
    </div>
  </div>
  <div class="col-auto">
    <img src="assets/image/PARC SOG Event-6879 3.png" alt="img3" class="img3">
    <div class="sectitle">
    <p class="p1">EXPLORE</p>
    <p class="p2">Changing Lives, One Note at a Time</p><hr class="divider1">
    <p>We partner with communities to<br> uplift lives and build brighter futures<br> through music and education.</p>
    </div>
  </div>
</div>
</div>

<!-- second section ends here -->

<!-- third section starts here -->
<div class="container-fluid main-tsection">
  <div class="row third-section flex-column flex-md-row">
    <div class="col-md-7 col1">
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
      <p class="ttitle">80+</p>
      <p class="pbody">Scholars trained and supported</p><hr class="hrtitle">
      <p class="ttitle">30+</p>
      <p class="pbody">Community outreach program<br> conducted</p>
    </div>
  </div>
</div>
<!-- third section ends here -->

<!-- fourth section starts here -->
<div class="frsection">
  <img src="assets/image/1 (1) 2.png" alt="img4" class="img4">
  <img src="assets/image/1 (1) 4.png" alt="img5" class="img5">

  <!-- Orange Text Box -->
  <div class="text-overlay">
    <h2>What you need to know about<br> our scholars  ›</h2>
    <p>A flagship scholarship program offering free training<br>
       in music, dance, and theater.</p>
  </div>
</div>
<!-- fourth section ends here -->

<!-- fifth section starts here -->
<div class="container-fluid py-5 fifth-section text-center">
  <h2 class="fw-bold mb-2 ft1">Get Involved</h2>
  <p class="mb-5 ft2">Ways to support the PARC Foundation</p>

  <div class="container">
    <div class="row g-4 justify-content-center">
      <!-- Card 1 -->
      <div class="col-md-3 d-flex">
        <div class="card shadow-sm h-100 border-0">
          <div class="card-body">
            <div class="icon-circle mb-3 mx-auto">
              <img src="assets/icons/Heart.png" alt="Adopt a Scholar" class="icon-img">
            </div>
            <h5 class="fw-bold text-orange">Adopt a Scholar</h5>
            <hr class="divider2">
            <p class="mb-0">Support a scholar’s journey as their benefactor</p>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-3 d-flex">
        <div class="card shadow-sm h-100 border-0">
          <div class="card-body">
            <div class="icon-circle mb-3 mx-auto">
              <img src="assets/icons/Care.png" alt="Volunteer" class="icon-img">
            </div>
            <h5 class="fw-bold text-orange">Volunteer</h5>
            <hr class="divider2">
            <p class="mb-0">Share your expertise, mentor scholars, or assist in events</p>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-3 d-flex">
        <div class="card shadow-sm h-100 border-0">
          <div class="card-body">
            <div class="icon-circle mb-3 mx-auto">
              <img src="assets/icons/Social.png" alt="Be a PARCner" class="icon-img">
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

  <!-- Include Navbar -->
  @include('layouts.contacts')

    <!-- Include Footer -->
  @include('layouts.footer')

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
