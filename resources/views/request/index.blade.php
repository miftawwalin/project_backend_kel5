@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Request Barang</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $req)
            <tr>
                <td>{{ $req->user->name }}</td>
                <td>{{ $req->product->name }}</td>
                <td>{{ $req->quantity }}</td>
                <td>{{ ucfirst($req->status) }}</td>
                <td>
                    @if($req->status == 'pending')
                        <form method="POST" action="{{ route('requests.approve',$req->id) }}" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('requests.reject',$req->id) }}" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    @else
                        {{ ucfirst($req->status) }}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
