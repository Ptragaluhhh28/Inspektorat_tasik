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

<!-- Elfsight Instagram Feed | Untitled Instagram Feed -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <script src="https://elfsightcdn.com/platform.js" async></script>
        <div class="elfsight-app-8a0f4a0d-5ab9-40eb-b22b-306898be9f00" data-elfsight-app-lazy></div>
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
});

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
</script>
@endpush
