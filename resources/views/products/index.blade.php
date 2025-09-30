@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Stock Information & Item Status</h3>

    {{-- Statistik Ringkas --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">TOTAL ITEMS</h6>
                    <h3>{{ $products->total() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">LOW STOCK ITEMS</h6>
                    <h3>{{ \App\Models\Product::where('qty','>',0)->whereColumn('qty','<','min_stock')->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">OUT OF STOCK</h6>
                    <h3>{{ \App\Models\Product::where('qty','<=',0)->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Search & Filters --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('products.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Search Item</label>
                    <input type="text" name="search" class="form-control"
                           placeholder="Search by Item Code or Name"
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">UOM</label>
                    <select name="uom" class="form-select">
                        <option value="all">All UOM</option>
                        @foreach($uoms as $uom)
                            <option value="{{ $uom }}" {{ request('uom')==$uom ? 'selected' : '' }}>{{ $uom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Location</label>
                    <select name="loc" class="form-select">
                        <option value="all">All Locations</option>
                        @foreach($locs as $loc)
                            <option value="{{ $loc }}" {{ request('loc')==$loc ? 'selected' : '' }}>{{ $loc }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">User/Dept</label>
                    <select name="user" class="form-select">
                        <option value="all">All Users</option>
                        @foreach($users as $user)
                            <option value="{{ $user }}" {{ request('user')==$user ? 'selected' : '' }}>{{ $user }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Clear</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Import Excel --}}
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body">
            <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data" class="row g-2">
                @csrf
                <div class="col-md-6">
                    <input type="file" name="file" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-success">Import Excel</button>
                </div>
                <div class="col-md-3 text-end">
                    <a href="{{ route('products.create') }}" class="btn btn-primary">+ Tambah Produk</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Produk --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            {{-- ✅ Tambahkan table-responsive agar muncul rollbar --}}
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Item Code</th>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Current Stock</th>
                            <th>Min Stock</th>
                            <th>Status</th>
                            <th>Location</th>
                            <th>UOM</th>
                            <th>Last Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>{{ $loop->iteration + ($products->currentPage()-1) * $products->perPage() }}</td>
                            <td>{{ $product->item_code }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->qty }}</td>
                            <td>{{ $product->min_stock }}</td>
                            <td>
                                @if($product->qty <= 0)
                                    <span class="badge bg-danger">Out of Stock</span>
                                @elseif($product->qty < $product->min_stock)
                                    <span class="badge bg-warning text-dark">Low Stock</span>
                                @else
                                    <span class="badge bg-success">In Stock</span>
                                @endif
                            </td>
                            <td>{{ $product->loc }}</td>
                            <td>{{ $product->uom }}</td>
                            <td>{{ $product->updated_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin mau hapus?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center text-muted">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
{{-- Pagination --}}
<div class="card-footer d-flex justify-content-between align-items-center flex-wrap gap-2">
    <div class="text-muted small">
        Showing {{ $products->firstItem() ?? 0 }} 
        to {{ $products->lastItem() ?? 0 }} 
        of {{ $products->total() }} items
    </div>
    <div>
        {{ $products->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection
