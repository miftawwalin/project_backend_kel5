@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
<div class="container-fluid">
    <!-- Welcome Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold text-primary mb-1">My Dashboard</h4>
                    <p class="text-muted mb-0">
                        <i data-feather="user" style="width: 16px; height: 16px;"></i> 
                        Welcome, <strong>{{ auth()->user()->name }}</strong> 
                        <span class="text-muted">({{ auth()->user()->department->name ?? 'No Department' }})</span>
                    </p>
                </div>
                <div>
                    <a href="{{ route('form-request-user') }}" class="btn btn-primary btn-sm">
                        <i data-feather="plus"></i> New Request
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card stats-card border-0 shadow-sm h-100 border-primary-left">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-muted mb-1 fw-bold text-uppercase small">Total Request</h6>
                            <h2 class="fw-bold mb-0 text-primary">{{ $totalRequests }}</h2>
                        </div>
                        <div class="icon-box bg-primary-subtle text-primary rounded-circle">
                            <i data-feather="file-text"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <small class="text-muted">All your requests</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card stats-card border-0 shadow-sm h-100 border-warning-left">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-muted mb-1 fw-bold text-uppercase small">Pending</h6>
                            <h2 class="fw-bold mb-0 text-warning">{{ $pendingRequests }}</h2>
                        </div>
                        <div class="icon-box bg-warning-subtle text-warning rounded-circle">
                            <i data-feather="clock"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <small class="text-muted">Awaiting approval</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card stats-card border-0 shadow-sm h-100 border-success-left">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-muted mb-1 fw-bold text-uppercase small">Approved</h6>
                            <h2 class="fw-bold mb-0 text-success">{{ $approvedRequests }}</h2>
                        </div>
                        <div class="icon-box bg-success-subtle text-success rounded-circle">
                            <i data-feather="check-circle"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <small class="text-muted">Successfully approved</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Requests -->
    <div class="row">
        <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i data-feather="zap" class="me-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('form-request-user') }}" class="btn btn-outline-primary btn-sm text-start">
                            <i data-feather="file-plus" class="me-2"></i> Create New Request
                        </a>
                        <a href="{{ route('informasi-stock') }}" class="btn btn-outline-info btn-sm text-start">
                            <i data-feather="package" class="me-2"></i> View Stock Information
                        </a>
                        <a href="{{ route('form-request-user') }}" class="btn btn-outline-success btn-sm text-start">
                            <i data-feather="list" class="me-2"></i> My Request History
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i data-feather="clock" class="me-2"></i>Recent Requests
                    </h6>
        </div>
        <div class="card-body p-0">
                    <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                                    <th class="ps-4" style="width: 50px;">#</th>
                                    <th>Items</th>
                                    <th class="text-center" style="width: 100px;">Qty</th>
                                    <th class="text-center" style="width: 120px;">Status</th>
                                    <th class="text-end pe-4" style="width: 150px;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $index => $req)
                    <tr>
                                    <td class="ps-4 text-muted">{{ $index + 1 }}</td>
                                    <td>
                                        @if($req->items->count() > 0)
                                            <div class="fw-medium text-dark">
                                                {{ $req->items->first()->product->name ?? '-' }}
                                            </div>
                                            @if($req->items->count() > 1)
                                                <small class="text-muted">+{{ $req->items->count() - 1 }} more items</small>
                                            @endif
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border">
                                            {{ $req->items->sum('qty') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                            @if($req->status === 'pending')
                                            <span class="badge bg-warning-subtle text-warning border border-warning">Pending</span>
                            @elseif($req->status === 'approved')
                                            <span class="badge bg-success-subtle text-success border border-success">Approved</span>
                            @else
                                            <span class="badge bg-danger-subtle text-danger border border-danger">Rejected</span>
                            @endif
                        </td>
                                    <td class="text-end pe-4 text-muted small">
                                        {{ $req->created_at->format('d M Y') }}<br>
                                        <small>{{ $req->created_at->format('H:i') }}</small>
                                    </td>
                    </tr>
                    @empty
                    <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i data-feather="inbox" style="width: 48px; height: 48px; opacity: 0.3;"></i>
                                        <p class="mt-2 mb-0">No requests yet. Create your first request!</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
        </div>
    </div>
</div>

<style>
.stats-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 12px;
    overflow: hidden;
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1) !important;
}

.border-primary-left { 
    border-left: 4px solid #0d6efd !important; 
}

.border-warning-left { 
    border-left: 4px solid #ffc107 !important; 
}

.border-success-left { 
    border-left: 4px solid #198754 !important; 
}

.icon-box {
    width: 48px; 
    height: 48px; 
    display: flex; 
    align-items: center; 
    justify-content: center;
    transition: all 0.3s ease;
}

.stats-card:hover .icon-box {
    transform: scale(1.1) rotate(5deg);
}

.bg-primary-subtle { 
    background: linear-gradient(135deg, rgba(13, 110, 253, 0.15) 0%, rgba(13, 110, 253, 0.05) 100%); 
}

.bg-warning-subtle { 
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.15) 0%, rgba(255, 193, 7, 0.05) 100%); 
}

.bg-success-subtle { 
    background: linear-gradient(135deg, rgba(25, 135, 84, 0.15) 0%, rgba(25, 135, 84, 0.05) 100%); 
}

.bg-danger-subtle { 
    background: linear-gradient(135deg, rgba(220, 53, 69, 0.15) 0%, rgba(220, 53, 69, 0.05) 100%); 
}

.card {
    border-radius: 12px;
    overflow: hidden;
}

.table th {
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-outline-primary:hover,
.btn-outline-success:hover,
.btn-outline-info:hover {
    transform: translateX(5px);
    transition: all 0.3s ease;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
});
</script>
@endsection
