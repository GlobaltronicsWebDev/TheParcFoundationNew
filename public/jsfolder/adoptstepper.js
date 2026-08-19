/* 🌟 ADOPT A SCHOLAR 4-STEP WIZARD SCRIPT 🌟 */

document.addEventListener("DOMContentLoaded", function () {
  let currentStep = 1;

  // Stepper Elements
  const trackFill = document.getElementById("adoptStepperTrackFill");
  const stepNodes = [
    document.getElementById("adoptStepNode1"),
    document.getElementById("adoptStepNode2"),
    document.getElementById("adoptStepNode3"),
    document.getElementById("adoptStepNode4"),
  ];
  const stepCircles = [
    document.getElementById("adoptStepCircle1"),
    document.getElementById("adoptStepCircle2"),
    document.getElementById("adoptStepCircle3"),
    document.getElementById("adoptStepCircle4"),
  ];
  const stepIcons = [
    document.getElementById("adoptStepIcon1"),
    document.getElementById("adoptStepIcon2"),
    document.getElementById("adoptStepIcon3"),
    document.getElementById("adoptStepIcon4"),
  ];
  const stepChecks = [
    document.getElementById("adoptStepCheck1"),
    document.getElementById("adoptStepCheck2"),
    document.getElementById("adoptStepCheck3"),
    document.getElementById("adoptStepCheck4"),
  ];
  const stepLabels = [
    document.getElementById("adoptStepLabel1"),
    document.getElementById("adoptStepLabel2"),
    document.getElementById("adoptStepLabel3"),
    document.getElementById("adoptStepLabel4"),
  ];

  // Panels
  const panels = [
    document.getElementById("adoptStepPanel1"),
    document.getElementById("adoptStepPanel2"),
    document.getElementById("adoptStepPanel3"),
    document.getElementById("adoptStepPanel4"),
  ];

  // Hidden Inputs
  const selectedPackageInput = document.getElementById("selectedPackage");
  const selectedAmountInput = document.getElementById("selectedAmount");
  const adoptPaymentMethodInput = document.getElementById("adoptPaymentMethod");

  // Step 1 Elements
  const btnAdoptToStep2 = document.getElementById("btnAdoptToStep2");
  const selectedPkgCard = document.getElementById("selectedPkgCard");
  const summaryPkgTitle = document.getElementById("summaryPkgTitle");
  const summaryPkgAmount = document.getElementById("summaryPkgAmount");
  const adoptCustomAmountWrap = document.getElementById("adoptCustomAmountWrap");
  const adoptCustomAmountInput = document.getElementById("adoptCustomAmountInput");

  // Step 2 Inputs & Next Button
  const fnameInput = document.getElementById("fname");
  const lnameInput = document.getElementById("lname");
  const emailInput = document.getElementById("email");
  const btnAdoptToStep3 = document.getElementById("btnAdoptToStep3");
  const btnAdoptBackToStep1 = document.getElementById("btnAdoptBackToStep1");

  // Step 3 Inputs & Next Button
  const btnAdoptToStep4 = document.getElementById("btnAdoptToStep4");
  const btnAdoptBackToStep2 = document.getElementById("btnAdoptBackToStep2");

  // Step 4 Inputs & Submit Button
  const btnAdoptBackToStep3 = document.getElementById("btnAdoptBackToStep3");
  const adoptionForm = document.getElementById("adoptionForm");
  const adoptSubmitBtn = document.getElementById("adoptSubmitBtn");
  const adoptBtnSpinner = document.getElementById("adoptBtnSpinner");
  const adoptSuccessModal = document.getElementById("adoptSuccessModal");
  const adoptModalCloseBtn = document.getElementById("adoptModalCloseBtn");

  // Package Buttons on Adopt Page
  const pkgButtons = {
    patron: document.querySelector(".btnm1"),
    silver: document.querySelector(".btnm2"),
    gold: document.querySelector(".btnm3"),
    platinum: document.querySelector(".btn1"),
    share: document.querySelector(".btn2"),
  };

  const pkgNotes = {
    patron: document.querySelector(".notepatron"),
    silver: document.querySelector(".notesilver"),
    gold: document.querySelector(".notegold"),
    platinum: document.querySelector(".noteplatinum"),
    share: document.querySelector(".noteshare"),
  };

  // ── Package Data ─────────────────────────────────────────────────────────────
  const packagesData = {
    silver: { name: "SILVER (3 Months)", amount: "15000", displayAmount: "₱15,000" },
    gold: { name: "GOLD (6 Months)", amount: "25000", displayAmount: "₱25,000" },
    platinum: { name: "PLATINUM (12 Months)", amount: "50000", displayAmount: "₱50,000" },
    patron: { name: "PATRON (Custom)", amount: "custom", displayAmount: "Custom Amount" },
    share: { name: "Share What You Can", amount: "custom", displayAmount: "Custom Amount" },
  };

  // ── Select Package Function ──────────────────────────────────────────────────
  function selectPackage(key) {
    const pkg = packagesData[key];
    if (!pkg) return;

    selectedPackageInput.value = pkg.name;

    // Show Note
    Object.keys(pkgNotes).forEach((k) => {
      if (pkgNotes[k]) pkgNotes[k].style.display = k === key ? "block" : "none";
    });

    if (pkg.amount === "custom") {
      adoptCustomAmountWrap.style.display = "block";
      const customVal = adoptCustomAmountInput.value.trim();
      selectedAmountInput.value = customVal;
      summaryPkgTitle.textContent = pkg.name;
      summaryPkgAmount.textContent = customVal ? "₱" + Number(customVal).toLocaleString() : "Custom";
    } else {
      adoptCustomAmountWrap.style.display = "none";
      selectedAmountInput.value = pkg.amount;
      summaryPkgTitle.textContent = pkg.name;
      summaryPkgAmount.textContent = pkg.displayAmount;
    }

    selectedPkgCard.style.display = "block";
    checkStep1Valid();
  }

  // Bind Package Buttons
  Object.keys(pkgButtons).forEach((key) => {
    if (pkgButtons[key]) {
      pkgButtons[key].addEventListener("click", function (e) {
        e.preventDefault();
        selectPackage(key);
      });
    }
  });

  // Custom Amount Input Listener
  if (adoptCustomAmountInput) {
    adoptCustomAmountInput.addEventListener("input", function () {
      const val = this.value.trim();
      selectedAmountInput.value = val;
      if (summaryPkgAmount) {
        summaryPkgAmount.textContent = val && Number(val) > 0 ? "₱" + Number(val).toLocaleString() : "Custom";
      }
      checkStep1Valid();
    });
  }

  function checkStep1Valid() {
    const pkg = selectedPackageInput.value;
    const amt = selectedAmountInput.value;
    const isValid = pkg && amt && Number(amt) > 0;

    if (btnAdoptToStep2) {
      btnAdoptToStep2.disabled = !isValid;
      if (isValid) {
        btnAdoptToStep2.style.background = "#f89b1e";
        btnAdoptToStep2.style.color = "#ffffff";
        btnAdoptToStep2.style.cursor = "pointer";
      } else {
        btnAdoptToStep2.style.background = "#d1d5db";
        btnAdoptToStep2.style.color = "#777777";
        btnAdoptToStep2.style.cursor = "not-allowed";
      }
    }
    return isValid;
  }

  // ── Stepper UI Update ────────────────────────────────────────────────────────
  function updateStepperUI(targetStep) {
    currentStep = targetStep;
    const progressPercent = ((targetStep - 1) / 3) * 100;
    if (trackFill) trackFill.style.width = progressPercent + "%";

    for (let i = 0; i < 4; i++) {
      const stepNum = i + 1;
      const panel = panels[i];
      const circle = stepCircles[i];
      const icon = stepIcons[i];
      const check = stepChecks[i];
      const label = stepLabels[i];

      if (panel) panel.style.display = stepNum === targetStep ? "block" : "none";

      if (stepNum < targetStep) {
        // Completed step
        if (circle) {
          circle.style.backgroundColor = "#22c55e";
          circle.style.borderColor = "#22c55e";
          circle.style.boxShadow = "none";
        }
        if (icon) icon.style.display = "none";
        if (check) check.style.display = "block";
        if (label) {
          label.style.color = "#15803d";
          label.style.fontWeight = "700";
        }
      } else if (stepNum === targetStep) {
        // Active step
        if (circle) {
          circle.style.backgroundColor = "#ffffff";
          circle.style.borderColor = "#f89b1e";
          circle.style.boxShadow = "0 0 0 3px rgba(248, 155, 30, 0.15)";
        }
        if (icon) icon.style.display = "flex";
        if (check) check.style.display = "none";
        if (label) {
          label.style.color = "#f89b1e";
          label.style.fontWeight = "700";
        }
      } else {
        // Future step
        if (circle) {
          circle.style.backgroundColor = "#d1d5db";
          circle.style.borderColor = "transparent";
          circle.style.boxShadow = "none";
        }
        if (icon) icon.style.display = "none";
        if (check) check.style.display = "none";
        if (label) {
          label.style.color = "#6b7280";
          label.style.fontWeight = "500";
        }
      }
    }

    window.scrollTo({ top: document.querySelector(".adoptsection") ? document.querySelector(".adoptsection").offsetTop - 80 : 0, behavior: "smooth" });
  }

  // ── Step Navigation Handlers ─────────────────────────────────────────────────
  if (btnAdoptToStep2) {
    btnAdoptToStep2.addEventListener("click", function () {
      if (checkStep1Valid()) updateStepperUI(2);
    });
  }

  if (btnAdoptBackToStep1) {
    btnAdoptBackToStep1.addEventListener("click", function () {
      updateStepperUI(1);
    });
  }

  function validateStep2() {
    let valid = true;
    const errFname = document.getElementById("err-fname");
    const errLname = document.getElementById("err-lname");
    const errEmail = document.getElementById("err-email");

    if (!fnameInput.value.trim()) {
      if (errFname) errFname.style.display = "block";
      valid = false;
    } else if (errFname) errFname.style.display = "none";

    if (!lnameInput.value.trim()) {
      if (errLname) errLname.style.display = "block";
      valid = false;
    } else if (errLname) errLname.style.display = "none";

    if (!emailInput.value.trim() || !emailInput.value.includes("@")) {
      if (errEmail) errEmail.style.display = "block";
      valid = false;
    } else if (errEmail) errEmail.style.display = "none";

    return valid;
  }

  if (btnAdoptToStep3) {
    btnAdoptToStep3.addEventListener("click", function () {
      if (validateStep2()) updateStepperUI(3);
    });
  }

  if (btnAdoptBackToStep2) {
    btnAdoptBackToStep2.addEventListener("click", function () {
      updateStepperUI(2);
    });
  }

  // Step 3 Payment Radio Toggles
  const paymentRadios = document.querySelectorAll('input[name="adopt_payment_radio"]');
  paymentRadios.forEach((r) => {
    r.addEventListener("change", function () {
      const val = this.value;
      adoptPaymentMethodInput.value = val;
      const optEwallet = document.getElementById("adoptOptEwallet");
      const optBank = document.getElementById("adoptOptBank");

      if (val === "ewallet") {
        if (optEwallet) {
          optEwallet.style.border = "2px solid #f89b1e";
          optEwallet.style.background = "#fff8f0";
        }
        if (optBank) {
          optBank.style.border = "1.5px solid #d1d5db";
          optBank.style.background = "#ffffff";
        }
      } else {
        if (optBank) {
          optBank.style.border = "2px solid #f89b1e";
          optBank.style.background = "#fff8f0";
        }
        if (optEwallet) {
          optEwallet.style.border = "1.5px solid #d1d5db";
          optEwallet.style.background = "#ffffff";
        }
      }
    });
  });

  if (btnAdoptToStep4) {
    btnAdoptToStep4.addEventListener("click", function () {
      // Update Step 4 Final Summary
      document.getElementById("finalSummaryPkg").textContent = selectedPackageInput.value || "Custom Support";
      document.getElementById("finalSummaryAmount").textContent = selectedAmountInput.value ? "₱" + Number(selectedAmountInput.value).toLocaleString() : "—";
      document.getElementById("finalSummaryName").textContent = (fnameInput.value + " " + lnameInput.value).trim();
      document.getElementById("finalSummaryEmail").textContent = emailInput.value.trim();
      document.getElementById("finalSummaryPayment").textContent = adoptPaymentMethodInput.value === "ewallet" ? "e-Wallets (GCash / Maya)" : "Bank Transfer";

      updateStepperUI(4);
    });
  }

  if (btnAdoptBackToStep3) {
    btnAdoptBackToStep3.addEventListener("click", function () {
      updateStepperUI(3);
    });
  }

  // ── Form Submission via AJAX ──────────────────────────────────────────────────
  if (adoptionForm) {
    adoptionForm.addEventListener("submit", async function (e) {
      e.preventDefault();

      if (adoptSubmitBtn) adoptSubmitBtn.disabled = true;
      if (adoptBtnSpinner) adoptBtnSpinner.style.display = "inline-flex";

      const formData = new FormData(adoptionForm);

      try {
        const res = await fetch(adoptionForm.action, {
          method: "POST",
          headers: {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
          },
          body: formData,
        });

        const json = await res.json();

        if (res.ok && json.success) {
          adoptionForm.reset();
          if (adoptSuccessModal) adoptSuccessModal.style.display = "flex";
        } else {
          alert(json.message || json.error || "An error occurred submitting your adoption form. Please try again.");
        }
      } catch (err) {
        console.error("Adoption form submission error:", err);
        alert("Connection error. Please try again.");
      } finally {
        if (adoptSubmitBtn) adoptSubmitBtn.disabled = false;
        if (adoptBtnSpinner) adoptBtnSpinner.style.display = "none";
      }
    });
  }

  if (adoptModalCloseBtn) {
    adoptModalCloseBtn.addEventListener("click", function () {
      window.location.href = "/";
    });
  }
});
