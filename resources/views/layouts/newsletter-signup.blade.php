<section class="newsletter-signup">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-6">

        <h2 class="newsletter-heading">CONTACT US</h2>

        @if(session('contact_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('contact_success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('contact_error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('contact_error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <form id="contactForm" action="{{ route('contacts.send') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label class="form-label">First Name <span class="text-danger">*required</span></label>
            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required placeholder="First Name">
            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Last Name <span class="text-danger">*required</span></label>
            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required placeholder="Last Name">
            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Email Address <span class="text-danger">*required</span></label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="Email Address">
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Subject / Inquiry Type <span class="text-danger">*required</span></label>
            <select name="subject" class="form-select @error('subject') is-invalid @enderror" required>
              <option value="" disabled selected>Select an inquiry type</option>
              <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
              <option value="Volunteer Opportunities" {{ old('subject') == 'Volunteer Opportunities' ? 'selected' : '' }}>Volunteer Opportunities</option>
              <option value="Partnerships & PARCners" {{ old('subject') == 'Partnerships & PARCners' ? 'selected' : '' }}>Partnerships & PARCners</option>
              <option value="Adopt-a-Scholar Inquiry" {{ old('subject') == 'Adopt-a-Scholar Inquiry' ? 'selected' : '' }}>Adopt-a-Scholar Inquiry</option>
              <option value="Donation Question" {{ old('subject') == 'Donation Question' ? 'selected' : '' }}>Donation Question</option>
              <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Your Message <span class="text-danger">*required</span></label>
            <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="4" required placeholder="Write your message here...">{{ old('message') }}</textarea>
            @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <p class="newsletter-privacy text-muted small">
            We will keep your information safe and secure. Please see our <a href="#" class="text-decoration-none">Privacy Policy</a> for details of how we use your information.
          </p>

          <button type="submit" class="btn btn-newsletter w-100">Send Message</button>
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
  .form-label {
    color: #ddd;
    font-weight: 500;
  }
  .form-control, .form-select {
    background: #fff;
    border: 1px solid #555;
    color: #222;
  }
  .form-control:focus, .form-select:focus {
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
  .newsletter-privacy a {
    color: #f7af1e;
  }
</style>

@if(session('contact_success'))
<script>
  document.addEventListener("DOMContentLoaded", function() {
      const form = document.getElementById('contactForm');
      if (form) {
          form.reset(); 
      }
  });
</script>
@endif