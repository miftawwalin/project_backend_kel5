@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark">Dashboard User</h4>
        <small class="text-muted">Halo,{{ auth()->user()->name }} ({{ auth()->user()->department->name ?? 'Tanpa Departemen' }})</small>
    </div>

    {{-- Statistik Request Barang --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center p-4">
                <h6 class="text-muted mb-2">Total Request</h6>
                <h3 class="fw-bold text-primary">{{ $totalRequests }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center p-4">
                <h6 class="text-muted mb-2">Pending</h6>
                <h3 class="fw-bold text-warning">{{ $pendingRequests }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center p-4">
                <h6 class="text-muted mb-2">Disetujui</h6>
                <h3 class="fw-bold text-success">{{ $approvedRequests }}</h3>
            </div>
        </div>
    </div>

    {{-- Daftar Request Barang --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white fw-bold py-3">
            <i class="bi bi-clock-history me-2 text-primary"></i> Permintaan Barang Terbaru
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
                        <td>{{ $req->product->name ?? '-' }}</td>
                        <td>{{ $req->quantity }}</td>
                        <td>
                            @if($req->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($req->status === 'approved')
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
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
@endsection
