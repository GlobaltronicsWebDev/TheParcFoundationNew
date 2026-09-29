<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>{{ $article->title }} | The PARC Foundation News</title>
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
    body,
    .news-detail-wrapper,
    .article-header,
    .article-title,
    .article-content,
    .related-section,
    .related-card {
      font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    }
    .news-detail-wrapper {
      padding-top: 185px;
      padding-bottom: 80px;
      background: #fdfdfd;
      min-height: 80vh;
    }
    .news-breadcrumb {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap: 8px;
      font-size: 0.92rem;
      margin-bottom: 24px;
      color: #64748b;
    }
    .news-breadcrumb a {
      color: #f7581e;
      text-decoration: none;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      transition: color 0.2s ease;
    }
    .news-breadcrumb a:hover {
      color: #e04b16;
      text-decoration: underline;
    }
    .news-breadcrumb .breadcrumb-separator {
      color: #94a3b8;
      font-weight: 400;
      user-select: none;
    }
    .news-breadcrumb .breadcrumb-current {
      color: #475569;
      font-weight: 500;
      max-width: 450px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    @media (max-width: 576px) {
      .news-breadcrumb .breadcrumb-current {
        max-width: 200px;
      }
    }
    .article-header {
      margin-bottom: 30px;
    }
    .article-category {
      display: inline-block;
      padding: 6px 14px;
      background: rgba(247, 88, 30, 0.1);
      color: #f7581e;
      font-weight: 700;
      font-size: 0.82rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border-radius: 50px;
      margin-bottom: 14px;
    }
    .article-title {
      font-size: 2.4rem;
      font-weight: 800;
      color: #1a1a1a;
      line-height: 1.25;
      margin-bottom: 16px;
    }
    .article-meta {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 16px;
      font-size: 0.9rem;
      color: #718096;
      padding-bottom: 20px;
      border-bottom: 1px solid #edf2f7;
    }
    .article-meta i {
      color: #f7581e;
      margin-right: 4px;
    }
    .video-container {
      position: relative;
      width: 100%;
      padding-bottom: 56.25%; /* 16:9 aspect ratio */
      height: 0;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
      background: #000;
      margin-bottom: 36px;
    }
    .video-container iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border: 0;
    }
    .article-hero-image {
      width: 100%;
      max-height: 520px;
      object-fit: cover;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      margin-bottom: 36px;
    }
    .article-lead {
      font-size: 1.22rem;
      font-weight: 500;
      line-height: 1.7;
      color: #2d3748;
      margin-bottom: 28px;
      border-left: 4px solid #f7581e;
      padding-left: 18px;
    }
    .article-body {
      font-size: 1.05rem;
      line-height: 1.85;
      color: #4a5568;
    }
    .article-body p {
      margin-bottom: 20px;
      white-space: pre-line;
    }
    .article-actions {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      padding-top: 30px;
      margin-top: 40px;
      border-top: 1px solid #edf2f7;
    }
    .btn-parc-orange {
      background: #f7581e;
      color: #fff;
      font-weight: 700;
      padding: 10px 22px;
      border-radius: 8px;
      text-decoration: none;
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }
    .btn-parc-orange:hover {
      background: #e04b16;
      color: #fff;
      transform: translateY(-2px);
    }
    .btn-outline-back {
      border: 1.5px solid #cbd5e1;
      color: #475569;
      font-weight: 600;
      padding: 9px 20px;
      border-radius: 8px;
      text-decoration: none;
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }
    .btn-outline-back:hover {
      border-color: #f7581e;
      color: #f7581e;
      background: #fff;
    }
    .related-section {
      background: #f8fafc;
      padding: 70px 0;
      border-top: 1px solid #e2e8f0;
    }
    .related-card {
      background: #fff;
      border-radius: 14px;
      overflow: hidden;
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05);
      transition: transform 0.25s ease, box-shadow 0.25s ease;
      height: 100%;
      display: flex;
      flex-direction: column;
      text-decoration: none;
      color: inherit;
    }
    .related-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
      color: inherit;
    }
    .related-card-img-wrap {
      position: relative;
      height: 190px;
      overflow: hidden;
      background: #f1f5f9;
    }
    .related-card-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s ease;
    }
    .related-card:hover .related-card-img {
      transform: scale(1.05);
    }
    .related-card-badge {
      position: absolute;
      top: 12px;
      left: 12px;
      background: rgba(0, 0, 0, 0.7);
      color: #fff;
      padding: 4px 10px;
      font-size: 0.75rem;
      border-radius: 20px;
      backdrop-filter: blur(4px);
    }
    .related-card-yt {
      position: absolute;
      bottom: 12px;
      right: 12px;
      background: #ff0000;
      color: #fff;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }
    .related-card-body {
      padding: 20px;
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .related-card-title {
      font-size: 1.1rem;
      font-weight: 700;
      color: #1e293b;
      margin-bottom: 10px;
      line-height: 1.4;
    }
    .related-card-date {
      font-size: 0.8rem;
      color: #94a3b8;
      margin-top: auto;
    }
    @media (max-width: 991px) {
      .news-detail-wrapper {
        padding-top: 175px;
      }
    }
    @media (max-width: 768px) {
      .article-title {
        font-size: 1.75rem;
      }
    }
    @media (max-width: 576px) {
      .news-detail-wrapper {
        padding-top: 160px;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  @include('layouts.navbar')

  <div class="news-detail-wrapper">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-9">

          <!-- Breadcrumb -->
          <div class="news-breadcrumb">
            <a href="{{ url('/') }}"><i class="bi bi-house-door-fill me-1"></i> Home</a>
            <span class="breadcrumb-separator">/</span>
            <a href="{{ route('news') }}">News</a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">{{ $article->title }}</span>
          </div>

          <!-- Header -->
          <div class="article-header">
            <span class="article-category">{{ $article->category ?? 'News & Story' }}</span>
            <h1 class="article-title">{{ $article->title }}</h1>
            
            <div class="article-meta">
              <span><i class="bi bi-calendar3"></i> {{ $article->formatted_date }}</span>
              @if(!empty($article->youtube_url))
                <span class="text-danger fw-bold"><i class="bi bi-youtube"></i> Video Story</span>
              @endif
              @if($article->views_count > 0)
                <span><i class="bi bi-eye"></i> {{ number_format($article->views_count) }} views</span>
              @endif
            </div>
          </div>

          <!-- YouTube Video Player OR Hero Image -->
          @if(!empty($article->youtube_embed_url))
            <div class="video-container">
              <iframe 
                src="{{ $article->youtube_embed_url }}" 
                title="{{ $article->title }}" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                allowfullscreen>
              </iframe>
            </div>
          @elseif(!empty($article->display_image))
            <img src="{{ $article->display_image }}" alt="{{ $article->title }}" class="article-hero-image">
          @endif

          <!-- Lead Paragraph / Excerpt -->
          @if(!empty($article->excerpt))
            <div class="article-lead">
              {{ $article->excerpt }}
            </div>
          @endif

          <!-- Full Content -->
          @if(!empty($article->content))
            <div class="article-body">
              <p>{{ $article->content }}</p>
            </div>
          @endif

          <!-- Bottom Actions & External Links -->
          <div class="article-actions">
            <div>
              <a href="{{ route('news') }}" class="btn-outline-back">
                <i class="bi bi-arrow-left"></i> Back to News
              </a>
            </div>

            <div class="d-flex align-items-center gap-2">
              @if(!empty($article->external_link))
                <a href="{{ $article->external_link }}" target="_blank" rel="noopener" class="btn-parc-orange">
                  Learn More <i class="bi bi-box-arrow-up-right"></i>
                </a>
              @endif
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Related News Section -->
  @if($relatedArticles->count() > 0)
    <section class="related-section">
      <div class="container">
        <div class="text-center mb-5">
          <h3 class="fw-bold" style="color: #1e293b;">More Stories & Updates</h3>
          <p class="text-muted">Stay connected with our latest creative breakthroughs</p>
        </div>

        <div class="row g-4 justify-content-center">
          @foreach($relatedArticles as $rel)
            <div class="col-md-4">
              <a href="{{ route('news.show', $rel->slug ?: $rel->id) }}" class="related-card">
                <div class="related-card-img-wrap">
                  <img src="{{ $rel->display_image }}" alt="{{ $rel->title }}" class="related-card-img">
                  <span class="related-card-badge">{{ $rel->category ?? 'News' }}</span>
                  @if(!empty($rel->youtube_url))
                    <span class="related-card-yt" title="Includes YouTube Video"><i class="bi bi-play-fill" style="font-size: 1.1rem; margin-left: 2px;"></i></span>
                  @endif
                </div>
                <div class="related-card-body">
                  <h4 class="related-card-title">{{ Str::limit($rel->title, 65) }}</h4>
                  <div class="related-card-date">
                    <i class="bi bi-calendar3 me-1"></i> {{ $rel->formatted_date }}
                  </div>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  <!-- Contacts & Footer -->
  @include('layouts.contacts')
  @include('layouts.footer')

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
