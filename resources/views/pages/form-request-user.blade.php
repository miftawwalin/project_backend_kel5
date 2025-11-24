@extends('layouts.app')

@section('title', 'Form Request Barang (User)')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center p-3" style="background-color:#f8f9fa; border:1px solid #dee2e6;">
                <img src="{{ asset('assets/images/mai.png') }}" style="width:120px;" class="me-4">
                <div>
                    <p class="mb-1 small text-primary fw-semibold">To the infinite development and harmony of technology and human being</p>
                    <h4 class="fw-bold text-dark">PT. METALART ASTRA INDONESIA</h4>
                    <p class="mb-1 small text-muted">Kawasan Industri KIIC, Jl. Harapan III Lot-JJ2A, Karawang 41631</p>
                    <p class="mb-0 small text-muted">Telp : (021) 2936 9960</p>
                </div>
            </div>
        </div>
    </div>

    {{-- TITLE --}}
    <h3 class="fw-bold text-center text-decoration-underline mb-4">FORM REQUEST BARANG (USER)</h3>

    <form method="POST" action="{{ route('requests.store') }}">
        @csrf

        <input type="hidden" name="items" id="itemsInput">

        <div class="card">
            <div class="card-body">

                {{-- NPK + Nama --}}
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="fw-bold">NPK</label>
                        <input type="text" name="npk" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="fw-bold">Nama Karyawan</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                </div>

                {{-- Tanggal + Produk --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="fw-bold">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>

                    
                </div>

                {{-- BUTTON --}}
                <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalAddItem">
                    + REQUEST ITEM
                </button>

                {{-- TABEL --}}
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>ITEM CODE</th>
                                <th>NAMA BARANG</th>
                                <th>LOC</th>
                                <th>QTY</th>
                                <th>UOM</th>
                                <th>NPK/NAMA</th>
                            </tr>
                        </thead>
                        <tbody id="itemTableBody"></tbody>
                    </table>
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-bold mt-3">KIRIM REQUEST</button>

            </div>
        </div>
    </form>
</div>


{{-- MODAL ADD ITEM --}}
<div class="modal fade" id="modalAddItem">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Item</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <label class="fw-bold">Pilih Item</label>
                <select id="itemSelect" class="form-control select2 mb-3">
                    <option value="">-- Pilih Item --</option>
                    @foreach($products as $p)
                        <option value="{{ $p->item_code }}"
                                data-name="{{ $p->name }}"
                                data-loc="{{ $p->loc }}"
                                data-uom="{{ $p->uom }}">
                                {{ $p->item_code }} — {{ $p->name }}
                        </option>
                    @endforeach
                </select>

                <div class="mb-3">
                    <label>Item Code</label>
                    <input type="text" id="itemCode" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label>Nama Barang</label>
                    <input type="text" id="namaBarang" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label>LOC</label>
                    <input type="text" id="loc" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label>UOM</label>
                    <input type="text" id="uom" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label>Qty</label>
                    <input type="number" id="qty" min="1" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Catatan</label>
                    <input type="text" id="npkInput" class="form-control">
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-success" onclick="addItem()">Tambah</button>
            </div>

        </div>
    </div>
</div>


@endsection


@push('scripts')
<script>
$(document).ready(function () {

    // ACTIVE SELECT2
    $('#itemSelect').select2({
        theme: 'bootstrap-5',
        width: '100%'
    });

    // AUTO FILL
    $('#itemSelect').on('select2:select', function (e) {

        let option = e.params.data.element;

        $('#itemCode').val(option.value);
        $('#namaBarang').val(option.dataset.name);
        $('#loc').val(option.dataset.loc);
        $('#uom').val(option.dataset.uom);

        console.log("Autofill:", option.dataset.name);
    });

});
</script>


<script>
let items = [];

function addItem() {

    let item = {
        code: $('#itemCode').val(),
        nama: $('#namaBarang').val(),
        loc: $('#loc').val(),
        qty: $('#qty').val(),
        uom: $('#uom').val(),
        npk: $('#npkInput').val()
    };

    items.push(item);

    $('#itemsInput').val(JSON.stringify(items));

    updateTable();

    $('#itemSelect').val('').trigger('change');
    $('#itemCode').val('');
    $('#namaBarang').val('');
    $('#loc').val('');
    $('#qty').val('');
    $('#uom').val('');
    $('#npkInput').val('');

    bootstrap.Modal.getInstance(document.getElementById('modalAddItem')).hide();
}

function updateTable() {
    let body = $('#itemTableBody');
    body.html('');

    items.forEach((item, i) => {
        body.append(`
            <tr>
                <td>${i+1}</td>
                <td>${item.code}</td>
                <td>${item.nama}</td>
                <td>${item.loc}</td>
                <td>${item.qty}</td>
                <td>${item.uom}</td>
                <td>${item.catatan}</td>
            </tr>
        `);
    });
}
</script>
@endpush
