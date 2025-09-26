@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
 <!-- Main Content -->
      <div class="col-md-9 col-lg-10 p-4">
        <h2 class="mb-4">Dashboard</h2>
        
        <div class="row g-3">
          <!-- Card 1 -->
          <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
              <div class="card-body">
                <h5 class="card-title">Total Produk</h5>
                <p class="card-text fs-4 fw-bold text-primary">12000</p>
              </div>
            </div>
          </div>
          <!-- Card 2 -->
          <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
              <div class="card-body">
                <h5 class="card-title">Penjualan Bulan Ini</h5>
                <p class="card-text fs-4 fw-bold text-success">Rp 15.000.000</p>
              </div>
            </div>
          </div>
          <!-- Card 3 -->
          <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
              <div class="card-body">
                <h5 class="card-title">Pengguna Terdaftar</h5>
                <p class="card-text fs-4 fw-bold text-warning">58</p>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>

@endsection
