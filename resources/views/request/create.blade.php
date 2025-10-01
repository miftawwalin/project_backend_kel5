@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Buat Request Barang</h3>

    <form action="{{ route('requests.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Produk</label>
            <select name="product_id" class="form-control" required>
                @foreach($products as $p)
                    <option value="{{ $p->id }}">{{ $p->item_code }} - {{ $p->name }} (stok: {{ $p->qty }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="quantity" class="form-control" min="1" required>
        </div>
        <button class="btn btn-primary">Kirim Request</button>
    </form>
</div>
@endsection
