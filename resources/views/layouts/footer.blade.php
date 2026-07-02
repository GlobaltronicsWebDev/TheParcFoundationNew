<footer class="mainfooter mt-auto py-5 bg-light">
  <div class="container text-center">
    <p class="uppertext d-block">© Copyright 2026 The PARC Foundation, Inc</p>
    <p class="lowertext d-block">
     DSWD-SB-RL-2025-000171 
     <br><br>
     Valid for three (3) years covering the period 11/6/2025 to 11/6/2028, unless suspended or
     revoked before its expiration. <br><br>
     Issued on the 6th day of November 2025 in Quezon City, Philippines.
    </p>
  </div>
</footer>

<!-- ── Scroll to Top Button ── -->
<button id="scroll-to-top" title="Back to top" aria-label="Back to top">
  <i class="bi bi-arrow-up"></i>
</button>

<style>
  #scroll-to-top {
    position: fixed;
    bottom: 32px;
    right: 32px;
    width: 46px;
    height: 46px;
    border-radius: 50%;
    background: #f78f1e;
    color: #fff;
    border: none;
    font-size: 1.2rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 14px rgba(0,0,0,0.2);
    opacity: 0;
    visibility: hidden;
    transform: translateY(12px);
    transition: opacity 0.3s ease, transform 0.3s ease, visibility 0.3s ease;
    z-index: 9999;
  }

  #scroll-to-top.visible {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
  }

  #scroll-to-top:hover {
    background: #e07a0a;
    transform: translateY(-3px);
  }

  @media (max-width: 991px) {
    #scroll-to-top {
      width: 44px;
      height: 44px;
      font-size: 0.95rem;
      bottom: 16px;
      right: 54px;
    }
  }
  /* Main Footer Container */
.mainfooter {
  background-color: #f8f9fa; /* Soft light gray matching 'bg-light' */
  border-top: 1px solid #e9ecef; /* Subtle top border for definition */
  font-family: 'Helvetica Neue', Arial, sans-serif; /* Clean sans-serif font */
}

/* Container spacing adjustment */
.mainfooter .container {
  max-width: 800px; /* Restricts width so text reads easily center-aligned */
  margin: 0 auto;
  padding: 0 15px;
}

/* Copyright Text (Upper) */
.mainfooter .uppertext {
  font-size: 0.95rem;
  font-weight: 600;
  color: #2b2b2b; /* Deep charcoal for main text */
  letter-spacing: 0.5px;
  margin-bottom: 1.5rem; /* Generous gap between copyright and license */
}

/* DSWD License Certificate Text (Lower) */
.mainfooter .lowertext {
  font-size: 0.8rem; /* Scaled down for legal/fine print look */
  line-height: 1.6;
  color: #6c757d; /* Muted gray for secondary legal text */
  font-weight: 400;
  max-width: 600px; /* keeps the paragraphs from getting too wide on desktop */
  margin: 0 auto;
}

/* Make it responsive for mobile viewports */
@media (max-width: 576px) {
  .mainfooter {
    padding-top: 2.5rem !important;
    padding-bottom: 2.5rem !important;
  }
  .mainfooter .uppertext {
    font-size: 0.9rem;
  }
  .mainfooter .lowertext {
    font-size: 0.75rem;
  }
}
</style>

<script>
  (function () {
    var btn = document.getElementById('scroll-to-top');

    window.addEventListener('scroll', function () {
      if (window.scrollY > 300) {
        btn.classList.add('visible');
      } else {
        btn.classList.remove('visible');
      }
    });

    btn.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  })();
</script>
