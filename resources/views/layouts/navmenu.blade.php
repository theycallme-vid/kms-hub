    <div class="flex-grow-1 overflow-y-auto">
      <!-- Group: Menu -->
      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title">Menu</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="{{ route('dashboard') }}" class="sidebar-menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" id="menu-overview" title="Dashboard">
              <i class="bi bi-grid-fill"></i>
              <span>Dashboard</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- Group: Components -->
      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title">Data Master</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="{{ route('kategori') }}" class="sidebar-menu-link {{ request()->routeIs('kategori') ? 'active' : '' }}" id="menu-kategori" title="Kategori">
              <i class="bi bi-tags"></i>
              <span>Kategori</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="{{ route('barang') }}" class="sidebar-menu-link {{ request()->routeIs('barang') ? 'active' : '' }}" id="menu-barang" title="Barang">
              <i class="bi bi-box-seam"></i>
              <span>Barang</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="{{ route('pegawai') }}" class="sidebar-menu-link {{ request()->routeIs('pegawai') ? 'active' : '' }}" id="menu-pegawai" title="Pegawai">
              <i class="bi bi-people"></i>
              <span>Pegawai</span>
            </a>
          </li>
        </ul>
      </div>
    </div>