{{-- Personal Info & Payment Form --}}
<div class="donate-form-wrapper">

  <!-- Stepper Bar Header -->
  <div class="donate-stepper-wrapper">
    <div class="donate-stepper" id="donateStepper">
      <div class="stepper-track-bg"></div>
      <div class="stepper-track-fill" id="stepperTrackFill"></div>
      
      <!-- Step 1: Amount -->
      <div class="step-item active" data-step="1" id="stepNode1" title="Step 1: Amount">
        <div class="step-circle">
          <span class="step-icon">
            <svg viewBox="0 0 32 32" class="parc-p-icon" fill="none">
              <circle cx="16" cy="16" r="13" stroke="currentColor" stroke-width="2.5"/>
              <path d="M11 9h6.5a4.5 4.5 0 0 1 0 9H14v6M14 13.5h7" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <span class="step-check">✓</span>
        </div>
        <span class="step-label">Amount</span>
      </div>

      <!-- Step 2: My Info -->
      <div class="step-item" data-step="2" id="stepNode2" title="Step 2: My Info">
        <div class="step-circle">
          <span class="step-icon">
            <svg viewBox="0 0 32 32" class="parc-p-icon" fill="none">
              <circle cx="16" cy="16" r="13" stroke="currentColor" stroke-width="2.5"/>
              <path d="M11 9h6.5a4.5 4.5 0 0 1 0 9H14v6M14 13.5h7" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <span class="step-check">✓</span>
        </div>
        <span class="step-label">My Info</span>
      </div>

      <!-- Step 3: Payment -->
      <div class="step-item" data-step="3" id="stepNode3" title="Step 3: Payment">
        <div class="step-circle">
          <span class="step-icon">
            <svg viewBox="0 0 32 32" class="parc-p-icon" fill="none">
              <circle cx="16" cy="16" r="13" stroke="currentColor" stroke-width="2.5"/>
              <path d="M11 9h6.5a4.5 4.5 0 0 1 0 9H14v6M14 13.5h7" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <span class="step-check">✓</span>
        </div>
        <span class="step-label">Payment</span>
      </div>

      <!-- Step 4: Confirm -->
      <div class="step-item" data-step="4" id="stepNode4" title="Step 4: Confirm">
        <div class="step-circle">
          <span class="step-icon">
            <svg viewBox="0 0 32 32" class="parc-p-icon" fill="none">
              <circle cx="16" cy="16" r="13" stroke="currentColor" stroke-width="2.5"/>
              <path d="M11 9h6.5a4.5 4.5 0 0 1 0 9H14v6M14 13.5h7" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <span class="step-check">✓</span>
        </div>
        <span class="step-label">Confirm</span>
      </div>
    </div>
  </div>

  <form id="donationForm" action="{{ route('donations.store') }}" method="POST" class="personalinfo" enctype="multipart/form-data" novalidate>
    @csrf

    <input type="hidden" id="selectedAmount"  name="amount"                    value="" />
    <input type="hidden" id="giveType"         name="give_type"                 value="once" />
    <input type="hidden" id="paymentMethod"    name="payment_method"            value="bank" />
    <input type="hidden" id="stripeIntentId"   name="stripe_payment_intent_id"  value="" />
    <input type="hidden" id="stripeStatus"     name="stripe_status"             value="pending" />

    <!-- ==================== STEP 1: AMOUNT ==================== -->
    <div class="step-panel active" id="stepPanel1">
      <!-- One-time / Monthly Toggle -->
      <div class="center-btn" id="giveTypeBtns" role="group" aria-label="Donation frequency">
        <a href="#" class="btn1 active" data-give="once" id="giveOnceBtn">Give Once</a>
        <a href="#" class="btn2" data-give="monthly" id="giveMonthlyBtn">Give Monthly</a>
      </div>

      <!-- Note -->
      <div class="note1">
        <p class="p1" id="noteTitle">Thank you for making a difference.</p>
        <p class="p2" id="noteSubtitle">
          One-time giving is a powerful way to support PARCaralan Scholars
        </p>
      </div>

      <!-- Amount Options -->
      <div class="btn-monthly" id="amountSection">
        <div class="center-btn amount-grid" id="amountBtns" role="group" aria-label="Donation amount">
          <a href="#" class="btnm1 amount-btn" data-amount="500" data-once="₱500" data-monthly="₱500/mo">₱500</a>
          <a href="#" class="btnm2 amount-btn" data-amount="1000" data-once="₱1,000" data-monthly="₱1,000/mo">₱1,000</a>
          <a href="#" class="btnm3 amount-btn" data-amount="1500" data-once="₱1,500" data-monthly="₱1,500/mo">₱1,500</a>
          <a href="#" class="btnm4 amount-btn" data-amount="2000" data-once="₱2,000" data-monthly="₱2,000/mo">₱2,000</a>
          <a href="#" class="btnm5 amount-btn" data-amount="5000" data-once="₱5,000" data-monthly="₱5,000/mo">₱5,000</a>
          <a href="#" class="btnm6 amount-btn other-btn" data-amount="other" data-once="Custom" data-monthly="Custom/mo">
            <b class="dollar">₱</b>Other
          </a>
        </div>

        <!-- Custom Amount Input -->
        <div class="custom-amount-wrap" id="customAmountWrap" style="display:none;">
          <label for="customAmountInput">Enter custom amount (₱)</label>
          <input type="number" id="customAmountInput" min="1" placeholder="e.g. 3000" />
        </div>
      </div>

      {{-- Selected Amount Display --}}
      <div class="selected-amount-display" id="selectedAmountDisplay" style="display:none;">
        <span class="amount-label">Selected Amount:</span>
        <span class="amount-value" id="amountDisplayValue">—</span>
      </div>

      <div class="step-actions">
        <button type="button" class="btn-step-next" id="btnToStep2">
          <span>Continue to My Info</span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
      </div>
    </div>

    <!-- ==================== STEP 2: MY INFO ==================== -->
    <div class="step-panel" id="stepPanel2">
      <h3 class="formtitle">Your Information</h3>

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

      <div class="form-group">
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

      <div class="form-group">
        <label for="street">Street Address</label>
        <input type="text" id="street" name="street" placeholder="123 Main St" />
      </div>

      <div class="form-group">
        <label for="postal">Postal Code</label>
        <input type="text" id="postal" name="postal" placeholder="e.g. 1000" />
      </div>

      {{-- Privacy note --}}
      <div class="note2">
        <p class="p3">We will keep your information safe and secure. Please see our <b class="privacy">Privacy Policy</b> for details.</p>
      </div>

      <div class="step-actions">
        <button type="button" class="btn-step-back" id="btnBackToStep1">← Back</button>
        <button type="button" class="btn-step-next" id="btnToStep3">
          <span>Continue to Payment</span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
      </div>
    </div>

    <!-- ==================== STEP 3: PAYMENT ==================== -->
    <div class="step-panel" id="stepPanel3">
      <h3 class="formtitle">Payment Method</h3>

      <a href="#" class="btnm9" id="btn-bank">Bank Account</a>

      <div class="notebank" id="notebank" style="display: block; background-color: #eae8e8; padding: 20px; margin-top: 15px; border-radius: 8px; text-align: center;">
        <p style="font-weight: bold; color: #f78f1e; margin-bottom: 15px;">Scan to Donate</p>
        <div style="display: flex; justify-content: center; align-items: center;">
          <img src="{{ asset('assets/image/qr_code.png') }}" alt="PARC Foundation QR Code" style="width: 260px; height: auto; border: 1px solid #ccc; border-radius: 8px; background: #fff; padding: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);" />
        </div>
        <p style="margin-top: 15px; font-size: 14px; color: #555;">After scanning please screenshot your receipt and attach it on form </p>

        <!-- Receipt Upload -->
        <div style="margin-top: 15px; text-align: left;">
          <label for="receipt" style="display: block; font-size: 13px; font-weight: 600; color: #444; margin-bottom: 8px;">
            📎 Attach Receipt Screenshot <span class="req">*</span>
          </label>
          <input
            type="file"
            id="receipt"
            name="receipt"
            accept="image/*,.pdf"
            style="display: none;"
            onchange="handleReceiptChange(this)"
          />
          <label for="receipt" id="receipt-label" style="display: flex; align-items: center; gap: 10px; cursor: pointer; background: #fff; border: 2px dashed #f78f1e; border-radius: 8px; padding: 14px 18px; font-size: 13px; color: #888; transition: border-color 0.2s;">
            <span style="font-size: 22px;">🖼️</span>
            <span id="receipt-label-text">Click to upload (JPG, PNG, PDF — max 5MB)</span>
          </label>
          <div id="receipt-preview" style="display: none; margin-top: 10px; text-align: center;">
            <img id="receipt-img-preview" src="" alt="Receipt Preview" style="max-width: 100%; max-height: 200px; border-radius: 8px; border: 1px solid #ccc; box-shadow: 0 2px 6px rgba(0,0,0,0.1);" />
            <p id="receipt-file-name" style="font-size: 12px; color: #666; margin-top: 6px;"></p>
            <button type="button" onclick="clearReceipt()" style="margin-top: 4px; background: none; border: none; color: #e74c3c; font-size: 12px; cursor: pointer;">✕ Remove</button>
          </div>
        </div>
        <span class="field-error" id="err-receipt"></span>

        <script>
          function handleReceiptChange(input) {
            const preview = document.getElementById('receipt-preview');
            const imgPreview = document.getElementById('receipt-img-preview');
            const fileName = document.getElementById('receipt-file-name');
            const labelText = document.getElementById('receipt-label-text');
            const errEl = document.getElementById('err-receipt');

            if (errEl) errEl.style.display = 'none';

            if (input.files && input.files[0]) {
              const file = input.files[0];
              labelText.textContent = file.name;
              fileName.textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';

              if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                  imgPreview.src = e.target.result;
                  imgPreview.style.display = 'block';
                  preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
              } else {
                imgPreview.style.display = 'none';
                preview.style.display = 'block';
              }
            }
          }

          function clearReceipt() {
            const input = document.getElementById('receipt');
            const preview = document.getElementById('receipt-preview');
            const labelText = document.getElementById('receipt-label-text');
            input.value = '';
            preview.style.display = 'none';
            labelText.textContent = 'Click to upload (JPG, PNG, PDF — max 5MB)';
          }
        </script>
      </div>

      <div class="step-actions">
        <button type="button" class="btn-step-back" id="btnBackToStep2">← Back</button>
        <button type="button" class="btn-step-next" id="btnToStep4">
          <span>Review &amp; Confirm</span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
      </div>
    </div>

    <!-- ==================== STEP 4: CONFIRM ==================== -->
    <div class="step-panel" id="stepPanel4">
      <h3 class="formtitle">Review Your Donation</h3>

      <div class="summary-card">
        <div class="summary-row">
          <span class="summary-label">Donation Amount:</span>
          <span class="summary-value" id="sumAmount">—</span>
        </div>
        <div class="summary-row">
          <span class="summary-label">Frequency:</span>
          <span class="summary-value" id="sumType">Give Once</span>
        </div>
        <div class="summary-row">
          <span class="summary-label">Donor Name:</span>
          <span class="summary-value" id="sumName">—</span>
        </div>
        <div class="summary-row">
          <span class="summary-label">Email Address:</span>
          <span class="summary-value" id="sumEmail">—</span>
        </div>
        <div class="summary-row">
          <span class="summary-label">Payment Method:</span>
          <span class="summary-value">Bank Account / Scan QR</span>
        </div>
        <div class="summary-row">
          <span class="summary-label">Attached Receipt:</span>
          <span class="summary-value" id="sumReceipt">—</span>
        </div>
      </div>

      <div class="note2" style="background: #fff8ed; border: 1px solid #ffe4a6;">
        <p class="p3" style="color: #b45309;">
          <strong>Final Step:</strong> Please double-check your information above before submitting your donation.
        </p>
      </div>

      <div class="step-actions">
        <button type="button" class="btn-step-back" id="btnBackToStep3">← Edit Details</button>
        {{-- DONATE SUBMIT BUTTON --}}
        <button type="submit" class="btn-donate-submit" id="donateSubmitBtn" style="border:none;">
          <span class="btn-text">CONFIRM &amp; DONATE NOW 🎉</span>
          <span class="btn-spinner" id="btnSpinner" style="display:none;">
            <svg class="spin-svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
              <circle cx="12" cy="12" r="10" stroke="rgba(255,255,255,0.3)" stroke-width="3"/>
              <path d="M12 2a10 10 0 0110 10" stroke="white" stroke-width="3" stroke-linecap="round"/>
            </svg>
          </span>
        </button>
      </div>
    </div>

  </form>
