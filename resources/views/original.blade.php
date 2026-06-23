<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>The Parc Foundation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('cssfolder/original.css') }}">
</head>
<body> 
    <header class="main-header">
        <div class="header-content">
            <p>(02) 8350 6350 | program.director@foundation.com.ph</p>
        </div>
        <button class="adbot"><a href="">DONATE</a></button>
        <button class="adbot2"><a href="">ADOPT A SCHOLAR</a></button>
    </header>

    <nav class="main-nav">
            <img class="logo" src="./assets/logo/logo2.png" alt="" />
        <ul class="nav-menu">
            <li class="nav-item"><a href="#" class="nav-link active">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link">About</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Causes</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Pages</a></li>
            <li class="nav-item"><a href="#" class="nav-link">News</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
        </ul>
        <div class="social-icons">
            <i class="bi bi-facebook"></i>
            <i class="bi bi-linkedin"></i>
            <i class="bi bi-youtube"></i>
            <i class="bi bi-instagram"></i>
        </div>
    </nav>
    <!-- header ends -->
     
    <!-- carousel -->
    <div class="container-fluid">
        <div class="carousel-container">
            <div class="carousel-wrapper">
                <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                    <!-- Slides -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./assets/slider/Property 1=1.png" class="d-block w-100" alt="Mountain">
                        </div>
                        <div class="carousel-item">
                            <img src="./assets/slider/Property 1=2.png" class="d-block w-100" alt="Ocean">
                        </div>
                        <div class="carousel-item">
                            <img src="./assets/slider/Property 1=3.png" class="d-block w-100" alt="Forest">
                        </div>
                    </div>

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>

                    <!-- Indicators -->
                    <!-- <div class="carousel-indicators">
                        <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- carousel ends here -->
    <div class="container">
        <h1 class="title">PARCaralan</h1>
        <p class="paragraph">
            We harness the power of performing arts to transform the lives of 
            underprivileged children & youth through our flagship program.
        </p>
        <button class="cta-button">Learn More</button>
    </div>



    
<div class="main-flex">
  <div class="image-container">
    <img src="assets\image\PARC SOG Event-1896 1.png" alt="Orchestra" class="main-image">
    <img src="assets\image\sing.png" alt="Singers" class="small-image">
  </div>
  <div class="info-section">
    <h2>Who we serve?</h2>
    <ul>
      <li><span class="emoji">🧑‍🎤</span> <span class="info-title">Who We Help:</span> Artistically gifted children (ages 7-12) from underserved communities, accepted as scholars.</li>
      <li><span class="emoji">📚</span> <span class="info-title">What They Receive:</span> Free training in music, dance, and theater, plus school supplies, transportation, and meal allowances.</li>
      <li><span class="emoji">🌱</span> <span class="info-title">Beyond the Arts:</span> Values formation, character-building, and cultural immersions to nurture ambition and appreciation for the arts.</li>
      <li><span class="emoji">🚀</span> <span class="info-title">Future-Ready:</span> By age 17, we connect them with top art schools, mentors, and career opportunities—on stage, behind the scenes, or in other fields where they can apply their skills.</li>
    </ul>
  </div>
</div>
    <script src="{{ asset('jsfolder/main.js') }}"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>
</html>
