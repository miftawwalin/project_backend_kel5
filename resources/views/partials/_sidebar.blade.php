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
      <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>

      {{-- HANYA ADMIN YANG MELIHAT DATA MANAGEMENT --}}
      @if(auth()->user()->role === 'admin')
      <li class="nav-item nav-category">Data Management</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#products" role="button"
           aria-expanded="false" aria-controls="products">
          <i class="link-icon" data-feather="package"></i>
          <span class="link-title">Products</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="products">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('informasi-stock') }}"
                 class="nav-link {{ request()->routeIs('informasi-stock*') ? 'active' : '' }}">
                 Stock Information
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('add-product') }}" class="nav-link">Add Product</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Categories</a>
            </li>
          </ul>
        </div>
      </li>
      @endif

      {{-- USER BISA MELIHAT STOCK INFO TANPA ADD PRODUCT --}}
      @if(auth()->user()->role === 'user')
      <li class="nav-item nav-category">Stock</li>
      <li class="nav-item">
        <a href="{{ route('informasi-stock') }}" class="nav-link {{ request()->routeIs('informasi-stock*') ? 'active' : '' }}">
          <i class="link-icon" data-feather="archive"></i>
          <span class="link-title">Stock Information</span>
        </a>
      </li>
      @endif

      {{-- REQUEST FORM UNTUK SEMUA ROLE --}}
      <li class="nav-item">
        <a href="{{ route('form-request-user') }}" class="nav-link {{ request()->routeIs('form-request-user*') ? 'active' : '' }}">
          <i class="link-icon" data-feather="file-text"></i>
          <span class="link-title">Request Form</span>
        </a>
      </li>

      {{-- USER MANAGEMENT HANYA ADMIN --}}
      @if(auth()->user()->role === 'admin')
      <li class="nav-item">
        <a href="{{ route('user-informasi') }}" class="nav-link {{ request()->routeIs('user-informasi*') ? 'active' : '' }}">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">User Management</span>
        </a>
      </li>
      @endif

      {{-- DATA MASTER (ADMIN ONLY) --}}
      @if(auth()->user()->role === 'admin')
      <li class="nav-item nav-category">Data Master</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#dataMaster" role="button"
           aria-expanded="false" aria-controls="dataMaster">
          <i class="link-icon" data-feather="database"></i>
          <span class="link-title">Inventory Management</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="dataMaster">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('inventory-dashboard') }}"
                 class="nav-link {{ request()->routeIs('inventory-dashboard*') ? 'active' : '' }}">Inventory Dashboard</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('inventory-movements') }}"
                 class="nav-link {{ request()->routeIs('inventory-movements*') ? 'active' : '' }}">Stock Movements</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('inventory-reports') }}"
                 class="nav-link {{ request()->routeIs('inventory-reports*') ? 'active' : '' }}">Inventory Reports</a>
            </li>
          </ul>
        </div>
      </li>
      @endif

      {{-- SETTINGS (ADMIN ONLY) --}}
      @if(auth()->user()->role === 'admin')
      <li class="nav-item nav-category">Settings</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#settings" role="button"
           aria-expanded="false" aria-controls="settings">
          <i class="link-icon" data-feather="settings"></i>
          <span class="link-title">Configuration</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="settings">
          <ul class="nav sub-menu">
            <li class="nav-item"><a href="#" class="nav-link">General Settings</a></li>
            <li class="nav-item"><a href="#" class="nav-link">System Logs</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Backup & Restore</a></li>
          </ul>
        </div>
      </li>
      @endif

      {{-- ABOUT & CONTACT UNTUK SEMUA ROLE --}}
      <li class="nav-item nav-category">Information</li>
      <li class="nav-item">
        <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about*') ? 'active' : '' }}">
          <i class="link-icon" data-feather="info"></i>
          <span class="link-title">About</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact*') ? 'active' : '' }}">
          <i class="link-icon" data-feather="phone"></i>
          <span class="link-title">Contact</span>
        </a>
      </li>
    </ul>
  </div>
</nav>
