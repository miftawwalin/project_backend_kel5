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

          <div class="mb-2">
            <label class="fw-bold mt-2">Stock Tersedia</label>
            <div class="alert alert-info mb-2 py-2" id="stockInfo" style="display: none;">
              <i data-feather="package"></i> <strong>Stock:</strong> <span id="stockDisplay">0</span>
            </div>
          </div>

          <label class="fw-bold mt-2">QTY *</label>
          <input type="number" id="qty" min="1" class="form-control" required>
          <div class="invalid-feedback" id="qtyError" style="display: none;">
            Qty tidak boleh melebihi stock yang tersedia!
          </div>
          <input type="hidden" id="maxStock" value="0">

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
// Initialize feather icons on page load
document.addEventListener('DOMContentLoaded', function() {
  if (typeof feather !== 'undefined') {
    feather.replace();
  }
  
  // Reset form saat modal ditutup atau dibuka
  const requestItemModal = document.getElementById('requestItemModal');
  if (requestItemModal) {
    requestItemModal.addEventListener('hidden.bs.modal', function() {
      document.getElementById('requestItemForm').reset();
      document.getElementById("stockInfo").style.display = 'none';
      document.getElementById("maxStock").value = 0;
      currentStock = 0;
      document.getElementById('qty').classList.remove('is-invalid');
      document.getElementById('qtyError').style.display = 'none';
      document.getElementById('qty').removeAttribute('max');
    });
    
    requestItemModal.addEventListener('show.bs.modal', function() {
      // Reset form saat modal dibuka
      document.getElementById('requestItemForm').reset();
      document.getElementById("stockInfo").style.display = 'none';
      document.getElementById("maxStock").value = 0;
      currentStock = 0;
      document.getElementById('qty').classList.remove('is-invalid');
      document.getElementById('qtyError').style.display = 'none';
      document.getElementById('qty').removeAttribute('max');
    });
  }
});

let requestItems = [];
let html5Qr;
let currentStock = 0; // Menyimpan stock saat ini

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
/* ==============================
   SCAN KAMERA
============================== */
function startScanner() {
  document.getElementById("scanner").style.display = "block";

  if (!html5Qr) {
    // Konfigurasi format barcode (termasuk 1D Barcode)
    // Pastikan library html5-qrcode terbaru dimuat
    const formats = [
        Html5QrcodeSupportedFormats.QR_CODE,
        Html5QrcodeSupportedFormats.CODE_128,
        Html5QrcodeSupportedFormats.CODE_39,
        Html5QrcodeSupportedFormats.EAN_13,
        Html5QrcodeSupportedFormats.UPC_A
    ];
    html5Qr = new Html5Qrcode("scanner", { formatsToSupport: formats, verbose: false });
  }

  const config = { 
      fps: 20, 
      qrbox: { width: 250, height: 250 }, // Kotak persegi untuk QR Code
      aspectRatio: 1.0
  };

  html5Qr.start(
    { facingMode: "environment" },
    config,
    (decodedText) => {
      console.log("Scanned:", decodedText);
      document.getElementById("itemCode").value = decodedText;
      
      // Trigger event change agar fetchProduct jalan
      document.getElementById("itemCode").dispatchEvent(new Event('change'));
      
      html5Qr.stop().then(() => {
          document.getElementById("scanner").style.display = "none";
      });
    },
    (errorMessage) => {
        // ignore errors (scanning...)
    }
  ).catch(err => {
      alert("Gagal mengakses kamera: " + err);
  });
}

/* ==============================
   AJAX GET PRODUCT FROM DATABASE
============================== */
/* ==============================
   AJAX GET PRODUCT FROM DATABASE
============================== */
function fetchProduct(code) {
  fetch(`/admin/get-product/${code}`)
    .then(res => res.json())
    .then(res => {
      if (!res.status) {
        alert("Item tidak ditemukan!");
        // Reset form jika item tidak ditemukan
        document.getElementById("namaBarang").value = '';
        document.getElementById("loc").value = '';
        document.getElementById("uom").value = '';
        document.getElementById("stockInfo").style.display = 'none';
        document.getElementById("maxStock").value = 0;
        currentStock = 0;
        return;
      }

      let p = res.data;

      document.getElementById("namaBarang").value = p.name;
      document.getElementById("loc").value = p.loc || '';
      document.getElementById("uom").value = p.uom || '';
      
      // Set stock (gunakan qty dari database)
      currentStock = parseInt(p.qty) || 0;
      document.getElementById("maxStock").value = currentStock;
      
      // Tampilkan stock info
      const stockInfo = document.getElementById("stockInfo");
      const stockDisplay = document.getElementById("stockDisplay");
      stockDisplay.textContent = currentStock.toLocaleString('id-ID');
      stockInfo.style.display = 'block';
      
      // Update class alert berdasarkan stock
      if (currentStock <= 0) {
        stockInfo.className = 'alert alert-danger mb-2 py-2';
        stockDisplay.textContent = '0 (OUT OF STOCK)';
      } else if (currentStock < (p.min_stock || 0)) {
        stockInfo.className = 'alert alert-warning mb-2 py-2';
      } else {
        stockInfo.className = 'alert alert-info mb-2 py-2';
      }
      
      // Reset qty dan validasi
      document.getElementById("qty").value = '';
      document.getElementById("qty").classList.remove('is-invalid');
      document.getElementById("qtyError").style.display = 'none';
      
      // Set max attribute pada input qty
      document.getElementById("qty").setAttribute('max', currentStock);
    })
    .catch(err => {
      console.error(err);
      alert("Terjadi kesalahan saat mengambil data produk!");
    });
}

