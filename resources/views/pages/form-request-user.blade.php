@extends('layouts.app')

<<<<<<< HEAD
@section('title', 'Form Request Barang Warehouse Consumable')

@section('content')
<div class="container-fluid">
  <!-- Company Header -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between p-3" style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
        <div class="d-flex align-items-center">
          <!-- Company Logo -->
          <div class="me-3">
            <div style="width: 60px; height: 60px; background: linear-gradient(45deg, #007bff, #dc3545); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 24px;">
              M
            </div>
          </div>
          <!-- Company Info -->
          <div>
            <h5 class="mb-1 fw-bold">PT. METALART ASTRA INDONESIA</h5>
            <p class="mb-0 small text-muted">To the white hope and harmony of the technology and human being</p>
            <p class="mb-0 small">Kawasan Industri KIIC, Jl. Harapan Raya Lot GG-1, Desa Walahar, Kecamatan Klari, Karawang 41371, Jawa Barat</p>
            <p class="mb-0 small">Phone: (021) 123-4567 | Fax: (021) 123-4568</p>
          </div>
        </div>
        <!-- PRODUKSI Section -->
        <div>
          <button type="button" class="btn btn-warning fw-bold px-4 py-2" data-bs-toggle="modal" data-bs-target="#produksiModal" id="produksiButton">
            PRODUKSI - 4500 TAP
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Form Title -->
  <div class="row mb-4">
    <div class="col-12 text-center">
      <h3 class="fw-bold text-decoration-underline">FORM REQUEST BARANG WAREHOUSE CONSUMABLE</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
        <!-- Request Details Section -->
        <div class="row mb-4">
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label fw-bold">TANGGAL :</label>
              <input type="date" class="form-control" style="border: 2px solid #28a745;">
=======
@section('title', 'Form Request User')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Form Request User</h4>
  </div>
  <div class="d-flex align-items-center flex-wrap text-nowrap">
    <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="printer"></i>
      Print
    </button>
    <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="download-cloud"></i>
      Export
    </button>
  </div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <!-- Header Form -->
        <div class="row mb-4">
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label fw-bold">NO:</label>
              <input type="text" class="form-control" placeholder="Enter number">
>>>>>>> 706271487a356ff15070414545f9e0d7013be69b
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
<<<<<<< HEAD
              <label class="form-label fw-bold">PRODUK :</label>
              <input type="text" class="form-control text-center" placeholder="(P1- )" style="border: 2px solid #28a745;">
=======
              <label class="form-label fw-bold">DATE:</label>
              <input type="date" class="form-control">
>>>>>>> 706271487a356ff15070414545f9e0d7013be69b
            </div>
          </div>
        </div>

<<<<<<< HEAD
        <!-- Item Request Table -->
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead style="background-color: white;">
              <tr>
                <th class="text-center fw-bold" style="width: 8%; border: 2px solid #000;">NO.</th>
                <th class="text-center fw-bold" style="width: 15%; border: 2px solid #000;">ITEM CODE</th>
                <th class="text-center fw-bold" style="width: 25%; border: 2px solid #000;">NAMA BARANG</th>
                <th class="text-center fw-bold" style="width: 10%; border: 2px solid #000;">LOC</th>
                <th class="text-center fw-bold" style="width: 10%; border: 2px solid #000;">QTY</th>
                <th class="text-center fw-bold" style="width: 10%; border: 2px solid #000;">UOM</th>
                <th class="text-center fw-bold" style="width: 22%; border: 2px solid #000;">NPK / NAMA</th>
=======
        <div class="row mb-4">
          <div class="col-md-12">
            <div class="mb-3">
              <label class="form-label fw-bold">TO:</label>
              <input type="text" class="form-control" placeholder="Recipient">
            </div>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-12">
            <div class="mb-3">
              <label class="form-label fw-bold">FROM:</label>
              <input type="text" class="form-control" placeholder="Sender">
            </div>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-12">
            <div class="mb-3">
              <label class="form-label fw-bold">SUBJECT:</label>
              <input type="text" class="form-control" placeholder="Subject">
            </div>
          </div>
        </div>

        <!-- Table Form -->
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead class="table-light">
              <tr>
                <th style="width: 5%">NO</th>
                <th style="width: 25%">MATERIAL</th>
                <th style="width: 15%">QUANTITY</th>
                <th style="width: 15%">UNIT</th>
                <th style="width: 20%">QUALITY</th>
                <th style="width: 20%">REMARK</th>
