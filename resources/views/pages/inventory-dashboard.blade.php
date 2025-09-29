@extends('layouts.app')

@section('title', 'Inventory Dashboard')

@section('content')
<div class="container-fluid">
  <!-- Header Section -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <h2 class="fw-bold text-primary mb-1">Inventory Dashboard</h2>
          <p class="text-muted mb-0">Data Inventory Consumable & Sparepart 2025</p>
        </div>
        <div class="d-flex gap-2">
          <button class="btn btn-outline-primary" onclick="exportToExcel()">
            <i data-feather="download"></i> Export Excel
          </button>
          <button class="btn btn-primary" onclick="refreshData()">
            <i data-feather="refresh-cw"></i> Refresh
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Summary Cards -->
  <div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-3">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Items</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalItems">0</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-boxes fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-3">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total GR September</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalGR">0</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-arrow-down fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-3">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total GI September</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalGI">0</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-arrow-up fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-3">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Ending Balance</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalBalance">0</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-balance-scale fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Filters Section -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-3 mb-3">
              <label class="form-label fw-bold">Search Item</label>
              <input type="text" class="form-control" id="searchItem" placeholder="Search by Item Code or Description">
            </div>
            <div class="col-md-2 mb-3">
              <label class="form-label fw-bold">UOM</label>
              <select class="form-select" id="filterUOM">
                <option value="">All UOM</option>
                <option value="Pcs">Pcs</option>
                <option value="Ltr">Ltr</option>
                <option value="CAN">CAN</option>
                <option value="DRUM">DRUM</option>
                <option value="GALON">GALON</option>
                <option value="Pail">Pail</option>
                <option value="BTL">BTL</option>
              </select>
            </div>
            <div class="col-md-2 mb-3">
              <label class="form-label fw-bold">Location</label>
              <select class="form-select" id="filterLocation">
                <option value="">All Locations</option>
                <option value="D-5-1(A.1)">D-5-1(A.1)</option>
                <option value="OIL AREA">OIL AREA</option>
                <option value="D-1-4 (E.2)">D-1-4 (E.2)</option>
                <option value="E-2-4 (C.1)">E-2-4 (C.1)</option>
              </select>
            </div>
            <div class="col-md-2 mb-3">
              <label class="form-label fw-bold">User/Dept</label>
              <select class="form-select" id="filterUser">
                <option value="">All Users</option>
                <option value="PPIC">PPIC</option>
                <option value="QC">QC</option>
                <option value="DIES SHOP">DIES SHOP</option>
                <option value="PRODUCTION">PRODUCTION</option>
                <option value="QA">QA</option>
                <option value="Maintenance">Maintenance</option>
              </select>
            </div>
            <div class="col-md-3 mb-3 d-flex align-items-end">
              <button class="btn btn-outline-secondary me-2" onclick="clearFilters()">
                <i data-feather="x"></i> Clear
              </button>
              <button class="btn btn-primary" onclick="applyFilters()">
                <i data-feather="search"></i> Filter
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Inventory Table -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0 fw-bold">
            <i data-feather="database"></i> Data Inventory Consumable & Sparepart 2025
          </h5>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0" id="inventoryTable">
              <thead class="table-light">
                <tr>
                  <th class="text-center fw-bold" style="width: 5%;">NO.</th>
                  <th class="fw-bold" style="width: 15%;">Item Code</th>
                  <th class="fw-bold" style="width: 25%;">Description</th>
                  <th class="text-center fw-bold" style="width: 8%;">UOM</th>
                  <th class="fw-bold" style="width: 12%;">LOC</th>
                  <th class="fw-bold" style="width: 10%;">USER</th>
                  <th class="text-center fw-bold" style="width: 10%;">Total GR<br>September</th>
                  <th class="text-center fw-bold" style="width: 10%;">GI<br>September</th>
                  <th class="text-center fw-bold" style="width: 10%;">Ending Balance<br>September</th>
                </tr>
              </thead>
              <tbody id="inventoryTableBody">
                <!-- Data akan diisi melalui JavaScript -->
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer">
          <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted">
              Showing <span id="showingCount">0</span> of <span id="totalCount">0</span> items
            </div>
            <nav>
              <ul class="pagination pagination-sm mb-0" id="pagination">
                <!-- Pagination akan diisi melalui JavaScript -->
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.border-left-primary {
  border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
  border-left: 0.25rem solid #1cc88a !important;
}
.border-left-warning {
  border-left: 0.25rem solid #f6c23e !important;
}
.border-left-info {
  border-left: 0.25rem solid #36b9cc !important;
}

.table th {
  background-color: #f8f9fc !important;
  border-bottom: 2px solid #e3e6f0 !important;
  font-size: 0.85rem;
  padding: 0.75rem;
}

.table td {
  padding: 0.75rem;
  vertical-align: middle;
  border-bottom: 1px solid #e3e6f0;
}

.table-hover tbody tr:hover {
  background-color: #f8f9fc;
}

.text-xs {
  font-size: 0.7rem;
}

.text-gray-800 {
  color: #5a5c69 !important;
}

.text-gray-300 {
  color: #dddfeb !important;
}

