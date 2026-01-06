@extends('admin.layouts.app')

@section('title', 'Detail Kontak')
@section('page-title', 'Detail Pesan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.kontak.index') }}">Kontak Masuk</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Message Details -->
        <div class="col-lg-8">
            <div class="card shadow mb-4 border-left-primary">
                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-envelope-open me-2"></i>Pesan dari {{ $kontak->nama }}
                    </h6>
                    <span class="badge bg-{{ $kontak->getStatusBadgeClass() }}">
                        {{ $kontak->getStatusLabel() }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="row mb-2">
                            <div class="col-sm-3 fw-bold text-gray-800">Nama Lengkap:</div>
                            <div class="col-sm-9 text-gray-700">{{ $kontak->nama }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-3 fw-bold text-gray-800">Email:</div>
                            <div class="col-sm-9 text-gray-700">
                                <a href="mailto:{{ $kontak->email }}">{{ $kontak->email }}</a>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-3 fw-bold text-gray-800">Telepon:</div>
                            <div class="col-sm-9 text-gray-700">{{ $kontak->telepon ?? '-' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-3 fw-bold text-gray-800">Subjek:</div>
                            <div class="col-sm-9 text-gray-700">{{ $kontak->subjek }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-3 fw-bold text-gray-800">Waktu Kirim:</div>
                            <div class="col-sm-9 text-gray-700">{{ $kontak->created_at->format('d F Y, H:i') }}</div>
                        </div>
                    </div>

                    <hr>

                    <div class="message-content p-4 bg-light rounded shadow-sm mb-4">
                        <h6 class="fw-bold mb-3"><i class="fas fa-quote-left text-primary me-2"></i>Isi Pesan:</h6>
                        <div class="text-gray-800" style="line-height: 1.6; white-space: pre-wrap;">{{ $kontak->pesan }}</div>
                    </div>

                    @if($kontak->balasan)
                        <div class="reply-content p-4 border border-success rounded bg-success bg-opacity-10 mb-4">
                            <h6 class="fw-bold text-success mb-3">
                                <i class="fas fa-reply me-2"></i>Balasan Admin ({{ $kontak->replied_at ? $kontak->replied_at->format('d/m/Y H:i') : '' }}):
                            </h6>
                            <div class="text-gray-800" style="line-height: 1.6; white-space: pre-wrap;">{{ $kontak->balasan }}</div>
                        </div>
                    @endif
                </div>
                <div class="card-footer bg-white py-3">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.kontak.index') }}" class="btn btn-secondary shadow-sm">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <div class="btn-group">
                            @if($kontak->status == 0)
                                <form action="{{ route('admin.kontak.markAsRead', $kontak->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-success shadow-sm">
                                        <i class="fas fa-check me-2"></i>Tandai Sudah Dibaca
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.kontak.markAsUnread', $kontak->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-warning shadow-sm">
                                        <i class="fas fa-undo me-2"></i>Tandai Belum Dibaca
                                    </button>
                                </form>
                            @endif
                            <button type="button" class="btn btn-danger shadow-sm ms-2" onclick="deleteItem()">
                                <i class="fas fa-trash me-2"></i>Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reply Section -->
        <div class="col-lg-4">
            <div class="card shadow mb-4 overflow-hidden">
                <div class="card-header py-3 bg-success text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-paper-plane me-2"></i>Balas Pesan
                    </h6>
                </div>
                <div class="card-body">
                    <p class="small text-muted mb-3">Tulis balasan untuk dikirimkan (Anda dapat menyalin teks ini untuk membalas via email atau platform lain).</p>
                    <form action="{{ route('admin.kontak.reply', $kontak->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <textarea name="balasan" id="balasan" rows="10" class="form-control @error('balasan') is-invalid @enderror" placeholder="Tulis balasan Anda di sini...">{{ $kontak->balasan ?? '' }}</textarea>
                            @error('balasan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success w-100 shadow-sm">
                            <i class="fab fa-whatsapp me-2"></i>Simpan & Kirim ke WhatsApp
                        </button>
                    </form>
                </div>
            </div>

            <div class="card shadow mb-4 border-left-info">
                <div class="card-body">
                    <h6 class="font-weight-bold text-info mb-2">Informasi Lainnya</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-1"><strong>Status:</strong> {{ $kontak->getStatusLabel() }}</li>
                        <li class="mb-1"><strong>IP Address:</strong> {{ request()->ip() }} (Simulated)</li>
                        <li><strong>Diterima:</strong> {{ $kontak->created_at->diffForHumans() }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="delete-form" action="{{ route('admin.kontak.destroy', $kontak->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@if(session('wa_url'))
    <div class="alert alert-info alert-dismissible fade show mx-4 mt-3" role="alert">
        <strong>Pesan Berhasil Disimpan!</strong> Klik tombol di bawah jika WhatsApp tidak terbuka otomatis.
        <br>
        <a href="{{ session('wa_url') }}" target="_blank" class="btn btn-sm btn-success mt-2">
            <i class="fab fa-whatsapp me-1"></i> Buka WhatsApp Sekarang
        </a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('wa_url'))
            // Open WhatsApp in a new tab automatically
            window.open("{{ session('wa_url') }}", '_blank');
        @endif
    });

    function deleteItem() {
        if (confirm('Apakah Anda yakin ingin menghapus pesan ini?')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endpush
@endsection
