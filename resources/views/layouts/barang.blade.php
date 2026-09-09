<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Barang - KMS Hub</title>

  <!-- SEO Optimization -->
  <meta name="description" content="Data Barang - KMS Hub">
  <meta name="author" content="KMS Hub">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('template/assets/images/favicon.ico') }}">

  <!-- Local Third-Party Libraries (100% Offline Compatible) -->
  <link rel="stylesheet" href="{{ asset('template/assets/libs/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{  asset('template/assets/libs/apexcharts/apexcharts.css') }}">
  <link rel="stylesheet" href="{{ asset('template/assets/libs/flatpickr/flatpickr.min.css')}}">

  <!-- Main Design System & Custom Stylesheet -->
  <link rel="stylesheet" href="{{ asset('template/assets/css/main.css')}}">
</head>

<body>

  <!-- ==========================================
         START: Sidebar Component
         ========================================== -->
  <div class="sidebar-wrapper" id="sidebar">
    <!-- Brand Logo / Identity -->
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
      <i class="bi bi-asterisk"></i>
      <span>KMS Hub Mini</span>
    </a>

    <!-- Navigation Menu -->
    @include('layouts.navmenu')

    <!-- Sidebar Profile Card (Dynamic Footer) -->
    <div class="sidebar-profile">
      <img src="{{ asset('assets/images/avatar.png') }}" alt="Administrator" class="sidebar-profile-img"
        onerror="this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=256&auto=format&fit=crop'">
      <div class="sidebar-profile-info">
        <div class="sidebar-profile-name">{{ auth()->check() ? auth()->user()->nama : 'Administrator' }}</div>
        <div class="sidebar-profile-email">{{ auth()->check() ? auth()->user()->email : 'admin@email.com' }}</div>
      </div>
    </div>
  </div>
  <!-- ==========================================
         END: Sidebar Component
         ========================================== -->


  <!-- ==========================================
         START: Main Content Area
         ========================================== -->
  <div class="main-wrapper">

    <!-- START: Top Navbar Component -->
    <header class="navbar-custom">
      <div class="navbar-left">
        <!-- Desktop sidebar toggle (visible on large screens only) -->
        <button class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3"
          id="desktop-sidebar-toggle" aria-label="Minimize Sidebar">
          <i class="bi bi-chevron-bar-left"></i>
        </button>
        <!-- Mobile sidebar toggle -->
        <button class="sidebar-toggle-btn me-2" id="sidebar-toggle" aria-label="Toggle Navigation">
          <i class="bi bi-list"></i>
        </button>

        <!-- Quick Actions Dropdown -->
        <div class="dropdown ms-2">
          <button class="btn-quick-action dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"
            id="quick-actions-dropdown">
            <i class="bi bi-plus-lg"></i>
            <span>Create</span>
          </button>
          <ul class="dropdown-menu dropdown-menu-quick-action" aria-labelledby="quick-actions-dropdown">
            <li class="dropdown-header">Quick Action Shortcuts</li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-plus"></i> New Invoice</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-person-plus"></i> New User</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-box-seam"></i> New Product</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> System Settings</a></li>
          </ul>
        </div>
      </div>

      <!-- Mid navbar: search pill -->
      <div class="navbar-search-wrapper">
        <input type="text" class="navbar-search-input" placeholder="Search anything..." id="main-search">
        <button class="navbar-search-btn" aria-label="Search">
          <i class="bi bi-search"></i>
        </button>
      </div>

      <!-- Right actions -->
      <div class="navbar-actions">
        <!-- Fullscreen Toggle -->
        <button class="navbar-action-btn me-1" aria-label="Toggle Fullscreen" id="btn-fullscreen">
          <i class="bi bi-arrows-fullscreen"></i>
        </button>
        <div class="dropdown">
          <button class="navbar-action-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false" id="btn-notifications" data-bs-auto-close="outside">
            <i class="bi bi-bell"></i>
            <span class="navbar-action-badge"></span>
          </button>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-notification p-0"
            aria-labelledby="btn-notifications">
            <div class="notification-header">
              <h6 class="notification-title">Notifications</h6>
              <button class="btn-clear-all" type="button">Mark all read</button>
            </div>
            <div class="notification-list">
              <!-- Sale Notification -->
              <a href="#" class="notification-item">
                <div class="notification-icon bg-success text-white">
                  <i class="bi bi-wallet2"></i>
                </div>
                <div class="notification-content">
                  <p class="notification-text">New sale received: <strong>$150.00</strong></p>
                  <span class="notification-time">2 mins ago</span>
                </div>
                <span class="notification-unread-dot"></span>
              </a>
              <!-- User Registration Notification -->
              <a href="#" class="notification-item">
                <div class="notification-icon bg-primary text-white">
                  <i class="bi bi-person-plus-fill"></i>
                </div>
                <div class="notification-content">
                  <p class="notification-text">New user registered: <strong>John Doe</strong></p>
                  <span class="notification-time">1 hour ago</span>
                </div>
                <span class="notification-unread-dot"></span>
              </a>
              <!-- Low Stock Notification -->
              <a href="#" class="notification-item">
                <div class="notification-icon bg-warning text-dark">
                  <i class="bi bi-box-seam-fill"></i>
                </div>
                <div class="notification-content">
                  <p class="notification-text">Stock running low: <strong>Hoodie</strong></p>
                  <span class="notification-time">3 hours ago</span>
                </div>
              </a>
            </div>
            <a href="#" class="notification-footer">View All Notifications</a>
          </div>
        </div>

        <!-- Profile Dropdown -->
        <div class="dropdown ms-2">
          <button class="navbar-profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false" id="profile-dropdown">
            <img src="{{ asset('assets/images/avatar.png') }}" alt="Profile Image" class="navbar-profile-img">
            <span class="navbar-profile-name d-none d-md-inline">{{ auth()->check() ? auth()->user()->nama : 'Administrator' }}</span>
            <i class="bi bi-chevron-down navbar-profile-caret"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile" aria-labelledby="profile-dropdown">
            <li class="dropdown-header">Welcome !</li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> My Account</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-lock"></i> Lock Screen</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right"></i>
                Logout</a></li>
          </ul>
        </div>
      </div>
    </header>
    <!-- END: Top Navbar Component -->

    <!-- START: Page Header Banner -->
    <div class="page-header">
      <div>
        <h1 class="page-title">Data Barang</h1>
        <p class="page-subtitle">Manajemen daftar barang.</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted-green">Home</a></li>
          <li class="breadcrumb-item text-muted-green">Data Master</li>
          <li class="breadcrumb-item active text-main" aria-current="page">Barang</li>
        </ol>
      </nav>
    </div>
    <!-- END: Page Header Banner -->

    <!-- Alerts for Flash Messages -->
    <div class="container-fluid px-4 mt-3">
        @if(session('sukses'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('sukses') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- START: Basic Table Card Container -->
    <div class="table-card-custom">
      <!-- Header Controls -->
      <div class="table-header-control">
        <!-- Search bar -->
        <div class="table-search-box">
          <i class="bi bi-search table-search-icon"></i>
          <input type="text" class="table-search-input" placeholder="Cari barang..." id="searchBarang">
        </div>
        @if(auth()->check() && auth()->user()->role === 'admin')
        <!-- Action buttons -->
        <div class="table-filter-group">
          <button class="btn-table-action" type="button" data-bs-toggle="modal" data-bs-target="#modalTambahBarang">
            <i class="bi bi-plus-lg"></i> Tambah Barang
          </button>
        </div>
        @endif
      </div>

      <!-- Responsive Table Wrapper -->
      <div class="table-responsive">
        <table class="table-custom" id="tabelBarang">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama Barang</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Kategori</th>
              @if(auth()->check() && auth()->user()->role === 'admin')
              <th class="text-center">Actions</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach($barangs as $barang)
            <tr>
              <td class="table-order-id">{{ $barang->id }}</td>
              <td>
                <div class="transaction-name fw-semibold">{{ $barang->nama }}</div>
              </td>
              <td>
                <span class="text-muted-green">Rp {{ number_format($barang->harga, 2, ',', '.') }}</span>
              </td>
              <td>
                <span class="text-muted-green">{{ $barang->stok }}</span>
              </td>
              <td>
                <span class="badge bg-success bg-opacity-10 text-success px-2 py-1">{{ $barang->kategori->nama_kategori ?? '-' }}</span>
              </td>
              @if(auth()->check() && auth()->user()->role === 'admin')
              <td>
                <div class="d-flex justify-content-center gap-1">
                  <button type="button" class="table-btn-action" title="Ubah"
                    data-bs-toggle="modal" data-bs-target="#modalUbahBarang"
                    data-id="{{ $barang->id }}"
                    data-nama="{{ $barang->nama }}"
                    data-harga="{{ $barang->harga }}"
                    data-stok="{{ $barang->stok }}"
                    data-kategori-id="{{ $barang->kategori_id }}">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <form action="{{ route('barang.hapus', $barang->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="table-btn-action delete" title="Hapus" style="border: none; background: none;">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
              @endif
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>

      <!-- Footer Controls / Pagination -->
      <div class="table-footer-control">
        <span class="table-pagination-info">Menampilkan {{ $barangs->count() }} barang</span>
        <nav aria-label="Page navigation">
          <ul class="pagination mb-0 gap-1">
            <li class="page-item disabled"><a class="page-link border-0" href="#"><i class="bi bi-chevron-left"></i></a>
            </li>
            <li class="page-item active"><a class="page-link border-0" href="#">1</a></li>
            <li class="page-item"><a class="page-link border-0" href="#"><i class="bi bi-chevron-right"></i></a></li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- END: Basic Table Card Container -->

    <!-- ==========================================
         MODAL: Tambah Barang
         ========================================== -->
    <div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-labelledby="modalTambahBarangLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTambahBarangLabel">
              <i class="bi bi-plus-circle me-2"></i>Tambah Barang Baru
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST" action="{{ url('simpan-barang') }}">
            @csrf
            <div class="modal-body">
              <div class="mb-3">
                <label for="tambah_nama_barang" class="form-label fw-semibold">Nama Barang <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="tambah_nama_barang" name="nama"
                       value="{{ old('nama') }}"
                       placeholder="Masukkan nama barang" required>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="tambah_harga" class="form-label fw-semibold">Harga <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control" id="tambah_harga" name="harga"
                           value="{{ old('harga') }}" step="0.01" min="0"
                           placeholder="0" required>
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="tambah_stok" class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
                  <input type="number" class="form-control" id="tambah_stok" name="stok"
                         value="{{ old('stok', 0) }}" min="0"
                         placeholder="0" required>
                </div>
              </div>
              <div class="mb-3">
                <label for="tambah_kategori" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                <select class="form-select" id="tambah_kategori" name="kategori_id" required>
                  <option value="" disabled selected>-- Pilih Kategori --</option>
                  @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                      {{ $kategori->nama_kategori }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="bi bi-x-lg me-1"></i>Batal
              </button>
              <button type="submit" class="btn btn-success">
                <i class="bi bi-check-lg me-1"></i>Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- ==========================================
         MODAL: Ubah Barang
         ========================================== -->
    <div class="modal fade" id="modalUbahBarang" tabindex="-1" aria-labelledby="modalUbahBarangLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalUbahBarangLabel">
              <i class="bi bi-pencil-square me-2"></i>Ubah Barang
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST" action="{{ url('/update-barang') }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="ubah_barang_id">
            <div class="modal-body">
              <div class="mb-3">
                <label for="ubah_nama_barang" class="form-label fw-semibold">Nama Barang <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="ubah_nama_barang" name="nama"
                       placeholder="Masukkan nama barang" required>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="ubah_harga" class="form-label fw-semibold">Harga <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control" id="ubah_harga" name="harga"
                           step="0.01" min="0"
                           placeholder="0" required>
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="ubah_stok" class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
                  <input type="number" class="form-control" id="ubah_stok" name="stok"
                         min="0" placeholder="0" required>
                </div>
              </div>
              <div class="mb-3">
                <label for="ubah_kategori" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                <select class="form-select" id="ubah_kategori" name="kategori_id" required>
                  <option value="" disabled>-- Pilih Kategori --</option>
                  @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="bi bi-x-lg me-1"></i>Batal
              </button>
              <button type="submit" class="btn btn-success">
                <i class="bi bi-check-lg me-1"></i>Simpan Perubahan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- START: Footer Component -->
    <footer class="footer-custom">
      <div class="footer-left">
        <span class="footer-logo">
          <i class="bi bi-asterisk"></i> KMS Hub
        </span>
        <span class="footer-separator">|</span>
        <span class="footer-copy">&copy; 2026 KMS Hub Mini</span>
      </div>
      <div class="footer-right">
        <ul class="footer-links">
          <li><a href="#" class="footer-link">Overview</a></li>
          <li><a href="#" class="footer-link">Statistics</a></li>
          <li><a href="#" class="footer-link">Help & Documentation</a></li>
          <li><a href="#" class="footer-link">Status <span class="status-dot"></span></a></li>
        </ul>
      </div>
    </footer>
    <!-- END: Footer Component -->

  </div>
  <!-- ==========================================
         END: Main Content Area
         ========================================== -->

  <!-- Local Third-Party Libraries Script dependencies -->
  <script src="{{ asset('template/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('template/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('template/assets/libs/flatpickr/flatpickr.min.js') }}"></script>

  <!-- Local dashboard interactions controller -->
  <script src="{{ asset('template/assets/js/dashboard.js') }}"></script>

  <script>
    // Populate Edit Modal with data from clicked row
    const modalUbahBarang = document.getElementById('modalUbahBarang');
    if (modalUbahBarang) {
      modalUbahBarang.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const nama = button.getAttribute('data-nama');
        const harga = button.getAttribute('data-harga');
        const stok = button.getAttribute('data-stok');
        const kategoriId = button.getAttribute('data-kategori-id');

        this.querySelector('#ubah_barang_id').value = id;
        this.querySelector('#ubah_nama_barang').value = nama;
        this.querySelector('#ubah_harga').value = harga;
        this.querySelector('#ubah_stok').value = stok;
        this.querySelector('#ubah_kategori').value = kategoriId;
      });
    }

    // Auto-open create modal if there are validation errors
    @if($errors->any() && old('_method') === null)
      const modalTambah = new bootstrap.Modal(document.getElementById('modalTambahBarang'));
      modalTambah.show();
    @endif

    // Simple table search
    const searchInput = document.getElementById('searchBarang');
    if (searchInput) {
      searchInput.addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#tabelBarang tbody tr');
        rows.forEach(row => {
          const text = row.textContent.toLowerCase();
          row.style.display = text.includes(filter) ? '' : 'none';
        });
      });
    }
  </script>
</body>

</html>