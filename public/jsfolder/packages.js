// public/jsfolder/packages.js

(function () {
  "use strict";

  document.addEventListener("DOMContentLoaded", function () {

    // Package button → note panel mapping + amount data
    const options = [
      { btn: ".btnm1", note: ".notepatron",  package: "Patron",              amount: "" },
      { btn: ".btnm2", note: ".notesilver",  package: "Silver",              amount: "₱15,000" },
      { btn: ".btnm3", note: ".notegold",    package: "Gold",                amount: "₱25,000" },
      { btn: ".btn1",  note: ".noteplatinum",package: "Platinum",            amount: "₱50,000" },
      { btn: ".btn2",  note: ".noteshare",   package: "Share What You Can",  amount: "" },
    ];

    // Hidden inputs for form submission
    const pkgInput    = document.getElementById("selectedPackage");
    const amtInput    = document.getElementById("selectedAmount");
    const pkgDisplay  = document.getElementById("selectedPkgDisplay");
    const pkgText     = document.getElementById("selectedPkgText");

    // Collect all note elements and all buttons
    const allNotes   = options.map(opt => document.querySelector(opt.note));
    const allButtons = options.map(opt => document.querySelector(opt.btn));

    // Restore active state if old() value exists (after validation error)
    const restoredPkg = pkgInput ? pkgInput.value : "";
    if (restoredPkg) {
      const match = options.find(o => o.package === restoredPkg);
      if (match) {
        const btnEl  = document.querySelector(match.btn);
        const noteEl = document.querySelector(match.note);
        if (btnEl)  btnEl.classList.add("pkg-active");
        if (noteEl) noteEl.classList.add("show");
      }
    }

    options.forEach(({ btn, note, package: pkgName, amount }) => {
      const buttonEl = document.querySelector(btn);
      const noteEl   = document.querySelector(note);

      if (!buttonEl || !noteEl) {
        console.warn(`packages.js: ${btn} or ${note} not found in DOM.`);
        return;
      }

      // Ensure all notes start hidden
      noteEl.classList.remove("show");

      buttonEl.addEventListener("click", function (e) {
        e.preventDefault();

        const isVisible = noteEl.classList.contains("show");

        // Hide all notes & remove active from all buttons
        allNotes.forEach(n => n && n.classList.remove("show"));
        allButtons.forEach(b => b && b.classList.remove("pkg-active"));

        if (!isVisible) {
          // Show this note
          noteEl.classList.add("show");
          noteEl.scrollIntoView({ behavior: "smooth", block: "nearest" });

          // Highlight this button
          buttonEl.classList.add("pkg-active");

          // Populate hidden form fields
          if (pkgInput) pkgInput.value = pkgName;
          if (amtInput) amtInput.value = amount;

          // Update display badge
          if (pkgDisplay && pkgText) {
            pkgText.textContent      = pkgName + (amount ? " — " + amount : "");
            pkgDisplay.style.display = "flex";
          }
        } else {
          // Deselect — toggle off
          buttonEl.classList.remove("pkg-active");
          if (pkgInput) pkgInput.value = "";
          if (amtInput) amtInput.value = "";
          if (pkgDisplay) pkgDisplay.style.display = "none";
        }
      });
    });
  });
})();
