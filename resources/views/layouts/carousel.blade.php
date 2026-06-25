  <!-- carousel -->
  <div class="container-fluid">
    <div class="carousel-container">
      <div class="carousel-wrapper">
        <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
          
          <!-- Slides -->
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="{{ asset('assets/slider/Property 2=1.png.png') }}" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
              <img src="{{ asset('assets/slider/Property 2=2.png.png') }}" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
              <img src="{{ asset('assets/slider/Property2=3.png.png') }}" class="d-block w-100" alt="Slide 3">
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
  <!-- carousel ends here -->
