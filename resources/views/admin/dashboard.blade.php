<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PARC Foundation - Admin Control Center</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/logo/parclogosquare.png') }}">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Modern Admin Stylesheet -->
  <link rel="stylesheet" href="{{ asset('cssfolder/admin.css?v=6.0') }}">
  <!-- Lucide Icons CDN -->
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="admin-body">

  <!-- Mobile Overlay Backdrop -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <div class="admin-layout">
    
    <!-- 📌 Left Side-Panel (Sidebar) Navigation -->
    <aside class="admin-sidebar" id="adminSidebar">
      <div class="admin-sidebar-header d-flex align-items-center justify-content-between">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-nav-brand">
          <div class="sidebar-brand-badge">
            <img src="{{ asset('assets/logo/parclogosquare.png') }}" alt="PARC Logo">
          </div>
          <div>PARC <span>Foundation</span></div>
        </a>
        <button class="btn btn-sm btn-subtle-outline d-lg-none p-1" id="sidebarCloseBtn" aria-label="Close Sidebar">
          <i data-lucide="x"></i>
        </button>
      </div>

      <div class="admin-sidebar-body">
        <div class="sidebar-menu-title">Main Navigation</div>
        <ul class="sidebar-menu">
          <li class="sidebar-menu-item">
            <a href="#donations-pane" class="sidebar-menu-link active" data-tab-target="#donations-tab">
              <span class="link-label-group">
                <i data-lucide="heart"></i>
                <span>Donations</span>
              </span>
              <span class="sidebar-menu-badge">{{ count($donations) }}</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="#adoptions-pane" class="sidebar-menu-link" data-tab-target="#adoptions-tab">
              <span class="link-label-group">
                <i data-lucide="graduation-cap"></i>
                <span>Adopt-a-Scholar</span>
              </span>
              <span class="sidebar-menu-badge">{{ count($adoptions) }}</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="#contacts-pane" class="sidebar-menu-link" data-tab-target="#contacts-tab">
              <span class="link-label-group">
                <i data-lucide="message-square"></i>
                <span>Contact Inquiries</span>
              </span>
              <span class="sidebar-menu-badge">{{ count($contacts) }}</span>
            </a>
          </li>
        </ul>

        <div class="sidebar-menu-title">Quick Actions</div>
        <ul class="sidebar-menu">
          <li class="sidebar-menu-item">
            <a href="{{ route('welcome') }}" target="_blank" class="sidebar-menu-link">
              <span class="link-label-group">
                <i data-lucide="external-link"></i>
                <span>View Live Site</span>
              </span>
              <i data-lucide="arrow-up-right" style="width: 0.9rem; height: 0.9rem; opacity: 0.5;"></i>
            </a>
          </li>
        </ul>
      </div>

      <div class="admin-sidebar-footer">
        <div class="d-grid gap-2">
          <form action="{{ route('admin.sync') }}" method="POST" class="d-grid sync-form">
            @csrf
            <button type="submit" class="btn btn-brand-primary w-100 justify-content-center spin-on-click">
              <i data-lucide="refresh-cw"></i>
              <span>Sync Google Sheets</span>
            </button>
          </form>
          <div class="d-flex gap-2 mt-1">
            <form action="{{ route('admin.reset') }}" method="POST" class="flex-grow-1" onsubmit="return confirm('⚠️ ARE YOU SURE? This will delete all database records (Donations, Adoptions, Messages) and reset IDs to #1. This action cannot be undone!');">
              @csrf
              <button type="submit" class="btn btn-subtle-outline w-100 justify-content-center text-danger" title="Reset All Records">
                <i data-lucide="trash-2"></i>
                <span class="small">Reset Data</span>
              </button>
            </form>
            <form action="{{ route('admin.logout') }}" method="POST" class="flex-shrink-0">
              @csrf
              <button type="submit" class="btn btn-subtle-outline px-3 justify-content-center" title="Log Out">
                <i data-lucide="log-out"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </aside>

    <!-- 💻 Main Content Wrapper -->
    <div class="admin-main-wrapper">
      
      <!-- Top Bar Header -->
      <nav class="admin-navbar d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
          <button class="btn btn-subtle-outline btn-sm d-lg-none p-2" id="sidebarToggleBtn" aria-label="Toggle Navigation">
            <i data-lucide="menu"></i>
          </button>
          <div class="admin-nav-title">
            <i data-lucide="layout-dashboard" style="color: var(--brand-primary); width: 1.15rem; height: 1.15rem;"></i>
            <span>Control Center</span>
          </div>
          <span class="admin-nav-badge d-none d-sm-inline-flex ms-2">
            <span class="pulse-dot"></span> Live Database Active
          </span>
        </div>

        <div class="d-flex align-items-center gap-2">
          <form action="{{ route('admin.sync') }}" method="POST" class="d-none d-sm-inline-block sync-form">
            @csrf
            <button type="submit" class="btn btn-brand-primary btn-sm spin-on-click">
              <i data-lucide="refresh-cw"></i>
              <span>Sync Sheets</span>
            </button>
          </form>
          <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-subtle-outline btn-sm">
              <i data-lucide="log-out"></i>
              <span class="d-none d-sm-inline">Logout</span>
            </button>
          </form>
        </div>
      </nav>

      <!-- Page Content Area -->
      <div class="container-fluid px-3 px-md-4 px-xl-5 py-4">

        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 d-flex align-items-center gap-2 py-3 px-4" role="alert" style="background-color: var(--status-emerald-soft); color: var(--status-emerald); border-left: 4px solid var(--status-emerald) !important;">
            <i data-lucide="check-circle-2" style="width: 1.25rem; height: 1.25rem;"></i>
            <div class="fw-semibold">{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
          </div>
        @endif

        @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4 d-flex align-items-center gap-2 py-3 px-4" role="alert" style="background-color: var(--status-danger-soft); color: var(--status-danger); border-left: 4px solid var(--status-danger) !important;">
            <i data-lucide="alert-triangle" style="width: 1.25rem; height: 1.25rem;"></i>
            <div class="fw-semibold">{{ session('error') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
          </div>
        @endif

        <!-- Hero Control Banner -->
        <div class="admin-hero-banner">
          <div>
            <h1 class="admin-hero-title">Overview Dashboard</h1>
            <p class="admin-hero-sub">Real-time monitoring of donations, scholar adoptions, and community inquiries.</p>
          </div>
          <div class="d-none d-md-flex align-items-center gap-3">
            <div class="admin-date-chip">
              <i data-lucide="calendar"></i>
              <span>{{ date('l, M d, Y') }}</span>
            </div>
          </div>
        </div>

        <!-- Metric KPI Cards Row (4 Columns Compact) -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-4 g-2 g-xl-3 mb-3">
          
          <!-- KPI 1: Funds Raised -->
          <div class="col">
            <div class="stat-card-wide">
              <div class="stat-header">
                <div class="stat-icon-box stat-icon-gold">
                  <i data-lucide="wallet"></i>
                </div>
                <span class="stat-pill-badge" style="color: #b45309; background: #fffbeb; border-color: #fde68a;">PHP</span>
              </div>
              <div class="stat-value-wide">₱{{ number_format($totalRaised, 2) }}</div>
              <div class="stat-label-wide">Total Funds Raised</div>
            </div>
          </div>

          <!-- KPI 2: Donations -->
          <div class="col">
            <div class="stat-card-wide">
              <div class="stat-header">
                <div class="stat-icon-box stat-icon-emerald">
                  <i data-lucide="heart"></i>
                </div>
                <span class="stat-pill-badge" style="color: #059669; background: #ecfdf5; border-color: #a7f3d0;">{{ $donationCount }} total</span>
              </div>
              <div class="stat-value-wide">{{ $donationCount }}</div>
              <div class="stat-label-wide">Total Donations</div>
            </div>
          </div>

          <!-- KPI 3: Scholars -->
          <div class="col">
            <div class="stat-card-wide">
              <div class="stat-header">
                <div class="stat-icon-box stat-icon-blue">
                  <i data-lucide="graduation-cap"></i>
                </div>
                <span class="stat-pill-badge" style="color: #2563eb; background: #eff6ff; border-color: #bfdbfe;">{{ $adoptionCount }} scholars</span>
              </div>
              <div class="stat-value-wide">{{ $adoptionCount }}</div>
              <div class="stat-label-wide">Adopted Scholars</div>
            </div>
          </div>

          <!-- KPI 4: Inquiries -->
          <div class="col">
            <div class="stat-card-wide">
              <div class="stat-header">
                <div class="stat-icon-box stat-icon-purple">
                  <i data-lucide="message-square"></i>
                </div>
                <span class="stat-pill-badge" style="color: #7c3aed; background: #f5f3ff; border-color: #ddd6fe;">{{ $contactCount }} messages</span>
              </div>
              <div class="stat-value-wide">{{ $contactCount }}</div>
              <div class="stat-label-wide">Contact Inquiries</div>
            </div>
          </div>
        </div>

        <!-- Main Data Panel Container -->
        <div class="admin-panel-wrapper">
          
          <!-- Panel Toolbar: Segmented Tab Pills & Real-time Search -->
          <div class="admin-panel-toolbar">
            <ul class="nav nav-tabs-pills" id="adminTabs" role="tablist">
              <li class="nav-item">
                <button class="nav-link active" id="donations-tab" data-bs-toggle="tab" data-bs-target="#donations-pane" type="button">
                  <i data-lucide="heart"></i>
                  <span>Donations</span>
                  <span class="badge-count">{{ count($donations) }}</span>
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link" id="adoptions-tab" data-bs-toggle="tab" data-bs-target="#adoptions-pane" type="button">
                  <i data-lucide="graduation-cap"></i>
                  <span>Adopt-a-Scholar</span>
                  <span class="badge-count">{{ count($adoptions) }}</span>
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link" id="contacts-tab" data-bs-toggle="tab" data-bs-target="#contacts-pane" type="button">
                  <i data-lucide="message-square"></i>
                  <span>Contact Inquiries</span>
                  <span class="badge-count">{{ count($contacts) }}</span>
                </button>
              </li>
            </ul>

            <div class="admin-search-box">
              <i data-lucide="search" class="search-icon"></i>
              <input type="text" id="adminTableSearch" placeholder="Search records in real-time..." autocomplete="off" />
              <span class="search-shortcut">/</span>
            </div>
          </div>

          <!-- Tab Content Panes -->
          <div class="tab-content" id="adminTabsContent">
            
            <!-- 1. Donations Pane -->
            <div class="tab-pane fade show active" id="donations-pane">
              <div class="table-responsive">
                <table class="table-modern">
                  <thead>
                    <tr>
                      <th style="width: 70px;">ID</th>
                      <th>Donor</th>
                      <th>Location</th>
                      <th>Amount</th>
                      <th>Type</th>
                      <th>Payment</th>
                      <th>Date</th>
                      <th>Receipt</th>
                      <th class="text-end" style="width: 100px;">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($donations as $donation)
                      @php
                        $firstL = mb_substr(trim($donation->fname ?? 'D'), 0, 1);
                        $lastL  = mb_substr(trim($donation->lname ?? ''), 0, 1);
                        $initials = strtoupper($firstL . ($lastL ?: ''));
                      @endphp
                      <tr>
                        <td class="fw-semibold text-muted font-monospace">#{{ $donation->id }}</td>
                        <td>
                          <div class="user-avatar-pill">
                            <span class="avatar-initials">{{ $initials }}</span>
                            <div>
                              <div class="user-name-primary">{{ $donation->fname }} {{ $donation->lname }}</div>
                              <div class="user-meta-sub">{{ $donation->email }}</div>
                            </div>
                          </div>
                        </td>
                        <td class="text-secondary small">{{ $donation->city ? $donation->city . ', ' . $donation->country : ($donation->country ?: '—') }}</td>
                        <td class="fw-bold fs-6" style="color: var(--brand-primary); font-variant-numeric: tabular-nums;">
                          ₱{{ number_format($donation->amount, 2) }}
                        </td>
                        <td>
                          <span class="badge-soft badge-soft-neutral">
                            {{ ucfirst($donation->give_type ?? 'once') }}
                          </span>
                        </td>
                        <td>
                          @php
                            $pm = strtoupper($donation->payment_method ?? 'GCASH');
                            $badgeClass = ($pm === 'GCASH') ? 'badge-soft-blue' : (($pm === 'MAYA') ? 'badge-soft-green' : 'badge-soft-gold');
                          @endphp
                          <span class="badge-soft {{ $badgeClass }}">{{ $pm }}</span>
                        </td>
                        <td class="text-muted small">{{ $donation->created_at ? $donation->created_at->format('M d, Y') : 'N/A' }}</td>
                        <td>
                          @if($donation->id)
                            <a href="{{ route('donations.receipt', $donation->id) }}" target="_blank" class="btn-action-ghost" title="View Official Receipt">
                              <i data-lucide="file-text"></i>
                              <span>Receipt</span>
                            </a>
                          @else
                            —
                          @endif
                        </td>
                        <td class="text-end">
                          <form action="{{ route('admin.donations.delete', $donation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete donation #{{ $donation->id }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action-delete" title="Delete record">
                              <i data-lucide="trash-2"></i>
                            </button>
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr class="empty-state-row">
                        <td colspan="9">
                          <div class="admin-empty-state">
                            <div class="empty-state-icon">
                              <i data-lucide="inbox"></i>
                            </div>
                            <div class="empty-state-title">No donation records found</div>
                            <p class="empty-state-desc">Click "Sync Google Sheets" above to import the latest live spreadsheet entries.</p>
                          </div>
                        </td>
                      </tr>
                    @endforelse
                    <tr class="search-empty-row" style="display: none;">
                      <td colspan="9">
                        <div class="admin-empty-state py-4">
                          <div class="empty-state-icon" style="width: 40px; height: 40px;">
                            <i data-lucide="search-x"></i>
                          </div>
                          <div class="empty-state-title">No matching records</div>
                          <p class="empty-state-desc">Try adjusting your search terms.</p>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- 2. Adoptions Pane -->
            <div class="tab-pane fade" id="adoptions-pane">
              <div class="table-responsive">
                <table class="table-modern">
                  <thead>
                    <tr>
                      <th style="width: 70px;">ID</th>
                      <th>Adopter</th>
                      <th>Scholar Tier</th>
                      <th>Amount</th>
                      <th>Location</th>
                      <th>Date</th>
                      <th>Receipt</th>
                      <th class="text-end" style="width: 100px;">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($adoptions as $adoption)
                      @php
                        $firstL = mb_substr(trim($adoption->fname ?? 'S'), 0, 1);
                        $lastL  = mb_substr(trim($adoption->lname ?? ''), 0, 1);
                        $initials = strtoupper($firstL . ($lastL ?: ''));
                      @endphp
                      <tr>
                        <td class="fw-semibold text-muted font-monospace">#{{ $adoption->id }}</td>
                        <td>
                          <div class="user-avatar-pill">
                            <span class="avatar-initials" style="background: var(--status-blue-soft); color: var(--status-blue); border-color: var(--status-blue-border);">{{ $initials }}</span>
                            <div>
                              <div class="user-name-primary">{{ $adoption->fname }} {{ $adoption->lname }}</div>
                              <div class="user-meta-sub">{{ $adoption->email }}</div>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span class="badge-soft badge-soft-gold">
                            <i data-lucide="graduation-cap" style="width: 0.85rem; height: 0.85rem;"></i>
                            {{ $adoption->package ?? 'Scholar Tier' }}
                          </span>
                        </td>
                        <td class="fw-bold fs-6 text-success" style="font-variant-numeric: tabular-nums;">
                          ₱{{ number_format($adoption->amount, 2) }}
                        </td>
                        <td class="text-secondary small">{{ $adoption->city ? $adoption->city . ', ' . $adoption->country : ($adoption->country ?: '—') }}</td>
                        <td class="text-muted small">{{ $adoption->created_at ? $adoption->created_at->format('M d, Y') : 'N/A' }}</td>
                        <td>
                          @if($adoption->id)
                            <a href="{{ route('adoptions.receipt', $adoption->id) }}" target="_blank" class="btn-action-ghost" title="View Official Receipt">
                              <i data-lucide="file-text"></i>
                              <span>Receipt</span>
                            </a>
                          @else
                            —
                          @endif
                        </td>
                        <td class="text-end">
                          <form action="{{ route('admin.adoptions.delete', $adoption->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete adoption record #{{ $adoption->id }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action-delete" title="Delete record">
                              <i data-lucide="trash-2"></i>
                            </button>
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr class="empty-state-row">
                        <td colspan="8">
                          <div class="admin-empty-state">
                            <div class="empty-state-icon">
                              <i data-lucide="inbox"></i>
                            </div>
                            <div class="empty-state-title">No scholar adoption records found</div>
                            <p class="empty-state-desc">Click "Sync Google Sheets" above to import the latest live spreadsheet entries.</p>
                          </div>
                        </td>
                      </tr>
                    @endforelse
                    <tr class="search-empty-row" style="display: none;">
                      <td colspan="8">
                        <div class="admin-empty-state py-4">
                          <div class="empty-state-icon" style="width: 40px; height: 40px;">
                            <i data-lucide="search-x"></i>
                          </div>
                          <div class="empty-state-title">No matching records</div>
                          <p class="empty-state-desc">Try adjusting your search terms.</p>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- 3. Contact Messages Pane -->
            <div class="tab-pane fade" id="contacts-pane">
              <div class="table-responsive">
                <table class="table-modern">
                  <thead>
                    <tr>
                      <th style="width: 70px;">ID</th>
                      <th>Sender</th>
                      <th>Phone</th>
                      <th>Subject</th>
                      <th>Message</th>
                      <th>Date</th>
                      <th class="text-end" style="width: 100px;">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($contacts as $contact)
                      @php
                        $firstL = mb_substr(trim($contact->first_name ?? 'C'), 0, 1);
                        $lastL  = mb_substr(trim($contact->last_name ?? ''), 0, 1);
                        $initials = strtoupper($firstL . ($lastL ?: ''));
                      @endphp
                      <tr>
                        <td class="fw-semibold text-muted font-monospace">#{{ $contact->id }}</td>
                        <td>
                          <div class="user-avatar-pill">
                            <span class="avatar-initials" style="background: var(--status-purple-soft); color: var(--status-purple); border-color: var(--status-purple-border);">{{ $initials }}</span>
                            <div>
                              <div class="user-name-primary">{{ $contact->first_name }} {{ $contact->last_name }}</div>
                              <div class="user-meta-sub">{{ $contact->email }}</div>
                            </div>
                          </div>
                        </td>
                        <td class="small text-secondary">{{ $contact->phone ?? '—' }}</td>
                        <td>
                          <span class="badge-soft badge-soft-blue">
                            {{ $contact->subject ?? 'General Inquiry' }}
                          </span>
                        </td>
                        <td style="max-width: 320px; white-space: normal;" class="small text-secondary">
                          {{ $contact->message }}
                        </td>
                        <td class="text-muted small">{{ $contact->created_at ? $contact->created_at->format('M d, Y') : 'N/A' }}</td>
                        <td class="text-end">
                          <form action="{{ route('admin.contacts.delete', $contact->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete message #{{ $contact->id }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action-delete" title="Delete message">
                              <i data-lucide="trash-2"></i>
                            </button>
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr class="empty-state-row">
                        <td colspan="7">
                          <div class="admin-empty-state">
                            <div class="empty-state-icon">
                              <i data-lucide="inbox"></i>
                            </div>
                            <div class="empty-state-title">No contact inquiries found</div>
                            <p class="empty-state-desc">Community contact messages submitted through the website will appear here.</p>
                          </div>
                        </td>
                      </tr>
                    @endforelse
                    <tr class="search-empty-row" style="display: none;">
                      <td colspan="7">
                        <div class="admin-empty-state py-4">
                          <div class="empty-state-icon" style="width: 40px; height: 40px;">
                            <i data-lucide="search-x"></i>
                          </div>
                          <div class="empty-state-title">No matching records</div>
                          <p class="empty-state-desc">Try adjusting your search terms.</p>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

          </div>

        </div>

      </div>
    </div>

  </div>

  <!-- Bootstrap 5 JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // 1. Initialize Lucide Icons
      if (window.lucide) {
        lucide.createIcons({ attrs: { 'stroke-width': 1.75 } });
      }

      // 2. Tab Persistence & Sidebar Sync
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
          if (window.lucide) lucide.createIcons({ attrs: { 'stroke-width': 1.75 } });
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

      // 3. Mobile Sidebar Controls
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

      // 4. Real-time Live Search
      const searchInput = document.getElementById('adminTableSearch');
      if (searchInput) {
        searchInput.addEventListener('input', function() {
          filterTable(this.value.toLowerCase().trim());
        });
      }

      // Keyboard shortcut '/' to search
      document.addEventListener('keydown', function(e) {
        if (e.key === '/' && document.activeElement !== searchInput) {
          e.preventDefault();
          if (searchInput) searchInput.focus();
        }
      });

      function filterTable(query) {
        const activePane = document.querySelector('.tab-pane.active');
        if (!activePane) return;
        const rows = activePane.querySelectorAll('tbody tr:not(.empty-state-row):not(.search-empty-row)');
        let visibleCount = 0;

        rows.forEach(function(row) {
          const text = row.textContent.toLowerCase();
          const matches = text.includes(query);
          row.style.display = matches ? '' : 'none';
          if (matches) visibleCount++;
        });

        const searchEmpty = activePane.querySelector('.search-empty-row');
        if (searchEmpty) {
          searchEmpty.style.display = (visibleCount === 0 && rows.length > 0 && query !== '') ? '' : 'none';
        }
        if (window.lucide) lucide.createIcons({ attrs: { 'stroke-width': 1.75 } });
      }

      // 5. Sync Form Loading Animation
      document.querySelectorAll('.sync-form').forEach(function(form) {
        form.addEventListener('submit', function() {
          const btn = this.querySelector('.spin-on-click');
          if (btn) {
            btn.classList.add('animating');
            const span = btn.querySelector('span');
            if (span) span.textContent = 'Syncing...';
          }
        });
      });
    });
  </script>
</body>
</html>
