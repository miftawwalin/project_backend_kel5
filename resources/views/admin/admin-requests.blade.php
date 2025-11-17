@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="fw-bold mb-4">Daftar Permintaan Barang</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th><th>User</th><th>Barang</th><th>Jumlah</th><th>Status</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $req)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $req->user->name ?? '-' }}</td>
                <td>{{ $req->product->name ?? '-' }}</td>
                <td>{{ $req->quantity }}</td>
                <td>
                    <span class="badge 
                        @if($req->status=='Approved') bg-success 
                        @elseif($req->status=='Rejected') bg-danger 
                        @else bg-warning text-dark @endif">
                        {{ $req->status }}
                    </span>
                </td>
                <td>
                    @if($req->status == 'pending')
                        <form action="{{ route('requests.approve', $req->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form action="{{ route('requests.reject', $req->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    @else
                        <em>-</em>
                    @endif
                </td>
            </tr>
            @empty
                <tr><td colspan="6" class="text-center">Tidak ada permintaan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
