<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dashboard | Kelompok 5</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">Kelompok 5</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" 
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->

  <!-- Dashboard Content -->
  <div class="container-fluid mt-4">
    <div class="row">
      
      <!-- Sidebar -->
      <div class="col-md-3 col-lg-2 bg-light p-3 border-end">
        <h5 class="fw-bold">Menu</h5>
        <ul class="nav flex-column">
          <li class="nav-item"><a href="#" class="nav-link">📊 Statistik</a></li>
          <li class="nav-item"><a href="#" class="nav-link">📦 Data Produk</a></li>
          <li class="nav-item"><a href="#" class="nav-link">🛒 Penjualan</a></li>
          <li class="nav-item"><a href="#" class="nav-link">⚙️ Pengaturan</a></li>
        </ul>
      </div>
      
      <!-- Main Content -->
      <div class="col-md-9 col-lg-10 p-4">
        <h2 class="mb-4">Dashboard</h2>
        
        <div class="row g-3">
          <!-- Card 1 -->
          <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
              <div class="card-body">
                <h5 class="card-title">Total Produk</h5>
                <p class="card-text fs-4 fw-bold text-primary">120</p>
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
  <!-- End Dashboard Content -->

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
