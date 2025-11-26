@extends('layouts.app')

@section('title', 'Form Request Barang Warehouse Consumable')

@section('content')
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="container-fluid">
  <form id="adminRequestForm" action="{{ route('admin.store-request') }}"
 method="POST">
@csrf
<input type="hidden" name="items" id="itemsInput">

  <!-- Company Header -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between p-3" style="background-color:#f8f9fa; border:1px solid #dee2e6;">
        <div class="d-flex align-items-center">
          <div class="me-4">
            <img src="{{ asset('assets/images/mai.png') }}" style="width:120px; object-fit:contain;">
          </div>
          <div class="flex-grow-1">
            <p class="mb-1 small text-primary fw-semibold">To the infinite development and harmony of the technology and human being</p>
            <h4 class="mb-2 fw-bold text-dark">PT. METALART ASTRA INDONESIA</h4>
            <p class="mb-1 small text-muted">Kawasan Industri KIIC, Jl. Harapan III Lot-JJ2A...</p>
            <p class="mb-0 small text-muted">Telp : (021) 2936 9960...</p>
          </div>
        </div>

        <div>
          <button type="button" class="btn btn-warning fw-bold px-4 py-2" data-bs-toggle="modal" data-bs-target="#produksiModal" id="produksiButton">
            PRODUKSI - 4500 TAP
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Title -->
  <div class="row mb-4">
    <div class="col-12 text-center">
      <h3 class="fw-bold text-decoration-underline">FORM REQUEST BARANG WAREHOUSE CONSUMABLE</h3>
    </div>
  </div>

  <!-- FORM -->
  <div class="row">
    <div class="col-md-12">
      @if(session('success'))
