@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Daftar Request Barang</h4>
    <a href="{{ route('requests.create') }}" class="btn btn-success mb-3">+ Buat Request</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Status</th>
                <th>Jumlah Item</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $req)
            <tr>
                <td>{{ $req->id }}</td>
                <td>{{ $req->request_date }}</td>
                <td>{{ $req->produk }}</td>
                <td>{{ $req->status }}</td>
                <td>{{ $req->items->count() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $requests->links() }}
</div>
@endsection
