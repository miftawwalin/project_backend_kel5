@extends('layouts.app')

@section('title', 'User Management')

@section('content')
<div class="container-fluid">
  <!-- Header Section -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <h4 class="fw-bold text-primary mb-1">User Management</h4>
          <p class="text-muted mb-0">Kelola akun pengguna sistem</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Success/Error Messages -->
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i data-feather="check-circle"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i data-feather="alert-circle"></i> {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <!-- Statistics Cards -->
  <div class="row mb-4">
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm border-0" style="border-left: 4px solid #0d6efd !important;">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h6 class="text-muted mb-2 small text-uppercase">Total Users</h6>
              <h3 class="fw-bold mb-0">{{ $totalUsers ?? 0 }}</h3>
            </div>
            <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
              <i data-feather="users" class="text-primary" style="width: 24px; height: 24px;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm border-0" style="border-left: 4px solid #198754 !important;">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h6 class="text-muted mb-2 small text-uppercase">Administrator</h6>
              <h3 class="fw-bold mb-0 text-success">{{ $adminUsers ?? 0 }}</h3>
            </div>
            <div class="bg-success bg-opacity-10 p-3 rounded-circle">
              <i data-feather="shield" class="text-success" style="width: 24px; height: 24px;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm border-0" style="border-left: 4px solid #ffc107 !important;">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h6 class="text-muted mb-2 small text-uppercase">Regular Users</h6>
              <h3 class="fw-bold mb-0 text-warning">{{ $regularUsers ?? 0 }}</h3>
            </div>
            <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
              <i data-feather="user" class="text-warning" style="width: 24px; height: 24px;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm border-0" style="border-left: 4px solid #0dcaf0 !important;">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h6 class="text-muted mb-2 small text-uppercase">New This Month</h6>
              <h3 class="fw-bold mb-0 text-info">{{ $newThisMonth ?? 0 }}</h3>
            </div>
            <div class="bg-info bg-opacity-10 p-3 rounded-circle">
              <i data-feather="user-plus" class="text-info" style="width: 24px; height: 24px;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabs Navigation -->
  <div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
      <ul class="nav nav-tabs" id="userTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="list-tab" data-bs-toggle="tab" data-bs-target="#list" type="button" role="tab">
            <i data-feather="list" style="width: 16px; height: 16px;"></i> User List
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="create-tab" data-bs-toggle="tab" data-bs-target="#create" type="button" role="tab">
            <i data-feather="user-plus" style="width: 16px; height: 16px;"></i> Create User
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab">
            <i data-feather="lock" style="width: 16px; height: 16px;"></i> Change Password
          </button>
        </li>
      </ul>

      <div class="tab-content mt-4" id="userTabsContent">
        <!-- Tab 1: User List -->
        <div class="tab-pane fade show active" id="list" role="tabpanel">
          <!-- Search & Filter -->
          <form method="GET" action="{{ route('user-informasi') }}" class="mb-4">
            <div class="row g-3">
              <div class="col-md-8">
                <div class="input-group">
                  <span class="input-group-text"><i data-feather="search"></i></span>
                  <input type="text" class="form-control" name="search" 
                         placeholder="Search by name or email..." 
                         value="{{ request('search') }}">
                </div>
              </div>
              <div class="col-md-3">
                <select class="form-select" name="role">
                  <option value="">All Roles</option>
                  <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                  <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                </select>
              </div>
              <div class="col-md-1">
                <button type="submit" class="btn btn-primary w-100">
                  <i data-feather="filter"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Users Table -->
          <div class="table-responsive">
            <table class="table table-hover align-middle">
              <thead class="table-light">
                <tr>
                  <th style="width: 5%;">#</th>
                  <th style="width: 20%;">Name</th>
                  <th style="width: 20%;">Email</th>
                  <th style="width: 15%;">Role</th>
                  <th style="width: 15%;">Department</th>
                  <th style="width: 15%;">Created At</th>
                  <th style="width: 10%;" class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($users as $user)
                <tr>
                  <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" 
                           style="width: 40px; height: 40px;">
                        <i data-feather="user" class="text-primary" style="width: 20px; height: 20px;"></i>
                      </div>
                      <div>
                        <strong>{{ $user->name }}</strong>
                        @if($user->id == auth()->id())
                          <span class="badge bg-info ms-1">You</span>
                        @endif
                      </div>
                    </div>
                  </td>
                  <td>{{ $user->email }}</td>
                  <td>
                    @if($user->role == 'admin')
                      <span class="badge bg-danger">Administrator</span>
                    @else
                      <span class="badge bg-warning text-dark">User</span>
                    @endif
                  </td>
                  <td>
                    <span class="text-muted">{{ $user->department->name ?? '-' }}</span>
                  </td>
                  <td>
                    <small class="text-muted">{{ $user->created_at->format('d M Y') }}</small>
                  </td>
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-sm btn-outline-primary" 
                              onclick="editUser({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ $user->email }}', '{{ $user->role }}', '{{ addslashes($user->department->name ?? '') }}')"
                              title="Edit">
                        <i data-feather="edit" style="width: 14px; height: 14px;"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-outline-warning" 
                              onclick="changePasswordModal({{ $user->id }}, '{{ $user->name }}')"
                              title="Change Password">
                        <i data-feather="lock" style="width: 14px; height: 14px;"></i>
                      </button>
                      @if($user->id != auth()->id())
                      <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                          <i data-feather="trash-2" style="width: 14px; height: 14px;"></i>
                        </button>
                      </form>
                      @endif
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="7" class="text-center text-muted py-4">
                    <i data-feather="inbox" style="width: 48px; height: 48px; opacity: 0.5;"></i>
                    <p class="mt-2 mb-0">Tidak ada data user.</p>
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          @if($users->hasPages())
          <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted small">
              Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} users
            </div>
            <div>
              {{ $users->links() }}
            </div>
          </div>
          @endif
        </div>

        <!-- Tab 2: Create User -->
        <div class="tab-pane fade" id="create" role="tabpanel">
          <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       name="name" value="{{ old('name') }}" required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" required>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" 
                         name="password" id="createPassword" required>
                  <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('createPassword', 'toggleCreatePassword')">
                    <i data-feather="eye" id="toggleCreatePassword" style="width: 18px; height: 18px;"></i>
                  </button>
                </div>
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Minimal 8 karakter</small>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Confirm Password <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input type="password" class="form-control" name="password_confirmation" id="createPasswordConfirm" required>
                  <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('createPasswordConfirm', 'toggleCreatePasswordConfirm')">
                    <i data-feather="eye" id="toggleCreatePasswordConfirm" style="width: 18px; height: 18px;"></i>
                  </button>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Role <span class="text-danger">*</span></label>
                <select class="form-select @error('role') is-invalid @enderror" name="role" required>
                  <option value="">Select Role</option>
                  <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                  <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                </select>
                @error('role')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Department</label>
                <input type="text" class="form-control @error('department') is-invalid @enderror" 
                       name="department" value="{{ old('department') }}" 
                       placeholder="Masukkan nama department (contoh: Produksi, IT, HRD)">
                @error('department')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Tulis nama department secara manual</small>
              </div>
            </div>
            <div class="d-flex justify-content-end gap-2">
              <button type="reset" class="btn btn-light">Reset</button>
              <button type="submit" class="btn btn-primary">
                <i data-feather="user-plus"></i> Create User
              </button>
            </div>
          </form>
        </div>

        <!-- Tab 3: Change Password -->
        <div class="tab-pane fade" id="password" role="tabpanel">
          <div class="alert alert-info">
            <i data-feather="info"></i> Pilih user dari tabel di tab "User List" untuk mengubah password, atau gunakan form di bawah untuk mengubah password user tertentu.
          </div>
          <form id="changePasswordForm" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-12 mb-3">
                <label class="form-label fw-bold">Select User <span class="text-danger">*</span></label>
                <select class="form-select" id="passwordUserId" name="user_id" required>
                  <option value="">Select User</option>
                  @foreach(\App\Models\User::all() as $u)
                    <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">New Password <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" 
                         name="password" id="newPassword" required>
                  <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('newPassword', 'toggleNewPassword')">
                    <i data-feather="eye" id="toggleNewPassword" style="width: 18px; height: 18px;"></i>
                  </button>
                </div>
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Minimal 8 karakter</small>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Confirm Password <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input type="password" class="form-control" name="password_confirmation" id="newPasswordConfirm" required>
                  <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('newPasswordConfirm', 'toggleNewPasswordConfirm')">
                    <i data-feather="eye" id="toggleNewPasswordConfirm" style="width: 18px; height: 18px;"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-end gap-2">
              <button type="reset" class="btn btn-light">Reset</button>
              <button type="submit" class="btn btn-warning">
                <i data-feather="lock"></i> Change Password
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="editUserForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" id="editName" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email" id="editEmail" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold">Role <span class="text-danger">*</span></label>
            <select class="form-select" name="role" id="editRole" required>
              <option value="admin">Administrator</option>
              <option value="user">User</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold">Department</label>
            <input type="text" class="form-control" name="department" id="editDepartment" 
                   placeholder="Masukkan nama department (contoh: Produksi, IT, HRD)">
            <small class="text-muted">Tulis nama department secara manual</small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update User</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="changePasswordModalForm" method="POST">
        @csrf
        <div class="modal-body">
          <div class="alert alert-info">
            <i data-feather="info"></i> Mengubah password untuk: <strong id="passwordUserName"></strong>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold">New Password <span class="text-danger">*</span></label>
            <div class="input-group">
              <input type="password" class="form-control" name="password" id="modalPassword" required>
              <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('modalPassword', 'toggleModalPassword')">
                <i data-feather="eye" id="toggleModalPassword" style="width: 18px; height: 18px;"></i>
              </button>
            </div>
            <small class="text-muted">Minimal 8 karakter</small>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold">Confirm Password <span class="text-danger">*</span></label>
            <div class="input-group">
              <input type="password" class="form-control" name="password_confirmation" id="modalPasswordConfirm" required>
              <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('modalPasswordConfirm', 'toggleModalPasswordConfirm')">
                <i data-feather="eye" id="toggleModalPasswordConfirm" style="width: 18px; height: 18px;"></i>
              </button>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-warning">Change Password</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  if (typeof feather !== 'undefined') {
    feather.replace();
  }
});

