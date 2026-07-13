{{-- ============================================================
     Adopt a Scholar — Personal Info & Payment Form
     ============================================================ --}}
<div>

  {{-- ── SUCCESS FLASH ── --}}
  @if(session('success'))
    <div class="adopt-success-alert" id="adoptSuccessAlert">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
        <circle cx="12" cy="12" r="11" fill="#22c55e"/>
        <path d="M7 13l3 3 7-7" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      <span>{{ session('success') }}</span>
    </div>
  @endif

  <h3 class="formtitle">Your Information</h3>

  <form action="{{ route('adoptions.store') }}" method="POST"
        class="personalinfo" id="adoptionForm" enctype="multipart/form-data" novalidate>
    @csrf

    {{-- Hidden: selected package + amount --}}
    <input type="hidden" id="selectedPackage" name="package" value="{{ old('package') }}">
    <input type="hidden" id="selectedAmount"  name="amount"  value="{{ old('amount') }}">

    {{-- Selected package display --}}
    <div class="selected-pkg-display" id="selectedPkgDisplay" style="display:{{ old('package') ? 'flex' : 'none' }};">
      <span class="pkg-display-label">Selected Package:</span>
      <span class="pkg-display-value" id="selectedPkgText">{{ old('package', '') }}{{ old('amount') ? ' — ' . old('amount') : '' }}</span>
    </div>

    {{-- ── FIRST NAME ── --}}
    <div class="form-group">
      <label for="fname">First Name <span class="req">*</span></label>
      <input type="text" id="fname" name="fname"
             placeholder="Enter first name"
             value="{{ old('fname') }}"
             required />
      @error('fname')
        <span class="field-error" style="display:block;">{{ $message }}</span>
      @enderror
    </div>

    {{-- ── LAST NAME ── --}}
    <div class="form-group">
      <label for="lname">Last Name <span class="req">*</span></label>
      <input type="text" id="lname" name="lname"
             placeholder="Enter last name"
             value="{{ old('lname') }}"
             required />
      @error('lname')
        <span class="field-error" style="display:block;">{{ $message }}</span>
      @enderror
    </div>

    {{-- ── EMAIL ── --}}
    <div class="form-group">
      <label for="email">Email Address <span class="req">*</span></label>
      <input type="email" id="email" name="email"
             placeholder="you@example.com"
             value="{{ old('email') }}"
             required />
      @error('email')
        <span class="field-error" style="display:block;">{{ $message }}</span>
      @enderror
    </div>

    {{-- ── COUNTRY ── --}}
    <div class="form-group">
      <label for="country">Country</label>
      <input type="text" id="country" name="country"
             placeholder="e.g. Philippines"
             value="{{ old('country') }}" />
    </div>

    {{-- ── STREET ── --}}
    <div class="form-group">
      <label for="street">Street Address</label>
      <input type="text" id="street" name="street"
             placeholder="123 Main St"
             value="{{ old('street') }}" />
    </div>

    {{-- ── CITY ── --}}
    <div class="form-group">
      <label for="city">City</label>
      <input type="text" id="city" name="city"
             placeholder="e.g. Manila"
             value="{{ old('city') }}" />
    </div>

    {{-- ── POSTAL ── --}}
    <div class="form-group">
      <label for="postal">Postal Code</label>
      <input type="text" id="postal" name="postal"
             placeholder="e.g. 1000"
             value="{{ old('postal') }}" />
    </div>

    {{-- ── COMMUNITY OPT-IN ── --}}
    <div class="community-section">
      <p class="p1form">BE PART OF OUR COMMUNITY</p>
      <p class="p2form">Stay updated on how you can help empower youth through music. You can unsubscribe at any time.</p>

      <div class="radio-block">
        <b><p>I would like to get email updates:</p></b>
        <fieldset class="radio-group">
          <label class="radio-label">
            <input type="radio" name="emailUpdates" id="emailYes" value="yes"
                   {{ old('emailUpdates') === 'yes' ? 'checked' : '' }} /> Yes
          </label>
          <label class="radio-label">
            <input type="radio" name="emailUpdates" id="emailNo" value="no"
                   {{ old('emailUpdates', 'no') === 'no' ? 'checked' : '' }} /> No
          </label>
        </fieldset>
      </div>

      <div class="radio-block">
        <b><p>I would like to get PARC text messages:</p></b>
        <fieldset class="radio-group">
          <label class="radio-label">
            <input type="radio" name="textUpdates" id="textYes" value="yes"
                   {{ old('textUpdates') === 'yes' ? 'checked' : '' }} /> Yes
          </label>
          <label class="radio-label">
            <input type="radio" name="textUpdates" id="textNo" value="no"
                   {{ old('textUpdates', 'no') === 'no' ? 'checked' : '' }} /> No
          </label>
        </fieldset>
      </div>
    </div>

    {{-- ── PRIVACY NOTE ── --}}
    <div class="note2">
      <p class="p3">We will keep your information safe and secure. Please see our
        <b class="privacy">Privacy Policy</b> for details of how we use your information.
      </p>
    </div>

    {{-- ── PAYMENT METHOD ── --}}
    <h3 class="formtitle">Payment Method</h3>

    <a href="#" class="btnm9" id="btn-bank">Bank Account</a>

    <div class="notebank" id="notebank" style="display: none; background-color: #eae8e8; padding: 20px; margin-top: 15px; border-radius: 8px; text-align: center;">
      <p style="font-weight: bold; color: #f78f1e; margin-bottom: 15px;">Scan to Donate</p>
      <div style="display: flex; justify-content: center; align-items: center;">
        <img src="{{ asset('assets/image/qr_code.png') }}" alt="PARC Foundation QR Code"
             style="width: 260px; height: auto; border: 1px solid #ccc; border-radius: 8px; background: #fff; padding: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);" />
      </div>
      <p style="margin-top: 15px; font-size: 14px; color: #555;">After scanning please screenshot your receipt and attach it on form</p>

      {{-- Receipt Upload --}}
      <div style="margin-top: 15px; text-align: left;">
        <label for="receipt" style="display: block; font-size: 13px; font-weight: 600; color: #444; margin-bottom: 8px;">
          📎 Attach Receipt Screenshot
        </label>
        <input type="file" id="receipt" name="receipt" accept="image/*,.pdf"
               style="display: none;" onchange="handleReceiptChange(this)" />
        <label for="receipt" id="receipt-label"
               style="display: flex; align-items: center; gap: 10px; cursor: pointer; background: #fff; border: 2px dashed #f78f1e; border-radius: 8px; padding: 14px 18px; font-size: 13px; color: #888; transition: border-color 0.2s;">
          <span style="font-size: 22px;">🖼️</span>
          <span id="receipt-label-text">Click to upload (JPG, PNG, PDF — max 5MB)</span>
        </label>
        <div id="receipt-preview" style="display: none; margin-top: 10px; text-align: center;">
          <img id="receipt-img-preview" src="" alt="Receipt Preview"
               style="max-width: 100%; max-height: 200px; border-radius: 8px; border: 1px solid #ccc; box-shadow: 0 2px 6px rgba(0,0,0,0.1);" />
          <p id="receipt-file-name" style="font-size: 12px; color: #666; margin-top: 6px;"></p>
          <button type="button" onclick="clearReceipt()"
                  style="margin-top: 4px; background: none; border: none; color: #e74c3c; font-size: 12px; cursor: pointer;">✕ Remove</button>
        </div>
      </div>
    </div>

    {{-- ── COVER FEE ── --}}
    <div class="last">
      <label class="checkbox-label">
        <input type="checkbox" id="checkparc" name="cover_processing_fee" value="1"
               {{ old('cover_processing_fee') ? 'checked' : '' }}>
        I want PARC to receive 100% of my donation. I'll cover processing fees ($0.30).
      </label>
    </div>

    {{-- ── DONATE NOW BUTTON ── --}}
    <button type="submit" class="adopt-donate-btn" id="adoptSubmitBtn">
      <span class="btn-text">DONATE NOW</span>
      <span class="btn-spinner" id="adoptBtnSpinner" style="display:none;">
        <svg class="spin-svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
          <circle cx="12" cy="12" r="10" stroke="rgba(255,255,255,0.3)" stroke-width="3"/>
          <path d="M12 2a10 10 0 0110 10" stroke="white" stroke-width="3" stroke-linecap="round"/>
        </svg>
      </span>
    </button>

  </form>
