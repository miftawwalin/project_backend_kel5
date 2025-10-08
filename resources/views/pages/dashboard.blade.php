@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
  <!-- Welcome Header -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <h1 class="fw-bold text-primary mb-1">
            <i data-feather="grid" class="me-2"></i>Dashboard Overview
          </h1>
          <p class="text-muted mb-0">Selamat datang di Request Item Management System</p>
        </div>
        <div class="d-flex gap-2">
          <div class="text-end">
            <small class="text-muted d-block">Last Updated</small>
            <span class="fw-bold">{{ date('d M Y, H:i') }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Statistics Cards -->
  <div class="row g-4 mb-4">
    <!-- Total Products Card -->
    <div class="col-xl-3 col-md-6">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                <i data-feather="package" class="text-primary" style="width: 24px; height: 24px;"></i>
              </div>
            </div>
            <div class="flex-grow-1 ms-3">
              <h6 class="text-muted mb-1">Total Produk</h6>
              <h3 class="fw-bold text-primary mb-0">12,000</h3>
              <small class="text-success">
                <i data-feather="trending-up" style="width: 12px; height: 12px;"></i>
                +5.2% dari bulan lalu
              </small>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Monthly Outgoing Items Card -->
    <div class="col-xl-3 col-md-6">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <div class="bg-success bg-opacity-10 rounded-3 p-3">
                <i data-feather="arrow-up-right" class="text-success" style="width: 24px; height: 24px;"></i>
              </div>
            </div>
            <div class="flex-grow-1 ms-3">
              <h6 class="text-muted mb-1">Barang Keluar Bulan Ini</h6>
              <h3 class="fw-bold text-success mb-0">500,000</h3>
              <small class="text-success">
                <i data-feather="trending-up" style="width: 12px; height: 12px;"></i>
                +12.8% dari bulan lalu
              </small>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Registered Users Card -->
    <div class="col-xl-3 col-md-6">
      <div class="card border-0 shadow-sm h-100">
              <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                <i data-feather="users" class="text-warning" style="width: 24px; height: 24px;"></i>
              </div>
            </div>
            <div class="flex-grow-1 ms-3">
              <h6 class="text-muted mb-1">Pengguna Terdaftar</h6>
              <h3 class="fw-bold text-warning mb-0">58</h3>
              <small class="text-success">
                <i data-feather="trending-up" style="width: 12px; height: 12px;"></i>
                +3 pengguna baru
              </small>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card -->
    <div class="col-xl-3 col-md-6">
      <div class="card border-0 shadow-sm h-100">
              <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <div class="bg-info bg-opacity-10 rounded-3 p-3">
                <i data-feather="clock" class="text-info" style="width: 24px; height: 24px;"></i>
              </div>
            </div>
            <div class="flex-grow-1 ms-3">
              <h6 class="text-muted mb-1">Request Pending</h6>
              <h3 class="fw-bold text-info mb-0">24</h3>
              <small class="text-muted">
                <i data-feather="alert-circle" style="width: 12px; height: 12px;"></i>
                Memerlukan persetujuan
              </small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Quick Actions & Recent Activity -->
  <div class="row g-4 mb-4">
    <!-- Quick Actions -->
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-header bg-transparent border-0 pb-0">
          <h5 class="card-title mb-0">
            <i data-feather="zap" class="me-2"></i>Quick Actions
          </h5>
        </div>
        <div class="card-body">
          <div class="row g-3">
            <div class="col-6">
              <a href="{{ route('requests.create') }}" class="btn btn-outline-primary w-100 py-3 text-start">
                <i data-feather="plus-circle" class="me-2"></i>
                <div>
                  <div class="fw-bold">Buat Request</div>
                  <small class="text-muted">Request barang baru</small>
                </div>
              </a>
            </div>
            <div class="col-6">
              <a href="{{ route('informasi-stock') }}" class="btn btn-outline-success w-100 py-3 text-start">
                <i data-feather="bar-chart-2" class="me-2"></i>
                <div>
                  <div class="fw-bold">Cek Stock</div>
                  <small class="text-muted">Informasi stok barang</small>
                </div>
              </a>
            </div>
            <div class="col-6">
              <a href="{{ route('add-product') }}" class="btn btn-outline-warning w-100 py-3 text-start">
                <i data-feather="package" class="me-2"></i>
                <div>
                  <div class="fw-bold">Tambah Produk</div>
                  <small class="text-muted">Produk baru</small>
                </div>
              </a>
            </div>
            <div class="col-6">
              <a href="{{ route('user-informasi') }}" class="btn btn-outline-info w-100 py-3 text-start">
                <i data-feather="users" class="me-2"></i>
                <div>
                  <div class="fw-bold">Kelola User</div>
                  <small class="text-muted">Manajemen pengguna</small>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Activity -->
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-header bg-transparent border-0 pb-0">
          <h5 class="card-title mb-0">
            <i data-feather="activity" class="me-2"></i>Aktivitas Terbaru
          </h5>
        </div>
              <div class="card-body">
          <div class="timeline">
            <div class="timeline-item d-flex align-items-start mb-3">
              <div class="timeline-marker bg-success rounded-circle me-3 mt-1" style="width: 8px; height: 8px;"></div>
              <div class="flex-grow-1">
                <div class="fw-bold">Request #REQ-001 disetujui</div>
                <small class="text-muted">oleh Manager - 2 jam yang lalu</small>
              </div>
            </div>
            <div class="timeline-item d-flex align-items-start mb-3">
              <div class="timeline-marker bg-primary rounded-circle me-3 mt-1" style="width: 8px; height: 8px;"></div>
              <div class="flex-grow-1">
                <div class="fw-bold">Produk baru ditambahkan</div>
                <small class="text-muted">Safety Helmet - 4 jam yang lalu</small>
              </div>
            </div>
            <div class="timeline-item d-flex align-items-start mb-3">
              <div class="timeline-marker bg-warning rounded-circle me-3 mt-1" style="width: 8px; height: 8px;"></div>
              <div class="flex-grow-1">
                <div class="fw-bold">Stok rendah terdeteksi</div>
                <small class="text-muted">Welding Rod 3.2mm - 6 jam yang lalu</small>
              </div>
            </div>
            <div class="timeline-item d-flex align-items-start">
              <div class="timeline-marker bg-info rounded-circle me-3 mt-1" style="width: 8px; height: 8px;"></div>
              <div class="flex-grow-1">
                <div class="fw-bold">User baru terdaftar</div>
                <small class="text-muted">John Doe - 1 hari yang lalu</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- System Status -->
  <div class="row g-4">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent border-0">
          <h5 class="card-title mb-0">
            <i data-feather="monitor" class="me-2"></i>Status Sistem
          </h5>
        </div>
        <div class="card-body">
          <div class="row g-4">
            <div class="col-md-3">
              <div class="text-center">
                <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 48px; height: 48px;">
                  <i data-feather="server" class="text-success"></i>
                </div>
                <h6 class="fw-bold">Database</h6>
                <span class="badge bg-success">Online</span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="text-center">
                <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 48px; height: 48px;">
                  <i data-feather="wifi" class="text-success"></i>
                </div>
                <h6 class="fw-bold">Koneksi</h6>
                <span class="badge bg-success">Stabil</span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="text-center">
                <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 48px; height: 48px;">
                  <i data-feather="hard-drive" class="text-warning"></i>
                </div>
                <h6 class="fw-bold">Storage</h6>
                <span class="badge bg-warning">75% Used</span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="text-center">
                <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 48px; height: 48px;">
                  <i data-feather="shield" class="text-info"></i>
                </div>
                <h6 class="fw-bold">Security</h6>
                <span class="badge bg-info">Protected</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.timeline-marker {
  flex-shrink: 0;
}

.card {
  transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.btn:hover {
  transform: translateY(-1px);
  transition: all 0.2s ease-in-out;
}

.bg-opacity-10 {
  background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
}
</style>

@endsection
