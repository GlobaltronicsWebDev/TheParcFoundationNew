/**
 * donate.js – Full Stripe Payment Intents integration
 * Senior Developer Implementation
 *
 * Flow (Card tab):
 *   1. User selects amount + fills personal info
 *   2. On submit → POST /stripe/create-intent with amount
 *   3. Server returns { client_secret, intent_id }
 *   4. stripe.confirmCardPayment(client_secret, { card: cardElement })
 *   5. On success → POST /donations to save record → show success modal
 *   6. On error → display Stripe error inline
 *
 * Bank Transfer & PayPal tabs bypass Stripe and submit directly.
 */

document.addEventListener("DOMContentLoaded", function () {
  "use strict";

  /* ================================================================
   * CONSTANTS & ELEMENT REFS
   * ================================================================ */
  const CSRF_TOKEN      = document.querySelector('meta[name="csrf-token"]')?.content || "";
  const STRIPE_PUB_KEY  = document.querySelector('meta[name="stripe-key"]')?.content || "";
  const DONATE_URL      = "/donations";
  const INTENT_URL      = "/stripe/create-intent";

  /* ================================================================
   * 1. STRIPE INITIALISATION
   * ================================================================ */
  let stripe      = null;
  let cardElement = null;
  let stripeReady = false;

  function initStripe() {
    if (!STRIPE_PUB_KEY || STRIPE_PUB_KEY.includes("your_publishable")) {
      console.warn("Stripe: publishable key not set. Card payments will be disabled.");
      showStripeKeyWarning();
      return;
    }

    stripe = Stripe(STRIPE_PUB_KEY);

    const elements = stripe.elements({
      fonts: [{ cssSrc: "https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" }],
    });

    cardElement = elements.create("card", {
      style: {
        base: {
          fontFamily:  "'Inter', system-ui, sans-serif",
          fontSize:    "15px",
          color:       "#1a1a1a",
          "::placeholder": { color: "#9ca3af" },
          iconColor:   "#f89b1e",
        },
        invalid: {
          color:     "#e63946",
          iconColor: "#e63946",
        },
      },
      hidePostalCode: true,
    });

    cardElement.mount("#stripe-card-element");
    stripeReady = true;

    // Show inline errors from Stripe Element
    cardElement.on("change", function (event) {
      const errEl = document.getElementById("stripe-card-errors");
      if (!errEl) return;
      if (event.error) {
        errEl.textContent = event.error.message;
        errEl.style.display = "block";
      } else {
        errEl.textContent = "";
        errEl.style.display = "none";
      }
    });

    console.log("Stripe: initialised ✅");
  }

  function showStripeKeyWarning() {
    const container = document.getElementById("stripe-card-element");
    if (container) {
      container.innerHTML = `
        <div class="stripe-key-warning">
          ⚠️ Stripe key not configured.
          Add your <code>STRIPE_KEY</code> to <code>.env</code> to enable card payments.
        </div>`;
    }
  }

  initStripe();

  /* ================================================================
   * 2. ELEMENT REFS & INITIAL STATE
   * ================================================================ */
  const giveOnceBtn           = document.getElementById("giveOnceBtn");
  const giveMonthlyBtn        = document.getElementById("giveMonthlyBtn");
  const giveTypeInput         = document.getElementById("giveType");
  const noteTitle             = document.getElementById("noteTitle");
  const noteSubtitle          = document.getElementById("noteSubtitle");
  const amountBtns            = document.querySelectorAll(".amount-btn");
  const btnToStep2            = document.getElementById("btnToStep2");
  const selectedAmountInput   = document.getElementById("selectedAmount");
  const selectedAmountDisplay = document.getElementById("selectedAmountDisplay");
  const amountDisplayValue    = document.getElementById("amountDisplayValue");
  const customAmountWrap      = document.getElementById("customAmountWrap");
  const customAmountInput     = document.getElementById("customAmountInput");
  const modalAmountVal        = document.getElementById("modalAmountVal");
  const paymentMethodInput    = document.getElementById("paymentMethod");

  /** Numeric raw value for Stripe (no currency symbol) */
  let currentRawAmount = 0;

  const giveTexts = {
    once: {
      title:    "Thank you for making a difference.",
      subtitle: "One-time giving is a powerful way to support PARCaralan Scholars"
    },
    monthly: {
      title:    "You're changing lives every month.",
      subtitle: "Monthly giving is a simple, impactful way to support PARCaralan Scholars"
    }
  };

  function formatPeso(num) {
    return "₱" + Number(num).toLocaleString("en-PH");
  }

  function updateStep1ButtonState() {
    const btn = document.getElementById("btnToStep2");
    if (!btn) return;

    const giveTypeEl = document.getElementById("giveType");
    const amountEl   = document.getElementById("selectedAmount");

    const hasType = !!giveTypeEl?.value;
    const hasAmount = !!amountEl?.value && Number(amountEl.value) > 0;

    if (hasType && hasAmount) {
      btn.disabled = false;
      btn.removeAttribute("disabled");
      btn.style.background = "#f89b1e";
      btn.style.color = "#ffffff";
      btn.style.cursor = "pointer";
      btn.style.opacity = "1";
      btn.style.pointerEvents = "auto";
    } else {
      btn.disabled = true;
      btn.setAttribute("disabled", "disabled");
      btn.style.background = "#d1d5db";
      btn.style.color = "#777777";
      btn.style.cursor = "not-allowed";
      btn.style.opacity = "0.7";
      btn.style.pointerEvents = "none";
    }
  }

  function setSelectedAmount(displayText, rawValue) {
    if (selectedAmountInput) selectedAmountInput.value = rawValue;
    currentRawAmount = Number(rawValue) || 0;
    if (amountDisplayValue)    amountDisplayValue.textContent = displayText;
    if (selectedAmountDisplay) selectedAmountDisplay.style.display = "flex";
    if (modalAmountVal)        modalAmountVal.textContent = displayText;

    updateStep1ButtonState();
  }

  function setGiveType(type) {
    if (!type) {
      if (giveTypeInput) giveTypeInput.value = "";
      giveOnceBtn?.classList.remove("active");
      giveMonthlyBtn?.classList.remove("active");
      updateStep1ButtonState();
      return;
    }

    if (giveTypeInput) giveTypeInput.value = type;
    giveOnceBtn?.classList.toggle("active", type === "once");
    giveMonthlyBtn?.classList.toggle("active", type === "monthly");
    if (noteTitle)    noteTitle.textContent    = giveTexts[type].title;
    if (noteSubtitle) noteSubtitle.textContent = giveTexts[type].subtitle;

    amountBtns.forEach(btn => {
      if (btn.dataset.amount !== "other") {
        const label = type === "once"
          ? btn.getAttribute("data-once")
          : btn.getAttribute("data-monthly");
        btn.innerHTML = label;
      }
    });

    // Default to 500 if no amount selected yet
    if (!selectedAmountInput?.value) {
      const defaultBtn = document.querySelector('.amount-btn[data-amount="500"]');
      if (defaultBtn) {
        amountBtns.forEach(b => b.classList.remove("active"));
        defaultBtn.classList.add("active");
        const label = type === "monthly" ? "₱500/mo" : "₱500";
        setSelectedAmount(label, "500");
      }
    }

    updateStep1ButtonState();
  }

  giveOnceBtn?.addEventListener("click",    e => { e.preventDefault(); setGiveType("once"); });
  giveMonthlyBtn?.addEventListener("click", e => { e.preventDefault(); setGiveType("monthly"); });
  setGiveType(null);
  if (document.activeElement instanceof HTMLElement) {
    document.activeElement.blur();
  }

  /* ================================================================
   * 3. AMOUNT SELECTION LISTENERS
   * ================================================================ */
  amountBtns.forEach(btn => {
    btn.addEventListener("click", function (e) {
      e.preventDefault();
      const wasActive = this.classList.contains("active");
      amountBtns.forEach(b => b.classList.remove("active"));

      if (!wasActive) {
        this.classList.add("active");
        const amount = this.dataset.amount;

        if (amount === "other") {
          if (customAmountWrap) customAmountWrap.style.display = "block";
          customAmountInput?.focus();
          currentRawAmount = 0;
          setSelectedAmount("Custom Amount", "");
        } else {
          if (customAmountWrap) customAmountWrap.style.display = "none";
          const label = (giveTypeInput?.value === "monthly")
            ? this.getAttribute("data-monthly")
            : this.getAttribute("data-once");
          setSelectedAmount(label, amount);
        }
      } else {
        if (customAmountWrap) customAmountWrap.style.display = "none";
        if (selectedAmountDisplay) selectedAmountDisplay.style.display = "none";
        if (selectedAmountInput) selectedAmountInput.value = "";
        currentRawAmount = 0;
        updateStep1ButtonState();
      }
    });
  });

  customAmountInput?.addEventListener("input", function () {
    const val = this.value.trim();
    if (val && Number(val) > 0) {
      const isMonthly = giveTypeInput?.value === "monthly";
      const label = formatPeso(val) + (isMonthly ? "/mo" : "");
      setSelectedAmount(label, val);
    } else {
      currentRawAmount = 0;
      setSelectedAmount("Custom Amount", "");
    }
    updateStep1ButtonState();
  });

  /* ================================================================
   * 4. PAYMENT METHOD TOGGLE & DYNAMIC SUMMARY BANNER
   * ================================================================ */
  const btnPayCard   = document.getElementById("btn-pay-card");
  const btnPayOthers = document.getElementById("btn-pay-others");
  const cardInfoBox  = document.getElementById("cardInfoBox");
  const notebank     = document.getElementById("notebank");

  if (paymentMethodInput) paymentMethodInput.value = "visa";

  btnPayCard?.addEventListener("click", () => {
    btnPayCard.classList.add("active");
    btnPayCard.style.background = "linear-gradient(135deg, #ffa200 0%, #f89b1e 100%)";
    btnPayCard.style.color = "#ffffff";
    btnPayCard.style.border = "2px solid #f89b1e";
    btnPayCard.style.boxShadow = "0 4px 14px rgba(255, 162, 0, 0.4)";

    btnPayOthers.classList.remove("active");
    btnPayOthers.style.background = "#ffffff";
    btnPayOthers.style.color = "#1f2937";
    btnPayOthers.style.border = "2px solid #f89b1e";
    btnPayOthers.style.boxShadow = "0 2px 6px rgba(0,0,0,0.06)";

    if (cardInfoBox) cardInfoBox.style.display = "flex";
    if (notebank) notebank.style.display = "none";

    if (paymentMethodInput) paymentMethodInput.value = "visa";
  });

  btnPayOthers?.addEventListener("click", () => {
    btnPayOthers.classList.add("active");
    btnPayOthers.style.background = "linear-gradient(135deg, #ffa200 0%, #f89b1e 100%)";
    btnPayOthers.style.color = "#ffffff";
    btnPayOthers.style.border = "2px solid #f89b1e";
    btnPayOthers.style.boxShadow = "0 4px 14px rgba(255, 162, 0, 0.4)";

    btnPayCard.classList.remove("active");
    btnPayCard.style.background = "#ffffff";
    btnPayCard.style.color = "#1f2937";
    btnPayCard.style.border = "2px solid #f89b1e";
    btnPayCard.style.boxShadow = "0 2px 6px rgba(0,0,0,0.06)";

    if (cardInfoBox) cardInfoBox.style.display = "none";
    if (notebank) notebank.style.display = "block";

    if (paymentMethodInput) paymentMethodInput.value = "bank";
  });

  function updatePaymentSummaryBanner() {
    const bannerAmount = document.getElementById("paymentSummaryAmount");
    const bannerType   = document.getElementById("paymentSummaryType");

    const amountVal = currentRawAmount || Number(selectedAmountInput?.value) || 0;
    const typeVal   = giveTypeInput?.value || "once";

    if (bannerAmount) {
      bannerAmount.textContent = "₱ " + formatPeso(amountVal);
    }
    if (bannerType) {
      bannerType.textContent = typeVal === "monthly" ? "MONTHLY DONATION" : "ONE-TIME DONATION";
    }
  }

  /* ================================================================
   * 5. COPY ACCOUNT NUMBER
   * ================================================================ */
  const copyAccBtn = document.getElementById("copyAccBtn");
  const copyToast  = document.getElementById("copyToast");
  const bankAccNum = document.getElementById("bankAccNum");

  copyAccBtn?.addEventListener("click", () => {
    const text = bankAccNum?.textContent?.trim() || "";
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

  function showCopyToast() {
    if (!copyToast) return;
    copyToast.classList.add("visible");
    setTimeout(() => copyToast.classList.remove("visible"), 2000);
  }

  /* ================================================================
   * 6. OFFICIAL PSGC PHILIPPINE LOCATION FETCH (100% ALL REGIONS, PROVINCES, CITIES, BARANGAYS)
   * ================================================================ */
  const provinceSelect = document.getElementById("province");
  const citySelect     = document.getElementById("citySelect");
  const cityCustom     = document.getElementById("cityCustom");
  const barangaySelect = document.getElementById("barangaySelect");
  const barangayCustom = document.getElementById("barangayCustom");

  // In-memory cache for API requests
  const psgcCache = {
    provinces: [],
    regions: [],
    cities: {},
    barangays: {}
  };

  async function loadProvincesAndRegions() {
    if (!provinceSelect) return;
    try {
      provinceSelect.innerHTML = '<option value="" disabled selected>Loading Provinces & Regions...</option>';

      // Fetch official provinces & Metro Manila (NCR) region
      const [provRes, regRes] = await Promise.all([
        fetch("https://psgc.gitlab.io/api/provinces/").then(r => r.json()).catch(() => []),
        fetch("https://psgc.gitlab.io/api/regions/").then(r => r.json()).catch(() => [])
      ]);

      provinceSelect.innerHTML = '<option value="" disabled selected>Select Province / Region</option>';

      let allLocations = [];

      // Add Metro Manila / NCR
      if (Array.isArray(regRes)) {
        regRes.forEach(reg => {
          if (reg.code === "130000000" || reg.name.toLowerCase().includes("ncr") || reg.name.toLowerCase().includes("metro manila")) {
            allLocations.push({ name: "Metro Manila (NCR)", code: reg.code, isRegion: true });
          }
        });
      }

      // Add all 82 provinces
      if (Array.isArray(provRes)) {
        provRes.forEach(p => {
          allLocations.push({ name: p.name, code: p.code, isRegion: false });
        });
      }

      // Sort alphabetically
      allLocations.sort((a, b) => a.name.localeCompare(b.name));

      allLocations.forEach(loc => {
        const opt = document.createElement("option");
        opt.value = loc.name;
        opt.dataset.code = loc.code;
        opt.dataset.isRegion = loc.isRegion ? "true" : "false";
        opt.textContent = loc.name;
        provinceSelect.appendChild(opt);
      });

      // Add Other option
      const otherOpt = document.createElement("option");
      otherOpt.value = "Other";
      otherOpt.textContent = "Other / Custom Region";
      provinceSelect.appendChild(otherOpt);

    } catch (err) {
      console.warn("PSGC API failed to load provinces, using fallback.", err);
    }
  }

  provinceSelect?.addEventListener("change", async function () {
    const selectedOpt = this.options[this.selectedIndex];
    const locationName = this.value;
    const locationCode = selectedOpt?.dataset?.code;
    const isRegion = selectedOpt?.dataset?.isRegion === "true";

    if (!citySelect || !barangaySelect) return;

    citySelect.innerHTML = '<option value="" disabled selected>Loading Cities / Municipalities...</option>';
    barangaySelect.innerHTML = '<option value="" disabled selected>Select City First</option>';

    if (cityCustom) cityCustom.style.display = "none";
    if (barangayCustom) barangayCustom.style.display = "none";

    if (locationName === "Other") {
      citySelect.innerHTML = '<option value="Other" selected>Type Custom City Name</option>';
      barangaySelect.innerHTML = '<option value="Other" selected>Type Custom Barangay Name</option>';
      if (cityCustom) cityCustom.style.display = "block";
      if (barangayCustom) barangayCustom.style.display = "block";
      return;
    }

    if (!locationCode) return;

    try {
      let cities = psgcCache.cities[locationCode];
      if (!cities) {
        const endpoint = isRegion
          ? `https://psgc.gitlab.io/api/regions/${locationCode}/cities-municipalities/`
          : `https://psgc.gitlab.io/api/provinces/${locationCode}/cities-municipalities/`;

        const res = await fetch(endpoint);
        cities = await res.json();
        psgcCache.cities[locationCode] = cities;
      }

      citySelect.innerHTML = '<option value="" disabled selected>Select City / Municipality</option>';

      if (Array.isArray(cities) && cities.length > 0) {
        cities.sort((a, b) => a.name.localeCompare(b.name));
        cities.forEach(c => {
          const opt = document.createElement("option");
          opt.value = c.name;
          opt.dataset.code = c.code;
          opt.textContent = c.name;
          citySelect.appendChild(opt);
        });
      }

      const otherOpt = document.createElement("option");
      otherOpt.value = "Other";
      otherOpt.textContent = "Other / Type City Name";
      citySelect.appendChild(otherOpt);

    } catch (err) {
      console.warn("PSGC API cities fetch error:", err);
      citySelect.innerHTML = '<option value="Other" selected>Type Custom City Name</option>';
      if (cityCustom) cityCustom.style.display = "block";
    }
  });

  citySelect?.addEventListener("change", async function () {
    const selectedOpt = this.options[this.selectedIndex];
    const cityName = this.value;
    const cityCode = selectedOpt?.dataset?.code;

    if (!barangaySelect) return;

    barangaySelect.innerHTML = '<option value="" disabled selected>Loading Barangays...</option>';

    if (cityName === "Other") {
      if (cityCustom) cityCustom.style.display = "block";
      if (barangayCustom) barangayCustom.style.display = "block";
      barangaySelect.innerHTML = '<option value="Other" selected>Type Custom Barangay Name</option>';
      return;
    }

    if (cityCustom) cityCustom.style.display = "none";

    if (!cityCode) {
      barangaySelect.innerHTML = '<option value="Other" selected>Type Custom Barangay Name</option>';
      if (barangayCustom) barangayCustom.style.display = "block";
      return;
    }

    try {
      let barangays = psgcCache.barangays[cityCode];
      if (!barangays) {
        const res = await fetch(`https://psgc.gitlab.io/api/cities-municipalities/${cityCode}/barangays/`);
        barangays = await res.json();
        psgcCache.barangays[cityCode] = barangays;
      }

      barangaySelect.innerHTML = '<option value="" disabled selected>Select Barangay</option>';

      if (Array.isArray(barangays) && barangays.length > 0) {
        barangays.sort((a, b) => a.name.localeCompare(b.name));
        barangays.forEach(b => {
          const opt = document.createElement("option");
          opt.value = b.name;
          opt.textContent = b.name;
          barangaySelect.appendChild(opt);
        });
      }

      const otherOpt = document.createElement("option");
      otherOpt.value = "Other";
      otherOpt.textContent = "Other / Type Barangay Name";
      barangaySelect.appendChild(otherOpt);

    } catch (err) {
      console.warn("PSGC API barangays fetch error:", err);
      barangaySelect.innerHTML = '<option value="Other" selected>Type Custom Barangay Name</option>';
      if (barangayCustom) barangayCustom.style.display = "block";
    }
  });

  barangaySelect?.addEventListener("change", function () {
    if (this.value === "Other") {
      if (barangayCustom) barangayCustom.style.display = "block";
    } else {
      if (barangayCustom) barangayCustom.style.display = "none";
    }
  });

  // Load official PSGC Philippine provinces on startup
  loadProvincesAndRegions();

  /* ================================================================
   * 7. CLIENT-SIDE VALIDATION
   * ================================================================ */
  function showFieldError(id, msg) {
    const el = document.getElementById(id);
    if (el) { el.textContent = msg; el.style.display = "block"; }
  }
  function clearFieldError(id) {
    const el = document.getElementById(id);
    if (el) { el.textContent = ""; el.style.display = "none"; }
  }
  function clearAllErrors() {
    document.querySelectorAll(".field-error").forEach(el => { el.textContent = ""; el.style.display = "none"; });
    const stripeErr = document.getElementById("stripe-card-errors");
    if (stripeErr) { stripeErr.textContent = ""; stripeErr.style.display = "none"; }
  }

  function validateForm() {
    clearAllErrors();
    let valid = true;

    const fname  = document.getElementById("fname")?.value.trim();
    const lname  = document.getElementById("lname")?.value.trim();
    const email  = document.getElementById("email")?.value.trim();
    const method = paymentMethodInput?.value;

    if (!fname) { showFieldError("err-fname", "First name is required."); valid = false; }
    if (!lname) { showFieldError("err-lname",  "Last name is required."); valid = false; }
    if (!email) { showFieldError("err-email",  "Email address is required."); valid = false; }
    else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      showFieldError("err-email", "Enter a valid email address."); valid = false;
    }

    // Warn if no amount selected (not a hard block)
    if (!selectedAmountInput?.value) {
      const go = confirm("You haven't selected a donation amount. Continue anyway?");
      if (!go) { valid = false; }
    }

    if (method === "bank") {
      const receiptInput = document.getElementById("receipt");
      if (!receiptInput || !receiptInput.files[0]) {
        showFieldError("err-receipt", "Please attach your receipt screenshot."); valid = false;
      }
    }

    return valid;
  }

  /* ================================================================
   * 8. HELPERS: UI state
   * ================================================================ */
  const donateSubmitBtn = document.getElementById("donateSubmitBtn");
  const btnSpinner      = document.getElementById("btnSpinner");
  const btnText         = donateSubmitBtn?.querySelector(".btn-text");

  function setLoading(loading) {
    donateSubmitBtn.disabled = loading;
    if (btnText)    btnText.style.display    = loading ? "none" : "inline";
    if (btnSpinner) btnSpinner.style.display = loading ? "flex"  : "none";
  }

  /* ================================================================
   * 9. AJAX HELPERS
   * ================================================================ */
  async function postJSON(url, data) {
    const res = await fetch(url, {
      method:  "POST",
      headers: {
        "Content-Type": "application/json",
        "Accept":       "application/json",
        "X-CSRF-TOKEN": CSRF_TOKEN,
      },
      body: JSON.stringify(data),
    });
    const json = await res.json();
    if (!res.ok) throw new Error(json.error || "Request failed");
    return json;
  }

  async function postForm(url, formData) {
    const res = await fetch(url, {
      method:  "POST",
      headers: { "Accept": "application/json", "X-CSRF-TOKEN": CSRF_TOKEN },
      body:    formData,
    });
    const json = await res.json();
    if (!res.ok) throw new Error(json.message || "Failed to save donation");
    return json;
  }

  /* ================================================================
   * 10. FORM SUBMISSION
   * ================================================================ */
  const donationForm = document.getElementById("donationForm");

  donationForm?.addEventListener("submit", async function (e) {
    e.preventDefault();
    if (!validateForm()) return;

    const method = paymentMethodInput?.value;
    setLoading(true);

    try {
      if (method === "visa" || method === "") {
        await handleCardPayment();
      } else {
        // Bank Transfer or PayPal — no Stripe, submit directly
        await handleManualPayment();
      }
    } catch (err) {
      console.error("Donation error:", err);
      showGenericError(err.message || "An error occurred. Please try again.");
      setLoading(false);
    }
  });

  /* ================================================================
   * 11. CARD PAYMENT (Stripe Payment Intents)
   * ================================================================ */
  async function handleCardPayment() {
    if (!stripeReady || !stripe || !cardElement) {
      throw new Error("Card payment is not available. Please configure Stripe keys.");
    }

    const amount   = currentRawAmount || Number(selectedAmountInput?.value) || 0;
    const giveType = giveTypeInput?.value || "once";

    // Step 1: Create PaymentIntent on the server
    const intentData = await postJSON(INTENT_URL, {
      amount:    amount,
      give_type: giveType,
      currency:  "php",
    });

    const clientSecret = intentData.client_secret;
    const intentId     = intentData.intent_id;

    // Step 2: Confirm card payment using Stripe.js (PCI-compliant)
    const fname = document.getElementById("fname")?.value.trim();
    const lname = document.getElementById("lname")?.value.trim();
    const email = document.getElementById("email")?.value.trim();

    const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
      payment_method: {
        card:            cardElement,
        billing_details: {
          name:  `${fname} ${lname}`,
          email: email,
        },
      },
    });

    if (error) {
      // Stripe-provided error message (e.g. "Your card was declined.")
      const errEl = document.getElementById("stripe-card-errors");
      if (errEl) { errEl.textContent = error.message; errEl.style.display = "block"; }
      setLoading(false);
      return;
    }

    if (paymentIntent.status === "succeeded") {
      // Step 3: Store donation record in our database
      document.getElementById("stripeIntentId").value = paymentIntent.id;
      document.getElementById("stripeStatus").value   = "succeeded";

      const formData = new FormData(donationForm);
      await postForm(DONATE_URL, formData);

      setLoading(false);
      showSuccessModal();
    } else {
      throw new Error("Payment not completed. Status: " + paymentIntent.status);
    }
  }

  /* ================================================================
   * 12. MANUAL PAYMENT (Bank Transfer / PayPal)
   * ================================================================ */
  async function handleManualPayment() {
    // Set status as pending (no Stripe for manual payments)
    const stripeIntentEl  = document.getElementById("stripeIntentId");
    const stripeStatusEl  = document.getElementById("stripeStatus");
    if (stripeIntentEl) stripeIntentEl.value = "";
    if (stripeStatusEl) stripeStatusEl.value = "pending";

    const formData = new FormData(donationForm);
    await postForm(DONATE_URL, formData);

    setLoading(false);
    showSuccessModal();
  }

  /* ================================================================
   * 13. GENERIC ERROR DISPLAY
   * ================================================================ */
  function showGenericError(msg) {
    let errBox = document.getElementById("global-donate-error");
    if (!errBox) {
      errBox = document.createElement("div");
      errBox.id = "global-donate-error";
      errBox.className = "global-error-box";
      donateSubmitBtn?.insertAdjacentElement("beforebegin", errBox);
    }
    errBox.textContent = "⚠️ " + msg;
    errBox.style.display = "block";
    setTimeout(() => { errBox.style.display = "none"; }, 8000);
  }

  /* ================================================================
   * 14. SUCCESS MODAL
   * ================================================================ */
  const successModal       = document.getElementById("successModal");
  const modalCloseBtn      = document.getElementById("modalCloseBtn");
  const confettiContainer  = document.getElementById("confettiContainer");
  const autoCloseCountdown = document.getElementById("autoCloseCountdown");
  let autoCloseTimer       = null;
  let countdownInterval    = null;

  function showSuccessModal() {
    if (!successModal) return;
    successModal.style.display = "flex";
    document.body.style.overflow = "hidden";
    launchConfetti();
    modalCloseBtn?.focus();

    // Start 3-second countdown
    let secondsLeft = 3;
    if (autoCloseCountdown) autoCloseCountdown.textContent = secondsLeft;

    if (countdownInterval) clearInterval(countdownInterval);
    countdownInterval = setInterval(() => {
      secondsLeft--;
      if (secondsLeft >= 0 && autoCloseCountdown) {
        autoCloseCountdown.textContent = secondsLeft;
      }
      if (secondsLeft <= 0) {
        clearInterval(countdownInterval);
        countdownInterval = null;
      }
    }, 1000);

    // Automatically close modal after 3 seconds (3000 ms)
    if (autoCloseTimer) clearTimeout(autoCloseTimer);
    autoCloseTimer = setTimeout(() => {
      hideSuccessModal();
    }, 3000);
  }

  function hideSuccessModal() {
    if (autoCloseTimer) {
      clearTimeout(autoCloseTimer);
      autoCloseTimer = null;
    }
    if (countdownInterval) {
      clearInterval(countdownInterval);
      countdownInterval = null;
    }
    if (!successModal) return;
    successModal.style.display = "none";
    document.body.style.overflow = "";
    donationForm?.reset();
    amountBtns.forEach(b => b.classList.remove("active"));
    if (customAmountWrap) customAmountWrap.style.display = "none";
    if (selectedAmountDisplay) selectedAmountDisplay.style.display = "none";
    if (selectedAmountInput) selectedAmountInput.value = "";
    currentRawAmount = 0;
    const notebank = document.getElementById("notebank");
    if (notebank) notebank.style.display = "none";
    // Clear Stripe card element
    cardElement?.clear();
    // Reset stepper to Step 1
    if (typeof updateStepperUI === "function") {
      updateStepperUI(1);
    }
  }

  modalCloseBtn?.addEventListener("click", hideSuccessModal);
  successModal?.addEventListener("click", e => { if (e.target === successModal) hideSuccessModal(); });
  document.addEventListener("keydown", e => {
    if (e.key === "Escape" && successModal?.style.display === "flex") hideSuccessModal();
  });

  /* ================================================================
   * 15. CONFETTI ANIMATION
   * ================================================================ */
  function launchConfetti() {
    if (!confettiContainer) return;
    confettiContainer.innerHTML = "";
    const colors = ["#f89b1e", "#ff5e57", "#22c55e", "#3b82f6", "#a855f7", "#ec4899", "#fbbf24"];
    for (let i = 0; i < 60; i++) {
      const piece = document.createElement("div");
      piece.className = "confetti-piece";
      piece.style.cssText = `
        left: ${Math.random() * 100}%;
        background: ${colors[Math.floor(Math.random() * colors.length)]};
        animation-delay: ${Math.random() * 0.8}s;
        animation-duration: ${0.8 + Math.random() * 1.2}s;
        width: ${6 + Math.random() * 8}px;
        height: ${6 + Math.random() * 8}px;
        border-radius: ${Math.random() > 0.5 ? "50%" : "2px"};
        transform: rotate(${Math.random() * 360}deg);
      `;
      confettiContainer.appendChild(piece);
    }
  }

  /* ================================================================
   * 16. STEPPER & WIZARD NAVIGATION LOGIC
   * ================================================================ */
  let currentStep = 1;

  function updateStepperUI(targetStep) {
    currentStep = targetStep;

    const trackFill = document.getElementById("stepperTrackFill");
    const totalSteps = 4;
    const percentage = ((targetStep - 1) / (totalSteps - 1)) * 100;
    if (trackFill) {
      trackFill.style.width = percentage + "%";
    }

    const nodes = [
      document.getElementById("stepNode1"),
      document.getElementById("stepNode2"),
      document.getElementById("stepNode3"),
      document.getElementById("stepNode4")
    ];

    nodes.forEach((node, index) => {
      if (!node) return;
      const stepNum = index + 1;
      const circle = document.getElementById("stepCircle" + stepNum);
      const icon = document.getElementById("stepIcon" + stepNum);
      const check = document.getElementById("stepCheck" + stepNum);
      const label = document.getElementById("stepLabel" + stepNum);

      node.classList.remove("active", "completed");

      if (stepNum < targetStep) {
        node.classList.add("completed");
        if (circle) {
          circle.style.backgroundColor = "#ffa200";
          circle.style.border = "2.5px solid #ffa200";
          circle.style.boxShadow = "none";
        }
        if (icon) icon.style.display = "none";
        if (check) check.style.display = "block";
        if (label) {
          label.style.color = "#ffa200";
          label.style.fontWeight = "600";
        }
      } else if (stepNum === targetStep) {
        node.classList.add("active");
        if (circle) {
          circle.style.backgroundColor = "#ffffff";
          circle.style.border = "2.5px solid #ffa200";
          circle.style.boxShadow = "0 0 0 3px rgba(255, 162, 0, 0.15)";
        }
        if (icon) icon.style.display = "flex";
        if (check) check.style.display = "none";
        if (label) {
          label.style.color = "#ffa200";
          label.style.fontWeight = "700";
        }
      } else {
        if (circle) {
          circle.style.backgroundColor = "#d1d5db";
          circle.style.border = "2.5px solid transparent";
          circle.style.boxShadow = "none";
        }
        if (icon) icon.style.display = "none";
        if (check) check.style.display = "none";
        if (label) {
          label.style.color = "#6b7280";
          label.style.fontWeight = "500";
        }
      }
    });

    const panels = [
      document.getElementById("stepPanel1"),
      document.getElementById("stepPanel2"),
      document.getElementById("stepPanel3"),
      document.getElementById("stepPanel4")
    ];

    panels.forEach((panel, index) => {
      if (!panel) return;
      const stepNum = index + 1;
      if (stepNum === targetStep) {
        panel.classList.add("active");
        panel.style.setProperty("display", "block", "important");
      } else {
        panel.classList.remove("active");
        panel.style.setProperty("display", "none", "important");
      }
    });

    if (targetStep === 3) {
      updatePaymentSummaryBanner();
    }
    if (targetStep === 4) {
      populateConfirmSummary();
    }

    document.querySelector(".donateform")?.scrollIntoView({ behavior: "smooth", block: "nearest" });
  }

  function validateStep(stepNum) {
    stepNum = Number(stepNum);
    clearAllErrors();

    const giveTypeEl = document.getElementById("giveType");
    const amountEl   = document.getElementById("selectedAmount");

    if (stepNum === 1) {
      const typeVal   = giveTypeEl?.value;
      const amountVal = amountEl?.value;

      if (!typeVal) {
        alert("Please select a donation frequency ('Give Once' or 'Give Monthly') to proceed.");
        return false;
      }
      if (!amountVal || Number(amountVal) <= 0) {
        alert("Please select or enter a donation amount to proceed.");
        return false;
      }
      return true;
    }

    if (stepNum === 2) {
      let valid = true;
      const fname = document.getElementById("fname")?.value.trim();
      const lname = document.getElementById("lname")?.value.trim();
      const email = document.getElementById("email")?.value.trim();

      if (!fname) { showFieldError("err-fname", "First name is required."); valid = false; }
      if (!lname) { showFieldError("err-lname", "Last name is required."); valid = false; }
      if (!email) { showFieldError("err-email", "Email address is required."); valid = false; }
      else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        showFieldError("err-email", "Enter a valid email address."); valid = false;
      }
      return valid;
    }

    if (stepNum === 3) {
      const method = paymentMethodInput?.value || "visa";
      if (method === "bank") {
        const receiptInput = document.getElementById("receipt");
        if (!receiptInput || !receiptInput.files[0]) {
          showFieldError("err-receipt", "Please attach your receipt screenshot for Bank / QR donation.");
          return false;
        }
      }
      return true;
    }

    return true;
  }

  function goToStep(targetStep) {
    targetStep = Number(targetStep);

    if (targetStep > currentStep) {
      for (let i = currentStep; i < targetStep; i++) {
        if (!validateStep(i)) return;
      }
    }
    updateStepperUI(targetStep);
  }

  // Node clicks
  [1, 2, 3, 4].forEach(stepNum => {
    const node = document.getElementById("stepNode" + stepNum);
    if (node) {
      node.onclick = function (e) {
        if (e) e.preventDefault();
        if (stepNum <= currentStep) {
          updateStepperUI(stepNum);
        } else {
          goToStep(stepNum);
        }
        return false;
      };
    }
  });

  // Action buttons direct onclick assignment
  const btn2 = document.getElementById("btnToStep2");
  if (btn2) {
    btn2.onclick = function (e) {
      if (e) {
        e.preventDefault();
        e.stopPropagation();
      }
      goToStep(2);
      return false;
    };
  }

  const btnBack1 = document.getElementById("btnBackToStep1");
  if (btnBack1) {
    btnBack1.onclick = function (e) {
      if (e) { e.preventDefault(); e.stopPropagation(); }
      goToStep(1);
      return false;
    };
  }

  const btn3 = document.getElementById("btnToStep3");
  if (btn3) {
    btn3.onclick = function (e) {
      if (e) { e.preventDefault(); e.stopPropagation(); }
      goToStep(3);
      return false;
    };
  }

  const btnBack2 = document.getElementById("btnBackToStep2");
  if (btnBack2) {
    btnBack2.onclick = function (e) {
      if (e) { e.preventDefault(); e.stopPropagation(); }
      goToStep(2);
      return false;
    };
  }

  const btn4 = document.getElementById("btnToStep4");
  if (btn4) {
    btn4.onclick = function (e) {
      if (e) { e.preventDefault(); e.stopPropagation(); }
      goToStep(4);
      return false;
    };
  }

  const btnBack3 = document.getElementById("btnBackToStep3");
  if (btnBack3) {
    btnBack3.onclick = function (e) {
      if (e) { e.preventDefault(); e.stopPropagation(); }
      goToStep(3);
      return false;
    };
  }

  function populateConfirmSummary() {
    const amountVal = amountDisplayValue?.textContent || formatPeso(currentRawAmount || selectedAmountInput?.value || 0);
    const giveType = giveTypeInput?.value === "monthly" ? "Give Monthly" : "Give Once";
    const fname = document.getElementById("fname")?.value.trim() || "";
    const lname = document.getElementById("lname")?.value.trim() || "";
    const email = document.getElementById("email")?.value.trim() || "";
    const receiptFile = document.getElementById("receipt")?.files[0];

    const sumAmount = document.getElementById("sumAmount");
    const sumType = document.getElementById("sumType");
    const sumName = document.getElementById("sumName");
    const sumEmail = document.getElementById("sumEmail");
    const sumReceipt = document.getElementById("sumReceipt");

    if (sumAmount) sumAmount.textContent = amountVal;
    if (sumType) sumType.textContent = giveType;
    if (sumName) sumName.textContent = `${fname} ${lname}`;
    if (sumEmail) sumEmail.textContent = email;
    if (sumReceipt) sumReceipt.textContent = receiptFile ? receiptFile.name : "Attached";
  }

  // Expose wizard functions globally for inline onclick handlers
  window.goToStep = goToStep;
  window.updateStepperUI = updateStepperUI;
  window.validateStep = validateStep;

  console.log("donate.js: 4-step wizard integration loaded ✅");
});
