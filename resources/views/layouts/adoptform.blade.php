{{-- ============================================================
     Adopt a Scholar — 4-Step Payment & Adoption Wizard Form
     ============================================================ --}}
<div class="adopt-form-wrapper">

  <!-- Stepper Header Bar -->
  <div class="adopt-stepper-wrapper" style="width: 100%; padding: 15px 0 25px; margin-bottom: 25px;">
    <div class="adopt-stepper" id="adoptStepper" style="display: flex; justify-content: space-between; align-items: flex-start; position: relative; width: 100%; max-width: 440px; margin: 0 auto;">
      
      <!-- Track lines -->
      <div class="stepper-track-bg" style="position: absolute; top: 14px; left: 12%; right: 12%; height: 2px; background-color: #e5e7eb; z-index: 1;"></div>
      <div class="stepper-track-fill" id="adoptStepperTrackFill" style="position: absolute; top: 14px; left: 12%; height: 2px; background-color: #f89b1e; width: 0%; transition: width 0.35s ease; z-index: 2;"></div>
      
      <!-- Step 1: Package -->
      <div class="step-item active" data-step="1" id="adoptStepNode1" style="display: flex; flex-direction: column; align-items: center; position: relative; z-index: 3; cursor: pointer; width: 65px;">
        <div class="step-circle" id="adoptStepCircle1" style="width: 28px; height: 28px; border-radius: 50%; background-color: #ffffff; border: 2.5px solid #f89b1e; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 0 3px rgba(248, 155, 30, 0.15); transition: all 0.3s ease;">
          <span class="step-icon" id="adoptStepIcon1" style="display: flex; align-items: center; justify-content: center;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke="#f89b1e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <span class="step-check" id="adoptStepCheck1" style="display: none; color: #ffffff; font-weight: bold; font-size: 14px;">✓</span>
        </div>
        <span class="step-label" id="adoptStepLabel1" style="font-size: 0.8rem; font-weight: 700; color: #f89b1e; margin-top: 6px; white-space: nowrap;">Package</span>
      </div>

      <!-- Step 2: My Info -->
      <div class="step-item" data-step="2" id="adoptStepNode2" style="display: flex; flex-direction: column; align-items: center; position: relative; z-index: 3; cursor: pointer; width: 65px;">
        <div class="step-circle" id="adoptStepCircle2" style="width: 28px; height: 28px; border-radius: 50%; background-color: #d1d5db; border: 2.5px solid transparent; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;">
          <span class="step-icon" id="adoptStepIcon2" style="display: none; align-items: center; justify-content: center;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" stroke="#f89b1e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <span class="step-check" id="adoptStepCheck2" style="display: none; color: #ffffff; font-weight: bold; font-size: 14px;">✓</span>
        </div>
        <span class="step-label" id="adoptStepLabel2" style="font-size: 0.8rem; font-weight: 500; color: #6b7280; margin-top: 6px; white-space: nowrap;">My Info</span>
      </div>

      <!-- Step 3: Payment -->
      <div class="step-item" data-step="3" id="adoptStepNode3" style="display: flex; flex-direction: column; align-items: center; position: relative; z-index: 3; cursor: pointer; width: 65px;">
        <div class="step-circle" id="adoptStepCircle3" style="width: 28px; height: 28px; border-radius: 50%; background-color: #d1d5db; border: 2.5px solid transparent; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;">
          <span class="step-icon" id="adoptStepIcon3" style="display: none; align-items: center; justify-content: center;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <rect x="2" y="5" width="20" height="14" rx="2" stroke="#f89b1e" stroke-width="2"/>
              <line x1="2" y1="10" x2="22" y2="10" stroke="#f89b1e" stroke-width="2"/>
            </svg>
          </span>
          <span class="step-check" id="adoptStepCheck3" style="display: none; color: #ffffff; font-weight: bold; font-size: 14px;">✓</span>
        </div>
        <span class="step-label" id="adoptStepLabel3" style="font-size: 0.8rem; font-weight: 500; color: #6b7280; margin-top: 6px; white-space: nowrap;">Payment</span>
      </div>

      <!-- Step 4: Confirm -->
      <div class="step-item" data-step="4" id="adoptStepNode4" style="display: flex; flex-direction: column; align-items: center; position: relative; z-index: 3; cursor: pointer; width: 65px;">
        <div class="step-circle" id="adoptStepCircle4" style="width: 28px; height: 28px; border-radius: 50%; background-color: #d1d5db; border: 2.5px solid transparent; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;">
          <span class="step-icon" id="adoptStepIcon4" style="display: none; align-items: center; justify-content: center;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" stroke="#f89b1e" stroke-width="2" stroke-linecap="round"/>
              <polyline points="22 4 12 14.01 9 11.01" stroke="#f89b1e" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </span>
          <span class="step-check" id="adoptStepCheck4" style="display: none; color: #ffffff; font-weight: bold; font-size: 14px;">✓</span>
        </div>
        <span class="step-label" id="adoptStepLabel4" style="font-size: 0.8rem; font-weight: 500; color: #6b7280; margin-top: 6px; white-space: nowrap;">Confirm</span>
      </div>
    </div>
  </div>

  <form id="adoptionForm" action="{{ route('adoptions.store') }}" method="POST" class="personalinfo" enctype="multipart/form-data" novalidate>
    @csrf

    <input type="hidden" id="selectedPackage"   name="package"        value="{{ old('package') }}" />
    <input type="hidden" id="selectedAmount"    name="amount"         value="{{ old('amount') }}" />
    <input type="hidden" id="adoptPaymentMethod" name="payment_method" value="ewallet" />

    <!-- ==================== STEP 1: PACKAGE ==================== -->
    <div class="adopt-step-panel active" id="adoptStepPanel1" style="display: block;">
      <h3 class="formtitle" style="color: #f89b1e; font-weight: 800; text-transform: uppercase;">Step 1: Choose Adoption Package</h3>
      
      <p style="font-size: 0.95rem; color: #4b5563; margin-bottom: 20px; line-height: 1.5;">
        Select an adoption package or share what you can to support underprivileged young talents in the arts.
      </p>

      {{-- Selected Package Display Card --}}
      <div class="selected-pkg-card" id="selectedPkgCard" style="background: #fff8f0; border: 2px solid #f89b1e; border-radius: 12px; padding: 18px 22px; margin-bottom: 25px; display: none;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <div>
            <span style="font-size: 0.85rem; font-weight: 700; color: #6b7280; text-transform: uppercase;">Selected Package</span>
            <h4 id="summaryPkgTitle" style="font-size: 1.25rem; font-weight: 800; color: #111827; margin: 4px 0 0 0;">—</h4>
          </div>
          <div style="text-align: right;">
            <span id="summaryPkgAmount" style="font-size: 1.3rem; font-weight: 800; color: #f89b1e;">—</span>
          </div>
        </div>
      </div>

      {{-- Custom Amount Input --}}
      <div class="custom-amount-wrap" id="adoptCustomAmountWrap" style="display: none; margin-bottom: 20px;">
        <label for="adoptCustomAmountInput" style="font-size: 0.9rem; font-weight: 700; color: #1f2937; margin-bottom: 6px; display: block;">Enter Your Support Amount (₱) <span class="req">*</span></label>
        <input type="number" id="adoptCustomAmountInput" min="1" placeholder="e.g. 5000" style="width: 100%; padding: 12px 16px; border: 1.5px solid #d1d5db; border-radius: 8px; font-size: 1rem;" />
      </div>

      <div class="step-actions" style="margin-top: 24px;">
        <button type="button" class="btn-step-next" id="btnAdoptToStep2" style="width: 100%; padding: 16px; background: #d1d5db; color: #777777; border: none; border-radius: 8px; font-size: 1.05rem; font-weight: 800; letter-spacing: 0.5px; text-transform: uppercase; cursor: not-allowed; transition: all 0.25s ease;">
          Continue to My Information →
        </button>
      </div>
    </div>

    <!-- ==================== STEP 2: MY INFO ==================== -->
    <div class="adopt-step-panel" id="adoptStepPanel2" style="display: none;">
      <h3 class="formtitle" style="color: #f89b1e; font-weight: 800; text-transform: uppercase;">Step 2: Donor Information</h3>

      <div class="form-row" style="display: flex; gap: 16px; margin-bottom: 15px;">
        <div class="form-group" style="flex: 1;">
          <label for="fname" style="font-weight: 700; color: #1f2937;">First Name <span class="req">*</span></label>
          <input type="text" id="fname" name="fname" placeholder="Enter first name" required style="width: 100%; padding: 12px; border: 1.5px solid #d1d5db; border-radius: 8px;" />
          <span class="field-error" id="err-fname" style="color: #e11d48; font-size: 0.82rem; margin-top: 4px; display: none;">First name is required</span>
        </div>
        <div class="form-group" style="flex: 1;">
          <label for="lname" style="font-weight: 700; color: #1f2937;">Last Name <span class="req">*</span></label>
          <input type="text" id="lname" name="lname" placeholder="Enter last name" required style="width: 100%; padding: 12px; border: 1.5px solid #d1d5db; border-radius: 8px;" />
          <span class="field-error" id="err-lname" style="color: #e11d48; font-size: 0.82rem; margin-top: 4px; display: none;">Last name is required</span>
        </div>
      </div>

      <div class="form-group" style="margin-bottom: 15px;">
        <label for="email" style="font-weight: 700; color: #1f2937;">Email Address <span class="req">*</span></label>
        <input type="email" id="email" name="email" placeholder="you@example.com" required style="width: 100%; padding: 12px; border: 1.5px solid #d1d5db; border-radius: 8px;" />
        <span class="field-error" id="err-email" style="color: #e11d48; font-size: 0.82rem; margin-top: 4px; display: none;">Valid email address is required</span>
      </div>

      <div class="form-group" style="margin-bottom: 15px;">
        <label for="phone" style="font-weight: 700; color: #1f2937;">Contact Number</label>
        <div style="display: flex; gap: 8px; align-items: center;">
          <select id="adopt_country_code" name="country_code" style="width: 110px; padding: 12px 6px; font-size: 0.9rem; border: 1.5px solid #d1d5db; border-radius: 8px; background-color: #ffffff; color: #1f2937; outline: none; cursor: pointer;">
            <option value="+63" selected>🇵🇭 +63</option>
            <option value="+1">🇺🇸 +1</option>
            <option value="+1">🇨🇦 +1</option>
            <option value="+61">🇦🇺 +61</option>
            <option value="+44">🇬🇧 +44</option>
            <option value="+65">🇸🇬 +65</option>
            <option value="+81">🇯🇵 +81</option>
            <option value="+971">🇦🇪 +971</option>
            <option value="+82">🇰🇷 +82</option>
            <option value="+886">🇹🇼 +886</option>
            <option value="+852">🇭🇰 +852</option>
            <option value="+60">🇲🇾 +60</option>
            <option value="+62">🇮🇩 +62</option>
            <option value="+66">🇹🇭 +66</option>
            <option value="+84">🇻🇳 +84</option>
            <option value="+91">🇮🇳 +91</option>
            <option value="+966">🇸🇦 +966</option>
            <option value="+974">🇶🇦 +974</option>
            <option value="+965">🇰🇼 +965</option>
            <option value="+33">🇫🇷 +33</option>
            <option value="+49">🇩🇪 +49</option>
            <option value="+39">🇮🇹 +39</option>
            <option value="+34">🇪🇸 +34</option>
            <option value="+31">🇳🇱 +31</option>
            <option value="+64">🇳🇿 +64</option>
          </select>
          <input type="tel" id="phone" name="phone" placeholder="905 123 4567" style="flex: 1; padding: 12px; border: 1.5px solid #d1d5db; border-radius: 8px;" />
        </div>
      </div>

      <h4 style="font-size: 0.95rem; font-weight: 700; color: #4b5563; margin: 20px 0 12px; border-bottom: 1px solid #e5e7eb; padding-bottom: 6px;">
        My Address <span style="font-size: 0.8rem; font-weight: 400; color: #888;">(Optional)</span>
      </h4>

      <div class="form-row" style="display: flex; gap: 16px; margin-bottom: 15px;">
        <div class="form-group" style="flex: 1;">
          <label for="country" style="font-weight: 700; color: #1f2937;">Country</label>
          <select id="country" name="country" style="width: 100%; padding: 12px 14px; font-size: 0.95rem; border: 1.5px solid #d1d5db; border-radius: 8px; background-color: #ffffff; color: #1f2937; outline: none; cursor: pointer;">
            <option value="Philippines" selected>Philippines</option>
            <option value="United States">United States</option>
            <option value="Canada">Canada</option>
            <option value="Australia">Australia</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="Singapore">Singapore</option>
            <option value="Japan">Japan</option>
            <option value="United Arab Emirates">United Arab Emirates</option>
            <option value="Other">Other Country</option>
          </select>
        </div>

        <div class="form-group" style="flex: 1;">
          <label for="adoptProvince" style="font-weight: 700; color: #1f2937;">Province / Region</label>
          <select id="adoptProvince" name="province" style="width: 100%; padding: 12px 14px; font-size: 0.95rem; border: 1.5px solid #d1d5db; border-radius: 8px; background-color: #ffffff; color: #1f2937; outline: none; cursor: pointer;">
            <option value="" disabled selected>Select Province / Region</option>
          </select>
        </div>
      </div>

      <div class="form-row" style="display: flex; gap: 16px; margin-bottom: 15px;">
        <div class="form-group" style="flex: 1;">
          <label for="adoptCitySelect" style="font-weight: 700; color: #1f2937;">City / Municipality</label>
          <select id="adoptCitySelect" name="city" style="width: 100%; padding: 12px 14px; font-size: 0.95rem; border: 1.5px solid #d1d5db; border-radius: 8px; background-color: #ffffff; color: #1f2937; outline: none; cursor: pointer;">
            <option value="" disabled selected>Select Province First</option>
          </select>
          <input type="text" id="adoptCityCustom" name="city_custom" placeholder="Type city name" style="display: none; margin-top: 8px; width: 100%; padding: 12px; border: 1.5px solid #d1d5db; border-radius: 8px;" />
        </div>

        <div class="form-group" style="flex: 1;">
          <label for="adoptBarangaySelect" style="font-weight: 700; color: #1f2937;">Barangay</label>
          <select id="adoptBarangaySelect" name="barangay" style="width: 100%; padding: 12px 14px; font-size: 0.95rem; border: 1.5px solid #d1d5db; border-radius: 8px; background-color: #ffffff; color: #1f2937; outline: none; cursor: pointer;">
            <option value="" disabled selected>Select City First</option>
          </select>
          <input type="text" id="adoptBarangayCustom" name="barangay_custom" placeholder="Type barangay name" style="display: none; margin-top: 8px; width: 100%; padding: 12px; border: 1.5px solid #d1d5db; border-radius: 8px;" />
        </div>
      </div>

      <div class="form-row" style="display: flex; gap: 16px; margin-bottom: 15px;">
        <div class="form-group" style="flex: 2;">
          <label for="street" style="font-weight: 700; color: #1f2937;">Street Address</label>
          <input type="text" id="street" name="street" placeholder="House No., Building, Street Name" style="width: 100%; padding: 12px; border: 1.5px solid #d1d5db; border-radius: 8px;" />
        </div>
        <div class="form-group" style="flex: 1;">
          <label for="postal" style="font-weight: 700; color: #1f2937;">Postal Code</label>
          <input type="text" id="postal" name="postal" placeholder="e.g. 1000" style="width: 100%; padding: 12px; border: 1.5px solid #d1d5db; border-radius: 8px;" />
        </div>
      </div>

      <div class="step-actions" style="display: flex; gap: 14px; margin-top: 24px;">
        <button type="button" class="btn-step-back" id="btnAdoptBackToStep1" style="flex: 1; padding: 14px; background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; border-radius: 8px; font-weight: 700; cursor: pointer;">
          ← Back
        </button>
        <button type="button" class="btn-step-next active-btn" id="btnAdoptToStep3" style="flex: 2; padding: 14px; background: #f89b1e; color: #ffffff; border: none; border-radius: 8px; font-weight: 800; text-transform: uppercase; cursor: pointer;">
          Proceed to Payment →
        </button>
      </div>
    </div>

    <!-- ==================== STEP 3: PAYMENT ==================== -->
    <div class="adopt-step-panel" id="adoptStepPanel3" style="display: none;">
      <h3 class="formtitle" style="color: #f89b1e; font-weight: 800; text-transform: uppercase;">Step 3: Select Payment Method</h3>

      <div class="payment-method-selector" style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 20px;">
        <!-- Option 1: e-Wallets -->
        <label class="payment-opt-box active" id="adoptOptEwallet" onclick="if(window.selectAdoptPaymentMethod) window.selectAdoptPaymentMethod('ewallet');" style="display: flex; align-items: center; justify-content: space-between; padding: 16px; border: 2px solid #f89b1e; border-radius: 12px; background: #fff8f0; cursor: pointer;">
          <div style="display: flex; align-items: center; gap: 12px;">
            <input type="radio" name="adopt_payment_radio" value="ewallet" checked onchange="if(window.selectAdoptPaymentMethod) window.selectAdoptPaymentMethod('ewallet');" style="accent-color: #f89b1e; width: 18px; height: 18px;" />
            <span style="font-weight: 700; color: #111827; font-size: 1rem;">e-Wallets (GCash, Maya, QR Ph)</span>
          </div>
          <span style="font-size: 0.85rem; font-weight: 600; color: #f89b1e;">Scan QR</span>
        </label>

        <!-- Option 2: Bank Transfer -->
        <label class="payment-opt-box" id="adoptOptBank" onclick="if(window.selectAdoptPaymentMethod) window.selectAdoptPaymentMethod('bank');" style="display: flex; align-items: center; justify-content: space-between; padding: 16px; border: 1.5px solid #d1d5db; border-radius: 12px; background: #ffffff; cursor: pointer;">
          <div style="display: flex; align-items: center; gap: 12px;">
            <input type="radio" name="adopt_payment_radio" value="bank" onchange="if(window.selectAdoptPaymentMethod) window.selectAdoptPaymentMethod('bank');" style="accent-color: #f89b1e; width: 18px; height: 18px;" />
            <span style="font-weight: 700; color: #111827; font-size: 1rem;">Bank Deposit / Transfer</span>
          </div>
          <span style="font-size: 0.85rem; font-weight: 600; color: #6b7280;">View Bank Details</span>
        </label>
      </div>

      <!-- Bank Account Details Card (Shown when Bank Deposit / Transfer is selected) -->
      <div class="adopt-bank-details-box" id="adoptBankDetailsBox" style="display: none; background: #ffffff; border: 2px solid #f89b1e; border-radius: 12px; padding: 22px; margin-bottom: 20px; box-shadow: 0 6px 18px rgba(0,0,0,0.06);">
        <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 2px solid #f89b1e; padding-bottom: 12px; margin-bottom: 16px;">
          <div style="display: flex; align-items: center; gap: 10px;">
            <span style="font-size: 1.5rem;">🏛️</span>
            <h4 style="font-size: 1.15rem; font-weight: 800; color: #111827; margin: 0; text-transform: uppercase; letter-spacing: 0.5px;">Bank Transfer Details</h4>
          </div>
          <span style="background: #fff8f0; color: #f89b1e; border: 1px solid #f89b1e; font-size: 0.78rem; font-weight: 800; padding: 4px 10px; border-radius: 20px; text-transform: uppercase;">Official Account</span>
        </div>

        <div style="display: flex; flex-direction: column; gap: 12px; font-size: 0.95rem; text-align: left;">
          <div style="display: flex; justify-content: space-between; align-items: center; background: #f9fafb; padding: 10px 14px; border-radius: 8px; border: 1px solid #e5e7eb;">
            <span style="color: #6b7280; font-weight: 600;">Bank Name:</span>
            <strong style="color: #111827; font-size: 1rem;">BDO Unibank (Bank of the Philippine Islands / BDO)</strong>
          </div>

          <div style="display: flex; justify-content: space-between; align-items: center; background: #f9fafb; padding: 10px 14px; border-radius: 8px; border: 1px solid #e5e7eb;">
            <span style="color: #6b7280; font-weight: 600;">Account Name:</span>
            <strong style="color: #111827; font-size: 1rem;">THE PARC FOUNDATION INC.</strong>
          </div>

          <div style="display: flex; justify-content: space-between; align-items: center; background: #fff8f0; padding: 12px 14px; border-radius: 8px; border: 1.5px solid #f89b1e;">
            <span style="color: #6b7280; font-weight: 700;">Account Number:</span>
            <div style="display: flex; align-items: center; gap: 8px;">
              <strong id="bankAccNoText" style="color: #f89b1e; font-size: 1.15rem; font-weight: 800; letter-spacing: 1px;">0072 6800 5419</strong>
              <button type="button" id="copyBankAccBtn" style="background: #f89b1e; color: #ffffff; border: none; border-radius: 6px; padding: 4px 10px; font-size: 0.78rem; font-weight: 700; cursor: pointer;">Copy</button>
            </div>
          </div>

          <div style="display: flex; justify-content: space-between; align-items: center; background: #f9fafb; padding: 10px 14px; border-radius: 8px; border: 1px solid #e5e7eb;">
            <span style="color: #6b7280; font-weight: 600;">Branch / Location:</span>
            <strong style="color: #111827; font-size: 0.95rem;">San Juan, Metro Manila, Philippines</strong>
          </div>
        </div>

        <div style="margin-top: 16px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 12px 16px; font-size: 0.88rem; color: #15803d; line-height: 1.45; text-align: left; font-weight: 500;">
          💡 <strong>Instructions:</strong> Please transfer or deposit your pledge amount using your bank app or online banking. Once completed, screenshot your deposit slip or receipt and attach it below for validation.
        </div>
      </div>

      <!-- QR & Receipt Box -->
      <div class="notebank" id="adoptNotebank" style="display: block; background-color: #f9fafb; padding: 20px; border-radius: 12px; border: 1px solid #e5e7eb; text-align: center; margin-bottom: 20px;">
        <p style="font-weight: 800; color: #f89b1e; margin-bottom: 12px; font-size: 1.1rem;" id="adoptPaymentBoxTitle">Scan QR Code to Pay</p>
        
        <div id="adoptQrBox" style="display: block;">
          <div style="display: flex; justify-content: center; align-items: center;">
            <img src="{{ asset('assets/image/qr_code.png') }}" alt="PARC Foundation QR Code"
                 style="width: 240px; height: auto; border: 1px solid #e5e7eb; border-radius: 10px; background: #fff; padding: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.06);" />
          </div>
          <p style="margin-top: 14px; font-size: 0.88rem; color: #4b5563; line-height: 1.4;">
            After sending your payment, please screenshot your receipt and attach it below.
          </p>
        </div>

        {{-- Receipt Upload --}}
        <div style="margin-top: 18px; text-align: left;">
          <label for="receipt" style="display: block; font-size: 0.9rem; font-weight: 700; color: #1f2937; margin-bottom: 8px;">
            📎 Attach Receipt Screenshot <span class="req">*required</span>
          </label>
          <input type="file" id="receipt" name="receipt" accept="image/*,.pdf" style="display: none;" onchange="handleReceiptChange(this)" />
          <label for="receipt" id="receipt-label" style="display: flex; align-items: center; gap: 10px; cursor: pointer; background: #fff; border: 2px dashed #f89b1e; border-radius: 10px; padding: 14px 18px; font-size: 0.9rem; color: #4b5563; transition: border-color 0.2s;">
            <span style="font-size: 22px;">🖼️</span>
            <span id="receipt-label-text">Click to upload receipt (JPG, PNG, PDF — max 5MB)</span>
          </label>
          <div id="receipt-preview" style="display: none; margin-top: 12px; text-align: center;">
            <img id="receipt-img-preview" src="" alt="Receipt Preview" style="max-width: 100%; max-height: 200px; border-radius: 8px; border: 1px solid #ccc; box-shadow: 0 2px 6px rgba(0,0,0,0.1);" />
            <p id="receipt-file-name" style="font-size: 0.82rem; color: #4b5563; margin-top: 6px; font-weight: 600;"></p>
            <button type="button" onclick="clearReceipt()" style="margin-top: 4px; background: none; border: none; color: #e11d48; font-size: 0.82rem; cursor: pointer; font-weight: 700;">✕ Remove File</button>
          </div>
          <span class="field-error" id="err-receipt" style="color: #e11d48; font-size: 0.82rem; margin-top: 4px; display: none;">Please attach proof of payment / receipt</span>
        </div>
      </div>

      <div class="step-actions" style="display: flex; gap: 14px; margin-top: 24px;">
        <button type="button" class="btn-step-back" id="btnAdoptBackToStep2" style="flex: 1; padding: 14px; background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; border-radius: 8px; font-weight: 700; cursor: pointer;">
          ← Back
        </button>
        <button type="button" class="btn-step-next active-btn" id="btnAdoptToStep4" style="flex: 2; padding: 14px; background: #f89b1e; color: #ffffff; border: none; border-radius: 8px; font-weight: 800; text-transform: uppercase; cursor: pointer;">
          Review & Confirm →
        </button>
      </div>
    </div>

    <!-- ==================== STEP 4: CONFIRM ==================== -->
    <div class="adopt-step-panel" id="adoptStepPanel4" style="display: none;">
      <h3 class="formtitle" style="color: #f89b1e; font-weight: 800; text-transform: uppercase;">Step 4: Confirm Adoption Details</h3>

      {{-- Final Summary Card --}}
      <div style="background: #ffffff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 22px; margin-bottom: 24px; box-shadow: 0 4px 15px rgba(0,0,0,0.04);">
        <h4 style="font-size: 1.1rem; font-weight: 800; color: #111827; margin-bottom: 16px; border-bottom: 1px solid #f3f4f6; padding-bottom: 10px;">Summary of Your Support</h4>

        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
          <span style="color: #6b7280; font-size: 0.95rem;">Adoption Package:</span>
          <strong id="finalSummaryPkg" style="color: #111827; font-size: 0.95rem;">—</strong>
        </div>

        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
          <span style="color: #6b7280; font-size: 0.95rem;">Pledge Amount:</span>
          <strong id="finalSummaryAmount" style="color: #f89b1e; font-size: 1.1rem; font-weight: 800;">—</strong>
        </div>

        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
          <span style="color: #6b7280; font-size: 0.95rem;">Donor Name:</span>
          <strong id="finalSummaryName" style="color: #111827; font-size: 0.95rem;">—</strong>
        </div>

        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
          <span style="color: #6b7280; font-size: 0.95rem;">Email Address:</span>
          <strong id="finalSummaryEmail" style="color: #111827; font-size: 0.95rem;">—</strong>
        </div>

        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
          <span style="color: #6b7280; font-size: 0.95rem;">Payment Method:</span>
          <strong id="finalSummaryPayment" style="color: #111827; font-size: 0.95rem;">—</strong>
        </div>
      </div>

      <div class="note2" style="margin-bottom: 20px;">
        <p class="p3" style="font-size: 0.85rem; color: #6b7280; line-height: 1.4;">
          By completing this form, you agree to support PARCaralan Scholars. We will keep your information safe and secure in accordance with our Privacy Policy.
        </p>
      </div>

      <div class="step-actions" style="display: flex; gap: 14px;">
        <button type="button" class="btn-step-back" id="btnAdoptBackToStep3" style="flex: 1; padding: 14px; background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; border-radius: 8px; font-weight: 700; cursor: pointer;">
          ← Back
        </button>
        <button type="submit" class="adopt-donate-btn" id="adoptSubmitBtn" style="flex: 2; padding: 16px; background: #f89b1e; color: #ffffff; border: none; border-radius: 8px; font-size: 1.05rem; font-weight: 800; text-transform: uppercase; cursor: pointer; box-shadow: 0 4px 12px rgba(248,155,30,0.3);">
          <span class="btn-text">CONFIRM & ADOPT SCHOLAR</span>
          <span class="btn-spinner" id="adoptBtnSpinner" style="display:none;">
            <svg class="spin-svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
              <circle cx="12" cy="12" r="10" stroke="rgba(255,255,255,0.3)" stroke-width="3"/>
              <path d="M12 2a10 10 0 0110 10" stroke="white" stroke-width="3" stroke-linecap="round"/>
            </svg> Submitting...
          </span>
        </button>
      </div>
    </div>

  </form>
</div>

<!-- ── Adoption Success Popup Modal ── -->
<div class="contact-modal-overlay" id="adoptSuccessModal" style="display: none;">
  <div class="contact-modal-card">
    <div class="contact-modal-icon">
      <svg width="64" height="64" viewBox="0 0 24 24" fill="none">
        <circle cx="12" cy="12" r="11" fill="#22c55e"/>
        <path d="M7 13l3 3 7-7" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>
    <h3 class="contact-modal-title">Adoption Application Received! 🎉</h3>
    <p class="contact-modal-subtitle" id="adoptModalSubtitle">
      Thank you for adopting a scholar! Your pledge has been recorded and our team will get in touch with you shortly with scholar updates.
    </p>
    <button type="button" class="contact-modal-close-btn" id="adoptModalCloseBtn">OK / Return to Home</button>
  </div>
</div>