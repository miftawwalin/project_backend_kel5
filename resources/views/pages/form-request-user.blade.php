@extends('layouts.app')

@section('title', 'Form Request Barang Warehouse Consumable')

@section('content')
<div class="container-fluid">
  <!-- Company Header -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between p-3" style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
        <div class="d-flex align-items-center">
          <!-- Company Logo -->
          <div class="me-4">
            <img src="{{ asset('assets/images/mai.png') }}" alt="PT. METALART ASTRA INDONESIA Logo" style="width: 120px; height: auto; object-fit: contain;">
          </div>
          <!-- Company Info -->
          <div class="flex-grow-1">
            <p class="mb-1 small text-primary fw-semibold">To the infinite development and harmony of the technology and human being</p>
            <h4 class="mb-2 fw-bold text-dark">PT. METALART ASTRA INDONESIA</h4>
            <p class="mb-1 small text-muted">Kawasan Industri KIIC, Jl. Harapan III Lot-JJ2A, Desa Sirnabaya, Kecamatan Teluk Jambe Timur, Karawang 41631 Jawa Barat</p>
            <p class="mb-0 small text-muted">Telp : (021) 2936 9960, (0267) 78639862 | Fax : (021) 29369965</p>
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
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label fw-bold">PRODUK :</label>
              <input type="text" class="form-control text-center" placeholder="(P1- )" style="border: 2px solid #28a745;">
            </div>
          </div>
        </div>

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
              </tr>
            </thead>
            <tbody id="requestTableBody">
              <tr>
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
      </div>
    </div>
  </div>
</div>

<!-- PRODUKSI Modal -->
<div class="modal fade" id="produksiModal" tabindex="-1" aria-labelledby="produksiModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="produksiModalLabel">Pilih PRODUKSI</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="list-group">
          <button type="button" class="list-group-item list-group-item-action" onclick="selectProduksi('PRODUKSI - 4500 TAP')">
            PRODUKSI - 4500 TAP
          </button>
          <button type="button" class="list-group-item list-group-item-action" onclick="selectProduksi('PRODUKSI - 2500 TAP')">
            PRODUKSI - 2500 TAP
          </button>
          <button type="button" class="list-group-item list-group-item-action" onclick="selectProduksi('PRODUKSI - 2000 TAP')">
            PRODUKSI - 2000 TAP
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
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

function addRow() {
  rowCounter++;
  const tableBody = document.getElementById('requestTableBody');
  const newRow = document.createElement('tr');
  
  newRow.innerHTML = `
    <td class="text-center fw-bold" style="border: 1px solid #000;">${rowCounter}</td>
    <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Item Code"></td>
    <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="Nama Barang"></td>
    <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="LOC"></td>
    <td style="border: 1px solid #000;"><input type="number" class="form-control border-0" placeholder="Qty"></td>
    <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="UOM"></td>
    <td style="border: 1px solid #000;"><input type="text" class="form-control border-0" placeholder="NPK / Nama"></td>
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
  text-align: center;
}

.table td input.form-control.border-0:focus {
  background: #f8f9fa;
  border: 1px solid #86b7fe !important;
}

.table th {
  background-color: white !important;
  font-weight: 600;
  text-align: center;
  vertical-align: middle;
  border: 2px solid #000 !important;
}

.table td {
  vertical-align: middle;
  text-align: center;
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
}
</style>
@endsection
