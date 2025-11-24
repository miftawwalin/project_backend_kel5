@extends('layouts.app')

@section('title', 'History Request')

@section('content')
<div class="container">

    <h4 class="fw-bold mb-3">History Request</h4>

    <form class="row mb-4" method="GET">
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>

        <div class="col-md-3">
            <input type="date" name="from_date" class="form-control">
        </div>

        <div class="col-md-3">
            <input type="date" name="to_date" class="form-control">
        </div>

        <div class="col-md-3">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Barang</th>
                <th>Qty</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <tbody>
            @forelse($requests as $req)
            <tr>
                <td>{{ $req->id }}</td>
                <td>{{ $req->user->name }}</td>
                <td>{{ $req->product->name }}</td>
                <td>{{ $req->quantity }}</td>
                <td>{{ ucfirst($req->status) }}</td>
                <td>{{ $req->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $requests->links() }}

</div>
@endsection
