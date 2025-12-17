<!-- partial:partials/_navbar.html -->
<nav class="navbar">
  <a href="#" class="sidebar-toggler">
    <i data-feather="menu"></i>
  </a>
  <div class="navbar-content">
    
    <!-- Functional Global Search -->
    <form class="search-form" action="{{ route('inventory-dashboard') }}" method="GET">
      <div class="input-group">
        <div class="input-group-text">
          <i data-feather="search" class="text-muted"></i>
        </div>
        <input type="text" class="form-control" name="search" id="navbarForm" placeholder="Search inventory..." value="{{ request('search') }}">
      </div>
    </form>

    <ul class="navbar-nav">
      
      <!-- Quick Access Apps -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="appsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i data-feather="grid"></i>
        </a>
        <div class="dropdown-menu p-0" aria-labelledby="appsDropdown">
          <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
            <p class="mb-0 fw-bold">Quick Access</p>
          </div>
          <div class="row g-0 p-1">
            <div class="col-3 text-center">
              @if(Auth::check() && Auth::user()->role === 'admin')
                  <a href="{{ route('requests.index') }}" class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70">
                    <i data-feather="file-text" class="icon-lg mb-1"></i>
                    <p class="tx-12">Requests</p>
                  </a>
              @else
                  <a href="{{ route('form-request-user') }}" class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70">
                    <i data-feather="edit" class="icon-lg mb-1"></i>
                    <p class="tx-12">Buat Req</p>
                  </a>
              @endif
            </div>
            <div class="col-3 text-center">
              <a href="{{ route('inventory-dashboard') }}" class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70">
                <i data-feather="box" class="icon-lg mb-1"></i>
                <p class="tx-12">Stock</p>
              </a>
            </div>
            <div class="col-3 text-center">
              <a href="{{ route('inventory-movements') }}" class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70">
                <i data-feather="activity" class="icon-lg mb-1"></i>
                <p class="tx-12">Movements</p>
              </a>
            </div>
            <div class="col-3 text-center">
              <a href="{{ route('inventory-reports') }}" class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70">
                <i data-feather="pie-chart" class="icon-lg mb-1"></i>
                <p class="tx-12">Reports</p>
              </a>
            </div>
          </div>
        </div>
      </li>

      <!-- Notifications (Mockup for System Alerts) -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i data-feather="bell"></i>
          <!-- Indicator dot (optional logic could go here) -->
          {{-- <div class="indicator"><div class="circle"></div></div> --}}
        </a>
        <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
          <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
            <p>System Notifications</p>
            <a href="javascript:;" class="text-muted">Clear all</a>
          </div>
          <div class="p-1">
            <div class="dropdown-item d-flex align-items-center py-2">
              <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-danger rounded-circle me-3">
                <i class="icon-sm text-white" data-feather="alert-circle"></i>
              </div>
              <div class="flex-grow-1">
                <h6 class="mb-1">Low Stock Alert</h6>
                <p class="text-muted tx-13 mb-0">Check your inventory dashboard.</p>
              </div>
            </div>
            <div class="dropdown-item d-flex align-items-center py-2">
              <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                <i class="icon-sm text-white" data-feather="info"></i>
              </div>
              <div class="flex-grow-1">
                <h6 class="mb-1">System Update</h6>
                <p class="text-muted tx-13 mb-0">System is running normally.</p>
              </div>
            </div>
          </div>
          <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
            <a href="javascript:;">View all</a>
          </div>
        </div>
      </li>

      <!-- Profile Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="wd-30 ht-30 rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bolder">
            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
          </div>
        </a>
        <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
          <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
            <div class="mb-3">
              <div class="wd-80 ht-80 rounded-circle bg-primary d-flex align-items-center justify-content-center text-white" style="font-size: 40px; font-weight: bold;">
                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
              </div>
            </div>
            <div class="text-center">
              <p class="tx-16 fw-bolder">{{ Auth::user()->name ?? 'User' }}</p>
              <p class="tx-12 text-muted">{{ Auth::user()->email ?? '-' }}</p>
            </div>
          </div>
          <ul class="list-unstyled p-1 px-2">
            <li class="dropdown-item py-2">
              <a href="javascript:;" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="user"></i>
                <span>Profile</span>
              </a>
            </li>
            <li class="dropdown-item py-2">
              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                <button type="submit" class="btn btn-link text-body p-0 ms-0 d-flex align-items-center" style="text-decoration: none;">
                  <i class="me-2 icon-md" data-feather="log-out"></i>
                  <span>Logout</span>
                </button>
              </form>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</nav>
