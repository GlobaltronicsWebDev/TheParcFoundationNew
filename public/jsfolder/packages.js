// public/js/packages.js 

(function () {
  "use strict";

  document.addEventListener("DOMContentLoaded", function () {
    console.log("packages.js: script loaded");

    // Define button-note pairs
    const options = [
      { btn: ".btnm1", note: ".notepatron" },
      { btn: ".btnm2", note: ".notesilver" },
      { btn: ".btnm3", note: ".notegold" },
      { btn: ".btn1", note: ".noteplatinum" },
    ];

    // Collect all notes
    const allNotes = options.map(opt => document.querySelector(opt.note));

    options.forEach(({ btn, note }) => {
      const buttonEl = document.querySelector(btn);
      const noteEl = document.querySelector(note);

      if (!buttonEl || !noteEl) {
        console.warn(`packages.js: ${btn} or ${note} not found in DOM.`);
        return;
      }

      // Ensure hidden initially
      noteEl.classList.remove("show");

      buttonEl.addEventListener("click", function (e) {
        e.preventDefault();

        const isVisible = noteEl.classList.contains("show");

        // Hide all notes
        allNotes.forEach(n => n && n.classList.remove("show"));

        if (!isVisible) {
          noteEl.classList.add("show");
          noteEl.scrollIntoView({ behavior: "smooth", block: "nearest" });
        }
      });
    });
  });
})();


/**
 <!-- Inline JS for testing -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const silverBtn = document.querySelector(".btnm2");
      const silverNote = document.querySelector(".note1");

      console.log("✅ Script loaded");

      silverBtn.addEventListener("click", function (e) {
        e.preventDefault();
        console.log("👉 Silver button clicked");

        silverNote.classList.toggle("show");
      });
    });
  </script>
 **/

  /**
 <!-- Inline JS for testing -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const silverBtn = document.querySelector(".btnm2");
      const silverNote = document.querySelector(".note1");

      console.log("✅ Script loaded");

      silverBtn.addEventListener("click", function (e) {
        e.preventDefault();
        console.log("👉 Silver button clicked");

        silverNote.classList.toggle("show");
      });
    });
  </script>
 **/
