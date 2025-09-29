@extends('layouts.app')

@section('content')
<div class="container">
    <h4>FORM REQUEST BARANG</h4>
    <form method="POST" action="{{ route('requests.store') }}">
        @csrf

        <div class="row mb-3">
            <div class="col">
                <label>Tanggal</label>
                <input type="date" name="request_date" class="form-control" required>
            </div>
            <div class="col">
                <label>Produk</label>
                <input type="text" name="produk" class="form-control">
            </div>
        </div>

        <table class="table" id="items-table">
            <thead>
                <tr>
                    <th>Item Code</th>
                    <th>Nama Barang</th>
                    <th>LOC</th>
                    <th>Qty</th>
                    <th>UOM</th>
                    <th>NPK / Nama</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input name="items[0][item_code]" class="form-control"></td>
                    <td><input name="items[0][item_name]" class="form-control" required></td>
                    <td><input name="items[0][loc]" class="form-control"></td>
                    <td><input type="number" name="items[0][qty]" class="form-control" min="1" required></td>
                    <td><input name="items[0][uom]" class="form-control"></td>
                    <td><input name="items[0][npk_name]" class="form-control"></td>
                    <td><button type="button" class="btn btn-danger remove-row">X</button></td>
                </tr>
            </tbody>
        </table>

        <button type="button" id="add-row" class="btn btn-secondary">+ Add Row</button>
        <button type="submit" class="btn btn-primary">Request Item</button>
    </form>
</div>

<script>
document.getElementById('add-row').addEventListener('click', function() {
    let tbody = document.querySelector('#items-table tbody');
    let index = tbody.children.length;
    let row = `<tr>
        <td><input name="items[${index}][item_code]" class="form-control"></td>
        <td><input name="items[${index}][item_name]" class="form-control" required></td>
        <td><input name="items[${index}][loc]" class="form-control"></td>
        <td><input type="number" name="items[${index}][qty]" class="form-control" min="1" required></td>
        <td><input name="items[${index}][uom]" class="form-control"></td>
        <td><input name="items[${index}][npk_name]" class="form-control"></td>
        <td><button type="button" class="btn btn-danger remove-row">X</button></td>
    </tr>`;
    tbody.insertAdjacentHTML('beforeend', row);
});

document.addEventListener('click', function(e) {
    if(e.target.classList.contains('remove-row')){
        e.target.closest('tr').remove();
    }
});
</script>
@endsection
