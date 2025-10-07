@extends('layouts.app')

@section('title', 'Tugas Pokok dan Fungsi - Inspektorat Kota Tasikmalaya')

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

    .tupoksi-container {
        padding: 4rem 0;
    }

    .tupoksi-section {
        margin-bottom: 4rem;
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

    .tupoksi-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
    }

    .tupoksi-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    .card-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #088395, #73C8D2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 2rem;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2c3e50;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .card-description {
        color: #666;
        line-height: 1.7;
        text-align: center;
        margin-bottom: 2rem;
    }

    .function-list {
        list-style: none;
        padding: 0;
    }

    .function-item {
        padding: 1rem 0;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: flex-start;
    }

    .function-item:last-child {
        border-bottom: none;
    }

    .function-number {
        background: linear-gradient(135deg, #088395, #73C8D2);
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .function-text {
        color: #555;
        line-height: 1.6;
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

    .stats-section {
        background: linear-gradient(135deg, #088395, #73C8D2);
        color: white;
        padding: 4rem 0;
        border-radius: 20px;
        margin: 4rem 0;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }

    .stat-item {
        text-align: center;
        padding: 2rem;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2.5rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .tupoksi-card {
            padding: 2rem 1.5rem;
        }
        
        .card-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-title" data-aos="fade-up">Tugas Pokok dan Fungsi</h1>
        <p style="font-size: 1.2rem; opacity: 0.9; max-width: 600px; margin: 0 auto;" data-aos="fade-up" data-aos-delay="200">
            Tugas pokok dan fungsi Inspektorat Kota Tasikmalaya dalam pengawasan internal pemerintah daerah
        </p>
    </div>
</section>

<!-- Introduction -->
<section class="tupoksi-container">
    <div class="container">
        <div class="intro-section" data-aos="fade-up">
            <div class="intro-content">
                <h2 class="intro-title">Tupoksi Inspektorat</h2>
                <p class="intro-text">
                    Inspektorat Kota Tasikmalaya merupakan unsur pengawas penyelenggaraan pemerintahan di bawah dan bertanggung jawab kepada Walikota. Inspektorat dipimpin oleh seorang Inspektur yang memiliki tugas pokok dan fungsi yang jelas dalam mendukung terwujudnya pemerintahan yang bersih dan akuntabel.
                </p>
            </div>
        </div>

        <!-- Tugas Pokok -->
        <div class="tupoksi-section">
            <h2 class="section-title" data-aos="fade-up">Tugas Pokok</h2>
            <div class="row">
                <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="tupoksi-card">
                        <div class="card-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="card-title">Pengawasan Internal</h3>
                        <p class="card-description">
                            Melaksanakan pengawasan terhadap pelaksanaan urusan pemerintahan di lingkungan Pemerintah Kota Tasikmalaya
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="tupoksi-card">
                        <div class="card-icon">
                            <i class="fas fa-city"></i>
                        </div>
                        <h3 class="card-title">Pembinaan SPIP</h3>
                        <p class="card-description">
                            Melaksanakan pembinaan atas penyelenggaraan Sistem Pengendalian Intern Pemerintah (SPIP)
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fungsi -->
        <div class="tupoksi-section">
            <h2 class="section-title" data-aos="fade-up">Fungsi Inspektorat</h2>
            <div class="row">
                <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="tupoksi-card">
                        <h3 class="card-title">Fungsi Pengawasan</h3>
                        <ul class="function-list">
                            <li class="function-item">
                                <span class="function-number">1</span>
                                <span class="function-text">Perencanaan program pengawasan</span>
                            </li>
                            <li class="function-item">
                                <span class="function-number">2</span>
                                <span class="function-text">Perumusan kebijakan dan fasilitasi pengawasan</span>
                            </li>
                            <li class="function-item">
                                <span class="function-number">3</span>
                                <span class="function-text">Pemeriksaan, pengusutan, pengujian, dan penilaian tugas pembantuan</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="tupoksi-card">
                        <h3 class="card-title">Fungsi Pembinaan</h3>
                        <ul class="function-list">
                            <li class="function-item">
                                <span class="function-number">1</span>
                                <span class="function-text">Perencanaan pembinaan penyelenggaraan SPIP</span>
                            </li>
                            <li class="function-item">
                                <span class="function-number">2</span>
                                <span class="function-text">Perumusan kebijakan pembinaan penyelenggaraan SPIP</span>
                            </li>
                            <li class="function-item">
                                <span class="function-number">3</span>
                                <span class="function-text">Evaluasi penyelenggaraan SPIP</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="stats-section" data-aos="fade-up">
            <div class="container">
                <div class="stats-grid">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                        <div class="stat-number">4</div>
                        <div class="stat-label">Bidang Pengawasan</div>
                    </div>
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">SKPD yang Diawasi</div>
                    </div>
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                        <div class="stat-number">100+</div>
                        <div class="stat-label">Laporan Pengawasan per Tahun</div>
                    </div>
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Pengawasan Berkelanjutan</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Functions -->
        <div class="tupoksi-section">
            <h2 class="section-title" data-aos="fade-up">Rincian Fungsi Inspektorat</h2>
            <div class="row">
                <div class="col-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="tupoksi-card">
                        <h3 class="card-title">Fungsi Lengkap Inspektorat Kota Tasikmalaya</h3>
                        <ul class="function-list">
                            <li class="function-item">
                                <span class="function-number">a</span>
                                <span class="function-text">Perencanaan program pengawasan</span>
                            </li>
                            <li class="function-item">
                                <span class="function-number">b</span>
                                <span class="function-text">Perumusan kebijakan dan fasilitasi pengawasan</span>
                            </li>
                            <li class="function-item">
                                <span class="function-number">c</span>
                                <span class="function-text">Pemeriksaan, pengusutan, pengujian, dan penilaian tugas pembantuan</span>
                            </li>
                            <li class="function-item">
                                <span class="function-number">d</span>
                                <span class="function-text">Perencanaan pembinaan penyelenggaraan Sistem Pengendalian Intern Pemerintah</span>
                            </li>
                            <li class="function-item">
                                <span class="function-number">e</span>
                                <span class="function-text">Perumusan kebijakan pembinaan penyelenggaraan Sistem Pengendalian Intern Pemerintah</span>
                            </li>
                            <li class="function-item">
                                <span class="function-number">f</span>
                                <span class="function-text">Evaluasi penyelenggaraan Sistem Pengendalian Intern Pemerintah</span>
                            </li>
                            <li class="function-item">
                                <span class="function-number">g</span>
                                <span class="function-text">Fasilitasi penyelenggaraan Sistem Pengendalian Intern Pemerintah</span>
                            </li>
                            <li class="function-item">
                                <span class="function-number">h</span>
                                <span class="function-text">Pelaksanaan urusan kesekretariatan Inspektorat</span>
                            </li>
                            <li class="function-item">
                                <span class="function-number">i</span>
                                <span class="function-text">Pelaksanaan fungsi lain yang diberikan oleh Walikota terkait dengan tugas dan fungsinya</span>
                            </li>
                        </ul>
                    </div>
                </div>
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
</script>
@endpush
