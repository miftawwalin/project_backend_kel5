@extends('layouts.app')

@section('title', 'Edit Movement')

@section('content')
<div class="container-fluid">
  <div class="row mb-3">
    <div class="col-12">
      <h4 class="fw-bold mb-1">Edit Movement</h4>
      <p class="text-muted mb-0">Update status dan catatan movement</p>
    </div>
  </div>

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card shadow-sm border-0">
    <div class="card-body">
      <form action="{{ route('movements.update', $movement->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label fw-bold">Tanggal Request</label>
            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($movement->request_date)->format('d M Y') }}" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">User / NPK</label>
            <input type="text" class="form-control" value="{{ $movement->npk_nama ?? ($movement->user->name ?? '-') }}" readonly>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Items</label>
          <div class="table-responsive">
            <table class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th>Item Code</th>
                  <th>Nama Barang</th>
                  <th>Qty</th>
                  <th>Note</th>
                </tr>
              </thead>
              <tbody>
                @foreach($movement->items as $item)
                <tr>
                  <td>{{ $item->product->item_code ?? '-' }}</td>
                  <td>{{ $item->product->name ?? '-' }}</td>
                  <td>{{ $item->qty }}</td>
                  <td>{{ $item->note ?? '-' }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Status *</label>
          <select name="status" class="form-select" required>
            <option value="approved" {{ $movement->status === 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="rejected" {{ $movement->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Note</label>
          <textarea name="note" class="form-control" rows="3">{{ $movement->note }}</textarea>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary">
            <i data-feather="save"></i> Update Movement
          </button>
          <a href="{{ route('inventory-movements') }}" class="btn btn-secondary">
            <i data-feather="x"></i> Cancel
          </a>
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
</script>
@endsection

