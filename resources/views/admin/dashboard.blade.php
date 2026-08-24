<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PARC Foundation - Admin Dashboard</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/logo/parclogosquare.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('cssfolder/admin.css?v=1.0') }}">
</head>
<body class="admin-body">

  <!-- Navbar -->
  <nav class="admin-navbar d-flex justify-content-between align-items-center">
    <a href="{{ route('admin.dashboard') }}" class="admin-nav-brand">
      <img src="{{ asset('assets/logo/parclogosquare.png') }}" width="36" alt="Logo">
      PARC <span>Dashboard</span>
    </a>
    <div class="d-flex align-items-center gap-3">
      <form action="{{ route('admin.sync') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-sync btn-sm">
          <i class="bi bi-arrow-repeat me-1"></i> Sync Google Sheets
        </button>
      </form>
      <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-outline-secondary btn-sm text-light">
          <i class="bi bi-box-arrow-right me-1"></i> Logout
        </button>
      </form>
    </div>
  </nav>

  <div class="container-fluid p-4">

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show border-0 bg-success text-white mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show border-0 bg-danger text-white mb-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
      </div>
    @endif

    <!-- Top Stats Row -->
    <div class="row g-3 mb-4">
      <div class="col-md-3">
        <div class="stat-card">
          <div class="stat-icon"><i class="bi bi-currency-dollar"></i></div>
          <div class="stat-value">₱{{ number_format($totalRaised, 2) }}</div>
          <div class="stat-label">Total Funds Raised</div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="stat-card">
          <div class="stat-icon"><i class="bi bi-heart-fill"></i></div>
          <div class="stat-value">{{ $donationCount }}</div>
          <div class="stat-label">Total Donations</div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="stat-card">
          <div class="stat-icon"><i class="bi bi-mortarboard-fill"></i></div>
          <div class="stat-value">{{ $adoptionCount }}</div>
          <div class="stat-label">Adopted Scholars</div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="stat-card">
          <div class="stat-icon"><i class="bi bi-chat-left-text-fill"></i></div>
          <div class="stat-value">{{ $contactCount }}</div>
          <div class="stat-label">Contact Messages</div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="stat-card">
          <div class="stat-icon"><i class="bi bi-envelope-check-fill"></i></div>
          <div class="stat-value">{{ $subscriberCount }}</div>
          <div class="stat-label">Subscribers</div>
        </div>
      </div>
    </div>

    <!-- Data Tables Container -->
    <div class="admin-table-wrapper p-3">
      
      <!-- Nav Tabs -->
      <ul class="nav nav-tabs nav-tabs-custom mb-3" id="adminTabs" role="tablist">
        <li class="nav-item">
          <button class="nav-link active" id="donations-tab" data-bs-toggle="tab" data-bs-target="#donations-pane" type="button">
            <i class="bi bi-heart me-1"></i> Donations ({{ count($donations) }})
          </button>
        </li>
        <li class="nav-item">
          <button class="nav-link" id="adoptions-tab" data-bs-toggle="tab" data-bs-target="#adoptions-pane" type="button">
            <i class="bi bi-mortarboard me-1"></i> Adopt-a-Scholar ({{ count($adoptions) }})
          </button>
        </li>
        <li class="nav-item">
          <button class="nav-link" id="contacts-tab" data-bs-toggle="tab" data-bs-target="#contacts-pane" type="button">
            <i class="bi bi-chat-left-text me-1"></i> Contact Messages ({{ count($contacts) }})
          </button>
        </li>
        <li class="nav-item">
          <button class="nav-link" id="subscribers-tab" data-bs-toggle="tab" data-bs-target="#subscribers-pane" type="button">
            <i class="bi bi-envelope me-1"></i> Newsletter Subscribers ({{ count($subscribers) }})
          </button>
        </li>
      </ul>

      <!-- Tab Content -->
      <div class="tab-content" id="adminTabsContent">
        
        <!-- Donations Pane -->
        <div class="tab-pane fade show active" id="donations-pane">
          <div class="table-responsive">
            <table class="table table-dark-custom align-middle">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Donor Name</th>
                  <th>Email</th>
                  <th>Location</th>
                  <th>Amount</th>
                  <th>Type</th>
                  <th>Payment</th>
                  <th>Date</th>
                  <th>Receipt</th>
                </tr>
              </thead>
              <tbody>
                @forelse($donations as $donation)
                  <tr>
                    <td>#{{ $donation->id }}</td>
                    <td class="fw-bold">{{ $donation->fname }} {{ $donation->lname }}</td>
                    <td>{{ $donation->email }}</td>
                    <td>{{ $donation->city ? $donation->city . ', ' . $donation->country : $donation->country }}</td>
                    <td class="fw-bold text-warning">₱{{ number_format($donation->amount, 2) }}</td>
                    <td><span class="badge bg-secondary">{{ ucfirst($donation->give_type ?? 'once') }}</span></td>
                    <td><span class="badge bg-dark border border-secondary">{{ strtoupper($donation->payment_method ?? 'GCASH') }}</span></td>
                    <td>{{ $donation->created_at ? $donation->created_at->format('M d, Y') : 'N/A' }}</td>
                    <td>
                      @if($donation->id)
                        <a href="{{ route('donations.receipt', $donation->id) }}" target="_blank" class="btn btn-sm btn-outline-warning">
                          <i class="bi bi-receipt"></i> View
                        </a>
                      @else
                        -
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="9" class="text-center text-secondary py-4">No donation records found. Click "Sync Google Sheets" to import.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        <!-- Adoptions Pane -->
        <div class="tab-pane fade" id="adoptions-pane">
          <div class="table-responsive">
            <table class="table table-dark-custom align-middle">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Adopter Name</th>
                  <th>Email</th>
                  <th>Package / Tier</th>
                  <th>Amount</th>
                  <th>Location</th>
                  <th>Date</th>
                  <th>Receipt</th>
                </tr>
              </thead>
              <tbody>
                @forelse($adoptions as $adoption)
                  <tr>
                    <td>#{{ $adoption->id }}</td>
                    <td class="fw-bold">{{ $adoption->fname }} {{ $adoption->lname }}</td>
                    <td>{{ $adoption->email }}</td>
                    <td><span class="badge bg-warning text-dark">{{ $adoption->package ?? 'Scholar Tier' }}</span></td>
                    <td class="fw-bold text-success">₱{{ number_format($adoption->amount, 2) }}</td>
                    <td>{{ $adoption->city ? $adoption->city . ', ' . $adoption->country : $adoption->country }}</td>
                    <td>{{ $adoption->created_at ? $adoption->created_at->format('M d, Y') : 'N/A' }}</td>
                    <td>
                      @if($adoption->id)
                        <a href="{{ route('adoptions.receipt', $adoption->id) }}" target="_blank" class="btn btn-sm btn-outline-warning">
                          <i class="bi bi-receipt"></i> View
                        </a>
                      @else
                        -
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="8" class="text-center text-secondary py-4">No scholar adoption records found. Click "Sync Google Sheets" to import.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        <!-- Contact Messages Pane -->
        <div class="tab-pane fade" id="contacts-pane">
          <div class="table-responsive">
            <table class="table table-dark-custom align-middle">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Sender Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                @forelse($contacts as $contact)
                  <tr>
                    <td>#{{ $contact->id }}</td>
                    <td class="fw-bold">{{ $contact->first_name }} {{ $contact->last_name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone ?? 'N/A' }}</td>
                    <td><span class="badge bg-info text-dark">{{ $contact->subject ?? 'Inquiry' }}</span></td>
                    <td style="max-width: 320px; white-space: normal;">{{ $contact->message }}</td>
                    <td>{{ $contact->created_at ? $contact->created_at->format('M d, Y') : 'N/A' }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="7" class="text-center text-secondary py-4">No contact messages found. Click "Sync Google Sheets" to import.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        <!-- Subscribers Pane -->
        <div class="tab-pane fade" id="subscribers-pane">
          <div class="table-responsive">
            <table class="table table-dark-custom align-middle">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Email Address</th>
                  <th>Date Subscribed</th>
                </tr>
              </thead>
              <tbody>
                @forelse($subscribers as $sub)
                  <tr>
                    <td>#{{ $sub->id }}</td>
                    <td>{{ $sub->email }}</td>
                    <td>{{ $sub->created_at ? $sub->created_at->format('M d, Y') : 'N/A' }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="3" class="text-center text-secondary py-4">No subscribers found yet.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

      </div>

    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
