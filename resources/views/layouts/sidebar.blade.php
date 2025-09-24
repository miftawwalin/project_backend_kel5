<nav class="sidebar">
      <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
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
            <a href="{{ route('dashboard') }}" class="nav-link">
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
                  <a href="#" class="nav-link">All Products</a>
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
            <a href="#" class="nav-link">
              <i class="link-icon" data-feather="shopping-cart"></i>
              <span class="link-title">Sales</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="link-icon" data-feather="users"></i>
              <span class="link-title">Customers</span>
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
                  <a href="#" class="nav-link">Inventory Report</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">Customer Report</a>
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
                  <a href="#" class="nav-link">User Management</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">System Logs</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <nav class="settings-sidebar">
      <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
          <i data-feather="settings"></i>
        </a>
        <h6 class="text-muted mb-2">Sidebar:</h6>
        <div class="mb-3 pb-3 border-bottom">
          <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight" value="sidebar-light" checked>
            <label class="form-check-label" for="sidebarLight">
              Light
            </label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark" value="sidebar-dark">
            <label class="form-check-label" for="sidebarDark">
              Dark
            </label>
          </div>
        </div>
        <div class="theme-wrapper">
          <h6 class="text-muted mb-2">Light Theme:</h6>
          <a class="theme-item active" href="#">
            <img src="{{ asset('assets/images/screenshots/light.jpg') }}" alt="light theme">
          </a>
          <h6 class="text-muted mb-2">Dark Theme:</h6>
          <a class="theme-item" href="#">
            <img src="{{ asset('assets/images/screenshots/dark.jpg') }}" alt="dark theme">
          </a>
        </div>
      </div>
    </nav>
