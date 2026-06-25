<footer class="mainfooter mt-auto py-5 bg-light">
  <div class="container text-center">
    <p class="uppertext d-block">© Copyright 2025 The PARC Foundation, Inc</p>
    <p class="lowertext d-block">
      DSWD-SB-SP-00006-2025 valid from February 24, 2025 to February 23, 2026; Nationwide
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
      width: 36px;
      height: 36px;
      font-size: 0.95rem;
      bottom: 16px;
      right: 16px;
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
