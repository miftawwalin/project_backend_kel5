@extends('layouts.app')

@section('title', 'History Pergerakan Barang')

@section('content')
<div class="container-fluid">
  <!-- Page Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="fw-bold text-primary mb-1">Stock Movements</h4>
      <p class="text-muted mb-0">History Approval & Rejection (Pergerakan Stok)</p>
    </div>
    @if(auth()->user()->role === 'admin')
    <div class="d-flex gap-2">
      <!-- Hidden Form for Bulk Delete -->
      <form id="bulkDeleteForm" action="{{ route('movements.bulkDestroy') }}" method="POST" class="d-none">
        @csrf
        @method('DELETE')
        <div id="bulkDeleteInputContainer"></div>
      </form>

      <button class="btn btn-danger btn-sm d-none" id="btnDeleteSelected" onclick="confirmBulkDelete()">
        <i data-feather="trash-2"></i> Delete Selected (<span id="selectedCount">0</span>)
      </button>
      
      <button class="btn btn-outline-danger btn-sm" onclick="confirmDeleteAll()">
        <i data-feather="trash"></i> Delete All
      </button>
    </div>
    @endif
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <!-- Filter Card -->
  <div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
      <form action="{{ route('inventory-movements') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-md-3">
          <label class="form-label fw-bold small text-muted">Start Date (Requested)</label>
          <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}">
        </div>
        <div class="col-md-3">
          <label class="form-label fw-bold small text-muted">End Date (Requested)</label>
          <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}">
        </div>
        <div class="col-md-4">
          <label class="form-label fw-bold small text-muted">Search (NPK / Nama)</label>
          <input type="text" class="form-control" name="search" placeholder="Cari NPK atau Nama..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary flex-grow-1">
                <i data-feather="filter"></i> Filter
            </button>
            <a href="{{ route('inventory-movements') }}" class="btn btn-light border" title="Reset">
                <i data-feather="refresh-cw"></i>
            </a>
        </div>
      </form>
    </div>
  </div>

  <!-- Table Card -->
  <div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
      <h6 class="mb-0 fw-bold text-dark">
        <i data-feather="list" class="text-muted me-1"></i> Daftar Riwayat Transaksi
      </h6>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light" style="position: sticky; top: 0; z-index: 10;">
            <tr>
              @if(auth()->user()->role === 'admin')
              <th scope="col" class="text-center" style="width: 40px;">
                <input type="checkbox" id="check-all" class="form-check-input">
              </th>
              @endif
              <th scope="col" class="text-center" style="width: 50px;">No</th>
              <th scope="col" style="width: 150px;">Tanggal Request</th>
              <th scope="col" style="width: 250px;">User / NPK</th>
              <th scope="col">Items (Barang & Qty)</th>
              <th scope="col" class="text-center" style="width: 120px;">Status</th>
              <th scope="col" style="width: 180px;">Tanggal Proses</th>
            </tr>
          </thead>
          <tbody>
            @forelse($movements as $m)
            <tr>
              @if(auth()->user()->role === 'admin')
              <td class="text-center p-2" style="vertical-align: middle;">
                <input type="checkbox" class="form-check-input check-item" value="{{ $m->id }}">
              </td>
              @endif
              <td class="text-center text-muted">{{ $loop->iteration + ($movements->currentPage() - 1) * $movements->perPage() }}</td>
              <td>
                <div class="fw-bold">{{ \Carbon\Carbon::parse($m->request_date)->format('d M Y') }}</div>
                <small class="text-muted">{{ \Carbon\Carbon::parse($m->created_at)->format('H:i') }}</small>
              </td>
              <td>
                <div class="fw-bold text-dark">{{ $m->npk_nama ?? ($m->user->name ?? '-') }}</div>
                <small class="text-muted">{{ $m->department->name ?? ($m->user->department->name ?? '-') }}</small>
              </td>
              <td>
                @if($m->items->count() > 0)
                  <ul class="list-unstyled mb-0 small">
                    @foreach($m->items as $item)
                    <li class="d-flex justify-content-between border-bottom py-1" style="max-width: 400px;">
                        <span>
                            <span class="fw-semibold text-primary">{{ $item->product->item_code ?? '?' }}</span> - 
                            {{ $item->product->name ?? 'Unknown' }}
                        </span>
                        <span class="badge bg-light text-dark border ms-2">x{{ $item->qty }}</span>
                    </li>
                    @endforeach
                  </ul>
                @else
                  <span class="text-muted small">No items</span>
                @endif
              </td>
              <td class="text-center">
                @if($m->status === 'approved')
                    <span class="badge bg-success-subtle text-success border border-success px-2 py-1">
                        <i data-feather="check-circle" style="width:12px"></i> Approved
                    </span>
                @elseif($m->status === 'rejected')
                    <span class="badge bg-danger-subtle text-danger border border-danger px-2 py-1">
                        <i data-feather="x-circle" style="width:12px"></i> Rejected
                    </span>
                @else
                    <span class="badge bg-warning text-dark">{{ $m->status }}</span>
                @endif
              </td>
              <td>
                @if($m->approved_at)
                   {{ \Carbon\Carbon::parse($m->approved_at)->format('d M Y H:i') }}
                @else
                   {{ $m->updated_at->format('d M Y H:i') }}
                @endif
              </td>
            </tr>
            @empty
            <tr>
                <td colspan="{{ auth()->user()->role === 'admin' ? '7' : '6' }}" class="text-center py-5">
                    <div class="text-muted">
                        <i data-feather="inbox" style="width: 48px; height: 48px; opacity: 0.5"></i>
                        <p class="mt-2 text-muted fw-semibold">Tidak ada riwayat pergerakan barang.</p>
                    </div>
                </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    
    <!-- Check if movements has pages before showing footer -->
    @if($movements->hasPages())
    <div class="card-footer bg-white">
        {{ $movements->withQueryString()->links() }}
    </div>
    @endif
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  if (typeof feather !== 'undefined') {
    feather.replace();
  }

  // Bulk selection logic
  const checkAll = document.getElementById('check-all');
  const checkItems = document.querySelectorAll('.check-item');
  const btnDeleteSelected = document.getElementById('btnDeleteSelected');
  const bulkDeleteForm = document.getElementById('bulkDeleteForm');

  function toggleDeleteButton() {
    const selectedCount = document.querySelectorAll('.check-item:checked').length;
    if (document.getElementById('selectedCount')) {
      document.getElementById('selectedCount').textContent = selectedCount;
    }
    
    if (btnDeleteSelected) {
      if (selectedCount > 0) {
        btnDeleteSelected.classList.remove('d-none');
      } else {
        btnDeleteSelected.classList.add('d-none');
      }
    }
  }

  if (checkAll) {
    checkAll.addEventListener('change', function() {
      checkItems.forEach(checkbox => {
        checkbox.checked = this.checked;
      });
      toggleDeleteButton();
    });
  }

  checkItems.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      if (checkAll) {
        checkAll.checked = checkItems.length === document.querySelectorAll('.check-item:checked').length;
      }
      toggleDeleteButton();
    });
  });
});

