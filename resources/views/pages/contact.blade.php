@extends('layouts.simple')
@extends('layouts.navbar')

@section('title', 'Contact')

@section('content')
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
@endsection