</div>

{{-- ── SCRIPTS ── --}}
<script>
  /* ---- Receipt upload helpers ---- */
  function handleReceiptChange(input) {
    const preview   = document.getElementById('receipt-preview');
    const imgPrev   = document.getElementById('receipt-img-preview');
    const fileName  = document.getElementById('receipt-file-name');
    const labelText = document.getElementById('receipt-label-text');

    if (input.files && input.files[0]) {
      const file = input.files[0];
      labelText.textContent = file.name;
      fileName.textContent  = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';

      if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
          imgPrev.src = e.target.result;
          imgPrev.style.display = 'block';
          preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
      } else {
        imgPrev.style.display = 'none';
        preview.style.display = 'block';
      }
    }
  }

  function clearReceipt() {
    document.getElementById('receipt').value = '';
    document.getElementById('receipt-preview').style.display = 'none';
    document.getElementById('receipt-label-text').textContent = 'Click to upload (JPG, PNG, PDF — max 5MB)';
  }

  /* ---- Bank toggle ---- */
  document.addEventListener("DOMContentLoaded", function () {
    const btnBank  = document.getElementById("btn-bank");
    const noteBank = document.getElementById("notebank");

    if (btnBank && noteBank) {
      btnBank.addEventListener("click", function (e) {
        e.preventDefault();
        noteBank.style.display = noteBank.style.display === "none" ? "block" : "none";
      });
    }

    /* ---- Spinner on submit ---- */
    const adoptForm = document.getElementById("adoptionForm");
    const submitBtn = document.getElementById("adoptSubmitBtn");
    const spinner   = document.getElementById("adoptBtnSpinner");
    const btnText   = submitBtn ? submitBtn.querySelector(".btn-text") : null;

    if (adoptForm && submitBtn) {
      adoptForm.addEventListener("submit", function () {
        // Basic HTML5 check first
        if (!adoptForm.checkValidity()) return;
        submitBtn.disabled = true;
        if (spinner) spinner.style.display = "inline-flex";
        if (btnText) btnText.textContent   = "Submitting…";
      });
    }

    /* ---- Auto-scroll to error or success ---- */
    const firstError = document.querySelector('.field-error[style*="display:block"], .field-error[style*="display: block"]');
    const successBox = document.getElementById('adoptSuccessAlert');
    if (firstError) {
      firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    } else if (successBox) {
      successBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  });
</script>