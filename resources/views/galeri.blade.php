@extends('layouts.app')

@section('title', 'Galeri - Inspektorat Kota Tasikmalaya')

@push('styles')
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- AOS Animation -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* Custom styles for gallery */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .filter-container {
        scrollbar-width: thin;
        scrollbar-color: #cbd5e1 #f1f5f9;
    }
    
    .filter-container::-webkit-scrollbar {
        height: 6px;
    }
    
    .filter-container::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }
    
    .filter-container::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }
    
    .filter-container::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    .modal-backdrop {
        backdrop-filter: blur(8px);
    }
    
    .gallery-item {
        transition: all 0.3s ease;
    }
    
    .gallery-item:hover {
        transform: translateY(-4px);
    }
    
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
    }
    
    /* Loading skeleton */
    .skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }
    
    @keyframes loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container mx-auto px-4">
        <h1 class="page-title" data-aos="fade-up">Galeri</h1>
        <p class="text-xl opacity-90 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            Dokumentasi kegiatan dan aktivitas Inspektorat Kota Tasikmalaya
        </p>
    </div>
</section>

<!-- Gallery Section with Tailwind CSS -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Dokumentasi Kegiatan</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Kumpulan foto kegiatan dan aktivitas Inspektorat Kota Tasikmalaya dalam menjalankan fungsi pengawasan dan pembinaan
            </p>
        </div>

        <!-- Filter Tabs -->
        <div class="flex flex-wrap justify-center gap-2 mb-12 filter-container overflow-x-auto pb-2" data-aos="fade-up" data-aos-delay="200">
            <button class="filter-btn px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300" data-filter="*">
                Semua Kegiatan
            </button>
            <button class="filter-btn px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300" data-filter="audit">
                Audit & Pengawasan
            </button>
            <button class="filter-btn px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300" data-filter="sosialisasi">
                Sosialisasi & Pelatihan
            </button>
            <button class="filter-btn px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300" data-filter="rapat">
                Rapat & Koordinasi
            </button>
            <button class="filter-btn px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300" data-filter="kegiatan">
                Kegiatan Lainnya
            </button>
        </div>

        <!-- Masonry Gallery Grid -->
        <div class="columns-1 sm:columns-2 lg:columns-3 xl:columns-4 gap-6 space-y-6" id="gallery-grid">
            
            <!-- Gallery Item 1 - Audit -->
            <div class="gallery-item audit break-inside-avoid mb-6 bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 cursor-pointer" data-category="audit" data-aos="fade-up" data-aos-delay="100" onclick="openModal('modal1')">
                <div class="relative group">
                    <img src="https://picsum.photos/400/300?random=1" alt="Audit Internal SPIP" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-blue-600 text-xs px-2 py-1 rounded-full font-semibold">Audit</span>
                                <span class="text-xs opacity-75">15 Oktober 2024</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">Pelaksanaan Audit Internal SPIP</h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-3">Kegiatan audit internal terhadap implementasi Sistem Pengendalian Internal Pemerintah di seluruh OPD Kota Tasikmalaya</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500 flex items-center gap-1">
                            <i class="fas fa-calendar"></i>
                            15 Oktober 2024
                        </span>
                        <span class="text-xs text-blue-600 flex items-center gap-1 hover:text-blue-800">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </span>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 2 - Sosialisasi -->
            <div class="gallery-item sosialisasi break-inside-avoid mb-6 bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 cursor-pointer" data-category="sosialisasi" data-aos="fade-up" data-aos-delay="200" onclick="openModal('modal2')">
                <div class="relative group">
                    <img src="https://picsum.photos/400/450?random=2" alt="Sosialisasi SPIP" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-green-600 text-xs px-2 py-1 rounded-full font-semibold">Sosialisasi</span>
                                <span class="text-xs opacity-75">10 Oktober 2024</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">Sosialisasi SPIP untuk ASN</h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-3">Kegiatan sosialisasi pemahaman SPIP kepada seluruh Aparatur Sipil Negara di lingkungan Pemerintah Kota Tasikmalaya</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500 flex items-center gap-1">
                            <i class="fas fa-calendar"></i>
                            10 Oktober 2024
                        </span>
                        <span class="text-xs text-blue-600 flex items-center gap-1 hover:text-blue-800">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </span>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 3 - Rapat -->
            <div class="gallery-item rapat break-inside-avoid mb-6 bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 cursor-pointer" data-category="rapat" data-aos="fade-up" data-aos-delay="300" onclick="openModal('modal3')">
                <div class="relative group">
                    <img src="https://picsum.photos/400/250?random=3" alt="Rapat Koordinasi" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-purple-600 text-xs px-2 py-1 rounded-full font-semibold">Rapat</span>
                                <span class="text-xs opacity-75">5 Oktober 2024</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">Rapat Koordinasi Pengawasan</h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-3">Rapat koordinasi antara Inspektorat dengan seluruh OPD dalam rangka penguatan fungsi pengawasan internal</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500 flex items-center gap-1">
                            <i class="fas fa-calendar"></i>
                            5 Oktober 2024
                        </span>
                        <span class="text-xs text-blue-600 flex items-center gap-1 hover:text-blue-800">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </span>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 4 - Kegiatan -->
            <div class="gallery-item kegiatan break-inside-avoid mb-6 bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 cursor-pointer" data-category="kegiatan" data-aos="fade-up" data-aos-delay="400" onclick="openModal('modal4')">
                <div class="relative group">
                    <img src="https://picsum.photos/400/350?random=4" alt="Workshop Auditor" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-orange-600 text-xs px-2 py-1 rounded-full font-semibold">Workshop</span>
                                <span class="text-xs opacity-75">1 Oktober 2024</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">Workshop Peningkatan Kapasitas Auditor</h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-3">Pelatihan untuk meningkatkan kompetensi dan profesionalisme auditor internal Inspektorat</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500 flex items-center gap-1">
                            <i class="fas fa-calendar"></i>
                            1 Oktober 2024
                        </span>
                        <span class="text-xs text-blue-600 flex items-center gap-1 hover:text-blue-800">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </span>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 5 - Audit -->
            <div class="gallery-item audit break-inside-avoid mb-6 bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 cursor-pointer" data-category="audit" data-aos="fade-up" data-aos-delay="500" onclick="openModal('modal5')">
                <div class="relative group">
                    <img src="https://picsum.photos/400/280?random=5" alt="Evaluasi SAKIP" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-blue-600 text-xs px-2 py-1 rounded-full font-semibold">Evaluasi</span>
                                <span class="text-xs opacity-75">28 September 2024</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">Evaluasi Implementasi SAKIP</h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-3">Kegiatan evaluasi terhadap implementasi Sistem Akuntabilitas Kinerja Instansi Pemerintah</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500 flex items-center gap-1">
                            <i class="fas fa-calendar"></i>
                            28 September 2024
                        </span>
                        <span class="text-xs text-blue-600 flex items-center gap-1 hover:text-blue-800">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </span>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 6 - Sosialisasi -->
            <div class="gallery-item sosialisasi break-inside-avoid mb-6 bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 cursor-pointer" data-category="sosialisasi" data-aos="fade-up" data-aos-delay="600" onclick="openModal('modal6')">
                <div class="relative group">
                    <img src="https://picsum.photos/400/380?random=6" alt="Bimbingan Teknis" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-green-600 text-xs px-2 py-1 rounded-full font-semibold">Bimtek</span>
                                <span class="text-xs opacity-75">25 September 2024</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">Bimbingan Teknis Laporan Keuangan</h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-3">Bimbingan teknis penyusunan dan pelaporan keuangan untuk seluruh OPD</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500 flex items-center gap-1">
                            <i class="fas fa-calendar"></i>
                            25 September 2024
                        </span>
                        <span class="text-xs text-blue-600 flex items-center gap-1 hover:text-blue-800">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </span>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 7 - Rapat -->
            <div class="gallery-item rapat break-inside-avoid mb-6 bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 cursor-pointer" data-category="rapat" data-aos="fade-up" data-aos-delay="700" onclick="openModal('modal7')">
                <div class="relative group">
                    <img src="https://picsum.photos/400/320?random=7" alt="Rapat Evaluasi" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-purple-600 text-xs px-2 py-1 rounded-full font-semibold">Rapat</span>
                                <span class="text-xs opacity-75">20 September 2024</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">Rapat Evaluasi Triwulanan</h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-3">Rapat evaluasi kinerja triwulanan dengan seluruh pimpinan OPD</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500 flex items-center gap-1">
                            <i class="fas fa-calendar"></i>
                            20 September 2024
                        </span>
                        <span class="text-xs text-blue-600 flex items-center gap-1 hover:text-blue-800">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </span>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 8 - Kegiatan -->
            <div class="gallery-item kegiatan break-inside-avoid mb-6 bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 cursor-pointer" data-category="kegiatan" data-aos="fade-up" data-aos-delay="800" onclick="openModal('modal8')">
                <div class="relative group">
                    <img src="https://picsum.photos/400/290?random=8" alt="Monitoring Proyek" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-orange-600 text-xs px-2 py-1 rounded-full font-semibold">Monitoring</span>
                                <span class="text-xs opacity-75">15 September 2024</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">Monitoring Proyek Pembangunan</h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-3">Kegiatan monitoring langsung ke lapangan untuk pengawasan proyek pembangunan</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500 flex items-center gap-1">
                            <i class="fas fa-calendar"></i>
                            15 September 2024
                        </span>
                        <span class="text-xs text-blue-600 flex items-center gap-1 hover:text-blue-800">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-12" data-aos="fade-up">
            <button id="loadMoreBtn" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-8 rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 inline-flex items-center gap-2">
                <i class="fas fa-plus"></i>
                Tampilkan Lebih Banyak
            </button>
        </div>
    </div>
