@extends('layouts.app')

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
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label fw-bold">DATE:</label>
              <input type="date" class="form-control">
            </div>
          </div>
        </div>

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
              </tr>
            </thead>
            <tbody id="requestTableBody">
              <tr>
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

<!-- Quality Modal -->
<div class="modal fade" id="qualityModal" tabindex="-1" aria-labelledby="qualityModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="qualityModalLabel">Select Quality</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="list-group">
          <button type="button" class="list-group-item list-group-item-action" onclick="selectQuality('QUALITY - 4500 TAP')">
            QUALITY - 4500 TAP
          </button>
          <button type="button" class="list-group-item list-group-item-action" onclick="selectQuality('QUALITY - 2500 TAP')">
            QUALITY - 2500 TAP
          </button>
          <button type="button" class="list-group-item list-group-item-action" onclick="selectQuality('QUALITY - 2000 TAP')">
            QUALITY - 2000 TAP
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
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

function addRow() {
  rowCounter++;
  const tableBody = document.getElementById('requestTableBody');
  const newRow = document.createElement('tr');
  
  newRow.innerHTML = `
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
}

.table td input.form-control.border-0:focus {
  background: #f8f9fa;
  border: 1px solid #86b7fe !important;
}

.table th {
  background-color: #f8f9fa !important;
  font-weight: 600;
  text-align: center;
  vertical-align: middle;
}

.table td {
  vertical-align: middle;
  text-align: center;
}

.signature-box {
  min-height: 120px;
  border: 1px solid #dee2e6;
}
</style>
@endsection
