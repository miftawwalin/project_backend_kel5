@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold text-primary mb-1">Add New Product</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('inventory-dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('inventory-dashboard') }}" class="btn btn-outline-secondary btn-sm">
            <i data-feather="arrow-left" class="icon-sm me-1"></i> Back to Inventory
        </a>
    </div>

    {{-- Alert Errors --}}
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 border-start border-danger border-3" role="alert">
        <h6 class="fw-bold mb-2"><i data-feather="alert-circle" class="icon-sm me-1"></i> Form Errors</h6>
        <ul class="mb-0 small">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="row">
            {{-- Left Column: Basic Information --}}
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4 position-relative overflow-hidden">
                    <div class="card-header bg-white py-3">
                        <h6 class="fw-bold m-0 text-primary"><i data-feather="box" class="icon-sm me-1"></i> Basic Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            {{-- Item Code --}}
                            <div class="col-md-6">
                                <label for="item_code" class="form-label fw-bold small text-muted">Item Code <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i data-feather="hash" class="icon-xs"></i></span>
                                    <input type="text" class="form-control @error('item_code') is-invalid @enderror" 
                                           id="item_code" name="item_code" placeholder="e.g. SBM-010-001" 
                                           value="{{ old('item_code') }}" required autofocus>
                                </div>
                                @error('item_code') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            {{-- Item Name --}}
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold small text-muted">Item Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i data-feather="type" class="icon-xs"></i></span>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" placeholder="e.g. SAFETY GLOVES" 
                                           value="{{ old('name') }}" required>
                                </div>
                            </div>

                            {{-- Category --}}
                            <div class="col-md-12">
                                <label for="category" class="form-label fw-bold small text-muted">Category <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="category" name="category" placeholder="e.g. Sparepart" value="{{ old('category') }}" required>
                            </div>



                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Stock & Location --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="fw-bold m-0 text-success"><i data-feather="archive" class="icon-sm me-1"></i> Stock & Location</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            {{-- Qty --}}
                            <div class="col-md-6">
                                <label for="qty" class="form-label fw-bold small text-muted">Initial Qty <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="qty" name="qty" min="0" value="{{ old('qty', 0) }}" required>
                            </div>

                            {{-- Min Stock --}}
                            <div class="col-md-6">
                                <label for="min_stock" class="form-label fw-bold small text-muted">Min Stock</label>
                                <input type="number" class="form-control" id="min_stock" name="min_stock" min="0" value="{{ old('min_stock', 5) }}">
                            </div>

                            {{-- Stock Max --}}
                            <div class="col-md-6">
                                <label for="stock_max" class="form-label fw-bold small text-muted">Stock Max</label>
                                <input type="number" class="form-control" id="stock_max" name="stock_max" min="0" value="{{ old('stock_max', 0) }}">
                            </div>

                            {{-- Titik Order --}}
                            <div class="col-md-6">
                                <label for="titik_order" class="form-label fw-bold small text-muted">Titik Order</label>
                                <input type="number" class="form-control" id="titik_order" name="titik_order" min="0" value="{{ old('titik_order', 0) }}">
                            </div>

                            {{-- UOM --}}
                            <div class="col-12">
                                <label for="uom" class="form-label fw-bold small text-muted">UOM (Unit of Measure)</label>
                                <input type="text" class="form-control" id="uom" name="uom" placeholder="e.g. Pcs" value="{{ old('uom') }}">
                            </div>

                            {{-- Location --}}
                            <div class="col-12">
                                <label for="loc" class="form-label fw-bold small text-muted">Location</label>
                                <input type="text" class="form-control" id="loc" name="loc" placeholder="e.g. A-1-1" value="{{ old('loc') }}">
                            </div>

                             {{-- Department --}}
                             <div class="col-12">
                                <label for="department_name" class="form-label fw-bold small text-muted">Department / User</label>
                                <input type="text" class="form-control" id="department_name" name="department_name" placeholder="e.g. PPIC" value="{{ old('department_name') }}">
                            </div>
                        </div>
                    </div>
                </div>



                {{-- Action Buttons --}}
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary fw-bold py-2 shadow-sm">
                        <i data-feather="save" class="icon-sm me-1"></i> Save Product
                    </button>
                    <a href="{{ route('inventory-dashboard') }}" class="btn btn-light border fw-bold py-2">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>

    <div class="row my-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 bg-white">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-4">
                        <div class="mb-3 mb-md-0">
                            <h5 class="fw-bold text-success mb-2"><i data-feather="upload-cloud" class="icon-sm me-2"></i>Bulk Upload via Excel</h5>
                            <p class="text-muted small mb-0">
                                Quickly add multiple products by uploading an Excel file. <br>
                                Format: <strong>ITEM CODE, NAME, UOM, LOC, QTY, Stock Max, Titik Order, Min Stock, USER, STATUS, CATEGORY</strong>
                            </p>
                        </div>
                        <div class="flex-grow-1 w-100" style="max-width: 500px;">
                            <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2">
                                @csrf
                                <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                                <button type="submit" class="btn btn-success fw-bold">
                                    Import
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-5">

    {{-- Product List with Bulk Actions --}}
    <div class="card shadow-sm border-0 mb-5">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h6 class="fw-bold m-0 text-primary"><i data-feather="list" class="icon-sm me-1"></i> Product List</h6>
            <div class="d-flex gap-2">
                {{-- Bulk Delete Button --}}
                <button type="button" class="btn btn-danger btn-sm" id="btn-delete-selected" disabled>
                    <i data-feather="trash-2" class="icon-xs me-1"></i> Delete Selected
                </button>
                {{-- Delete All Button --}}
                <form action="{{ route('products.destroyAll') }}" method="POST" onsubmit="return confirm('WARNING: This will delete ALL products in the database. Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i data-feather="trash" class="icon-xs me-1"></i> Delete All Items
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <form id="bulk-delete-form" action="{{ route('products.bulkDestroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" width="40">
                                    <input type="checkbox" class="form-check-input" id="check-all">
                                </th>
                                <th class="ps-3">Item Code</th>
                                <th>Name</th>
                                <th class="text-center">UOM</th>
                                <th>Loc</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Stock Max</th>
                                <th class="text-center">Titik Order</th>
                                <th class="text-center">Min Stock</th>
                                <th>User</th>
                                <th class="text-center">Status</th>
                                <th>Category</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="ids[]" value="{{ $product->id }}" class="form-check-input check-item">
                                </td>
                                <td class="ps-3">{{ $product->item_code }}</td>
                                <td>{{ $product->name }}</td>
                                <td class="text-center">{{ $product->uom }}</td>
                                <td>{{ $product->loc }}</td>
                                <td class="text-center">{{ $product->qty }}</td>
                                <td class="text-center">{{ $product->stock_max ?? '-' }}</td>
                                <td class="text-center">{{ $product->titik_order ?? '-' }}</td>
                                <td class="text-center">{{ $product->min_stock }}</td>
                                <td>{{ $product->department?->name ?? '-' }}</td>
                                <td class="text-center">
                                    @if($product->qty <= 0)
                                        <span class="badge bg-danger">Out</span>
                                    @elseif($product->qty < $product->min_stock)
                                        <span class="badge bg-warning text-dark">Low</span>
                                    @else
                                        <span class="badge bg-success">OK</span>
                                    @endif
                                </td>
                                <td>{{ $product->category }}</td>
                                <td class="text-center">
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger p-0 border-0" title="Delete">
                                            <i data-feather="trash-2" class="icon-xs"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="13" class="text-center text-muted py-4">No products found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </form>
            </div>
            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Init Feather Icons
        if (typeof feather !== 'undefined') {
            feather.replace();
        }

        // Init Select2 (Assuming jQuery & Select2 are loaded in Layout)
        if (typeof $ !== 'undefined' && $.fn.select2) {
            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: $(this).data('placeholder'),
            });
        }

        // Bulk Selection Logic
        const checkAll = document.getElementById('check-all');
        const checkItems = document.querySelectorAll('.check-item');
        const btnDeleteSelected = document.getElementById('btn-delete-selected');
        const bulkDeleteForm = document.getElementById('bulk-delete-form');

        function toggleDeleteButton() {
            let anyChecked = Array.from(checkItems).some(checkbox => checkbox.checked);
            btnDeleteSelected.disabled = !anyChecked;
        }

        if (checkAll) {
            checkAll.addEventListener('change', function() {
                checkItems.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                toggleDeleteButton();
            });
        }

        checkItems.forEach(checkbox => {
            checkbox.addEventListener('change', toggleDeleteButton);
        });

        if (btnDeleteSelected) {
            btnDeleteSelected.addEventListener('click', function() {
                if (confirm('Are you sure you want to delete selected items?')) {
                    bulkDeleteForm.submit();
                }
            });
        }
    });
</script>
@endsection