  <footer class="footercon">
    <div class="footer-container">
      <!-- Left Links Section -->
      <div class="footer-links">
        <div class="footer-column">
          <h4>SUPPORT</h4>
          <ul>
            <li><a href="{{ url('/donate') }}" target="_blank">Donate now</a></li>
            <li><a href="{{ url('/adopt') }}" target="_blank">Adopt a Scholar</a></li>
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
            <li><a href="news">Newsroom</a></li>
          </ul>
        </div>
      </div>

      <!-- Right Contact Form -->
      <div class="footer-form">
        <h4 class="highlight">CONTACT US</h4>

        @if(session('contact_success'))
        <div style="background:#2e7d32;color:#fff;padding:10px 14px;border-radius:6px;margin-bottom:12px;font-size:0.9rem;">
          {{ session('contact_success') }}
        </div>
        @endif

        @if(session('contact_error'))
        <div style="background:#c62828;color:#fff;padding:10px 14px;border-radius:6px;margin-bottom:12px;font-size:0.9rem;">
          {{ session('contact_error') }}
        </div>
        @endif

        <form action="{{ route('contacts.send') }}" method="POST">
          @csrf
          <label for="footer_first_name">First Name <span class="required">*required</span></label>
          <input type="text" id="footer_first_name" name="first_name" value="{{ old('first_name') }}" required placeholder="First Name" style="width:100% !important;max-width:100% !important;display:block !important;padding:10px 12px !important;margin-top:5px !important;border:1px solid #ccc !important;border-radius:4px !important;background-color:#ffffff !important;color:#222222 !important;font-size:13px !important;box-sizing:border-box !important;">
          @error('first_name')<p style="color:#f7af1e;font-size:0.8rem;margin:2px 0 6px;">{{ $message }}</p>@enderror

          <label for="footer_last_name">Last Name <span class="required">*required</span></label>
          <input type="text" id="footer_last_name" name="last_name" value="{{ old('last_name') }}" required placeholder="Last Name" style="width:100% !important;max-width:100% !important;display:block !important;padding:10px 12px !important;margin-top:5px !important;border:1px solid #ccc !important;border-radius:4px !important;background-color:#ffffff !important;color:#222222 !important;font-size:13px !important;box-sizing:border-box !important;">
          @error('last_name')<p style="color:#f7af1e;font-size:0.8rem;margin:2px 0 6px;">{{ $message }}</p>@enderror

          <label for="footer_email">Email Address <span class="required">*required</span></label>
          <input type="email" id="footer_email" name="email" value="{{ old('email') }}" required placeholder="Email Address" style="width:100% !important;max-width:100% !important;display:block !important;padding:10px 12px !important;margin-top:5px !important;border:1px solid #ccc !important;border-radius:4px !important;background-color:#ffffff !important;color:#222222 !important;font-size:13px !important;box-sizing:border-box !important;">
          @error('email')<p style="color:#f7af1e;font-size:0.8rem;margin:2px 0 6px;">{{ $message }}</p>@enderror

          <label for="footer_subject">Subject / Inquiry Type <span class="required">*required</span></label>
          <select id="footer_subject" name="subject" required style="width:100% !important;max-width:100% !important;display:block !important;padding:10px 12px !important;margin-top:5px !important;border:1px solid #ccc !important;border-radius:4px !important;background-color:#ffffff !important;color:#222222 !important;font-size:13px !important;box-sizing:border-box !important;cursor:pointer !important;">
            <option value="" disabled selected>Select an inquiry type</option>
            <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
            <option value="Volunteer Opportunities" {{ old('subject') == 'Volunteer Opportunities' ? 'selected' : '' }}>Volunteer Opportunities</option>
            <option value="Partnerships & PARCners" {{ old('subject') == 'Partnerships & PARCners' ? 'selected' : '' }}>Partnerships & PARCners</option>
            <option value="Adopt-a-Scholar Inquiry" {{ old('subject') == 'Adopt-a-Scholar Inquiry' ? 'selected' : '' }}>Adopt-a-Scholar Inquiry</option>
            <option value="Donation Question" {{ old('subject') == 'Donation Question' ? 'selected' : '' }}>Donation Question</option>
            <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
          </select>
          @error('subject')<p style="color:#f7af1e;font-size:0.8rem;margin:2px 0 6px;">{{ $message }}</p>@enderror

          <label for="footer_message">Your Message <span class="required">*required</span></label>
          <textarea id="footer_message" name="message" rows="4" required placeholder="Write your message here..." style="width:100% !important;max-width:100% !important;display:block !important;padding:10px 12px !important;margin-top:5px !important;border:1px solid #ccc !important;border-radius:4px !important;background-color:#ffffff !important;color:#222222 !important;font-size:13px !important;min-height:110px !important;box-sizing:border-box !important;resize:vertical !important;">{{ old('message') }}</textarea>
          @error('message')<p style="color:#f7af1e;font-size:0.8rem;margin:2px 0 6px;">{{ $message }}</p>@enderror

          <p class="small-text">
            We will keep your information safe and secure. Please see our Privacy Policy for details of how we use your information.
          </p>

          <button type="submit" class="btncontact">Send Message</button>
        </form>
      </div>
    </div>
  </footer>
