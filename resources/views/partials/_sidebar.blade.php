<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
  <div class="sidebar-header">
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
      <img id="sidebar-logo" src="{{ asset('assets/images/logo.png') }}" alt="Logo"
           style="width: 165px; height: 100%; object-fit: contain; border-radius: 5px; margin-right: 8px;">
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>

  <div class="sidebar-body">
    <ul class="nav">

      {{-- MAIN --}}
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item {{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') || request()->routeIs('user.dashboard') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') || request()->routeIs('user.dashboard') ? 'active' : '' }}">
          <i class="link-icon" data-feather="home"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>

      {{-- HANYA ADMIN YANG MELIHAT DATA MANAGEMENT --}}  
      <li class="nav-item nav-category">Data Management</li>
      {{-- REQUEST FORM UNTUK SEMUA ROLE --}}

      

      <li class="nav-item {{ request()->routeIs('form-request-user') || request()->routeIs('requests.store') ? 'active' : '' }}">
    <a href="{{ route('form-request-user') }}"
       class="nav-link {{ request()->routeIs('form-request-user') || request()->routeIs('requests.store') ? 'active' : '' }}">
        <i class="link-icon" data-feather="edit"></i>
        <span class="link-title">Request Manual</span>
    </a>
</li>

<li class="nav-item {{ request()->routeIs('admin.form-request') || request()->routeIs('admin.store-request') || request()->routeIs('admin.get-product') ? 'active' : '' }}">
    <a href="{{ route('admin.form-request') }}"
       class="nav-link {{ request()->routeIs('admin.form-request') || request()->routeIs('admin.store-request') || request()->routeIs('admin.get-product') ? 'active' : '' }}">
        <i class="link-icon" data-feather="file-plus"></i>
        <span class="link-title">Scan Barcode</span>
    </a>
</li>

      <li class="nav-item {{ request()->routeIs('informasi-stock') ? 'active' : '' }}">
        <a href="{{ route('informasi-stock') }}" class="nav-link {{ request()->routeIs('informasi-stock') ? 'active' : '' }}">
          <i class="link-icon" data-feather="package"></i>
          <span class="link-title">Stock Information</span>
        </a>
      </li>

      <li class="nav-item {{ request()->routeIs('stock-minim') ? 'active' : '' }}">
        <a href="{{ route('stock-minim') }}" class="nav-link {{ request()->routeIs('stock-minim') ? 'active' : '' }}">
          <i class="link-icon" data-feather="alert-triangle"></i>
          <span class="link-title">Stock Minim</span>
        </a>
      </li>

      @if(auth()->user()->role === 'admin')
<li class="nav-item {{ request()->routeIs('requests.index') || request()->routeIs('requests.approve') || request()->routeIs('requests.reject') ? 'active' : '' }}">
    <a href="{{ route('requests.index') }}"
       class="nav-link {{ request()->routeIs('requests.index') || request()->routeIs('requests.approve') || request()->routeIs('requests.reject') ? 'active' : '' }}">
        <i class="link-icon" data-feather="check-circle"></i>
        <span class="link-title">Approve Request</span>
    </a>
</li>
@endif


      {{-- DATA MASTER (ADMIN ONLY) --}}
      @if(auth()->user()->role === 'admin')
      <li class="nav-item nav-category">Data Master</li>
      {{-- ubahan ryan *u admin --}}
      <li class="nav-item {{ request()->routeIs('inventory-dashboard') || request()->is('inventory-dashboard') ? 'active' : '' }}">
        <a href="{{ route('inventory-dashboard') }}" class="nav-link {{ request()->routeIs('inventory-dashboard') || request()->is('inventory-dashboard') ? 'active' : '' }}">
          <i class="link-icon" data-feather="trending-up"></i>
          <span class="link-title">Inventory Dashboard</span>
        </a>
      </li>
      <li class="nav-item {{ request()->routeIs('add-product') || request()->routeIs('products.*') ? 'active' : '' }}">
        <a href="{{ route('add-product') }}" class="nav-link {{ request()->routeIs('add-product') || request()->routeIs('products.*') ? 'active' : '' }}">
          <i class="link-icon" data-feather="plus-circle"></i>
          <span class="link-title">Add Product</span>
        </a>
      </li>
      <li class="nav-item {{ request()->routeIs('inventory-movements') || request()->routeIs('inventory-items') || request()->routeIs('inventory-reports') ? 'active' : '' }}">
        <a href="{{ route('inventory-movements') }}" class="nav-link {{ request()->routeIs('inventory-movements') || request()->routeIs('inventory-items') || request()->routeIs('inventory-reports') ? 'active' : '' }}">
          <i class="link-icon" data-feather="refresh-cw"></i>
          <span class="link-title">Stock Movements</span>
        </a>
      </li>
      @endif

      {{-- SETTINGS (ADMIN ONLY) --}}
      @if(auth()->user()->role === 'admin')
      <li class="nav-item nav-category">Settings</li>
      <li class="nav-item {{ request()->routeIs('user-informasi') ? 'active' : '' }}">
        <a href="{{ route('user-informasi') }}" class="nav-link {{ request()->routeIs('user-informasi') ? 'active' : '' }}">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">User Management</span>
        </a>
      </li>
      @endif

      {{-- ABOUT & CONTACT UNTUK SEMUA ROLE --}}
      <li class="nav-item nav-category">Information</li>
      <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
        <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
          <i class="link-icon" data-feather="info"></i>
          <span class="link-title">About</span>
        </a>
      </li>
      <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
        <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
          <i class="link-icon" data-feather="phone"></i>
          <span class="link-title">Contact</span>
        </a>
      </li>
    </ul>
  </div>
