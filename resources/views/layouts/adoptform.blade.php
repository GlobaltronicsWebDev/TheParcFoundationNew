<!-- Personal Info Form -->
<div>
  <h3 class="formtitle">Your Information</h3>
  <form action="{{ route('adoptions.store') }}" method="POST" class="personalinfo" enctype="multipart/form-data" novalidate id="adoptionForm">
    @csrf

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

    <p class="p1form">BE PART OF OUR COMMUNITY</p>
    <p class="p2form">
      Stay updated on how you can help empower youth through music. From inspiring stories to events and ways to give - we'll keep you in the loop. You can unsubscribe at any time.
    </p>

    <!-- Radio Buttons -->
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

    <!-- Note -->
    <div class="note2">
      <p class="p3">
        We will keep your information safe and secure. Please see our <b class="privacy">Privacy Policy</b> for details of how we use your information.
      </p>
    </div>

    <!--Payment Method-->
    <h3 class="formtitle">Payment Method</h3>

    <div class="pmt-tabs" role="tablist">
      <button type="button" class="pmt-tab pmt-tab--active" id="btn-bank" style="width: 100%;" role="tab" aria-selected="true">
        <svg class="pmt-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M3 10L12 4l9 6v1H3v-1z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
          <rect x="5"  y="11" width="2" height="6" rx="0.5" fill="currentColor"/>
          <rect x="11" y="11" width="2" height="6" rx="0.5" fill="currentColor"/>
          <rect x="17" y="11" width="2" height="6" rx="0.5" fill="currentColor"/>
          <rect x="3"  y="18" width="18" height="2" rx="0.5" fill="currentColor"/>
        </svg>
        <span>Bank Account (BDO / GCash)</span>
      </button>
    </div>

    <div class="pmt-panel" id="notebank">
      <div class="bank-info-box">
        <div class="bank-header">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M3 10L12 4l9 6v1H3v-1z" stroke="#f89b1e" stroke-width="1.8" stroke-linejoin="round"/><rect x="5" y="11" width="2" height="6" fill="#f89b1e"/><rect x="11" y="11" width="2" height="6" fill="#f89b1e"/><rect x="17" y="11" width="2" height="6" fill="#f89b1e"/><rect x="3" y="18" width="18" height="2" fill="#f89b1e"/></svg>
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
            <span class="bank-label">Account No.</span>
            <span class="bank-value">
              <span id="bankAccNum">0042-1234-5678</span>
              <span class="copy-wrap">
                <button type="button" class="copy-btn" id="copyAccBtn" title="Copy account number">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><rect x="9" y="9" width="13" height="13" rx="2" stroke="currentColor" stroke-width="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1" stroke="currentColor" stroke-width="2"/></svg>
                </button>
                <span class="copy-toast" id="copyToast">Copied!</span>
              </span>
            </span>
          </div>
          <div class="bank-detail-row">
            <span class="bank-label">Branch</span>
            <span class="bank-value">Cavite Main Branch</span>
          </div>
        </div>

        {{-- QR Section --}}
        <div class="qr-section">
          <p class="qr-label">Scan to Pay via GCash / Maya</p>
          <div class="qr-placeholder">
            <img src="{{ asset('assets/image/qr_code.png') }}" alt="PARC Foundation QR Code" style="width: 150px; height: auto; border-radius: 8px;" />
            <p class="qr-sub" style="margin-top: 8px;">PARC Foundation GCash QR</p>
          </div>
        </div>

        {{-- Receipt Reminder --}}
        <div class="receipt-reminder" id="receiptReminder">
          <span class="reminder-icon">📸</span>
          <div class="reminder-text">
            <strong>Important Reminder</strong>
            <p>Kindly screenshot your receipt and attach it for reference after completing the bank transfer.</p>
          </div>
        </div>

        <!-- Receipt Upload -->
        <div class="form-group" style="margin-top: 16px;">
          <label for="receipt">Attach Receipt Screenshot <span class="req">*</span></label>
          <div class="upload-area" id="uploadArea">
            <input
              type="file"
              id="receipt"
              name="receipt"
              accept="image/*,.pdf"
              class="upload-input"
              onchange="handleReceiptChange(this)"
            />
            <div class="upload-placeholder" id="uploadPlaceholder">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 16V8m0 0l-3 3m3-3l3 3" stroke="#f89b1e" stroke-width="2" stroke-linecap="round"/><path d="M3 17v2a2 2 0 002 2h14a2 2 0 002-2v-2" stroke="#f89b1e" stroke-width="2"/></svg>
              <span id="receipt-label-text">Click to upload or drag &amp; drop</span>
              <small>JPG, PNG, PDF (max 5MB)</small>
            </div>
            <div class="upload-preview" id="receipt-preview" style="display: none;">
              <img id="receipt-img-preview" src="" alt="Receipt Preview" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #fce7c0;" />
              <span id="receipt-file-name" style="font-size: 0.85rem; color: #333; flex: 1; word-break: break-all;"></span>
              <button type="button" class="remove-upload" onclick="clearReceipt()">✕</button>
            </div>
          </div>
          <span class="field-error" id="err-receipt"></span>
        </div>

      </div>
    </div>

    <div class="last">
      <input type="checkbox" id="checkparc" name="checkparc" value="1">
      <label for="checkparc">I want PARC to receive 100% of my donation. I'll cover processing fees ($0.30).</label>
    </div>

    <input type="submit" value="ADOPT SCHOLAR" class="btn-donate-submit" style="border:none;" />
  </form>
