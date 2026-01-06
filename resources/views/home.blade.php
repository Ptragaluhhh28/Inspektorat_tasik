@extends('layouts.app')

@section('title', 'Inspektorat Kota Tasikmalaya - Mengawal Kinerja Berintegritas')

@push('styles')
<style>
    /* Remove unnecessary gaps */
    body {
        margin: 0;
        padding: 0;
        line-height: 1.6;
    }
    
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    section {
        margin: 0;
        padding: 0;
    }
    
    /* Ensure no gaps between sections */
    section + section {
        margin-top: 0;
    }
    
    /* Hero Section */
    .hero {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%),
        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 400"><polygon fill="%23ffffff15" points="0,0 1000,200 1000,400 0,300"/><polygon fill="%23ffffff08" points="0,100 1000,0 1000,150 0,250"/></svg>');
        background-size: cover;
        background-attachment: fixed;
        color: white;
        padding: 4rem 0 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
        margin: 0;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="%23ffffff20"/><circle cx="80" cy="40" r="1" fill="%23ffffff15"/><circle cx="40" cy="80" r="1.5" fill="%23ffffff10"/></svg>');
        animation: float 20s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .hero-content {
        max-width: 900px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    .hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        line-height: 1.2;
    }

    .hero-subtitle {
        font-size: 1.3rem;
        margin-bottom: 2rem;
        opacity: 0.95;
        font-weight: 300;
    }

    .hero-cta {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .cta-btn {
        padding: 1rem 2rem;
        font-size: 1.1rem;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .cta-primary {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(10px);
    }

    .cta-primary:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .cta-secondary {
        background: transparent;
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.5);
    }

    .cta-secondary:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
    }

    /* Stats Section */
    .stats-section {
        background: white;
        margin-top: -1rem;
        margin-bottom: 0;
        position: relative;
        z-index: 10;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 0;
    }

    .stat-item {
        padding: 3rem 2rem;
        text-align: center;
        position: relative;
        background: linear-gradient(135deg, #f8f9ff, #ffffff);
        border-right: 1px solid #e8ecef;
    }

    .stat-item:last-child {
        border-right: none;
    }

    .stat-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-size: 2rem;
        box-shadow: 0 10px 30px rgba(30, 64, 175, 0.3);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #666;
        font-weight: 500;
    }

    /* Services Section */
    .services-section {
        padding: 4rem 0 2rem;
        background: #f8f9ff;
        margin-top: 0;
        margin-bottom: 0;
    }

    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .section-subtitle {
        font-size: 1.2rem;
        color: #666;
        max-width: 600px;
        margin: 0 auto;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .service-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .service-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        color: white;
        font-size: 2rem;
    }

    .service-title {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #2c3e50;
    }

    .service-description {
        color: #666;
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }

    .service-link {
        color: #1e40af;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .service-link:hover {
        gap: 1rem;
    }

    /* News Section */
    .news-section {
        padding: 2rem 0 4rem;
        background: white;
        margin-top: 0;
        margin-bottom: 0;
    }

    .news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .news-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
    }

    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
    }

    .news-image {
        height: 200px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
    }

    .news-content {
        padding: 1.5rem;
    }

    .news-date {
        color: #1e40af;
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .news-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
        line-height: 1.4;
    }

    .news-excerpt {
        color: #666;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .news-link {
        color: #1e40af;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .news-link:hover {
        gap: 1rem;
    }

    /* Quick Links */
    .quick-links {
        background: linear-gradient(135deg, #2c3e50, #34495e);
        padding: 3rem 0;
        color: white;
        margin-top: 0;
        margin-bottom: 0;
    }

    .quick-links-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
    }

    .quick-link-item {
        text-align: center;
        padding: 2rem 1rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        transition: all 0.3s ease;
        text-decoration: none;
        color: white;
        backdrop-filter: blur(10px);
    }

    .quick-link-item:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-5px);
    }

    .quick-link-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #1e40af;
    }

    .quick-link-title {
        font-weight: 600;
        font-size: 1.1rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero {
            padding: 3rem 0 1.5rem;
        }
        
        .hero h1 {
            font-size: 2.5rem;
        }

        .hero-cta {
            flex-direction: column;
            align-items: center;
        }

        .cta-btn {
            width: 100%;
            max-width: 300px;
            justify-content: center;
        }

        .services-section {
            padding: 3rem 0 1.5rem;
        }
        
        .news-section {
            padding: 1.5rem 0 3rem;
        }
        
        .quick-links {
            padding: 2.5rem 0;
        }
        
        .section-header {
            margin-bottom: 2rem;
        }

        .services-grid,
        .news-grid {
            grid-template-columns: 1fr;
        }

        .stat-item {
            border-right: none;
            border-bottom: 1px solid #e8ecef;
            padding: 2rem 1rem;
        }

        .stat-item:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: 2rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content" data-aos="fade-up">
            <h1>Inspektorat Mengawal<br>Kinerja Berintegritas</h1>
            <p class="hero-subtitle">Meningkatkan Tata Kelola Pemerintahan Yang Baik dan Bersih di Kota Tasikmalaya</p>
            <div class="hero-cta">
                <a href="{{ route('tentang-kami') }}" class="cta-btn cta-primary">
                    <i class="fas fa-info-circle"></i> Tentang Kami
                </a>
                <a href="{{ route('kontak') }}" class="cta-btn cta-secondary">
                    <i class="fas fa-phone"></i> Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section - HIDDEN -->
{{-- <section class="container">
    <div class="stats-section" data-aos="fade-up" data-aos-delay="200">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number" data-count="150">0</div>
                <div class="stat-label">Pegawai</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="stat-number" data-count="25">0</div>
                <div class="stat-label">OPD</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-number" data-count="100">0</div>
                <div class="stat-label">Program</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="fas fa-award"></i>
                </div>
                <div class="stat-number" data-count="95">0</div>
                <div class="stat-label">Akreditasi</div>
            </div>
        </div>
    </div>
</section> --}}

{{-- Services Section - HIDDEN --}}
{{-- <section class="services-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Layanan Kami</h2>
            <p class="section-subtitle">Inspektorat Kota Tasikmalaya menyediakan berbagai layanan untuk meningkatkan kualitas tata kelola pemerintahan</p>
        </div>

        <div class="services-grid">
            <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                <div class="service-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="service-title">Quality Assurance</h3>
                <p class="service-description">Audit investigasi, Audit Kinerja, Reviu, dan Monitoring Evaluasi untuk memastikan kualitas penyelenggaraan pemerintahan.</p>
                <a href="{{ route('sakip') }}" class="service-link">
                    Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                <div class="service-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <h3 class="service-title">Consulting Activity</h3>
                <p class="service-description">Konsultasi, Pendampingan, Sosialisasi, dan Asistensi untuk mendukung peningkatan kinerja organisasi.</p>
                <a href="{{ route('berita.index') }}" class="service-link">
                    Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                <div class="service-icon">
                    <i class="fas fa-balance-scale"></i>
                </div>
                <h3 class="service-title">Accountability</h3>
                <p class="service-description">Akuntabilitas kinerja dengan evaluasi yang sehat untuk mewujudkan transparansi dan akuntabilitas publik.</p>
                <a href="{{ route('peraturan') }}" class="service-link">
                    Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section> --}}

<!-- News Section -->
<section class="news-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Berita Terbaru</h2>
            <p class="section-subtitle">Informasi terkini seputar kegiatan dan program Inspektorat Kota Tasikmalaya</p>
        </div>

        <div class="news-grid">
            <article class="news-card" data-aos="fade-up" data-aos-delay="100">
                <div class="news-image">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="news-content">
                    <div class="news-date">07 AGUSTUS 2025</div>
                    <h3 class="news-title">Rapat Koordinasi Evaluasi SPI 2025 dan Pencegahan Korupsi</h3>
                    <p class="news-excerpt">Pemerintah Kota Tasikmalaya melalui Inspektorat Daerah menggelar Rapat Koordinasi Evaluasi Rencana Aksi Pencegahan Korupsi...</p>
                    <a href="{{ route('berita.detail', 'rapat-koordinasi-evaluasi-spi-2025') }}" class="news-link">
                        Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>

            <article class="news-card" data-aos="fade-up" data-aos-delay="200">
                <div class="news-image">
                    <i class="fas fa-users"></i>
                </div>
                <div class="news-content">
                    <div class="news-date">29 JULI 2025</div>
                    <h3 class="news-title">Apel Pagi dan Penyampaian Program Strategis Pemerintah Kota</h3>
                    <p class="news-excerpt">Inspektorat Daerah Kota Tasikmalaya melaksanakan apel pagi yang dirangkaikan dengan penyampaian Program Strategis...</p>
                    <a href="{{ route('berita.detail', 'apel-pagi-program-strategis') }}" class="news-link">
                        Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>

            <article class="news-card" data-aos="fade-up" data-aos-delay="300">
                <div class="news-image">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="news-content">
                    <div class="news-date">29 MEI 2020</div>
                    <h3 class="news-title">Penyerahan Bantuan Sosial dari BAZNAS Kota Tasikmalaya</h3>
                    <p class="news-excerpt">Bertempat di Bale Kota Tasikmalaya Wali Kota Tasikmalaya menghadiri penyerahan bantuan sosial dari Baznas...</p>
                    <a href="{{ route('berita.detail', 'bantuan-sosial-baznas') }}" class="news-link">
                        Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>
        </div>

        <div style="text-align: center; margin-top: 3rem;" data-aos="fade-up" data-aos-delay="400">
            <a href="{{ route('berita.index') }}" class="btn">
                <i class="fas fa-newspaper"></i> Lihat Semua Berita
            </a>
        </div>
    </div>
</section>

<!-- Quick Links - HIDDEN -->
 <section class="quick-links">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title" style="color: white;">Akses Cepat</h2>
            <p class="section-subtitle" style="color: #bdc3c7;">Portal dan layanan digital untuk kemudahan akses informasi</p>
        </div>

        <div class="quick-links-grid">
            <a href="https://portal.tasikmalayakota.go.id/" target="_blank" class="quick-link-item" data-aos="fade-up" data-aos-delay="100">
                <div class="quick-link-icon">
                    <i class="fas fa-globe"></i>
                </div>
                <div class="quick-link-title">Portal Tasik</div>
            </a>

            <a href="https://lapor.go.id/" target="_blank" class="quick-link-item" data-aos="fade-up" data-aos-delay="200">
                <div class="quick-link-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="quick-link-title">Lapor</div>
            </a>

            <a href="https://data.tasikmalayakota.go.id/" target="_blank" class="quick-link-item" data-aos="fade-up" data-aos-delay="300">
                <div class="quick-link-icon">
                    <i class="fas fa-database"></i>
                </div>
                <div class="quick-link-title">Open Data</div>
            </a>

            <a href="https://jdih.tasikmalayakota.go.id/" target="_blank" class="quick-link-item" data-aos="fade-up" data-aos-delay="400">
                <div class="quick-link-icon">
                    <i class="fas fa-gavel"></i>
                </div>
                <div class="quick-link-title">JDIH</div>
            </a>
        </div>
    </div>
</section> 
@endsection

@push('scripts')
<script>
    // Counter animation
    function animateCounters() {
        const counters = document.querySelectorAll('[data-count]');
        
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count'));
            const increment = target / 100;
            let current = 0;
            
            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    counter.textContent = Math.ceil(current);
                    setTimeout(updateCounter, 20);
                } else {
                    counter.textContent = target;
                }
            };
            
            // Start animation when element is in viewport
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateCounter();
                        observer.unobserve(entry.target);
                    }
                });
            });
            
            observer.observe(counter);
        });
    }

    // Initialize counter animation
    document.addEventListener('DOMContentLoaded', animateCounters);
</script>
@endpush
