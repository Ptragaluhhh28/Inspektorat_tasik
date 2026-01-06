@extends('admin.layouts.app')

@section('title', 'Manajemen Kontak')
@section('page-title', 'Kontak Masuk')

@section('breadcrumb')
    <li class="breadcrumb-item active">Kontak Masuk</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-envelope me-2"></i>Daftar Pesan Kontak
                    </h6>
                    <div class="dropdown no-arrow">
                        <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> Aksi Masal
                        </button>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="javascript:void(0)" onclick="bulkMarkAsRead()">
                                <i class="fas fa-check-double fa-sm fa-fw me-2 text-success"></i>Tandai Sudah Dibaca
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="bulkDelete()">
                                <i class="fas fa-trash fa-sm fa-fw me-2 text-danger"></i>Hapus Terpilih
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <form id="bulkActionForm" method="POST" action="">
                            @csrf
                            <input type="hidden" name="selected_ids" id="selectedIds">
                            <table class="table table-hover align-middle" id="kontakTable">
                                <thead class="table-light">
                                    <tr>
                                        <th width="40">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="selectAll">
                                            </div>
                                        </th>
                                        <th>Pengirim</th>
                                        <th>Subjek</th>
                                        <th>Pesan</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th width="120" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($kontak as $item)
                                        <tr class="{{ $item->status == 0 ? 'table-light fw-bold' : '' }}">
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input select-item" type="checkbox" value="{{ $item->id }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-{{ $item->status == 0 ? 'primary' : 'secondary' }} text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                    <div>
                                                        <div class="name">{{ $item->nama }}</div>
                                                        <small class="text-muted">{{ $item->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->subjek }}</td>
                                            <td>{{ Str::limit($item->pesan, 50) }}</td>
                                            <td>
                                                <span class="badge bg-{{ $item->getStatusBadgeClass() }}">
                                                    {{ $item->getStatusLabel() }}
                                                </span>
                                            </td>
                                            <td>
                                                <small>{{ $item->created_at->format('d/m/Y') }}</small><br>
                                                <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('admin.kontak.show', $item->id) }}" class="btn btn-primary" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger" onclick="deleteItem({{ $item->id }})" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                                <form id="delete-form-{{ $item->id }}" action="{{ route('admin.kontak.destroy', $item->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4 text-muted">
                                                <i class="fas fa-envelope-open-text fa-3x mb-3"></i>
                                                <p>Belum ada pesan masuk</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="mt-4">
                        {{ $kontak->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('selectAll');
        const selectItems = document.querySelectorAll('.select-item');
        
        if (selectAll) {
            selectAll.addEventListener('change', function() {
                selectItems.forEach(item => {
                    item.checked = this.checked;
                });
            });
        }
    });

    function getSelectedIds() {
        const checkedItems = document.querySelectorAll('.select-item:checked');
        const ids = Array.from(checkedItems).map(item => item.value);
        return ids;
    }

    function bulkMarkAsRead() {
        const ids = getSelectedIds();
        if (ids.length === 0) {
            alert('Silakan pilih setidaknya satu pesan.');
            return;
        }

        if (confirm('Tandai ' + ids.length + ' pesan sebagai sudah dibaca?')) {
            const form = document.getElementById('bulkActionForm');
            form.action = "{{ route('admin.kontak.bulkMarkAsRead') }}";
            document.getElementById('selectedIds').value = JSON.stringify(ids);
            form.submit();
        }
    }

    function bulkDelete() {
        const ids = getSelectedIds();
        if (ids.length === 0) {
            alert('Silakan pilih setidaknya satu pesan.');
            return;
        }

        if (confirm('Apakah Anda yakin ingin menghapus ' + ids.length + ' pesan terpilih? Tindakan ini tidak dapat dibatalkan.')) {
            const form = document.getElementById('bulkActionForm');
            form.action = "{{ route('admin.kontak.bulkDelete') }}";
            document.getElementById('selectedIds').value = JSON.stringify(ids);
            form.submit();
        }
    }

    function deleteItem(id) {
        if (confirm('Apakah Anda yakin ingin menghapus pesan ini?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endpush
@endsection