// Toggle password visibility
function togglePassword(inputId, iconId) {
  const input = document.getElementById(inputId);
  const icon = document.getElementById(iconId);
  
  if (input.type === 'password') {
    input.type = 'text';
    icon.setAttribute('data-feather', 'eye-off');
  } else {
    input.type = 'password';
    icon.setAttribute('data-feather', 'eye');
  }
  
  // Re-initialize feather icons
  if (typeof feather !== 'undefined') {
    feather.replace();
  }
}

function editUser(id, name, email, role, departmentName) {
  document.getElementById('editUserForm').action = '{{ route("users.update", ":id") }}'.replace(':id', id);
  document.getElementById('editName').value = name;
  document.getElementById('editEmail').value = email;
  document.getElementById('editRole').value = role;
  document.getElementById('editDepartment').value = departmentName || '';
  
  const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
  modal.show();
}

function changePasswordModal(id, name) {
  document.getElementById('changePasswordModalForm').action = '{{ route("users.change-password", ":id") }}'.replace(':id', id);
  document.getElementById('passwordUserName').textContent = name;
  
  const modal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
  modal.show();
}

// Handle change password form in tab
document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const userId = document.getElementById('passwordUserId').value;
  if (!userId) {
    alert('Please select a user');
    return;
  }
  
  const formData = new FormData(this);
  const action = '{{ route("users.change-password", ":id") }}'.replace(':id', userId);
  
  fetch(action, {
    method: 'POST',
    body: formData,
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}',
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    }
  })
  .then(response => {
    if (response.ok) {
      return response.json();
    }
    return response.json().then(err => Promise.reject(err));
  })
  .then(data => {
    if (data.success) {
      window.location.reload();
    } else {
      alert('Error: ' + (data.message || 'Failed to change password'));
    }
  })
  .catch(error => {
    console.error('Error:', error);
    if (error.message) {
      alert('Error: ' + error.message);
    } else {
      // If response is not JSON, reload page
      window.location.reload();
    }
  });
});
</script>

<style>
.card {
  border-radius: 0.5rem;
}

.nav-tabs .nav-link {
  border: none;
  border-bottom: 2px solid transparent;
  color: #6c757d;
  padding: 0.75rem 1.5rem;
}

.nav-tabs .nav-link:hover {
  border-bottom-color: #dee2e6;
  color: #0d6efd;
}

.nav-tabs .nav-link.active {
  border-bottom-color: #0d6efd;
  color: #0d6efd;
  font-weight: 600;
}

.table th {
  font-size: 0.875rem;
  font-weight: 600;
  white-space: nowrap;
}

.table td {
  font-size: 0.875rem;
  vertical-align: middle;
}

.badge {
  font-size: 0.75rem;
  padding: 0.35em 0.65em;
}
</style>
@endsection
