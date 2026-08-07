{{-- ── PARC Foundation Musical Note Preloader Layout Component ── --}}
<link rel="stylesheet" href="{{ asset('cssfolder/preloader.css?v=1.0') }}">

<div id="parc-music-preloader" aria-label="Loading page">
  <!-- Musical Staff Background Lines -->
  <div class="preloader-staff-lines">
    <div class="staff-line"></div>
    <div class="staff-line"></div>
    <div class="staff-line"></div>
    <div class="staff-line"></div>
    <div class="staff-line"></div>
  </div>

  <!-- Floating & Dancing Musical Notes -->
  <div class="floating-notes-container">
    <div class="floating-note note-1">
      <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
    </div>
    <div class="floating-note note-2">
      <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 3H9v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h11v6.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V3z"/></svg>
    </div>
    <div class="floating-note note-3">
      <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
    </div>
    <div class="floating-note note-4">
      <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 3H9v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h11v6.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V3z"/></svg>
    </div>
    <div class="floating-note note-5">
      <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
    </div>
    <div class="floating-note note-6">
      <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 3H9v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h11v6.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V3z"/></svg>
    </div>
  </div>

  <!-- Center Content: Pulsing Logo & Soundwave Equalizer -->
  <div class="preloader-content">
    <div class="preloader-logo-wrapper">
      <div class="music-wave-ring ring-1"></div>
      <div class="music-wave-ring ring-2"></div>
      <div class="music-wave-ring ring-3"></div>
      <img src="{{ asset('assets/logo/parclogosquare.png') }}" alt="PARC Foundation Logo" class="preloader-logo">
    </div>

    <!-- Rhythmic Music Equalizer Soundwave -->
    <div class="music-equalizer">
      <span class="eq-bar bar-1"></span>
      <span class="eq-bar bar-2"></span>
      <span class="eq-bar bar-3"></span>
      <span class="eq-bar bar-4"></span>
      <span class="eq-bar bar-5"></span>
      <span class="eq-bar bar-6"></span>
      <span class="eq-bar bar-7"></span>
    </div>

    <!-- Progress Bar -->
    <div class="preloader-progress-wrap">
      <div class="preloader-progress-bar" id="preloaderProgressBar"></div>
    </div>

    <!-- Loading Subtitle -->
    <div class="preloader-text">
      <span class="music-icon-spin"><i class="bi bi-music-note-beamed"></i></span>
      <span id="preloaderStatusText">Empowering Youth Through Music</span>
    </div>
  </div>
</div>

<script>
 (function () {
  var preloader = document.getElementById('parc-music-preloader');
  var progressBar = document.getElementById('preloaderProgressBar');
  var statusText = document.getElementById('preloaderStatusText');

  if (!preloader) return;

  var TOTAL_DURATION = 7000; // 7 seconds in milliseconds
  var UPDATE_INTERVAL = 50;  // Update every 50ms for smooth animation
  var startTime = Date.now();

  var progressInterval = setInterval(function () {
    var elapsedTime = Date.now() - startTime;
    var progress = Math.min((elapsedTime / TOTAL_DURATION) * 100, 100);

    if (progressBar) {
      progressBar.style.width = progress.toFixed(1) + '%';
    }

    if (elapsedTime >= TOTAL_DURATION) {
      clearInterval(progressInterval);
      hidePreloader();
    }
  }, UPDATE_INTERVAL);

  function hidePreloader() {
    if (progressBar) progressBar.style.width = '100%';
    if (statusText) statusText.textContent = 'Welcome!';

    setTimeout(function () {
      preloader.classList.add('hide-preloader');
      setTimeout(function () {
        if (preloader.parentNode) {
          preloader.parentNode.removeChild(preloader);
        }
      }, 700);
    }, 300);
  }
})();
</script>
