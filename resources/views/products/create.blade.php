@extends('layouts.app')

@section('content')
<h2>Tambah Produk</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Kode Item</label>
        <input type="text" name="item_code" class="form-control" value="{{ old('item_code') }}" required>
    </div>

    <div class="mb-3">
        <label>Nama Produk</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
        <label>Kategori</label>
        <select name="category" class="form-select" required>
            <option value="">-- Pilih Kategori --</option>
            <option value="Sparepart" {{ old('category')=='Sparepart' ? 'selected' : '' }}>Sparepart</option>
            <option value="Elektrikal" {{ old('category')=='Elektrikal' ? 'selected' : '' }}>Elektrikal</option>
            <option value="Material" {{ old('category')=='Material' ? 'selected' : '' }}>Material</option>
            <option value="Consumable" {{ old('category')=='Consumable' ? 'selected' : '' }}>Consumable</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Lokasi / Rak</label>
        <select name="loc" class="form-select">
            <option value="">-- Pilih Rak --</option>
            <option value="Rak A1" {{ old('loc')=='Rak A1' ? 'selected' : '' }}>Rak A1</option>
            <option value="Rak B2" {{ old('loc')=='Rak B2' ? 'selected' : '' }}>Rak B2</option>
            <option value="Rak C1" {{ old('loc')=='Rak C1' ? 'selected' : '' }}>Rak C1</option>
            <option value="Oil Area" {{ old('loc')=='Oil Area' ? 'selected' : '' }}>Oil Area</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Qty</label>
        <input type="number" name="qty" class="form-control" value="{{ old('qty') }}" required>
    </div>

    <div class="mb-3">
        <label>UOM</label>
        <select name="uom" class="form-select">
            <option value="">-- Pilih UOM --</option>
            <option value="pcs" {{ old('uom')=='pcs' ? 'selected' : '' }}>pcs</option>
            <option value="meter" {{ old('uom')=='meter' ? 'selected' : '' }}>meter</option>
            <option value="lembar" {{ old('uom')=='lembar' ? 'selected' : '' }}>lembar</option>
            <option value="ltr" {{ old('uom')=='ltr' ? 'selected' : '' }}>ltr</option>
            <option value="can" {{ old('uom')=='can' ? 'selected' : '' }}>can</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Min Stock</label>
        <input type="number" name="min_stock" class="form-control" value="{{ old('min_stock') }}">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
