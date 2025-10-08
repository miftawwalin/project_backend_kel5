@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">
            <i class="bi bi-box2-heart me-2 text-primary"></i> Form Permintaan Barang
        </h4>
        <small class="text-muted">PT Metal Art Toyota Astra Indonesia</small>
    </div>

    {{-- FORM REQUEST --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body">
            
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Nama Barang</label>
                        <input type="text" name="item_name" class="form-control shadow-sm" placeholder="Contoh: Bearing 6202Z" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Jumlah</label>
                        <input type="number" name="quantity" class="form-control shadow-sm" min="1" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Alasan Permintaan</label>
                        <input type="text" name="note" class="form-control shadow-sm" placeholder="Contoh: Penggantian sparepart line produksi">
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary px-4 rounded-3">
                        <i class="bi bi-send me-1"></i> Kirim Request
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
