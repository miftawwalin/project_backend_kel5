<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tentang Kami | PT Metal Art Indonesia</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  {{-- Navbar --}}
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">Kelompok 5</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" 
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="/about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>
  {{-- End Navbar --}}

  <!-- About Section -->
  <div class="container my-5">
    <div class="row align-items-center g-5">
      <!-- Gambar -->
      <div class="col-lg-6">
        <img src="{{ asset('img/pabrik.jpeg') }}" 
     alt="Pabrik PT Metal Art Indonesia" 
     class="img-fluid rounded "
     style="max-height: 300px; width: 70%; object-fit: cover;">

      </div>
      <!-- Deskripsi -->
      <div class="col-lg-6">
        <h1 class="fw-bold mb-3 text-primary">Tentang PT Metal Art Indonesia</h1>
        <p class="text-muted">
          <strong>PT Metal Art Indonesia</strong> adalah perusahaan manufaktur yang bergerak di bidang 
          <em>metal engineering & fabrication</em>. Kami berdiri dengan komitmen menghadirkan produk logam 
          berkualitas tinggi yang digunakan dalam sektor konstruksi, otomotif, dan seni dekorasi.
        </p>
        <p class="text-muted">
          Dengan tim profesional dan mesin berteknologi modern, kami memberikan layanan mulai dari desain, 
          produksi, hingga finishing dengan standar mutu internasional.
        </p>
        <p class="text-muted">
          Visi kami adalah menjadi perusahaan logam terkemuka di Indonesia yang mengedepankan 
          <span class="fw-bold text-dark">inovasi, kualitas, dan kepuasan pelanggan</span>.
        </p>
      </div>
    </div>

    <!-- Visi & Misi -->
    <div class="row mt-5">
      <div class="col-md-6 mb-3">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-body">
            <h3 class="fw-bold text-primary">Visi</h3>
            <p class="text-muted mb-0">
              Menjadi perusahaan logam terkemuka di Asia Tenggara dengan produk inovatif, berkualitas, dan ramah lingkungan.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-body">
            <h3 class="fw-bold text-primary">Misi</h3>
            <ul class="text-muted mb-0">
              <li>Menyediakan produk logam berkualitas tinggi dengan harga kompetitif.</li>
              <li>Mengutamakan teknologi modern dalam setiap proses produksi.</li>
              <li>Mendukung keberlanjutan melalui praktik ramah lingkungan.</li>
              <li>Memberikan layanan terbaik untuk kepuasan pelanggan.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End About Section -->

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-5">
    <p class="mb-0">&copy; {{ date('Y') }} PT Metal Art Indonesia | All Rights Reserved</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
