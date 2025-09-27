@extends('layouts.app')

@section('title', 'Inventory Reports')

@section('content')
<div class="container-fluid">
  <div class="row mb-4">
    <div class="col-12">
      <h2 class="fw-bold text-primary mb-1">Inventory Reports</h2>
      <p class="text-muted mb-0">Laporan dan analisis inventory</p>
    </div>
  </div>
  
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body text-center py-5">
          <i data-feather="bar-chart-2" class="text-muted" style="width: 64px; height: 64px;"></i>
          <h4 class="mt-3 text-muted">Inventory Reports Page</h4>
          <p class="text-muted">Halaman ini akan menampilkan laporan dan analisis inventory</p>
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