</div>

{{-- ===== SUCCESS MODAL ===== --}}
<div class="modal-overlay" id="successModal" role="dialog" aria-modal="true" aria-labelledby="successTitle" style="display:none;">
  <div class="modal-card">
    <div class="modal-confetti" id="confettiContainer"></div>
    <div class="modal-icon-wrap">
      <div class="modal-icon success-icon">
        <svg width="56" height="56" viewBox="0 0 24 24" fill="none">
          <circle cx="12" cy="12" r="11" fill="#22c55e"/>
          <path d="M7 13l3 3 7-7" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
    </div>
    <h2 class="modal-title" id="successTitle">Donated Successfully! 🎉</h2>
    <p class="modal-subtitle">Thank you for your generous contribution to PARC Foundation.</p>

    <div class="modal-receipt-reminder">
      <span class="reminder-emoji">📸</span>
      <div>
        <strong>Don't forget!</strong>
        <p>Kindly screenshot your receipt and attach it for reference.</p>
      </div>
    </div>

    <div class="modal-amount-summary" id="modalAmountSummary">
      <p>Your donation of <strong id="modalAmountVal">—</strong> has been recorded.</p>
    </div>

    <div class="modal-autoclose-note" id="modalAutoCloseNote" style="font-size: 0.85rem; color: #6b7280; margin: 12px 0 16px;">
      This window will automatically close in <span id="autoCloseCountdown" style="font-weight: 700; color: #f89b1e;">3</span> seconds...
    </div>

    <button type="button" class="modal-close-btn" id="modalCloseBtn">Close &amp; Continue</button>
  </div>
</div>