.card {
  box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
}

.btn {
  border-radius: 0.35rem;
}

.form-control, .form-select {
  border-radius: 0.35rem;
}

.pagination {
  border-radius: 0.35rem;
}

.page-link {
  border-radius: 0.35rem;
  margin: 0 0.125rem;
}

/* Status indicators */
.status-positive {
  color: #1cc88a;
  font-weight: bold;
}

.status-negative {
  color: #e74a3b;
  font-weight: bold;
}

.status-zero {
  color: #6c757d;
  font-weight: bold;
}
</style>

<script>
// Sample data berdasarkan gambar
const inventoryData = [
  {
    no: 1,
    itemCode: 'SBM-001-002-0000002',
    description: 'ZERUST YELLOW FERROUS VCI FILM SHEET',
    uom: 'Pcs',
    loc: 'D-5-1(A.1)',
    user: 'PPIC',
    totalGR: 0,
    gi: 0,
    endingBalance: '-'
  },
  {
    no: 2,
    itemCode: 'SBM-001-003-0000001',
    description: 'ANTI-RUST OIL TBS-3215',
    uom: 'Ltr',
    loc: 'OIL AREA',
    user: 'QC',
    totalGR: 0,
    gi: 0,
    endingBalance: '-'
  },
  {
    no: 3,
    itemCode: 'SBM-001-004-0000001',
    description: 'LITHIUM GREASE EP.O',
    uom: 'CAN',
    loc: 'D-1-4 (E.2)',
    user: 'DIES SHOP',
    totalGR: 0,
    gi: 0,
    endingBalance: '-'
  },
  {
    no: 4,
    itemCode: 'SBM-001-005-0000001',
    description: 'DESICANT SUNDRY II 60 GRAM',
    uom: 'Pcs',
    loc: 'D-5-1(A.1)',
    user: 'PPIC',
    totalGR: 2640,
    gi: 3210,
    endingBalance: 710
  },
  {
    no: 5,
    itemCode: 'SBM-001-006-0000001',
    description: 'W-4C ANTI CORROSIVE (18 L/CAN)',
    uom: 'CAN',
    loc: 'OIL AREA',
    user: 'QC',
    totalGR: 2,
    gi: 3,
    endingBalance: 7
  },
  {
    no: 6,
    itemCode: 'SBM-001-007-0000001',
    description: 'SOLAR',
    uom: 'Ltr',
    loc: 'D-1-4 (E.2)',
    user: 'PRODUCTION',
    totalGR: 5000,
    gi: 2945,
    endingBalance: 5668
  },
  {
    no: 7,
    itemCode: 'SBM-001-008-0000001',
    description: 'CUTTING OIL',
    uom: 'DRUM',
    loc: 'E-2-4 (C.1)',
    user: 'DIES SHOP',
    totalGR: 0,
    gi: 0,
    endingBalance: '-'
  },
  {
    no: 8,
    itemCode: 'SBM-001-009-0000001',
    description: 'HYDRAULIC OIL',
    uom: 'GALON',
    loc: 'OIL AREA',
    user: 'Maintenance',
    totalGR: 0,
    gi: 0,
    endingBalance: '-'
  },
  {
    no: 9,
    itemCode: 'SBM-001-010-0000001',
    description: 'CLEANING SOLVENT',
    uom: 'Pail',
    loc: 'D-5-1(A.1)',
    user: 'QA',
    totalGR: 0,
    gi: 0,
    endingBalance: '-'
  },
  {
    no: 10,
    itemCode: 'SBM-001-011-0000001',
    description: 'LUBRICATING OIL',
    uom: 'BTL',
    loc: 'D-1-4 (E.2)',
    user: 'Maintenance',
    totalGR: 0,
    gi: 0,
    endingBalance: '-'
  }
];

let filteredData = [...inventoryData];
let currentPage = 1;
const itemsPerPage = 10;

// Initialize dashboard
document.addEventListener('DOMContentLoaded', function() {
  updateSummaryCards();
  renderTable();
  setupEventListeners();
  
  // Initialize feather icons
  if (typeof feather !== 'undefined') {
    feather.replace();
  }
});

function updateSummaryCards() {
  const totalItems = inventoryData.length;
  const totalGR = inventoryData.reduce((sum, item) => sum + (item.totalGR || 0), 0);
  const totalGI = inventoryData.reduce((sum, item) => sum + (item.gi || 0), 0);
  const totalBalance = inventoryData.reduce((sum, item) => {
    if (item.endingBalance === '-' || item.endingBalance === 0) return sum;
    return sum + item.endingBalance;
  }, 0);

  document.getElementById('totalItems').textContent = totalItems.toLocaleString();
  document.getElementById('totalGR').textContent = totalGR.toLocaleString();
  document.getElementById('totalGI').textContent = totalGI.toLocaleString();
  document.getElementById('totalBalance').textContent = totalBalance.toLocaleString();
}

