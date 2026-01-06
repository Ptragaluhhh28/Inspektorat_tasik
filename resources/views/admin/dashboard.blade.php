@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<!-- Overview Stats -->
<div class="row g-4 mb-4">
    <!-- Total Berita Stats -->
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card primary h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="flex-grow-1">
                        <div class="text-sm fw-medium text-muted text-uppercase tracking-wider mb-2">
                            Total Berita
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h3 fw-bold text-gray-900 mb-0">{{ number_format($totalBerita) }}</div>
                            <div class="ms-2 text-sm text-success">
                                <i class="fas fa-arrow-up me-1"></i>+12%
                            </div>
                        </div>
                        <div class="text-sm text-muted mt-1">dari bulan lalu</div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="rounded-lg bg-primary bg-opacity-10 p-3">
                            <i class="fas fa-newspaper text-primary fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Berita Published Stats -->
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card success h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="flex-grow-1">
                        <div class="text-sm fw-medium text-muted text-uppercase tracking-wider mb-2">
                            Berita Published
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h3 fw-bold text-gray-900 mb-0">{{ number_format($totalBeritaPublished) }}</div>
                            <div class="ms-2 text-sm text-success">
                                <i class="fas fa-arrow-up me-1"></i>+8%
                            </div>
                        </div>
                        <div class="text-sm text-muted mt-1">dari bulan lalu</div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="rounded-lg bg-success bg-opacity-10 p-3">
                            <i class="fas fa-check-circle text-success fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Galeri Stats -->
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card warning h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="flex-grow-1">
                        <div class="text-sm fw-medium text-muted text-uppercase tracking-wider mb-2">
                            Total Galeri
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h3 fw-bold text-gray-900 mb-0">{{ number_format($totalGaleri) }}</div>
                            <div class="ms-2 text-sm text-warning">
                                <i class="fas fa-minus me-1"></i>0%
                            </div>
                        </div>
                        <div class="text-sm text-muted mt-1">dari bulan lalu</div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="rounded-lg bg-warning bg-opacity-10 p-3">
                            <i class="fas fa-images text-warning fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kontak Baru Stats -->
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card danger h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="flex-grow-1">
                        <div class="text-sm fw-medium text-muted text-uppercase tracking-wider mb-2">
                            Kontak Baru
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h3 fw-bold text-gray-900 mb-0">{{ number_format($totalKontakMasuk) }}</div>
                            <div class="ms-2 text-sm text-danger">
                                <i class="fas fa-arrow-down me-1"></i>-5%
                            </div>
                        </div>
                        <div class="text-sm text-muted mt-1">dari bulan lalu</div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="rounded-lg bg-danger bg-opacity-10 p-3">
                            <i class="fas fa-envelope text-danger fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Chart Pengunjung -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-area me-2"></i>
                    Statistik Pengunjung (7 Hari Terakhir)
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="pengunjungChart" width="100%" height="40"></canvas>
                </div>
                <div class="mt-4 text-center">
                    <div class="small">
                        <span class="me-3">
                            <i class="fas fa-circle text-primary me-1"></i>Pengunjung
                        </span>
                        <span>
                            <i class="fas fa-circle text-success me-1"></i>Page Views
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pengunjung Bulan Ini -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-users me-2"></i>
                    Pengunjung Bulan Ini
                </h6>
            </div>
            <div class="card-body text-center">
                <div class="text-center">
                    <div class="h1 mb-3 text-primary">{{ number_format($totalPengunjungBulanIni) }}</div>
                    <p class="text-muted">Total pengunjung di bulan {{ now()->format('F Y') }}</p>
                </div>
                <div class="progress mb-3">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="small text-muted">Meningkat dari bulan sebelumnya</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Berita Terbaru -->
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-newspaper me-2"></i>
                    Berita Terbaru
                </h6>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i>Lihat Semua
                </a>
            </div>
            <div class="card-body">
                @if($beritaTerbaru->count() > 0)
                    @foreach($beritaTerbaru as $berita)
                    <div class="d-flex align-items-center py-2 border-bottom">
                        <div class="flex-shrink-0">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fas fa-newspaper text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">{{ Str::limit($berita->judul, 40) }}</h6>
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $berita->created_at->format('d M Y') }}
                                <span class="badge bg-{{ $berita->status == 1 ? 'success' : 'warning' }} ms-2">
                                    {{ $berita->status == 1 ? 'Published' : 'Draft' }}
                                </span>
                            </small>
                        </div>
                        <div class="flex-shrink-0">
                            <small class="text-muted">
                                <i class="fas fa-eye me-1"></i>{{ $berita->views }}
                            </small>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-3">
                        <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada berita</p>
                        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Tambah Berita
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Kontak Masuk Terbaru -->
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-envelope me-2"></i>
                    Kontak Masuk Terbaru
                </h6>
                <a href="{{ route('admin.kontak.index') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-envelope me-1"></i>Lihat Semua
                </a>
            </div>
            <div class="card-body">
                @if($kontakTerbaru->count() > 0)
                    @foreach($kontakTerbaru as $kontak)
                    <div class="d-flex align-items-center py-2 border-bottom">
                        <div class="flex-shrink-0">
                            <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">{{ $kontak->nama }}</h6>
                            <small class="text-muted">
                                {{ Str::limit($kontak->subjek, 30) }}
                                <span class="badge bg-{{ $kontak->getStatusBadgeClass() }} ms-2">
                                    {{ $kontak->getStatusLabel() }}
                                </span>
                            </small>
                        </div>
                        <div class="flex-shrink-0">
                            <small class="text-muted">
                                {{ $kontak->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-3">
                        <i class="fas fa-envelope fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada kontak masuk</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Chart Pengunjung
const ctx = document.getElementById('pengunjungChart').getContext('2d');
const chartData = @json($chartData);

const pengunjungChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: chartData.map(item => item.tanggal),
        datasets: [{
            label: 'Pengunjung',
            data: chartData.map(item => item.pengunjung),
            borderColor: '#007bff',
            backgroundColor: 'rgba(0, 123, 255, 0.1)',
            borderWidth: 2,
            fill: true,
            tension: 0.4
        }, {
            label: 'Page Views',
            data: chartData.map(item => item.page_views),
            borderColor: '#28a745',
            backgroundColor: 'rgba(40, 167, 69, 0.1)',
            borderWidth: 2,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0, 0, 0, 0.1)'
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>
@endpush
