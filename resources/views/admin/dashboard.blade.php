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
    <div class="col-md-4">
        <div class="card stat-card primary h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="flex-grow-1">
                        <div class="text-sm fw-medium text-muted text-uppercase tracking-wider mb-2">
                            Total Berita
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h3 fw-bold text-gray-900 mb-0">{{ number_format($totalBerita) }}</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Berita Published Stats -->
    <div class="col-md-4">
        <div class="card stat-card success h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="flex-grow-1">
                        <div class="text-sm fw-medium text-muted text-uppercase tracking-wider mb-2">
                            Berita Published
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h3 fw-bold text-gray-900 mb-0">{{ number_format($totalBeritaPublished) }}</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>    <!-- Pengunjung Bulan Ini Stats -->
    <div class="col-md-4">
        <div class="card stat-card info h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="flex-grow-1">
                        <div class="text-sm fw-medium text-muted text-uppercase tracking-wider mb-2">
                            Pengunjung Bulan Ini
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h3 fw-bold text-gray-900 mb-0">{{ number_format($totalPengunjungBulanIni) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Chart Pengunjung -->
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-area me-2"></i>
                    Statistik Pengunjung (7 Hari Terakhir)
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-area" style="height: 400px;">
                    <canvas id="pengunjungChart"></canvas>
                </div>
                <div class="mt-4 text-center">
                    <div class="small">
                        <span class="me-3">
                            <i class="fas fa-circle text-primary me-1"></i>Pengunjung
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <!-- Berita Terbaru -->
    <div class="col-lg-12">
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
</div>
@endsection

@push('scripts')
<script>
// Chart Pengunjung
const ctx = document.getElementById('pengunjungChart').getContext('2d');
const chartData = @json($chartData);

const pengunjungChart = new Chart(ctx, {
    type: 'bar', // Changed to bar chart
    data: {
        labels: chartData.map(item => item.tanggal),
        datasets: [{
            label: 'Pengunjung',
            data: chartData.map(item => item.pengunjung),
            backgroundColor: '#4682B4',
            borderColor: '#4682B4',
            borderWidth: 1,
            barPercentage: 0.5,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: '#ccc',
                    drawBorder: false,
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
