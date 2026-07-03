<section class="newsletter-signup">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-6">

        <h2 class="newsletter-heading">GET THE LATEST UPDATES</h2>

        @if(session('newsletter_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('newsletter_success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('newsletter_error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('newsletter_error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <form id="newsletterForm" action="{{ route('newsletter.subscribe') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label class="form-label">First Name <span class="text-danger">*required</span></label>
            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Last Name <span class="text-danger">*required</span></label>
            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Email Address <span class="text-danger">*required</span></label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <h5 class="newsletter-subheading mt-4">BE A PART OF OUR COMMUNITY</h5>
          <p class="newsletter-description">
            Stay updated on how you can help empower youth through music. From inspiring stories to events and ways to give - we'll keep you in the loop. You can unsubscribe at any time.
          </p>

          <div class="mb-3">
            <label class="form-label d-block">I would like to get email updates:</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="email_updates" value="yes" id="email-yes" checked>
              <label class="form-check-label" for="email-yes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="email_updates" value="no" id="email-no">
              <label class="form-check-label" for="email-no">No</label>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label d-block">I would like to get PARC text messages:</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="text_updates" value="yes" id="text-yes">
              <label class="form-check-label" for="text-yes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="text_updates" value="no" id="text-no" checked>
              <label class="form-check-label" for="text-no">No</label>
            </div>
          </div>

          <p class="newsletter-privacy text-muted small">
            We will keep your information safe and secure. Please see our <a href="#" class="text-decoration-none">Privacy Policy</a> for details of how we use your information.
          </p>

          <p class="newsletter-recaptcha text-muted small">
            This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy" class="text-decoration-none" target="_blank">Privacy Policy</a> and <a href="https://policies.google.com/terms" class="text-decoration-none" target="_blank">Terms of Service</a> apply.
          </p>

          <button type="submit" class="btn btn-newsletter w-100">Sign Up</button>
        </form>

      </div>
    </div>
  </div>
</section>

<style>
  .newsletter-signup {
    background: #2b2b2b;
    color: #ddd;
  }
  .newsletter-heading {
    color: #f7af1e;
    font-weight: bold;
    font-size: 1.6rem;
    margin-bottom: 20px;
  }
  .newsletter-subheading {
    color: #f7af1e;
    font-weight: 600;
    font-size: 1.2rem;
  }
  .newsletter-description {
    color: #ccc;
    line-height: 1.6;
  }
  .form-label {
    color: #ddd;
    font-weight: 500;
  }
  .form-control {
    background: #fff;
    border: 1px solid #555;
    color: #222;
  }
  .form-control:focus {
    border-color: #f7af1e;
    box-shadow: 0 0 0 0.2rem rgba(247, 175, 30, 0.25);
  }
  .btn-newsletter {
    background: #f7af1e;
    color: #fff;
    font-weight: bold;
    padding: 12px;
    border-radius: 6px;
    border: none;
    transition: all 0.3s ease;
  }
  .btn-newsletter:hover {
    background: #d88e04;
    color: #fff;
  }
  .newsletter-privacy a,
  .newsletter-recaptcha a {
    color: #f7af1e;
  }
  .form-check-input:checked {
    background-color: #f7af1e;
    border-color: #f7af1e;
  }
</style>

@if(session('newsletter_success'))
<script>
  document.addEventListener("DOMContentLoaded", function() {
      const form = document.getElementById('newsletterForm');
      if (form) {
          form.reset(); 
      }
  });
</script>
@endif