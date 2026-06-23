document.addEventListener("DOMContentLoaded", function () {
  console.log("donate.js: loaded");

  /**
   * Makes a button group behave like radio buttons
   * @param {string} selector - CSS selector for the button group
   * @param {string} activeClass - Class to add to the selected button
   */
  function makeExclusive(selector, activeClass = "active") {
    const buttons = document.querySelectorAll(selector);

    buttons.forEach(btn => {
      btn.addEventListener("click", function (e) {
        e.preventDefault();

        // Remove active class from all in the same group
        buttons.forEach(b => b.classList.remove(activeClass));

        // Add to clicked one
        this.classList.add(activeClass);
      });
    });
  }

  // Group 1: Give Once / Give Monthly
  makeExclusive(".center-btn .btn1, .center-btn .btn2");

  // Group 2: Monthly Options
  makeExclusive(".btn-monthly .center-btn a");
});
