@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Produk</h1>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Item Code (SKU)</label>
            <input type="text" name="item_code" class="form-control" value="{{ old('item_code') }}" required>
        </div>
        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="category" class="form-control" value="{{ old('category') }}" required>
        </div>
        <div class="mb-3">
            <label>Qty</label>
            <input type="number" name="qty" class="form-control" value="{{ old('qty', 0) }}" min="0" required>
        </div>

        {{-- Optional fields --}}
        <div class="mb-3">
            <label>Lokasi (loc)</label>
            <input type="text" name="loc" class="form-control" value="{{ old('loc') }}">
        </div>
        <div class="mb-3">
            <label>Unit of Measure (uom)</label>
            <input type="text" name="uom" class="form-control" value="{{ old('uom') }}">
        </div>
        <div class="mb-3">
            <label>Minimal Stock</label>
            <input type="number" name="min_stock" class="form-control" value="{{ old('min_stock', 0) }}" min="0">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
