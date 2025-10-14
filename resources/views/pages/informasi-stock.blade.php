@extends('layouts.app')

@section('title', 'Stock Information & Item Status')

@section('content')
<div class="container-fluid">

    <h3 class="fw-bold mb-4 text-dark">Stock Information & Item Status</h3>

    {{-- Statistik Singkat --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body text-center">
                    <h6 class="text-muted mb-1">Total Produk</h6>
                    <h3 class="fw-bold text-primary">{{ $totalProducts }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body text-center">
                    <h6 class="text-muted mb-1">In Stock</h6>
                    <h3 class="fw-bold text-success">{{ $inStock }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body text-center">
                    <h6 class="text-muted mb-1">Low Stock</h6>
                    <h3 class="fw-bold text-danger">{{ $lowStock }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Item</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Qty</th>
                        <th>Min Stock</th>
                        <th>Status</th>
                        <th>Lokasi</th>
                        <th>UOM</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $index => $product)
                        @php
                            $isLowStock = $product->stock <= $product->min_stock;
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $product->item_code }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->min_stock }}</td>
                            <td>
    @php
        $qty = (int) $product->qty;
        $minStock = (int) ($product->min_stock ?? 0);
    @endphp

    @if($qty <= $minStock)
        <span class="badge bg-danger text-white">Low Stock</span>
    @else
        <span class="badge bg-success text-white">In Stock</span>
    @endif
</td>

                            
                            <td>{{ $product->loc ?? '-' }}</td>
                            <td>{{ $product->uom ?? '-' }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus item ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">Tidak ada data produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
