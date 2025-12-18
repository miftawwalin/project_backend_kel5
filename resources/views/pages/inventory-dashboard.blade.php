@extends('layouts.app')

@section('title', 'Inventory Dashboard')

@section('content')
<div class="container-fluid">
  <!-- Header Section -->
  <div class="row mb-3">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <h4 class="fw-bold text-primary mb-1">Inventory Dashboard</h4>
          <p class="text-muted mb-0">Data Inventory Consumable & Sparepart 2025</p>
        </div>
        <div class="d-flex gap-2">
          {{-- Hidden Form for Bulk Delete --}}
          <form id="bulkDeleteForm" action="{{ route('products.bulkDestroy') }}" method="POST" class="d-none">
            @csrf
            @method('DELETE')
            <div id="bulkDeleteInputContainer"></div>
          </form>

          <button class="btn btn-danger btn-sm d-none" id="btnDeleteSelected" onclick="confirmBulkDelete()">
            <i data-feather="trash-2"></i> Delete Selected (<span id="selectedCount">0</span>)
          </button>

          <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
            <i data-feather="plus"></i> Tambah Produk
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Success/Error Messages -->
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
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
      <div class="card shadow-sm border-0">
        <div class="card-body text-center">
          <h6 class="text-muted mb-2">Total Items</h6>
          <h3 class="fw-bold mb-0">{{ $totalItems }}</h3>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card shadow-sm border-0">
        <div class="card-body text-center">
          <h6 class="text-muted mb-2">Low Stock</h6>
          <h3 class="fw-bold text-warning mb-0">{{ $lowStock }}</h3>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card shadow-sm border-0">
        <div class="card-body text-center">
          <h6 class="text-muted mb-2">Out of Stock</h6>
          <h3 class="fw-bold text-danger mb-0">{{ $outStock }}</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Import Excel & Filters Section -->
  <div class="row mb-3">
    <div class="col-md-12">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <div class="row align-items-end">
            <!-- Filters -->
            <div class="col-md-12">
              <form method="GET" action="{{ route('inventory-dashboard') }}">
                <div class="row g-2 align-items-end">
                  <div class="col-md-9">
                    <label class="form-label fw-bold small text-muted">Search Name</label>
                    <input type="text" class="form-control form-control-sm" name="search" 
                           placeholder="Search by Name..." 
                           value="{{ request('search') }}">
                  </div>
                  <div class="col-md-3 d-flex gap-2">
                    <a href="{{ route('inventory-dashboard') }}" class="btn btn-light btn-sm border">
                      <i data-feather="x"></i> Clear
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm flex-grow-1">
                      <i data-feather="search"></i> Filter
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Inventory Table -->
  <div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white py-2">
      <h6 class="mb-0 fw-bold">
        <i data-feather="database"></i> Data Inventory Consumable & Sparepart 2025
      </h6>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
        <table class="table table-hover align-middle mb-0" id="inventoryTable">
          <thead class="table-light" style="position: sticky; top: 0; z-index: 10; background-color: #f8f9fa;">
            <tr>
              <th class="text-center" style="width: 40px;">
                  <div class="form-check d-flex justify-content-center mb-0">
                      <input class="form-check-input" type="checkbox" id="selectAll">
                  </div>
              </th>
              <th style="width: 150px;">ITEM CODE</th>
              <th style="min-width: 200px;">NAME</th>
              <th class="text-center" style="width: 80px;">UOM</th>
              <th style="width: 120px;">LOC</th>
              <th class="text-center" style="width: 80px;">QTY</th>
              <th class="text-center" style="width: 80px;">Stock Max</th>
              <th class="text-center" style="width: 80px;">Titik Order</th>
              <th class="text-center" style="width: 100px;">Min Stock</th>
              <th style="width: 120px;">USER</th>
              <th class="text-center" style="width: 100px;">STATUS</th>
              <th style="width: 180px;">CATEGORY</th>
              <th class="text-center" style="width: 150px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($products as $product)
            <tr>
              <td class="text-center">
                  <div class="form-check d-flex justify-content-center mb-0">
                    <input class="form-check-input item-checkbox" type="checkbox" value="{{ $product->id }}">
                  </div>
              </td>
              <td><code class="text-primary small">{{ $product->item_code }}</code></td>
              <td class="text-truncate" style="max-width: 200px;" title="{{ $product->name }}">{{ $product->name }}</td>
              <td class="text-center small">{{ $product->uom ?? '-' }}</td>
              <td class="small">{{ $product->loc ?? '-' }}</td>
              <td class="text-center">
                <span class="badge {{ $product->qty > 0 ? 'bg-success' : 'bg-danger' }}">
                  {{ number_format($product->qty) }}
                </span>
              </td>
              <td class="text-center small">{{ number_format($product->stock_max ?? 0) }}</td>
              <td class="text-center small">{{ number_format($product->titik_order ?? 0) }}</td>
              <td class="text-center small">{{ number_format($product->min_stock ?? 0) }}</td>
              <td class="small">{{ $product->department?->name ?? '-' }}</td>
              <td class="text-center">
                @if($product->qty <= 0)
                  <span class="badge bg-danger">Out</span>
                @elseif($product->qty < ($product->min_stock ?? 0))
                  <span class="badge bg-warning text-dark">Low</span>
                @else
                  <span class="badge bg-success">OK</span>
                @endif
              </td>
              <td class="small">{{ $product->category ?? '-' }}</td>
              <td class="text-center">
                <div class="d-inline-flex align-items-center gap-1">
                  <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm px-2 py-1" title="Edit">
                    <i data-feather="edit" style="width: 14px; height: 14px;"></i>
                  </a>
                  <form action="{{ route('products.destroy', $product->id) }}" method="POST" 
                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')" class="d-inline m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm px-2 py-1" title="Hapus">
                      <i data-feather="trash-2" style="width: 14px; height: 14px;"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="13" class="text-center text-muted py-5">
                <i data-feather="inbox" style="width: 48px; height: 48px; opacity: 0.5;"></i>
                <p class="mt-2 mb-0">Tidak ada data inventory.</p>
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
          <span id="filterInfo">Menampilkan semua <strong>{{ count($products) }}</strong> item</span>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.table th {
  font-size: 0.875rem;
  font-weight: 600;
  padding: 0.75rem 0.5rem;
  white-space: nowrap;
}

