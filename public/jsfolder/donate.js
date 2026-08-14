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
   * 2. GIVE ONCE / GIVE MONTHLY TOGGLE
   * ================================================================ */
  const giveOnceBtn    = document.getElementById("giveOnceBtn");
  const giveMonthlyBtn = document.getElementById("giveMonthlyBtn");
  const giveTypeInput  = document.getElementById("giveType");
  const noteTitle      = document.getElementById("noteTitle");
  const noteSubtitle   = document.getElementById("noteSubtitle");
  const amountBtns     = document.querySelectorAll(".amount-btn");
  const btnToStep2     = document.getElementById("btnToStep2");

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

  function updateStep1ButtonState() {
    const btn = document.getElementById("btnToStep2");
    if (!btn) return;

    const hasType = !!giveTypeInput?.value;

    if (hasType) {
      btn.disabled = false;
      btn.style.background = "#f89b1e";
      btn.style.color = "#ffffff";
      btn.style.cursor = "pointer";
      btn.style.opacity = "1";
    } else {
      btn.disabled = true;
      btn.style.background = "#d1d5db";
      btn.style.color = "#777777";
      btn.style.cursor = "not-allowed";
      btn.style.opacity = "0.7";
    }
  }

  function setGiveType(type) {
    if (!type) {
      if (giveTypeInput) giveTypeInput.value = "";
      giveOnceBtn?.classList.remove("active");
      giveMonthlyBtn?.classList.remove("active");
      updateStep1ButtonState();
      return;
    }

    giveTypeInput.value = type;
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

  /* ================================================================
   * 3. AMOUNT SELECTION
   * ================================================================ */
  const selectedAmountInput   = document.getElementById("selectedAmount");
  const selectedAmountDisplay = document.getElementById("selectedAmountDisplay");
  const amountDisplayValue    = document.getElementById("amountDisplayValue");
  const customAmountWrap      = document.getElementById("customAmountWrap");
  const customAmountInput     = document.getElementById("customAmountInput");
  const modalAmountVal        = document.getElementById("modalAmountVal");

  /** Numeric raw value for Stripe (no currency symbol) */
  let currentRawAmount = 0;

  function formatPeso(num) {
    return "₱" + Number(num).toLocaleString("en-PH");
  }

  function setSelectedAmount(displayText, rawValue) {
    selectedAmountInput.value = rawValue;
    currentRawAmount = Number(rawValue) || 0;
    if (amountDisplayValue)    amountDisplayValue.textContent = displayText;
    if (selectedAmountDisplay) selectedAmountDisplay.style.display = "flex";
    if (modalAmountVal)        modalAmountVal.textContent = displayText;

    updateStep1ButtonState();
  }

  amountBtns.forEach(btn => {
    btn.addEventListener("click", function (e) {
      e.preventDefault();
      const wasActive = this.classList.contains("active");
      amountBtns.forEach(b => b.classList.remove("active"));

      if (!wasActive) {
        this.classList.add("active");
        const amount = this.dataset.amount;

        if (amount === "other") {
          customAmountWrap.style.display = "block";
          customAmountInput?.focus();
          currentRawAmount = 0;
          setSelectedAmount("Custom Amount", "");
        } else {
          customAmountWrap.style.display = "none";
          const label = giveTypeInput.value === "monthly"
            ? this.getAttribute("data-monthly")
            : this.getAttribute("data-once");
          setSelectedAmount(label, amount);
        }
      } else {
        customAmountWrap.style.display = "none";
        if (selectedAmountDisplay) selectedAmountDisplay.style.display = "none";
        selectedAmountInput.value = "";
        currentRawAmount = 0;
        updateStep1ButtonState();
      }
    });
  });

  customAmountInput?.addEventListener("input", function () {
    const val = this.value.trim();
    if (val && Number(val) > 0) {
      const isMonthly = giveTypeInput.value === "monthly";
      const label = formatPeso(val) + (isMonthly ? "/mo" : "");
      setSelectedAmount(label, val);
    } else {
      currentRawAmount = 0;
      setSelectedAmount("Custom Amount", "");
    }
    updateStep1ButtonState();
  });

  /* ================================================================
   * 4. PAYMENT METHOD CONFIG
   * ================================================================ */
  if (paymentMethodInput) paymentMethodInput.value = "bank";

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
  const totalSteps = 4;

  const stepNodes = [
    document.getElementById("stepNode1"),
    document.getElementById("stepNode2"),
    document.getElementById("stepNode3"),
    document.getElementById("stepNode4")
  ];

  const stepPanels = [
    document.getElementById("stepPanel1"),
    document.getElementById("stepPanel2"),
    document.getElementById("stepPanel3"),
    document.getElementById("stepPanel4")
  ];

  const stepperTrackFill = document.getElementById("stepperTrackFill");
  const paymentMethodInput = document.getElementById("paymentMethod");

  function updateStepperUI(targetStep) {
    currentStep = targetStep;

    // Update track line fill width: Step 1 = 0%, Step 2 = 33.33%, Step 3 = 66.66%, Step 4 = 100%
    const percentage = ((targetStep - 1) / (totalSteps - 1)) * 100;
    if (stepperTrackFill) {
      stepperTrackFill.style.width = percentage + "%";
    }

    // Update step nodes
    stepNodes.forEach((node, index) => {
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
          circle.style.backgroundColor = "#00aeef";
          circle.style.border = "2.5px solid #00aeef";
          circle.style.boxShadow = "none";
        }
        if (icon) icon.style.display = "none";
        if (check) check.style.display = "block";
        if (label) {
          label.style.color = "#00aeef";
          label.style.fontWeight = "600";
        }
      } else if (stepNum === targetStep) {
        node.classList.add("active");
        if (circle) {
          circle.style.backgroundColor = "#ffffff";
          circle.style.border = "2.5px solid #00aeef";
          circle.style.boxShadow = "0 0 0 3px rgba(0, 174, 239, 0.15)";
        }
        if (icon) icon.style.display = "flex";
        if (check) check.style.display = "none";
        if (label) {
          label.style.color = "#00aeef";
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

    // Update step panels visibility
    stepPanels.forEach((panel, index) => {
      if (!panel) return;
      const stepNum = index + 1;
      if (stepNum === targetStep) {
        panel.classList.add("active");
        panel.style.display = "block";
      } else {
        panel.classList.remove("active");
        panel.style.display = "none";
      }
    });

    // If entering Step 4, populate summary
    if (targetStep === 4) {
      populateConfirmSummary();
    }

    // Scroll smoothly to top of donate form
    document.querySelector(".donateform")?.scrollIntoView({ behavior: "smooth", block: "nearest" });
  }

  function validateStep(stepNum) {
    clearAllErrors();

    if (stepNum === 1) {
      if (!giveTypeInput?.value) {
        alert("Please select a donation frequency ('Give Once' or 'Give Monthly') to proceed.");
        return false;
      }
      const selectedVal = selectedAmountInput?.value;
      if (!selectedVal || Number(selectedVal) <= 0) {
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
      const receiptInput = document.getElementById("receipt");
      if (!receiptInput || !receiptInput.files[0]) {
        showFieldError("err-receipt", "Please attach your receipt screenshot.");
        return false;
      }
      return true;
    }

    return true;
  }

  function goToStep(targetStep) {
    if (targetStep > currentStep) {
      for (let i = currentStep; i < targetStep; i++) {
        if (!validateStep(i)) return;
      }
    }
    updateStepperUI(targetStep);
  }

  // Node clicks
  stepNodes.forEach((node, idx) => {
    node?.addEventListener("click", () => {
      const targetStep = idx + 1;
      if (targetStep <= currentStep) {
        updateStepperUI(targetStep);
      } else {
        goToStep(targetStep);
      }
    });
  });

  // Action buttons
  document.getElementById("btnToStep2")?.addEventListener("click", () => goToStep(2));
  document.getElementById("btnBackToStep1")?.addEventListener("click", () => goToStep(1));
  document.getElementById("btnToStep3")?.addEventListener("click", () => goToStep(3));
  document.getElementById("btnBackToStep2")?.addEventListener("click", () => goToStep(2));
  document.getElementById("btnToStep4")?.addEventListener("click", () => goToStep(4));
  document.getElementById("btnBackToStep3")?.addEventListener("click", () => goToStep(3));

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

  console.log("donate.js: 4-step wizard integration loaded ✅");
});
