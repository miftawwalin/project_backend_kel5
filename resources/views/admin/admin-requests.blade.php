@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Daftar Permintaan Barang</h3>
        <div class="d-flex gap-2">
            <!-- Hidden Form for Bulk Delete -->
            <form id="bulkDeleteForm" action="{{ route('requests.bulkDestroy') }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
                <div id="bulkDeleteInputContainer"></div>
            </form>

            <button class="btn btn-danger btn-sm d-none" id="btnDeleteSelected" onclick="confirmBulkDelete()">
                <i data-feather="trash-2"></i> Delete Selected (<span id="selectedCount">0</span>)
            </button>
        </div>
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
                            <th class="text-center" style="width: 40px;">
                                <input type="checkbox" id="check-all" class="form-check-input">
                            </th>
                            <th>No</th>
                            <th>User</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Note (Item)</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $req)
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" class="form-check-input check-item" value="{{ $req->id }}">
                            </td>
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
                            <td class="text-center">
                                @if($req->status == 'pending')
                                    <div class="d-flex gap-1 justify-content-center">
                                        <form action="{{ route('requests.approve', $req->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin approve request ini?')">
                                                Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('requests.reject', $req->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin reject request ini?')">
                                                Reject
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <tr><td colspan="8" class="text-center py-5">
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

  // Bulk selection logic
  const checkAll = document.getElementById('check-all');
  const checkItems = document.querySelectorAll('.check-item');
  const btnDeleteSelected = document.getElementById('btnDeleteSelected');
  const bulkDeleteForm = document.getElementById('bulkDeleteForm');

  function toggleDeleteButton() {
    const selectedCount = document.querySelectorAll('.check-item:checked').length;
    if (document.getElementById('selectedCount')) {
      document.getElementById('selectedCount').textContent = selectedCount;
    }
    
    if (btnDeleteSelected) {
      if (selectedCount > 0) {
        btnDeleteSelected.classList.remove('d-none');
      } else {
        btnDeleteSelected.classList.add('d-none');
      }
    }
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
    checkbox.addEventListener('change', function() {
      if (checkAll) {
        checkAll.checked = checkItems.length === document.querySelectorAll('.check-item:checked').length;
      }
      toggleDeleteButton();
    });
  });
});

function confirmBulkDelete() {
  const selected = document.querySelectorAll('.check-item:checked');
  if (selected.length === 0) {
    alert('Tidak ada item yang dipilih');
    return;
  }

  if (!confirm(`Apakah Anda yakin ingin menghapus ${selected.length} request(s)?`)) {
    return;
  }

  const container = document.getElementById('bulkDeleteInputContainer');
  container.innerHTML = '';
  
  selected.forEach(checkbox => {
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'ids[]';
    input.value = checkbox.value;
    container.appendChild(input);
  });

  document.getElementById('bulkDeleteForm').submit();
}
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
