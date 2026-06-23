<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PARC Foundation</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('cssfolder/mainnavbar.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/news.css') }}" />

  
</head>
<body>
  <!-- Include Navbar -->
  @include('layouts.navbar')

<!-- Latest News Section -->
<section class="latest-news-section">
  <div class="container text-center">
    <!-- Section Header -->
    <div class="news-header text-center">
      <h2 class="fw-bold">
        Latest <span class="highlight">News</span>
      </h2>
      <p class="subtitle">latest posts</p>
    </div>


    <!-- News Card -->
    <div class="news-card shadow-sm">
      <div class="row align-items-center g-0">
        <!-- Image -->
        <div class="col-md-5 news-image">
          <img src="{{ asset('./assets/image/WTG2.webp') }}" 
               alt="Globaltronics Award" 
               class="img-fluid rounded-start">
        </div>

        <!-- Content -->
        <div class="col-md-7 p-4 text-start">
          <h4 class="fw-bold text-highlight mb-3">
            Chairman and CEO of Globaltronics was awarded the KDR Icon of Music and
            Philanthropy during the 9th WISH Music Awards.
          </h4>

          <p class="date mb-2">January 14, 2024</p>

          <p class="text-dark mb-2">
            Mr. William Guido, the Chairman and CEO of Globaltronics, was awarded the
            KDR Icon of Music and Philanthropy during the 9th WISH Music Awards.
          </p>

          <p class="text-dark mb-4">
            The 9th Wish Music Awards happened on January 14, 2024 at the Araneta Coliseum.
          </p>

          <a href="#" class="btn btn-learn">LEARN MORE</a>
        </div>
      </div>




      
    </div>

    <!--add the new 9 cards section here-->
<div class="section-container">
    <div class="card">
        <div class="card-image">
            <img src="{{ asset('./assets/image/card1.webp') }}">
        </div>
        <div class="card-content">
            <h3>Corey Koh - A Night of Melodies</h3>
            <p>Get ready for an enchanting evening as Corey Koh brings his incredible voice to the stage at the upcoming "A Night of Melodies" concert on 15th February 2025.</p>
            <span class="event-date">February 15, 2025</span>
        </div>
    </div>
    <div class="card">
        <div class="card-image">
            <img src="{{ asset('./assets/image/card2.webp') }}">
        </div>
        <div class="card-content">
            <h3>Corey Koh's Latest Release - "Heartstrings"</h3>
            <p>Corey Koh has just released his newest single, "Heartstrings". Available for streaming on all platforms. Don't miss out on this soulful track!</p>
            <span class="release-date">January 30, 2025</span>
        </div>
    </div>
    <div class="card">
        <div class="card-image">
            <img src="{{ asset('./assets/image/card3.webp') }}">
        </div>
        <div class="card-content">
            <h3>Corey Koh: Spreading Joy at the Community Event</h3>
            <p>Join Corey Koh as he spreads warmth and joy with his music at the annual community charity event. This is a wonderful opportunity to give back and enjoy his live performance!</p>
            <span class="event-date">December 20, 2024</span>
        </div>
    </div>
</div>
  </div>
</section>





  <!-- Include Footer -->
  @include('layouts.footer')

  <!-- JS -->
  <script src="{{ asset('jsfolder/packages.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>