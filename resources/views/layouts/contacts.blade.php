  <footer class="footercon">
    <div class="footer-container">
      <!-- Left Links Section -->
      <div class="footer-links">
        <div class="footer-column">
          <h4>SUPPORT</h4>
          <ul>
            <li><a href="{{ url('/donate') }}">Donate now</a></li>
            <li><a href="{{ url('/adopt') }}">Adopt a Scholar</a></li>
            <li><a href="#">Volunteer</a></li>
            <li><a href="#">Be a PARCner</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h4>CONNECT</h4>
          <ul>
            <li><a href="#">Take action</a></li>
            <li><a href="#get-involved">Get involved</a></li>
            <li><a href="#">Careers</a></li>
            <li><a href="{{ url('/contacts') }}">Contact</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h4>DISCOVER</h4>
          <ul>
            <li><a href="#">Who we are</a></li>
            <li><a href="#">Latest stories</a></li>
            <li><a href="#">Our work</a></li>
            <li><a href="#">Newsroom</a></li>
          </ul>
        </div>
      </div>

      <!-- Right Sign-up Form -->
      <div class="footer-form">
        <h4 class="highlight">GET THE LATEST UPDATES</h4>

        @if(session('newsletter_success'))
        <div style="background:#2e7d32;color:#fff;padding:10px 14px;border-radius:6px;margin-bottom:12px;font-size:0.9rem;">
          {{ session('newsletter_success') }}
        </div>
        @endif

        @if(session('newsletter_error'))
        <div style="background:#c62828;color:#fff;padding:10px 14px;border-radius:6px;margin-bottom:12px;font-size:0.9rem;">
          {{ session('newsletter_error') }}
        </div>
        @endif

        <form action="{{ route('newsletter.subscribe') }}" method="POST">
          @csrf
          <label>First Name <span class="required">*required</span></label>
          <input type="text" name="first_name" value="{{ old('first_name') }}" required>
          @error('first_name')<p style="color:#f7af1e;font-size:0.8rem;margin:2px 0 6px;">{{ $message }}</p>@enderror

          <label>Last Name <span class="required">*required</span></label>
          <input type="text" name="last_name" value="{{ old('last_name') }}" required>
          @error('last_name')<p style="color:#f7af1e;font-size:0.8rem;margin:2px 0 6px;">{{ $message }}</p>@enderror

          <label>Email Address <span class="required">*required</span></label>
          <input type="email" name="email" value="{{ old('email') }}" required>
          @error('email')<p style="color:#f7af1e;font-size:0.8rem;margin:2px 0 6px;">{{ $message }}</p>@enderror

          <h4 class="highlight">BE A PART OF OUR COMMUNITY</h4>
          <p>
            Stay updated on how you can help empower youth through music. From inspiring stories to events and ways to give - we'll keep you in the loop. You can unsubscribe at any time.
          </p>

          <p>I would like to get email updates:</p>
          <div class="radio-group">
            <label><input type="radio" name="email_updates" value="yes" checked> Yes</label>
            <label><input type="radio" name="email_updates" value="no"> No</label>
          </div>

          <p>I would like to get PARC text messages:</p>
          <div class="radio-group">
            <label><input type="radio" name="text_updates" value="yes"> Yes</label>
            <label><input type="radio" name="text_updates" value="no" checked> No</label>
          </div>

          <p class="small-text">
            We will keep your information safe and secure. Please see our Privacy Policy for details of how we use your information.
          </p>
          <p class="small-text">
            This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.
          </p>

          <button type="submit" class="btncontact">Sign Up</button>
        </form>
      </div>
    </div>
  </footer>