<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
    <strong>Sukses!</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
    <strong>Gagal!</strong> {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

      <div class="card">
        <div class="card-body">

          <div class="row mb-4">
            <div class="col-md-6">
              <label class="form-label fw-bold">TANGGAL :</label>
              <input type="date" id="tanggal" name="tanggal" class="form-control" required>

            </div>
            
          </div>

          <div class="mb-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#requestItemModal">
              <i data-feather="plus"></i> REQUEST ITEM
            </button>
          </div>
                  <!-- Hidden input untuk dikirim -->
                  <input type="hidden" id="itemsInput" name="items">
                  <input type="hidden" id="npkNamaHidden" name="npk_nama">

          <!-- TABLE -->
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center fw-bold" style="width:8%;">NO</th>
                  <th class="text-center fw-bold">ITEM CODE</th>
                  <th class="text-center fw-bold">NAMA BARANG</th>
                  <th class="text-center fw-bold">LOC</th>
                  <th class="text-center fw-bold">QTY</th>
                  <th class="text-center fw-bold">UOM</th>
                  <th class="text-center fw-bold">NPK / NAMA</th>
                </tr>
              </thead>
              <tbody id="requestTableBody"></tbody>
            </table>
          </div>
          
          <button type="submit" class="btn btn-primary w-100 fw-bold mt-3">KIRIM REQUEST</button>

                </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- MODAL PRODUKSI -->
<div class="modal fade" id="produksiModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5>Pilih PRODUKSI</h5></div>
      <div class="modal-body">
        <div class="list-group">
          <button class="list-group-item" onclick="selectProduksi('PRODUKSI - 4500 TAP')">4500 TAP</button>
          <button class="list-group-item" onclick="selectProduksi('PRODUKSI - 2500 TAP')">2500 TAP</button>
          <button class="list-group-item" onclick="selectProduksi('PRODUKSI - 2000 TAP')">2000 TAP</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- MODAL REQUEST ITEM -->
<div class="modal fade" id="requestItemModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5>Request Item</h5>
      </div>

      <div class="modal-body">

        <!-- SCAN BUTTON -->
        <button class="btn btn-dark mb-3 w-100" onclick="startScanner()">
          📸 Scan Barcode
        </button>

        <!-- SCANNER AREA -->
        <div id="scanner" style="width:100%; display:none;"></div>

        <form id="requestItemForm">
          <label class="fw-bold mt-2">Item Code *</label>
          <input type="text" id="itemCode" class="form-control" required>

          <label class="fw-bold mt-2">Nama Barang</label>
          <input type="text" id="namaBarang" class="form-control" readonly>

          <label class="fw-bold mt-2">LOC</label>
          <input type="text" id="loc" class="form-control" readonly>

          <label class="fw-bold mt-2">QTY *</label>
          <input type="number" id="qty" min="1" class="form-control" required>

          <label class="fw-bold mt-2">UOM</label>
          <input type="text" id="uom" class="form-control" readonly>

          <label class="fw-bold mt-2">NPK / Nama *</label>
          <input type="text" id="npkNama" class="form-control" required>
        </form>

      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-success" onclick="addRequestItem()">Add Item</button>
      </div>

    </div>
  </div>
</div>


<!-- JAVASCRIPT -->
<script src="https://unpkg.com/html5-qrcode"></script>

<script>

let requestItems = [];
let html5Qr;

function addRowWarning() {
  alert("Gunakan tombol REQUEST ITEM untuk menambah item.");
}

function selectProduksi(x) {
  document.getElementById('produksiButton').textContent = x;
  bootstrap.Modal.getInstance(document.getElementById('produksiModal')).hide();
}

/* ==============================
   SCAN KAMERA
============================== */
function startScanner() {
  document.getElementById("scanner").style.display = "block";

  if (!html5Qr) {
    html5Qr = new Html5Qrcode("scanner");
  }

  html5Qr.start(
    { facingMode: "environment" },
    { fps: 10, qrbox: 250 },
    (decodedText) => {
      document.getElementById("itemCode").value = decodedText;
      fetchProduct(decodedText);
      html5Qr.stop();
      document.getElementById("scanner").style.display = "none";
    },
    (error) => {}
  );
}

/* ==============================
   AJAX GET PRODUCT FROM DATABASE
============================== */
function fetchProduct(code) {
  fetch(`/admin/get-product/${code}`)
    .then(res => res.json())
    .then(res => {
      if (!res.status) {
        alert("Item tidak ditemukan!");
        return;
      }

      let p = res.data;

      document.getElementById("namaBarang").value = p.name;
      document.getElementById("loc").value = p.loc;
      document.getElementById("uom").value = p.uom;
    });
}

document.getElementById("itemCode").addEventListener("input", function(){
  let code = this.value.trim();
  if (code.length >= 3) fetchProduct(code);
});
/* ==============================
   TAMBAH ITEM KE TABLE
============================== */
function addRequestItem() {
  const itemCode = document.getElementById('itemCode').value;
  const namaBarang = document.getElementById('namaBarang').value;
  const loc = document.getElementById('loc').value;
  const qty = document.getElementById('qty').value;
  const uom = document.getElementById('uom').value;
  const npkNama = document.getElementById('npkNama').value;

  if (!itemCode || !qty || !npkNama) {
    alert("Item Code, Qty, dan NPK wajib diisi!");
    return;
  }

  requestItems.push({
    itemCode, namaBarang, loc, qty, uom, npkNama
  });

  updateTable();

  document.getElementById('requestItemForm').reset();

  bootstrap.Modal.getInstance(document.getElementById('requestItemModal')).hide();
}

/* ==============================
   UPDATE TABLE HTML
============================== */
function updateTable() {
  /* ==============================
   KIRIM REQUEST ADMIN
============================== */
document.querySelector(".btn-primary").addEventListener("click", function () {

    if (requestItems.length < 1) {
        alert("Item request belum ditambahkan!");
        return;
    }

    let tanggal = document.getElementById("tanggal").value;

    if (!tanggal) {
        alert("Tanggal wajib diisi!");
        return;
    }

    // isi hidden input sebelum dikirim
    document.getElementById("itemsInput").value = JSON.stringify(requestItems);
    document.getElementById("npkNamaHidden").value = requestItems[0].npkNama;

   
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            alert("Request berhasil dibuat!");
            window.location.href = "{{ route('requests.index') }}";
        } else {
            alert("Gagal menyimpan: " + res.message);
        }
    });
});
  const tbody = document.getElementById('requestTableBody');
  tbody.innerHTML = "";

  requestItems.forEach((item, index) => {
    tbody.innerHTML += `
      <tr>
        <td class="text-center fw-bold">${index + 1}</td>
        <td>${item.itemCode}</td>
        <td>${item.namaBarang}</td>
        <td>${item.loc}</td>
        <td>${item.qty}</td>
        <td>${item.uom}</td>
        <td>${item.npkNama}</td>
      </tr>
    `;
  });
}
document.getElementById('adminRequestForm').addEventListener('submit', function(e) {
    if (requestItems.length === 0) {
        e.preventDefault();
        alert("Belum ada item yang ditambahkan!");
        return;
    }

    document.getElementById('itemsInput').value = JSON.stringify(requestItems);
});

</script>

<style>
.table th { border:2px solid #000 !important; }
.table td { border:1px solid #000 !important; }
.table tbody tr:hover { background:#f8f9fa; }
.modal-content { border-radius:8px; }
.btn-warning { font-weight:bold; }
</style>

@endsection
