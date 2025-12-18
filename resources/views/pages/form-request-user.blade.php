@extends('layouts.app')

@section('title', 'Form Request Barang (User)')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
    <strong>Sukses!</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
{{-- Alert --}}
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
    <strong>Gagal!</strong> {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="container-fluid">

    {{-- HEADER --}}
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
            Request Manual
          </button>
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
                                <th>NOTE</th>
                                <th>ACTION</th>
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

                <form id="requestItemForm">
                  <label class="fw-bold">Pilih Item *</label>
                  <select id="itemSelect" class="form-control select2" style="width: 100%;" required>
                    <option value="">-- Cari atau Pilih Item --</option>
                    @foreach($products as $p)
                      <option value="{{ $p->item_code }}"
                              data-name="{{ $p->name }}"
                              data-category="{{ $p->category }}"
                              data-uom="{{ $p->uom }}"
                              data-loc="{{ $p->loc }}"
                              data-description="{{ $p->description }}"
                              data-department-id="{{ $p->department_id }}"
                              data-department-name="{{ $p->department->name ?? '-' }}"
                              data-stock="{{ $p->qty }}"
                              data-min-stock="{{ $p->min_stock }}">
                        {{ $p->item_code }} — {{ $p->name }} (Stock: {{ $p->qty }})
                      </option>
                    @endforeach
                  </select>

                  <label class="fw-bold mt-2">Item Code</label>
                  <input type="text" id="itemCode" class="form-control" readonly>

                  <label class="fw-bold mt-2">Nama Barang</label>
                  <input type="text" id="namaBarang" class="form-control" readonly>

                  <div class="row">
                    <div class="col-md-6">
                      <label class="fw-bold mt-2">Category</label>
                      <input type="text" id="category" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                      <label class="fw-bold mt-2">UOM (Unit of Measure)</label>
                      <input type="text" id="uom" class="form-control" readonly>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <label class="fw-bold mt-2">LOC (Location)</label>
                      <input type="text" id="loc" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                      <label class="fw-bold mt-2">Department/User</label>
                      <input type="text" id="department" class="form-control" readonly>
                    </div>
                  </div>

                  <label class="fw-bold mt-2">Description</label>
                  <textarea id="description" class="form-control" rows="2" readonly></textarea>

                  <div class="mb-2">
                    <label class="fw-bold mt-2">Stock Tersedia (dari Inventory Dashboard)</label>
                    <div class="alert alert-info mb-2 py-2" id="stockInfo" style="display: none;">
                      <div class="d-flex align-items-center justify-content-between">
                        <div>
                          <i data-feather="package"></i> <strong>Stock Tersedia:</strong> 
                          <span id="stockDisplay" class="fw-bold fs-5">0</span>
                          <span id="stockUOM" class="text-muted small ms-1"></span>
                        </div>
                        <div class="badge bg-primary" id="stockBadge" style="display: none;">Dari Inventory</div>
                      </div>
                    </div>
                    <div class="text-muted small" id="stockHint" style="display: none;">
                      <i data-feather="info"></i> Masukkan QTY tidak boleh melebihi stock yang tersedia di atas (sumber: Inventory Dashboard)
                    </div>
                  </div>

                  <label class="fw-bold mt-2">QTY *</label>
                  <input type="number" id="qty" min="1" class="form-control" required placeholder="Masukkan jumlah yang diminta">
                  <div class="invalid-feedback" id="qtyError" style="display: none;">
                    Qty tidak boleh melebihi stock yang tersedia!
                  </div>
                  <small class="text-muted" id="qtyHint">Maksimal: <span id="maxStockDisplay" class="fw-bold">0</span></small>
                  <input type="hidden" id="maxStock" value="0">

                  <div class="mb-3">
                      <label class="fw-bold mt-2">Note</label>
                      <textarea id="noteInput" class="form-control" rows="2" placeholder="Masukkan catatan untuk item ini (opsional)"></textarea>
                  </div>
                </form>

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
// Initialize
$(document).ready(function() {
  // Initialize Select2 dengan search functionality
  $('#itemSelect').select2({
    theme: 'bootstrap-5',
    width: '100%',
    dropdownParent: $('#modalAddItem'),
    placeholder: '-- Cari atau Pilih Item --',
    allowClear: true,
    language: {
      noResults: function() {
        return "Item tidak ditemukan";
      },
      searching: function() {
        return "Mencari...";
      }
    }
  });

  // Event ketika item dipilih dari dropdown
  $('#itemSelect').on('select2:select', function(e) {
    const selectedOption = $(this).find(':selected');
    const optionData = selectedOption.data();

    // Isi semua field otomatis dari data option
    $('#itemCode').val(selectedOption.val());
    $('#namaBarang').val(optionData.name || '');
    $('#category').val(optionData.category || '');
    $('#uom').val(optionData.uom || '');
    $('#loc').val(optionData.loc || '');
    $('#description').val(optionData.description || '');
    $('#department').val(optionData.departmentName || '-');

    // Set stock
    currentStock = parseInt(optionData.stock) || 0;
    const minStock = parseInt(optionData.minStock) || 0;
    $('#maxStock').val(currentStock);

    // Tampilkan stock info
    updateStockDisplay(currentStock, minStock, optionData.uom);
  });

  // Reset form saat modal ditutup
  $('#modalAddItem').on('hidden.bs.modal', function() {
    resetForm();
  });

  // Reset form saat modal dibuka
  $('#modalAddItem').on('show.bs.modal', function() {
    resetForm();
  });
});

let currentStock = 0; // Menyimpan stock saat ini

// Function untuk update stock display
function updateStockDisplay(stock, minStock, uom) {
  const stockDisplay = $('#stockDisplay');
  const stockHint = $('#stockHint');
  const maxStockDisplay = $('#maxStockDisplay');
  const stockUOM = $('#stockUOM');
  const stockBadge = $('#stockBadge');
  const stockInfo = $('#stockInfo');
  const qtyInput = $('#qty');

  // Format stock dengan pemisah ribuan
  const formattedStock = stock.toLocaleString('id-ID');
  stockDisplay.text(formattedStock);
  maxStockDisplay.text(formattedStock);

  // Tampilkan UOM jika ada
  if (uom) {
    stockUOM.text(`(${uom})`);
  } else {
    stockUOM.text('');
  }

  // Tampilkan semua elemen stock info
  stockInfo.show();
  stockHint.show();
  stockBadge.show();

  // Update class alert berdasarkan stock
  if (stock <= 0) {
    // OUT OF STOCK
    stockInfo.removeClass('alert-success alert-warning').addClass('alert-danger');
    stockDisplay.text('0 (OUT OF STOCK)');
    maxStockDisplay.text('0');
    qtyInput.attr('max', 0).attr('readonly', true).attr('placeholder', 'Stock tidak tersedia');
    stockBadge.removeClass('bg-success bg-warning').addClass('bg-danger').text('OUT OF STOCK');
  } else if (stock < minStock) {
    // LOW STOCK
    stockInfo.removeClass('alert-success alert-danger').addClass('alert-warning');
    qtyInput.attr('max', stock).removeAttr('readonly').attr('placeholder', `Maksimal ${formattedStock} (Low Stock)`);
    stockBadge.removeClass('bg-success bg-danger').addClass('bg-warning text-dark').text('LOW STOCK');
  } else {
    // STOCK OK
    stockInfo.removeClass('alert-warning alert-danger').addClass('alert-success');
    qtyInput.attr('max', stock).removeAttr('readonly').attr('placeholder', `Maksimal ${formattedStock} (sesuai stock tersedia)`);
    stockBadge.removeClass('bg-warning bg-danger').addClass('bg-success').text('STOCK OK');
  }

  // Reset qty dan validasi
  qtyInput.val('').removeClass('is-invalid');
  $('#qtyError').hide();

  // Re-initialize feather icons
  if (typeof feather !== 'undefined') {
    feather.replace();
  }

  // Scroll ke stock info
  stockInfo[0].scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

// Function untuk reset form
function resetForm() {
  $('#requestItemForm')[0].reset();
  $('#itemSelect').val(null).trigger('change');
  $('#itemCode').val('');
  $('#namaBarang').val('');
  $('#category').val('');
  $('#uom').val('');
  $('#loc').val('');
  $('#description').val('');
  $('#department').val('');
  $('#noteInput').val('');
  $('#stockInfo').hide();
  $('#stockHint').hide();
  $('#stockBadge').hide();
  $('#stockUOM').text('');
  $('#maxStock').val(0);
  $('#maxStockDisplay').text('0');
  currentStock = 0;
  $('#qty').removeClass('is-invalid').removeAttr('max').removeAttr('readonly').attr('placeholder', 'Masukkan jumlah yang diminta');
  $('#qtyError').hide();
}

// Validasi QTY real-time
$('#qty').on('input', function() {
  const qty = parseInt($(this).val()) || 0;
  const maxStock = parseInt($('#maxStock').val()) || 0;
  const qtyError = $('#qtyError');

  // Validasi: QTY harus lebih dari 0
  if (qty <= 0 && $(this).val() !== '') {
    $(this).addClass('is-invalid');
    qtyError.show().text('Qty harus lebih dari 0!');
    return;
  }

  // Validasi: QTY tidak boleh melebihi stock yang tersedia
  if (qty > maxStock && maxStock > 0) {
    $(this).addClass('is-invalid');
    qtyError.show().text(`Qty tidak boleh melebihi stock yang tersedia! Stock tersedia: ${maxStock.toLocaleString('id-ID')}`);
    return;
  }

  // Jika stock 0 atau kosong
  if (maxStock <= 0) {
    $(this).addClass('is-invalid');
    qtyError.show().text('Stock tidak tersedia! Tidak dapat meminta item ini.');
    return;
  }

  // Validasi berhasil
  $(this).removeClass('is-invalid');
  qtyError.hide();
});
</script>


<script>
let items = [];

function addItem() {
    const itemCode = document.getElementById('itemCode').value.trim();
    const namaBarang = document.getElementById('namaBarang').value;
    const loc = document.getElementById('loc').value;
    const qty = parseInt(document.getElementById('qty').value) || 0;
    const uom = document.getElementById('uom').value;
    const note = document.getElementById('noteInput').value.trim();
    const maxStock = parseInt(document.getElementById("maxStock").value) || 0;

    // Validasi wajib
    if (!itemCode || !qty) {
        alert("Item Code dan Qty wajib diisi!");
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
        alert(`Qty tidak boleh melebihi stock yang tersedia!\n\nStock tersedia: ${maxStock.toLocaleString('id-ID')}\nQty yang diminta: ${qty.toLocaleString('id-ID')}\n\nSilakan kurangi qty yang diminta.`);
        document.getElementById('qty').focus();
        document.getElementById('qty').classList.add('is-invalid');
        document.getElementById('qtyError').style.display = 'block';
        document.getElementById('qtyError').textContent = `Qty tidak boleh melebihi stock yang tersedia! Stock tersedia: ${maxStock.toLocaleString('id-ID')}`;
        return;
    }
    
    // Validasi jika stock 0 atau tidak tersedia
    if (maxStock <= 0) {
        alert(`Stock tidak tersedia untuk item ini!\n\nStock tersedia: 0\n\nTidak dapat meminta item dengan stock 0.`);
        document.getElementById('qty').focus();
        return;
    }

    // Cek apakah item code sudah ada di items (duplikasi)
    const existingItem = items.find(item => item.code === itemCode);
    if (existingItem) {
        if (!confirm(`Item ${itemCode} sudah ada dalam daftar. Apakah Anda ingin menggantinya?`)) {
            return;
        }
        // Hapus item lama
        items = items.filter(item => item.code !== itemCode);
    }

    let item = {
        code: itemCode,
        nama: namaBarang,
        loc: loc,
        qty: qty,
        uom: uom,
        note: note
    };

    items.push(item);
    document.getElementById('itemsInput').value = JSON.stringify(items);

    updateTable();

    // Reset form
    document.getElementById('requestItemForm').reset();
    document.getElementById("stockInfo").style.display = 'none';
    document.getElementById("stockHint").style.display = 'none';
    document.getElementById("maxStock").value = 0;
    document.getElementById("maxStockDisplay").textContent = '0';
    currentStock = 0;
    document.getElementById('qty').classList.remove('is-invalid');
    document.getElementById('qtyError').style.display = 'none';
    document.getElementById('qty').removeAttribute('readonly');
    document.getElementById('qty').removeAttribute('max');
    
    // Re-initialize feather icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }

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
                <td>${item.note || '-'}</td>
                <td>
                    <button class="btn btn-sm btn-danger" onclick="removeItem(${i})">
                        <i data-feather="trash-2"></i> Hapus
                    </button>
                </td>
            </tr>
        `);
    });
    
    // Re-initialize feather icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
}

function removeItem(index) {
    if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
        items.splice(index, 1);
        document.getElementById('itemsInput').value = JSON.stringify(items);
        updateTable();
    }
}
</script>
@endpush
