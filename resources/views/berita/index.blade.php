@extends('layouts.app')

@section('title', 'Berita - Inspektorat Kota Tasikmalaya')

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

    .news-container {
        padding: 4rem 0;
    }

    .news-filters {
        display: flex;
        gap: 1rem;
        margin-bottom: 3rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 0.75rem 1.5rem;
        background: white;
        color: #666;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: 2px solid #e8ecef;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: linear-gradient(135deg, #088395, #73C8D2);
        color: white;
        border-color: transparent;
        transform: translateY(-2px);
    }

    .news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
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
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .news-image {
        height: 200px;
        background: linear-gradient(135deg, #088395, #73C8D2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        position: relative;
        overflow: hidden;
    }

    .news-image::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="%23ffffff20"/><circle cx="80" cy="40" r="1" fill="%23ffffff15"/></svg>');
    }

    .news-content {
        padding: 2rem;
    }

    .news-category {
        display: inline-block;
        background: rgba(8, 131, 149, 0.1);
        color: #088395;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .news-date {
        color: #088395;
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .news-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .news-excerpt {
        color: #666;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .news-link {
        color: #088395;
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

    .featured-news {
        margin-bottom: 4rem;
    }

    .featured-card {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
        align-items: center;
    }

    .featured-image {
        height: 300px;
        background: linear-gradient(135deg, #088395, #73C8D2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 4rem;
    }

    .featured-content {
        padding: 2rem;
    }

    .featured-badge {
        background: linear-gradient(135deg, #088395, #73C8D2);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 3rem;
    }

    .page-btn {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        color: #666;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: 1px solid #e8ecef;
    }

    .page-btn:hover,
    .page-btn.active {
        background: linear-gradient(135deg, #088395, #73C8D2);
        color: white;
        border-color: transparent;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2.5rem;
        }
        
        .featured-card {
            grid-template-columns: 1fr;
            gap: 0;
        }
        
        .featured-image {
            height: 200px;
        }
        
        .news-grid {
            grid-template-columns: 1fr;
        }
        
        .news-filters {
            justify-content: flex-start;
            overflow-x: auto;
            padding-bottom: 1rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-title" data-aos="fade-up">Berita Terbaru</h1>
        <p style="font-size: 1.2rem; opacity: 0.9; max-width: 600px; margin: 0 auto;" data-aos="fade-up" data-aos-delay="200">
            Informasi terkini seputar kegiatan dan program Inspektorat Kota Tasikmalaya
        </p>
    </div>
</section>

<!-- News Container -->
<section class="news-container">
    <div class="container">
        <!-- Filters -->
        <div class="news-filters" data-aos="fade-up">
            <a href="#" class="filter-btn active">Semua</a>
            <a href="#" class="filter-btn">Kegiatan</a>
            <a href="#" class="filter-btn">Pengumuman</a>
            <a href="#" class="filter-btn">Audit</a>
            <a href="#" class="filter-btn">Sosialisasi</a>
        </div>

        <!-- Featured News -->
        <div class="featured-news" data-aos="fade-up" data-aos-delay="100">
            <div class="featured-card">
                <div class="featured-image">
                    <i class="fas fa-star"></i>
                </div>
                <div class="featured-content">
                    <span class="featured-badge">Berita Utama</span>
                    <h2 style="font-size: 2rem; font-weight: 700; color: #2c3e50; margin-bottom: 1rem;">
                        Rapat Koordinasi Evaluasi SPI 2025 dan Pencegahan Korupsi di Pemerintah Kota Tasikmalaya
                    </h2>
                    <div style="color: #088395; font-size: 0.9rem; font-weight: 500; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-calendar"></i> 07 AGUSTUS 2025
                    </div>
                    <p style="color: #666; line-height: 1.7; margin-bottom: 1.5rem;">
                        Tasikmalaya, 5 Agustus 2025 — Pemerintah Kota Tasikmalaya melalui Inspektorat Daerah menggelar Rapat Koordinasi Evaluasi Rencana Aksi Pencegahan Korupsi dan Penguatan Sistem Pengendalian Intern untuk meningkatkan tata kelola pemerintahan yang baik dan bersih.
                    </p>
                    <a href="{{ route('berita.detail', 'rapat-koordinasi-evaluasi-spi-2025') }}" class="btn">
                        <i class="fas fa-arrow-right"></i> Baca Selengkapnya
                    </a>
                </div>
            </div>
        </div>

        <!-- News Grid -->
        <div class="news-grid">
            <article class="news-card" data-aos="fade-up" data-aos-delay="100">
                <div class="news-image">
                    <i class="fas fa-users"></i>
                </div>
                <div class="news-content">
                    <span class="news-category">Kegiatan</span>
                    <div class="news-date">
                        <i class="fas fa-calendar"></i> 29 JULI 2025
                    </div>
                    <h3 class="news-title">Apel Pagi dan Penyampaian Program Strategis Pemerintah Kota Tasikmalaya 2025-2029</h3>
                    <p class="news-excerpt">
                        Inspektorat Daerah Kota Tasikmalaya melaksanakan apel pagi yang dirangkaikan dengan penyampaian Program Strategis Pemerintah Kota Tasikmalaya untuk periode 2025-2029 di lingkungan Inspektorat Daerah.
                    </p>
                    <a href="{{ route('berita.detail', 'apel-pagi-program-strategis') }}" class="news-link">
                        Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>

            <article class="news-card" data-aos="fade-up" data-aos-delay="200">
                <div class="news-image">
                    <i class="fas fa-handshake"></i>
                </div>
                <div class="news-content">
                    <span class="news-category">Bantuan Sosial</span>
                    <div class="news-date">
                        <i class="fas fa-calendar"></i> 29 MEI 2020
                    </div>
                    <h3 class="news-title">Penyerahan Bantuan Sosial dari BAZNAS Kota Tasikmalaya untuk Mustahik Terdampak COVID-19</h3>
                    <p class="news-excerpt">
                        Bertempat di Bale Kota Tasikmalaya, Wali Kota Tasikmalaya menghadiri penyerahan bantuan sosial dari Baznas Kota Tasikmalaya bagi mustahik yang terdampak pandemi COVID-19.
                    </p>
                    <a href="{{ route('berita.detail', 'bantuan-sosial-baznas') }}" class="news-link">
                        Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>

            <article class="news-card" data-aos="fade-up" data-aos-delay="300">
                <div class="news-image">
                    <i class="fas fa-search"></i>
                </div>
                <div class="news-content">
                    <span class="news-category">Audit</span>
                    <div class="news-date">
                        <i class="fas fa-calendar"></i> 15 JULI 2025
                    </div>
                    <h3 class="news-title">Pelaksanaan Audit Kinerja pada OPD Lingkup Pemerintah Kota Tasikmalaya</h3>
                    <p class="news-excerpt">
                        Inspektorat Kota Tasikmalaya melaksanakan audit kinerja pada berbagai Organisasi Perangkat Daerah untuk memastikan efektivitas dan efisiensi pengelolaan anggaran daerah.
                    </p>
                    <a href="{{ route('berita.detail', 'audit-kinerja-opd') }}" class="news-link">
                        Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>

            <article class="news-card" data-aos="fade-up" data-aos-delay="400">
                <div class="news-image">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="news-content">
                    <span class="news-category">Sosialisasi</span>
                    <div class="news-date">
                        <i class="fas fa-calendar"></i> 10 JULI 2025
                    </div>
                    <h3 class="news-title">Sosialisasi Sistem Pengendalian Intern Pemerintah (SPIP) kepada Seluruh ASN</h3>
                    <p class="news-excerpt">
                        Kegiatan sosialisasi SPIP bertujuan untuk meningkatkan pemahaman ASN tentang pentingnya pengendalian intern dalam mencegah terjadinya penyimpangan dan meningkatkan kualitas pelayanan publik.
                    </p>
                    <a href="{{ route('berita.detail', 'sosialisasi-spip') }}" class="news-link">
                        Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>

            <article class="news-card" data-aos="fade-up" data-aos-delay="500">
                <div class="news-image">
                    <i class="fas fa-award"></i>
                </div>
                <div class="news-content">
                    <span class="news-category">Pengumuman</span>
                    <div class="news-date">
                        <i class="fas fa-calendar"></i> 05 JULI 2025
                    </div>
                    <h3 class="news-title">Pengumuman Hasil Evaluasi Kinerja Tahunan Inspektorat Kota Tasikmalaya</h3>
                    <p class="news-excerpt">
                        Inspektorat Kota Tasikmalaya telah menyelesaikan evaluasi kinerja tahunan dengan hasil yang memuaskan. Berbagai program dan kegiatan telah terlaksana sesuai dengan target yang ditetapkan.
                    </p>
                    <a href="{{ route('berita.detail', 'hasil-evaluasi-kinerja') }}" class="news-link">
                        Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>

            <article class="news-card" data-aos="fade-up" data-aos-delay="600">
                <div class="news-image">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <div class="news-content">
                    <span class="news-category">Kegiatan</span>
                    <div class="news-date">
                        <i class="fas fa-calendar"></i> 01 JULI 2025
                    </div>
                    <h3 class="news-title">Workshop Peningkatan Kapasitas Auditor Internal Pemerintah Daerah</h3>
                    <p class="news-excerpt">
                        Workshop ini bertujuan untuk meningkatkan kompetensi dan profesionalisme auditor internal dalam melaksanakan fungsi pengawasan yang lebih efektif dan berkualitas.
                    </p>
                    <a href="{{ route('berita.detail', 'workshop-auditor') }}" class="news-link">
                        Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>
        </div>

        <!-- Pagination -->
        <div class="pagination" data-aos="fade-up" id="pagination">
            <!-- Pagination buttons akan di-generate otomatis oleh JavaScript -->
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Pagination configuration
    const ITEMS_PER_PAGE = 3;
    let currentPage = 1;
    let allNewsCards = [];
    let filteredNewsCards = [];
    let isFilterActive = false;

    // Initialize pagination
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            allNewsCards = Array.from(document.querySelectorAll('.news-card'));
            filteredNewsCards = [...allNewsCards];
            updateNewsDisplay();
            setupPagination();
        }, 100);
    });

    function updateNewsDisplay() {
        // Hide all news cards first
        allNewsCards.forEach(card => {
            card.style.display = 'none';
        });

        // Calculate which cards to show for current page
        const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
        const endIndex = startIndex + ITEMS_PER_PAGE;
        const cardsToShow = filteredNewsCards.slice(startIndex, endIndex);

        // Show cards for current page
        cardsToShow.forEach(card => {
            card.style.display = 'block';
        });
    }

    function setupPagination() {
        const totalPages = Math.ceil(filteredNewsCards.length / ITEMS_PER_PAGE);
        const paginationContainer = document.getElementById('pagination');
        
        if (!paginationContainer) return;
        
        if (totalPages <= 1) {
            paginationContainer.style.display = 'none';
            return;
        } else {
            paginationContainer.style.display = 'flex';
        }

        let paginationHTML = '';

        // Previous button
        if (currentPage > 1) {
            paginationHTML += `<a href="#" class="page-btn" onclick="changePage(${currentPage - 1})"><i class="fas fa-chevron-left"></i></a>`;
        }

        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            const activeClass = i === currentPage ? 'active' : '';
            paginationHTML += `<a href="#" class="page-btn ${activeClass}" onclick="changePage(${i})">${i}</a>`;
        }

        // Next button
        if (currentPage < totalPages) {
            paginationHTML += `<a href="#" class="page-btn" onclick="changePage(${currentPage + 1})"><i class="fas fa-chevron-right"></i></a>`;
        }

        paginationContainer.innerHTML = paginationHTML;
    }

    function changePage(page) {
        const totalPages = Math.ceil(filteredNewsCards.length / ITEMS_PER_PAGE);
        
        if (page < 1 || page > totalPages) return;
        
        currentPage = page;
        updateNewsDisplay();
        setupPagination();
        
        // Smooth scroll to news section
        document.querySelector('.news-grid').scrollIntoView({ 
            behavior: 'smooth',
            block: 'start'
        });
    }

    // Filter functionality with pagination integration
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all buttons
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Reset pagination to first page
            currentPage = 1;
            
            const category = this.textContent.toLowerCase();
            
            if (category === 'semua') {
                isFilterActive = false;
                filteredNewsCards = [...allNewsCards];
            } else {
                isFilterActive = true;
                filteredNewsCards = allNewsCards.filter(card => {
                    const cardCategory = card.querySelector('.news-category').textContent.toLowerCase();
                    return cardCategory.includes(category);
                });
            }
            
            updateNewsDisplay();
            setupPagination();
        });
    });
</script>
@endpush