>>>>>>> 706271487a356ff15070414545f9e0d7013be69b
              </tr>
            </thead>
            <tbody id="requestTableBody">
              <tr>
<<<<<<< HEAD
                <td class="text-center fw-bold" style="border: 1px solid #000;">1</td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Item Code"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Nama Barang"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="LOC"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control border-0" placeholder="Qty"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="UOM"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="NPK / Nama"></td>
              </tr>
              <tr>
                <td class="text-center fw-bold" style="border: 1px solid #000;">2</td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Item Code"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Nama Barang"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="LOC"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control border-0" placeholder="Qty"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="UOM"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="NPK / Nama"></td>
              </tr>
              <tr>
                <td class="text-center fw-bold" style="border: 1px solid #000;">3</td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Item Code"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Nama Barang"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="LOC"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control border-0" placeholder="Qty"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="UOM"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="NPK / Nama"></td>
              </tr>
              <tr>
                <td class="text-center fw-bold" style="border: 1px solid #000;">4</td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Item Code"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Nama Barang"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="LOC"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control border-0" placeholder="Qty"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="UOM"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="NPK / Nama"></td>
              </tr>
              <tr>
                <td class="text-center fw-bold" style="border: 1px solid #000;">5</td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Item Code"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Nama Barang"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="LOC"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control border-0" placeholder="Qty"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="UOM"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="NPK / Nama"></td>
              </tr>
              <tr>
                <td class="text-center fw-bold" style="border: 1px solid #000;">6</td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Item Code"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Nama Barang"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="LOC"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control border-0" placeholder="Qty"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="UOM"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="NPK / Nama"></td>
              </tr>
              <tr>
                <td class="text-center fw-bold" style="border: 1px solid #000;">7</td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Item Code"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Nama Barang"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="LOC"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control border-0" placeholder="Qty"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="UOM"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="NPK / Nama"></td>
              </tr>
              <tr>
                <td class="text-center fw-bold" style="border: 1px solid #000;">8</td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Item Code"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Nama Barang"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="LOC"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control border-0" placeholder="Qty"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="UOM"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="NPK / Nama"></td>
              </tr>
              <tr>
                <td class="text-center fw-bold" style="border: 1px solid #000;">9</td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Item Code"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Nama Barang"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="LOC"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control border-0" placeholder="Qty"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="UOM"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="NPK / Nama"></td>
              </tr>
              <tr>
                <td class="text-center fw-bold" style="border: 1px solid #000;">10</td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Item Code"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Nama Barang"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="LOC"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control border-0" placeholder="Qty"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="UOM"></td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="NPK / Nama"></td>
=======
                <td>1</td>
                <td><input type="text" class="form-control border-0" placeholder="Enter material"></td>
                <td><input type="number" class="form-control border-0" placeholder="Qty"></td>
                <td><input type="text" class="form-control border-0" placeholder="Unit"></td>
                <td>
                  <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#qualityModal">
                    QUALITY - 4500 TAP
                  </button>
                  <input type="hidden" name="quality[]" value="">
                </td>
                <td><input type="text" class="form-control border-0" placeholder="Remark"></td>
              </tr>
              <tr>
                <td>2</td>
                <td><input type="text" class="form-control border-0" placeholder="Enter material"></td>
                <td><input type="number" class="form-control border-0" placeholder="Qty"></td>
                <td><input type="text" class="form-control border-0" placeholder="Unit"></td>
                <td>
                  <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#qualityModal">
                    QUALITY - 4500 TAP
                  </button>
                  <input type="hidden" name="quality[]" value="">
                </td>
                <td><input type="text" class="form-control border-0" placeholder="Remark"></td>
              </tr>
              <tr>
                <td>3</td>
                <td><input type="text" class="form-control border-0" placeholder="Enter material"></td>
                <td><input type="number" class="form-control border-0" placeholder="Qty"></td>
                <td><input type="text" class="form-control border-0" placeholder="Unit"></td>
                <td>
                  <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#qualityModal">
                    QUALITY - 4500 TAP
                  </button>
                  <input type="hidden" name="quality[]" value="">
                </td>
                <td><input type="text" class="form-control border-0" placeholder="Remark"></td>
              </tr>
              <tr>
                <td>4</td>
                <td><input type="text" class="form-control border-0" placeholder="Enter material"></td>
                <td><input type="number" class="form-control border-0" placeholder="Qty"></td>
                <td><input type="text" class="form-control border-0" placeholder="Unit"></td>
                <td>
                  <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#qualityModal">
                    QUALITY - 4500 TAP
                  </button>
                  <input type="hidden" name="quality[]" value="">
                </td>
                <td><input type="text" class="form-control border-0" placeholder="Remark"></td>
              </tr>
              <tr>
                <td>5</td>
                <td><input type="text" class="form-control border-0" placeholder="Enter material"></td>
                <td><input type="number" class="form-control border-0" placeholder="Qty"></td>
                <td><input type="text" class="form-control border-0" placeholder="Unit"></td>
                <td>
                  <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#qualityModal">
                    QUALITY - 4500 TAP
                  </button>
                  <input type="hidden" name="quality[]" value="">
                </td>
                <td><input type="text" class="form-control border-0" placeholder="Remark"></td>