document.getElementById("itemCode").addEventListener("change", function(){
  let code = this.value.trim();
  if (code.length >= 3) fetchProduct(code);
});

// Validasi QTY real-time
document.getElementById("qty").addEventListener("input", function(){
  const qty = parseInt(this.value) || 0;
  const maxStock = parseInt(document.getElementById("maxStock").value) || 0;
  const qtyInput = this;
  const qtyError = document.getElementById("qtyError");
  
  if (qty > maxStock && maxStock > 0) {
    qtyInput.classList.add('is-invalid');
    qtyError.style.display = 'block';
    qtyError.textContent = `Qty tidak boleh melebihi stock yang tersedia! Stock tersedia: ${maxStock.toLocaleString('id-ID')}`;
  } else if (qty <= 0) {
    qtyInput.classList.add('is-invalid');
    qtyError.style.display = 'block';
    qtyError.textContent = 'Qty harus lebih dari 0!';
  } else {
    qtyInput.classList.remove('is-invalid');
    qtyError.style.display = 'none';
  }
});

/* ==============================
   TAMBAH ITEM KE TABLE
============================== */
function addRequestItem() {
  const itemCode = document.getElementById('itemCode').value.trim();
  const namaBarang = document.getElementById('namaBarang').value;
  const loc = document.getElementById('loc').value;
  const qty = parseInt(document.getElementById('qty').value) || 0;
  const uom = document.getElementById('uom').value;
  const npkNama = document.getElementById('npkNama').value.trim();
  const maxStock = parseInt(document.getElementById("maxStock").value) || 0;

  // Validasi wajib
  if (!itemCode || !qty || !npkNama) {
    alert("Item Code, Qty, dan NPK wajib diisi!");
    return;
  }

  // Validasi qty harus lebih dari 0
  if (qty <= 0) {
    alert("Qty harus lebih dari 0!");
    document.getElementById('qty').focus();
    return;
  }

  // Validasi qty tidak boleh melebihi stock
  if (qty > maxStock) {
    alert(`Qty tidak boleh melebihi stock yang tersedia!\nStock tersedia: ${maxStock.toLocaleString('id-ID')}\nQty yang diminta: ${qty.toLocaleString('id-ID')}`);
    document.getElementById('qty').focus();
    document.getElementById('qty').classList.add('is-invalid');
    return;
  }

  // Cek apakah item code sudah ada di requestItems (duplikasi)
  const existingItem = requestItems.find(item => item.itemCode === itemCode);
  if (existingItem) {
    if (!confirm(`Item ${itemCode} sudah ada dalam daftar. Apakah Anda ingin menggantinya?`)) {
      return;
    }
    // Hapus item lama
    requestItems = requestItems.filter(item => item.itemCode !== itemCode);
  }

  requestItems.push({
    itemCode, namaBarang, loc, qty, uom, npkNama
  });

  updateTable();

  // Reset form
  document.getElementById('requestItemForm').reset();
  document.getElementById("stockInfo").style.display = 'none';
  document.getElementById("maxStock").value = 0;
  currentStock = 0;
  document.getElementById('qty').classList.remove('is-invalid');
  document.getElementById('qtyError').style.display = 'none';
  
  // Re-initialize feather icons
  if (typeof feather !== 'undefined') {
    feather.replace();
  }

  bootstrap.Modal.getInstance(document.getElementById('requestItemModal')).hide();
}

/* ==============================
   UPDATE TABLE HTML
============================== */
function updateTable() {
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

// Form Submit Handler
document.getElementById('adminRequestForm').addEventListener('submit', function(e) {
    if (requestItems.length === 0) {
        e.preventDefault();
        alert("Belum ada item yang ditambahkan!");
        return;
    }

    document.getElementById('itemsInput').value = JSON.stringify(requestItems);
    // npkNamaHidden can be taken from first item or just handled in backend if needed
    if(requestItems.length > 0) {
        document.getElementById('npkNamaHidden').value = requestItems[0].npkNama;
    }
});

</script>

<style>
.table th { border:2px solid #000 !important; }
.table td { border:1px solid #000 !important; }
.table tbody tr:hover { background:#f8f9fa; }
.modal-content { border-radius:8px; }
.btn-warning { font-weight:bold; }

#stockInfo {
  font-size: 0.9rem;
}

#stockInfo i {
  width: 16px;
  height: 16px;
  margin-right: 5px;
}

#qtyError {
  font-size: 0.875rem;
}

.form-control.is-invalid {
  border-color: #dc3545;
  padding-right: calc(1.5em + 0.75rem);
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.8 3.6 .4.4.4-.4m0 4.8-.4-.4-.4.4'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right calc(0.375em + 0.1875rem) center;
  background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}
</style>

@endsection
