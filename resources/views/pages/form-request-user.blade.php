@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="fw-bold mb-4">Form Request Barang</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('requests.store') }}" class="mb-4">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label>Pilih Barang</label>
                <select class="form-select" name="product_id" required>
                    <option value="">-- Pilih --</option>
                    @foreach($products as $p)
                        <option value="{{ $p->id }}">{{ $p->name }} (Stok: {{ $p->qty }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="quantity" min="1" required>
            </div>
            <div class="col-md-4">
                <label>Catatan</label>
                <input type="text" name="note" class="form-control">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-success w-100">Kirim</button>
            </div>
        </div>
    </form>

    <h5>Riwayat Permintaan</h5>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th><th>Barang</th><th>Jumlah</th><th>Status</th><th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $req)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $req->product->name }}</td>
                <td>{{ $req->quantity }}</td>
                <td>
                    <span class="badge 
                        @if($req->status=='Approved') bg-success 
                        @elseif($req->status=='Rejected') bg-danger 
                        @else bg-warning text-dark @endif">
                        {{ $req->status }}
                    </span>
                </td>
                <td>{{ $req->created_at->format('d M Y H:i') }}</td>
            </tr>
            @empty
                <tr><td colspan="5" class="text-center">Belum ada request</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