>>>>>>> 706271487a356ff15070414545f9e0d7013be69b
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Add Row Button -->
        <div class="mb-3">
          <button type="button" class="btn btn-outline-secondary" onclick="addRow()">
            <i data-feather="plus"></i> Add Row
          </button>
        </div>

        <!-- Signature Section -->
        <div class="row mt-4">
          <div class="col-md-4">
            <div class="text-center border p-3">
              <p class="mb-1 fw-bold">REQUESTED BY:</p>
              <div style="height: 80px;"></div>
              <hr>
              <p class="mb-0">Name & Signature</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="text-center border p-3">
              <p class="mb-1 fw-bold">APPROVED BY:</p>
              <div style="height: 80px;"></div>
              <hr>
              <p class="mb-0">Name & Signature</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="text-center border p-3">
              <p class="mb-1 fw-bold">RECEIVED BY:</p>
              <div style="height: 80px;"></div>
              <hr>
              <p class="mb-0">Name & Signature</p>
            </div>
          </div>
        </div>

        <!-- Submit Buttons -->
        <div class="mt-4">
          <button type="submit" class="btn btn-primary me-2">Submit Request</button>
          <button type="button" class="btn btn-secondary">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>

<<<<<<< HEAD
<!-- PRODUKSI Modal -->
<div class="modal fade" id="produksiModal" tabindex="-1" aria-labelledby="produksiModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="produksiModalLabel">Pilih PRODUKSI</h5>
=======
<!-- Quality Modal -->
<div class="modal fade" id="qualityModal" tabindex="-1" aria-labelledby="qualityModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="qualityModalLabel">Select Quality</h5>
>>>>>>> 706271487a356ff15070414545f9e0d7013be69b
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="list-group">
<<<<<<< HEAD
          <button type="button" class="list-group-item list-group-item-action" onclick="selectProduksi('PRODUKSI - 4500 TAP')">
            PRODUKSI - 4500 TAP
          </button>
          <button type="button" class="list-group-item list-group-item-action" onclick="selectProduksi('PRODUKSI - 2500 TAP')">
            PRODUKSI - 2500 TAP
          </button>
          <button type="button" class="list-group-item list-group-item-action" onclick="selectProduksi('PRODUKSI - 2000 TAP')">
            PRODUKSI - 2000 TAP
=======
          <button type="button" class="list-group-item list-group-item-action" onclick="selectQuality('QUALITY - 4500 TAP')">
            QUALITY - 4500 TAP
          </button>
          <button type="button" class="list-group-item list-group-item-action" onclick="selectQuality('QUALITY - 2500 TAP')">
            QUALITY - 2500 TAP
          </button>
          <button type="button" class="list-group-item list-group-item-action" onclick="selectQuality('QUALITY - 2000 TAP')">
            QUALITY - 2000 TAP
>>>>>>> 706271487a356ff15070414545f9e0d7013be69b
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
<<<<<<< HEAD
let rowCounter = 10;

function selectProduksi(produksi) {
  const produksiButton = document.getElementById('produksiButton');
  if (produksiButton) {
    produksiButton.textContent = produksi;
  }
  
  // Close modal
  const modal = bootstrap.Modal.getInstance(document.getElementById('produksiModal'));
  modal.hide();
}

=======
let currentQualityButton = null;
let rowCounter = 5;

