{{-- Personal Info & Payment Form --}}
<div class="donate-form-wrapper">

  <!-- Stepper Bar Header -->
  <div class="donate-stepper-wrapper" style="width: 100%; padding: 15px 0 25px; margin-bottom: 25px;">
    <div class="donate-stepper" id="donateStepper" style="display: flex; justify-content: space-between; align-items: flex-start; position: relative; width: 100%; max-width: 440px; margin: 0 auto;">
      
      <!-- Track lines -->
      <div class="stepper-track-bg" style="position: absolute; top: 14px; left: 12%; right: 12%; height: 2px; background-color: #e5e7eb; z-index: 1;"></div>
      <div class="stepper-track-fill" id="stepperTrackFill" style="position: absolute; top: 14px; left: 12%; height: 2px; background-color: #ffa200; width: 0%; transition: width 0.35s ease; z-index: 2;"></div>
      
      <!-- Step 1: Amount -->
      <div class="step-item active" data-step="1" id="stepNode1" style="display: flex; flex-direction: column; align-items: center; position: relative; z-index: 3; cursor: pointer; width: 65px;">
        <div class="step-circle" id="stepCircle1" style="width: 28px; height: 28px; border-radius: 50%; background-color: #ffffff; border: 2.5px solid #ffa200; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 0 3px rgba(255, 162, 0, 0.15); transition: all 0.3s ease;">
          <span class="step-icon" id="stepIcon1" style="display: flex; align-items: center; justify-content: center;">
            <svg width="18" height="18" viewBox="0 0 32 32" style="width:18px; height:18px; max-width:18px; max-height:18px; display:block;" fill="none">
              <circle cx="16" cy="16" r="14" stroke="#ffa200" stroke-width="2.5"/>
              <path d="M11 9h6.5a4.5 4.5 0 0 1 0 9H14v6M14 13.5h7" stroke="#ffa200" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <span class="step-check" id="stepCheck1" style="display: none; color: #ffffff; font-weight: bold; font-size: 14px;">✓</span>
        </div>
        <span class="step-label" id="stepLabel1" style="font-size: 0.8rem; font-weight: 700; color: #ffa200; margin-top: 6px; white-space: nowrap;">Amount</span>
      </div>

      <!-- Step 2: My Info -->
      <div class="step-item" data-step="2" id="stepNode2" style="display: flex; flex-direction: column; align-items: center; position: relative; z-index: 3; cursor: pointer; width: 65px;">
        <div class="step-circle" id="stepCircle2" style="width: 28px; height: 28px; border-radius: 50%; background-color: #d1d5db; border: 2.5px solid transparent; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;">
          <span class="step-icon" id="stepIcon2" style="display: none; align-items: center; justify-content: center;">
            <svg width="18" height="18" viewBox="0 0 32 32" style="width:18px; height:18px; max-width:18px; max-height:18px; display:block;" fill="none">
              <circle cx="16" cy="16" r="14" stroke="#ffa200" stroke-width="2.5"/>
              <path d="M11 9h6.5a4.5 4.5 0 0 1 0 9H14v6M14 13.5h7" stroke="#ffa200" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <span class="step-check" id="stepCheck2" style="display: none; color: #ffffff; font-weight: bold; font-size: 14px;">✓</span>
        </div>
        <span class="step-label" id="stepLabel2" style="font-size: 0.8rem; font-weight: 500; color: #6b7280; margin-top: 6px; white-space: nowrap;">My Info</span>
      </div>

      <!-- Step 3: Payment -->
      <div class="step-item" data-step="3" id="stepNode3" style="display: flex; flex-direction: column; align-items: center; position: relative; z-index: 3; cursor: pointer; width: 65px;">
        <div class="step-circle" id="stepCircle3" style="width: 28px; height: 28px; border-radius: 50%; background-color: #d1d5db; border: 2.5px solid transparent; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;">
          <span class="step-icon" id="stepIcon3" style="display: none; align-items: center; justify-content: center;">
            <svg width="18" height="18" viewBox="0 0 32 32" style="width:18px; height:18px; max-width:18px; max-height:18px; display:block;" fill="none">
              <circle cx="16" cy="16" r="14" stroke="#ffa200" stroke-width="2.5"/>
              <path d="M11 9h6.5a4.5 4.5 0 0 1 0 9H14v6M14 13.5h7" stroke="#ffa200" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <span class="step-check" id="stepCheck3" style="display: none; color: #ffffff; font-weight: bold; font-size: 14px;">✓</span>
        </div>
        <span class="step-label" id="stepLabel3" style="font-size: 0.8rem; font-weight: 500; color: #6b7280; margin-top: 6px; white-space: nowrap;">Payment</span>
      </div>

      <!-- Step 4: Confirm -->
      <div class="step-item" data-step="4" id="stepNode4" style="display: flex; flex-direction: column; align-items: center; position: relative; z-index: 3; cursor: pointer; width: 65px;">
        <div class="step-circle" id="stepCircle4" style="width: 28px; height: 28px; border-radius: 50%; background-color: #d1d5db; border: 2.5px solid transparent; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;">
          <span class="step-icon" id="stepIcon4" style="display: none; align-items: center; justify-content: center;">
            <svg width="18" height="18" viewBox="0 0 32 32" style="width:18px; height:18px; max-width:18px; max-height:18px; display:block;" fill="none">
              <circle cx="16" cy="16" r="14" stroke="#ffa200" stroke-width="2.5"/>
              <path d="M11 9h6.5a4.5 4.5 0 0 1 0 9H14v6M14 13.5h7" stroke="#ffa200" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <span class="step-check" id="stepCheck4" style="display: none; color: #ffffff; font-weight: bold; font-size: 14px;">✓</span>
        </div>
        <span class="step-label" id="stepLabel4" style="font-size: 0.8rem; font-weight: 500; color: #6b7280; margin-top: 6px; white-space: nowrap;">Confirm</span>
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
    <div class="step-panel active" id="stepPanel1" style="display: block;">
      <!-- One-time / Monthly Toggle -->
      <div class="center-btn" id="giveTypeBtns" role="group" aria-label="Donation frequency">
        <a href="#" class="btn1" data-give="once" id="giveOnceBtn">Give Once</a>
        <a href="#" class="btn2" data-give="monthly" id="giveMonthlyBtn">Give Monthly</a>
      </div>

      <!-- Note -->
      <div class="note1">
        <p class="p1" id="noteTitle">Thank you for making a difference.</p>
        <p class="p2" id="noteSubtitle">
          Select a giving frequency to support PARCaralan Scholars
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

      <div class="step-actions" style="margin-top: 24px;">
        <button type="button" class="btn-step-next" id="btnToStep2" style="width: 100%; padding: 16px; background: #d1d5db; color: #777777; border: none; border-radius: 8px; font-size: 1.05rem; font-weight: 800; letter-spacing: 0.5px; text-transform: uppercase; cursor: not-allowed; transition: all 0.25s ease;">
          Donate Now
        </button>
      </div>
    </div>

    <!-- ==================== STEP 2: MY INFO ==================== -->
    <div class="step-panel" id="stepPanel2" style="display: none;">
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

      <div class="form-group" style="margin-top: 15px;">
        <label for="phone">Contact Number <span class="req">*</span></label>
        <div style="display: flex; gap: 8px; align-items: center;">
          <select id="country_code" name="country_code" style="width: 110px; padding: 12px 6px; font-size: 0.9rem; border: 1px solid #d1d5db; border-radius: 8px; background-color: #ffffff; color: #1f2937; outline: none; cursor: pointer;">
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
          <input type="tel" id="phone" name="phone" placeholder="905 123 4567 *" required style="flex: 1; padding: 12px 14px; font-size: 0.95rem; border: 1px solid #d1d5db; border-radius: 8px; outline: none;" />
        </div>
        <span class="field-error" id="err-phone"></span>
      </div>

      {{-- Address Section (Optional) --}}
      <h4 style="font-size: 0.95rem; font-weight: 700; color: #4b5563; margin: 20px 0 12px; border-bottom: 1px solid #e5e7eb; padding-bottom: 6px;">
        My Address <span style="font-size: 0.8rem; font-weight: 400; color: #888;">(Optional)</span>
      </h4>

      <div class="form-row">
        <div class="form-group">
          <label for="country">Country</label>
          <select id="country" name="country" class="form-select-custom" style="width: 100%; padding: 12px 14px; font-size: 0.95rem; border: 1px solid #d1d5db; border-radius: 8px; background-color: #ffffff; color: #1f2937; outline: none; cursor: pointer;">
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

        <div class="form-group">
          <label for="province">Province / Region</label>
          <select id="province" name="province" class="form-select-custom" style="width: 100%; padding: 12px 14px; font-size: 0.95rem; border: 1px solid #d1d5db; border-radius: 8px; background-color: #ffffff; color: #1f2937; outline: none; cursor: pointer;">
            <option value="" disabled selected>Select Province / Region</option>
            <option value="Metro Manila">Metro Manila (NCR)</option>
            <option value="Abra">Abra</option>
            <option value="Agusan del Norte">Agusan del Norte</option>
            <option value="Agusan del Sur">Agusan del Sur</option>
            <option value="Aklan">Aklan</option>
            <option value="Albay">Albay</option>
            <option value="Antique">Antique</option>
            <option value="Apayao">Apayao</option>
            <option value="Aurora">Aurora</option>
            <option value="Basilan">Basilan</option>
            <option value="Bataan">Bataan</option>
            <option value="Batanes">Batanes</option>
            <option value="Batangas">Batangas</option>
            <option value="Benguet">Benguet</option>
            <option value="Biliran">Biliran</option>
            <option value="Bohol">Bohol</option>
            <option value="Bukidnon">Bukidnon</option>
            <option value="Bulacan">Bulacan</option>
            <option value="Cagayan">Cagayan</option>
            <option value="Camarines Norte">Camarines Norte</option>
            <option value="Camarines Sur">Camarines Sur</option>
            <option value="Camiguin">Camiguin</option>
            <option value="Capiz">Capiz</option>
            <option value="Catanduanes">Catanduanes</option>
            <option value="Cavite">Cavite</option>
            <option value="Cebu">Cebu</option>
            <option value="Cotabato">Cotabato</option>
            <option value="Davao de Oro">Davao de Oro</option>
            <option value="Davao del Norte">Davao del Norte</option>
            <option value="Davao del Sur">Davao del Sur</option>
            <option value="Davao Occidental">Davao Occidental</option>
            <option value="Davao Oriental">Davao Oriental</option>
            <option value="Dinagat Islands">Dinagat Islands</option>
            <option value="Eastern Samar">Eastern Samar</option>
            <option value="Guimaras">Guimaras</option>
            <option value="Ifugao">Ifugao</option>
            <option value="Ilocos Norte">Ilocos Norte</option>
            <option value="Ilocos Sur">Ilocos Sur</option>
            <option value="Iloilo">Iloilo</option>
            <option value="Isabela">Isabela</option>
            <option value="Kalinga">Kalinga</option>
            <option value="La Union">La Union</option>
            <option value="Laguna">Laguna</option>
            <option value="Lanao del Norte">Lanao del Norte</option>
            <option value="Lanao del Sur">Lanao del Sur</option>
            <option value="Leyte">Leyte</option>
            <option value="Maguindanao">Maguindanao</option>
            <option value="Marinduque">Marinduque</option>
            <option value="Masbate">Masbate</option>
            <option value="Misamis Occidental">Misamis Occidental</option>
            <option value="Misamis Oriental">Misamis Oriental</option>
            <option value="Mountain Province">Mountain Province</option>
            <option value="Negros Occidental">Negros Occidental</option>
            <option value="Negros Oriental">Negros Oriental</option>
            <option value="Northern Samar">Northern Samar</option>
            <option value="Nueva Ecija">Nueva Ecija</option>
            <option value="Nueva Vizcaya">Nueva Vizcaya</option>
            <option value="Occidental Mindoro">Occidental Mindoro</option>
            <option value="Oriental Mindoro">Oriental Mindoro</option>
            <option value="Palawan">Palawan</option>
            <option value="Pampanga">Pampanga</option>
            <option value="Pangasinan">Pangasinan</option>
            <option value="Quezon">Quezon</option>
            <option value="Quirino">Quirino</option>
            <option value="Rizal">Rizal</option>
            <option value="Romblon">Romblon</option>
            <option value="Samar">Samar</option>
            <option value="Sarangani">Sarangani</option>
            <option value="Siquijor">Siquijor</option>
            <option value="Sorsogon">Sorsogon</option>
            <option value="South Cotabato">South Cotabato</option>
            <option value="Southern Leyte">Southern Leyte</option>
            <option value="Sultan Kudarat">Sultan Kudarat</option>
            <option value="Sulu">Sulu</option>
            <option value="Surigao del Norte">Surigao del Norte</option>
            <option value="Surigao del Sur">Surigao del Sur</option>
            <option value="Tarlac">Tarlac</option>
            <option value="Tawi-Tawi">Tawi-Tawi</option>
            <option value="Zambales">Zambales</option>
            <option value="Zamboanga del Norte">Zamboanga del Norte</option>
            <option value="Zamboanga del Sur">Zamboanga del Sur</option>
            <option value="Zamboanga Sibugay">Zamboanga Sibugay</option>
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="citySelect">City / Municipality</label>
          <select id="citySelect" name="city" class="form-select-custom" style="width: 100%; padding: 12px 14px; font-size: 0.95rem; border: 1px solid #d1d5db; border-radius: 8px; background-color: #ffffff; color: #1f2937; outline: none; cursor: pointer;">
            <option value="" disabled selected>Provinced</option>
          </select>
          <input type="text" id="cityCustom" name="city_custom" placeholder="Type city/municipality name" style="display: none; margin-top: 8px;" />
        </div>
        <div class="form-group">
          <label for="barangaySelect">Barangay</label>
          <select id="barangaySelect" name="barangay" class="form-select-custom" style="width: 100%; padding: 12px 14px; font-size: 0.95rem; border: 1px solid #d1d5db; border-radius: 8px; background-color: #ffffff; color: #1f2937; outline: none; cursor: pointer;">
            <option value="" disabled selected>City</option>
          </select>
          <input type="text" id="barangayCustom" name="barangay_custom" placeholder="Type barangay name" style="display: none; margin-top: 8px;" />
        </div>
      </div>

      <div class="form-row">
        <div class="form-group" style="flex: 2;">
          <label for="street">Street Address</label>
          <input type="text" id="street" name="street" placeholder="House No., Building, Street Name" />
        </div>
        <div class="form-group" style="flex: 1;">
          <label for="postal">Postal Code</label>
          <input type="text" id="postal" name="postal" placeholder="e.g. 1000" />
        </div>
      </div>

      {{-- Privacy note --}}
      <div class="note2">
        <p class="p3">We will keep your information safe and secure. Please see our <b class="privacy">Privacy Policy</b> for details.</p>
      </div>

      <div class="step-actions" style="display: flex; gap: 12px; margin-top: 24px;">
        <button type="button" class="btn-step-back" id="btnBackToStep1" style="padding: 14px 20px; background: #f3f4f6; color: #4b5563; border: 1.5px solid #d1d5db; border-radius: 8px; font-weight: 600; cursor: pointer;">← Back</button>
        <button type="button" class="btn-step-next" id="btnToStep3" style="flex: 1; padding: 14px 20px; background: #f89b1e; color: #ffffff; border: none; border-radius: 8px; font-weight: 800; font-size: 1rem; text-transform: uppercase; cursor: pointer;">
          Continue
        </button>
      </div>
    </div>

    <!-- ==================== STEP 3: PAYMENT ==================== -->
    <div class="step-panel" id="stepPanel3" style="display: none;">
      
      <!-- Dynamic Payment Summary Pill Banner -->
      <div class="payment-summary-banner" style="background: linear-gradient(135deg, #f89b1e 0%, #ffa200 100%); color: #ffffff; border-radius: 14px; padding: 20px 15px; text-align: center; margin-bottom: 22px; box-shadow: 0 6px 18px rgba(248, 155, 30, 0.3);">
        <div style="font-size: 2.2rem; font-weight: 900; letter-spacing: -0.5px; line-height: 1.2;">
          <span id="paymentSummaryAmount">₱1,000</span>
        </div>
        <div id="paymentSummaryType" style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; opacity: 0.95; margin-top: 4px;">
          MONTHLY DONATION
        </div>
      </div>

      <!-- Sub-heading instructions -->
      <p style="text-align: center; font-size: 1.05rem; font-weight: 700; color: #1f2937; margin-bottom: 18px;">
        Please select your mode of payment
      </p>

      <!-- Payment Mode Selector Options -->
      <div style="display: flex; flex-direction: column; gap: 14px; align-items: center;">
        
        <!-- Credit / Debit Card Option (Primary Active Button) -->
        <button type="button" id="btn-pay-card" class="payment-mode-btn active" style="width: 100%; max-width: 380px; padding: 14px 20px; background: linear-gradient(135deg, #ffa200 0%, #f89b1e 100%); color: #ffffff; border: 2px solid #f89b1e; border-radius: 30px; font-size: 1.05rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; box-shadow: 0 4px 14px rgba(255, 162, 0, 0.4); transition: all 0.25s ease;">
          <span style="font-size: 1.3rem;">💳</span>
          <span>CREDIT / DEBIT CARD</span>
        </button>

        <!-- Feature Info Box (Card Benefits Note with Avatar) -->
        <div id="cardInfoBox" class="card-info-box" style="width: 100%; max-width: 380px; border: 2px dashed #f89b1e; border-radius: 12px; padding: 16px; display: flex; align-items: center; gap: 14px; background: #fff7ed;">
          <div style="width: 68px; height: 68px; min-width: 68px; border-radius: 50%; overflow: hidden; border: 2px solid #f89b1e; box-shadow: 0 3px 8px rgba(0,0,0,0.15); background: #ffffff;">
            <img src="{{ asset('assets/image/groupart.png') }}" alt="PARC Children" style="width: 100%; height: 100%; object-fit: cover;" />
          </div>
          <p style="font-size: 0.85rem; line-height: 1.35; color: #374151; font-weight: 500; margin: 0; text-align: left;">
            Donations via credit/debit cards provide a more stable and secure way to manage your support to children in need.
          </p>
        </div>

        <!-- e-Wallets Payment Option (Matches Image Reference) -->
        <div class="ewallet-dropdown-wrapper" style="width: 100%; max-width: 380px;">
          <!-- e-Wallets Toggle Button -->
          <button type="button" id="btn-pay-others" class="payment-mode-btn ewallet-toggle-btn" style="width: 100%; padding: 14px 20px; background: #ffffff; color: #1f2937; border: 2px solid #f89b1e; border-radius: 14px; font-size: 1.1rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; cursor: pointer; display: flex; align-items: center; justify-content: space-between; gap: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.06); transition: all 0.25s ease;">
            <div style="display: flex; align-items: center; gap: 10px;">
              <svg width="24" height="20" viewBox="0 0 32 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 7.5A2.5 2.5 0 0 1 4.5 5h23A2.5 2.5 0 0 1 30 7.5v13a2.5 2.5 0 0 1-2.5 2.5h-23A2.5 2.5 0 0 1 2 20.5v-13z" stroke="currentColor" stroke-width="2.5"/>
                <path d="M7 5V3.5A2.5 2.5 0 0 1 9.5 1h13A2.5 2.5 0 0 1 25 3.5V5" stroke="currentColor" stroke-width="2.5"/>
                <circle cx="22" cy="14" r="2" fill="currentColor"/>
              </svg>
              <span id="ewalletBtnTitle">e-Wallets</span>
            </div>
            <span class="ewallet-caret" style="display: flex; align-items: center; transition: transform 0.3s ease;">
              <svg width="14" height="10" viewBox="0 0 14 10" fill="currentColor">
                <path d="M7 10L0 0h14L7 10z"/>
              </svg>
            </span>
          </button>

          <!-- e-Wallets Dropdown Menu (Matches Image Reference 2) -->
          <div id="ewalletDropdownMenu" class="ewallet-dropdown-menu" style="display: none; width: 100%; background: #ffffff; border: 2px solid #f89b1e; border-top: none; border-radius: 0 0 14px 14px; margin-top: -2px; box-shadow: 0 8px 20px rgba(0,0,0,0.12); overflow: hidden;">
            <div style="padding: 6px 0;">
              
              <!-- GCash -->
              <div class="ewallet-item selected" data-wallet="gcash" title="GCash" style="padding: 20px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background 0.2s; position: relative;">
                <img src="{{ asset('assets/icons/GCASH.png') }}" alt="GCash Logo" style="height: 56px; width: auto; max-width: 220px; object-fit: contain;" />
                <span class="ewallet-check" style="width: 28px; height: 28px; border-radius: 50%; background: #22c55e; color: #ffffff; font-size: 14px; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(34, 197, 94, 0.4); position: absolute; right: 20px;"><i class="fa-solid fa-check"></i></span>
              </div>

              <div class="ewallet-divider"></div>

              <!-- Maya -->
              <div class="ewallet-item" data-wallet="maya" title="Maya" style="padding: 20px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background 0.2s; position: relative;">
                <img src="{{ asset('assets/icons/MAYA.png') }}" alt="Maya Logo" style="height: 52px; width: auto; max-width: 200px; object-fit: contain;" />
                <span class="ewallet-check" style="width: 28px; height: 28px; border-radius: 50%; background: #22c55e; color: #ffffff; font-size: 14px; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(34, 197, 94, 0.4); position: absolute; right: 20px;"><i class="fa-solid fa-check"></i></span>
              </div>

            </div>
          </div>
        </div>

      </div>

      <!-- Bank Transfer / QR Code Details (Shown when e-Wallets is selected) -->
      <div class="notebank" id="notebank" style="display: none; background-color: #ffffff; padding: 22px; margin-top: 20px; border-radius: 12px; border: 2px solid #f89b1e; text-align: center; box-shadow: 0 6px 18px rgba(0,0,0,0.08);">
        <p style="font-weight: 800; color: #f89b1e; font-size: 1.1rem; margin-bottom: 15px;">Scan QR Code to Pay via e-Wallet (GCash, Maya, etc.)</p>
        
        <div style="display: flex; justify-content: center; align-items: center;">
          <img src="{{ asset('assets/image/qr_code.png') }}" alt="PARC Foundation QR Code" style="width: 240px; height: auto; border: 1px solid #ccc; border-radius: 8px; background: #fff; padding: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);" />
        </div>
        <p style="margin-top: 15px; font-size: 14px; color: #4b5563; font-weight: 700;">1.OPEN THE SELECTED APP FIRST, BEFORE SCANNING.</p>

        <p style="margin-top: 15px; font-size: 14px; color: #4b5563; font-weight: 700;">2. After scanning, please screenshot your receipt and attach it below.</p>

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
          <label for="receipt" id="receipt-label" style="display: flex; align-items: center; gap: 10px; cursor: pointer; background: #fff; border: 2px dashed #f89b1e; border-radius: 8px; padding: 14px 18px; font-size: 13px; color: #666; transition: border-color 0.2s;">
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

      <!-- Gateway Disclaimer Note -->
      <p style="font-size: 0.8rem; line-height: 1.4; color: #000000ff; margin: 22px 0 10px; text-align: center; font-style: italic;">
        *Upon clicking "Continue", you will be redirected to our partner's secure payment gateway. Do not close or refresh the page.
      </p>

      <div class="step-actions" style="display: flex; gap: 12px; margin-top: 20px;">
        <button type="button" class="btn-step-back" id="btnBackToStep2" style="padding: 14px 20px; background: #f3f4f6; color: #4b5563; border: 1.5px solid #d1d5db; border-radius: 8px; font-weight: 600; cursor: pointer;">← Back</button>
        <button type="button" class="btn-step-next" id="btnToStep4" style="flex: 1; padding: 14px 20px; background: #f89b1e; color: #ffffff; border: none; border-radius: 8px; font-weight: 800; font-size: 1rem; text-transform: uppercase; cursor: pointer;">
          Continue
        </button>
      </div>
    </div>

    <!-- ==================== STEP 4: CONFIRM ==================== -->
    <div class="step-panel" id="stepPanel4" style="display: none;">
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
          <span class="summary-value" id="sumPaymentMethod">e-Wallet (GCash / Maya)</span>
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

      <div class="step-actions" style="display: flex; gap: 12px; margin-top: 24px;">
        <button type="button" class="btn-step-back" id="btnBackToStep3" style="padding: 14px 20px; background: #f3f4f6; color: #4b5563; border: 1.5px solid #d1d5db; border-radius: 8px; font-weight: 600; cursor: pointer;">← Edit Details</button>
        {{-- DONATE SUBMIT BUTTON --}}
        <button type="submit" class="btn-donate-submit" id="donateSubmitBtn" style="flex: 1; border:none; background: #f89b1e; color: #ffffff; padding: 16px; border-radius: 8px; font-weight: 800; font-size: 1rem; text-transform: uppercase; cursor: pointer;">
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

    <div class="modal-actions-wrap" style="display: flex; flex-direction: column; gap: 10px; margin-top: 22px; width: 100%;">
      <a id="downloadReceiptBtn" href="#" target="_blank" class="btn-download-receipt" style="display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; padding: 14px 18px; background: #f89b1e; color: #ffffff; border: none; border-radius: 8px; font-weight: 700; font-size: 0.95rem; text-decoration: none; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 4px 12px rgba(248,155,30,0.25);">
        <i class="fa-solid fa-download"></i> Download Official Receipt
      </a>
      <button type="button" class="modal-close-btn" id="modalCloseBtn" style="width: 100%; padding: 12px; background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; border-radius: 8px; font-weight: 600; font-size: 0.9rem; cursor: pointer;">
        Close
      </button>
    </div>
  </div>
</div>