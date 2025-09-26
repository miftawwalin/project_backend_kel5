@extends('layouts.app')

@section('title', 'User Information')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">User Information Management</h4>
  </div>
  <div class="d-flex align-items-center flex-wrap text-nowrap">
    <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="user-plus"></i>
      Add User
    </button>
    <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="download-cloud"></i>
      Export Users
    </button>
  </div>
</div>

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Total Users</h6>
              <div class="dropdown mb-2">
                <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span>View</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="users" class="icon-sm me-2"></i> <span>Manage</span></a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2">247</h3>
                <div class="d-flex align-items-baseline">
                  <p class="text-success">
                    <span>+12.5%</span>
                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <div id="usersChart" class="mt-md-3 mt-xl-0"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Active Users</h6>
              <div class="dropdown mb-2">
                <a type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span>View</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="activity" class="icon-sm me-2"></i> <span>Activity</span></a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2">189</h3>
                <div class="d-flex align-items-baseline">
                  <p class="text-success">
                    <span>+8.2%</span>
                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <div id="activeUsersChart" class="mt-md-3 mt-xl-0"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">New This Month</h6>
              <div class="dropdown mb-2">
                <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span>View</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="user-plus" class="icon-sm me-2"></i> <span>Add New</span></a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2">24</h3>
                <div class="d-flex align-items-baseline">
                  <p class="text-info">
                    <span>+15.3%</span>
                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <div id="newUsersChart" class="mt-md-3 mt-xl-0"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-8 stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-0">User List</h6>
          <div class="dropdown mb-2">
            <a type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span>View All</span></a>
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span>Edit</span></a>
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span>Delete</span></a>
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span>Export</span></a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th class="pt-0">#</th>
                <th class="pt-0">Name</th>
                <th class="pt-0">Email</th>
                <th class="pt-0">Role</th>
                <th class="pt-0">Status</th>
                <th class="pt-0">Last Login</th>
                <th class="pt-0">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>
                  <div class="d-flex align-items-center">
                    <img class="wd-30 ht-30 rounded-circle me-2" src="https://via.placeholder.com/30x30" alt="profile">
                    <span>John Doe</span>
                  </div>
                </td>
                <td>john.doe@kelompok5.com</td>
                <td>Administrator</td>
                <td><span class="badge bg-success">Active</span></td>
                <td>2025-01-15 09:30</td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-link p-0" type="button" data-bs-toggle="dropdown">
                      <i data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#"><i data-feather="edit-2" class="icon-sm me-2"></i>Edit</a>
                      <a class="dropdown-item" href="#"><i data-feather="trash" class="icon-sm me-2"></i>Delete</a>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>
                  <div class="d-flex align-items-center">
                    <img class="wd-30 ht-30 rounded-circle me-2" src="https://via.placeholder.com/30x30" alt="profile">
                    <span>Jane Smith</span>
                  </div>
                </td>
                <td>jane.smith@kelompok5.com</td>
                <td>Manager</td>
                <td><span class="badge bg-success">Active</span></td>
                <td>2025-01-15 08:45</td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-link p-0" type="button" data-bs-toggle="dropdown">
                      <i data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#"><i data-feather="edit-2" class="icon-sm me-2"></i>Edit</a>
                      <a class="dropdown-item" href="#"><i data-feather="trash" class="icon-sm me-2"></i>Delete</a>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>3</td>
                <td>
                  <div class="d-flex align-items-center">
                    <img class="wd-30 ht-30 rounded-circle me-2" src="https://via.placeholder.com/30x30" alt="profile">
                    <span>Mike Johnson</span>
                  </div>
                </td>
                <td>mike.johnson@kelompok5.com</td>
                <td>User</td>
                <td><span class="badge bg-warning">Inactive</span></td>
                <td>2025-01-10 14:20</td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-link p-0" type="button" data-bs-toggle="dropdown">
                      <i data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#"><i data-feather="edit-2" class="icon-sm me-2"></i>Edit</a>
                      <a class="dropdown-item" href="#"><i data-feather="trash" class="icon-sm me-2"></i>Delete</a>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div> 
    </div>
  </div>
  <div class="col-lg-4 stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-0">User Roles Distribution</h6>
        </div>
        <div id="userRolesChart"></div>
        <div class="row mb-3">
          <div class="col-6 d-flex justify-content-end">
            <div>
              <label class="d-flex align-items-center justify-content-end tx-10 text-uppercase fw-bolder">Administrator <span class="p-1 ms-1 rounded-circle bg-primary"></span></label>
              <h5 class="fw-bolder mb-0 text-end">25</h5>
            </div>
          </div>
          <div class="col-6">
            <div>
              <label class="d-flex align-items-center tx-10 text-uppercase fw-bolder"><span class="p-1 me-1 rounded-circle bg-success"></span> Manager</label>
              <h5 class="fw-bolder mb-0">67</h5>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-6 d-flex justify-content-end">
            <div>
              <label class="d-flex align-items-center justify-content-end tx-10 text-uppercase fw-bolder">User <span class="p-1 ms-1 rounded-circle bg-warning"></span></label>
              <h5 class="fw-bolder mb-0 text-end">155</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
