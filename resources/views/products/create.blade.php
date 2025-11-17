@extends('layouts.app')

@section('title', 'Tambah Produk Baru')

@section('content')
<div class="container-fluid py-4">

  {{-- Judul Halaman --}}
  <div class="mb-4 border-bottom pb-2 d-flex justify-content-between align-items-center">
      <h3 class="fw-bold text-primary mb-0">Tambah Produk Baru</h3>
      <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
          <i class="bi bi-arrow-left"></i> Kembali
      </a>
  </div>

  {{-- ✅ Alert sukses --}}
  @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
  @endif

  {{-- ❌ Alert error --}}
  @if($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Terjadi kesalahan:</strong>
          <ul class="mb-0 mt-2">
              @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
  @endif

  {{-- 🧾 FORM FULL WIDTH --}}
  <div class="card border-0 shadow-sm">
    <div class="card-body px-4 py-4">

      <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
          <div class="col-md-4">
            <label class="form-label fw-semibold">Kode Item</label>
            <input type="text" name="item_code" class="form-control" value="{{ old('item_code') }}" required>
          </div>
          
          <div class="col-md-4">
            <label class="form-label fw-semibold">Nama Produk</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
          </div>
          
           <div class="mb-3">
          <label class="form-label fw-semibold">Kategori</label>
          <select name="category" class="form-select">
              <option value="">-- Pilih Kategori --</option>
              @foreach ($categories as $cat)
                  <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>
                      {{ $cat }}
                  </option>
              @endforeach
          </select>
      </div>

      <div class="mb-3">
          <label class="form-label fw-semibold">Departemen</label>
          <select name="department_id" class="form-select">
              <option value="">-- Pilih Departemen --</option>
              @foreach ($departments as $dept)
                  <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                      {{ $dept->name }}
                  </option>
              @endforeach
          </select>
      </div>

      <div class="mb-3">
          <label class="form-label fw-semibold">Lokasi / Rak</label>
          <select name="loc" class="form-select">
              <option value="">-- Pilih Lokasi --</option>
              @foreach ($locs as $loc)
                  <option value="{{ $loc }}" {{ old('loc') == $loc ? 'selected' : '' }}>{{ $loc }}</option>
              @endforeach
          </select>
      </div>

      <div class="mb-3">
          <label class="form-label fw-semibold">Qty</label>
          <input type="number" name="qty" class="form-control" value="{{ old('qty') }}" min="0" required>
      </div>

      <div class="mb-3">
          <label class="form-label fw-semibold">UOM</label>
          <select name="uom" class="form-select">
              <option value="">-- Pilih UOM --</option>
              @foreach ($uoms as $u)
                  <option value="{{ $u }}" {{ old('uom') == $u ? 'selected' : '' }}>{{ $u }}</option>
              @endforeach
          </select>
      </div>

      <div class="mb-3">
          <label class="form-label fw-semibold">Min Stock</label>
          <input type="number" name="min_stock" class="form-control" value="{{ old('min_stock') }}" min="0">
      </div>

      <div class="d-flex justify-content-end gap-2">
          <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Simpan Produk</button>
      </div>
  </form>
</div>

        <div class="mt-4 d-flex justify-content-start gap-2">
          <button type="submit" class="btn btn-primary px-4">
              <i class="bi bi-save"></i> Simpan Produk
          </button>
          <a href="{{ route('products.index') }}" class="btn btn-outline-secondary px-4">
              <i class="bi bi-x-circle"></i> Batal
          </a>
        </div>

      </form>
    </div>
  </div>
</div>

{{-- 🌈 Styling --}}
<style>
  body {
    background-color: #f8f9fc;
  }
  .card {
    width: 100%;
    border-radius: 12px;
  }
  .form-label {
    color: #495057;
  }
  .form-control, .form-select {
    border: 1px solid #ced4da;
    transition: all 0.2s ease;
  }
  .form-control:focus, .form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
  }
</style>
@endsection
