@extends('layouts.app')

@section('title', 'Berita - Inspektorat Kota Tasikmalaya')

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
        background: linear-gradient(135deg, #1e40af, #3b82f6);
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
        background: linear-gradient(135deg, #1e40af, #3b82f6);
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
        color: #1e40af;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .news-date {
        color: #1e40af;
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
        background: linear-gradient(135deg, #1e40af, #3b82f6);
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
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 1rem;
    }

    /* Pagination Styles */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        margin-top: 3rem;
        list-style: none;
        padding: 0;
    }

    .pagination .page-item .page-link {
        min-width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        color: #333;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: 1px solid #e0e0e0;
        padding: 0 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
        border-color: transparent;
        box-shadow: 0 4px 8px rgba(30, 64, 175, 0.3);
    }

    .pagination .page-item .page-link:hover {
        background: #f5f5f5;
        border-color: #d0d0d0;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .pagination .page-item.active .page-link:hover {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        border-color: transparent;
        transform: translateY(-2px);
    }

    .pagination .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
        pointer-events: none;
    }

    /* Hide pagination info text */
    .pagination-wrapper p {
        display: none;
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
        <!-- Filters -->
        <!-- <div class="news-filters" data-aos="fade-up">
            <a href="#" class="filter-btn active">Semua</a>
            <a href="#" class="filter-btn">Kegiatan</a>
            <a href="#" class="filter-btn">Pengumuman</a>
            <a href="#" class="filter-btn">Audit</a>
            <a href="#" class="filter-btn">Sosialisasi</a>
        </div> -->

        <!-- Featured News -->
        @if($berita->count() > 0)
        <div class="featured-news" data-aos="fade-up" data-aos-delay="100">
            <div class="featured-card">
                <div class="featured-image">
                    @if($berita->first()->gambar)
                        <img src="{{ asset('images/berita/' . $berita->first()->gambar) }}" 
                             alt="{{ $berita->first()->judul }}" 
                             style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <i class="fas fa-star"></i>
                    @endif
                </div>
                <div class="featured-content">
                    <span class="featured-badge">Berita Utama</span>
                    <h2 style="font-size: 2rem; font-weight: 700; color: #2c3e50; margin-bottom: 1rem;">
                        {{ $berita->first()->judul }}
                    </h2>
                    <div style="color: #1e40af; font-size: 0.9rem; font-weight: 500; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-calendar"></i> {{ $berita->first()->created_at->format('d F Y') }}
                    </div>
                    <p style="color: #666; line-height: 1.7; margin-bottom: 1.5rem;">
                        {{ Str::limit($berita->first()->excerpt, 200) }}
                    </p>
                    <a href="{{ route('berita.detail', $berita->first()->slug) }}" class="btn">
                        <i class="fas fa-arrow-right"></i> Baca Selengkapnya
                    </a>
                </div>
            </div>
        </div>
        @endif

        <!-- News Grid -->
        <div class="news-grid">
            @if($berita->count() > 1)
                @foreach($berita->skip(1) as $index => $item)
                <article class="news-card" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="news-image">
                        @if($item->gambar)
                            <img src="{{ asset('images/berita/' . $item->gambar) }}" 
                                 alt="{{ $item->judul }}" 
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <i class="fas fa-newspaper"></i>
                        @endif
                    </div>
                    <div class="news-content">
                        <span class="news-category">Berita</span>
                        <div class="news-date">
                            <i class="fas fa-calendar"></i> {{ $item->created_at->format('d M Y') }}
                        </div>
                        <h3 class="news-title">{{ $item->judul }}</h3>
                        <p class="news-excerpt">
                            {{ Str::limit($item->excerpt, 120) }}
                        </p>
                        <a href="{{ route('berita.detail', $item->slug) }}" class="news-link">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            @else
                @if($berita->count() == 0)
                <div class="col-12 text-center py-5">
                    <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada berita tersedia</h5>
                    <p class="text-muted">Silakan kembali lagi nanti untuk membaca berita terbaru.</p>
                </div>
                @endif
            @endif
        </div>

        <!-- Pagination -->
        @if($berita->hasPages())
        <div class="pagination-wrapper d-flex justify-content-center mt-5" data-aos="fade-up">
            {{ $berita->links('vendor.pagination.custom') }}
        </div>
        @endif

    </div>
</section>
@endsection

@push('scripts')
<script>
    // Animation for news cards
    document.addEventListener('DOMContentLoaded', function() {
        // Any simple animations if needed
    });
</script>
@endpush
