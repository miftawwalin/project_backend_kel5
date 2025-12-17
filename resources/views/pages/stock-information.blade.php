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

          <div class="col-md-3 mb-3">
            <label class="form-label fw-bold small text-muted">Category</label>
            <select name="category" class="form-select select2">
              <option value="all">All Categories</option>
              @foreach (\App\Models\Product::select('category')->distinct()->pluck('category') as $cat)
                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2 mb-3">
            <label class="form-label fw-bold small text-muted">Location</label>
            <select name="loc" class="form-select select2">
              <option value="all">All Locations</option>
              @foreach ($locs as $l)
                <option value="{{ $l }}" {{ request('loc') == $l ? 'selected' : '' }}>{{ $l }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2 mb-3">
            <label class="form-label fw-bold small text-muted">Department</label>
            <select name="department" class="form-select select2">
              <option value="all">All Departments</option>
              @foreach ($departments as $d)
                <option value="{{ $d->id }}" {{ request('department') == $d->id ? 'selected' : '' }}>
                  {{ $d->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2 mb-3 d-flex gap-2 align-items-end">
            <button type="submit" class="btn btn-primary w-100 shadow-sm">
              <i class="bi bi-search"></i> Filter
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  {{-- 🔹 Inventory Table --}}
  <div class="card shadow border-0">
    <div class="card-header bg-white py-3">
      <h6 class="m-0 fw-bold text-primary"><i class="bi bi-table me-1"></i> Data Inventory Consumable & Sparepart 2025</h6>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
                <th class="py-3 ps-3">ITEM CODE</th>
                <th class="py-3">NAME</th>
                <th class="py-3 text-center">UOM</th>
                <th class="py-3">LOC</th>
                <th class="py-3 text-center">QTY</th>
                <th class="py-3 text-center">Stock Max</th>
                <th class="py-3 text-center">Titik Order</th>
                <th class="py-3 text-center">Min Stock</th>
                <th class="py-3">USER</th>
                <th class="py-3 text-center">STATUS</th>
                <th class="py-3">CATEGORY</th>
            </tr>
          </thead>

          <tbody>
            @forelse ($products as $index => $p)
            <tr>
                <td class="ps-3"><code class="text-primary bg-light px-2 py-1 rounded">{{ $p->item_code }}</code></td>

                <td class="fw-bold text-dark">{{ $p->name ?? '-' }}</td>
                
                <td class="text-center"><span class="small text-muted">{{ $p->uom }}</span></td>

                <td><span class="small"><i class="bi bi-geo-alt me-1 text-muted"></i>{{ $p->loc }}</span></td>

                <td class="text-center fw-bold">{{ number_format($p->qty) }}</td>

                <td class="text-center small text-muted">{{ $p->stock_max ?? '-' }}</td>

                <td class="text-center small text-muted">{{ $p->titik_order ?? '-' }}</td>

                <td class="text-center small text-muted">{{ $p->min_stock ?? 0 }}</td>

                <td>
                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-10">
                        {{ $p->department?->name ?? '-' }}
                    </span>
                </td>

                <td class="text-center">
                    @if($p->qty <= 0)
                        <span class="badge bg-danger">OUT</span>
                    @elseif($p->qty <= ($p->min_stock ?? 0))
                        <span class="badge bg-warning text-dark">LOW</span>
                    @else
                        <span class="badge bg-success">OK</span>
                    @endif
                </td>

                <td><span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-10">{{ $p->category ?? '-' }}</span></td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="text-center text-muted py-3">
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
