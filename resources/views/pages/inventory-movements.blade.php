@extends('layouts.app')

@section('title', 'Stock Movements')

@section('content')
<div class="container-fluid">
  <div class="row mb-4">
    <div class="col-12">
      <h2 class="fw-bold text-primary mb-1">Stock Movements</h2>
      <p class="text-muted mb-0">Pergerakan stok barang (GR/GI)</p>
    </div>
  </div>
  
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body text-center py-5">
          <i data-feather="trending-up" class="text-muted" style="width: 64px; height: 64px;"></i>
          <h4 class="mt-3 text-muted">Stock Movements Page</h4>
          <p class="text-muted">Halaman ini akan menampilkan pergerakan stok barang (Good Receipt & Good Issue)</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  if (typeof feather !== 'undefined') {
    feather.replace();
  }
});
</script>
@endsection
