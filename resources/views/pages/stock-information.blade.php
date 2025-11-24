@extends('layouts.app')

@section('title', 'Stock Information')

@section('content')
<div class="container-fluid">

  {{-- 🔹 Header --}}
  <div class="d-flex align-items-center justify-content-between mb-4">
    <div>
      <h2 class="fw-bold text-primary mb-1">Stock Information</h2>
      <p class="text-muted mb-0">Data Inventory Consumable & Sparepart 2025</p>
    </div>
  </div>

  {{-- 🔹 Summary Cards --}}
  <div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-3">
      <div class="card border-left-primary shadow h-100 py-2 text-center">
        <div class="card-body">
          <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total Items</div>
          <div class="h5 fw-bold text-gray-800">{{ number_format($totalItems) }}</div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-3">
      <div class="card border-left-success shadow h-100 py-2 text-center">
        <div class="card-body">
          <div class="text-xs fw-bold text-success text-uppercase mb-1">
  Total GR ({{ \Carbon\Carbon::now()->translatedFormat('d F Y') }})
</div>

          <div class="h5 fw-bold text-gray-800">{{ number_format($totalGR) }}</div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-3">
      <div class="card border-left-warning shadow h-100 py-2 text-center">
        <div class="card-body">
          <div class="text-xs fw-bold text-warning text-uppercase mb-1">
  Total GI ({{ \Carbon\Carbon::now()->translatedFormat('d F Y') }})
</div>
          <div class="h5 fw-bold text-gray-800">{{ number_format($totalGI) }}</div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-3">
      <div class="card border-left-info shadow h-100 py-2 text-center">
        <div class="card-body">
          <div class="text-xs fw-bold text-info text-uppercase mb-1">
  Total Ending Balance ({{ \Carbon\Carbon::now()->translatedFormat('d F Y') }})
</div>
          <div class="h5 fw-bold text-gray-800">{{ number_format($totalEnding) }}</div>
        </div>
      </div>
    </div>
  </div>

  {{-- 🔹 Filter Section --}}
  <div class="card mb-4">
    <div class="card-body">
      <form method="GET" action="{{ route('informasi-stock') }}">

        <div class="row align-items-end">
          <div class="col-md-3 mb-3">
            <label class="form-label fw-bold">Search Item</label>
            <input type="text" name="keyword" class="form-control"
                   placeholder="Search by Item Code or Description" value="{{ request('keyword') }}">
          </div>

          <div class="col-md-2 mb-3">
            <label class="form-label fw-bold">UOM</label>
            <select name="uom" class="form-select">
              <option value="all">All UOM</option>
              @foreach ($uoms as $u)
                <option value="{{ $u }}" {{ request('uom') == $u ? 'selected' : '' }}>{{ $u }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2 mb-3">
            <label class="form-label fw-bold">Location</label>
            <select name="loc" class="form-select">
              <option value="all">All Locations</option>
              @foreach ($locs as $l)
                <option value="{{ $l }}" {{ request('loc') == $l ? 'selected' : '' }}>{{ $l }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-3 mb-3">
            <label class="form-label fw-bold">Department</label>
            <select name="department" class="form-select">
              <option value="all">All Departments</option>
              @foreach ($departments as $d)
                <option value="{{ $d->id }}" {{ request('department') == $d->id ? 'selected' : '' }}>
                  {{ $d->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2 mb-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-50">
              <i class="bi bi-search"></i> Filter
            </button>
            <a href="{{ route('informasi-stock') }}" class="btn btn-outline-secondary w-50">
              <i class="bi bi-x-circle"></i> Clear
            </a>
          </div>
        </div>
      </form>
    </div>
  </div>

  {{-- 🔹 Inventory Table --}}
  <div class="card shadow">
    <div class="card-header bg-primary text-white fw-bold">
      <i class="bi bi-archive"></i> Data Inventory Consumable & Sparepart 2025
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover mb-0">
          <thead class="table-light">
    <tr>
        <th>No</th>
        <th>Item Code</th>
        <th>Description</th>
        <th>QTY</th>
        <th>UOM</th>
        <th>Location</th>
        <th>Department</th>
        <th>Min Stock</th>
        <th>Status</th>
    </tr>
</thead>

<tbody>
    @forelse ($products as $index => $p)
    <tr>
        <td>{{ $products->firstItem() + $index }}</td>

        <td><code class="text-primary">{{ $p->item_code }}</code></td>

        <td>{{ $p->name ?? '-' }}</td>

        <td class="fw-bold">{{ number_format($p->qty) }}</td>

        <td><span class="badge bg-light text-dark">{{ $p->uom }}</span></td>

        <td><span class="badge bg-info text-dark">{{ $p->loc }}</span></td>

        <td>
            <span class="badge bg-warning text-dark">
                {{ $p->department->name ?? '—' }}
            </span>
        </td>

        <td class="fw-bold text-primary">{{ $p->min_stock ?? 0 }}</td>

        <td>
            @if($p->qty <= $p->min_stock)
                <span class="badge bg-danger">LOW</span>
            @else
                <span class="badge bg-success">OK</span>
            @endif
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="9" class="text-center text-muted py-3">
            <em>No data found</em>
        </td>
    </tr>
    @endforelse
</tbody>

        </table>
      </div>

      {{-- Pagination --}}
      <div class="p-3">
        {{ $products->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