</section>

<!-- Modal untuk Detail Gambar -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 modal-backdrop z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto transform scale-95 opacity-0 transition-all duration-300">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 id="modalTitle" class="text-2xl font-bold text-gray-900"></h3>
                <button onclick="closeModal()" class="bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-full p-2 transition-colors duration-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <img id="modalImage" src="" alt="" class="w-full h-auto rounded-lg mb-4">
            <p id="modalDescription" class="text-gray-700 mb-4"></p>
            <div class="flex items-center justify-between text-sm text-gray-500">
                <span id="modalDate"></span>
                <span id="modalCategory" class="px-3 py-1 rounded-full text-white"></span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- AOS Animation -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS
    AOS.init({
        duration: 1000,
        once: true
    });

    // Initialize filter buttons
    initializeFilters();
    
    // Initialize load more button
    initializeLoadMore();
});

function initializeFilters() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    // Set default active filter
    filterButtons[0].classList.add('bg-blue-600', 'text-white', 'shadow-lg');
    filterButtons[0].classList.remove('bg-white', 'text-gray-700', 'border-2', 'border-gray-200');

    filterButtons.forEach(button => {
        // Set initial inactive styles
        if (!button.classList.contains('bg-blue-600')) {
            button.classList.add('bg-white', 'text-gray-700', 'border-2', 'border-gray-200', 'hover:border-blue-600', 'hover:text-blue-600', 'transform', 'hover:scale-105');
        }
        
        button.addEventListener('click', function() {
            const filterValue = this.getAttribute('data-filter');
            
            // Update active button
            filterButtons.forEach(btn => {
                btn.classList.remove('bg-blue-600', 'text-white', 'shadow-lg');
                btn.classList.add('bg-white', 'text-gray-700', 'border-2', 'border-gray-200', 'hover:border-blue-600', 'hover:text-blue-600', 'transform', 'hover:scale-105');
            });
            
            this.classList.remove('bg-white', 'text-gray-700', 'border-2', 'border-gray-200', 'hover:border-blue-600', 'hover:text-blue-600');
            this.classList.add('bg-blue-600', 'text-white', 'shadow-lg', 'transform', 'hover:scale-105');
            
            // Filter gallery items with animation
            galleryItems.forEach((item, index) => {
                if (filterValue === '*' || item.classList.contains(filterValue)) {
                    item.style.display = 'block';
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(20px)';
                    
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'translateY(0)';
                    }, index * 50);
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
}

function initializeLoadMore() {
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            // Simulate loading more items
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memuat...';
            this.disabled = true;
            
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-plus"></i> Tampilkan Lebih Banyak';
                this.disabled = false;
                showNotification('Tidak ada foto lagi untuk ditampilkan', 'info');
            }, 2000);
        });
    }
}

