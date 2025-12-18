@extends('layouts.app')

@section('title', 'Stock Information')

@section('content')
<div class="container-fluid">
  <!-- Header Section -->
  <div class="row mb-3">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <h4 class="fw-bold text-primary mb-1">Stock Information</h4>
          <p class="text-muted mb-0">Data Inventory Consumable & Sparepart 2025</p>
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

  <!-- Search Filter Section -->
  <div class="row mb-3">
    <div class="col-md-12">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <form method="GET" action="{{ route('informasi-stock') }}" id="searchForm">
            <div class="row g-2 align-items-end">
              <div class="col-md-12">
                <label class="form-label fw-bold small text-muted">Search Name</label>
                <div class="position-relative">
                  <input type="text" class="form-control form-control-sm" id="searchInput"
                         placeholder="Cari item name muuuu" 
                         autocomplete="off">
                  <button type="button" class="btn btn-sm position-absolute end-0 top-0 h-100 d-flex align-items-center pe-2" 
                          onclick="clearSearch()" id="clearBtn" style="background: transparent; border: none; z-index: 10; display: none;" title="Clear">
                    <i data-feather="x" style="width: 16px; height: 16px; color: #6c757d;"></i>
                  </button>
                </div>
                <small class="text-muted">
                  <i data-feather="info" style="width: 14px; height: 14px;"></i> 
                  Perhatikan untuk name itemnya yaaaa
                </small>
              </div>
            </div>
          </form>
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
            </tr>
          </thead>
          <tbody id="tableBody">
            @forelse($products as $product)
            <tr class="data-row" data-name="{{ strtolower($product->name ?? '') }}">
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
            </tr>
            @empty
            <tr id="emptyRow">
              <td colspan="11" class="text-center text-muted py-5">
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

  // Filter seperti Excel - filter real-time tanpa submit
  const searchInput = document.getElementById('searchInput');
  const clearBtn = document.getElementById('clearBtn');
  const tableBody = document.getElementById('tableBody');
  const dataRows = document.querySelectorAll('.data-row');
  const emptyRow = document.getElementById('emptyRow');

  if (searchInput) {
    // Filter saat mengetik (real-time seperti Excel)
    searchInput.addEventListener('input', function() {
      const searchTerm = this.value.toLowerCase().trim();
      
      // Toggle clear button
      if (searchTerm.length > 0) {
        clearBtn.style.display = 'flex';
      } else {
        clearBtn.style.display = 'none';
      }

      // Filter rows
      let visibleCount = 0;
      dataRows.forEach(row => {
        const name = row.getAttribute('data-name') || '';
        if (name.includes(searchTerm)) {
          row.style.display = '';
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      });

      // Tampilkan/sembunyikan empty row
      if (visibleCount === 0 && searchTerm.length > 0) {
        if (emptyRow) {
          emptyRow.style.display = '';
          emptyRow.querySelector('td').colSpan = 11;
          emptyRow.querySelector('p').textContent = 'Tidak ada data yang cocok dengan pencarian.';
        }
      } else {
        if (emptyRow) {
          emptyRow.style.display = 'none';
        }
      }

      // Update pagination info jika ada
      updateFilterInfo(visibleCount, dataRows.length);
    });

    // Prevent form submit saat Enter
    searchInput.addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        e.preventDefault();
      }
    });
  }
});

// Function untuk clear search
function clearSearch() {
  const searchInput = document.getElementById('searchInput');
  const clearBtn = document.getElementById('clearBtn');
  const dataRows = document.querySelectorAll('.data-row');
  const emptyRow = document.getElementById('emptyRow');

  if (searchInput) {
    searchInput.value = '';
    clearBtn.style.display = 'none';

    // Tampilkan semua rows
    dataRows.forEach(row => {
      row.style.display = '';
    });

    // Sembunyikan empty row jika ada data
    if (emptyRow && dataRows.length > 0) {
      emptyRow.style.display = 'none';
    }

    // Update filter info
    updateFilterInfo(dataRows.length, dataRows.length);

    // Focus kembali ke input
    searchInput.focus();
  }
}

// Function untuk update info filter
function updateFilterInfo(visible, total) {
  const filterInfo = document.getElementById('filterInfo');
  if (filterInfo) {
    if (visible === total) {
      filterInfo.innerHTML = `Menampilkan semua <strong>${total}</strong> item`;
    } else {
      filterInfo.innerHTML = `Menampilkan <strong>${visible}</strong> dari <strong>${total}</strong> item`;
    }
  }
}
</script>
@endsection
