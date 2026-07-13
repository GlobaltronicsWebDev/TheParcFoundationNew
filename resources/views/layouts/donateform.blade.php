{{-- Personal Info & Payment Form --}}
<div class="donate-form-wrapper">

  {{-- Section: Your Information --}}
  <h3 class="formtitle">Your Information</h3>
  <form id="donationForm" action="{{ route('donations.store') }}" method="POST" class="personalinfo" enctype="multipart/form-data" novalidate>
    @csrf

    <input type="hidden" id="selectedAmount"  name="amount"                    value="" />
    <input type="hidden" id="giveType"         name="give_type"                 value="once" />
    <input type="hidden" id="paymentMethod"    name="payment_method"            value="bank" />
    <input type="hidden" id="stripeIntentId"   name="stripe_payment_intent_id"  value="" />
    <input type="hidden" id="stripeStatus"     name="stripe_status"             value="pending" />

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

    {{-- Community opt-in --}}
    <div class="community-section">
      <p class="p1form">BE PART OF OUR COMMUNITY</p>
      <p class="p2form">Stay updated on how you can help empower youth through music. You can unsubscribe at any time.</p>

      <div class="radio-block">
        <b><p>I would like to get email updates:</p></b>
        <fieldset class="radio-group">
          <label class="radio-label"><input type="radio" name="emailUpdates" id="emailYes" value="yes" /> Yes</label>
          <label class="radio-label"><input type="radio" name="emailUpdates" id="emailNo"  value="no" checked /> No</label>
        </fieldset>
      </div>

      <div class="radio-block">
        <b><p>I would like to get PARC text messages:</p></b>
        <fieldset class="radio-group">
          <label class="radio-label"><input type="radio" name="textUpdates" id="textYes" value="yes" /> Yes</label>
          <label class="radio-label"><input type="radio" name="textUpdates" id="textNo"  value="no" checked /> No</label>
        </fieldset>
      </div>
    </div>

    {{-- Privacy note --}}
    <div class="note2">
      <p class="p3">We will keep your information safe and secure. Please see our <b class="privacy">Privacy Policy</b> for details.</p>
    </div>

    {{-- ===== PAYMENT METHOD ===== --}}
    <h3 class="formtitle">Payment Method</h3>

    <a href="#" class="btnm9" id="btn-bank">Bank Account</a>

    <div class="notebank" id="notebank" style="display: none; background-color: #eae8e8; padding: 20px; margin-top: 15px; border-radius: 8px; text-align: center;">
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

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const btnBank = document.getElementById("btn-bank");
        const noteBank = document.getElementById("notebank");

        if (btnBank && noteBank) {
          btnBank.addEventListener("click", function (e) {
            e.preventDefault();
            if (noteBank.style.display === "none") {
              noteBank.style.display = "block";
            } else {
              noteBank.style.display = "none";
            }
          });
        }
      });
    </script>

    {{-- Selected Amount Display --}}
    <div class="selected-amount-display" id="selectedAmountDisplay" style="display:none;">
      <span class="amount-label">Donation Amount:</span>
      <span class="amount-value" id="amountDisplayValue">—</span>
    </div>

    {{-- Cover processing fee --}}
    <div class="last">
      <input type="checkbox" id="checkparc" name="checkparc" value="1">
      <label for="checkparc">I want PARC to receive 100% of my donation. I'll cover processing fees ($0.30).</label>
    </div>

    {{-- DONATE BUTTON --}}
    <button type="submit" class="btn-donate-submit" id="donateSubmitBtn" style="border:none;">
      <span class="btn-text">DONATE NOW</span>
      <span class="btn-spinner" id="btnSpinner" style="display:none;">
        <svg class="spin-svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
          <circle cx="12" cy="12" r="10" stroke="rgba(255,255,255,0.3)" stroke-width="3"/>
          <path d="M12 2a10 10 0 0110 10" stroke="white" stroke-width="3" stroke-linecap="round"/>
        </svg>
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

    <button type="button" class="modal-close-btn" id="modalCloseBtn">Close &amp; Continue</button>
  </div>
</div>