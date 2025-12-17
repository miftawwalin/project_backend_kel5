@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">
    <!-- Welcome Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold text-primary mb-1">Dashboard Overview</h4>
                    <p class="text-muted mb-0">
                        <i data-feather="user" style="width: 16px; height: 16px;"></i> 
                        Welcome back, <strong>{{ Auth::user()->name }}</strong>! Here's what's happening today.
                    </p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('export.request') }}" class="btn btn-success btn-sm">
                        <i data-feather="file-text"></i> Export Request
                    </a>
                    <a href="{{ route('export.product') }}" class="btn btn-primary btn-sm">
                        <i data-feather="box"></i> Export Product
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards - Enhanced -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card stats-card border-0 shadow-sm h-100 border-primary-left">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-muted mb-1 fw-bold text-uppercase small">Total Request</h6>
                            <h2 class="fw-bold mb-0 text-primary">{{ $totalRequests }}</h2>
                        </div>
                        <div class="icon-box bg-primary-subtle text-primary rounded-circle">
                            <i data-feather="layers"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <small class="text-muted">
                            <i data-feather="trending-up" class="icon-xs text-success"></i> All time requests
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
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
                        <small class="text-muted">Awaiting your approval</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
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
                        <small class="text-muted">Successfully processed</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card stats-card border-0 shadow-sm h-100 border-danger-left">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-muted mb-1 fw-bold text-uppercase small">Rejected</h6>
                            <h2 class="fw-bold mb-0 text-danger">{{ $rejectedRequests }}</h2>
                        </div>
                        <div class="icon-box bg-danger-subtle text-danger rounded-circle">
                            <i data-feather="x-circle"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <small class="text-muted">Denied requests</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mb-4">
        <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold mb-0 text-dark">
                            <i data-feather="trending-up" class="me-2"></i>Request Trend (Monthly)
                        </h6>
                        <div class="badge bg-primary-subtle text-primary">2025</div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="monthlyChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i data-feather="pie-chart" class="me-2"></i>Status Distribution
                    </h6>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <div style="width: 100%; max-width: 250px;">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Activities -->
    <div class="row mb-4">
        <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i data-feather="zap" class="me-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.form-request') }}" class="btn btn-outline-primary btn-sm text-start">
                            <i data-feather="file-plus" class="me-2"></i> Create New Request
                        </a>
                        <a href="{{ route('add-product') }}" class="btn btn-outline-success btn-sm text-start">
                            <i data-feather="plus-circle" class="me-2"></i> Add New Product
                        </a>
                        <a href="{{ route('requests.index') }}" class="btn btn-outline-warning btn-sm text-start">
                            <i data-feather="check-circle" class="me-2"></i> Review Pending Requests
                        </a>
                        <a href="{{ route('inventory-dashboard') }}" class="btn btn-outline-info btn-sm text-start">
                            <i data-feather="trending-up" class="me-2"></i> View Inventory
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
                    <a href="{{ route('requests.index') }}" class="btn btn-sm btn-link text-decoration-none p-0">
                        View All <i data-feather="arrow-right" style="width: 14px; height: 14px;"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4" style="width: 50px;">No</th>
                                    <th>User / Department</th>
                                    <th>Items</th>
                                    <th class="text-center" style="width: 100px;">Qty</th>
                                    <th class="text-center" style="width: 120px;">Status</th>
                                    <th class="text-end pe-4" style="width: 150px;">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($latestRequests as $req)
                                <tr>
                                    <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $req->user->name ?? ($req->npk_nama ?? 'N/A') }}</div>
                                        <small class="text-muted">{{ $req->department->name ?? '-' }}</small>
                                    </td>
                                    <td>
                                        @if($req->items->count() > 0)
                                            <span class="text-dark fw-medium">{{ $req->items->first()->product->name ?? '-' }}</span>
                                            @if($req->items->count() > 1)
                                                <small class="text-muted ms-1">+{{ $req->items->count() - 1 }} more</small>
                                            @endif
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border">{{ $req->items->sum('qty') }}</span>
                                    </td>
                                    <td class="text-center">
                                        @if($req->status == 'approved')
                                            <span class="badge bg-success-subtle text-success border border-success">Approved</span>
                                        @elseif($req->status == 'pending')
                                            <span class="badge bg-warning-subtle text-warning border border-warning">Pending</span>
                                        @elseif($req->status == 'rejected')
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
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i data-feather="inbox" style="width: 48px; height: 48px; opacity: 0.3;"></i>
                                        <p class="mt-2 mb-0">No recent requests found.</p>
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

    <!-- Summary Stats Row -->
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i data-feather="activity" class="text-primary" style="width: 32px; height: 32px;"></i>
                    </div>
                    <h5 class="fw-bold mb-1">Approval Rate</h5>
                    <h3 class="text-success mb-0">
                        {{ $totalRequests > 0 ? number_format(($approvedRequests / $totalRequests) * 100, 1) : 0 }}%
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i data-feather="alert-circle" class="text-warning" style="width: 32px; height: 32px;"></i>
                    </div>
                    <h5 class="fw-bold mb-1">Pending Rate</h5>
                    <h3 class="text-warning mb-0">
                        {{ $totalRequests > 0 ? number_format(($pendingRequests / $totalRequests) * 100, 1) : 0 }}%
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i data-feather="target" class="text-info" style="width: 32px; height: 32px;"></i>
                    </div>
                    <h5 class="fw-bold mb-1">Processing Time</h5>
                    <h3 class="text-info mb-0">Avg 2.5 Days</h3>
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

.border-danger-left { 
    border-left: 4px solid #dc3545 !important; 
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

.table td {
    font-size: 0.875rem;
}

.btn-outline-primary:hover,
.btn-outline-success:hover,
.btn-outline-warning:hover,
.btn-outline-info:hover {
    transform: translateX(5px);
    transition: all 0.3s ease;
}
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize feather icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }

    // === DOUGHNUT CHART (Status Distribution) ===
    const ctxStatus = document.getElementById('statusChart');
    if (ctxStatus) {
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Approved', 'Rejected'],
                datasets: [{
                    data: [
                        {{ $pendingRequests }},
                        {{ $approvedRequests }},
                        {{ $rejectedRequests }}
                    ],
                    backgroundColor: [
                        'rgba(255, 193, 7, 0.8)',
                        'rgba(25, 135, 84, 0.8)',
                        'rgba(220, 53, 69, 0.8)'
                    ],
                    borderColor: [
                        '#ffc107',
                        '#198754',
                        '#dc3545'
                    ],
                    borderWidth: 2,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { 
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            font: { size: 12 }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: { size: 14 },
                        bodyFont: { size: 13 }
                    }
                }
            }
        });
    }

    // === LINE CHART (Monthly Trend) ===
    const ctxMonthly = document.getElementById('monthlyChart');
    if (ctxMonthly) {
        const gradient = ctxMonthly.getContext('2d').createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(13, 110, 253, 0.3)');
        gradient.addColorStop(1, 'rgba(13, 110, 253, 0.0)');

        new Chart(ctxMonthly, {
            type: 'line',
            data: {
                labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
                datasets: [{
                    label: 'Requests',
                    data: [
                        @for ($i = 1; $i <= 12; $i++)
                            {{ $monthly[$i] ?? 0 }},
                        @endfor
                    ],
                    borderColor: '#0d6efd',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#0d6efd',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: { size: 14 },
                        bodyFont: { size: 13 }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { 
                            borderDash: [5, 5],
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            font: { size: 11 }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { size: 11 }
                        }
                    }
                }
            }
        });
    }
});
</script>
@endsection
