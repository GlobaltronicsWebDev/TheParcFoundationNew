<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>PARC Foundation — Events Video Gallery</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/logo/parclogosquare.png') }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('cssfolder/mainnavbar.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/contacts.css') }}" />
  <link rel="stylesheet" href="{{ asset('cssfolder/events-gallery.css') }}" />
</head>
<body>
  @include('layouts.navbar')

  <section class="gallery-section">
    <div class="container px-4">

      <h1 class="gallery-title text-center">Events Video Gallery</h1>

      <div class="gallery-layout">

        <!-- Sidebar Playlist -->
        <aside class="gallery-sidebar">
          <ul class="playlist" id="playlist">

            <li class="playlist-item active"
                data-video="{{ asset("assets/video/PARC'D.mp4") }}"
                data-title="PARC'D">
              PARC'D
            </li>
            <li class="playlist-item"
                data-video="https://www.youtube-nocookie.com/embed/Hge6Hx049Co"
                data-title="PARC Wilmer Ong Guido Hall Inauguration 2019">
              PARC WILMER ONG GUIDO HALL INAUGURATION 2019
            </li>
            <li class="playlist-item"
                data-video="https://www.youtube-nocookie.com/embed/sdszrNqyD9o"
                data-title="PARC Spirit of Giving (SOG)">
              PARC SPIRIT OF GIVING (SOG)
            </li>
            <li class="playlist-item"
                data-video="https://www.youtube-nocookie.com/embed/P4dfVXDMKbc"
                data-title="A Walk in the PARC Open House Festival">
              A WALK IN THE PARC OPEN HOUSE FESTIVAL
            </li>
            <li class="playlist-item"
                data-video="https://www.youtube-nocookie.com/embed/BSOUjBJnb50"
                data-title="Music Video Featuring The PARC Foundation [U N I by Q-York feat. Jay R]">
              MUSIC VIDEO FEATURING THE PARC FOUNDATION [U N I BY Q-YORK FEAT. JAY R]
            </li>
            <li class="playlist-item"
                data-video="https://www.youtube-nocookie.com/embed/9Rd8WUi2Uz8"
                data-title="PARCaralan Performance at Sun Yu Li x Ramon Orlina Exhibit [U N I by Q-York feat. Jay R]">
              PARCARALAN PERFORMANCE AT SUN YU LI X RAMON ORLINA EXHIBIT AT THE PODIUM [U N I BY Q-YORK FEAT. JAY R]
            </li>
            <li class="playlist-item"
                data-video="https://www.youtube-nocookie.com/embed/U2l4ZTiFsDI"
                data-title="PARCaralan Performance at ABS-CBN Foundation Ball at EDSA Shangri-La">
              PARCARALAN PERFORMANCE AT ABS-CBN FOUNDATION BALL AT EDSA SHANGRI-LA
            </li>
            <li class="playlist-item"
                data-video="https://www.youtube-nocookie.com/embed/_RP8AvJ6NsI"
                data-title="PARC Coke Studio Season 3 Christmas Special">
              PARC COKE STUDIO SEASON 3 CHRISTMAS SPECIAL
            </li>

          </ul>
        </aside>

        <!-- Main Video Player -->
        <div class="gallery-player">
          <div class="player-card">
            <h2 class="player-title" id="player-title">PARC'D</h2>
            <div class="video-wrapper">
              <iframe
                id="main-video-iframe"
                src=""
                title="PARC Event Video"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
                style="display: none;">
              </iframe>
              <video
                id="main-video-player"
                controls
                style="display: block;">
                <source src="{{ asset("assets/video/PARC'D.mp4") }}" type="video/mp4">
                Your browser does not support the video tag.
              </video>
            </div>
          </div>
        </div>

      </div>
    </div>
    
  </section>

  <!-- ===================== Events List Section ===================== -->
  <section class="events-list-section">
    <div class="container px-4">

      <h2 class="events-list-title text-center">Events List</h2>

      <!-- Year Filter -->
      <div class="events-list-filter text-center">
        <label class="elf-option active" data-year="all"><span class="elf-dot"></span> ALL EVENTS</label>
        <label class="elf-option" data-year="2026"><span class="elf-dot"></span> 2026</label>
        <label class="elf-option" data-year="2025"><span class="elf-dot"></span> 2025</label>
        <label class="elf-option" data-year="2024"><span class="elf-dot"></span> 2024</label>
        <label class="elf-option" data-year="2023"><span class="elf-dot"></span> 2023</label>

        <!-- Older years behind arrow -->
        <div class="elf-more-wrap">
          <button class="elf-arrow-btn" id="elf-toggle" title="Show older years">&#8250;</button>
          <div class="elf-older" id="elf-older">
            <label class="elf-option" data-year="2022"><span class="elf-dot"></span> 2022</label>
            <label class="elf-option" data-year="2021"><span class="elf-dot"></span> 2021</label>
            <label class="elf-option" data-year="2020"><span class="elf-dot"></span> 2020</label>
            <label class="elf-option" data-year="2019"><span class="elf-dot"></span> 2019</label>
            <label class="elf-option" data-year="2018"><span class="elf-dot"></span> 2018</label>
            <label class="elf-option" data-year="2017"><span class="elf-dot"></span> 2017</label>
            <label class="elf-option" data-year="2016"><span class="elf-dot"></span> 2016</label>
          </div>
        </div>
      </div>

      <!-- Events Image Grid -->
      <div class="events-list-grid" id="events-list-grid">

        <!-- 2026 -->
        <div class="el-card" data-year="2026">
          <img src="{{ asset('./assets/image/NEWS/PARC_MAYONAISE.png') }}" alt="PARC'D with Mayonnaise">
        </div>

        <!-- 2022 -->
        <div class="el-card" data-year="2022">
          <img src="{{ asset('./assets/image/SOGPOSTER2022.webp') }}" alt="Spirit of Giving 2022">
        </div>
        <div class="el-card" data-year="2022">
          <img src="{{ asset('./assets/image/Artiparc.webp') }}" alt="ARTiPARC">
        </div>
        <div class="el-card" data-year="2022">
          <img src="{{ asset('./assets/image/spiritgiving.webp') }}" alt="Balik-JAM sa PARCaralan">
        </div>

        <!-- 2021 -->
        <div class="el-card" data-year="2021">
          <img src="{{ asset('./assets/image/sog2021part1.webp') }}" alt="Spirit of Giving 2021">
        </div>
        <div class="el-card" data-year="2021">
          <img src="{{ asset('./assets/image/sog2021_gigi.webp') }}" alt="SOG 2021 - Gigi De Lana">
        </div>
        <div class="el-card" data-year="2021">
          <img src="{{ asset('./assets/image/sog2021_CK.webp') }}" alt="SOG 2021 - Corey Koh">
        </div>
        <div class="el-card" data-year="2021">
          <img src="{{ asset('./assets/image/sog2021_NLA.webp') }}" alt="SOG 2021 - Nicole Asensio">
        </div>

        <!-- 2020 -->
        <div class="el-card" data-year="2020">
          <img src="{{ asset('./assets/image/EVENTS/2020/03.19.20 PARCners_ Night 2020 Vision.jpg') }}" alt="PARCners Night 2020 Vision">
        </div>
        <div class="el-card" data-year="2020">
          <img src="{{ asset('./assets/image/EVENTS/2020/02.27.20 REISE Mixed Voices in Manila.jpg') }}" alt="REISE Mixed Voices in Manila">
        </div>
        <div class="el-card" data-year="2020">
          <img src="{{ asset('./assets/image/EVENTS/2020/02.29.20 Act Avenue Theater Festival.jpg') }}" alt="Act Avenue Theater Festival">
        </div>
        <div class="el-card" data-year="2020">
          <img src="{{ asset('./assets/image/EVENTS/2020/02.25.20 Take the Leap into Entrepreneurship.jpg') }}" alt="Take the Leap into Entrepreneurship">
        </div>
        <div class="el-card" data-year="2020">
          <img src="{{ asset('./assets/image/EVENTS/new event/Project Tempo_Poster.jpg') }}" alt="Project TEMPO">
        </div>
        <div class="el-card" data-year="2020">
          <img src="{{ asset('./assets/image/EVENTS/new event/4thPFD_FB POSTER1.jpg') }}" alt="4th PARC Foundation Day">
        </div>
        <div class="el-card" data-year="2020">
          <img src="{{ asset('./assets/image/EVENTS/new event/Tambayan May Paki! U Theater Festival (Act Avenue x PARC).jpg') }}" alt="Tambayan May Paki">
        </div>

        <!-- 2019 -->
        <div class="el-card" data-year="2019">
          <img src="{{ asset('./assets/image/EVENTS/2019/12.11.19 Spirit of Giving.jpg') }}" alt="Spirit of Giving 2019">
        </div>
        <div class="el-card" data-year="2019">
          <img src="{{ asset('./assets/image/Copy of GoVol 2019 Poster.webp') }}" alt="GoVol 2019">
        </div>
        <div class="el-card" data-year="2019">
          <img src="{{ asset('./assets/image/EVENTS/2019/11.23.19 Short and Sweet Theatre Festival Finals.jpg') }}" alt="Short and Sweet Theatre Festival Finals">
        </div>
        <div class="el-card" data-year="2019">
          <img src="{{ asset('./assets/image/EVENTS/2019/11.09.19 Short and Sweet Theatre Festival.jpg') }}" alt="Short and Sweet Theatre Festival">
        </div>
        <div class="el-card" data-year="2019">
          <img src="{{ asset('./assets/image/EVENTS/2019/10.20.19 Sampung Bagong Dula.jpg') }}" alt="Sampung Bagong Dula">
        </div>
        <div class="el-card" data-year="2019">
          <img src="{{ asset('./assets/image/EVENTS/2019/10.18.19 Unstage.jpg') }}" alt="Unstage">
        </div>
        <div class="el-card" data-year="2019">
          <img src="{{ asset('./assets/image/EVENTS/2019/10.11.19 Shorts _ Briefs Theater Festival.jpg') }}" alt="Shorts & Briefs Theater Festival">
        </div>
        <div class="el-card" data-year="2019">
          <img src="{{ asset('./assets/image/EVENTS/2019/09.13.19 Company A Musical Comedy.jpg') }}" alt="Company: A Musical Comedy">
        </div>
        <div class="el-card" data-year="2019">
          <img src="{{ asset('./assets/image/EVENTS/2019/09.05.19 Sun Yu Li x Ramon Orlina Exhibit.jpg') }}" alt="Sun Yu Li x Ramon Orlina Exhibit">
        </div>
        <div class="el-card" data-year="2019">
          <img src="{{ asset('./assets/image/EVENTS/2019/05.18.19 A Walk in The PARC.jpg') }}" alt="A Walk in The PARC">
        </div>
        <div class="el-card" data-year="2019">
          <img src="{{ asset('./assets/image/EVENTS/2019/02.16.19 Lucinda_s Big Opening.jpeg') }}" alt="Lucinda's Big Opening">
        </div>
        <div class="el-card" data-year="2019">
          <img src="{{ asset('./assets/image/EVENTS/2019/02.15.19 Two Left Feet.png') }}" alt="Two Left Feet">
        </div>

        <!-- 2018 -->
        <div class="el-card" data-year="2018">
          <img src="{{ asset('./assets/image/EVENTS/2018/06.01.18 The PARC Foundation Day.jpg') }}" alt="The PARC Foundation Day 2018">
        </div>
        <div class="el-card" data-year="2018">
          <img src="{{ asset('./assets/image/EVENTS/2018/05.19.18 I Dance I Give.jpg') }}" alt="I Dance I Give">
        </div>
        <div class="el-card" data-year="2018">
          <img src="{{ asset('./assets/image/EVENTS/2018/05.12.18 From Pen to Pixels.jpg') }}" alt="From Pen to Pixels">
        </div>
        <div class="el-card" data-year="2018">
          <img src="{{ asset('./assets/image/EVENTS/2018/05.12.18 Basic Acrylic Painting.jpg') }}" alt="Basic Acrylic Painting">
        </div>
        <div class="el-card" data-year="2018">
          <img src="{{ asset('./assets/image/EVENTS/2018/03.19.18 Summer Workshops.png') }}" alt="Summer Workshops 2018">
        </div>
        <div class="el-card" data-year="2018">
          <img src="{{ asset('./assets/image/EVENTS/2018/02.17.18 Si Saldang, Si Marvin, at ang Halimaw ng Gabi.png') }}" alt="Si Saldang Si Marvin">
        </div>
        <div class="el-card" data-year="2018">
          <img src="{{ asset('./assets/image/EVENTS/2018/02.10.18 Improviliga.jpg') }}" alt="Improviliga">
        </div>
        <div class="el-card" data-year="2018">
          <img src="{{ asset('./assets/image/EVENTS/2018/01.13.18 Remembering Wilmer.jpg') }}" alt="Remembering Wilmer">
        </div>
        <div class="el-card" data-year="2018">
          <img src="{{ asset('./assets/image/EVENTS/2018/01.10.18 Launchpad.png') }}" alt="Launchpad">
        </div>
        <div class="el-card" data-year="2018">
          <img src="{{ asset('./assets/image/Copy of Spring Awakening blueREP Main Poster.webp') }}" alt="Spring Awakening">
        </div>
        <div class="el-card" data-year="2018">
          <img src="{{ asset('./assets/image/Copy of May Isang Sundalo poster final.webp') }}" alt="May Isang Sundalo">
        </div>

        <!-- 2017 -->
        <div class="el-card" data-year="2017">
          <img src="{{ asset('./assets/image/EVENTS/2017/07.08.17 UNO What Do We Do.jpg') }}" alt="UNO What Do We Do">
        </div>
        <div class="el-card" data-year="2017">
          <img src="{{ asset('./assets/image/EVENTS/2017/06.30.17 Love is Love is Love.png') }}" alt="Love is Love is Love">
        </div>
        <div class="el-card" data-year="2017">
          <img src="{{ asset('./assets/image/EVENTS/2017/06.25.17 International Yoga Day.jpg') }}" alt="International Yoga Day">
        </div>
        <div class="el-card" data-year="2017">
          <img src="{{ asset('./assets/image/EVENTS/2017/05.27.17 Aftershookt.jpg') }}" alt="Aftershookt">
        </div>
        <div class="el-card" data-year="2017">
          <img src="{{ asset('./assets/image/EVENTS/2017/05.20.17 LIKHA.jpg') }}" alt="LIKHA">
        </div>
        <div class="el-card" data-year="2017">
          <img src="{{ asset('./assets/image/EVENTS/2017/04.01.17 ARAW Summer Workshops.jpg') }}" alt="ARAW Summer Workshops">
        </div>
        <div class="el-card" data-year="2017">
          <img src="{{ asset('./assets/image/EVENTS/2017/03.11.17 FinArts.jpg') }}" alt="FinArts">
        </div>
        <div class="el-card" data-year="2017">
          <img src="{{ asset('./assets/image/EVENTS/2017/02.11.17 String Theory.jpg') }}" alt="String Theory">
        </div>
        <div class="el-card" data-year="2017">
          <img src="{{ asset('./assets/image/EVENTS/2017/02.11.17 Love Labs.jpg') }}" alt="Love Labs">
        </div>
        <div class="el-card" data-year="2017">
          <img src="{{ asset('./assets/image/EVENTS/2017/02.10.17 Under the Stars.jpg') }}" alt="Under the Stars">
        </div>
        <div class="el-card" data-year="2017">
          <img src="{{ asset('./assets/image/EVENTS/2017/02.06.17 Estado.jpg') }}" alt="Estado">
        </div>
        <div class="el-card" data-year="2017">
          <img src="{{ asset('./assets/image/EVENTS/2017/01.28.17 NOSYON Staged Reading.jpg') }}" alt="NOSYON Staged Reading">
        </div>

        <!-- 2016 -->
        <div class="el-card" data-year="2016">
          <img src="{{ asset('./assets/image/EVENTS/2016/12.28.16 COUNTDOWN.jpg') }}" alt="COUNTDOWN">
        </div>
        <div class="el-card" data-year="2016">
          <img src="{{ asset('./assets/image/EVENTS/2016/12.26.16 THREEFOLD.jpg') }}" alt="THREEFOLD">
        </div>
        <div class="el-card" data-year="2016">
          <img src="{{ asset('./assets/image/EVENTS/2016/12.22.16 Donation Drive.jpg') }}" alt="Donation Drive">
        </div>
        <div class="el-card" data-year="2016">
          <img src="{{ asset('./assets/image/EVENTS/2016/12.18.16 Who Got Hugot.jpg') }}" alt="Who Got Hugot">
        </div>
        <div class="el-card" data-year="2016">
          <img src="{{ asset('./assets/image/EVENTS/2016/12.18.16 Tri.Cycle.jpg') }}" alt="Tri.Cycle">
        </div>
        <div class="el-card" data-year="2016">
          <img src="{{ asset('./assets/image/EVENTS/2016/12.13.16 COEXISTENCE.jpg') }}" alt="COEXISTENCE">
        </div>
        <div class="el-card" data-year="2016">
          <img src="{{ asset('./assets/image/EVENTS/2016/12.10.16 Haha Have a Merry Christmas.jpg') }}" alt="Haha Have a Merry Christmas">
        </div>
        <div class="el-card" data-year="2016">
          <img src="{{ asset('./assets/image/EVENTS/2016/12.03.16 FVSE.jpg') }}" alt="FVSE">
        </div>
        <div class="el-card" data-year="2016">
          <img src="{{ asset('./assets/image/EVENTS/2016/11.30.16 Improv Jam.jpg') }}" alt="Improv Jam">
        </div>
        <div class="el-card" data-year="2016">
          <img src="{{ asset('./assets/image/EVENTS/2016/11.04.16 U-Jam.jpg') }}" alt="U-Jam">
        </div>
        <div class="el-card" data-year="2016">
          <img src="{{ asset('./assets/image/EVENTS/2016/07.15.16 Suicide Incorporated.jpg') }}" alt="Suicide Incorporated">
        </div>
        <div class="el-card" data-year="2016">
          <img src="{{ asset('./assets/image/EVENTS/2016/06.01.16 Dance at The PARC.jpg') }}" alt="Dance at The PARC">
        </div>

      </div>
      <!-- /events-list-grid -->

    </div>
  </section>
  <!-- ===================== End Events List ===================== -->

  @include('layouts.contacts')
  @include('layouts.footer')

  <script src="{{ asset('jsfolder/packages.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    const items = document.querySelectorAll('.playlist-item');
    const mainVideoIframe = document.getElementById('main-video-iframe');
    const mainVideoPlayer = document.getElementById('main-video-player');
    const playerTitle = document.getElementById('player-title');

    items.forEach(item => {
      item.addEventListener('click', function () {
        items.forEach(i => i.classList.remove('active'));
        this.classList.add('active');

        const videoUrl = this.dataset.video;
        playerTitle.textContent = this.dataset.title;

        const isLocalVideo = videoUrl.endsWith('.mp4') || videoUrl.includes('/assets/video/');

        if (isLocalVideo) {
          // Hide iframe and reset src to stop it
          mainVideoIframe.style.display = 'none';
          mainVideoIframe.src = '';

          // Show video player and play the local file
          mainVideoPlayer.style.display = 'block';
          mainVideoPlayer.src = videoUrl;
          mainVideoPlayer.play().catch(error => {
            console.log("Autoplay was prevented, waiting for user interaction:", error);
          });
        } else {
          // Hide video player and pause/clear it
          mainVideoPlayer.style.display = 'none';
          mainVideoPlayer.pause();
          mainVideoPlayer.src = '';

          // Show iframe and load YouTube embed
          mainVideoIframe.style.display = 'block';
          let embedUrl = videoUrl;
          if (embedUrl.includes('youtube.com/watch?v=')) {
            const videoId = embedUrl.split('v=')[1].split('&')[0];
            embedUrl = `https://www.youtube-nocookie.com/embed/${videoId}`;
          }
          mainVideoIframe.src = embedUrl + (embedUrl.includes('?') ? '&' : '?') + 'autoplay=1&rel=0';
        }
      });
    });
    // Events List year filter
    const elfOptions = document.querySelectorAll('.elf-option');
    const elCards = document.querySelectorAll('.el-card');

    elfOptions.forEach(option => {
      option.addEventListener('click', function () {
        elfOptions.forEach(o => o.classList.remove('active'));
        this.classList.add('active');
        const year = this.dataset.year;
        elCards.forEach(card => {
          card.style.display = (year === 'all' || card.dataset.year === year) ? 'block' : 'none';
        });
      });
    });

    // Arrow toggle for older years
    const elfToggle = document.getElementById('elf-toggle');
    const elfOlder = document.getElementById('elf-older');
    elfToggle.addEventListener('click', function () {
      const isOpen = elfOlder.classList.toggle('open');
      this.style.transform = isOpen ? 'rotate(90deg)' : 'rotate(0deg)';
    });
  </script>
</body>
</html>
