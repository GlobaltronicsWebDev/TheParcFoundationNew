<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>Contact Us — PARC Foundation</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/logo/parclogosquare.png') }}">

  <!-- Bootstrap 5 & Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('cssfolder/mainnavbar.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/contacts.css?v=2') }}" />
  <link rel="stylesheet" href="{{ asset('cssfolder/contactspage.css') }}" />
</head>
<body>

  <!-- Navbar -->
  @include('layouts.navbar')

  <div class="contact-page-spacer"></div>

  <!-- ── Hero Banner Section ── -->
  <section class="contact-hero">
    <div class="container">
      <h1 class="contact-hero-heading">Contact <span>Us</span></h1>
      <p class="contact-hero-sub">
        Have a question, want to volunteer, or interested in becoming a PARCner? Reach out to us — we would love to connect with you!
      </p>
    </div>
  </section>

  <!-- ── Contact Cards Section ── -->
  <section class="contact-cards-section">
    <div class="container">
      <div class="row g-4">
        <!-- Card 1: Visit Us -->
        <div class="col-md-6 col-lg-3">
          <div class="contact-card">
            <div class="contact-icon-wrapper">
              <i class="bi bi-geo-alt-fill"></i>
            </div>
            <h4>Visit Us</h4>
            <p>494 Lt. Artiaga St., Cor. F. Manalo St., San Juan, Metro Manila, Philippines</p>
          </div>
        </div>

        <!-- Card 2: Call Us -->
        <div class="col-md-6 col-lg-3">
          <div class="contact-card">
            <div class="contact-icon-wrapper">
              <i class="bi bi-telephone-fill"></i>
            </div>
            <h4>Call Us</h4>
            <a href="tel:+639176232840">+63 917 623 2840</a>
            <a href="tel:+63283506356">(02) 8350 6356</a>
          </div>
        </div>

        <!-- Card 3: Email Us -->
        <div class="col-md-6 col-lg-3">
          <div class="contact-card">
            <div class="contact-icon-wrapper">
              <i class="bi bi-envelope-fill"></i>
            </div>
            <h4>Email Us</h4>
            <a href="mailto:program.director@foundation.com.ph">program.director@foundation.com.ph</a>
            <a href="mailto:info@theparcfoundation.ph">info@theparcfoundation.ph</a>
          </div>
        </div>

        <!-- Card 4: Office Hours -->
        <div class="col-md-6 col-lg-3">
          <div class="contact-card">
            <div class="contact-icon-wrapper">
              <i class="bi bi-clock-fill"></i>
            </div>
            <h4>Office Hours</h4>
            <p>Monday – Saturday</p>
            <p>9:00 AM – 6:00 PM</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ── Main Contact Form & Map Section ── -->
  <section class="contact-main-section">
    <div class="container">
      <div class="row g-4">
        
        <!-- Left: Detailed Contact Form -->
        <div class="col-lg-7">
          <div class="contact-form-wrapper">
            <h3 class="contact-form-title">Send Us A Message</h3>

            @if(session('contact_success'))
              <div class="contact-alert-success">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('contact_success') }}
              </div>
            @endif

            @if(session('contact_error'))
              <div class="contact-alert-error">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('contact_error') }}
              </div>
            @endif

            <form action="{{ route('contacts.send') }}" method="POST">
              @csrf

              <div class="row g-3">
                <div class="col-md-6">
                  <div class="contact-form-group">
                    <label for="first_name">First Name <span class="req">*required</span></label>
                    <input type="text" id="first_name" name="first_name" class="contact-input" value="{{ old('first_name') }}" required placeholder="Enter your first name">
                    @error('first_name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="contact-form-group">
                    <label for="last_name">Last Name <span class="req">*required</span></label>
                    <input type="text" id="last_name" name="last_name" class="contact-input" value="{{ old('last_name') }}" required placeholder="Enter your last name">
                    @error('last_name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                  </div>
                </div>
              </div>

              <div class="row g-3">
                <div class="col-md-6">
                  <div class="contact-form-group">
                    <label for="email">Email Address <span class="req">*required</span></label>
                    <input type="email" id="email" name="email" class="contact-input" value="{{ old('email') }}" required placeholder="your.email@example.com">
                    @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="contact-form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" class="contact-input" value="{{ old('phone') }}" placeholder="+63 912 345 6789">
                    @error('phone')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                  </div>
                </div>
              </div>

              <div class="contact-form-group">
                <label for="subject">Subject / Inquiry Type <span class="req">*required</span></label>
                <select id="subject" name="subject" class="contact-input" required>
                  <option value="" disabled selected>Select an inquiry type</option>
                  <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                  <option value="Volunteer Opportunities" {{ old('subject') == 'Volunteer Opportunities' ? 'selected' : '' }}>Volunteer Opportunities</option>
                  <option value="Partnerships & PARCners" {{ old('subject') == 'Partnerships & PARCners' ? 'selected' : '' }}>Partnerships & PARCners</option>
                  <option value="Adopt-a-Scholar Inquiry" {{ old('subject') == 'Adopt-a-Scholar Inquiry' ? 'selected' : '' }}>Adopt-a-Scholar Inquiry</option>
                  <option value="Donation Question" {{ old('subject') == 'Donation Question' ? 'selected' : '' }}>Donation Question</option>
                  <option value="Media & Press" {{ old('subject') == 'Media & Press' ? 'selected' : '' }}>Media & Press</option>
                  <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('subject')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
              </div>

              <div class="contact-form-group">
                <label for="message">Your Message <span class="req">*required</span></label>
                <textarea id="message" name="message" class="contact-input" rows="5" required placeholder="How can we help you? Write your message here...">{{ old('message') }}</textarea>
                @error('message')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
              </div>

              <!-- <div class="contact-form-group">
                <label>I would like to receive email updates from PARC Foundation:</label>
                <div class="contact-radio-group">
                  <label class="contact-radio-label">
                    <input type="radio" name="email_updates" value="yes" checked> Yes
                  </label>
                  <label class="contact-radio-label">
                    <input type="radio" name="email_updates" value="no"> No
                  </label>
                </div>
              </div>

              <div class="contact-form-group">
                <label>I would like to receive text message updates:</label>
                <div class="contact-radio-group">
                  <label class="contact-radio-label">
                    <input type="radio" name="text_updates" value="yes"> Yes
                  </label>
                  <label class="contact-radio-label">
                    <input type="radio" name="text_updates" value="no" checked> No
                  </label>
                </div>
              </div> -->

              <button type="submit" class="btn-send-message mt-3">
                <i class="bi bi-send-fill me-2"></i> Send Message
              </button>
            </form>

          </div>
        </div>

        <!-- Right: Map Embed & Social Connect -->
        <div class="col-lg-5">
          <div class="contact-side-wrapper">
            
            <!-- Map Card -->
            <div class="map-card">
              <div class="map-card-header">
                <h4><i class="bi bi-map-fill me-2"></i> Our Location</h4>
              </div>
              <iframe 
                class="map-container"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.026367586616!2d121.0315!3d14.6001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c82e6d9b4b07%3A0x8e833633633633!2sSan%20Juan%2C%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1680000000000!5m2!1sen!2sph" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"
                title="PARC Foundation Location Map">
              </iframe>
            </div>

            <!-- Social Media Card -->
            <div class="social-connect-card">
              <h4>Connect With Us</h4>
              <p class="text-muted small mb-3" style="color: #b5b5b5 !important;">Follow our journey on social media and stay involved in empowering youth through music.</p>
              <div class="social-buttons-grid">
                <a href="https://www.facebook.com/parcph" target="_blank" class="social-btn" title="Facebook">
                  <i class="bi bi-facebook"></i>
                </a>
                <a href="https://www.linkedin.com/company/globaltronicsphl/" target="_blank" class="social-btn" title="LinkedIn">
                  <i class="bi bi-linkedin"></i>
                </a>
                <a href="https://www.youtube.com/@ThePARCFoundation" target="_blank" class="social-btn" title="YouTube">
                  <i class="bi bi-youtube"></i>
                </a>
                <a href="https://www.instagram.com/theparcfoundation.ph?igsh=N3dteGZ5c242NnEz" target="_blank" class="social-btn" title="Instagram">
                  <i class="bi bi-instagram"></i>
                </a>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Newsletter & Footer Includes -->
  @include('layouts.contacts')
  @include('layouts.footer')

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
