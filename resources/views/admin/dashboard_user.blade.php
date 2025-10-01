@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard User</h2>
    <p>Halo, {{ auth()->user()->name }} (User)</p>
    <ul>
        <li><a href="{{ route('requests.create') }}">Buat Request Barang</a></li>
        <li><a href="{{ route('requests.user') }}">Request Saya</a></li>
    </ul>
    <form method="POST" action="/logout">@csrf
        <button class="btn btn-danger">Logout</button>
    </form>
</div>
@endsection
