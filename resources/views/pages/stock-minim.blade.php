@extends('layouts.app')

@section('title', 'Stock Minim - Titik Order')

@section('content')
<div class="container-fluid">
  <!-- Header Section -->
  <div class="row mb-3">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <h4 class="fw-bold text-danger mb-1">
            <i data-feather="alert-triangle"></i> Stock Minim - Titik Order
          </h4>
          <p class="text-muted mb-0">Daftar item yang sudah mencapai atau melewati titik order</p>
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
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <!-- Summary Cards -->
  <div class="row mb-3">
    <div class="col-md-4 mb-3">
      <div class="card shadow-sm border-0 border-start border-danger border-4">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="flex-grow-1">
              <h6 class="text-muted mb-1">Total Kritikal</h6>
              <h3 class="fw-bold text-danger mb-0">{{ $totalKritikal }}</h3>
              <small class="text-muted">Qty ≤ Titik Order</small>
            </div>
            <div class="text-danger">
              <i data-feather="alert-circle" style="width: 48px; height: 48px;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card shadow-sm border-0 border-start border-warning border-4">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="flex-grow-1">
              <h6 class="text-muted mb-1">Peringatan</h6>
              <h3 class="fw-bold text-warning mb-0">{{ $totalPeringatan }}</h3>
              <small class="text-muted">Titik Order < Qty ≤ Min Stock</small>
            </div>
            <div class="text-warning">
              <i data-feather="alert-triangle" style="width: 48px; height: 48px;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card shadow-sm border-0 border-start border-dark border-4">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="flex-grow-1">
              <h6 class="text-muted mb-1">Out of Stock</h6>
              <h3 class="fw-bold text-dark mb-0">{{ $outOfStock }}</h3>
              <small class="text-muted">Qty = 0</small>
            </div>
            <div class="text-dark">
              <i data-feather="x-circle" style="width: 48px; height: 48px;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Filters Section -->
  <div class="row mb-3">
    <div class="col-md-12">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <form method="GET" action="{{ route('stock-minim') }}">
            <div class="row g-2 align-items-end">
              <div class="col-md-4">
                <label class="form-label fw-bold small text-muted">Search Name</label>
                <input type="text" class="form-control form-control-sm" name="search" 
                       placeholder="Cari berdasarkan nama item..." 
                       value="{{ request('search') }}"
                       id="searchInput">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Table Section -->
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
          <div class="d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0">Daftar Item Stock Minim</h6>
            <span class="badge bg-danger">{{ count($products) }} Item</span>
          </div>
        </div>
        <div class="card-body p-0">
          <div style="max-height: 600px; overflow-y: auto;">
            <table class="table table-hover mb-0">
              <thead class="table-light" style="position: sticky; top: 0; z-index: 10; background-color: #f8f9fa;">
                <tr>
                  <th style="width: 5%;" class="text-center">No</th>
                  <th style="width: 10%;">Item Code</th>
                  <th style="width: 20%;">Nama Barang</th>
                  <th style="width: 10%;">Category</th>
                  <th style="width: 8%;" class="text-center">Qty</th>
                  <th style="width: 8%;" class="text-center">Titik Order</th>
                  <th style="width: 8%;" class="text-center">Min Stock</th>
                  <th style="width: 8%;" class="text-center">UOM</th>
                  <th style="width: 10%;">LOC</th>
                  <th style="width: 10%;">Department</th>
                  <th style="width: 8%;" class="text-center">Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse($products as $index => $product)
                  @php
                    $percentage = $product->titik_order > 0 
                      ? ($product->qty / $product->titik_order) * 100 
                      : 0;
                    $status = '';
                    $statusClass = '';
                    
                    if ($product->qty <= 0) {
                      $status = 'OUT';
                      $statusClass = 'bg-dark';
                    } elseif ($product->qty <= $product->titik_order) {
                      $status = 'KRITIKAL';
                      $statusClass = 'bg-danger';
                    } elseif ($product->qty <= ($product->min_stock ?? 0)) {
                      $status = 'PERINGATAN';
                      $statusClass = 'bg-warning text-dark';
                    } else {
                      $status = 'OK';
                      $statusClass = 'bg-success';
                    }
                  @endphp
                  <tr class="{{ $product->qty <= $product->titik_order ? 'table-danger' : '' }}">
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td><strong>{{ $product->item_code }}</strong></td>
                    <td>{{ $product->name }}</td>
                    <td>
                      <span class="badge bg-secondary">{{ $product->category ?? '-' }}</span>
                    </td>
                    <td class="text-center">
                      <strong class="{{ $product->qty <= $product->titik_order ? 'text-danger' : 'text-dark' }}">
                        {{ number_format($product->qty, 0, ',', '.') }}
                      </strong>
                    </td>
                    <td class="text-center">
                      <strong>{{ number_format($product->titik_order ?? 0, 0, ',', '.') }}</strong>
                    </td>
                    <td class="text-center">
                      {{ number_format($product->min_stock ?? 0, 0, ',', '.') }}
                    </td>
                    <td class="text-center">{{ $product->uom ?? '-' }}</td>
                    <td>{{ $product->loc ?? '-' }}</td>
                    <td>{{ $product->department->name ?? '-' }}</td>
                    <td class="text-center">
                      <span class="badge {{ $statusClass }}">{{ $status }}</span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="11" class="text-center py-5">
                      <i data-feather="inbox" style="width: 48px; height: 48px;" class="text-muted mb-2"></i>
                      <p class="text-muted mb-0">Tidak ada item yang mencapai titik order</p>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer bg-white py-2">
          <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted small">
              <span>Menampilkan <strong>{{ count($products) }}</strong> item stock minim</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
/* Custom Scrollbar */
.table-responsive::-webkit-scrollbar,
div[style*="overflow-y"]::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

.table-responsive::-webkit-scrollbar-track,
div[style*="overflow-y"]::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb,
div[style*="overflow-y"]::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb:hover,
div[style*="overflow-y"]::-webkit-scrollbar-thumb:hover {
  background: #555;
}

.table-hover tbody tr:hover {
  background-color: rgba(0, 123, 255, 0.05);
}
</style>
@endsection

@push('scripts')
<script>
// Initialize feather icons
document.addEventListener('DOMContentLoaded', function() {
  if (typeof feather !== 'undefined') {
    feather.replace();
  }
});

// Real-time search (client-side filtering)
const searchInput = document.getElementById('searchInput');
if (searchInput) {
  searchInput.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
  });
}

</script>
@endpush

