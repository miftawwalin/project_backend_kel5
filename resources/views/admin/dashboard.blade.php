@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">

    <h4 class="fw-bold mb-4">Dashboard Admin</h4>

    {{-- Statistik --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm text-center">
                <h6>Total Request</h6>
                <h3>{{ $totalRequests }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm text-center">
                <h6>Pending</h6>
                <h3 class="text-warning">{{ $pendingRequests }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm text-center">
                <h6>Approved</h6>
                <h3 class="text-success">{{ $approvedRequests }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm text-center">
                <h6>Rejected</h6>
                <h3 class="text-danger">{{ $rejectedRequests }}</h3>
            </div>
        </div>
    </div>

    {{-- Bar Chart --}}
    <div class="card mt-4">
        <div class="card-header fw-bold">Statistik Status Request</div>
        <div class="card-body">
            <canvas id="statusChart"></canvas>
        </div>
    </div>

    {{-- Line Chart --}}
    <div class="card mt-4">
        <div class="card-header fw-bold">Trend Request Per Bulan</div>
        <div class="card-body">
            <canvas id="monthlyChart"></canvas>
        </div>
    </div>

    <a href="{{ route('export.request') }}" class="btn btn-success mb-3">
    Export Request Excel
</a>

<a href="{{ route('export.product') }}" class="btn btn-primary mb-3">
    Export Product Excel
</a>


    {{-- Latest Requests --}}
    <div class="card shadow-sm">
        <div class="card-header fw-bold">Permintaan Barang Terbaru</div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Barang</th>
                        <th>Qty</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($latestRequests as $req)
                    <tr>
                        <td>{{ $req->id }}</td>
                        <td>{{ $req->user->name }}</td>
                       <td>
    {{ $req->items->first()->product->name ?? '-' }}
</td>

<td>
    {{ $req->items->sum('qty') }}
</td>

                        <td>
                            <span class="badge bg-{{ $req->status == 'approved' ? 'success' : ($req->status == 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($req->status) }}
                            </span>
                        </td>
                        <td>{{ $req->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // === BAR CHART (Pending / Approved / Rejected) ===
    new Chart(document.getElementById('statusChart'), {
        type: 'bar',
        data: {
            labels: ['Pending', 'Approved', 'Rejected'],
            datasets: [{
                label: 'Jumlah Request',
                data: [
                    {{ $pendingRequests }},
                    {{ $approvedRequests }},
                    {{ $rejectedRequests }}
                ],
                backgroundColor: ['#f1c40f', '#27ae60', '#e74c3c']
            }]
        }
    });

    // === LINE CHART (Request Per Bulan) ===
    new Chart(document.getElementById('monthlyChart'), {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
            datasets: [{
                label: 'Request Per Bulan',
                data: [
                    @for ($i = 1; $i <= 12; $i++)
                        {{ $monthly[$i] ?? 0 }},
                    @endfor
                ],
                borderColor: '#3498db',
                tension: 0.3
            }]
        }
    });
</script>
@endsection
