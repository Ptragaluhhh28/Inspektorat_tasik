@extends('layouts.app')

@section('title', 'Statistik - Inspektorat Kota Tasikmalaya')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, rgba(8, 131, 149, 0.9), rgba(115, 200, 210, 0.9)),
                    url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 300"><polygon fill="%23ffffff15" points="0,0 1000,100 1000,300 0,200"/></svg>');
        background-size: cover;
        color: white;
        padding: 8rem 0 4rem;
        text-align: center;
    }

    .page-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .statistik-container {
        padding: 4rem 0;
    }

    .stats-overview {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin: 3rem 0;
    }

    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        text-align: center;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #088395, #73C8D2);
    }

    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        color: #088395;
        margin-bottom: 0.5rem;
        display: block;
    }

    .stat-label {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 1rem;
    }

    .stat-change {
        font-size: 0.9rem;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
    }

    .stat-change.positive {
        background: #d4edda;
        color: #155724;
    }

    .stat-change.negative {
        background: #f8d7da;
        color: #721c24;
    }

    .chart-container {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        margin: 2rem 0;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .chart-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 2rem;
        text-align: center;
    }

    .chart-placeholder {
        height: 300px;
        background: linear-gradient(135deg, #E9F8F9, #e9ecef);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        font-size: 1.1rem;
        border: 2px dashed #dee2e6;
    }

    .progress-section {
        margin: 4rem 0;
    }

    .progress-item {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .progress-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .progress-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .progress-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2c3e50;
    }

    .progress-percentage {
        font-size: 1.1rem;
        font-weight: 700;
        color: #088395;
    }

    .progress-bar-container {
        background: #f0f0f0;
        border-radius: 10px;
        height: 12px;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(135deg, #088395, #73C8D2);
        border-radius: 10px;
        transition: width 1s ease;
    }

    .table-container {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        margin: 2rem 0;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        overflow-x: auto;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }

    .data-table th,
    .data-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #f0f0f0;
    }

    .data-table th {
        background: #E9F8F9;
        font-weight: 600;
        color: #2c3e50;
        position: sticky;
        top: 0;
    }

    .data-table tr:hover {
        background: #E9F8F9;
    }

    .intro-section {
        background: #E9F8F9;
        padding: 4rem 0;
        margin-bottom: 3rem;
        border-radius: 20px;
    }

    .intro-content {
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
    }

    .intro-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 2rem;
    }

    .intro-text {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(135deg, #088395, #73C8D2);
        border-radius: 2px;
    }

    .filter-tabs {
        display: flex;
        justify-content: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .filter-tab {
        padding: 0.8rem 2rem;
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 30px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .filter-tab.active {
        background: linear-gradient(135deg, #088395, #73C8D2);
        color: white;
        border-color: #088395;
    }

    .filter-tab:hover {
        border-color: #088395;
        color: #088395;
    }

    .filter-tab.active:hover {
        color: white;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2.5rem;
        }
        
        .stat-number {
            font-size: 2.5rem;
        }
        
        .progress-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .filter-tabs {
            flex-direction: column;
            align-items: center;
        }
        
        .filter-tab {
            width: 200px;
            text-align: center;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-title" data-aos="fade-up">Statistik</h1>
        <p style="font-size: 1.2rem; opacity: 0.9; max-width: 600px; margin: 0 auto;" data-aos="fade-up" data-aos-delay="200">
            Data statistik kinerja dan capaian Inspektorat Kota Tasikmalaya
        </p>
    </div>
</section>

<!-- Introduction -->
<section class="statistik-container">
    <div class="container">
        <div class="intro-section" data-aos="fade-up">
            <div class="intro-content">
                <h2 class="intro-title">Statistik Kinerja Inspektorat</h2>
                <p class="intro-text">
                    Data statistik berikut menunjukkan kinerja dan capaian Inspektorat Kota Tasikmalaya dalam melaksanakan fungsi pengawasan internal pemerintah daerah. Data ini diperbaharui secara berkala untuk memberikan informasi yang akurat kepada publik.
                </p>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="filter-tabs" data-aos="fade-up">
            <div class="filter-tab active" onclick="showData('yearly')">Data Tahunan</div>
            <div class="filter-tab" onclick="showData('monthly')">Data Bulanan</div>
            <div class="filter-tab" onclick="showData('quarterly')">Data Kuartalan</div>
        </div>

        <!-- Statistics Overview -->
        <div class="stats-overview" id="yearly-data">
            <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                <span class="stat-number">147</span>
                <div class="stat-label">Total Kegiatan Pengawasan</div>
                <span class="stat-change positive">+12% dari tahun lalu</span>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                <span class="stat-number">89</span>
                <div class="stat-label">Laporan Pengawasan</div>
                <span class="stat-change positive">+8% dari tahun lalu</span>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                <span class="stat-number">52</span>
                <div class="stat-label">SKPD yang Diawasi</div>
                <span class="stat-change positive">100% coverage</span>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="400">
                <span class="stat-number">234</span>
                <div class="stat-label">Temuan Pengawasan</div>
                <span class="stat-change negative">-15% dari tahun lalu</span>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="500">
                <span class="stat-number">198</span>
                <div class="stat-label">Temuan Ditindaklanjuti</div>
                <span class="stat-change positive">84.6% tingkat penyelesaian</span>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="600">
                <span class="stat-number">67</span>
                <div class="stat-label">Pengaduan Masyarakat</div>
                <span class="stat-change positive">+23% dari tahun lalu</span>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="chart-container" data-aos="fade-up">
            <h3 class="chart-title">Tren Kegiatan Pengawasan 5 Tahun Terakhir</h3>
            <div class="chart-placeholder">
                <i class="fas fa-chart-line" style="font-size: 3rem; margin-right: 1rem; color: #088395;"></i>
                Grafik Tren Pengawasan 2020-2024
            </div>
        </div>

        <!-- Progress Section -->
        <div class="progress-section">
            <h2 class="section-title" data-aos="fade-up">Capaian Target 2024</h2>
            
            <div class="progress-item" data-aos="fade-up" data-aos-delay="100">
                <div class="progress-header">
                    <div class="progress-title">Target Pengawasan SKPD</div>
                    <div class="progress-percentage">96%</div>
                </div>
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: 96%"></div>
                </div>
            </div>
            
            <div class="progress-item" data-aos="fade-up" data-aos-delay="200">
                <div class="progress-header">
                    <div class="progress-title">Penyelesaian Temuan Audit</div>
                    <div class="progress-percentage">84%</div>
                </div>
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: 84%"></div>
                </div>
            </div>
            
            <div class="progress-item" data-aos="fade-up" data-aos-delay="300">
                <div class="progress-header">
                    <div class="progress-title">Implementasi SPIP</div>
                    <div class="progress-percentage">78%</div>
                </div>
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: 78%"></div>
                </div>
            </div>
            
            <div class="progress-item" data-aos="fade-up" data-aos-delay="400">
                <div class="progress-header">
                    <div class="progress-title">Kepuasan Stakeholder</div>
                    <div class="progress-percentage">91%</div>
                </div>
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: 91%"></div>
                </div>
            </div>
        </div>

        <!-- Chart Grid -->
        <div class="row">
            <div class="col-lg-6">
                <div class="chart-container" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="chart-title">Jenis Pengawasan 2024</h3>
                    <div class="chart-placeholder">
                        <i class="fas fa-chart-pie" style="font-size: 3rem; margin-right: 1rem; color: #088395;"></i>
                        Diagram Pie Jenis Pengawasan
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="chart-container" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="chart-title">Status Tindak Lanjut</h3>
                    <div class="chart-placeholder">
                        <i class="fas fa-chart-bar" style="font-size: 3rem; margin-right: 1rem; color: #088395;"></i>
                        Grafik Batang Status Tindak Lanjut
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="table-container" data-aos="fade-up">
            <h3 class="chart-title">Rekapitulasi Pengawasan per SKPD</h3>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama SKPD</th>
                        <th>Jumlah Pengawasan</th>
                        <th>Temuan</th>
                        <th>Tindak Lanjut</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Dinas Pendidikan</td>
                        <td>8</td>
                        <td>12</td>
                        <td>10</td>
                        <td><span class="stat-change positive">83%</span></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Dinas Kesehatan</td>
                        <td>6</td>
                        <td>9</td>
                        <td>8</td>
                        <td><span class="stat-change positive">89%</span></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Dinas PUPR</td>
                        <td>7</td>
                        <td>15</td>
                        <td>11</td>
                        <td><span class="stat-change positive">73%</span></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Dinas Sosial</td>
                        <td>5</td>
                        <td>8</td>
                        <td>7</td>
                        <td><span class="stat-change positive">88%</span></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>BAPPELITBANGDA</td>
                        <td>4</td>
                        <td>6</td>
                        <td>6</td>
                        <td><span class="stat-change positive">100%</span></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Dinas Perdagangan</td>
                        <td>3</td>
                        <td>4</td>
                        <td>3</td>
                        <td><span class="stat-change positive">75%</span></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Dinas Pariwisata</td>
                        <td>4</td>
                        <td>7</td>
                        <td>5</td>
                        <td><span class="stat-change positive">71%</span></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>BKPSDM</td>
                        <td>3</td>
                        <td>5</td>
                        <td>4</td>
                        <td><span class="stat-change positive">80%</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Additional Chart -->
        <div class="chart-container" data-aos="fade-up">
            <h3 class="chart-title">Perbandingan Kinerja dengan Target</h3>
            <div class="chart-placeholder">
                <i class="fas fa-chart-area" style="font-size: 3rem; margin-right: 1rem; color: #088395;"></i>
                Grafik Area Perbandingan Target vs Realisasi
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Initialize AOS
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true
    });

    // Tab filtering function
    function showData(period) {
        // Remove active class from all tabs
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.classList.remove('active');
        });
        
        // Add active class to clicked tab
        event.target.classList.add('active');
        
        // Update data based on period (this would typically fetch from API)
        updateStatsData(period);
    }

    function updateStatsData(period) {
        // This function would typically update the statistics based on the selected period
        // For demo purposes, we'll just show different sample data
        const stats = document.querySelectorAll('.stat-number');
        
        if (period === 'monthly') {
            stats[0].textContent = '12';
            stats[1].textContent = '8';
            stats[2].textContent = '15';
            stats[3].textContent = '18';
            stats[4].textContent = '14';
            stats[5].textContent = '6';
        } else if (period === 'quarterly') {
            stats[0].textContent = '38';
            stats[1].textContent = '23';
            stats[2].textContent = '42';
            stats[3].textContent = '56';
            stats[4].textContent = '47';
            stats[5].textContent = '17';
        } else {
            // yearly data (default)
            stats[0].textContent = '147';
            stats[1].textContent = '89';
            stats[2].textContent = '52';
            stats[3].textContent = '234';
            stats[4].textContent = '198';
            stats[5].textContent = '67';
        }
    }

    // Animate progress bars on scroll
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const progressBars = entry.target.querySelectorAll('.progress-bar');
                progressBars.forEach(bar => {
                    const width = bar.style.width;
                    bar.style.width = '0%';
                    setTimeout(() => {
                        bar.style.width = width;
                    }, 100);
                });
            }
        });
    }, observerOptions);

    document.querySelectorAll('.progress-section').forEach(section => {
        observer.observe(section);
    });
</script>
@endpush
