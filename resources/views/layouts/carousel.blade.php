  <!-- carousel -->
  <div class="container-fluid">
    <div class="carousel-container">
      <div class="carousel-wrapper">
        <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
          
          <!-- Slides -->
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="{{ asset('assets/slider/slider1.png') }}" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
              <img src="{{ asset('assets/slider/slider2.png') }}" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item carousel-item-video">
              <video
                id="carousel-video"
                class="d-block w-100"
                muted
                playsinline
                preload="metadata">
                <source src="{{ asset('assets/slider/videoslider1main.mp4') }}" type="video/mp4">
              </video>
            </div>
          </div>

<!-- Carousel Indicators -->
<div class="carousel-indicators">
  <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
  <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
  <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
</div>

          <!-- Custom Controls -->
          <button class="carousel-control custom-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
            <span class="circle-btn"><i class="bi bi-arrow-left"></i></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control custom-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
            <span class="circle-btn"><i class="bi bi-arrow-right"></i></span>
            <span class="visually-hidden">Next</span>
          </button>

        </div>
      </div>
    </div>
  </div>

  <script>
    (function () {
      var carouselEl = document.getElementById('imageCarousel');
      var video      = document.getElementById('carousel-video');
      var bsCarousel = bootstrap.Carousel.getOrCreateInstance(carouselEl);

      /* When a slide finishes transitioning in, check if it's the video slide */
      carouselEl.addEventListener('slid.bs.carousel', function (e) {
        if (e.relatedTarget.classList.contains('carousel-item-video')) {
          bsCarousel.pause();          /* stop auto-advance */
          video.currentTime = 0;
          video.play();
        } else {
          video.pause();
          video.currentTime = 0;
        }
      });

      /* When the video ends, move to the next slide and resume cycling */
      video.addEventListener('ended', function () {
        bsCarousel.next();
        bsCarousel.cycle();
      });
    })();
  </script>
  <!-- carousel ends here -->
