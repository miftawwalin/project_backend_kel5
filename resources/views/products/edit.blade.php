@extends('layouts.app')

@section('content')
<h2>Edit Produk</h2>
@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Kode Item</label>
        <input type="text" name="item_code" class="form-control" value="{{ old('item_code', $product->item_code) }}" required>
    </div>

    <div class="mb-3">
        <label>Nama Produk</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
    </div>

    <div class="mb-3">
        <label>Kategori</label>
        <input type="text" name="category" class="form-control" value="{{ old('category', $product->category) }}" required>
    </div>

    <div class="mb-3">
        <label>Lokasi</label>
        <input type="text" name="loc" class="form-control" value="{{ old('loc', $product->loc) }}">
    </div>

    <div class="mb-3">
        <label>Qty</label>
        <input type="number" name="qty" class="form-control" value="{{ old('qty', $product->qty) }}" required>
    </div>

    <div class="mb-3">
        <label>UOM</label>
        <input type="text" name="uom" class="form-control" value="{{ old('uom', $product->uom) }}">
    </div>

    <div class="mb-3">
        <label>Min Stock</label>
        <input type="number" name="min_stock" class="form-control" value="{{ old('min_stock', $product->min_stock) }}">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
