<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Kontak Kami | PT Metal Art Indonesia</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  {{-- Navbar --}}
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
          <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
          <li class="nav-item"><a class="nav-link active" href="/contact">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>
  {{-- End Navbar --}}

  <!-- Contact Section -->
  <div class="container my-5">
    <div class="text-center mb-4">
      <h1 class="fw-bold">Hubungi Kami</h1>
      <p class="text-muted">Silakan tinggalkan pesan atau pertanyaan Anda melalui form di bawah ini.</p>
    </div>

    <div class="row g-4">
      <!-- Form -->
      <div class="col-md-7">
        <div class="card shadow-sm border-0 p-4">
          <form action="/contact/send" method="POST">
            {{-- Tambahkan @csrf jika dipakai di Laravel --}}
            <div class="mb-3">
              <label for="name" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama Anda" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="nama@email.com" required>
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Pesan</label>
              <textarea class="form-control" id="message" name="message" rows="5" placeholder="Tulis pesan Anda..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim Pesan</button>
          </form>
        </div>
      </div>

      <!-- Contact Info -->
      <div class="col-md-5">
        <div class="card shadow-sm border-0 p-4">
          <h4 class="fw-bold">Informasi Kontak</h4>
          <p><strong>PT Metal Art Indonesia</strong></p>
          <p><i class="bi bi-geo-alt-fill"></i> Kawasan Industri KIIC, Jl. Harapan III No.Lot JJ-2A, Sirnabaya, Telukjambe Timur, Karawang, Jawa Barat 41361</p>
          <p><i class="bi bi-telephone-fill"></i> (021) 29369960</p>
          <p><i class="bi bi-envelope-fill"></i> info@metalart.co.id</p>

          <hr>
          <h5 class="fw-bold">Jam Operasional</h5>
          <p>Senin - Jumat: 08.00 - 17.00</p>
          <p>Sabtu: 08.00 - 12.00</p>
          <p>Minggu & Hari Libur: Tutup</p>
        </div>
      </div>
    </div>
  </div>
  <!-- End Contact Section -->

  <!-- Bootstrap JS + Icons -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</body>
</html>
