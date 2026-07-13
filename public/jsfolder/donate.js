/**
 * donate.js – Full donation page interactivity
 * Senior Developer Implementation
 * 
 * Features:
 *  - Give Once / Give Monthly toggle
 *  - Amount button selection (radio-like, with custom input)
 *  - Payment method tabs (Card, PayPal, Bank Transfer)
 *  - Card number formatting & type detection
 *  - Bank transfer receipt upload with drag-and-drop
 *  - Copy account number to clipboard
 *  - Client-side form validation
 *  - Receipt reminder (bank transfer flow)
 *  - "Donated Successfully" modal with confetti
 */

document.addEventListener("DOMContentLoaded", function () {
  "use strict";

  /* ================================================================
   * 1. GIVE ONCE / GIVE MONTHLY TOGGLE
   * ================================================================ */
  const giveOnceBtn   = document.getElementById("giveOnceBtn");
  const giveMonthlyBtn = document.getElementById("giveMonthlyBtn");
  const giveTypeInput  = document.getElementById("giveType");
  const noteTitle      = document.getElementById("noteTitle");
  const noteSubtitle   = document.getElementById("noteSubtitle");
  const amountBtns     = document.querySelectorAll(".amount-btn");

  const giveTexts = {
    once: {
      title: "Thank you for making a difference.",
      subtitle: "One-time giving is a powerful way to support PARCaralan Scholars"
    },
    monthly: {
      title: "You're changing lives every month.",
      subtitle: "Monthly giving is a simple, impactful way to support PARCaralan Scholars"
    }
  };

  function setGiveType(type) {
    giveTypeInput.value = type;

    if (type === "once") {
      giveOnceBtn.classList.add("active");
      giveMonthlyBtn.classList.remove("active");
    } else {
      giveMonthlyBtn.classList.add("active");
      giveOnceBtn.classList.remove("active");
    }

    if (noteTitle)    noteTitle.textContent   = giveTexts[type].title;
    if (noteSubtitle) noteSubtitle.textContent = giveTexts[type].subtitle;

    // Update amount button labels
    amountBtns.forEach(btn => {
      const key = type === "once" ? "data-once" : "data-monthly";
      if (btn.dataset.amount !== "other") {
        btn.innerHTML = btn.getAttribute(key);
      }
    });
  }

  giveOnceBtn?.addEventListener("click", e => { e.preventDefault(); setGiveType("once"); });
  giveMonthlyBtn?.addEventListener("click", e => { e.preventDefault(); setGiveType("monthly"); });

  // Init
  setGiveType("once");


  /* ================================================================
   * 2. AMOUNT SELECTION
   * ================================================================ */
  const selectedAmountInput   = document.getElementById("selectedAmount");
  const selectedAmountDisplay = document.getElementById("selectedAmountDisplay");
  const amountDisplayValue    = document.getElementById("amountDisplayValue");
  const customAmountWrap      = document.getElementById("customAmountWrap");
  const customAmountInput     = document.getElementById("customAmountInput");
  const modalAmountVal        = document.getElementById("modalAmountVal");

  function formatPeso(num) {
    return "₱" + Number(num).toLocaleString("en-PH");
  }

  function setSelectedAmount(displayText, rawValue) {
    selectedAmountInput.value = rawValue;
    if (amountDisplayValue) amountDisplayValue.textContent = displayText;
    if (selectedAmountDisplay) selectedAmountDisplay.style.display = "flex";
    if (modalAmountVal) modalAmountVal.textContent = displayText;
  }

  amountBtns.forEach(btn => {
    btn.addEventListener("click", function (e) {
      e.preventDefault();

      // Toggle active (radio-like)
      const wasActive = this.classList.contains("active");
      amountBtns.forEach(b => b.classList.remove("active"));

      if (!wasActive) {
        this.classList.add("active");

        const amount = this.dataset.amount;

        if (amount === "other") {
          // Show custom input
          customAmountWrap.style.display = "block";
          customAmountInput.focus();
          setSelectedAmount("Custom Amount", "");
        } else {
          customAmountWrap.style.display = "none";
          const label = giveTypeInput.value === "monthly"
            ? this.getAttribute("data-monthly")
            : this.getAttribute("data-once");
          setSelectedAmount(label, amount);
        }
      } else {
        // Deselect
        customAmountWrap.style.display = "none";
        if (selectedAmountDisplay) selectedAmountDisplay.style.display = "none";
        selectedAmountInput.value = "";
      }
    });
  });

  customAmountInput?.addEventListener("input", function () {
    const val = this.value.trim();
    if (val && Number(val) > 0) {
      const label = formatPeso(val) + (giveTypeInput.value === "monthly" ? "/mo" : "");
      setSelectedAmount(label, val);
    } else {
      setSelectedAmount("Custom Amount", "");
    }
  });


  /* ================================================================
   * 3. PAYMENT METHOD TABS
   * ================================================================ */
  const payTabs   = document.querySelectorAll(".pay-tab");
  const payPanels = document.querySelectorAll(".pay-panel");
  const paymentMethodInput = document.getElementById("paymentMethod");

  function activateTab(method) {
    payTabs.forEach(t => {
      const isActive = t.dataset.method === method;
      t.classList.toggle("active", isActive);
      t.setAttribute("aria-selected", isActive ? "true" : "false");
    });

    payPanels.forEach(p => {
      if (p.id === "panel-" + method) {
        p.classList.remove("hidden");
      } else {
        p.classList.add("hidden");
      }
    });

    if (paymentMethodInput) paymentMethodInput.value = method;
  }

  payTabs.forEach(tab => {
    tab.addEventListener("click", function () {
      activateTab(this.dataset.method);
    });
  });

  // Default to card
  activateTab("visa");


  /* ================================================================
   * 4. CARD NUMBER FORMATTING & TYPE DETECTION
   * ================================================================ */
  const cardNumberInput = document.getElementById("card_number");
  const cardTypeIcon    = document.getElementById("cardTypeIcon");

  function detectCardType(num) {
    const n = num.replace(/\s/g, "");
    if (/^4/.test(n))            return "💳 Visa";
    if (/^5[1-5]/.test(n))      return "💳 Mastercard";
    if (/^3[47]/.test(n))       return "💳 Amex";
    if (/^6(?:011|5)/.test(n))  return "💳 Discover";
    return "💳";
  }

  cardNumberInput?.addEventListener("input", function () {
    // Format with spaces every 4 digits
    let val = this.value.replace(/\D/g, "").substring(0, 16);
    val = val.replace(/(.{4})/g, "$1 ").trim();
    this.value = val;

    if (cardTypeIcon) cardTypeIcon.textContent = detectCardType(val);
  });


  /* ================================================================
   * 5. COPY ACCOUNT NUMBER
   * ================================================================ */
  const copyAccBtn = document.getElementById("copyAccBtn");
  const copyToast  = document.getElementById("copyToast");
  const bankAccNum = document.getElementById("bankAccNum");

  copyAccBtn?.addEventListener("click", function () {
    const text = bankAccNum?.textContent?.trim() || "";
    if (navigator.clipboard) {
      navigator.clipboard.writeText(text).then(() => showCopyToast());
    } else {
      // Fallback
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
   * 6. RECEIPT FILE UPLOAD (DRAG & DROP)
   * ================================================================ */
  const uploadArea        = document.getElementById("uploadArea");
  const receiptUpload     = document.getElementById("receipt_upload");
  const uploadPlaceholder = document.getElementById("uploadPlaceholder");
  const uploadPreview     = document.getElementById("uploadPreview");
  const previewImg        = document.getElementById("previewImg");
  const previewName       = document.getElementById("previewName");
  const removeUpload      = document.getElementById("removeUpload");

  function handleFile(file) {
    if (!file) return;
    const maxMB = 5;
    if (file.size > maxMB * 1024 * 1024) {
      showFieldError("err-receipt", `File too large (max ${maxMB}MB).`);
      return;
    }
    clearFieldError("err-receipt");
    previewName.textContent = file.name;

    if (file.type.startsWith("image/")) {
      const reader = new FileReader();
      reader.onload = e => {
        previewImg.src = e.target.result;
        previewImg.style.display = "block";
      };
      reader.readAsDataURL(file);
    } else {
      previewImg.style.display = "none";
    }

    uploadPlaceholder.style.display = "none";
    uploadPreview.style.display = "flex";
  }

  uploadArea?.addEventListener("click", (e) => {
    if (!e.target.closest(".remove-upload")) {
      receiptUpload?.click();
    }
  });

  receiptUpload?.addEventListener("change", function () {
    handleFile(this.files[0]);
  });

  uploadArea?.addEventListener("dragover", e => {
    e.preventDefault();
    uploadArea.classList.add("drag-over");
  });

  uploadArea?.addEventListener("dragleave", () => {
    uploadArea.classList.remove("drag-over");
  });

  uploadArea?.addEventListener("drop", e => {
    e.preventDefault();
    uploadArea.classList.remove("drag-over");
    const file = e.dataTransfer.files[0];
    if (file) {
      // Assign to input
      const dt = new DataTransfer();
      dt.items.add(file);
      receiptUpload.files = dt.files;
      handleFile(file);
    }
  });

  removeUpload?.addEventListener("click", e => {
    e.stopPropagation();
    receiptUpload.value = "";
    previewImg.src = "";
    previewName.textContent = "";
    uploadPlaceholder.style.display = "flex";
    uploadPreview.style.display = "none";
  });


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
    document.querySelectorAll(".field-error").forEach(el => {
      el.textContent = "";
      el.style.display = "none";
    });
  }

  function validateForm() {
    clearAllErrors();
    let valid = true;

    const fname = document.getElementById("fname")?.value.trim();
    const lname  = document.getElementById("lname")?.value.trim();
    const email  = document.getElementById("email")?.value.trim();
    const method = paymentMethodInput?.value;
    const amount = selectedAmountInput?.value;

    if (!fname) { showFieldError("err-fname", "First name is required."); valid = false; }
    if (!lname)  { showFieldError("err-lname",  "Last name is required."); valid = false; }
    if (!email)  { showFieldError("err-email", "Email address is required."); valid = false; }
    else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      showFieldError("err-email", "Enter a valid email address."); valid = false;
    }

    if (!amount || amount === "") {
      // Soft warning – don't hard block but alert
      const proceed = confirm("You haven't selected a donation amount. Continue anyway?");
      if (!proceed) { valid = false; }
    }

    if (method === "visa") {
      const cardNum = document.getElementById("card_number")?.value.replace(/\s/g, "");
      if (!cardNum || cardNum.length < 13) {
        showFieldError("err-card_number", "Enter a valid card number."); valid = false;
      }
    }

    if (method === "bank") {
      const file = receiptUpload?.files[0];
      if (!file) {
        showFieldError("err-receipt", "Please attach your receipt screenshot."); valid = false;
      }
    }

    return valid;
  }


  /* ================================================================
   * 8. FORM SUBMISSION & SUCCESS MODAL
   * ================================================================ */
  const donationForm    = document.getElementById("donationForm");
  const donateSubmitBtn = document.getElementById("donateSubmitBtn");
  const btnSpinner      = document.getElementById("btnSpinner");
  const btnText         = donateSubmitBtn?.querySelector(".btn-text");
  const successModal    = document.getElementById("successModal");
  const modalCloseBtn   = document.getElementById("modalCloseBtn");
  const confettiContainer = document.getElementById("confettiContainer");

  donationForm?.addEventListener("submit", function (e) {
    e.preventDefault();

    if (!validateForm()) return;

    // Show loading state
    if (btnText)    btnText.style.display   = "none";
    if (btnSpinner) btnSpinner.style.display = "flex";
    donateSubmitBtn.disabled = true;

    // Simulate processing delay (replace with real AJAX/form submit)
    setTimeout(() => {
      // In production, you'd do:
      // fetch(this.action, { method: "POST", body: new FormData(this) })
      //   .then(res => ...).then(data => showSuccessModal())

      showSuccessModal();

      // Reset button state
      if (btnText)    btnText.style.display   = "inline";
      if (btnSpinner) btnSpinner.style.display = "none";
      donateSubmitBtn.disabled = false;
    }, 1800);
  });

  function showSuccessModal() {
    if (!successModal) return;
    successModal.style.display = "flex";
    document.body.style.overflow = "hidden";
    launchConfetti();

    // Trap focus in modal
    modalCloseBtn?.focus();
  }

  function hideSuccessModal() {
    if (!successModal) return;
    successModal.style.display = "none";
    document.body.style.overflow = "";
    donationForm?.reset();
    amountBtns.forEach(b => b.classList.remove("active"));
    customAmountWrap.style.display = "none";
    if (selectedAmountDisplay) selectedAmountDisplay.style.display = "none";
    selectedAmountInput.value = "";
    activateTab("visa");
  }

  modalCloseBtn?.addEventListener("click", hideSuccessModal);

  // Close on overlay click
  successModal?.addEventListener("click", function (e) {
    if (e.target === successModal) hideSuccessModal();
  });

  // Close on Escape
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && successModal?.style.display === "flex") {
      hideSuccessModal();
    }
  });


  /* ================================================================
   * 9. CONFETTI ANIMATION
   * ================================================================ */
  function launchConfetti() {
    if (!confettiContainer) return;
    confettiContainer.innerHTML = "";

    const colors = ["#f89b1e", "#ff5e57", "#22c55e", "#3b82f6", "#a855f7", "#ec4899", "#fbbf24"];
    const count  = 60;

    for (let i = 0; i < count; i++) {
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
   * 10. RECEIPT REMINDER AUTO-HIGHLIGHT (Bank Transfer)
   * ================================================================ */
  // Pulse the reminder box when bank tab is activated
  const receiptReminder = document.getElementById("receiptReminder");

  payTabs.forEach(tab => {
    tab.addEventListener("click", function () {
      if (this.dataset.method === "bank" && receiptReminder) {
        setTimeout(() => {
          receiptReminder.classList.add("pulse-highlight");
          setTimeout(() => receiptReminder.classList.remove("pulse-highlight"), 2000);
        }, 300);
      }
    });
  });

  console.log("donate.js: fully loaded ✅");
});
