@extends('admin.layouts.app')

@section('title', 'Tambah Berita')
@section('page-title', 'Tambah Berita')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.berita.index') }}">Berita</a></li>
    <li class="breadcrumb-item active">Tambah Berita</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-plus me-2"></i>
                    Form Tambah Berita
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Judul -->
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Berita <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('judul') is-invalid @enderror" 
                                       id="judul" 
                                       name="judul" 
                                       value="{{ old('judul') }}" 
                                       placeholder="Masukkan judul berita" 
                                       required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Excerpt -->
                            <div class="mb-3">
                                <label for="excerpt" class="form-label">Excerpt/Ringkasan</label>
                                <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                          id="excerpt" 
                                          name="excerpt" 
                                          rows="3" 
                                          placeholder="Ringkasan singkat berita (opsional)">{{ old('excerpt') }}</textarea>
                                @error('excerpt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Jika kosong, akan diambil dari konten utama</small>
                            </div>

                            <!-- Konten -->
                            <div class="mb-3">
                                <label for="konten" class="form-label">Konten Berita <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('konten') is-invalid @enderror" 
                                          id="konten" 
                                          name="konten" 
                                          rows="15" 
                                          placeholder="Tulis konten berita lengkap di sini..." 
                                          required>{{ old('konten') }}</textarea>
                                @error('konten')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Status -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Status Publikasi <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" 
                                        name="status" 
                                        required>
                                    <option value="">Pilih Status</option>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gambar -->
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar Utama</label>
                                <input type="file" 
                                       class="form-control @error('gambar') is-invalid @enderror" 
                                       id="gambar" 
                                       name="gambar" 
                                       accept="image/*">
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                                
                                <!-- Preview Gambar -->
                                <div id="imagePreview" class="mt-3" style="display: none;">
                                    <img id="preview" src="#" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                </div>
                            </div>

                            <!-- Info Box -->
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-info-circle text-info me-1"></i>
                                        Tips Menulis Berita
                                    </h6>
                                    <small class="text-muted">
                                        • Gunakan judul yang menarik dan informatif<br>
                                        • Tulis excerpt yang merangkum inti berita<br>
                                        • Gunakan gambar berkualitas tinggi<br>
                                        • Simpan sebagai draft untuk review<br>
                                        • Publish setelah konten final
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Kembali
                                </a>
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i>Simpan Berita
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Preview Gambar
document.getElementById('gambar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        document.getElementById('imagePreview').style.display = 'none';
    }
});

// Auto-generate excerpt dari konten
document.getElementById('konten').addEventListener('input', function(e) {
    const excerpt = document.getElementById('excerpt');
    if (!excerpt.value) {
        const text = e.target.value.replace(/<[^>]*>/g, ''); // Remove HTML tags
        excerpt.value = text.substring(0, 200);
    }
});
</script>
@endpush