</div>

<script>
  function handleReceiptChange(input) {
    const preview = document.getElementById('receipt-preview');
    const imgPreview = document.getElementById('receipt-img-preview');
    const fileName = document.getElementById('receipt-file-name');
    const placeholder = document.getElementById('uploadPlaceholder');
    const errEl = document.getElementById('err-receipt');

    if (errEl) errEl.style.display = 'none';

    if (input.files && input.files[0]) {
      const file = input.files[0];

      if (file.size > 5 * 1024 * 1024) {
        if (errEl) {
          errEl.textContent = 'File too large (max 5MB).';
          errEl.style.display = 'block';
        }
        input.value = '';
        return;
      }

      fileName.textContent = file.name;
      placeholder.style.display = 'none';
      preview.style.display = 'flex';

      if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
          imgPreview.src = e.target.result;
          imgPreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
      } else {
        imgPreview.style.display = 'none';
      }
    }
  }

  function clearReceipt() {
    const input = document.getElementById('receipt');
    const preview = document.getElementById('receipt-preview');
    const placeholder = document.getElementById('uploadPlaceholder');
    input.value = '';
    preview.style.display = 'none';
    placeholder.style.display = 'flex';
  }

  document.addEventListener("DOMContentLoaded", function () {
    // Copy account number
    const copyAccBtn = document.getElementById("copyAccBtn");
    const copyToast  = document.getElementById("copyToast");
    const bankAccNum = document.getElementById("bankAccNum");

    if (copyAccBtn) {
      copyAccBtn.addEventListener("click", function () {
        const text = bankAccNum ? bankAccNum.textContent.trim() : "";
        if (navigator.clipboard) {
          navigator.clipboard.writeText(text).then(showCopyToast);
        } else {
          const el = document.createElement("textarea");
          el.value = text;
          document.body.appendChild(el);
          el.select();
          document.execCommand("copy");
          document.body.removeChild(el);
          showCopyToast();
        }
      });
    }

    function showCopyToast() {
      if (!copyToast) return;
      copyToast.classList.add("visible");
      setTimeout(() => copyToast.classList.remove("visible"), 2000);
    }

    // Toggle Bank Account Panel on click (interactive feel)
    const btnBank = document.getElementById("btn-bank");
    const noteBank = document.getElementById("notebank");

    if (btnBank && noteBank) {
      btnBank.addEventListener("click", function (e) {
        e.preventDefault();
        btnBank.classList.toggle("pmt-tab--active");
        if (noteBank.style.display === "none") {
          noteBank.style.display = "block";
        } else {
          noteBank.style.display = "none";
        }
      });
    }

    // Drag and drop for upload area
    const uploadArea = document.getElementById("uploadArea");
    const receiptInput = document.getElementById("receipt");

    if (uploadArea && receiptInput) {
      uploadArea.addEventListener("click", function (e) {
        if (!e.target.closest(".remove-upload")) {
          receiptInput.click();
        }
      });

      uploadArea.addEventListener("dragover", function (e) {
        e.preventDefault();
        uploadArea.classList.add("drag-over");
      });

      uploadArea.addEventListener("dragleave", function () {
        uploadArea.classList.remove("drag-over");
      });

      uploadArea.addEventListener("drop", function (e) {
        e.preventDefault();
        uploadArea.classList.remove("drag-over");
        const file = e.dataTransfer.files[0];
        if (file) {
          const dt = new DataTransfer();
          dt.items.add(file);
          receiptInput.files = dt.files;
          handleReceiptChange(receiptInput);
        }
      });
    }
  });
</script>