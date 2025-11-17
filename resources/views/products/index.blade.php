@extends('layouts.app')

@section('title', 'Stock Information')

@section('content')
<div class="container-fluid">

    {{-- 🔔 Alert sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Judul Halaman --}}
    <h4 class="fw-bold text-primary mb-3 mt-3">Stock Information</h4>

    {{-- Statistik --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Items</h6>
                    <h3 class="fw-bold">{{ $totalItems }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Low Stock</h6>
                    <h3 class="fw-bold text-warning">{{ $lowStock }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Out of Stock</h6>
                    <h3 class="fw-bold text-danger">{{ $outStock }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Tombol Tambah Produk dan Import Excel --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
            <div class="d-flex gap-2">
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Produk
                </a>

                <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2 align-items-center">
                    @csrf
                    <input type="file" name="file" class="form-control" style="width: 230px;" accept=".xlsx,.xls,.csv" required>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-file-earmark-excel"></i> Import Excel
                    </button>
                </form>
        
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
        </div>

    {{-- Tabel Produk --}}
    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Item Code</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Qty</th>
                        <th>Min Stock</th>
                        <th>Status</th>
                        <th>Loc</th>
                        <th>UOM</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->item_code }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->qty }}</td>
                            <td>{{ $product->min_stock }}</td>
                            <td>
                                @if($product->qty <= 0)
                                    <span class="badge bg-danger">Out</span>
                                @elseif($product->qty < $product->min_stock)
                                    <span class="badge bg-warning text-dark">Low</span>
                                @else
                                    <span class="badge bg-success">OK</span>
                                @endif
                            </td>
                            <td>{{ $product->loc }}</td>
                            <td>{{ $product->uom }}</td>
                            <td>
    <div class="d-inline-flex align-items-center" style="gap: 6px;">
        {{-- Tombol Edit --}}
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm px-3 py-1">
            <i class="bi bi-pencil-square"></i> Edit
        </a>

        {{-- Tombol Hapus --}}
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm px-3 py-1">
                <i class="bi bi-trash"></i> Hapus
            </button>
        </form>
    </div>
</td>


                    @empty
                        <tr><td colspan="10" class="text-center text-muted">Belum ada data produk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
