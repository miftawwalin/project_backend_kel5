@extends('layouts.app')

@section('title', 'Form Request Barang')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4 fw-bold text-dark">Form Request Barang ({{ auth()->user()->department->name ?? 'Tanpa Departemen' }})</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('product-request.store') }}" method="POST" class="card p-4 mb-4 shadow-sm">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Pilih Barang</label>
                <select name="product_id" class="form-select" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->name }} (Stok: {{ $product->qty }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Jumlah</label>
                <input type="number" name="quantity" min="1" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Catatan</label>
                <input type="text" name="note" class="form-control" placeholder="Keterangan opsional">
            </div>
        </div>
        <div class="mt-4 text-end">
            <button type="submit" class="btn btn-primary px-4">Kirim Request</button>
        </div>
    </form>

    <div class="card p-4 shadow-sm">
        <h5 class="fw-bold mb-3">Riwayat Permintaan Saya</h5>
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Barang</th>
                    <th>Qty</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $index => $req)
                <tr>
                    <td>{{ $index+1 }}</td>
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
                <tr><td colspan="5" class="text-center text-muted">Belum ada permintaan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
