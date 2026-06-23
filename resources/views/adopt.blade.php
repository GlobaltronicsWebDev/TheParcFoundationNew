<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PARC Foundation</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('cssfolder/mainnavbar.css') }}">
  <link rel="stylesheet" href="{{ asset('cssfolder/adopt.css') }}" />
  <link rel="stylesheet" href="{{ asset('cssfolder/parcform.css') }}" />

  
</head>
<body>
  <!-- Include Navbar -->
  @include('layouts.navbar')

  <!-- Adopt Main Content -->
  <div class="container adoptsection">
    <div class="row row-cols-2">
      
      <!-- Left Column -->
      <div class="col col1">
        <div class="intro">
          <h1 class="text-left my-5 title">Adopt a Scholar</h1>
          
          <img src="{{ asset('./assets/image/groupsing.png') }}" 
               alt="Donate Image" 
               class="img-fluid mb-4 img1" />

          <img src="{{ asset('./assets/image/AdoptImageMobile.jpg') }}" 
               alt="Donate Image Mobile" 
               class="img-fluid mb-4 img2" />

          <p class="text-left desc1">
            The program invites individuals and organizations to <br>
            support talented youth from underprivileged <br>
            backgrounds.
          </p>

          <p class="text-left desc2">
            Your pledge helps cover training costs, empowering <br>
            scholars to pursue their dreams in the arts.
          </p>
        </div>

        <!-- Details Section -->
        <div class="details">
          <div class="pdt">
            <p>HOW IT WORKS?</p>
          </div>

          <div class="details-list">
            
            <!-- Pledge Commitment -->
            <div class="detail-item">
              <div class="music-icon">
                <img src="{{ asset('assets/icons/Hands.png') }}" alt="Hands" />
              </div>
              <p>
                <b>Pledge Commitment</b><br>
                Donors can adopt a scholar by choosing a 2025 scholarship package that covers training expenses.
              </p>
            </div>
            <hr />

            <!-- Duration -->
            <div class="detail-item">
              <div class="detail-icon">
                <img src="{{ asset('assets/icons/Time.png') }}" alt="Instrument" />
              </div>
              <p>
                <b>Duration</b><br>
                Commitment periods vary by package, offering flexible options for donors.
              </p>
            </div>
            <hr />

            <!-- Transparency -->
            <div class="detail-item">
              <div class="detail-icon">
                <img src="{{ asset('assets/icons/Search.png') }}" alt="Bus" />
              </div>
              <p>
                <b>Impact Transparency</b><br>
                Donors receive regular updates on their scholar’s progress and impact through newsletters and personal messages.
              </p>
            </div>
            <hr />

            <!-- Recognition -->
            <div class="detail-item">
              <div class="detail-icon">
                <img src="{{ asset('assets/icons/Award.png') }}" alt="Apple" />
              </div>
              <p>
                <b>Recognition</b><br>
                Donors are recognized on The PARC Foundation’s website, social media, and events for their support of the arts and young talent.
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column -->
      <div class="col col2">
        <div class="adoptform">

          <h2 class="maintitle">ADOPTION PACKAGES</h2>

          <!-- Packages Buttons -->
          <div class="btn-packages">
            
            <!-- Top Buttons -->
            <div class="center-btn topbtn">
              <a href="#" class="btnm1">Patron</a>
              <a href="#" class="btnm2">Silver</a>
              <a href="#" class="btnm3">Gold</a>
            </div>

            <!-- Lower Buttons -->
            <div class="center-btn lower-btn">
              <a href="#" class="btn1">Platinum</a>
              <a href="#" class="btn2">Share what you can</a>
            </div>

            <!-- Patron Note -->
            <div class="notepatron">
              <div class="note-header">
                <p class="p1">
                  PATRON <span class="badge-duration">3-MONTHS DURATION</span>
                </p>
                <p class="price-tag">
                  ₱15,000 <span class="small">/ Scholar</span>
                </p>
              </div>

              <p class="p3">Training expenses for intermediate skill development workshops, Mentor’s fee, collaterals, and etc.</p>
              <hr>
              <p class="p3">Recognition on the PARC Foundation website.</p>
              <hr>
              <p class="p4">Quarterly progress update.</p>
              <hr>
              <p class="p5">Invitation to the annual scholar showcase event.</p>
            </div> 

            <!-- Silver Note -->
            <div class="notesilver">
              <div class="note-header">
                <p class="p1">
                  SILVER <span class="badge-duration">3-MONTHS DURATION</span>
                </p>
                <p class="price-tag">
                  ₱15,000 <span class="small">/ Scholar</span>
                </p>
              </div>

              <p class="p3">Training expenses for intermediate skill development workshops, Mentor’s fee, collaterals, and etc.</p>
              <hr>
              <p class="p3">Recognition on the PARC Foundation website.</p>
              <hr>
              <p class="p4">Quarterly progress update.</p>
              <hr>
              <p class="p5">Invitation to the annual scholar showcase event.</p>
            </div>

            <!-- Gold Note --> 
            <div class="notegold">
              <div class="note-header">
                <p class="p1">
                  GOLD <span class="badge-duration">3-MONTHS DURATION</span>
                </p>
                <p class="price-tag">
                  ₱15,000 <span class="small">/ Scholar</span>
                </p>
              </div>

              <p class="p3">Training expenses for intermediate skill development workshops, Mentor’s fee, collaterals, and etc.</p>
              <hr>
              <p class="p3">Recognition on the PARC Foundation website.</p>
              <hr>
              <p class="p4">Quarterly progress update.</p>
              <hr>
              <p class="p5">Invitation to the annual scholar showcase event.</p>
            </div>

            <!-- Platinum Note -->
            <div class="noteplatinum">
              <div class="note-header">
                <p class="p1">
                  PLATINUM <span class="badge-duration">3-MONTHS DURATION</span>
                </p>
                <p class="price-tag">
                  ₱15,000 <span class="small">/ Scholar</span>
                </p>
              </div>

              <p class="p3">Training expenses for intermediate skill development workshops, Mentor’s fee, collaterals, and etc.</p>
              <hr>
              <p class="p3">Recognition on the PARC Foundation website.</p>
              <hr>
              <p class="p4">Quarterly progress update.</p>
              <hr>
              <p class="p5">Invitation to the annual scholar showcase event.</p>
            </div> 

            
          </div><!-- End of btn-packages -->
            <hr class="break" />

  <!-- Include Parcform -->
  @include('layouts.adoptform')
        </div>

      </div>
    </div>
  </div>

  <!-- Include Footer -->
  @include('layouts.footer')

  <!-- JS -->
  <script src="{{ asset('jsfolder/packages.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>