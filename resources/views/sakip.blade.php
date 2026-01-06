@extends('layouts.app')

@section('title', 'SAKIP - Inspektorat Kota Tasikmalaya')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        background-size: cover;
        color: white;
        padding: 4rem 0;
        text-align: center;
    }

    .page-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        letter-spacing: -0.02em;
    }

    .sakip-container {
        padding: 4rem 0;
    }

    .intro-section {
        max-width: 800px;
        margin: 0 auto 4rem;
        text-align: center;
    }

    .intro-text {
        font-size: 1.2rem;
        line-height: 1.8;
        color: #555;
        margin-bottom: 2rem;
    }

    .sakip-overview {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 4rem;
    }

    .overview-card {
        background: white;
        border-radius: 16px;
        padding: 2.5rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        text-align: center;
        border: 1px solid #f0f0f0;
        position: relative;
        overflow: hidden;
    }

    .overview-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
    }

    .overview-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .overview-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 2rem;
    }

    .overview-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .overview-description {
        color: #666;
        line-height: 1.6;
    }

    .documents-section {
        background: #eff6ff;
        padding: 4rem 0;
        margin: 4rem 0;
        border-radius: 20px;
    }

    .section-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 3rem;
    }

    .documents-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
    }

    .document-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
    }

    .document-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .document-header {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .document-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .document-info {
        flex: 1;
    }

    .document-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }

    .document-year {
        color: #1e40af;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .document-description {
        color: #666;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .document-actions {
        display: flex;
        gap: 1rem;
    }

    .action-btn {
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
    }

    .btn-view {
        background: rgba(8, 131, 149, 0.1);
        color: #1e40af;
        border: 1px solid rgba(8, 131, 149, 0.2);
    }

    .btn-download {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
        border: 1px solid transparent;
    }

    .action-btn:hover {
        transform: translateY(-2px);
    }

    .btn-view:hover {
        background: #1e40af;
        color: white;
        text-decoration: none;
    }

    .btn-download:hover {
        box-shadow: 0 10px 30px rgba(8, 131, 149, 0.3);
        color: white;
        text-decoration: none;
    }

    .performance-metrics {
        margin-bottom: 4rem;
    }

    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }

    .metric-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .metric-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
    }

    .metric-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .metric-value {
        font-size: 3rem;
        font-weight: 700;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .metric-label {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .metric-description {
        color: #666;
        font-size: 0.9rem;
    }

    .evaluation-timeline {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        margin-bottom: 4rem;
    }

    .timeline-title {
        text-align: center;
        font-size: 2.2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 3rem;
    }

    .timeline {
        position: relative;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, #1e40af, #3b82f6);
        transform: translateX(-50%);
    }

    .timeline-item {
        display: flex;
        align-items: center;
        margin-bottom: 3rem;
        position: relative;
    }

    .timeline-item:nth-child(odd) .timeline-content {
        margin-right: auto;
        margin-left: 0;
        text-align: right;
        padding-right: 2rem;
    }

    .timeline-item:nth-child(even) .timeline-content {
        margin-left: auto;
        margin-right: 0;
        text-align: left;
        padding-left: 2rem;
    }

    .timeline-content {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        width: 45%;
        position: relative;
    }

    .timeline-date {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 0.5rem;
    }

    .timeline-title-item {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .timeline-description {
        color: #666;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .timeline-dot {
        position: absolute;
        left: 50%;
        width: 16px;
        height: 16px;
        background: white;
        border: 3px solid #1e40af;
        border-radius: 50%;
        transform: translateX(-50%);
        z-index: 2;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2.5rem;
        }
        
        .documents-grid {
            grid-template-columns: 1fr;
        }
        
        .document-actions {
            flex-direction: column;
        }
        
        .timeline::before {
            left: 20px;
        }
        
        .timeline-item:nth-child(odd) .timeline-content,
        .timeline-item:nth-child(even) .timeline-content {
            width: calc(100% - 60px);
            margin-left: 60px;
            margin-right: 0;
            text-align: left;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        .timeline-dot {
            left: 20px;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-title" data-aos="fade-up">SAKIP</h1>
        <p style="font-size: 1.2rem; opacity: 0.9; max-width: 700px; margin: 0 auto;" data-aos="fade-up" data-aos-delay="200">
            Sistem Akuntabilitas Kinerja Instansi Pemerintah - Evaluasi dan Pelaporan Kinerja Inspektorat Kota Tasikmalaya
        </p>
    </div>
</section>

<!-- SAKIP Container -->
<section class="sakip-container">
    <div class="container">
        <!-- Introduction -->
        <div class="intro-section" data-aos="fade-up">
            <p class="intro-text">
                SAKIP (Sistem Akuntabilitas Kinerja Instansi Pemerintah) merupakan rangkaian sistematik berbagai aktivitas, alat, dan prosedur yang dirancang untuk tujuan penetapan dan pengukuran, pengumpulan data, pengklasifikasian, pengikhtisaran, dan pelaporan kinerja pada instansi pemerintah, dalam rangka pertanggungjawaban dan peningkatan kinerja instansi pemerintah.
            </p>
        </div>

        <!-- SAKIP Overview - HIDDEN -->
        {{-- <div class="sakip-overview">
            <div class="overview-card" data-aos="fade-up" data-aos-delay="100">
                <div class="overview-icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3 class="overview-title">Perencanaan Kinerja</h3>
                <p class="overview-description">
                    Penyusunan rencana strategis, rencana kinerja tahunan, dan penetapan indikator kinerja yang terukur dan dapat dipertanggungjawabkan.
                </p>
            </div>

            <div class="overview-card" data-aos="fade-up" data-aos-delay="200">
                <div class="overview-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="overview-title">Pengukuran Kinerja</h3>
                <p class="overview-description">
                    Proses pengumpulan data dan pengukuran capaian kinerja berdasarkan indikator yang telah ditetapkan dalam perencanaan.
                </p>
            </div>

            <div class="overview-card" data-aos="fade-up" data-aos-delay="300">
                <div class="overview-icon">
                    <i class="fas fa-file-chart-line"></i>
                </div>
                <h3 class="overview-title">Pelaporan Kinerja</h3>
                <p class="overview-description">
                    Penyusunan laporan kinerja secara berkala sebagai bentuk pertanggungjawaban atas pencapaian kinerja instansi.
                </p>
            </div>

            <div class="overview-card" data-aos="fade-up" data-aos-delay="400">
                <div class="overview-icon">
                    <i class="fas fa-search-plus"></i>
                </div>
                <h3 class="overview-title">Evaluasi Kinerja</h3>
                <p class="overview-description">
                    Proses analisis dan evaluasi atas capaian kinerja untuk perbaikan dan peningkatan kinerja di masa mendatang.
                </p>
            </div>
        </div> --}}

        <!-- Performance Metrics -->
        <!-- Performance Metrics - HIDDEN -->
        {{-- <div class="performance-metrics">
            <h2 class="section-title" data-aos="fade-up">Capaian Kinerja 2024</h2>
            <div class="metrics-grid">
                <div class="metric-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="metric-value">95%</div>
                    <div class="metric-label">Tingkat Capaian IKU</div>
                    <div class="metric-description">Indikator Kinerja Utama</div>
                </div>

                <div class="metric-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="metric-value">A</div>
                    <div class="metric-label">Nilai SAKIP</div>
                    <div class="metric-description">Evaluasi SAKIP Tahun 2024</div>
                </div>

                <div class="metric-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="metric-value">12</div>
                    <div class="metric-label">Program Strategis</div>
                    <div class="metric-description">Program yang dilaksanakan</div>
                </div>

                <div class="metric-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="metric-value">38</div>
                    <div class="metric-label">Kegiatan Audit</div>
                    <div class="metric-description">Audit yang telah selesai</div>
                </div>
            </div>
        </div> --}}

        <!-- Documents Section -->
        <div class="documents-section">
            <div class="container">
                <h2 class="section-title" data-aos="fade-up">Dokumen SAKIP</h2>
                <div class="documents-grid">
                    <div class="document-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="document-header">
                            <div class="document-icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <div class="document-info">
                                <h3 class="document-title">Laporan Kinerja (LAKIN)</h3>
                                <div class="document-year">Tahun 2024</div>
                            </div>
                        </div>
                        <p class="document-description">
                            Laporan pertanggungjawaban kinerja Inspektorat Kota Tasikmalaya yang memuat pencapaian kinerja berdasarkan rencana strategis dan rencana kerja tahunan.
                        </p>
                        <div class="document-actions">
                            <a href="#" class="action-btn btn-view">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <a href="#" class="action-btn btn-download">
                                <i class="fas fa-download"></i> Unduh
                            </a>
                        </div>
                    </div>

                    <div class="document-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="document-header">
                            <div class="document-icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                            <div class="document-info">
                                <h3 class="document-title">Rencana Strategis (RENSTRA)</h3>
                                <div class="document-year">2025-2029</div>
                            </div>
                        </div>
                        <p class="document-description">
                            Dokumen perencanaan strategis Inspektorat untuk periode 5 tahun yang memuat visi, misi, tujuan, sasaran strategis, dan program/kegiatan.
                        </p>
                        <div class="document-actions">
                            <a href="#" class="action-btn btn-view">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <a href="#" class="action-btn btn-download">
                                <i class="fas fa-download"></i> Unduh
                            </a>
                        </div>
                    </div>

                    <div class="document-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="document-header">
                            <div class="document-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="document-info">
                                <h3 class="document-title">Rencana Kerja Tahunan (RENJA)</h3>
                                <div class="document-year">Tahun 2025</div>
                            </div>
                        </div>
                        <p class="document-description">
                            Penjabaran dari Renstra dalam bentuk rencana kerja tahunan yang memuat program, kegiatan, indikator kinerja dan anggaran.
                        </p>
                        <div class="document-actions">
                            <a href="#" class="action-btn btn-view">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <a href="#" class="action-btn btn-download">
                                <i class="fas fa-download"></i> Unduh
                            </a>
                        </div>
                    </div>

                    <div class="document-card" data-aos="fade-up" data-aos-delay="400">
                        <div class="document-header">
                            <div class="document-icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <div class="document-info">
                                <h3 class="document-title">Perjanjian Kinerja (PK)</h3>
                                <div class="document-year">Tahun 2025</div>
                            </div>
                        </div>
                        <p class="document-description">
                            Dokumen komitmen kinerja yang berisi sasaran kinerja beserta indikator kinerja yang akan dicapai dalam satu tahun anggaran.
                        </p>
                        <div class="document-actions">
                            <a href="#" class="action-btn btn-view">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <a href="#" class="action-btn btn-download">
                                <i class="fas fa-download"></i> Unduh
                            </a>
                        </div>
                    </div>

                    <div class="document-card" data-aos="fade-up" data-aos-delay="500">
                        <div class="document-header">
                            <div class="document-icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <div class="document-info">
                                <h3 class="document-title">Laporan Kinerja Triwulan</h3>
                                <div class="document-year">Q4 2024</div>
                            </div>
                        </div>
                        <p class="document-description">
                            Laporan pencapaian kinerja secara berkala setiap triwulan sebagai monitoring dan evaluasi pelaksanaan kegiatan.
                        </p>
                        <div class="document-actions">
                            <a href="#" class="action-btn btn-view">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <a href="#" class="action-btn btn-download">
                                <i class="fas fa-download"></i> Unduh
                            </a>
                        </div>
                    </div>

                    <div class="document-card" data-aos="fade-up" data-aos-delay="600">
                        <div class="document-header">
                            <div class="document-icon">
                                <i class="fas fa-award"></i>
                            </div>
                            <div class="document-info">
                                <h3 class="document-title">Evaluasi SAKIP</h3>
                                <div class="document-year">Tahun 2024</div>
                            </div>
                        </div>
                        <p class="document-description">
                            Hasil evaluasi SAKIP oleh inspektorat internal yang memuat penilaian terhadap penerapan sistem akuntabilitas kinerja.
                        </p>
                        <div class="document-actions">
                            <a href="#" class="action-btn btn-view">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <a href="#" class="action-btn btn-download">
                                <i class="fas fa-download"></i> Unduh
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Evaluation Timeline - HIDDEN -->
        {{-- <div class="evaluation-timeline" data-aos="fade-up">
            <h2 class="timeline-title">Timeline Evaluasi SAKIP 2025</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <span class="timeline-date">Januari 2025</span>
                        <h4 class="timeline-title-item">Penyusunan Rencana Kerja</h4>
                        <p class="timeline-description">Finalisasi RENJA dan Perjanjian Kinerja untuk tahun 2025</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <span class="timeline-date">Maret 2025</span>
                        <h4 class="timeline-title-item">Laporan Triwulan I</h4>
                        <p class="timeline-description">Penyusunan laporan capaian kinerja triwulan pertama</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <span class="timeline-date">Juni 2025</span>
                        <h4 class="timeline-title-item">Laporan Triwulan II</h4>
                        <p class="timeline-description">Evaluasi capaian kinerja semester pertama dan penyesuaian strategi</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <span class="timeline-date">September 2025</span>
                        <h4 class="timeline-title-item">Laporan Triwulan III</h4>
                        <p class="timeline-description">Monitoring pencapaian target dan identifikasi hambatan</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <span class="timeline-date">Desember 2025</span>
                        <h4 class="timeline-title-item">Laporan Kinerja Tahunan</h4>
                        <p class="timeline-description">Penyusunan LAKIN dan evaluasi kinerja tahunan lengkap</p>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Document interaction
    document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (this.classList.contains('btn-download')) {
                // Simulate file download
                const documentTitle = this.closest('.document-card').querySelector('.document-title').textContent;
                alert(`Mengunduh: ${documentTitle}`);
            } else if (this.classList.contains('btn-view')) {
                // Simulate document view
                const documentTitle = this.closest('.document-card').querySelector('.document-title').textContent;
                alert(`Membuka: ${documentTitle}`);
            }
        });
    });

    // Counter animation for metrics
    function animateCounters() {
        const counters = document.querySelectorAll('.metric-value');
        
        counters.forEach(counter => {
            const target = counter.textContent.replace(/[^0-9]/g, '');
            const isPercentage = counter.textContent.includes('%');
            const isLetter = isNaN(target);
            
            if (!isLetter && target) {
                let current = 0;
                const increment = target / 50;
                
                const updateCounter = () => {
                    if (current < target) {
                        current += increment;
                        counter.textContent = Math.floor(current) + (isPercentage ? '%' : '');
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target + (isPercentage ? '%' : '');
                    }
                };
                
                updateCounter();
            }
        });
    }

    // Trigger counter animation when section comes into view
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    const metricsSection = document.querySelector('.performance-metrics');
    if (metricsSection) {
        observer.observe(metricsSection);
    }
</script>
@endpush
