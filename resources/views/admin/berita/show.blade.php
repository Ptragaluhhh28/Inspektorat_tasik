@extends('admin.layouts.app')

@section('title', 'Detail Berita')
@section('page-title', 'Detail Berita')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.berita.index') }}">Berita</a></li>
    <li class="breadcrumb-item active">Detail Berita</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-newspaper me-2"></i>
                    Detail Berita
                </h6>
                <div>
                    <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Judul -->
                        <div class="mb-4">
                            <h2 class="mb-2">{{ $berita->judul }}</h2>
                            <div class="d-flex align-items-center text-muted">
                                <small>
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $berita->created_at->format('d F Y, H:i') }}
                                </small>
                                <span class="mx-2">•</span>
                                <small>
                                    <i class="fas fa-eye me-1"></i>
                                    {{ $berita->views }} views
                                </small>
                                <span class="mx-2">•</span>
                                <span class="badge bg-{{ $berita->status == 1 ? 'success' : 'warning' }}">
                                    {{ $berita->status == 1 ? 'Published' : 'Draft' }}
                                </span>
                            </div>
                        </div>

                        <!-- Excerpt -->
                        @if($berita->excerpt)
                        <div class="mb-4">
                            <h5>Ringkasan</h5>
                            <p class="text-muted">{{ $berita->excerpt }}</p>
                        </div>
                        @endif

                        <!-- Konten -->
                        <div class="mb-4">
                            <h5>Konten</h5>
                            <div class="content-body">
                                {!! nl2br(e($berita->konten)) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Gambar -->
                        @if($berita->gambar)
                        <div class="mb-4">
                            <h6>Gambar Berita</h6>
                            <img src="{{ asset('images/berita/' . $berita->gambar) }}" 
                                 alt="{{ $berita->judul }}" 
                                 class="img-fluid rounded shadow">
                        </div>
                        @else
                        <div class="mb-4">
                            <h6>Gambar Berita</h6>
                            <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                                 style="height: 200px;">
                                <div class="text-center text-muted">
                                    <i class="fas fa-image fa-3x mb-2"></i>
                                    <p>Tidak ada gambar</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Informasi Tambahan -->
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <i class="fas fa-info-circle text-info me-1"></i>
                                    Informasi Berita
                                </h6>
                                <table class="table table-sm">
                                    <tr>
                                        <td><strong>Slug:</strong></td>
                                        <td><code>{{ $berita->slug }}</code></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status:</strong></td>
                                        <td>
                                            <span class="badge bg-{{ $berita->status == 1 ? 'success' : 'warning' }}">
                                                {{ $berita->status == 1 ? 'Published' : 'Draft' }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Views:</strong></td>
                                        <td>{{ number_format($berita->views) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Dibuat:</strong></td>
                                        <td>{{ $berita->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Diperbarui:</strong></td>
                                        <td>{{ $berita->updated_at->format('d M Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Aksi -->
                        <div class="mt-3">
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit me-1"></i>Edit Berita
                                </a>
                                <form action="{{ route('admin.berita.destroy', $berita->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus berita ini?')"
                                      class="d-grid">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash me-1"></i>Hapus Berita
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.content-body {
    line-height: 1.8;
    font-size: 1.1rem;
}

.content-body p {
    margin-bottom: 1rem;
}

.table-sm td {
    padding: 0.5rem 0.25rem;
    border: none;
}

.table-sm td:first-child {
    width: 40%;
    padding-left: 0;
}
</style>
@endpush