</nav>

<style>
/* ============================================
   PROFESSIONAL & LUXURIOUS SIDEBAR STYLING
   ============================================ */

/* Active State - Mewah & Terang */
.sidebar .nav .nav-item.active {
    position: relative;
    margin: 2px 0;
}

.sidebar .nav .nav-item.active > .nav-link {
    background: linear-gradient(135deg, rgba(13, 110, 253, 0.2) 0%, rgba(13, 110, 253, 0.1) 50%, rgba(13, 110, 253, 0.05) 100%);
    border-left: 4px solid #0d6efd;
    color: #0d6efd !important;
    font-weight: 700;
    box-shadow: 
        0 4px 20px rgba(13, 110, 253, 0.25),
        inset 0 1px 0 rgba(255, 255, 255, 0.1),
        0 0 0 1px rgba(13, 110, 253, 0.1);
    transform: translateX(2px);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

/* Glow Effect untuk Active Link */
.sidebar .nav .nav-item.active > .nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% { left: -100%; }
    100% { left: 100%; }
}

/* Icon Active State - Glow Effect */
.sidebar .nav .nav-item.active > .nav-link i.link-icon {
    color: #0d6efd !important;
    filter: drop-shadow(0 0 8px rgba(13, 110, 253, 0.6));
    transform: scale(1.1);
    transition: all 0.3s ease;
}

/* Text Active State */
.sidebar .nav .nav-item.active > .nav-link .link-title {
    color: #0d6efd !important;
    font-weight: 700;
    text-shadow: 0 1px 2px rgba(13, 110, 253, 0.2);
}

/* Hover Effect untuk Non-Active */
.sidebar .nav .nav-item:not(.active) .nav-link:hover {
    color: #0d6efd;
    background: linear-gradient(90deg, rgba(13, 110, 253, 0.08) 0%, rgba(13, 110, 253, 0.02) 100%);
    transform: translateX(3px);
    transition: all 0.3s ease;
}

.sidebar .nav .nav-item:not(.active) .nav-link:hover i.link-icon {
    color: #0d6efd;
    transform: scale(1.05);
    transition: all 0.3s ease;
}

/* Category Styling */
.sidebar .nav .nav-item.nav-category {
    font-weight: 700;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #6c757d;
    margin-top: 1rem;
    margin-bottom: 0.5rem;
    padding-left: 1.5rem;
}

/* Sidebar Brand Enhancement */
.sidebar-brand img {
    filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.15));
    transition: all 0.3s ease;
}

.sidebar-brand:hover img {
    filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.25));
    transform: scale(1.02);
}

/* Smooth Transitions */
.sidebar .nav .nav-item .nav-link {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 0 8px 8px 0;
    margin-right: 8px;
}

/* Active Indicator Dot */
.sidebar .nav .nav-item.active > .nav-link::after {
    content: '';
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    width: 6px;
    height: 6px;
    background: #0d6efd;
    border-radius: 50%;
    box-shadow: 0 0 10px rgba(13, 110, 253, 0.8);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
        transform: translateY(-50%) scale(1);
    }
    50% {
        opacity: 0.7;
        transform: translateY(-50%) scale(1.2);
    }
}

/* Sidebar Body Enhancement */
.sidebar-body {
    padding: 1rem 0;
}

/* Responsive Enhancement */
@media (max-width: 991px) {
    .sidebar .nav .nav-item.active > .nav-link {
        transform: none;
    }
}
</style>
