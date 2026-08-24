<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PARC Foundation - Admin Login</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/logo/parclogosquare.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('cssfolder/admin.css?v=1.0') }}">
</head>
<body class="admin-body">

<div class="admin-login-wrapper">
  <div class="admin-login-card text-center">
    
    <img src="{{ asset('assets/logo/parclogosquare.png') }}" alt="PARC Logo" class="admin-brand-logo">
    <h3 class="fw-bold mb-1">PARC <span style="color: #f6a506;">Admin</span></h3>
    <p class="text-secondary small mb-4">Enter master password to access dashboard</p>

    @if(session('error'))
      <div class="alert alert-danger py-2 small mb-3">
        <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ session('error') }}
      </div>
    @endif

    @if(session('info'))
      <div class="alert alert-info py-2 small mb-3">
        {{ session('info') }}
      </div>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST">
      @csrf
      <div class="form-floating mb-3 text-start">
        <input type="password" name="password" class="form-control bg-dark text-light border-secondary" id="adminPassword" placeholder="Password" required autofocus>
        <label for="adminPassword" class="text-secondary"><i class="bi bi-key me-1"></i> Admin Password</label>
      </div>

      <button type="submit" class="btn btn-sync w-100 py-2 fs-6">
        Login to Dashboard <i class="bi bi-arrow-right-short ms-1"></i>
      </button>
    </form>

    <div class="mt-4 pt-3 border-top border-secondary">
      <a href="{{ route('home') }}" class="text-secondary text-decoration-none small">
        <i class="bi bi-arrow-left"></i> Return to Main Website
      </a>
    </div>

  </div>
</div>

</body>
</html>
