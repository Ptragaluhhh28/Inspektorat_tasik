@extends('layouts.app')

@section('title', 'Sejarah - Inspektorat Kota Tasikmalaya')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        color: white;
        padding: 4rem 0;
        text-align: center;
    }

    .page-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .history-container {
        padding: 4rem 0;
    }

    .timeline {
        position: relative;
        max-width: 800px;
        margin: 0 auto;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(to bottom, #1e40af, #3b82f6);
        transform: translateX(-50%);
    }

    .timeline-item {
        display: flex;
        align-items: center;
        margin-bottom: 4rem;
        position: relative;
    }

    .timeline-item:nth-child(odd) .timeline-content {
        margin-right: auto;
        margin-left: 0;
        text-align: right;
        padding-right: 3rem;
    }

    .timeline-item:nth-child(even) .timeline-content {
        margin-left: auto;
        margin-right: 0;
        text-align: left;
        padding-left: 3rem;
    }

    .timeline-content {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        width: 45%;
        position: relative;
        transition: all 0.3s ease;
    }

    .timeline-content:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .timeline-year {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-size: 1rem;
        font-weight: 700;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .timeline-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .timeline-description {
        color: #666;
        line-height: 1.7;
    }

    .timeline-dot {
        position: absolute;
        left: 50%;
        width: 20px;
        height: 20px;
        background: white;
        border: 4px solid #1e40af;
        border-radius: 50%;
        transform: translateX(-50%);
        z-index: 2;
    }

    .intro-section {
        background: #E9F8F9;
        padding: 4rem 0;
        margin-bottom: 2rem;
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

    @media (max-width: 768px) {
        .page-title {
            font-size: 2.5rem;
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
        <h1 class="page-title" data-aos="fade-up">Sejarah</h1>
        <p style="font-size: 1.2rem; opacity: 0.9; max-width: 600px; margin: 0 auto;" data-aos="fade-up" data-aos-delay="200">
            Perjalanan sejarah Inspektorat Kota Tasikmalaya dari masa ke masa
        </p>
    </div>
</section>

<!-- Introduction -->
<section class="history-container">
    <div class="container">
        <div class="intro-section" data-aos="fade-up">
            <div class="intro-content">
                <h2 class="intro-title">Sejarah Inspektorat Kota Tasikmalaya</h2>
                <p class="intro-text">
                    Inspektorat Kota Tasikmalaya merupakan salah satu organ pemerintahan yang memiliki peran penting dalam sistem pengawasan internal pemerintah daerah. Sejak dibentuk, Inspektorat telah mengalami berbagai perkembangan seiring dengan dinamika pemerintahan dan kebutuhan masyarakat akan tata kelola pemerintahan yang baik.
                </p>
            </div>
        </div>

        <!-- Timeline -->
        <div class="timeline">
            <div class="timeline-item" data-aos="fade-up" data-aos-delay="100">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="timeline-year">1971</span>
                    <h3 class="timeline-title">Pembentukan Awal</h3>
                    <p class="timeline-description">
                        Berdasarkan Undang-Undang Nomor 5 Tahun 1974 tentang Pokok-Pokok Pemerintahan di Daerah, dibentuk unit pengawasan dalam struktur pemerintahan daerah yang merupakan cikal bakal Inspektorat Daerah.
                    </p>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up" data-aos-delay="200">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="timeline-year">1999</span>
                    <h3 class="timeline-title">Era Reformasi</h3>
                    <p class="timeline-description">
                        Pasca reformasi, dengan lahirnya UU No. 22 Tahun 1999 tentang Pemerintahan Daerah, fungsi pengawasan internal semakin diperkuat dengan pembentukan Inspektorat Daerah yang lebih mandiri dan profesional.
                    </p>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up" data-aos-delay="300">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="timeline-year">2001</span>
                    <h3 class="timeline-title">Kota Tasikmalaya Terbentuk</h3>
                    <p class="timeline-description">
                        Dengan terbentuknya Kota Tasikmalaya sebagai daerah otonom berdasarkan UU No. 10 Tahun 2001, dibentuk pula Inspektorat Kota Tasikmalaya sebagai bagian dari struktur organisasi pemerintah daerah.
                    </p>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up" data-aos-delay="400">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="timeline-year">2004</span>
                    <h3 class="timeline-title">Penguatan Kelembagaan</h3>
                    <p class="timeline-description">
                        Dengan terbitnya UU No. 32 Tahun 2004 tentang Pemerintahan Daerah, Inspektorat Kota Tasikmalaya mengalami penguatan kelembagaan dengan struktur organisasi yang lebih jelas dan tugas fungsi yang lebih spesifik.
                    </p>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up" data-aos-delay="500">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="timeline-year">2008</span>
                    <h3 class="timeline-title">Implementasi SPIP</h3>
                    <p class="timeline-description">
                        Mulai menerapkan Sistem Pengendalian Intern Pemerintah (SPIP) berdasarkan PP No. 60 Tahun 2008, yang memperkuat peran Inspektorat dalam pencegahan korupsi dan peningkatan akuntabilitas.
                    </p>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up" data-aos-delay="600">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="timeline-year">2014</span>
                    <h3 class="timeline-title">Era Pemerintahan Modern</h3>
                    <p class="timeline-description">
                        Dengan lahirnya UU No. 23 Tahun 2014 tentang Pemerintahan Daerah, Inspektorat Kota Tasikmalaya semakin mengoptimalkan perannya dalam mendukung terwujudnya good governance dan clean government.
                    </p>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up" data-aos-delay="700">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="timeline-year">2020</span>
                    <h3 class="timeline-title">Digitalisasi Pengawasan</h3>
                    <p class="timeline-description">
                        Menghadapi era digital dan pandemi COVID-19, Inspektorat mulai mengimplementasikan sistem pengawasan berbasis teknologi informasi untuk meningkatkan efektivitas dan efisiensi pengawasan.
                    </p>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up" data-aos-delay="800">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="timeline-year">2025</span>
                    <h3 class="timeline-title">Pengawasan Masa Depan</h3>
                    <p class="timeline-description">
                        Saat ini, Inspektorat Kota Tasikmalaya terus berinovasi dalam melaksanakan fungsi pengawasan dengan menerapkan teknologi terkini dan metodologi audit modern untuk mendukung pencapaian visi "Tasikmalaya HEBAT".
                    </p>
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
