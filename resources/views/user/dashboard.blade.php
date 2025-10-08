@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard User</h2>
    <p>Halo, {{ auth()->user()->name }} (User)</p>
    
    <form method="POST" action="/logout">@csrf
        <button class="btn btn-danger">Logout</button>
    </form>
</div>
@extends('layouts.app')

@section('title', 'Request Form - User')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">
            <i class="bi bi-box2-heart me-2 text-primary"></i> Form Permintaan Barang
        </h4>
        <small class="text-muted">PT Metal Art Toyota Astra Indonesia</small>
    </div>

    {{-- FORM REQUEST --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('request.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Nama Barang</label>
                        <input type="text" name="item_name" class="form-control shadow-sm" placeholder="Contoh: Bearing 6202Z" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Jumlah</label>
                        <input type="number" name="quantity" class="form-control shadow-sm" min="1" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Alasan Permintaan</label>
                        <input type="text" name="note" class="form-control shadow-sm" placeholder="Contoh: Penggantian sparepart line produksi">
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary px-4 rounded-3">
                        <i class="bi bi-send me-1"></i> Kirim Request
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- DAFTAR REQUEST --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white fw-bold py-3">
            <i class="bi bi-clock-history me-2 text-primary"></i> Daftar Permintaan Saya
        </div>
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $index => $req)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $req->item_name }}</td>
                        <td>{{ $req->quantity }}</td>
                        <td>
                            @if($req->status === 'approved')
                                <span class="badge bg-success px-3 py-2">Disetujui</span>
                            @elseif($req->status === 'rejected')
                                <span class="badge bg-danger px-3 py-2">Ditolak</span>
                            @else
                                <span class="badge bg-warning text-dark px-3 py-2">Menunggu</span>
                            @endif
                        </td>
                        <td>{{ $req->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="bi bi-inbox me-2"></i> Belum ada request barang.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- OPTIONAL: Animasi ringan --}}
<script>
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll('.card').forEach(card => {
            card.style.opacity = 0;
            setTimeout(() => {
                card.style.transition = "all 0.4s ease";
                card.style.opacity = 1;
                card.style.transform = "translateY(0)";
            }, 200);
        });
    });
</script>
@endsection


