<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>News & Stories | The PARC Foundation</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/logo/parclogosquare.png') }}">

  <!-- Google Fonts: Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('cssfolder/mainnavbar.css?v=4.0') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/contacts.css') }}" />
  <link rel="stylesheet" href="{{ asset('cssfolder/news.css?v=2.0') }}" />

  <style>
    /* Card & Content Font Family */
    .news-card,
    .news-card *,
    .card,
    .card-content,
    .card-content h3,
    .card-content p,
    .card-content .event-date,
    .video-modal,
    .video-modal * {
      font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    }

    /* Play badge on cards with YouTube videos */
    .yt-play-badge {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) scale(1);
      width: 54px;
      height: 54px;
      background: rgba(255, 0, 0, 0.9);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #ffffff;
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.35);
      transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      pointer-events: none;
      z-index: 2;
    }
    .card:hover .yt-play-badge {
      transform: translate(-50%, -50%) scale(1.15);
      background: #ff0000;
      box-shadow: 0 6px 22px rgba(255, 0, 0, 0.5);
    }
    .yt-play-badge i {
      font-size: 1.8rem;
      margin-left: 4px;
    }
    .yt-corner-pill {
      position: absolute;
      bottom: 10px;
      right: 10px;
      background: rgba(0, 0, 0, 0.75);
      color: #fff;
      font-size: 0.75rem;
      font-weight: 700;
      padding: 3px 8px;
      border-radius: 4px;
      display: flex;
      align-items: center;
      gap: 4px;
      backdrop-filter: blur(4px);
      z-index: 2;
    }
    .yt-corner-pill i {
      color: #ff0000;
    }

    /* Video Modal Styles */
    .video-modal .modal-content {
      background: #111827;
      color: #fff;
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5);
    }
    .video-modal .modal-header {
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      padding: 16px 24px;
    }
    .video-modal .modal-header .btn-close {
      filter: invert(1) grayscale(100%) brightness(200%);
    }
    .video-modal .video-responsive-wrap {
      position: relative;
      padding-bottom: 56.25%;
      height: 0;
      overflow: hidden;
      background: #000;
    }
    .video-modal .video-responsive-wrap iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border: 0;
    }
    .video-modal .modal-body-content {
      padding: 24px;
    }
    .video-modal-title {
      font-size: 1.35rem;
      font-weight: 800;
      color: #f9fafb;
      margin-bottom: 8px;
    }
    .video-modal-date {
      font-size: 0.82rem;
      color: #9ca3af;
      margin-bottom: 14px;
    }
    .video-modal-excerpt {
      font-size: 0.95rem;
      line-height: 1.6;
      color: #d1d5db;
      margin-bottom: 20px;
    }
    .btn-modal-story {
      background: #f7581e;
      color: #fff;
      font-weight: 700;
      padding: 8px 18px;
      border-radius: 8px;
      text-decoration: none;
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    .btn-modal-story:hover {
      background: #e04b16;
      color: #fff;
    }

    /* Featured Article Action Buttons */
    .featured-btn-group {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 12px;
      margin-top: 8px;
    }
    .featured-btn-group .btn-action {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 10px 22px;
      font-size: 0.88rem;
      font-weight: 700;
      letter-spacing: 0.4px;
      text-transform: uppercase;
      border-radius: 8px;
      line-height: 1.2;
      text-decoration: none;
      margin: 0 !important;
      cursor: pointer;
      transition: all 0.2s ease-in-out;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
      white-space: nowrap;
    }
    .featured-btn-group .btn-action:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    .btn-action-video {
      background-color: #dc2626;
      color: #ffffff !important;
      border: 1.5px solid #dc2626;
    }
    .btn-action-video:hover {
      background-color: #b91c1c;
      border-color: #b91c1c;
      color: #ffffff !important;
    }
    .btn-action-read {
      background-color: #f6a506;
      color: #ffffff !important;
      border: 1.5px solid #f6a506;
    }
    .btn-action-read:hover {
      background-color: #e09405;
      border-color: #e09405;
      color: #ffffff !important;
    }
    .btn-action-external {
      background-color: #ffffff;
      color: #475569 !important;
      border: 1.5px solid #cbd5e1;
    }
    .btn-action-external:hover {
      background-color: #f8fafc;
      color: #0f172a !important;
      border-color: #94a3b8;
    }
  </style>

</head>
<body>
  <!-- Include Navbar -->
  @include('layouts.navbar')
  @include('layouts.preloader')

<!-- Latest News Section -->
<section class="latest-news-section">
  <div class="container text-center">

    <!-- Section Header -->
    <div class="news-header text-center">
      <h2 class="fw-bold">
        <span class="anim-left">Latest</span> <span class="highlight anim-right">News</span>
      </h2>
      <p class="subtitle">latest posts & stories</p>
    </div>

    <!-- Featured News Card -->
    @if($featuredArticle)
      <div class="news-card shadow-sm">
        <div class="row align-items-center g-0">

          <a href="{{ route('news.show', $featuredArticle->slug ?: $featuredArticle->id) }}" class="col-md-5 news-image position-relative d-block" style="min-height: 280px; overflow: hidden; background: #000; cursor: pointer;">
            <img src="{{ $featuredArticle->display_image }}"
                 alt="{{ $featuredArticle->title }}"
                 class="img-fluid rounded-start w-100 h-100"
                 style="object-fit: cover;">

            @if(!empty($featuredArticle->youtube_url))
              <div class="yt-play-badge">
                <i class="bi bi-play-fill"></i>
              </div>
              <div class="yt-corner-pill"><i class="bi bi-youtube"></i> Video Story</div>
            @endif
          </a>

          <div class="col-md-7 p-4 text-start">
            <span class="badge bg-warning text-dark mb-2" style="font-size: 0.78rem; text-transform: uppercase; font-weight: 700;">
              {{ $featuredArticle->category ?? 'Featured Story' }}
            </span>
            <h4 class="fw-bold mb-3">
              <a href="{{ route('news.show', $featuredArticle->slug ?: $featuredArticle->id) }}" class="text-highlight text-decoration-none">
                {{ $featuredArticle->title }}
              </a>
            </h4>
            <p class="date mb-2 text-uppercase font-monospace" style="color: #6c757d; font-size: 0.88rem;">
              {{ $featuredArticle->formatted_date }}
            </p>
            <p class="text-dark mb-4">
              {{ $featuredArticle->excerpt ?? Str::limit(strip_tags($featuredArticle->content), 240) }}
            </p>

            <div class="featured-btn-group">
              @if(!empty($featuredArticle->youtube_url))
                <button type="button" class="btn-action btn-action-video"
                        onclick="openVideoModal('{{ $featuredArticle->youtube_embed_url }}', '{{ addslashes($featuredArticle->title) }}', '{{ $featuredArticle->formatted_date }}', '{{ addslashes(Str::limit($featuredArticle->excerpt ?? $featuredArticle->content, 200)) }}', '{{ route('news.show', $featuredArticle->slug ?: $featuredArticle->id) }}')">
                  <i class="bi bi-play-circle-fill fs-6"></i> PLAY VIDEO
                </button>
              @endif

              <a href="{{ route('news.show', $featuredArticle->slug ?: $featuredArticle->id) }}" class="btn-action btn-action-read">
                READ ARTICLE
              </a>

              @if(!empty($featuredArticle->external_link))
                <a href="{{ $featuredArticle->external_link }}" class="btn-action btn-action-external" target="_blank" rel="noopener">
                  EXTERNAL LINK <i class="bi bi-box-arrow-up-right"></i>
                </a>
              @endif
            </div>
          </div>
        </div>
      </div>
    @endif

    <!-- Visible cards (Always shown initial grid) -->
    <div class="section-container" id="visible-cards">
      @foreach($articles as $card)
        <div class="news-reference-card card position-relative"
             data-detail-url="{{ route('news.show', $card->slug ?: $card->id) }}"
             onclick="window.location.href='{{ route('news.show', $card->slug ?: $card->id) }}'">
          
          <div class="news-card-img-wrap position-relative">
            <img src="{{ $card->display_image }}" alt="{{ $card->title }}">

            <!-- Top-Left Pill Badge like reference -->
            <div class="news-card-top-badge">
              <img src="{{ asset('assets/logo/parclogosquare.png') }}" alt="PARC" class="badge-logo">
              <span>THE PARC FOUNDATION</span>
            </div>

            @if(!empty($card->youtube_url))
              <div class="news-card-video-pill">
                <i class="bi bi-play-circle-fill"></i> Video Story
              </div>
            @endif
          </div>

          <div class="news-card-body text-start">
            <div class="news-card-meta">
              <span class="news-meta-date">
                <i class="bi bi-calendar-event me-1"></i> {{ strtoupper($card->formatted_date) }}
              </span>
              <span class="news-meta-category">
                {{ strtoupper($card->category ?? 'THE PARC FOUNDATION') }}
              </span>
            </div>

            <h3 class="news-card-title">
              <a href="{{ route('news.show', $card->slug ?: $card->id) }}">
                {{ $card->title }}
              </a>
            </h3>

            <p class="news-card-excerpt">
              {{ Str::limit($card->excerpt ?? strip_tags($card->content), 135) }}
            </p>

            <div class="news-card-footer">
              <a href="{{ route('news.show', $card->slug ?: $card->id) }}" class="news-read-more-btn">
                Read Full Story <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Extra cards (Revealed upon clicking "MORE") -->
    @if($extraArticles->count() > 0)
      <div class="section-container" id="extra-cards" style="display: none;">
        @foreach($extraArticles as $card)
          <div class="news-reference-card card position-relative"
               data-detail-url="{{ route('news.show', $card->slug ?: $card->id) }}"
               onclick="window.location.href='{{ route('news.show', $card->slug ?: $card->id) }}'">
            
            <div class="news-card-img-wrap position-relative">
              <img src="{{ $card->display_image }}" alt="{{ $card->title }}">

              <!-- Top-Left Pill Badge like reference -->
              <div class="news-card-top-badge">
                <img src="{{ asset('assets/logo/parclogosquare.png') }}" alt="PARC" class="badge-logo">
                <span>THE PARC FOUNDATION</span>
              </div>

              @if(!empty($card->youtube_url))
                <div class="news-card-video-pill">
                  <i class="bi bi-play-circle-fill"></i> Video Story
                </div>
              @endif
            </div>

            <div class="news-card-body text-start">
              <div class="news-card-meta">
                <span class="news-meta-date">
                  <i class="bi bi-calendar-event me-1"></i> {{ strtoupper($card->formatted_date) }}
                </span>
                <span class="news-meta-category">
                  {{ strtoupper($card->category ?? 'THE PARC FOUNDATION') }}
                </span>
              </div>

              <h3 class="news-card-title">
                <a href="{{ route('news.show', $card->slug ?: $card->id) }}">
                  {{ $card->title }}
                </a>
              </h3>

              <p class="news-card-excerpt">
                {{ Str::limit($card->excerpt ?? strip_tags($card->content), 135) }}
              </p>

              <div class="news-card-footer">
                <a href="{{ route('news.show', $card->slug ?: $card->id) }}" class="news-read-more-btn">
                  Read Full Story <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- More / Back Button -->
      <div class="more-btn-container d-flex justify-content-center align-items-center w-100 mt-4 mb-2">
        <button id="more-btn" class="btn btn-more">MORE</button>
      </div>
    @endif

  </div>
</section>

<!-- In-Page YouTube Video Modal -->
<div class="modal fade video-modal" id="youtubeVideoModal" tabindex="-1" aria-labelledby="youtubeVideoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-6 fw-bold text-white d-flex align-items-center gap-2" id="youtubeVideoModalLabel">
          <i class="bi bi-youtube text-danger fs-5"></i> Video Player
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="stopVideoModal()"></button>
      </div>
      
      <!-- 16:9 Video Frame -->
      <div class="video-responsive-wrap">
        <iframe id="modalVideoIframe" src="" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
      </div>

      <div class="modal-body-content text-start">
        <h4 id="modalVideoTitle" class="video-modal-title"></h4>
        <div id="modalVideoDate" class="video-modal-date"></div>
        <p id="modalVideoExcerpt" class="video-modal-excerpt"></p>

        <div class="d-flex align-items-center justify-content-between pt-2 border-top border-secondary">
          <a id="modalDetailLink" href="#" class="btn-modal-story">
            Read Full Story <i class="bi bi-arrow-right"></i>
          </a>
          <button type="button" class="btn btn-sm btn-outline-light" data-bs-dismiss="modal" onclick="stopVideoModal()">
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Contacts & Footer -->
  @include('layouts.contacts')
  @include('layouts.footer')

  <!-- JS -->
  <script src="{{ asset('jsfolder/packages.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    /* ── MORE / BACK Toggle ── */
    var moreBtn = document.getElementById('more-btn');
    if (moreBtn) {
      moreBtn.addEventListener('click', function () {
        var extraCards = document.getElementById('extra-cards');
        if (extraCards.style.display === 'none' || extraCards.style.display === '') {
          extraCards.style.display = 'grid';
          this.textContent = 'BACK';
        } else {
          extraCards.style.display = 'none';
          this.textContent = 'MORE';
        }
      });
    }

    /* ── Video Modal Handler ── */
    var videoModalEl = document.getElementById('youtubeVideoModal');
    var videoModal = new bootstrap.Modal(videoModalEl);
    var videoIframe = document.getElementById('modalVideoIframe');

    function openVideoModal(embedUrl, title, date, excerpt, detailUrl) {
      if (!embedUrl) return;
      // Auto-play video on modal open
      var playUrl = embedUrl + (embedUrl.includes('?') ? '&' : '?') + 'autoplay=1';
      videoIframe.src = playUrl;
      document.getElementById('modalVideoTitle').textContent = title || '';
      document.getElementById('modalVideoDate').textContent = date || '';
      document.getElementById('modalVideoExcerpt').textContent = excerpt || '';
      document.getElementById('modalDetailLink').href = detailUrl || '#';
      videoModal.show();
    }

    function stopVideoModal() {
      videoIframe.src = '';
    }

    // Stop playback if modal is closed via ESC or backdrop click
    videoModalEl.addEventListener('hidden.bs.modal', function () {
      stopVideoModal();
    });

    /* ── Card Click Behavior: Direct to news page content ── */
    document.querySelectorAll('.news-reference-card').forEach(function (card) {
      card.style.cursor = 'pointer';
      card.addEventListener('click', function (e) {
        // Prevent duplicate trigger if clicking a direct link inside
        if (e.target.tagName === 'A' || e.target.closest('a')) {
          return;
        }

        var detailUrl = this.getAttribute('data-detail-url');
        if (detailUrl) {
          window.location.href = detailUrl;
        }
      });
    });

    /* ── Scroll animation observer ── */
    const animEls = document.querySelectorAll('.anim-left, .anim-right');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.2 });
    animEls.forEach(el => observer.observe(el));
  </script>

</body>
</html>
