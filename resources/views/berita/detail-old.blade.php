@extends('layouts.app')

@section('title', 'Rapat Koordinasi Evaluasi SPI 2025 - Berita - Inspektorat Kota Tasikmalaya')

@push('styles')
<style>
    .article-header {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        color: white;
        padding: 4rem 0;
    }

    .breadcrumb {
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .breadcrumb a {
        color: white;
        text-decoration: none;
        opacity: 0.8;
        transition: opacity 0.3s ease;
    }

    .breadcrumb a:hover {
        opacity: 1;
    }

    .breadcrumb span {
        margin: 0 0.5rem;
        opacity: 0.6;
    }

    .article-category {
        display: inline-block;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 1rem;
        backdrop-filter: blur(10px);
    }

    .article-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 2rem;
        line-height: 1.2;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .article-meta {
        display: flex;
        gap: 2rem;
        flex-wrap: wrap;
        font-size: 1rem;
        opacity: 0.9;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .article-content {
        padding: 4rem 0;
    }

    .article-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .article-image {
        width: 100%;
        height: 400px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        border-radius: 16px;
        margin-bottom: 3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 4rem;
        position: relative;
        overflow: hidden;
    }

    .article-image::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="%23ffffff20"/><circle cx="80" cy="40" r="1" fill="%23ffffff15"/></svg>');
    }

    .article-body {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #333;
    }

    .article-body h2 {
        font-size: 1.8rem;
        font-weight: 600;
        color: #2c3e50;
        margin: 3rem 0 1.5rem;
        position: relative;
        padding-left: 1rem;
    }

    .article-body h2::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        border-radius: 2px;
    }

    .article-body p {
        margin-bottom: 1.5rem;
        text-align: justify;
    }

    .article-body blockquote {
        background: #E9F8F9;
        border-left: 4px solid #1e40af;
        padding: 1.5rem 2rem;
        margin: 2rem 0;
        border-radius: 0 8px 8px 0;
        font-style: italic;
    }

    .article-body ul, .article-body ol {
        margin-bottom: 1.5rem;
        padding-left: 2rem;
    }

    .article-body li {
        margin-bottom: 0.5rem;
    }

    .share-section {
        background: #E9F8F9;
        padding: 2rem;
        border-radius: 16px;
        margin: 3rem 0;
        text-align: center;
    }

    .share-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .share-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .share-btn {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        outline: none;
        border: none;
    }

    .share-btn:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.2);
    }

    .share-btn:active {
        transform: translateY(-1px);
        outline: none;
    }

    .share-btn.facebook {
        background: #3b5998;
        color: white;
    }

    .share-btn.twitter {
        background: #1da1f2;
        color: white;
    }

    .share-btn.whatsapp {
        background: #25d366;
        color: white;
    }

    .share-btn.telegram {
        background: #0088cc;
        color: white;
    }

    .share-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .related-news {
        background: #E9F8F9;
        padding: 4rem 0;
    }

    .related-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 3rem;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .related-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
    }

    .related-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        color: inherit;
        text-decoration: none;
    }

    .related-image {
        height: 150px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
    }

    .related-content {
        padding: 1.5rem;
    }

    .related-category {
        display: inline-block;
        background: rgba(30, 64, 175, 0.1);
        color: #1e40af;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .related-title-card {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .related-date {
        color: #666;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .back-to-news {
        margin-bottom: 2rem;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #1e40af;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        gap: 1rem;
        color: #5a6fd8;
    }

    @media (max-width: 768px) {
        .article-title {
            font-size: 2.5rem;
        }
        
        .article-meta {
            gap: 1rem;
        }
        
        .article-image {
            height: 250px;
            font-size: 3rem;
        }
        
        .article-body {
            font-size: 1rem;
        }
        
        .share-buttons {
            gap: 0.5rem;
        }
        
        .share-btn {
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
        }
        
        .related-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<!-- Article Header -->
<section class="article-header">
    <div class="container">
        <div class="article-container">
            <!-- Breadcrumb -->
            <nav class="breadcrumb" data-aos="fade-up">
                <a href="{{ route('home') }}">Beranda</a>
                <span>/</span>
                <a href="{{ route('berita.index') }}">Berita</a>
                <span>/</span>
                <span>Rapat Koordinasi Evaluasi SPI 2025</span>
            </nav>

            <!-- Category -->
            <span class="article-category" data-aos="fade-up" data-aos-delay="100">Kegiatan</span>

            <!-- Title -->
            <h1 class="article-title" data-aos="fade-up" data-aos-delay="200">
                Rapat Koordinasi Evaluasi SPI 2025 dan Pencegahan Korupsi di Pemerintah Kota Tasikmalaya
            </h1>

            <!-- Meta -->
            <div class="article-meta" data-aos="fade-up" data-aos-delay="300">
                <div class="meta-item">
                    <i class="fas fa-calendar"></i>
                    <span>07 Agustus 2025</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-user"></i>
                    <span>Admin Inspektorat</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-eye"></i>
                    <span>1,234 views</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Article Content -->
<section class="article-content">
    <div class="container">
        <div class="article-container">
            <!-- Back Button -->
            <div class="back-to-news" data-aos="fade-up">
                <a href="{{ route('berita.index') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Kembali ke Berita
                </a>
            </div>

            <!-- Article Image -->
            <div class="article-image" data-aos="fade-up" data-aos-delay="100">
                <i class="fas fa-users"></i>
            </div>

            <!-- Article Body -->
            <div class="article-body" data-aos="fade-up" data-aos-delay="200">
                <p>
                    <strong>Tasikmalaya, 5 Agustus 2025</strong> — Pemerintah Kota Tasikmalaya melalui Inspektorat Daerah menggelar Rapat Koordinasi Evaluasi Rencana Aksi Pencegahan Korupsi dan Penguatan Sistem Pengendalian Intern (SPI) untuk meningkatkan tata kelola pemerintahan yang baik dan bersih.
                </p>

                <p>
                    Kegiatan yang dilaksanakan di Ruang Rapat Inspektorat Kota Tasikmalaya ini dihadiri oleh seluruh pejabat struktural dan fungsional di lingkungan Inspektorat, serta perwakilan dari berbagai Organisasi Perangkat Daerah (OPD) di lingkungan Pemerintah Kota Tasikmalaya.
                </p>

                <h2>Tujuan dan Sasaran Kegiatan</h2>

                <p>
                    Inspektur Kota Tasikmalaya, Drs. H. Ahmad Sudrajat, M.Si., dalam sambutannya menyampaikan bahwa rapat koordinasi ini memiliki beberapa tujuan strategis yang sangat penting bagi kemajuan tata kelola pemerintahan di Kota Tasikmalaya.
                </p>

                <blockquote>
                    "Evaluasi SPI dan pencegahan korupsi bukan hanya tanggung jawab Inspektorat, tetapi merupakan komitmen bersama seluruh komponen pemerintahan untuk mewujudkan good governance yang berintegritas tinggi."
                </blockquote>

                <p>
                    Adapun tujuan utama dari kegiatan ini meliputi:
                </p>

                <ul>
                    <li>Mengevaluasi implementasi Sistem Pengendalian Intern Pemerintah (SPIP) di seluruh OPD</li>
                    <li>Menyusun rencana aksi pencegahan korupsi yang lebih efektif dan komprehensif</li>
                    <li>Meningkatkan koordinasi antar OPD dalam penerapan sistem pengawasan internal</li>
                    <li>Memperkuat komitmen bersama dalam mewujudkan pemerintahan yang bersih dan bebas korupsi</li>
                    <li>Menyinkronkan program-program pencegahan korupsi dengan rencana strategis daerah</li>
                </ul>

                <h2>Materi dan Pembahasan</h2>

                <p>
                    Dalam rapat koordinasi tersebut, dibahas berbagai materi penting yang berkaitan dengan penguatan sistem pengawasan internal dan pencegahan korupsi, antara lain:
                </p>

                <ol>
                    <li><strong>Evaluasi Implementasi SPIP 2024:</strong> Presentasi hasil evaluasi penerapan SPIP di masing-masing OPD beserta rekomendasi perbaikan yang diperlukan.</li>
                    <li><strong>Rencana Aksi Pencegahan Korupsi 2025:</strong> Pembahasan strategi dan program-program inovatif untuk mencegah terjadinya praktik korupsi di lingkungan pemerintahan.</li>
                    <li><strong>Sistem Pelaporan dan Monitoring:</strong> Sosialisasi mekanisme pelaporan dan sistem monitoring yang akan diterapkan untuk memantau efektivitas program pencegahan korupsi.</li>
                    <li><strong>Capacity Building:</strong> Rencana program peningkatan kapasitas SDM dalam bidang pengawasan dan pencegahan korupsi.</li>
                </ol>

                <h2>Komitmen dan Langkah Strategis</h2>

                <p>
                    Sebagai hasil dari rapat koordinasi ini, seluruh peserta sepakat untuk mengimplementasikan beberapa langkah strategis dalam rangka memperkuat sistem pengawasan dan pencegahan korupsi di Kota Tasikmalaya.
                </p>

                <p>
                    Wakil Wali Kota Tasikmalaya, Dr. H. Mohammad Taufik, S.H., M.H., yang turut hadir dalam kegiatan ini menegaskan komitmen Pemerintah Kota Tasikmalaya untuk terus mendukung upaya pencegahan korupsi dan penguatan tata kelola pemerintahan.
                </p>

                <blockquote>
                    "Kita harus memastikan bahwa setiap rupiah anggaran daerah digunakan secara optimal untuk kesejahteraan masyarakat. Tidak ada toleransi untuk praktik-praktik yang merugikan kepentingan publik."
                </blockquote>

                <h2>Rencana Tindak Lanjut</h2>

                <p>
                    Beberapa rencana tindak lanjut yang akan dilaksanakan pasca rapat koordinasi ini meliputi:
                </p>

                <ul>
                    <li>Penyusunan roadmap implementasi SPIP yang terintegrasi dengan sistem perencanaan daerah</li>
                    <li>Pelaksanaan bimbingan teknis SPIP untuk seluruh OPD secara berkala</li>
                    <li>Pembentukan tim monitoring dan evaluasi pencegahan korupsi di tingkat OPD</li>
                    <li>Pengembangan sistem informasi pengawasan yang berbasis teknologi digital</li>
                    <li>Peningkatan koordinasi dengan lembaga penegak hukum dalam upaya pencegahan dan penindakan korupsi</li>
                </ul>

                <p>
                    Dengan adanya rapat koordinasi ini, diharapkan implementasi SPIP dan program pencegahan korupsi di Kota Tasikmalaya dapat berjalan lebih efektif dan berkelanjutan, sehingga tercipta tata kelola pemerintahan yang semakin baik dan dapat memberikan pelayanan terbaik kepada masyarakat.
                </p>

                <p>
                    Kegiatan serupa akan terus dilaksanakan secara rutin sebagai bentuk komitmen Pemerintah Kota Tasikmalaya dalam mewujudkan good governance dan clean government yang menjadi harapan seluruh masyarakat Kota Tasikmalaya.
                </p>
            </div>

            <!-- Share Section -->
            <div class="share-section" data-aos="fade-up">
                <h3 class="share-title">Bagikan Berita Ini</h3>
                <div class="share-buttons">
                    <a href="#" class="share-btn facebook">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                    <a href="#" class="share-btn twitter">
                        <i class="fab fa-twitter"></i> Twitter
                    </a>
                    <a href="#" class="share-btn whatsapp">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    <a href="#" class="share-btn telegram">
                        <i class="fab fa-telegram"></i> Telegram
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related News -->
<section class="related-news">
    <div class="container">
        <h2 class="related-title" data-aos="fade-up">Berita Terkait</h2>
        <div class="related-grid">
            <a href="{{ route('berita.detail', 'apel-pagi-program-strategis') }}" class="related-card" data-aos="fade-up" data-aos-delay="100">
                <div class="related-image">
                    <i class="fas fa-users"></i>
                </div>
                <div class="related-content">
                    <span class="related-category">Kegiatan</span>
                    <h3 class="related-title-card">Apel Pagi dan Penyampaian Program Strategis Pemerintah Kota Tasikmalaya 2025-2029</h3>
                    <div class="related-date">
                        <i class="fas fa-calendar"></i> 29 Juli 2025
                    </div>
                </div>
            </a>

            <a href="{{ route('berita.detail', 'audit-kinerja-opd') }}" class="related-card" data-aos="fade-up" data-aos-delay="200">
                <div class="related-image">
                    <i class="fas fa-search"></i>
                </div>
                <div class="related-content">
                    <span class="related-category">Audit</span>
                    <h3 class="related-title-card">Pelaksanaan Audit Kinerja pada OPD Lingkup Pemerintah Kota Tasikmalaya</h3>
                    <div class="related-date">
                        <i class="fas fa-calendar"></i> 15 Juli 2025
                    </div>
                </div>
            </a>

            <a href="{{ route('berita.detail', 'sosialisasi-spip') }}" class="related-card" data-aos="fade-up" data-aos-delay="300">
                <div class="related-image">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="related-content">
                    <span class="related-category">Sosialisasi</span>
                    <h3 class="related-title-card">Sosialisasi Sistem Pengendalian Intern Pemerintah (SPIP) kepada Seluruh ASN</h3>
                    <div class="related-date">
                        <i class="fas fa-calendar"></i> 10 Juli 2025
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Share functionality
    document.querySelectorAll('.share-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const url = window.location.href;
            const title = document.querySelector('.article-title').textContent;
            
            let shareUrl = '';
            
            if (this.classList.contains('facebook')) {
                shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
            } else if (this.classList.contains('twitter')) {
                shareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`;
            } else if (this.classList.contains('whatsapp')) {
                shareUrl = `https://wa.me/?text=${encodeURIComponent(title + ' ' + url)}`;
            } else if (this.classList.contains('telegram')) {
                shareUrl = `https://t.me/share/url?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`;
            }
            
            if (shareUrl) {
                window.open(shareUrl, '_blank', 'width=600,height=400');
            }
        });
    });
</script>
@endpush