.table td {
  font-size: 0.875rem;
  padding: 0.75rem 0.5rem;
  vertical-align: middle;
}

.table-hover tbody tr:hover {
  background-color: #f8f9fa;
}

.card {
  border-radius: 0.5rem;
}

.btn-sm {
  font-size: 0.875rem;
  padding: 0.25rem 0.5rem;
}

.form-control-sm, .form-select-sm {
  font-size: 0.875rem;
}

.badge {
  font-size: 0.75rem;
  padding: 0.35em 0.65em;
}

code {
  font-size: 0.8rem;
  background-color: #f8f9fa;
  padding: 0.2rem 0.4rem;
  border-radius: 0.25rem;
}

.pagination {
  margin-bottom: 0;
}

.pagination .page-link {
  font-size: 0.875rem;
  padding: 0.375rem 0.75rem;
}

/* Table Scroll Styling */
.table-responsive {
  border: 1px solid #dee2e6;
  border-radius: 0.375rem;
}

.table-responsive::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
  background: #555;
}

/* Sticky header styling */
thead.table-light {
  box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.1);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Initialize feather icons
  if (typeof feather !== 'undefined') {
    feather.replace();
  }

  // Bulk Selection Logic
  const selectAll = document.getElementById('selectAll');
  const checkboxes = document.querySelectorAll('.item-checkbox');
  const btnDelete = document.getElementById('btnDeleteSelected');
  const selectedCountSpan = document.getElementById('selectedCount');

  function updateDeleteButton() {
    const checkedCount = document.querySelectorAll('.item-checkbox:checked').length;
    selectedCountSpan.textContent = checkedCount;
    if (checkedCount > 0) {
      btnDelete.classList.remove('d-none');
    } else {
      btnDelete.classList.add('d-none');
    }
  }

  selectAll.addEventListener('change', function() {
    checkboxes.forEach(cb => {
      cb.checked = selectAll.checked;
    });
    updateDeleteButton();
  });

  checkboxes.forEach(cb => {
    cb.addEventListener('change', function() {
      // If one is unchecked, uncheck "Select All"
      if (!this.checked) {
        selectAll.checked = false;
      }
      // If all are checked, check "Select All"
      if (document.querySelectorAll('.item-checkbox:checked').length === checkboxes.length) {
        selectAll.checked = true;
      }
      updateDeleteButton();
    });
  });
});

function confirmBulkDelete() {
  const selectedIds = Array.from(document.querySelectorAll('.item-checkbox:checked')).map(cb => cb.value);
  if (selectedIds.length === 0) return;

  if (confirm('Apakah Anda yakin ingin menghapus ' + selectedIds.length + ' item yang dipilih?')) {
    const form = document.getElementById('bulkDeleteForm');
    const container = document.getElementById('bulkDeleteInputContainer');
    container.innerHTML = ''; // Clear previous inputs

    selectedIds.forEach(id => {
      const input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'ids[]';
      input.value = id;
      container.appendChild(input);
    });

    form.submit();
  }
}

// Export to Excel
function exportToExcel() {
  const table = document.getElementById('inventoryTable');
  if (!table) return;
  
  const rows = table.querySelectorAll('tr');
  const csvContent = [];
  
  rows.forEach(row => {
    const cols = row.querySelectorAll('th, td');
    const rowData = [];
    cols.forEach((col, index) => {
      // Skip action column (kolom terakhir)
      if (index < cols.length - 1) {
        const text = col.textContent.trim().replace(/,/g, ';').replace(/"/g, '""');
        rowData.push(`"${text}"`);
      }
    });
    if (rowData.length > 0) {
      csvContent.push(rowData.join(','));
    }
  });

  const blob = new Blob([csvContent.join('\n')], { type: 'text/csv;charset=utf-8;' });
  const url = window.URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = `inventory_data_${new Date().toISOString().split('T')[0]}.csv`;
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
  window.URL.revokeObjectURL(url);
}
</script>
@endsection
