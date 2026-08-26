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

  // ── Step 3 Payment Method Toggle Function ──
  function selectAdoptPaymentMethod(method) {
    const adoptPaymentMethodInput = document.getElementById("adoptPaymentMethod");
    const optEwallet = document.getElementById("adoptOptEwallet");
    const optBank = document.getElementById("adoptOptBank");
    const radioEwallet = document.querySelector('input[name="adopt_payment_radio"][value="ewallet"]');
    const radioBank = document.querySelector('input[name="adopt_payment_radio"][value="bank"]');
    const adoptBankDetailsBox = document.getElementById("adoptBankDetailsBox");
    const adoptQrBox = document.getElementById("adoptQrBox");
    const adoptPaymentBoxTitle = document.getElementById("adoptPaymentBoxTitle");

    if (adoptPaymentMethodInput) adoptPaymentMethodInput.value = method;

    if (method === "ewallet") {
      if (radioEwallet) radioEwallet.checked = true;
      if (radioBank) radioBank.checked = false;

      if (optEwallet) {
        optEwallet.style.border = "2px solid #f89b1e";
        optEwallet.style.background = "#fff8f0";
      }
      if (optBank) {
        optBank.style.border = "1.5px solid #d1d5db";
        optBank.style.background = "#ffffff";
      }

      if (adoptBankDetailsBox) adoptBankDetailsBox.style.setProperty("display", "none", "important");
      if (adoptQrBox) adoptQrBox.style.setProperty("display", "block", "important");
      if (adoptPaymentBoxTitle) adoptPaymentBoxTitle.textContent = "Scan QR Code to Pay";
    } else {
      if (radioBank) radioBank.checked = true;
      if (radioEwallet) radioEwallet.checked = false;

      if (optBank) {
        optBank.style.border = "2px solid #f89b1e";
        optBank.style.background = "#fff8f0";
      }
      if (optEwallet) {
        optEwallet.style.border = "1.5px solid #d1d5db";
        optEwallet.style.background = "#ffffff";
      }

      if (adoptBankDetailsBox) adoptBankDetailsBox.style.setProperty("display", "block", "important");
      if (adoptQrBox) adoptQrBox.style.setProperty("display", "none", "important");
      if (adoptPaymentBoxTitle) adoptPaymentBoxTitle.textContent = "Attach Receipt / Deposit Slip";
    }
  }

  window.selectAdoptPaymentMethod = selectAdoptPaymentMethod;

  const copyBankAccBtn = document.getElementById("copyBankAccBtn");

  if (copyBankAccBtn) {
    copyBankAccBtn.addEventListener("click", function () {
      const accNo = "165770003447";
      navigator.clipboard.writeText(accNo).then(() => {
        copyBankAccBtn.textContent = "Copied! ✓";
        copyBankAccBtn.style.background = "#22c55e";
        setTimeout(() => {
          copyBankAccBtn.textContent = "Copy";
          copyBankAccBtn.style.background = "#f89b1e";
        }, 2000);
      }).catch(() => {
        const el = document.createElement("textarea");
        el.value = accNo;
        document.body.appendChild(el);
        el.select();
        document.execCommand("copy");
        document.body.removeChild(el);
        copyBankAccBtn.textContent = "Copied! ✓";
        copyBankAccBtn.style.background = "#22c55e";
        setTimeout(() => {
          copyBankAccBtn.textContent = "Copy";
          copyBankAccBtn.style.background = "#f89b1e";
        }, 2000);
      });
    });
  }

  // ── Receipt Screenshot Preview & Clear Handlers ─────────────────────────
  window.handleReceiptChange = function(input) {
    const previewContainer = document.getElementById("receipt-preview");
    const imgPreview = document.getElementById("receipt-img-preview");
    const fileNameEl = document.getElementById("receipt-file-name");
    const labelText = document.getElementById("receipt-label-text");
    const errReceipt = document.getElementById("err-receipt");

    if (errReceipt) errReceipt.style.display = "none";

    if (input && input.files && input.files[0]) {
      const file = input.files[0];
      const fileSizeMB = (file.size / 1024 / 1024).toFixed(2);

      if (fileNameEl) fileNameEl.textContent = file.name + " (" + fileSizeMB + " MB)";
      if (labelText) labelText.textContent = "Uploaded: " + file.name;

      if (file.type.startsWith("image/")) {
        const reader = new FileReader();
        reader.onload = function(e) {
          if (imgPreview) {
            imgPreview.src = e.target.result;
            imgPreview.style.display = "inline-block";
          }
        };
        reader.readAsDataURL(file);
      } else {
        // PDF or non-image file
        if (imgPreview) imgPreview.style.display = "none";
      }

      if (previewContainer) previewContainer.style.display = "block";
    }
  };

  window.clearReceipt = function() {
    const input = document.getElementById("receipt");
    const previewContainer = document.getElementById("receipt-preview");
    const imgPreview = document.getElementById("receipt-img-preview");
    const fileNameEl = document.getElementById("receipt-file-name");
    const labelText = document.getElementById("receipt-label-text");

    if (input) input.value = "";
    if (imgPreview) imgPreview.src = "";
    if (fileNameEl) fileNameEl.textContent = "";
    if (labelText) labelText.textContent = "Click to upload receipt (JPG, PNG, PDF — max 5MB)";
    if (previewContainer) previewContainer.style.display = "none";
  };

  if (btnAdoptToStep4) {
    btnAdoptToStep4.addEventListener("click", function () {
      const receiptInput = document.getElementById("receipt");
      const errReceipt = document.getElementById("err-receipt");
      const receiptLabel = document.getElementById("receipt-label");

      if (!receiptInput || !receiptInput.files || !receiptInput.files.length) {
        if (errReceipt) {
          errReceipt.style.display = "block";
          errReceipt.textContent = "⚠️ Proof of payment / receipt attachment is required before proceeding.";
        }
        if (receiptLabel) {
          receiptLabel.style.borderColor = "#e11d48";
          receiptLabel.style.backgroundColor = "#fff1f2";
        }
        receiptInput?.focus();
        return;
      }

      if (errReceipt) errReceipt.style.display = "none";
      if (receiptLabel) {
        receiptLabel.style.borderColor = "#f89b1e";
        receiptLabel.style.backgroundColor = "#ffffff";
      }

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

          const adoptDownloadReceiptBtn = document.getElementById("adoptDownloadReceiptBtn");
          const adoptViewReceiptBtn = document.getElementById("adoptViewReceiptBtn");

          if (adoptDownloadReceiptBtn && json.download_url) {
            adoptDownloadReceiptBtn.href = json.download_url;
          } else if (adoptDownloadReceiptBtn && json.adoption_id) {
            adoptDownloadReceiptBtn.href = "/adoptions/" + json.adoption_id + "/download-receipt";
          }

          if (adoptViewReceiptBtn && json.receipt_url) {
            adoptViewReceiptBtn.href = json.receipt_url;
          } else if (adoptViewReceiptBtn && json.adoption_id) {
            adoptViewReceiptBtn.href = "/adoptions/" + json.adoption_id + "/receipt";
          }

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

  /* ── PSGC PHILIPPINE LOCATIONS FETCH ── */
  const adoptProvinceSelect = document.getElementById("adoptProvince");
  const adoptCitySelect     = document.getElementById("adoptCitySelect");
  const adoptCityCustom     = document.getElementById("adoptCityCustom");
  const adoptBarangaySelect = document.getElementById("adoptBarangaySelect");
  const adoptBarangayCustom = document.getElementById("adoptBarangayCustom");

  const psgcCache = { provinces: [], regions: [], cities: {}, barangays: {} };

  async function loadAdoptProvincesAndRegions() {
    if (!adoptProvinceSelect) return;
    try {
      adoptProvinceSelect.innerHTML = '<option value="" disabled selected>Loading Provinces & Regions...</option>';

      const [provRes, regRes] = await Promise.all([
        fetch("https://psgc.gitlab.io/api/provinces/").then(r => r.json()).catch(() => []),
        fetch("https://psgc.gitlab.io/api/regions/").then(r => r.json()).catch(() => [])
      ]);

      adoptProvinceSelect.innerHTML = '<option value="" disabled selected>Select Province / Region</option>';

      let allLocations = [];

      if (Array.isArray(regRes)) {
        regRes.forEach(reg => {
          if (reg.code === "130000000" || reg.name.toLowerCase().includes("ncr") || reg.name.toLowerCase().includes("metro manila")) {
            allLocations.push({ name: "Metro Manila (NCR)", code: reg.code, isRegion: true });
          }
        });
      }

      if (Array.isArray(provRes)) {
        provRes.forEach(p => {
          allLocations.push({ name: p.name, code: p.code, isRegion: false });
        });
      }

      allLocations.sort((a, b) => a.name.localeCompare(b.name));

      allLocations.forEach(loc => {
        const opt = document.createElement("option");
        opt.value = loc.name;
        opt.dataset.code = loc.code;
        opt.dataset.isRegion = loc.isRegion ? "true" : "false";
        opt.textContent = loc.name;
        adoptProvinceSelect.appendChild(opt);
      });

      const otherOpt = document.createElement("option");
      otherOpt.value = "Other";
      otherOpt.textContent = "Other / Custom Region";
      adoptProvinceSelect.appendChild(otherOpt);

    } catch (err) {
      console.warn("PSGC API failed to load provinces for adopt form.", err);
    }
  }

  loadAdoptProvincesAndRegions();

  adoptProvinceSelect?.addEventListener("change", async function () {
    const selectedOpt = this.options[this.selectedIndex];
    const locationName = this.value;
    const locationCode = selectedOpt?.dataset?.code;
    const isRegion = selectedOpt?.dataset?.isRegion === "true";

    if (!adoptCitySelect || !adoptBarangaySelect) return;

    adoptCitySelect.innerHTML = '<option value="" disabled selected>Loading Cities...</option>';
    adoptBarangaySelect.innerHTML = '<option value="" disabled selected>Select City First</option>';

    if (adoptCityCustom) adoptCityCustom.style.display = "none";
    if (adoptBarangayCustom) adoptBarangayCustom.style.display = "none";

    if (locationName === "Other") {
      adoptCitySelect.innerHTML = '<option value="Other" selected>Type Custom City Name</option>';
      adoptBarangaySelect.innerHTML = '<option value="Other" selected>Type Custom Barangay Name</option>';
      if (adoptCityCustom) adoptCityCustom.style.display = "block";
      if (adoptBarangayCustom) adoptBarangayCustom.style.display = "block";
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

      adoptCitySelect.innerHTML = '<option value="" disabled selected>Select City / Municipality</option>';

      if (Array.isArray(cities)) {
        cities.sort((a, b) => a.name.localeCompare(b.name));
        cities.forEach(c => {
          const opt = document.createElement("option");
          opt.value = c.name;
          opt.dataset.code = c.code;
          opt.textContent = c.name;
          adoptCitySelect.appendChild(opt);
        });
      }

      const otherOpt = document.createElement("option");
      otherOpt.value = "Other";
      otherOpt.textContent = "Other / Custom City";
      adoptCitySelect.appendChild(otherOpt);

    } catch (err) {
      console.warn("Failed to load cities.", err);
      adoptCitySelect.innerHTML = '<option value="Other" selected>Type Custom City Name</option>';
      if (adoptCityCustom) adoptCityCustom.style.display = "block";
    }
  });

  adoptCitySelect?.addEventListener("change", async function () {
    const selectedOpt = this.options[this.selectedIndex];
    const cityName = this.value;
    const cityCode = selectedOpt?.dataset?.code;

    if (!adoptBarangaySelect) return;

    if (cityName === "Other") {
      adoptBarangaySelect.innerHTML = '<option value="Other" selected>Type Custom Barangay Name</option>';
      if (adoptBarangayCustom) adoptBarangayCustom.style.display = "block";
      if (adoptCityCustom) adoptCityCustom.style.display = "block";
      return;
    }

    if (adoptCityCustom) adoptCityCustom.style.display = "none";
    if (adoptBarangayCustom) adoptBarangayCustom.style.display = "none";

    if (!cityCode) return;

    try {
      let barangays = psgcCache.barangays[cityCode];
      if (!barangays) {
        const res = await fetch(`https://psgc.gitlab.io/api/cities-municipalities/${cityCode}/barangays/`);
        barangays = await res.json();
        psgcCache.barangays[cityCode] = barangays;
      }

      adoptBarangaySelect.innerHTML = '<option value="" disabled selected>Select Barangay</option>';

      if (Array.isArray(barangays)) {
        barangays.sort((a, b) => a.name.localeCompare(b.name));
        barangays.forEach(b => {
          const opt = document.createElement("option");
          opt.value = b.name;
          opt.textContent = b.name;
          adoptBarangaySelect.appendChild(opt);
        });
      }

      const otherOpt = document.createElement("option");
      otherOpt.value = "Other";
      otherOpt.textContent = "Other / Custom Barangay";
      adoptBarangaySelect.appendChild(otherOpt);

    } catch (err) {
      console.warn("Failed to load barangays.", err);
      adoptBarangaySelect.innerHTML = '<option value="Other" selected>Type Custom Barangay Name</option>';
      if (adoptBarangayCustom) adoptBarangayCustom.style.display = "block";
    }
  });

  adoptBarangaySelect?.addEventListener("change", function () {
    if (this.value === "Other") {
      if (adoptBarangayCustom) adoptBarangayCustom.style.display = "block";
    } else {
      if (adoptBarangayCustom) adoptBarangayCustom.style.display = "none";
    }
  });
});
