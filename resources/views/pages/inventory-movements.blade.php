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
  </div>

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
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
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
                <td colspan="6" class="text-center py-5">
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
});
</script>
@endsection