function confirmBulkDelete() {
  const selected = document.querySelectorAll('.check-item:checked');
  if (selected.length === 0) {
    alert('Tidak ada item yang dipilih');
    return;
  }

  if (!confirm(`Apakah Anda yakin ingin menghapus ${selected.length} movement(s)?`)) {
    return;
  }

  const container = document.getElementById('bulkDeleteInputContainer');
  container.innerHTML = '';
  
  selected.forEach(checkbox => {
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'ids[]';
    input.value = checkbox.value;
    container.appendChild(input);
  });

  document.getElementById('bulkDeleteForm').submit();
}

function confirmDeleteAll() {
  if (!confirm('Apakah Anda yakin ingin menghapus SEMUA movement? Tindakan ini tidak dapat dibatalkan!')) {
    return;
  }

  const form = document.createElement('form');
  form.method = 'POST';
  form.action = '{{ route("movements.destroyAll") }}';
  
  const csrf = document.createElement('input');
  csrf.type = 'hidden';
  csrf.name = '_token';
  csrf.value = '{{ csrf_token() }}';
  form.appendChild(csrf);

  const method = document.createElement('input');
  method.type = 'hidden';
  method.name = '_method';
  method.value = 'DELETE';
  form.appendChild(method);

  // Add current filters
  @if(request('start_date'))
  const startDate = document.createElement('input');
  startDate.type = 'hidden';
  startDate.name = 'start_date';
  startDate.value = '{{ request("start_date") }}';
  form.appendChild(startDate);
  @endif

  @if(request('end_date'))
  const endDate = document.createElement('input');
  endDate.type = 'hidden';
  endDate.name = 'end_date';
  endDate.value = '{{ request("end_date") }}';
  form.appendChild(endDate);
  @endif

  @if(request('search'))
  const search = document.createElement('input');
  search.type = 'hidden';
  search.name = 'search';
  search.value = '{{ request("search") }}';
  form.appendChild(search);
  @endif

  document.body.appendChild(form);
  form.submit();
}
</script>

<style>
.card-body .table-responsive::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

.card-body .table-responsive::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}

.card-body .table-responsive::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 10px;
}

.card-body .table-responsive::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>
@endsection
