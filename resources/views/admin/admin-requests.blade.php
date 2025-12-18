@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Daftar Permintaan Barang</h3>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light" style="position: sticky; top: 0; z-index: 10;">
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Note (Item)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $req)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $req->npk_nama ?? $req->user->name ?? '-' }}</td>
                            <td>
                                @if($req->items->count() > 0)
                                    @foreach($req->items as $i)
                                        • {{ $i->product->name ?? '-' }} <br>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($req->items->count() > 0)
                                    @foreach($req->items as $i)
                                        • {{ $i->qty }} <br>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($req->items->count() > 0)
                                    @foreach($req->items as $i)
                                        • {{ $i->note ?? '-' }} <br>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <span class="badge 
                                    @if($req->status=='approved') bg-success 
                                    @elseif($req->status=='rejected') bg-danger 
                                    @else bg-warning text-dark @endif">
                                    {{ ucfirst($req->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                            <tr><td colspan="6" class="text-center py-5">
                                <i data-feather="inbox" style="width: 48px; height: 48px;" class="text-muted mb-2"></i>
                                <p class="text-muted mb-0">Tidak ada permintaan.</p>
                            </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  if (typeof feather !== 'undefined') {
    feather.replace();
  }
});
</script>

<style>
.card-body .table-responsive::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

.card-body .table-responsive::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}

.card-body .table-responsive::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 10px;
}

.card-body .table-responsive::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>
@endsection
