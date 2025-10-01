@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Request Saya</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $req)
            <tr>
                <td>{{ $req->product->name }}</td>
                <td>{{ $req->quantity }}</td>
                <td>{{ ucfirst($req->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