function selectQuality(quality) {
  if (currentQualityButton) {
    currentQualityButton.textContent = quality;
    currentQualityButton.nextElementSibling.value = quality;
  }
  
  // Close modal
  const modal = bootstrap.Modal.getInstance(document.getElementById('qualityModal'));
  modal.hide();
}

// Handle quality button clicks
document.addEventListener('click', function(e) {
  if (e.target.classList.contains('btn-outline-primary') && e.target.textContent.includes('QUALITY')) {
    currentQualityButton = e.target;
  }
});

>>>>>>> 706271487a356ff15070414545f9e0d7013be69b
function addRow() {
  rowCounter++;
  const tableBody = document.getElementById('requestTableBody');
  const newRow = document.createElement('tr');
  
  newRow.innerHTML = `
<<<<<<< HEAD
    <td class="text-center fw-bold" style="border: 1px solid #000;">${rowCounter}</td>
    <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Item Code"></td>
    <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Nama Barang"></td>
    <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="LOC"></td>
    <td style="border: 1px solid #000;"><input type="number" class="form-control border-0" placeholder="Qty"></td>
    <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="UOM"></td>
    <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="NPK / Nama"></td>
=======
    <td>${rowCounter}</td>
    <td><input type="text" class="form-control border-0" placeholder="Enter material"></td>
    <td><input type="number" class="form-control border-0" placeholder="Qty"></td>
    <td><input type="text" class="form-control border-0" placeholder="Unit"></td>
    <td>
      <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#qualityModal">
        QUALITY - 4500 TAP
      </button>
      <input type="hidden" name="quality[]" value="">
    </td>
    <td><input type="text" class="form-control border-0" placeholder="Remark"></td>
>>>>>>> 706271487a356ff15070414545f9e0d7013be69b
  `;
  
  tableBody.appendChild(newRow);
  
  // Re-initialize feather icons
  if (typeof feather !== 'undefined') {
    feather.replace();
  }
}
</script>

<style>
.table td input.form-control.border-0 {
  background: transparent;
  border: none !important;
  box-shadow: none !important;
  padding: 0.375rem 0.5rem;
<<<<<<< HEAD
  text-align: center;
=======
>>>>>>> 706271487a356ff15070414545f9e0d7013be69b
}

.table td input.form-control.border-0:focus {
  background: #f8f9fa;
  border: 1px solid #86b7fe !important;
}

.table th {
<<<<<<< HEAD
  background-color: white !important;
  font-weight: 600;
  text-align: center;
  vertical-align: middle;
  border: 2px solid #000 !important;
=======
  background-color: #f8f9fa !important;
  font-weight: 600;
  text-align: center;
  vertical-align: middle;
>>>>>>> 706271487a356ff15070414545f9e0d7013be69b
}

.table td {
  vertical-align: middle;
  text-align: center;
<<<<<<< HEAD
  border: 1px solid #000 !important;
}

.table {
  border-collapse: collapse;
}

.table tbody tr:hover {
  background-color: #f8f9fa;
}

/* Company header styling */
.company-header {
  background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
  border: 2px solid #dee2e6;
  border-radius: 8px;
}

/* Form title styling */
.form-title {
  color: #212529;
  font-size: 1.75rem;
  margin: 2rem 0;
}

/* Input field styling */
.form-control {
  border-radius: 4px;
}

.form-control:focus {
  border-color: #28a745;
  box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

/* Button styling */
.btn-warning {
  background-color: #ffc107;
  border-color: #ffc107;
  color: #212529;
  font-weight: bold;
}

.btn-warning:hover {
  background-color: #e0a800;
  border-color: #d39e00;
  color: #212529;
}

/* Modal styling */
.modal-content {
  border-radius: 8px;
  border: none;
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.list-group-item {
  border: 1px solid #dee2e6;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
}

.list-group-item:hover {
  background-color: #f8f9fa;
  border-color: #007bff;
}

.list-group-item:first-child {
  border-top-left-radius: 0.375rem;
  border-top-right-radius: 0.375rem;
}

.list-group-item:last-child {
  border-bottom-left-radius: 0.375rem;
  border-bottom-right-radius: 0.375rem;
=======
}

.signature-box {
  min-height: 120px;
  border: 1px solid #dee2e6;
>>>>>>> 706271487a356ff15070414545f9e0d7013be69b
}
</style>
@endsection
