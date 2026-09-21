<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PARC Foundation - Admin Login</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/logo/parclogosquare.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('cssfolder/admin.css?v=5.0') }}">
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="admin-body">

<div class="admin-login-wrapper">
  <div class="admin-login-card text-center">
    
    <img src="{{ asset('assets/logo/parclogosquare.png') }}" alt="PARC Logo" class="admin-brand-logo">
    <h3 class="fw-bold mb-1 text-dark">PARC <span style="color: var(--brand-primary);">Admin</span></h3>
    <p class="text-muted small mb-4">Enter master password to access the control center</p>

    @if(session('error'))
      <div class="alert alert-danger py-2 small mb-3 d-flex align-items-center gap-2 text-start" style="background-color: var(--status-danger-soft); color: var(--status-danger); border: 1px solid var(--status-danger-border);">
        <i data-lucide="alert-triangle" style="width: 1.1rem; height: 1.1rem; flex-shrink: 0;"></i>
        <div>{{ session('error') }}</div>
      </div>
    @endif

    @if(session('info'))
      <div class="alert alert-info py-2 small mb-3 d-flex align-items-center gap-2 text-start" style="background-color: var(--status-blue-soft); color: var(--status-blue); border: 1px solid var(--status-blue-border);">
        <i data-lucide="info" style="width: 1.1rem; height: 1.1rem; flex-shrink: 0;"></i>
        <div>{{ session('info') }}</div>
      </div>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST">
      @csrf
      <div class="mb-3 text-start">
        <label for="adminPassword" class="form-label small fw-semibold text-secondary mb-1">
          Admin Password
        </label>
        <div class="position-relative">
          <input type="password" name="password" class="form-control" id="adminPassword" placeholder="Enter password" style="padding: 10px 14px 10px 38px; border-radius: 8px; border: 1px solid var(--admin-border);" required autofocus>
          <div style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-subtle);">
            <i data-lucide="lock" style="width: 1rem; height: 1rem;"></i>
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-brand-primary w-100 py-2 fs-6 justify-content-center mt-2">
        <span>Login to Dashboard</span>
        <i data-lucide="arrow-right"></i>
      </button>
    </form>

    <div class="mt-4 pt-3 border-top" style="border-color: var(--admin-border) !important;">
      <a href="{{ route('welcome') }}" class="text-muted text-decoration-none small d-inline-flex align-items-center gap-1 hover-text-dark">
        <i data-lucide="arrow-left" style="width: 0.9rem; height: 0.9rem;"></i>
        <span>Return to Main Website</span>
      </a>
    </div>

  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    if (window.lucide) {
      lucide.createIcons({ attrs: { 'stroke-width': 1.75 } });
    }
  });
</script>
</body>
</html>
