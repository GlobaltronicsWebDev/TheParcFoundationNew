{{-- Personal Info & Payment Form --}}
<div class="donate-form-wrapper">

  {{-- Section: Your Information --}}
  <h3 class="formtitle">Your Information</h3>
  <form id="donationForm" action="{{ route('donations.store') }}" method="POST" class="personalinfo" novalidate>
    @csrf

    {{-- Hidden: stores selected amount --}}
    <input type="hidden" id="selectedAmount" name="amount" value="" />
    {{-- Hidden: stores give once or monthly --}}
    <input type="hidden" id="giveType" name="give_type" value="once" />
    {{-- Hidden: stores payment method --}}
    <input type="hidden" id="paymentMethod" name="payment_method" value="" />
    {{-- Hidden: Stripe PaymentIntent ID (filled by JS after successful charge) --}}
    <input type="hidden" id="stripeIntentId" name="stripe_payment_intent_id" value="" />
    {{-- Hidden: Stripe payment status --}}
    <input type="hidden" id="stripeStatus" name="stripe_status" value="pending" />

    <div class="form-row">
      <div class="form-group">
        <label for="fname">First Name <span class="req">*</span></label>
        <input type="text" id="fname" name="fname" placeholder="Enter first name" required />
        <span class="field-error" id="err-fname"></span>
      </div>
      <div class="form-group">
        <label for="lname">Last Name <span class="req">*</span></label>
        <input type="text" id="lname" name="lname" placeholder="Enter last name" required />
        <span class="field-error" id="err-lname"></span>
      </div>
    </div>

    <div class="form-group full-width">
      <label for="email">Email Address <span class="req">*</span></label>
      <input type="email" id="email" name="email" placeholder="you@example.com" required />
      <span class="field-error" id="err-email"></span>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="country">Country</label>
        <input type="text" id="country" name="country" placeholder="e.g. Philippines" />
      </div>
      <div class="form-group">
        <label for="city">City</label>
        <input type="text" id="city" name="city" placeholder="e.g. Manila" />
      </div>
    </div>

    <div class="form-group full-width">
      <label for="street">Street Address</label>
      <input type="text" id="street" name="street" placeholder="123 Main St" />
    </div>

    <div class="form-group">
      <label for="postal">Postal Code</label>
      <input type="text" id="postal" name="postal" placeholder="e.g. 1000" />
    </div>

    {{-- Community opt-in --}}
    <div class="community-section">
      <p class="p1form">BE PART OF OUR COMMUNITY</p>
      <p class="p2form">
        Stay updated on how you can help empower youth through music. You can unsubscribe at any time.
      </p>

      <div class="radio-block">
        <b><p>I would like to get email updates:</p></b>
        <fieldset class="radio-group">
          <label class="radio-label"><input type="radio" name="emailUpdates" id="emailYes" value="yes" /> Yes</label>
          <label class="radio-label"><input type="radio" name="emailUpdates" id="emailNo" value="no" checked /> No</label>
        </fieldset>
      </div>

      <div class="radio-block">
        <b><p>I would like to get PARC text messages:</p></b>
        <fieldset class="radio-group">
          <label class="radio-label"><input type="radio" name="textUpdates" id="textYes" value="yes" /> Yes</label>
          <label class="radio-label"><input type="radio" name="textUpdates" id="textNo" value="no" checked /> No</label>
        </fieldset>
      </div>
    </div>

    {{-- Privacy note --}}
    <div class="note2">
      <p class="p3">
        We will keep your information safe and secure. Please see our
        <b class="privacy">Privacy Policy</b> for details of how we use your information.
      </p>
    </div>

    {{-- ===== PAYMENT METHOD ===== --}}
    <h3 class="formtitle">Payment Method</h3>

    {{-- Payment method tab buttons --}}
    <div class="payment-method-tabs" role="tablist">
      <button type="button" class="pay-tab active" id="tab-visa" data-method="visa" role="tab" aria-selected="true">
        <img src="{{ asset('assets/icons/visa.png') }}" alt="Visa/Card" class="pay-tab-icon" />
        <span>Card</span>
      </button>
      <button type="button" class="pay-tab" id="tab-paypal" data-method="paypal" role="tab" aria-selected="false">
        <img src="{{ asset('assets/icons/paypal.png') }}" alt="PayPal" class="pay-tab-icon" />
        <span>PayPal</span>
      </button>
      <button type="button" class="pay-tab" id="tab-bank" data-method="bank" role="tab" aria-selected="false">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 9L12 4L21 9V10H3V9Z" fill="currentColor"/><rect x="5" y="11" width="2" height="7" fill="currentColor"/><rect x="11" y="11" width="2" height="7" fill="currentColor"/><rect x="17" y="11" width="2" height="7" fill="currentColor"/><rect x="3" y="19" width="18" height="2" fill="currentColor"/></svg>
        <span>Bank Transfer</span>
      </button>
    </div>

    {{-- ===== CARD PANEL (Stripe Elements) ===== --}}
    <div class="pay-panel" id="panel-visa">

      {{-- Stripe Card Element replaces custom card inputs --}}
      {{-- Stripe.js mounts here: PCI-compliant, no raw card data touches our server --}}
      <div class="form-group full-width">
        <label>Card Details <span class="req">*</span></label>
        <div id="stripe-card-element" class="stripe-card-element-container"></div>
        <div id="stripe-card-errors" class="stripe-error-msg" role="alert"></div>
      </div>

      {{-- Accepted cards info --}}
      <div class="accepted-cards">
        <span class="accepted-label">Accepted:</span>
        <span class="card-badge visa-badge">VISA</span>
        <span class="card-badge mc-badge">Mastercard</span>
        <span class="card-badge amex-badge">Amex</span>
        <svg class="stripe-badge-svg" viewBox="0 0 60 25" fill="none" xmlns="http://www.w3.org/2000/svg" height="16">
          <text x="0" y="18" font-size="14" font-family="Arial" fill="#635bff" font-weight="bold">stripe</text>
        </svg>
        <span class="secure-badge">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><path d="M12 2L4 6v6c0 5.25 3.5 10.15 8 11.35C16.5 22.15 20 17.25 20 12V6l-8-4z" fill="#22c55e"/></svg>
          Secured by Stripe
        </span>
      </div>
    </div>

    {{-- ===== PAYPAL PANEL ===== --}}
    <div class="pay-panel hidden" id="panel-paypal">
      <div class="paypal-info-box">
        <img src="{{ asset('assets/icons/paypal.png') }}" alt="PayPal" class="paypal-logo" />
        <p>You will be redirected to PayPal to complete your donation securely.</p>
        <div class="paypal-email-field form-group full-width">
          <label for="paypal_email">Your PayPal Email</label>
          <input type="email" id="paypal_email" name="paypal_email" placeholder="your@paypal.com" />
        </div>
      </div>
    </div>

    {{-- ===== BANK TRANSFER PANEL ===== --}}
    <div class="pay-panel hidden" id="panel-bank">
      <div class="bank-info-box">
        <div class="bank-header">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M3 9L12 4L21 9V10H3V9Z" fill="#f89b1e"/><rect x="5" y="11" width="2" height="7" fill="#f89b1e"/><rect x="11" y="11" width="2" height="7" fill="#f89b1e"/><rect x="17" y="11" width="2" height="7" fill="#f89b1e"/><rect x="3" y="19" width="18" height="2" fill="#f89b1e"/></svg>
          <span>Bank Transfer Details</span>
        </div>

        <div class="bank-details-grid">
          <div class="bank-detail-row">
            <span class="bank-label">Bank Name</span>
            <span class="bank-value">BDO Unibank</span>
          </div>
          <div class="bank-detail-row">
            <span class="bank-label">Account Name</span>
            <span class="bank-value">PARC Foundation Inc.</span>
          </div>
          <div class="bank-detail-row">
            <span class="bank-label">Account Number</span>
            <span class="bank-value copy-wrap">
              <span id="bankAccNum">0042-1234-5678</span>
              <button type="button" class="copy-btn" id="copyAccBtn" title="Copy account number">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><rect x="9" y="9" width="13" height="13" rx="2" stroke="currentColor" stroke-width="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1" stroke="currentColor" stroke-width="2"/></svg>
              </button>
              <span class="copy-toast" id="copyToast">Copied!</span>
            </span>
          </div>
          <div class="bank-detail-row">
            <span class="bank-label">Branch</span>
            <span class="bank-value">Cavite Main Branch</span>
          </div>
        </div>

        {{-- QR Code --}}
        <div class="qr-section">
          <p class="qr-label">Scan to Transfer via GCash / Maya</p>
          <div class="qr-placeholder" id="qrCode">
            <svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect width="120" height="120" fill="white"/>
              <!-- QR pattern placeholder -->
              <rect x="10" y="10" width="40" height="40" rx="3" fill="#222"/>
              <rect x="15" y="15" width="30" height="30" rx="2" fill="white"/>
              <rect x="20" y="20" width="20" height="20" rx="1" fill="#222"/>
              <rect x="70" y="10" width="40" height="40" rx="3" fill="#222"/>
              <rect x="75" y="15" width="30" height="30" rx="2" fill="white"/>
              <rect x="80" y="20" width="20" height="20" rx="1" fill="#222"/>
              <rect x="10" y="70" width="40" height="40" rx="3" fill="#222"/>
              <rect x="15" y="75" width="30" height="30" rx="2" fill="white"/>
              <rect x="20" y="80" width="20" height="20" rx="1" fill="#222"/>
              <rect x="55" y="55" width="10" height="10" fill="#222"/>
              <rect x="70" y="55" width="10" height="10" fill="#222"/>
              <rect x="85" y="55" width="10" height="10" fill="#222"/>
              <rect x="100" y="55" width="10" height="10" fill="#222"/>
              <rect x="70" y="70" width="10" height="10" fill="#222"/>
              <rect x="85" y="85" width="10" height="10" fill="#222"/>
              <rect x="100" y="70" width="10" height="10" fill="#222"/>
              <rect x="55" y="70" width="10" height="10" fill="#222"/>
              <rect x="55" y="85" width="10" height="10" fill="#222"/>
              <rect x="100" y="100" width="10" height="10" fill="#222"/>
              <rect x="70" y="100" width="10" height="10" fill="#222"/>
            </svg>
            <p class="qr-sub">PARC Foundation GCash QR</p>
          </div>
        </div>

        {{-- Receipt Reminder --}}
        <div class="receipt-reminder" id="receiptReminder">
          <div class="reminder-icon">📸</div>
          <div class="reminder-text">
            <strong>Important Reminder</strong>
            <p>Kindly screenshot your receipt and attach it for their reference after completing the bank transfer.</p>
          </div>
        </div>

        {{-- Receipt Upload --}}
        <div class="form-group full-width" style="margin-top: 16px;">
          <label for="receipt_upload">Attach Receipt Screenshot <span class="req">*</span></label>
          <div class="upload-area" id="uploadArea">
            <input type="file" id="receipt_upload" name="receipt_upload" accept="image/*,.pdf" class="upload-input" />
            <div class="upload-placeholder" id="uploadPlaceholder">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none"><path d="M12 16V8m0 0l-3 3m3-3l3 3" stroke="#f89b1e" stroke-width="2" stroke-linecap="round"/><path d="M3 17v2a2 2 0 002 2h14a2 2 0 002-2v-2" stroke="#f89b1e" stroke-width="2"/></svg>
              <span>Click to upload or drag & drop</span>
              <small>JPG, PNG, PDF (max 5MB)</small>
            </div>
            <div class="upload-preview" id="uploadPreview" style="display:none;">
              <img id="previewImg" src="" alt="Receipt Preview" />
              <span id="previewName"></span>
              <button type="button" class="remove-upload" id="removeUpload">✕</button>
            </div>
          </div>
          <span class="field-error" id="err-receipt"></span>
        </div>
      </div>
    </div>

    {{-- ===== Selected Amount Display ===== --}}
    <div class="selected-amount-display" id="selectedAmountDisplay" style="display:none;">
      <span class="amount-label">Donation Amount:</span>
      <span class="amount-value" id="amountDisplayValue">—</span>
    </div>

    {{-- Cover processing fee --}}
    <div class="last">
      <label class="checkbox-label" for="checkparc">
        <input type="checkbox" id="checkparc" name="cover_processing_fee" value="1">
        <span class="checkmark"></span>
        I want PARC to receive 100% of my donation (cover processing fees)
      </label>
    </div>

    {{-- DONATE BUTTON --}}
    <button type="submit" class="btn-donate-submit" id="donateSubmitBtn">
      <span class="btn-text">DONATE NOW</span>
      <span class="btn-spinner" id="btnSpinner" style="display:none;">
        <svg class="spin-svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="rgba(255,255,255,0.3)" stroke-width="3"/><path d="M12 2a10 10 0 0110 10" stroke="white" stroke-width="3" stroke-linecap="round"/></svg>
      </span>
    </button>

  </form>
</div>

{{-- ===== SUCCESS MODAL ===== --}}
<div class="modal-overlay" id="successModal" role="dialog" aria-modal="true" aria-labelledby="successTitle" style="display:none;">
  <div class="modal-card">
    <div class="modal-confetti" id="confettiContainer"></div>
    <div class="modal-icon-wrap">
      <div class="modal-icon success-icon">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="11" fill="#22c55e"/><path d="M7 13l3 3 7-7" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </div>
    </div>
    <h2 class="modal-title" id="successTitle">Donated Successfully! 🎉</h2>
    <p class="modal-subtitle">Thank you for your generous contribution to PARC Foundation.</p>

    <div class="modal-receipt-reminder">
      <span class="reminder-emoji">📸</span>
      <div>
        <strong>Don't forget!</strong>
        <p>Kindly screenshot your receipt and attach it for their reference.</p>
      </div>
    </div>

    <div class="modal-amount-summary" id="modalAmountSummary">
      <p>Your donation of <strong id="modalAmountVal">—</strong> has been recorded.</p>
    </div>

    <button type="button" class="modal-close-btn" id="modalCloseBtn">Close &amp; Continue</button>
  </div>
</div>