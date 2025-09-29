@extends('layouts.app')

@section('content')
<h2>Edit Produk</h2>

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Produk</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
    </div>

    <div class="mb-3">
        <label>item-code</label>
        <input type="text" name="Item_code" class="form-control" value="{{ $product->item-code }}" required>
    </div>

    <div class="mb-3">
        <label>Kategori</label>
        <input type="text" name="category" class="form-control" value="{{ $product->category }}" required>
    </div>

    <div class="mb-3">
        <label>Qty</label>
        <input type="number" name="qty" class="form-control" value="{{ $product->qty }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
