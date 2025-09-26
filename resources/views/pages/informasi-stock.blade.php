@extends('layouts.app')

@section('title', 'Stock Information')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Stock Information & Item Status</h4>
  </div>
  <div class="d-flex align-items-center flex-wrap text-nowrap">
    <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="printer"></i>
      Print
    </button>
    <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="download-cloud"></i>
      Export Report
    </button>
  </div>
</div>

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Total Items</h6>
              <div class="dropdown mb-2">
                <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span>View</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span>Edit</span></a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2">1,245</h3>
                <div class="d-flex align-items-baseline">
                  <p class="text-success">
                    <span>+5.2%</span>
                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <div id="stockChart" class="mt-md-3 mt-xl-0"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Low Stock Items</h6>
              <div class="dropdown mb-2">
                <a type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span>View</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="alert-triangle" class="icon-sm me-2"></i> <span>Alert</span></a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2">23</h3>
                <div class="d-flex align-items-baseline">
                  <p class="text-danger">
                    <span>-1.8%</span>
                    <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <div id="lowStockChart" class="mt-md-3 mt-xl-0"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Out of Stock</h6>
              <div class="dropdown mb-2">
                <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span>View</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="shopping-cart" class="icon-sm me-2"></i> <span>Reorder</span></a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2">8</h3>
                <div class="d-flex align-items-baseline">
                  <p class="text-warning">
                    <span>+0.8%</span>
                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <div id="outOfStockChart" class="mt-md-3 mt-xl-0"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12 stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-0">Stock Items</h6>
          <div class="dropdown mb-2">
            <a type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span>View</span></a>
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span>Edit</span></a>
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span>Delete</span></a>
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span>Print</span></a>
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span>Download</span></a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th class="pt-0">#</th>
                <th class="pt-0">Item Name</th>
                <th class="pt-0">SKU</th>
                <th class="pt-0">Category</th>
                <th class="pt-0">Current Stock</th>
                <th class="pt-0">Min Stock</th>
                <th class="pt-0">Status</th>
                <th class="pt-0">Last Updated</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Metal Bracket A1</td>
                <td>MTA001</td>
                <td>Brackets</td>
                <td>150</td>
                <td>20</td>
                <td><span class="badge bg-success">In Stock</span></td>
                <td>2025-01-15</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Steel Rod B2</td>
                <td>STR002</td>
                <td>Rods</td>
                <td>15</td>
                <td>25</td>
                <td><span class="badge bg-warning">Low Stock</span></td>
                <td>2025-01-14</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Aluminum Sheet C3</td>
                <td>ALS003</td>
                <td>Sheets</td>
                <td>0</td>
                <td>10</td>
                <td><span class="badge bg-danger">Out of Stock</span></td>
                <td>2025-01-13</td>
              </tr>
              <tr>
                <td>4</td>
                <td>Copper Wire D4</td>
                <td>CPW004</td>
                <td>Wires</td>
                <td>200</td>
                <td>50</td>
                <td><span class="badge bg-success">In Stock</span></td>
                <td>2025-01-15</td>
              </tr>
              <tr>
                <td>5</td>
                <td>Iron Pipe E5</td>
                <td>IRP005</td>
                <td>Pipes</td>
                <td>8</td>
                <td>15</td>
                <td><span class="badge bg-warning">Low Stock</span></td>
                <td>2025-01-12</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div> 
    </div>
  </div>
</div>
@endsection
