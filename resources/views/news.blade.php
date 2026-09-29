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

          <div class="col-md-5 news-image position-relative" style="min-height: 280px; overflow: hidden; background: #000; cursor: {{ !empty($featuredArticle->youtube_url) ? 'pointer' : 'default' }};"
               @if(!empty($featuredArticle->youtube_url))
                 onclick="openVideoModal('{{ $featuredArticle->youtube_embed_url }}', '{{ addslashes($featuredArticle->title) }}', '{{ $featuredArticle->formatted_date }}', '{{ addslashes(Str::limit($featuredArticle->excerpt ?? $featuredArticle->content, 200)) }}', '{{ route('news.show', $featuredArticle->slug ?: $featuredArticle->id) }}')"
               @endif>
            <img src="{{ $featuredArticle->display_image }}"
                 alt="{{ $featuredArticle->title }}"
                 class="img-fluid rounded-start w-100 h-100"
                 style="object-fit: cover;">

            @if(!empty($featuredArticle->youtube_url))
              <div class="yt-play-badge">
                <i class="bi bi-play-fill"></i>
              </div>
              <div class="yt-corner-pill"><i class="bi bi-youtube"></i> Watch Video</div>
            @endif
          </div>

          <div class="col-md-7 p-4 text-start">
            <span class="badge bg-warning text-dark mb-2" style="font-size: 0.78rem; text-transform: uppercase; font-weight: 700;">
              {{ $featuredArticle->category ?? 'Featured Story' }}
            </span>
            <h4 class="fw-bold text-highlight mb-3">
              {{ $featuredArticle->title }}
            </h4>
            <p class="date mb-2 text-uppercase font-monospace" style="color: #6c757d; font-size: 0.88rem;">
              {{ $featuredArticle->formatted_date }}
            </p>
            <p class="text-dark mb-4">
              {{ $featuredArticle->excerpt ?? Str::limit(strip_tags($featuredArticle->content), 240) }}
            </p>

            <div class="d-flex flex-wrap gap-2 align-items-center">
              @if(!empty($featuredArticle->youtube_url))
                <button type="button" class="btn btn-danger fw-bold d-inline-flex align-items-center gap-2"
                        onclick="openVideoModal('{{ $featuredArticle->youtube_embed_url }}', '{{ addslashes($featuredArticle->title) }}', '{{ $featuredArticle->formatted_date }}', '{{ addslashes(Str::limit($featuredArticle->excerpt ?? $featuredArticle->content, 200)) }}', '{{ route('news.show', $featuredArticle->slug ?: $featuredArticle->id) }}')">
                  <i class="bi bi-play-circle-fill"></i> PLAY VIDEO
                </button>
              @endif

              <a href="{{ route('news.show', $featuredArticle->slug ?: $featuredArticle->id) }}" class="btn btn-learn">
                READ ARTICLE
              </a>

              @if(!empty($featuredArticle->external_link))
                <a href="{{ $featuredArticle->external_link }}" class="btn btn-outline-secondary" target="_blank" rel="noopener">
                  EXTERNAL LINK <i class="bi bi-box-arrow-up-right ms-1"></i>
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
        <div class="card position-relative"
             data-has-video="{{ !empty($card->youtube_url) ? '1' : '0' }}"
             data-embed-url="{{ $card->youtube_embed_url ?? '' }}"
             data-title="{{ $card->title }}"
             data-date="{{ $card->formatted_date }}"
             data-excerpt="{{ Str::limit($card->excerpt ?? strip_tags($card->content), 180) }}"
             data-detail-url="{{ route('news.show', $card->slug ?: $card->id) }}"
             data-external-link="{{ $card->external_link ?? '' }}">
          
          <div class="card-image position-relative">
            <img src="{{ $card->display_image }}" alt="{{ $card->title }}" class="fit-cover">

            @if(!empty($card->youtube_url))
              <div class="yt-play-badge">
                <i class="bi bi-play-fill"></i>
              </div>
              <div class="yt-corner-pill"><i class="bi bi-youtube"></i> Video</div>
            @endif
          </div>

          <div class="card-content text-start">
            <h3>{{ Str::limit($card->title, 65) }}</h3>
            <p>{{ Str::limit($card->excerpt ?? strip_tags($card->content), 140) }}</p>
            <span class="event-date">{{ $card->formatted_date }}</span>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Extra cards (Revealed upon clicking "MORE") -->
    @if($extraArticles->count() > 0)
      <div class="section-container" id="extra-cards" style="display: none;">
        @foreach($extraArticles as $card)
          <div class="card position-relative"
               data-has-video="{{ !empty($card->youtube_url) ? '1' : '0' }}"
               data-embed-url="{{ $card->youtube_embed_url ?? '' }}"
               data-title="{{ $card->title }}"
               data-date="{{ $card->formatted_date }}"
               data-excerpt="{{ Str::limit($card->excerpt ?? strip_tags($card->content), 180) }}"
               data-detail-url="{{ route('news.show', $card->slug ?: $card->id) }}"
               data-external-link="{{ $card->external_link ?? '' }}">
            
            <div class="card-image position-relative">
              <img src="{{ $card->display_image }}" alt="{{ $card->title }}" class="fit-cover">

              @if(!empty($card->youtube_url))
                <div class="yt-play-badge">
                  <i class="bi bi-play-fill"></i>
                </div>
                <div class="yt-corner-pill"><i class="bi bi-youtube"></i> Video</div>
              @endif
            </div>

            <div class="card-content text-start">
              <h3>{{ Str::limit($card->title, 65) }}</h3>
              <p>{{ Str::limit($card->excerpt ?? strip_tags($card->content), 140) }}</p>
              <span class="event-date">{{ $card->formatted_date }}</span>
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
          extraCards.style.display = 'flex';
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

    /* ── Card Click Behavior: Open Video Modal if YouTube exists, else go to detail page ── */
    document.querySelectorAll('.card').forEach(function (card) {
      card.style.cursor = 'pointer';
      card.addEventListener('click', function (e) {
        // Prevent click if clicking a direct link inside
        if (e.target.tagName === 'A' || e.target.closest('a')) {
          return;
        }

        var hasVideo = this.getAttribute('data-has-video') === '1';
        var embedUrl = this.getAttribute('data-embed-url');
        var title = this.getAttribute('data-title');
        var date = this.getAttribute('data-date');
        var excerpt = this.getAttribute('data-excerpt');
        var detailUrl = this.getAttribute('data-detail-url');
        var externalLink = this.getAttribute('data-external-link');

        if (hasVideo && embedUrl) {
          openVideoModal(embedUrl, title, date, excerpt, detailUrl);
        } else if (detailUrl) {
          window.location.href = detailUrl;
        } else if (externalLink) {
          window.location.href = externalLink;
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
