<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
  <div class="sidebar-header">
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
      Kelompok<span>5</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      
      <li class="nav-item nav-category">Data Management</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#products" role="button" aria-expanded="false" aria-controls="products">
          <i class="link-icon" data-feather="package"></i>
          <span class="link-title">Products</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="products">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('informasi-stock') }}" class="nav-link {{ request()->routeIs('informasi-stock*') ? 'active' : '' }}">Stock Information</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Add Product</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Categories</a>
            </li>
          </ul>
        </div>
      </li>
      
      <li class="nav-item">
        <a href="{{ route('form-request-user') }}" class="nav-link {{ request()->routeIs('form-request-user*') ? 'active' : '' }}">
          <i class="link-icon" data-feather="file-text"></i>
          <span class="link-title">Request Form</span>
        </a>
      </li>
      
      <li class="nav-item">
        <a href="{{ route('user-informasi') }}" class="nav-link {{ request()->routeIs('user-informasi*') ? 'active' : '' }}">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">User Management</span>
        </a>
      </li>
      
      <li class="nav-item nav-category">Reports</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#reports" role="button" aria-expanded="false" aria-controls="reports">
          <i class="link-icon" data-feather="pie-chart"></i>
          <span class="link-title">Analytics</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="reports">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="#" class="nav-link">Sales Report</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Stock Report</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">User Activity</a>
            </li>
          </ul>
        </div>
      </li>
      
      <li class="nav-item nav-category">Settings</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#settings" role="button" aria-expanded="false" aria-controls="settings">
          <i class="link-icon" data-feather="settings"></i>
          <span class="link-title">Configuration</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="settings">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="#" class="nav-link">General Settings</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">System Logs</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Backup & Restore</a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</nav>
