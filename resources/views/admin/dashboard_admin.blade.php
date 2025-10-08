@extends('layouts.app')

@section('content')
{{-- Statistik Ringkas --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 rounded-3">
                <h6 class="text-muted mb-1">Total Users</h6>
                <h3 class="fw-bold">{{ $totalUsers ?? 0 }}</h3>
                <small class="text-success"><i class="bi bi-person"></i> aktif</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 rounded-3">
                <h6 class="text-muted mb-1">Total Items</h6>
                <h3 class="fw-bold">{{ $totalItems ?? 0 }}</h3>
                <small class="text-primary"><i class="bi bi-box-seam"></i> barang</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 rounded-3">
                <h6 class="text-muted mb-1">Request Pending</h6>
                <h3 class="fw-bold text-warning">{{ $pendingRequests ?? 0 }}</h3>
                <small class="text-warning"><i class="bi bi-clock-history"></i> menunggu konfirmasi</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 rounded-3">
                <h6 class="text-muted mb-1">Low Stock Items</h6>
                <h3 class="fw-bold text-danger">{{ $lowStock ?? 0 }}</h3>
                <small class="text-danger"><i class="bi bi-exclamation-triangle"></i> stok menipis</small>
            </div>
        </div>
    </div>

    {{-- Grafik Stok --}}
    <div class="card mb-4 border-0 shadow-sm rounded-3">
        <div class="card-header bg-white fw-bold">Grafik Barang Masuk & Keluar</div>
        <div class="card-body">
            <canvas id="stockChart" height="100"></canvas>
        </div>
    </div>

    {{-- Aktivitas Terbaru --}}
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white fw-bold">Aktivitas Terbaru</div>
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Barang</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentActivities ?? [] as $activity)
                    <tr>
                        <td>{{ $activity->user->name }}</td>
                        <td>{{ $activity->item_name }}</td>
                        <td>
                            @if ($activity->status == 'approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif ($activity->status == 'rejected')
                                <span class="badge bg-danger">Rejected</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </td>
                        <td>{{ $activity->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada aktivitas terbaru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('stockChart').getContext('2d');
    const stockChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels ?? ['Sen', 'Sel', 'Rab', 'Kam', 'Jum']) !!},
            datasets: [
                {
                    label: 'Barang Masuk',
                    data: {!! json_encode($itemsIn ?? [12, 19, 7, 11, 5]) !!},
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.3
                },
                {
                    label: 'Barang Keluar',
                    data: {!! json_encode($itemsOut ?? [8, 15, 12, 9, 4]) !!},
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.3
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
