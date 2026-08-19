<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scholar Adoption Receipt #ADPT-ID-{{ str_pad($adoption->id, 3, '0', STR_PAD_LEFT) }} — The PARC Foundation</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
      background-color: #f3f4f6;
      color: #1f2937;
      padding: 40px 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
    }
    
    .receipt-card {
      background: #ffffff;
      width: 100%;
      max-width: 650px;
      border-radius: 16px;
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
      overflow: hidden;
      border: 1px solid #e5e7eb;
      position: relative;
    }

    .receipt-header-bar {
      background: linear-gradient(135deg, #f89b1e 0%, #d97706 100%);
      height: 8px;
    }

    .receipt-body {
      padding: 40px;
    }

    .brand-section {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      border-bottom: 2px dashed #e5e7eb;
      padding-bottom: 24px;
      margin-bottom: 28px;
    }

    .brand-logo-wrap {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .brand-logo {
      height: 52px;
      width: auto;
    }

    .brand-title {
      font-size: 1.25rem;
      font-weight: 800;
      color: #111827;
      letter-spacing: -0.02em;
    }

    .brand-subtitle {
      font-size: 0.8rem;
      color: #6b7280;
      font-weight: 500;
    }

    .receipt-badge {
      text-align: right;
    }

    .receipt-badge-title {
      font-size: 0.75rem;
      text-transform: uppercase;
      font-weight: 800;
      letter-spacing: 0.05em;
      color: #f89b1e;
      background: #fff7ed;
      padding: 4px 10px;
      border-radius: 6px;
      border: 1px solid #fed7aa;
      display: inline-block;
      margin-bottom: 6px;
    }

    .receipt-number {
      font-size: 1.1rem;
      font-weight: 700;
      color: #111827;
    }

    .receipt-date {
      font-size: 0.82rem;
      color: #6b7280;
      margin-top: 2px;
    }

    .section-label {
      font-size: 0.75rem;
      text-transform: uppercase;
      font-weight: 700;
      color: #9ca3af;
      letter-spacing: 0.05em;
      margin-bottom: 12px;
    }

    .grid-info {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
      margin-bottom: 28px;
    }

    .info-block label {
      display: block;
      font-size: 0.8rem;
      color: #6b7280;
      font-weight: 500;
      margin-bottom: 4px;
    }

    .info-block p {
      font-size: 0.95rem;
      font-weight: 600;
      color: #111827;
    }

    .amount-box {
      background: #fff8f0;
      border: 1.5px solid #fed7aa;
      border-radius: 12px;
      padding: 20px 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 28px;
    }

    .amount-box-label {
      font-size: 0.9rem;
      font-weight: 600;
      color: #4b5563;
    }

    .amount-box-val {
      font-size: 1.8rem;
      font-weight: 800;
      color: #d97706;
    }

    .details-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 28px;
    }

    .details-table th, .details-table td {
      padding: 12px 14px;
      text-align: left;
      font-size: 0.9rem;
    }

    .details-table th {
      background: #f9fafb;
      color: #4b5563;
      font-weight: 600;
      border-bottom: 1px solid #e5e7eb;
    }

    .details-table td {
      border-bottom: 1px solid #f3f4f6;
      color: #1f2937;
      font-weight: 500;
    }

    .thankyou-note {
      background: #f0fdf4;
      border: 1px solid #bbf7d0;
      border-radius: 10px;
      padding: 16px 20px;
      display: flex;
      gap: 14px;
      align-items: center;
      margin-bottom: 28px;
    }

    .thankyou-icon {
      font-size: 24px;
      color: #16a34a;
    }

    .thankyou-text {
      font-size: 0.85rem;
      color: #15803d;
      line-height: 1.45;
    }

    .receipt-footer {
      text-align: center;
      font-size: 0.78rem;
      color: #9ca3af;
      border-top: 1px solid #f3f4f6;
      padding-top: 20px;
    }

    .action-buttons {
      margin-top: 24px;
      display: flex;
      gap: 12px;
      width: 100%;
      max-width: 650px;
    }

    .btn-action {
      flex: 1;
      padding: 14px 20px;
      border-radius: 10px;
      font-size: 0.95rem;
      font-weight: 700;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: all 0.2s ease;
      text-decoration: none;
    }

    .btn-print {
      background: #f89b1e;
      color: #ffffff;
      border: none;
      box-shadow: 0 4px 12px rgba(248, 155, 30, 0.25);
    }
    .btn-print:hover {
      background: #e08713;
    }

    .btn-close {
      background: #ffffff;
      color: #4b5563;
      border: 1.5px solid #d1d5db;
    }
    .btn-close:hover {
      background: #f9fafb;
    }

    @media print {
      body {
        background: #ffffff;
        padding: 0;
      }
      .action-buttons {
        display: none !important;
      }
      .receipt-card {
        box-shadow: none;
        border: none;
        max-width: 100%;
      }
    }
  </style>
</head>
<body>

  <div class="receipt-card">
    <div class="receipt-header-bar"></div>
    <div class="receipt-body">
      
      {{-- Brand & Header --}}
      <div class="brand-section">
        <div class="brand-logo-wrap">
          <img src="{{ asset('assets/image/parclogo.png') }}" alt="PARC Foundation Logo" class="brand-logo">
          <div>
            <div class="brand-title">The PARC Foundation</div>
            <div class="brand-subtitle">Adopt a Scholar Official Acknowledgment</div>
          </div>
        </div>

        <div class="receipt-badge">
          <span class="receipt-badge-title">Adoption Receipt</span>
          <div class="receipt-number">ADPT-ID-{{ str_pad($adoption->id, 3, '0', STR_PAD_LEFT) }}</div>
          <div class="receipt-date">{{ $adoption->created_at ? $adoption->created_at->setTimezone('Asia/Manila')->format('M d, Y h:i A') : date('M d, Y h:i A') }}</div>
        </div>
      </div>

      {{-- Donor Info --}}
      <div class="section-label">Donor Information</div>
      <div class="grid-info">
        <div class="info-block">
          <label>Donor Name</label>
          <p>{{ $adoption->fname }} {{ $adoption->lname }}</p>
        </div>
        <div class="info-block">
          <label>Email Address</label>
          <p>{{ $adoption->email }}</p>
        </div>
        <div class="info-block">
          <label>Contact Number</label>
          <p>{{ $adoption->phone ?: 'Not provided' }}</p>
        </div>
        <div class="info-block">
          <label>Location / Address</label>
          <p>{{ $adoption->city ? $adoption->city . ', ' : '' }}{{ $adoption->country ?? 'Philippines' }}</p>
        </div>
      </div>

      {{-- Amount Box --}}
      <div class="amount-box">
        <div>
          <div class="amount-box-label">Adoption Sponsorship Pledge</div>
          <div style="font-size: 0.82rem; color: #6b7280; margin-top: 2px;">
            Package: <strong style="color: #111827;">{{ $adoption->package ?? 'Scholar Support' }}</strong>
          </div>
        </div>
        <div class="amount-box-val">₱{{ number_format((float) str_replace(['₱', ','], '', $adoption->amount ?? 0), 2) }}</div>
      </div>

      {{-- Transaction Details Table --}}
      <div class="section-label">Adoption Summary</div>
      <table class="details-table">
        <thead>
          <tr>
            <th>Description</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Adoption Reference ID</td>
            <td>ADPT-ID-{{ str_pad($adoption->id, 3, '0', STR_PAD_LEFT) }}</td>
          </tr>
          <tr>
            <td>Selected Package</td>
            <td><strong>{{ $adoption->package ?? 'Scholar Support' }}</strong></td>
          </tr>
          <tr>
            <td>Payment Method</td>
            <td>{{ strtoupper($adoption->payment_method ?? 'E-WALLET / BANK') }}</td>
          </tr>
          <tr>
            <td>Status</td>
            <td><strong style="color: #16a34a;">Recorded &amp; Confirmed</strong></td>
          </tr>
        </tbody>
      </table>

      {{-- Thank you Note --}}
      <div class="thankyou-note">
        <i class="fa-solid fa-graduation-cap thankyou-icon"></i>
        <div class="thankyou-text">
          <strong>Thank you for changing a scholar's life! 🎓</strong><br>
          Your generous support empowers underprivileged young artists through high-quality arts education, mentorship, workshops, and performance opportunities.
        </div>
      </div>

      {{-- Footer --}}
      <div class="receipt-footer">
        <p>The PARC Foundation Inc. • Registered Non-Profit Organization</p>
        <p style="margin-top: 4px;">This is an official computer-generated electronic adoption receipt.</p>
      </div>

    </div>
  </div>

  {{-- Print & Close Buttons --}}
  <div class="action-buttons">
    <button class="btn-action btn-print" onclick="window.print();">
      <i class="fa-solid fa-print"></i> Print / Save as PDF
    </button>
    <button class="btn-action btn-close" onclick="window.close();">
      <i class="fa-solid fa-xmark"></i> Close Window
    </button>
  </div>

  @if(request()->has('print'))
  <script>
    window.onload = function() {
      setTimeout(function() { window.print(); }, 500);
    };
  </script>
  @endif

</body>
</html>