// Modal functions
function openModal(modalId) {
    const modalData = {
        'modal1': {
            title: 'Pelaksanaan Audit Internal SPIP',
            image: 'https://picsum.photos/800/600?random=1',
            description: 'Kegiatan audit internal terhadap implementasi Sistem Pengendalian Internal Pemerintah di seluruh OPD Kota Tasikmalaya. Audit ini bertujuan untuk memastikan efektivitas pengendalian internal dan memberikan rekomendasi perbaikan untuk meningkatkan kualitas penyelenggaraan pemerintahan.',
            date: '15 Oktober 2024',
            category: 'Audit',
            categoryColor: 'bg-blue-600'
        },
        'modal2': {
            title: 'Sosialisasi SPIP untuk ASN',
            image: 'https://picsum.photos/800/600?random=2',
            description: 'Kegiatan sosialisasi pemahaman SPIP kepada seluruh Aparatur Sipil Negara di lingkungan Pemerintah Kota Tasikmalaya. Materi mencakup prinsip-prinsip dasar SPIP dan implementasinya dalam kegiatan sehari-hari untuk menciptakan good governance.',
            date: '10 Oktober 2024',
            category: 'Sosialisasi',
            categoryColor: 'bg-green-600'
        },
        'modal3': {
            title: 'Rapat Koordinasi Pengawasan',
            image: 'https://picsum.photos/800/600?random=3',
            description: 'Rapat koordinasi antara Inspektorat dengan seluruh OPD dalam rangka penguatan fungsi pengawasan internal. Pembahasan meliputi strategi pengawasan, evaluasi kinerja organisasi, dan sinkronisasi program kerja untuk optimalisasi hasil audit.',
            date: '5 Oktober 2024',
            category: 'Rapat',
            categoryColor: 'bg-purple-600'
        },
        'modal4': {
            title: 'Workshop Peningkatan Kapasitas Auditor',
            image: 'https://picsum.photos/800/600?random=4',
            description: 'Pelatihan untuk meningkatkan kompetensi dan profesionalisme auditor internal Inspektorat. Workshop mencakup teknik audit modern, penggunaan teknologi dalam audit, dan pengembangan soft skills untuk komunikasi yang efektif.',
            date: '1 Oktober 2024',
            category: 'Workshop',
            categoryColor: 'bg-orange-600'
        },
        'modal5': {
            title: 'Evaluasi Implementasi SAKIP',
            image: 'https://picsum.photos/800/600?random=5',
            description: 'Kegiatan evaluasi terhadap implementasi Sistem Akuntabilitas Kinerja Instansi Pemerintah di lingkungan Pemerintah Kota Tasikmalaya untuk memastikan akuntabilitas kinerja yang optimal dan pencapaian target kinerja yang telah ditetapkan.',
            date: '28 September 2024',
            category: 'Evaluasi',
            categoryColor: 'bg-blue-600'
        },
        'modal6': {
            title: 'Bimbingan Teknis Laporan Keuangan',
            image: 'https://picsum.photos/800/600?random=6',
            description: 'Bimbingan teknis penyusunan dan pelaporan keuangan untuk seluruh OPD. Kegiatan ini bertujuan meningkatkan kualitas laporan keuangan, transparansi pengelolaan keuangan daerah, dan kepatuhan terhadap standar akuntansi pemerintahan.',
            date: '25 September 2024',
            category: 'Bimtek',
            categoryColor: 'bg-green-600'
        },
        'modal7': {
            title: 'Rapat Evaluasi Triwulanan',
            image: 'https://picsum.photos/800/600?random=7',
            description: 'Rapat evaluasi kinerja triwulanan dengan seluruh pimpinan OPD untuk mengevaluasi capaian kinerja, mengidentifikasi kendala yang dihadapi, dan menyusun strategi perbaikan untuk periode selanjutnya guna mencapai target yang optimal.',
            date: '20 September 2024',
            category: 'Rapat',
            categoryColor: 'bg-purple-600'
        },
        'modal8': {
            title: 'Monitoring Proyek Pembangunan',
            image: 'https://picsum.photos/800/600?random=8',
            description: 'Kegiatan monitoring langsung ke lapangan untuk pengawasan proyek pembangunan infrastruktur di Kota Tasikmalaya. Pemantauan mencakup aspek teknis, keuangan, waktu pelaksanaan, dan kesesuaian dengan spesifikasi yang telah ditetapkan.',
            date: '15 September 2024',
            category: 'Monitoring',
            categoryColor: 'bg-orange-600'
        }
    };

    const data = modalData[modalId];
    if (data) {
        document.getElementById('modalTitle').textContent = data.title;
        document.getElementById('modalImage').src = data.image;
        document.getElementById('modalImage').alt = data.title;
        document.getElementById('modalDescription').textContent = data.description;
        document.getElementById('modalDate').textContent = data.date;
        
        const categorySpan = document.getElementById('modalCategory');
        categorySpan.textContent = data.category;
        categorySpan.className = `px-3 py-1 rounded-full text-white ${data.categoryColor}`;
        
        const modal = document.getElementById('imageModal');
        const modalContent = modal.querySelector('.bg-white');
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
        
        // Add smooth animation
        setTimeout(() => {
            modalContent.style.transform = 'scale(1)';
            modalContent.style.opacity = '1';
        }, 10);
    }
}

function closeModal() {
    const modal = document.getElementById('imageModal');
    const modalContent = modal.querySelector('.bg-white');
    
    modalContent.style.transform = 'scale(0.95)';
    modalContent.style.opacity = '0';
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }, 300);
}

// Close modal when clicking outside
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});

// Notification function
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg text-white transition-all duration-300 transform translate-x-full`;
    
    switch(type) {
        case 'success':
            notification.classList.add('bg-green-600');
            break;
        case 'error':
            notification.classList.add('bg-red-600');
            break;
        case 'warning':
            notification.classList.add('bg-yellow-600');
            break;
        default:
            notification.classList.add('bg-blue-600');
    }
    
    notification.innerHTML = `
        <div class="flex items-center gap-3">
            <i class="fas fa-info-circle"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Show notification
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Hide notification after 3 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// Add smooth scrolling for filter buttons
document.querySelectorAll('.filter-container').forEach(container => {
    container.addEventListener('wheel', function(e) {
        if (e.deltaY !== 0) {
            e.preventDefault();
            this.scrollLeft += e.deltaY;
        }
    });
});
</script>
@endpush
