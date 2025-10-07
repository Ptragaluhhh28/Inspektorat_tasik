@extends('layouts.app')

@section('title', 'Struktur Organisasi - Inspektorat Kota Tasikmalaya')

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

    .struktur-container {
        padding: 4rem 0;
    }

    .org-chart {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 3rem;
        margin: 3rem 0;
    }

    .org-level {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .org-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        position: relative;
        min-width: 280px;
        max-width: 320px;
    }

    .org-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        border-color: #088395;
    }

    .org-card.inspektur {
        background: linear-gradient(135deg, #088395, #73C8D2);
        color: white;
        border-color: #73C8D2;
    }

    .org-card.sekretaris {
        background: linear-gradient(135deg, #17a2b8, #138496);
        color: white;
    }

    .org-card.inspektur-pembantu {
        background: linear-gradient(135deg, #28a745, #1e7e34);
        color: white;
    }

    .org-card.subbag {
        background: linear-gradient(135deg, #ffc107, #e0a800);
        color: #333;
    }

    .position-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .position-name {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        opacity: 0.9;
    }

    .position-desc {
        font-size: 0.9rem;
        line-height: 1.5;
        opacity: 0.8;
    }

    .org-icon {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
    }

    .org-card.subbag .org-icon {
        background: rgba(0, 0, 0, 0.1);
    }

    .connector {
        width: 2px;
        height: 30px;
        background: #ddd;
        margin: 0 auto;
    }

    .connector-h {
        height: 2px;
        background: #ddd;
        flex: 1;
        margin: 0 1rem;
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

    .detail-section {
        margin-top: 4rem;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .detail-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .detail-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    }

    .detail-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #088395, #73C8D2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }

    .detail-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .detail-text {
        color: #666;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2.5rem;
        }
        
        .org-level {
            flex-direction: column;
            gap: 1rem;
        }
        
        .org-card {
            min-width: 260px;
            max-width: 300px;
        }
        
        .connector-h {
            display: none;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-title" data-aos="fade-up">Struktur Organisasi</h1>
        <p style="font-size: 1.2rem; opacity: 0.9; max-width: 600px; margin: 0 auto;" data-aos="fade-up" data-aos-delay="200">
            Struktur organisasi dan tata kelola Inspektorat Kota Tasikmalaya
        </p>
    </div>
</section>

<!-- Introduction -->
<section class="struktur-container">
    <div class="container">
        <div class="intro-section" data-aos="fade-up">
            <div class="intro-content">
                <h2 class="intro-title">Struktur Organisasi Inspektorat</h2>
                <p class="intro-text">
                    Inspektorat Kota Tasikmalaya memiliki struktur organisasi yang dirancang untuk mendukung efektivitas pengawasan internal pemerintah daerah. Struktur ini terdiri dari berbagai posisi strategis yang saling berkoordinasi dalam melaksanakan tugas pengawasan dan pembinaan.
                </p>
            </div>
        </div>

        <!-- Organization Chart -->
        <div class="org-chart">
            <!-- Level 1: Inspektur -->
            <div class="org-level" data-aos="fade-up" data-aos-delay="100">
                <div class="org-card inspektur">
                    <div class="org-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="position-title">Inspektur</div>
                    <div class="position-name">-</div>
                    <div class="position-desc">Pimpinan tertinggi Inspektorat yang bertanggung jawab kepada Walikota</div>
                </div>
            </div>

            <div class="connector"></div>

            <!-- Level 2: Sekretaris -->
            <div class="org-level" data-aos="fade-up" data-aos-delay="200">
                <div class="org-card sekretaris">
                    <div class="org-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="position-title">Sekretaris</div>
                    <div class="position-name">-</div>
                    <div class="position-desc">Menyelenggarakan urusan administrasi dan koordinasi pelaksanaan tugas</div>
                </div>
            </div>

            <div class="connector"></div>

            <!-- Level 3: Sub Bagian -->
            <div class="org-level" data-aos="fade-up" data-aos-delay="300">
                <div class="org-card subbag">
                    <div class="org-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="position-title">Subbag Perencanaan & Evaluasi</div>
                    <div class="position-name">-</div>
                    <div class="position-desc">Menyusun program kerja dan evaluasi kinerja</div>
                </div>
                <div class="org-card subbag">
                    <div class="org-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="position-title">Subbag Umum & Kepegawaian</div>
                    <div class="position-name">-</div>
                    <div class="position-desc">Mengelola administrasi umum dan kepegawaian</div>
                </div>
            </div>

            <div class="connector"></div>

            <!-- Level 4: Inspektur Pembantu -->
            <div class="org-level" data-aos="fade-up" data-aos-delay="400">
                <div class="org-card inspektur-pembantu">
                    <div class="org-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="position-title">Inspektur Pembantu Wilayah I</div>
                    <div class="position-name">-</div>
                    <div class="position-desc">Mengawasi SKPD wilayah I dan pelaksanaan program</div>
                </div>
                <div class="org-card inspektur-pembantu">
                    <div class="org-icon">
                        <i class="fas fa-city"></i>
                    </div>
                    <div class="position-title">Inspektur Pembantu Wilayah II</div>
                    <div class="position-name">-</div>
                    <div class="position-desc">Mengawasi SKPD wilayah II dan pembinaan SPIP</div>
                </div>
                <div class="org-card inspektur-pembantu">
                    <div class="org-icon">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <div class="position-title">Inspektur Pembantu Investigasi</div>
                    <div class="position-name">-</div>
                    <div class="position-desc">Melakukan investigasi dan pengusutan kasus</div>
                </div>
            </div>
        </div>

        <!-- Detail Section -->
        <div class="detail-section">
            <h2 class="intro-title text-center" data-aos="fade-up">Rincian Tugas Jabatan</h2>
            <div class="detail-grid">
                <div class="detail-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="detail-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <h3 class="detail-title">Inspektur</h3>
                    <p class="detail-text">
                        Memimpin dan mengoordinasikan seluruh kegiatan pengawasan, menetapkan kebijakan pengawasan, dan mempertanggungjawabkan pelaksanaan tugas kepada Walikota.
                    </p>
                </div>
                <div class="detail-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="detail-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h3 class="detail-title">Sekretaris</h3>
                    <p class="detail-text">
                        Menyelenggarakan koordinasi pelaksanaan tugas, pembinaan, dan pelayanan administrasi kepada seluruh unsur organisasi di lingkungan Inspektorat.
                    </p>
                </div>
                <div class="detail-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="detail-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3 class="detail-title">Subbag Perencanaan & Evaluasi</h3>
                    <p class="detail-text">
                        Menyusun rencana program pengawasan, melakukan monitoring dan evaluasi, serta menyusun laporan kinerja Inspektorat.
                    </p>
                </div>
                <div class="detail-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="detail-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="detail-title">Subbag Umum & Kepegawaian</h3>
                    <p class="detail-text">
                        Mengelola administrasi umum, kepegawaian, keuangan, perlengkapan, dan rumah tangga Inspektorat.
                    </p>
                </div>
                <div class="detail-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="detail-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="detail-title">Inspektur Pembantu Wilayah I</h3>
                    <p class="detail-text">
                        Melakukan pengawasan terhadap SKPD wilayah I, meliputi Dinas Pendidikan, Kesehatan, Sosial, dan SKPD terkait lainnya.
                    </p>
                </div>
                <div class="detail-card" data-aos="fade-up" data-aos-delay="600">
                    <div class="detail-icon">
                        <i class="fas fa-city"></i>
                    </div>
                    <h3 class="detail-title">Inspektur Pembantu Wilayah II</h3>
                    <p class="detail-text">
                        Melakukan pengawasan terhadap SKPD wilayah II, pembinaan SPIP, dan koordinasi dengan aparat pengawasan lainnya.
                    </p>
                </div>
                <div class="detail-card" data-aos="fade-up" data-aos-delay="700">
                    <div class="detail-icon">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <h3 class="detail-title">Inspektur Pembantu Investigasi</h3>
                    <p class="detail-text">
                        Melakukan investigasi, pengusutan kasus, audit investigatif, dan koordinasi dengan aparat penegak hukum.
                    </p>
                </div>
                <div class="detail-card" data-aos="fade-up" data-aos-delay="800">
                    <div class="detail-icon">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <h3 class="detail-title">Koordinasi Antar Unit</h3>
                    <p class="detail-text">
                        Setiap unit bekerja secara sinergis dan berkoordinasi untuk mencapai tujuan pengawasan yang efektif dan berkelanjutan.
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
