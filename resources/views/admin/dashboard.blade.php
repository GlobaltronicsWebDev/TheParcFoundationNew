<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PARC Foundation - Admin Dashboard</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/logo/parclogosquare.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('cssfolder/admin.css?v=4.0') }}">
</head>
<body class="admin-body">

  <!-- Mobile Overlay Backdrop -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <div class="admin-layout">
    
    <!-- 📌 Left Side-Panel (Sidebar) Navigation -->
    <aside class="admin-sidebar" id="adminSidebar">
      <div class="admin-sidebar-header d-flex align-items-center justify-content-between">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-nav-brand">
          <img src="{{ asset('assets/logo/parclogosquare.png') }}" width="36" height="36" alt="PARC Logo">
          PARC <span>Foundation</span>
        </a>
        <button class="btn-close d-lg-none" id="sidebarCloseBtn" aria-label="Close Sidebar"></button>
      </div>

      <div class="admin-sidebar-body">
        <div class="sidebar-menu-title">Main Navigation</div>
        <ul class="sidebar-menu">
          <li class="sidebar-menu-item">
            <a href="#donations-pane" class="sidebar-menu-link active" data-tab-target="#donations-tab">
              <span><i class="bi bi-heart text-danger"></i> Donations</span>
              <span class="sidebar-menu-badge">{{ count($donations) }}</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="#adoptions-pane" class="sidebar-menu-link" data-tab-target="#adoptions-tab">
              <span><i class="bi bi-mortarboard text-primary"></i> Adopt-a-Scholar</span>
              <span class="sidebar-menu-badge">{{ count($adoptions) }}</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="#contacts-pane" class="sidebar-menu-link" data-tab-target="#contacts-tab">
              <span><i class="bi bi-chat-left-text text-info"></i> Contact Inquiries</span>
              <span class="sidebar-menu-badge">{{ count($contacts) }}</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="#subscribers-pane" class="sidebar-menu-link" data-tab-target="#subscribers-tab">
              <span><i class="bi bi-envelope text-warning"></i> Subscribers</span>
              <span class="sidebar-menu-badge">{{ count($subscribers) }}</span>
            </a>
          </li>
        </ul>

        <div class="sidebar-menu-title">Quick Actions</div>
        <ul class="sidebar-menu">
          <li class="sidebar-menu-item">
            <a href="{{ route('welcome') }}" target="_blank" class="sidebar-menu-link">
              <span><i class="bi bi-globe text-secondary"></i> View Live Website</span>
              <i class="bi bi-box-arrow-up-right small text-muted"></i>
            </a>
          </li>
        </ul>
      </div>

      <div class="admin-sidebar-footer">
        <div class="d-grid gap-2">
          <form action="{{ route('admin.sync') }}" method="POST" class="d-grid">
            @csrf
            <button type="submit" class="btn btn-sync btn-sm w-100">
              <i class="bi bi-arrow-repeat me-1"></i> Sync Google Sheets
            </button>
          </form>
          <form action="{{ route('admin.reset') }}" method="POST" class="d-grid" onsubmit="return confirm('⚠️ ARE YOU SURE? This will delete all database records (Donations, Adoptions, Messages) and reset IDs to #1. This action cannot be undone!');">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm w-100">
              <i class="bi bi-trash3 me-1"></i> Reset All Data
            </button>
          </form>
          <form action="{{ route('admin.logout') }}" method="POST" class="d-grid mt-1">
            @csrf
            <button type="submit" class="btn btn-outline-dark btn-sm w-100">
              <i class="bi bi-box-arrow-right me-1"></i> Logout
            </button>
          </form>
        </div>
      </div>
    </aside>

    <!-- 💻 Main Content Wrapper -->
    <div class="admin-main-wrapper">
      
      <!-- Top Bar Header -->
      <nav class="admin-navbar d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
          <button class="btn btn-outline-dark btn-sm d-lg-none" id="sidebarToggleBtn" aria-label="Toggle Navigation">
            <i class="bi bi-list fs-5"></i>
          </button>
          <span class="fw-bold text-dark fs-5">Admin Control Center</span>
          <span class="admin-nav-badge d-none d-sm-inline-flex">
            <span class="pulse-dot"></span> Live Database Active
          </span>
        </div>

        <div class="d-flex align-items-center gap-2">
          <form action="{{ route('admin.sync') }}" method="POST" class="d-inline d-none d-sm-inline-block">
            @csrf
            <button type="submit" class="btn btn-sync btn-sm">
              <i class="bi bi-arrow-repeat me-1"></i> Sync Sheets
            </button>
          </form>
          <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-dark btn-sm">
              <i class="bi bi-box-arrow-right me-1"></i> Logout
            </button>
          </form>
        </div>
      </nav>

      <!-- Page Content Area -->
      <div class="container-fluid px-4 px-xl-5 py-4">

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

        <!-- Hero Control Banner -->
        <div class="admin-hero-banner">
          <div>
            <h1 class="admin-hero-title">Welcome Back, Administrator 👋</h1>
            <p class="admin-hero-sub">Manage donations, scholar adoptions, user contact inquiries, and newsletter subscribers from your side-panel control center.</p>
          </div>
          <div class="d-none d-lg-block text-end">
            <div class="badge bg-light text-dark border px-3 py-2 fs-6 mb-1">
              <i class="bi bi-calendar3 me-1 text-warning"></i> {{ date('F d, Y') }}
            </div>
            <div class="small text-muted fw-semibold">System Status: Optimal</div>
          </div>
        </div>

        <!-- Wide Top KPI Cards Row -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 g-3 mb-4">
          <div class="col">
            <div class="stat-card-wide">
              <div class="stat-header">
                <div class="stat-icon-box stat-icon-gold"><i class="bi bi-currency-dollar"></i></div>
                <span class="badge font-monospace" style="background:#fffbeb; color:#d97706; border:1px solid #fde68a;">PHP</span>
              </div>
              <div class="stat-value-wide">₱{{ number_format($totalRaised, 2) }}</div>
              <div class="stat-label-wide">Total Funds Raised</div>
            </div>
          </div>

          <div class="col">
            <div class="stat-card-wide">
              <div class="stat-header">
                <div class="stat-icon-box stat-icon-emerald"><i class="bi bi-heart-fill"></i></div>
                <span class="badge font-monospace" style="background:#ecfdf5; color:#059669; border:1px solid #a7f3d0;">{{ $donationCount }} total</span>
              </div>
              <div class="stat-value-wide">{{ $donationCount }}</div>
              <div class="stat-label-wide">Total Donations</div>
            </div>
          </div>

          <div class="col">
            <div class="stat-card-wide">
              <div class="stat-header">
                <div class="stat-icon-box stat-icon-blue"><i class="bi bi-mortarboard-fill"></i></div>
                <span class="badge font-monospace" style="background:#eff6ff; color:#2563eb; border:1px solid #bfdbfe;">{{ $adoptionCount }} scholars</span>
              </div>
              <div class="stat-value-wide">{{ $adoptionCount }}</div>
              <div class="stat-label-wide">Adopted Scholars</div>
            </div>
          </div>

          <div class="col">
            <div class="stat-card-wide">
              <div class="stat-header">
                <div class="stat-icon-box stat-icon-purple"><i class="bi bi-chat-left-text-fill"></i></div>
                <span class="badge font-monospace" style="background:#faf5ff; color:#9333ea; border:1px solid #e9d5ff;">{{ $contactCount }} msgs</span>
              </div>
              <div class="stat-value-wide">{{ $contactCount }}</div>
              <div class="stat-label-wide">Contact Inquiries</div>
            </div>
          </div>

          <div class="col">
            <div class="stat-card-wide">
              <div class="stat-header">
                <div class="stat-icon-box stat-icon-rose"><i class="bi bi-envelope-check-fill"></i></div>
                <span class="badge font-monospace" style="background:#fff1f2; color:#e11d48; border:1px solid #fecdd3;">Active</span>
              </div>
              <div class="stat-value-wide">{{ $subscriberCount }}</div>
              <div class="stat-label-wide">Subscribers</div>
            </div>
          </div>
        </div>

        <!-- Main Data Panel Container -->
        <div class="admin-panel-wrapper">
          
          <!-- Panel Toolbar & Live Search -->
          <div class="admin-panel-toolbar">
            <ul class="nav nav-pills nav-tabs-pills" id="adminTabs" role="tablist">
              <li class="nav-item">
                <button class="nav-link active" id="donations-tab" data-bs-toggle="tab" data-bs-target="#donations-pane" type="button">
                  <i class="bi bi-heart me-1"></i> Donations <span class="badge-count">{{ count($donations) }}</span>
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link" id="adoptions-tab" data-bs-toggle="tab" data-bs-target="#adoptions-pane" type="button">
                  <i class="bi bi-mortarboard me-1"></i> Adopt-a-Scholar <span class="badge-count">{{ count($adoptions) }}</span>
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link" id="contacts-tab" data-bs-toggle="tab" data-bs-target="#contacts-pane" type="button">
                  <i class="bi bi-chat-left-text me-1"></i> Contact Messages <span class="badge-count">{{ count($contacts) }}</span>
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link" id="subscribers-tab" data-bs-toggle="tab" data-bs-target="#subscribers-pane" type="button">
                  <i class="bi bi-envelope me-1"></i> Newsletter Subscribers <span class="badge-count">{{ count($subscribers) }}</span>
                </button>
              </li>
            </ul>

            <div class="admin-search-box">
              <i class="bi bi-search"></i>
              <input type="text" id="adminTableSearch" placeholder="Search records in real-time..." />
            </div>
          </div>

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
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($donations as $donation)
                      <tr>
                        <td class="fw-bold text-secondary">#{{ $donation->id }}</td>
                        <td class="fw-bold text-dark">{{ $donation->fname }} {{ $donation->lname }}</td>
                        <td><a href="mailto:{{ $donation->email }}" class="text-primary fw-semibold text-decoration-none">{{ $donation->email }}</a></td>
                        <td>{{ $donation->city ? $donation->city . ', ' . $donation->country : $donation->country }}</td>
                        <td class="fw-bold fs-6" style="color:#d97706;">₱{{ number_format($donation->amount, 2) }}</td>
                        <td><span class="badge bg-light text-dark border px-2 py-1">{{ ucfirst($donation->give_type ?? 'once') }}</span></td>
                        <td><span class="badge bg-light text-dark border px-2 py-1">{{ strtoupper($donation->payment_method ?? 'GCASH') }}</span></td>
                        <td class="text-muted small">{{ $donation->created_at ? $donation->created_at->format('M d, Y') : 'N/A' }}</td>
                        <td>
                          @if($donation->id)
                            <a href="{{ route('donations.receipt', $donation->id) }}" target="_blank" class="btn btn-sm btn-outline-warning">
                              <i class="bi bi-receipt"></i> View
                            </a>
                          @else
                            -
                          @endif
                        </td>
                        <td>
                          <form action="{{ route('admin.donations.delete', $donation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete donation #{{ $donation->id }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Donation">
                              <i class="bi bi-trash3"></i> Delete
                            </button>
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="10" class="text-center text-secondary py-5">
                          <i class="bi bi-inbox fs-2 d-block mb-2 text-muted"></i>
                          No donation records found. Click "Sync Google Sheets" to import.
                        </td>
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
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($adoptions as $adoption)
                      <tr>
                        <td class="fw-bold text-secondary">#{{ $adoption->id }}</td>
                        <td class="fw-bold text-dark">{{ $adoption->fname }} {{ $adoption->lname }}</td>
                        <td><a href="mailto:{{ $adoption->email }}" class="text-primary fw-semibold text-decoration-none">{{ $adoption->email }}</a></td>
                        <td><span class="badge" style="background:#fffbeb; color:#b45309; border:1px solid #fde68a;">{{ $adoption->package ?? 'Scholar Tier' }}</span></td>
                        <td class="fw-bold text-success fs-6">₱{{ number_format($adoption->amount, 2) }}</td>
                        <td>{{ $adoption->city ? $adoption->city . ', ' . $adoption->country : $adoption->country }}</td>
                        <td class="text-muted small">{{ $adoption->created_at ? $adoption->created_at->format('M d, Y') : 'N/A' }}</td>
                        <td>
                          @if($adoption->id)
                            <a href="{{ route('adoptions.receipt', $adoption->id) }}" target="_blank" class="btn btn-sm btn-outline-warning">
                              <i class="bi bi-receipt"></i> View
                            </a>
                          @else
                            -
                          @endif
                        </td>
                        <td>
                          <form action="{{ route('admin.adoptions.delete', $adoption->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete adoption #{{ $adoption->id }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Adoption">
                              <i class="bi bi-trash3"></i> Delete
                            </button>
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="9" class="text-center text-secondary py-5">
                          <i class="bi bi-inbox fs-2 d-block mb-2 text-muted"></i>
                          No scholar adoption records found. Click "Sync Google Sheets" to import.
                        </td>
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
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($contacts as $contact)
                      <tr>
                        <td class="fw-bold text-secondary">#{{ $contact->id }}</td>
                        <td class="fw-bold text-dark">{{ $contact->first_name }} {{ $contact->last_name }}</td>
                        <td><a href="mailto:{{ $contact->email }}" class="text-primary fw-semibold text-decoration-none">{{ $contact->email }}</a></td>
                        <td class="small">{{ $contact->phone ?? 'N/A' }}</td>
                        <td><span class="badge" style="background:#eff6ff; color:#1d4ed8; border:1px solid #bfdbfe;">{{ $contact->subject ?? 'Inquiry' }}</span></td>
                        <td style="max-width: 340px; white-space: normal;" class="small text-dark">{{ $contact->message }}</td>
                        <td class="text-muted small">{{ $contact->created_at ? $contact->created_at->format('M d, Y') : 'N/A' }}</td>
                        <td>
                          <form action="{{ route('admin.contacts.delete', $contact->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete contact message #{{ $contact->id }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Message">
                              <i class="bi bi-trash3"></i> Delete
                            </button>
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="8" class="text-center text-secondary py-5">
                          <i class="bi bi-inbox fs-2 d-block mb-2 text-muted"></i>
                          No contact messages found. Click "Sync Google Sheets" to import.
                        </td>
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
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($subscribers as $sub)
                      <tr>
                        <td class="fw-bold text-secondary">#{{ $sub->id }}</td>
                        <td><a href="mailto:{{ $sub->email }}" class="text-primary fw-semibold text-decoration-none">{{ $sub->email }}</a></td>
                        <td class="text-muted small">{{ $sub->created_at ? $sub->created_at->format('M d, Y') : 'N/A' }}</td>
                        <td>
                          <form action="{{ route('admin.subscribers.delete', $sub->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete subscriber #{{ $sub->id }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Subscriber">
                              <i class="bi bi-trash3"></i> Delete
                            </button>
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="4" class="text-center text-secondary py-5">
                          <i class="bi bi-inbox fs-2 d-block mb-2 text-muted"></i>
                          No subscribers found yet.
                        </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>

          </div>

        </div>

      </div>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // 1. Remember Active Tab & Sync Side Panel Links
      const activeTabTarget = localStorage.getItem('adminActiveTab');
      if (activeTabTarget) {
        const tabBtn = document.querySelector(`button[data-bs-target="${activeTabTarget}"]`);
        if (tabBtn) {
          const tab = new bootstrap.Tab(tabBtn);
          tab.show();
          updateSidebarLink(activeTabTarget);
        }
      }

      document.querySelectorAll('button[data-bs-toggle="tab"]').forEach(function(btn) {
        btn.addEventListener('shown.bs.tab', function(e) {
          const target = e.target.getAttribute('data-bs-target');
          localStorage.setItem('adminActiveTab', target);
          updateSidebarLink(target);

          // Clear search when switching tabs
          const searchInput = document.getElementById('adminTableSearch');
          if (searchInput) {
            searchInput.value = '';
            filterTable('');
          }
        });
      });

      // Synchronize Sidebar Links with Bootstrap Tabs
      document.querySelectorAll('.sidebar-menu-link[data-tab-target]').forEach(function(link) {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          const targetTabId = this.getAttribute('data-tab-target');
          const targetBtn = document.querySelector(targetTabId);
          if (targetBtn) {
            const tab = new bootstrap.Tab(targetBtn);
            tab.show();
          }
          closeSidebar();
        });
      });

      function updateSidebarLink(activeTabTargetId) {
        document.querySelectorAll('.sidebar-menu-link[data-tab-target]').forEach(function(link) {
          if (link.getAttribute('data-tab-target') === activeTabTargetId || link.getAttribute('href') === activeTabTargetId) {
            link.classList.add('active');
          } else {
            link.classList.remove('active');
          }
        });
      }

      // 2. Mobile Sidebar Drawer Controls
      const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
      const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
      const sidebarOverlay = document.getElementById('sidebarOverlay');
      const adminSidebar = document.getElementById('adminSidebar');

      if (sidebarToggleBtn) {
        sidebarToggleBtn.addEventListener('click', function() {
          adminSidebar.classList.add('show');
          sidebarOverlay.classList.add('show');
        });
      }

      if (sidebarCloseBtn) {
        sidebarCloseBtn.addEventListener('click', closeSidebar);
      }

      if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
      }

      function closeSidebar() {
        if (adminSidebar) adminSidebar.classList.remove('show');
        if (sidebarOverlay) sidebarOverlay.classList.remove('show');
      }

      // 3. Real-time Live Search Filtering across current active tab
      const searchInput = document.getElementById('adminTableSearch');
      if (searchInput) {
        searchInput.addEventListener('keyup', function() {
          filterTable(this.value.toLowerCase().trim());
        });
      }

      function filterTable(query) {
        const activePane = document.querySelector('.tab-pane.active');
        if (!activePane) return;
        const rows = activePane.querySelectorAll('tbody tr');
        rows.forEach(function(row) {
          if (row.children.length === 1) return; // Skip empty message row
          const text = row.textContent.toLowerCase();
          row.style.display = text.includes(query) ? '' : 'none';
        });
      }
    });
  </script>
</body>
</html>


