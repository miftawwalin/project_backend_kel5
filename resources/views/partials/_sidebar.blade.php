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
          <i class="link-icon" data-feather="home"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>

      {{-- HANYA ADMIN YANG MELIHAT DATA MANAGEMENT --}}  
      <li class="nav-item nav-category">Data Management</li>
      {{-- REQUEST FORM UNTUK SEMUA ROLE --}}

      

      <li class="nav-item">
    <a href="{{ route('form-request-user') }}"
       class="nav-link {{ request()->routeIs('form-request-user*') ? 'active' : '' }}">
        <i class="link-icon" data-feather="edit"></i>
        <span class="link-title">Request By User</span>
    </a>
</li>

      @if(auth()->user()->role === 'admin')
<li class="nav-item">
    <a href="{{ route('admin.form-request') }}"
       class="nav-link {{ request()->routeIs('admin.form-request*') ? 'active' : '' }}">
        <i class="link-icon" data-feather="file-plus"></i>
        <span class="link-title">Request By Admin</span>
    </a>
</li>
@endif

      <li class="nav-item">
        <a href="{{ route('informasi-stock') }}" class="nav-link {{ request()->routeIs('informasi-stock*') ? 'active' : '' }}">
          <i class="link-icon" data-feather="package"></i>
          <span class="link-title">Stock Information</span>
        </a>
      </li>

      @if(auth()->user()->role === 'admin')
<li class="nav-item">
    <a href="{{ route('requests.index') }}"
       class="nav-link {{ request()->routeIs('requests.index*') ? 'active' : '' }}">
        <i class="link-icon" data-feather="check-circle"></i>
        <span class="link-title">Approve Request</span>
    </a>
</li>
@endif


      {{-- DATA MASTER (ADMIN ONLY) --}}
      @if(auth()->user()->role === 'admin')
      <li class="nav-item nav-category">Data Master</li>
      {{-- ubahan ryan *u admin --}}
      <li class="nav-item">
        <a href="{{ route('inventory-dashboard') }}" class="nav-link {{ request()->routeIs('inventory-dashboard*') ? 'active' : '' }}">
          <i class="link-icon" data-feather="trending-up"></i>
          <span class="link-title">Inventory Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('add-product') }}" class="nav-link {{ request()->routeIs('add-product*') ? 'active' : '' }}">
          <i class="link-icon" data-feather="plus-circle"></i>
          <span class="link-title">Add Product</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('inventory-movements') }}" class="nav-link {{ request()->routeIs('inventory-movements*') ? 'active' : '' }}">
          <i class="link-icon" data-feather="refresh-cw"></i>
          <span class="link-title">Stock Movements</span>
        </a>
      </li>
      @endif

      {{-- SETTINGS (ADMIN ONLY) --}}
      @if(auth()->user()->role === 'admin')
      <li class="nav-item nav-category">Settings</li>
      <li class="nav-item">
        <a href="{{ route('user-informasi') }}" class="nav-link {{ request()->routeIs('user-informasi*') ? 'active' : '' }}">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">User Management</span>
        </a>
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
