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

        <form id="footerContactForm" action="{{ route('contacts.send') }}" method="POST">
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

          <button type="submit" id="footerContactSubmitBtn" class="btncontact">
            <span class="footer-btn-text">Send Message</span>
            <span class="footer-btn-spinner" id="footerBtnSpinner" style="display:none;">Sending...</span>
          </button>
        </form>
      </div>
    </div>
  </footer>

  <!-- ── Footer Contact Success Popup Modal ── -->
  <div class="contact-modal-overlay" id="footerContactSuccessModal" style="display: {{ session('contact_success') ? 'flex' : 'none' }};">
    <div class="contact-modal-card">
      <div class="contact-modal-icon">
        <svg width="64" height="64" viewBox="0 0 24 24" fill="none">
          <circle cx="12" cy="12" r="11" fill="#22c55e"/>
          <path d="M7 13l3 3 7-7" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <h3 class="contact-modal-title">Message Successfully Sent! 🎉</h3>
      <p class="contact-modal-subtitle" id="footerContactModalSubtitle">
        {{ session('contact_success') ?? 'Thank you for reaching out to The PARC Foundation. We have received your inquiry and our team will get back to you soon!' }}
      </p>
      <button type="button" class="contact-modal-close-btn" id="footerContactModalCloseBtn">OK / Close</button>
    </div>
  </div>

  <style>
    /* ── Footer Contact Modal Styling ── */
    .contact-modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(4px);
      z-index: 99999;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      animation: fadeInModal 0.3s ease;
    }
    .contact-modal-card {
      background: #ffffff;
      border-radius: 16px;
      max-width: 480px;
      width: 100%;
      padding: 36px 30px;
      text-align: center;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
      border: 1px solid #e5e7eb;
      animation: popInCard 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .contact-modal-icon {
      margin-bottom: 20px;
      display: flex;
      justify-content: center;
    }
    .contact-modal-title {
      font-size: 1.5rem;
      font-weight: 800;
      color: #111827;
      margin-bottom: 12px;
    }
    .contact-modal-subtitle {
      font-size: 0.95rem;
      color: #4b5563;
      line-height: 1.55;
      margin-bottom: 24px;
    }
    .contact-modal-close-btn {
      width: 100%;
      padding: 14px;
      background: #f89b1e;
      color: #ffffff;
      font-size: 0.95rem;
      font-weight: 700;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      box-shadow: 0 4px 12px rgba(248, 155, 30, 0.25);
      transition: all 0.2s ease;
    }
    .contact-modal-close-btn:hover {
      background: #e0840b;
      transform: translateY(-1px);
      box-shadow: 0 6px 16px rgba(248, 155, 30, 0.35);
    }
    @keyframes fadeInModal {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    @keyframes popInCard {
      from { opacity: 0; transform: scale(0.85); }
      to { opacity: 1; transform: scale(1); }
    }
  </style>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const footerContactForm = document.getElementById("footerContactForm");
      const footerContactSubmitBtn = document.getElementById("footerContactSubmitBtn");
      const footerBtnText = footerContactSubmitBtn?.querySelector(".footer-btn-text");
      const footerBtnSpinner = document.getElementById("footerBtnSpinner");
      const footerContactSuccessModal = document.getElementById("footerContactSuccessModal");
      const footerContactModalSubtitle = document.getElementById("footerContactModalSubtitle");
      const footerContactModalCloseBtn = document.getElementById("footerContactModalCloseBtn");

      function setFooterLoading(loading) {
        if (!footerContactSubmitBtn) return;
        footerContactSubmitBtn.disabled = loading;
        if (footerBtnText) footerBtnText.style.display = loading ? "none" : "inline";
        if (footerBtnSpinner) footerBtnSpinner.style.display = loading ? "inline" : "none";
      }

      function openFooterModal(msg) {
        if (footerContactModalSubtitle && msg) {
          footerContactModalSubtitle.textContent = msg;
        }
        if (footerContactSuccessModal) {
          footerContactSuccessModal.style.display = "flex";
        }
      }

      function closeFooterModal() {
        if (footerContactSuccessModal) {
          footerContactSuccessModal.style.display = "none";
        }
      }

      if (footerContactForm) {
        footerContactForm.addEventListener("submit", async function (e) {
          e.preventDefault();
          setFooterLoading(true);

          const formData = new FormData(footerContactForm);
          const actionUrl = footerContactForm.getAttribute("action");

          try {
            const res = await fetch(actionUrl, {
              method: "POST",
              headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
              },
              body: formData
            });

            const json = await res.json();

            if (res.ok && json.success) {
              footerContactForm.reset();
              openFooterModal(json.message || "Thank you for reaching out to The PARC Foundation. We have received your inquiry and our team will get back to you soon!");
            } else {
              alert(json.message || json.error || "An error occurred. Please try again.");
            }
          } catch (err) {
            console.error("Footer contact form error:", err);
            alert("Connection error. Please try again.");
          } finally {
            setFooterLoading(false);
          }
        });
      }

      if (footerContactModalCloseBtn) {
        footerContactModalCloseBtn.addEventListener("click", closeFooterModal);
      }
      if (footerContactSuccessModal) {
        footerContactSuccessModal.addEventListener("click", function (e) {
          if (e.target === footerContactSuccessModal) closeFooterModal();
        });
      }
      document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") closeFooterModal();
      });
    });
  </script>