function renderTable() {
  const tbody = document.getElementById('inventoryTableBody');
  const startIndex = (currentPage - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const pageData = filteredData.slice(startIndex, endIndex);

  tbody.innerHTML = '';

  pageData.forEach((item, index) => {
    const row = document.createElement('tr');
    
    // Format ending balance
    let endingBalanceClass = 'status-zero';
    let endingBalanceText = item.endingBalance;
    
    if (item.endingBalance !== '-' && item.endingBalance > 0) {
      endingBalanceClass = 'status-positive';
      endingBalanceText = item.endingBalance.toLocaleString();
    } else if (item.endingBalance === 0) {
      endingBalanceClass = 'status-zero';
      endingBalanceText = '0';
    }

    row.innerHTML = `
      <td class="text-center fw-bold">${startIndex + index + 1}</td>
      <td><code class="text-primary">${item.itemCode}</code></td>
      <td>${item.description}</td>
      <td class="text-center"><span class="badge bg-secondary">${item.uom}</span></td>
      <td><span class="badge bg-info">${item.loc}</span></td>
      <td><span class="badge bg-warning">${item.user}</span></td>
      <td class="text-center">${item.totalGR.toLocaleString()}</td>
      <td class="text-center">${item.gi.toLocaleString()}</td>
      <td class="text-center ${endingBalanceClass}">${endingBalanceText}</td>
    `;
    
    tbody.appendChild(row);
  });

  updatePagination();
  updateCounts();
}

function updatePagination() {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  const pagination = document.getElementById('pagination');
  
  pagination.innerHTML = '';

  // Previous button
  const prevLi = document.createElement('li');
  prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
  prevLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${currentPage - 1})">Previous</a>`;
  pagination.appendChild(prevLi);

  // Page numbers
  for (let i = 1; i <= totalPages; i++) {
    const li = document.createElement('li');
    li.className = `page-item ${i === currentPage ? 'active' : ''}`;
    li.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>`;
    pagination.appendChild(li);
  }

  // Next button
  const nextLi = document.createElement('li');
  nextLi.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
  nextLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${currentPage + 1})">Next</a>`;
  pagination.appendChild(nextLi);
}

function updateCounts() {
  const startIndex = (currentPage - 1) * itemsPerPage + 1;
  const endIndex = Math.min(currentPage * itemsPerPage, filteredData.length);
  
  document.getElementById('showingCount').textContent = filteredData.length > 0 ? startIndex : 0;
  document.getElementById('totalCount').textContent = filteredData.length;
}

function changePage(page) {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  if (page >= 1 && page <= totalPages) {
    currentPage = page;
    renderTable();
  }
}

function setupEventListeners() {
  document.getElementById('searchItem').addEventListener('input', applyFilters);
  document.getElementById('filterUOM').addEventListener('change', applyFilters);
  document.getElementById('filterLocation').addEventListener('change', applyFilters);
  document.getElementById('filterUser').addEventListener('change', applyFilters);
}

function applyFilters() {
  const searchTerm = document.getElementById('searchItem').value.toLowerCase();
  const uomFilter = document.getElementById('filterUOM').value;
  const locationFilter = document.getElementById('filterLocation').value;
  const userFilter = document.getElementById('filterUser').value;

  filteredData = inventoryData.filter(item => {
    const matchesSearch = !searchTerm || 
      item.itemCode.toLowerCase().includes(searchTerm) ||
      item.description.toLowerCase().includes(searchTerm);
    
    const matchesUOM = !uomFilter || item.uom === uomFilter;
    const matchesLocation = !locationFilter || item.loc === locationFilter;
    const matchesUser = !userFilter || item.user === userFilter;

    return matchesSearch && matchesUOM && matchesLocation && matchesUser;
  });

  currentPage = 1;
  renderTable();
}

function clearFilters() {
  document.getElementById('searchItem').value = '';
  document.getElementById('filterUOM').value = '';
  document.getElementById('filterLocation').value = '';
  document.getElementById('filterUser').value = '';
  
  filteredData = [...inventoryData];
  currentPage = 1;
  renderTable();
}

function refreshData() {
  // Simulate data refresh
  console.log('Refreshing data...');
  applyFilters();
  
  // Show success message
  const btn = event.target.closest('button');
  const originalText = btn.innerHTML;
  btn.innerHTML = '<i data-feather="check"></i> Refreshed';
  btn.classList.remove('btn-primary');
  btn.classList.add('btn-success');
  
  setTimeout(() => {
    btn.innerHTML = originalText;
    btn.classList.remove('btn-success');
    btn.classList.add('btn-primary');
    feather.replace();
  }, 2000);
}

function exportToExcel() {
  // Simple CSV export
  const csvContent = [
    ['NO', 'Item Code', 'Description', 'UOM', 'LOC', 'USER', 'Total GR September', 'GI September', 'Ending Balance September'],
    ...filteredData.map(item => [
      item.no,
      item.itemCode,
      item.description,
      item.uom,
      item.loc,
      item.user,
      item.totalGR,
      item.gi,
      item.endingBalance
    ])
  ].map(row => row.join(',')).join('\n');

  const blob = new Blob([csvContent], { type: 'text/csv' });
  const url = window.URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = `inventory_data_${new Date().toISOString().split('T')[0]}.csv`;
  a.click();
  window.URL.revokeObjectURL(url);
}
</script>
@endsection
