@extends('admin.layouts.app')

@section('title', 'Kelola Berita')
@section('page-title', 'Kelola Berita')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Berita</li>
@endsection

@push('styles')
<style>
.berita-thumbnail {
    width: 80px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.berita-thumbnail:hover {
    transform: scale(1.1);
    border-color: #007bff;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.no-image-placeholder {
    width: 80px;
    height: 60px;
    background: linear-gradient(45deg, #f8f9fa, #e9ecef);
    border-radius: 8px;
    border: 2px dashed #dee2e6;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    font-size: 1.2rem;
}

.table td {
    vertical-align: middle;
}
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-newspaper me-2"></i>
                    Daftar Berita
                </h6>
                <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Tambah Berita
                </a>
            </div>
            <div class="card-body">
                @if($berita->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Gambar</th>
                                <th width="35%">Judul</th>
                                <th width="10%">Status</th>
                                <th width="10%">Views</th>
                                <th width="15%">Tanggal</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($berita as $key => $item)
                            <tr>
                                <td>{{ $berita->firstItem() + $key }}</td>
                                <td>
                                    @if($item->gambar)
                                        <img src="{{ asset('images/berita/' . $item->gambar) }}" 
                                            alt="{{ $item->judul }}" 
                                            class="berita-thumbnail" 
                                            loading="lazy"
                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="no-image-placeholder" style="display: none;">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                    @else
                                        <div class="no-image-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $item->judul }}</strong>
                                    <br>
                                    <small class="text-muted">{{ Str::limit($item->excerpt, 80) }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $item->status == 1 ? 'success' : 'warning' }}">
                                        {{ $item->status == 1 ? 'Published' : 'Draft' }}
                                    </span>
                                </td>
                                <td>
                                    <i class="fas fa-eye text-muted"></i> {{ $item->views }}
                                </td>
                                <td>
                                    <small>
                                        {{ $item->created_at->format('d M Y') }}<br>
                                        {{ $item->created_at->format('H:i') }}
                                    </small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.berita.show', $item->id) }}" 
                                            class="btn btn-info" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.berita.edit', $item->id) }}" 
                                        class="btn btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.berita.destroy', $item->id) }}" 
                                            method="POST" 
                                            style="display: inline;"
                                            onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $berita->links() }}
                </div>
                @else
                <div class="text-center py-5">
                    <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada berita</h5>
                    <p class="text-muted">Mulai dengan menambahkan berita pertama Anda</p>
                    <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>Tambah Berita
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 
