@extends('layouts.app')

@section('title', 'Peraturan - Inspektorat Kota Tasikmalaya')

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

    .regulations-container {
        padding: 4rem 0;
    }

    .regulation-categories {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 4rem;
    }

    .category-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        text-align: center;
        border: 1px solid #f0f0f0;
    }

    .category-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .category-icon {
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

    .category-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .category-count {
        color: #1e40af;
        font-weight: 500;
        margin-bottom: 1.5rem;
    }

    .category-btn {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .category-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(8, 131, 149, 0.3);
        color: white;
        text-decoration: none;
    }

    .regulations-list {
        margin-bottom: 4rem;
    }

    .list-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 3rem;
        text-align: center;
    }

    .regulation-item {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border-left: 4px solid #1e40af;
    }

    .regulation-item:hover {
        transform: translateX(10px);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    .regulation-header {
        display: flex;
        justify-content: between;
        align-items: flex-start;
        gap: 2rem;
        margin-bottom: 1rem;
    }

    .regulation-info {
        flex: 1;
    }

    .regulation-number {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e40af;
        margin-bottom: 0.5rem;
    }

    .regulation-title-item {
        font-size: 1.3rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .regulation-date {
        color: #666;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .regulation-actions {
        display: flex;
        gap: 1rem;
        flex-shrink: 0;
    }

    .action-btn {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-view {
        background: rgba(8, 131, 149, 0.1);
        color: #1e40af;
    }

    .btn-download {
        background: rgba(115, 200, 210, 0.1);
        color: #1e40af;
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
        background: #1e40af;
        color: white;
        text-decoration: none;
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
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
        border-color: transparent;
    }

    .page-ellipsis {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 0.5rem;
        color: #666;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2.5rem;
        }
        
        .search-form {
            flex-direction: column;
            max-width: 100%;
        }
        
        .regulation-header {
            flex-direction: column;
            gap: 1rem;
        }
        
        .regulation-actions {
            justify-content: flex-start;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-title" data-aos="fade-up">Peraturan</h1>
        <p style="font-size: 1.2rem; opacity: 0.9; max-width: 600px; margin: 0 auto;" data-aos="fade-up" data-aos-delay="200">
            Kumpulan peraturan perundang-undangan yang menjadi dasar hukum pelaksanaan tugas dan fungsi Inspektorat
        </p>
    </div>
</section>

<!-- Search Section -->
<section class="regulations-container">
    <div class="container">
        <!-- Regulations List -->
        <div class="regulations-list">
            <h2 class="list-title" data-aos="fade-up">Peraturan Terbaru</h2>

            <div class="regulation-item" data-aos="fade-up" data-aos-delay="100">
                <div class="regulation-header">
                    <div class="regulation-info">
                        <div class="regulation-number">Peraturan Wali Kota Tasikmalaya Nomor 48 Tahun 2021</div>
                        <h3 class="regulation-title-item">Tentang Susunan Organisasi, Kedudukan, Tugas Pokok, Fungsi
Dan Tata Kerja Perangkat Daerah</h3>
                        <div class="regulation-date">
                            <i class="fas fa-calendar"></i> 15 Januari 2025
                        </div>
                    </div>
                    <div class="regulation-actions">
                        <a href="{{ asset('documents/Perwal-Nomor-48-Tahun-2021.pdf') }}" target="_blank" class="action-btn btn-view">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="{{ asset('documents/Perwal-Nomor-48-Tahun-2021.pdf') }}" download class="action-btn btn-download">
                            <i class="fas fa-download"></i> Unduh
                        </a>
                    </div>
                </div>
            </div>

            <div class="regulation-item" data-aos="fade-up" data-aos-delay="200">
                <div class="regulation-header">
                    <div class="regulation-info">
                        <div class="regulation-number">Peraturan Wali Kota Tasikmalaya Nomor 55 Tahun 2021</div>
                        <h3 class="regulation-title-item">Tentang Tugas Pokok Dan Rincian Tugas Unit Inspektorat Daerah Kota Tasikmalaya</h3>
                        <div class="regulation-date">
                            <i class="fas fa-calendar"></i> 20 Desember 2024
                        </div>
                    </div>
                    <div class="regulation-actions">
                        <a href="{{ asset('documents/Perwal-Nomor-55-Tahun-2021.pdf') }}" target="_blank" class="action-btn btn-view">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="{{ asset('documents/Perwal-Nomor-55-Tahun-2021.pdf') }}" download class="action-btn btn-download">
                            <i class="fas fa-download"></i> Unduh
                        </a>
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
@endsection

@push('scripts')
<script>
    // Pagination configuration
    const ITEMS_PER_PAGE = 3;
    let currentPage = 1;
    let allRegulations = [];
    let filteredRegulations = [];

    // Ensure function declarations are available immediately
    function updateRegulationsDisplay() {
        // Hide all regulations first
        allRegulations.forEach(regulation => {
            regulation.style.display = 'none';
        });

        // Calculate which regulations to show for current page
        const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
        const endIndex = startIndex + ITEMS_PER_PAGE;
        const regulationsToShow = filteredRegulations.slice(startIndex, endIndex);

        // Show regulations for current page
        regulationsToShow.forEach(regulation => {
            regulation.style.display = 'block';
        });
    }

    function setupPagination() {
        const totalPages = Math.ceil(filteredRegulations.length / ITEMS_PER_PAGE);
        const paginationContainer = document.getElementById('pagination');
        
        console.log('setupPagination called');
        console.log('filteredRegulations.length:', filteredRegulations.length);
        console.log('totalPages:', totalPages);
        console.log('paginationContainer:', paginationContainer);
        
        if (!paginationContainer) {
            console.error('Pagination container not found!');
            return;
        }
        
        if (totalPages <= 1) {
            console.log('Hiding pagination - totalPages <= 1');
            paginationContainer.style.display = 'none';
            return;
        } else {
            console.log('Showing pagination - totalPages > 1');
            paginationContainer.style.display = 'flex';
        }

        let paginationHTML = '';

        // Previous button
        if (currentPage > 1) {
            paginationHTML += `<a href="#" class="page-btn" onclick="changePage(${currentPage - 1})"><i class="fas fa-chevron-left"></i></a>`;
        }

        // Page numbers
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, startPage + 4);
        
        // Adjust start page if we're near the end
        if (endPage - startPage < 4) {
            startPage = Math.max(1, endPage - 4);
        }

        // First page and ellipsis
        if (startPage > 1) {
            paginationHTML += `<a href="#" class="page-btn" onclick="changePage(1)">1</a>`;
            if (startPage > 2) {
                paginationHTML += `<span class="page-ellipsis">...</span>`;
            }
        }

        // Page numbers
        for (let i = startPage; i <= endPage; i++) {
            const activeClass = i === currentPage ? 'active' : '';
            paginationHTML += `<a href="#" class="page-btn ${activeClass}" onclick="changePage(${i})">${i}</a>`;
        }

        // Last page and ellipsis
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                paginationHTML += `<span class="page-ellipsis">...</span>`;
            }
            paginationHTML += `<a href="#" class="page-btn" onclick="changePage(${totalPages})">${totalPages}</a>`;
        }

        // Next button
        if (currentPage < totalPages) {
            paginationHTML += `<a href="#" class="page-btn" onclick="changePage(${currentPage + 1})"><i class="fas fa-chevron-right"></i></a>`;
        }

        console.log('Final paginationHTML:', paginationHTML);
        paginationContainer.innerHTML = paginationHTML;
        console.log('Pagination setup completed');
    }

    function changePage(page) {
        const totalPages = Math.ceil(filteredRegulations.length / ITEMS_PER_PAGE);
        
        if (page < 1 || page > totalPages) return;
        
        currentPage = page;
        updateRegulationsDisplay();
        setupPagination();
        
        // Smooth scroll to regulations list
        document.querySelector('.regulations-list').scrollIntoView({ 
            behavior: 'smooth',
            block: 'start'
        });
    }

    // Initialize pagination - try multiple times to ensure it works
    function initializePagination() {
        console.log('Attempting to initialize pagination...');
        allRegulations = Array.from(document.querySelectorAll('.regulation-item'));
        
        if (allRegulations.length === 0) {
            console.warn('No regulation items found, retrying...');
            return false;
        }
        
        filteredRegulations = [...allRegulations];
        console.log('Total regulations found:', allRegulations.length);
        console.log('ITEMS_PER_PAGE:', ITEMS_PER_PAGE);
        console.log('Total pages should be:', Math.ceil(allRegulations.length / ITEMS_PER_PAGE));
        
        updateRegulationsDisplay();
        setupPagination();
        return true;
    }

    // Try initialization on DOMContentLoaded
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            if (!initializePagination()) {
                // If first attempt fails, try again after a longer delay
                setTimeout(initializePagination, 500);
            }
        }, 100);
    });

    // Fallback: also try on window load
    window.addEventListener('load', function() {
        setTimeout(function() {
            if (allRegulations.length === 0) {
                initializePagination();
            }
        }, 200);
    });

    // Category navigation with pagination reset
    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const targetCategory = this.getAttribute('href').replace('#', '');
            
            // Reset pagination
            currentPage = 1;
            
            // In a real application, this would filter by category
            // For now, we'll just scroll to the regulations list
            filteredRegulations = [...allRegulations];
            updateRegulationsDisplay();
            setupPagination();
            
            // Scroll to regulations list
            document.querySelector('.regulations-list').scrollIntoView({
                behavior: 'smooth'
            });
            
            console.log('Filter by category:', targetCategory);
        });
    });

    // Regulation action handlers
    document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#' || !href) {
                e.preventDefault();
                const regulationItem = this.closest('.regulation-item');
                const regulationTitle = regulationItem.querySelector('.regulation-title-item').textContent;
                const regulationNumber = regulationItem.querySelector('.regulation-number').textContent;
                
                if (this.classList.contains('btn-view')) {
                    alert(`Membuka: ${regulationNumber}\n${regulationTitle}`);
                } else if (this.classList.contains('btn-download')) {
                    alert(`Mengunduh: ${regulationNumber}\n${regulationTitle}`);
                }
            }
            // If href is not '#', let the default action happen
        });
    });
</script>
@endpush
