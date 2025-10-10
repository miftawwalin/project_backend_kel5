@extends('layouts.app')

@section('title', 'Form Request Barang')

@section('content')
<div class="container-fluid px-4 py-3">
    <h4 class="text-center fw-bold mb-4 text-uppercase">
        FORM REQUEST BARANG WAREHOUSE CONSUMABLE
    </h4>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- FORM REQUEST BARANG --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('requests.store') }}" method="POST">
                @csrf
                <div class="row g-3 align-items-end">
                    {{-- Pilih Produk --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Pilih Barang</label>
                        <select name="product_id" class="form-select" required>
                            <option value="">-- Pilih Produk --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->item_code ?? '' }} - {{ $product->name }} (stok: {{ $product->qty }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Jumlah --}}
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Jumlah</label>
                        <input type="number" name="quantity" min="1" class="form-control" required>
                    </div>

                    {{-- Catatan --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Keterangan</label>
                        <input type="text" name="note" class="form-control" placeholder="Catatan tambahan (opsional)">
                    </div>

                    {{-- Tombol --}}
                    <div class="col-md-3 text-end">
                        <button type="submit" class="btn btn-success mt-3 px-4">
                            Kirim Request
                        </button>
                    </div>
                </div>

                <hr class="my-4">

                {{-- Data User --}}
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Nama Pemohon</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Departemen</label>
                        <input type="text" class="form-control"
                            value="{{ auth()->user()->department->name ?? 'Tanpa Departemen' }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Tanggal Permintaan</label>
                        <input type="text" class="form-control" value="{{ now()->format('d M Y H:i') }}" readonly>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- TABEL RIWAYAT REQUEST USER --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Daftar Permintaan Barang</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
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
                                <td>{{ $req->product->name }}</td>
                                <td>{{ $req->quantity }}</td>
                                <td>
                                    @if($req->status == 'approved')
                                        <span class="badge bg-success">Disetujui</span>
                                    @elseif($req->status == 'rejected')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @endif
                                </td>
                                <td>{{ $req->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted">Belum ada permintaan barang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
