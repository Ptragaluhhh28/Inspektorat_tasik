@extends('layouts.app')

@section('title', 'Galeri - Inspektorat Kota Tasikmalaya')

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

    .gallery-container {
        padding: 4rem 0;
    }

    .gallery-filters {
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

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin-bottom: 3rem;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
        transition: all 0.3s ease;
    }

    .gallery-item {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
    }

    .gallery-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .gallery-image {
        height: 250px;
        background: linear-gradient(135deg, #088395, #73C8D2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        position: relative;
        overflow: hidden;
    }

    .gallery-image::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="%23ffffff20"/><circle cx="80" cy="40" r="1" fill="%23ffffff15"/></svg>');
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .view-btn {
        background: white;
        color: #333;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .view-btn:hover {
        transform: scale(1.05);
        color: #333;
        text-decoration: none;
    }

    .gallery-content {
        padding: 1.5rem;
    }

    .gallery-category {
        display: inline-block;
        background: rgba(8, 131, 149, 0.1);
        color: #088395;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .gallery-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .gallery-date {
        color: #666;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .video-gallery {
        background: #f8f9fa;
        padding: 4rem 0;
        margin-top: 2rem;
    }

    .section-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 3rem;
    }

    .video-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
    }

    .video-item {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .video-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .video-thumbnail {
        height: 200px;
        background: linear-gradient(135deg, #088395, #73C8D2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        position: relative;
        cursor: pointer;
    }

    .play-button {
        position: absolute;
        background: rgba(255, 255, 255, 0.9);
        color: #088395;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        transition: all 0.3s ease;
    }

    .play-button:hover {
        transform: scale(1.1);
        background: white;
    }

    .video-content {
        padding: 1.5rem;
    }

    .video-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .video-description {
        color: #666;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 1rem;
    }

    .video-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #888;
        font-size: 0.8rem;
    }

    /* Modal for enlarged images */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        max-width: 90%;
        max-height: 90%;
        background: white;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
    }

    .modal-image {
        width: 100%;
        height: 400px;
        background: linear-gradient(135deg, #088395, #73C8D2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 4rem;
    }

    .modal-info {
        padding: 2rem;
    }

    .close-modal {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
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
        
        .gallery-grid,
        .video-grid {
            grid-template-columns: 1fr;
        }
        
        .gallery-filters {
            justify-content: flex-start;
            overflow-x: auto;
            padding-bottom: 1rem;
        }
        
        .modal-content {
            max-width: 95%;
            max-height: 95%;
        }
        
        .modal-image {
            height: 250px;
            font-size: 3rem;
        }
    }

    @media (min-width: 769px) and (max-width: 1024px) {
        .gallery-grid,
        .video-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1025px) and (max-width: 1440px) {
        .gallery-grid,
        .video-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-title" data-aos="fade-up">Galeri</h1>
        <p style="font-size: 1.2rem; opacity: 0.9; max-width: 600px; margin: 0 auto;" data-aos="fade-up" data-aos-delay="200">
            Dokumentasi kegiatan dan program Inspektorat Kota Tasikmalaya dalam bentuk foto dan video
        </p>
    </div>
</section>

<!-- Gallery Container -->
<section class="gallery-container">
    <div class="container">
        <!-- Filters -->
        <div class="gallery-filters" data-aos="fade-up">
            <a href="#" class="filter-btn active" data-filter="all">Semua</a>
            <a href="#" class="filter-btn" data-filter="kegiatan">Kegiatan</a>
            <a href="#" class="filter-btn" data-filter="rapat">Rapat</a>
            <a href="#" class="filter-btn" data-filter="sosialisasi">Sosialisasi</a>
            <a href="#" class="filter-btn" data-filter="audit">Audit</a>
            <a href="#" class="filter-btn" data-filter="pelatihan">Pelatihan</a>
        </div>

        <!-- Photo Gallery -->
        <div class="gallery-grid">
            <div class="gallery-item" data-category="kegiatan" data-aos="fade-up" data-aos-delay="100">
                <div class="gallery-image">
                    <i class="fas fa-users"></i>
                    <div class="gallery-overlay">
                        <a href="#" class="view-btn" onclick="openModal('modal1')">
                            <i class="fas fa-expand"></i> Lihat
                        </a>
                    </div>
                </div>
                <div class="gallery-content">
                    <span class="gallery-category">Kegiatan</span>
                    <h3 class="gallery-title">Rapat Koordinasi Evaluasi SPI 2025</h3>
                    <div class="gallery-date">
                        <i class="fas fa-calendar"></i> 07 Agustus 2025
                    </div>
                </div>
            </div>

            <div class="gallery-item" data-category="sosialisasi" data-aos="fade-up" data-aos-delay="200">
                <div class="gallery-image">
                    <i class="fas fa-graduation-cap"></i>
                    <div class="gallery-overlay">
                        <a href="#" class="view-btn" onclick="openModal('modal2')">
                            <i class="fas fa-expand"></i> Lihat
                        </a>
                    </div>
                </div>
                <div class="gallery-content">
                    <span class="gallery-category">Sosialisasi</span>
                    <h3 class="gallery-title">Sosialisasi SPIP kepada Seluruh ASN</h3>
                    <div class="gallery-date">
                        <i class="fas fa-calendar"></i> 10 Juli 2025
                    </div>
                </div>
            </div>

            <div class="gallery-item" data-category="audit" data-aos="fade-up" data-aos-delay="300">
                <div class="gallery-image">
                    <i class="fas fa-search"></i>
                    <div class="gallery-overlay">
                        <a href="#" class="view-btn" onclick="openModal('modal3')">
                            <i class="fas fa-expand"></i> Lihat
                        </a>
                    </div>
                </div>
                <div class="gallery-content">
                    <span class="gallery-category">Audit</span>
                    <h3 class="gallery-title">Pelaksanaan Audit Kinerja OPD</h3>
                    <div class="gallery-date">
                        <i class="fas fa-calendar"></i> 15 Juli 2025
                    </div>
                </div>
            </div>

            <div class="gallery-item" data-category="pelatihan" data-aos="fade-up" data-aos-delay="400">
                <div class="gallery-image">
                    <i class="fas fa-clipboard-check"></i>
                    <div class="gallery-overlay">
                        <a href="#" class="view-btn" onclick="openModal('modal4')">
                            <i class="fas fa-expand"></i> Lihat
                        </a>
                    </div>
                </div>
                <div class="gallery-content">
                    <span class="gallery-category">Pelatihan</span>
                    <h3 class="gallery-title">Workshop Peningkatan Kapasitas Auditor</h3>
                    <div class="gallery-date">
                        <i class="fas fa-calendar"></i> 01 Juli 2025
                    </div>
                </div>
            </div>

            <div class="gallery-item" data-category="rapat" data-aos="fade-up" data-aos-delay="500">
                <div class="gallery-image">
                    <i class="fas fa-handshake"></i>
                    <div class="gallery-overlay">
                        <a href="#" class="view-btn" onclick="openModal('modal5')">
                            <i class="fas fa-expand"></i> Lihat
                        </a>
                    </div>
                </div>
                <div class="gallery-content">
                    <span class="gallery-category">Rapat</span>
                    <h3 class="gallery-title">Apel Pagi dan Program Strategis</h3>
                    <div class="gallery-date">
                        <i class="fas fa-calendar"></i> 29 Juli 2025
                    </div>
                </div>
            </div>

            <div class="gallery-item" data-category="kegiatan" data-aos="fade-up" data-aos-delay="600">
                <div class="gallery-image">
                    <i class="fas fa-award"></i>
                    <div class="gallery-overlay">
                        <a href="#" class="view-btn" onclick="openModal('modal6')">
                            <i class="fas fa-expand"></i> Lihat
                        </a>
                    </div>
                </div>
                <div class="gallery-content">
                    <span class="gallery-category">Kegiatan</span>
                    <h3 class="gallery-title">Evaluasi Kinerja Tahunan Inspektorat</h3>
                    <div class="gallery-date">
                        <i class="fas fa-calendar"></i> 05 Juli 2025
                    </div>
                </div>
            </div>

            <div class="gallery-item" data-category="sosialisasi" data-aos="fade-up" data-aos-delay="700">
                <div class="gallery-image">
                    <i class="fas fa-city"></i>
                    <div class="gallery-overlay">
                        <a href="#" class="view-btn" onclick="openModal('modal7')">
                            <i class="fas fa-expand"></i> Lihat
                        </a>
                    </div>
                </div>
                <div class="gallery-content">
                    <span class="gallery-category">Sosialisasi</span>
                    <h3 class="gallery-title">Pencegahan Korupsi di Lingkungan Pemda</h3>
                    <div class="gallery-date">
                        <i class="fas fa-calendar"></i> 20 Juni 2025
                    </div>
                </div>
            </div>

            <div class="gallery-item" data-category="audit" data-aos="fade-up" data-aos-delay="800">
                <div class="gallery-image">
                    <i class="fas fa-chart-line"></i>
                    <div class="gallery-overlay">
                        <a href="#" class="view-btn" onclick="openModal('modal8')">
                            <i class="fas fa-expand"></i> Lihat
                        </a>
                    </div>
                </div>
                <div class="gallery-content">
                    <span class="gallery-category">Audit</span>
                    <h3 class="gallery-title">Audit Sistem Informasi Keuangan Daerah</h3>
                    <div class="gallery-date">
                        <i class="fas fa-calendar"></i> 15 Juni 2025
                    </div>
                </div>
            </div>

            <div class="gallery-item" data-category="pelatihan" data-aos="fade-up" data-aos-delay="900">
                <div class="gallery-image">
                    <i class="fas fa-laptop"></i>
                    <div class="gallery-overlay">
                        <a href="#" class="view-btn" onclick="openModal('modal9')">
                            <i class="fas fa-expand"></i> Lihat
                        </a>
                    </div>
                </div>
                <div class="gallery-content">
                    <span class="gallery-category">Pelatihan</span>
                    <h3 class="gallery-title">Pelatihan Sistem Informasi Audit</h3>
                    <div class="gallery-date">
                        <i class="fas fa-calendar"></i> 10 Juni 2025
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination" data-aos="fade-up" id="pagination">
            <!-- Pagination buttons akan di-generate otomatis oleh JavaScript -->
        </div>
    </div>
</section>

<!-- Video Gallery -->
<section class="video-gallery">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Galeri Video</h2>
        <div class="video-grid">
            <div class="video-item" data-aos="fade-up" data-aos-delay="100">
                <div class="video-thumbnail" onclick="playVideo('video1')">
                    <i class="fas fa-video"></i>
                    <div class="play-button">
                        <i class="fas fa-play"></i>
                    </div>
                </div>
                <div class="video-content">
                    <h3 class="video-title">Profil Inspektorat Kota Tasikmalaya</h3>
                    <p class="video-description">Video profil yang menjelaskan visi, misi, dan tugas pokok Inspektorat Kota Tasikmalaya dalam pengawasan internal pemerintahan.</p>
                    <div class="video-meta">
                        <span><i class="fas fa-eye"></i> 2,345 views</span>
                        <span><i class="fas fa-clock"></i> 5:42</span>
                    </div>
                </div>
            </div>

            <div class="video-item" data-aos="fade-up" data-aos-delay="200">
                <div class="video-thumbnail" onclick="playVideo('video2')">
                    <i class="fas fa-graduation-cap"></i>
                    <div class="play-button">
                        <i class="fas fa-play"></i>
                    </div>
                </div>
                <div class="video-content">
                    <h3 class="video-title">Sosialisasi SPIP 2025</h3>
                    <p class="video-description">Dokumentasi kegiatan sosialisasi Sistem Pengendalian Intern Pemerintah kepada seluruh ASN di lingkungan Pemkot Tasikmalaya.</p>
                    <div class="video-meta">
                        <span><i class="fas fa-eye"></i> 1,876 views</span>
                        <span><i class="fas fa-clock"></i> 8:15</span>
                    </div>
                </div>
            </div>

            <div class="video-item" data-aos="fade-up" data-aos-delay="300">
                <div class="video-thumbnail" onclick="playVideo('video3')">
                    <i class="fas fa-city"></i>
                    <div class="play-button">
                        <i class="fas fa-play"></i>
                    </div>
                </div>
                <div class="video-content">
                    <h3 class="video-title">Program Pencegahan Korupsi</h3>
                    <p class="video-description">Penjelasan tentang program-program pencegahan korupsi yang dilaksanakan oleh Inspektorat Kota Tasikmalaya.</p>
                    <div class="video-meta">
                        <span><i class="fas fa-eye"></i> 3,124 views</span>
                        <span><i class="fas fa-clock"></i> 6:33</span>
                    </div>
                </div>
            </div>

            <div class="video-item" data-aos="fade-up" data-aos-delay="400">
                <div class="video-thumbnail" onclick="playVideo('video4')">
                    <i class="fas fa-chart-line"></i>
                    <div class="play-button">
                        <i class="fas fa-play"></i>
                    </div>
                </div>
                <div class="video-content">
                    <h3 class="video-title">Audit Kinerja dan Evaluasi</h3>
                    <p class="video-description">Proses pelaksanaan audit kinerja pada OPD dan evaluasi sistem pengendalian intern di lingkungan pemerintah daerah.</p>
                    <div class="video-meta">
                        <span><i class="fas fa-eye"></i> 1,567 views</span>
                        <span><i class="fas fa-clock"></i> 7:21</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal for enlarged images -->
<div id="imageModal" class="modal">
    <div class="modal-content">
        <button class="close-modal" onclick="closeModal()">&times;</button>
        <div id="modalImage" class="modal-image">
            <i class="fas fa-image"></i>
        </div>
        <div class="modal-info">
            <h3 id="modalTitle">Judul Gambar</h3>
            <p id="modalDescription">Deskripsi gambar akan ditampilkan di sini.</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Pagination configuration
    const ITEMS_PER_PAGE = 3;
    let currentPage = 1;
    let currentFilter = 'all';
    let allItems = [];
    let filteredItems = [];

    // Initialize gallery and pagination
    document.addEventListener('DOMContentLoaded', function() {
        allItems = Array.from(document.querySelectorAll('.gallery-item'));
        filteredItems = [...allItems];
        updateGalleryDisplay();
        setupPagination();
    });

    // Filter functionality with pagination
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all buttons
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Get filter value and reset to page 1
            currentFilter = this.getAttribute('data-filter');
            currentPage = 1;
            
            // Filter items
            filterItems();
            updateGalleryDisplay();
            setupPagination();
        });
    });

    function filterItems() {
        if (currentFilter === 'all') {
            filteredItems = [...allItems];
        } else {
            filteredItems = allItems.filter(item => 
                item.getAttribute('data-category') === currentFilter
            );
        }
    }

    function updateGalleryDisplay() {
        // Hide all items first
        allItems.forEach(item => {
            item.style.display = 'none';
        });

        // Calculate which items to show for current page
        const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
        const endIndex = startIndex + ITEMS_PER_PAGE;
        const itemsToShow = filteredItems.slice(startIndex, endIndex);

        // Show items for current page
        itemsToShow.forEach(item => {
            item.style.display = 'block';
        });

        // Update gallery grid to show items properly
        const galleryGrid = document.querySelector('.gallery-grid');
        if (itemsToShow.length === 1) {
            galleryGrid.style.gridTemplateColumns = '1fr';
            galleryGrid.style.maxWidth = '400px';
            galleryGrid.style.margin = '0 auto';
        } else if (itemsToShow.length === 2) {
            galleryGrid.style.gridTemplateColumns = 'repeat(2, 1fr)';
            galleryGrid.style.maxWidth = '800px';
            galleryGrid.style.margin = '0 auto';
        } else {
            galleryGrid.style.gridTemplateColumns = 'repeat(3, 1fr)';
            galleryGrid.style.maxWidth = '1200px';
            galleryGrid.style.margin = '0 auto';
        }
    }

    function setupPagination() {
        const totalPages = Math.ceil(filteredItems.length / ITEMS_PER_PAGE);
        const paginationContainer = document.getElementById('pagination');
        
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
        const totalPages = Math.ceil(filteredItems.length / ITEMS_PER_PAGE);
        
        if (page < 1 || page > totalPages) return;
        
        currentPage = page;
        updateGalleryDisplay();
        setupPagination();
        
        // Smooth scroll to gallery
        document.querySelector('.gallery-container').scrollIntoView({ 
            behavior: 'smooth',
            block: 'start'
        });
    }

    // Modal functionality
    function openModal(modalId) {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const modalTitle = document.getElementById('modalTitle');
        const modalDescription = document.getElementById('modalDescription');
        
        // Sample modal content based on modalId
        const modalData = {
            'modal1': {
                title: 'Rapat Koordinasi Evaluasi SPI 2025',
                description: 'Dokumentasi kegiatan rapat koordinasi evaluasi Sistem Pengendalian Intern Pemerintah dan pencegahan korupsi di lingkungan Pemerintah Kota Tasikmalaya.',
                icon: 'fas fa-users'
            },
            'modal2': {
                title: 'Sosialisasi SPIP kepada Seluruh ASN',
                description: 'Kegiatan sosialisasi untuk meningkatkan pemahaman ASN tentang pentingnya pengendalian intern dalam mencegah penyimpangan.',
                icon: 'fas fa-graduation-cap'
            },
            'modal3': {
                title: 'Pelaksanaan Audit Kinerja OPD',
                description: 'Proses audit kinerja pada Organisasi Perangkat Daerah untuk memastikan efektivitas dan efisiensi penyelenggaraan pemerintahan.',
                icon: 'fas fa-search'
            },
            'modal4': {
                title: 'Workshop Peningkatan Kapasitas Auditor',
                description: 'Kegiatan pelatihan untuk meningkatkan kemampuan dan kompetensi auditor internal dalam melaksanakan tugas pengawasan.',
                icon: 'fas fa-clipboard-check'
            },
            'modal5': {
                title: 'Apel Pagi dan Program Strategis',
                description: 'Kegiatan apel pagi dan sosialisasi program strategis Inspektorat dalam meningkatkan kualitas pengawasan internal.',
                icon: 'fas fa-handshake'
            },
            'modal6': {
                title: 'Evaluasi Kinerja Tahunan Inspektorat',
                description: 'Evaluasi pencapaian kinerja Inspektorat selama satu tahun dan perencanaan program kerja untuk periode berikutnya.',
                icon: 'fas fa-award'
            },
            'modal7': {
                title: 'Pencegahan Korupsi di Lingkungan Pemda',
                description: 'Program sosialisasi dan edukasi pencegahan korupsi untuk seluruh ASN di lingkungan Pemerintah Daerah.',
                icon: 'fas fa-city'
            },
            'modal8': {
                title: 'Audit Sistem Informasi Keuangan Daerah',
                description: 'Audit terhadap sistem informasi pengelolaan keuangan daerah untuk memastikan transparansi dan akuntabilitas.',
                icon: 'fas fa-chart-line'
            },
            'modal9': {
                title: 'Pelatihan Sistem Informasi Audit',
                description: 'Pelatihan penggunaan sistem informasi audit untuk meningkatkan efisiensi dan efektivitas proses audit.',
                icon: 'fas fa-laptop'
            }
        };
        
        const data = modalData[modalId] || modalData['modal1'];
        
        modalImage.innerHTML = `<i class="${data.icon}"></i>`;
        modalTitle.textContent = data.title;
        modalDescription.textContent = data.description;
        
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('imageModal');
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Video play functionality
    function playVideo(videoId) {
        // In a real application, this would open a video player or modal
        alert(`Playing video: ${videoId}`);
    }

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
</script>
@endpush
