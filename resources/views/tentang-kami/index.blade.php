@extends('layouts.app')

@section('title', 'Tentang Kami - Inspektorat Kota Tasikmalaya')

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

    .page-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }

    .content-section {
        padding: 4rem 0;
    }

    .vision-mission {
        background: #f8f9ff;
        padding: 4rem 0;
    }

    .vm-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 3rem;
        margin-top: 2rem;
    }

    .vm-card {
        background: white;
        padding: 3rem;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        text-align: center;
    }

    .vm-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        color: white;
        font-size: 2rem;
    }

    .vm-title {
        font-size: 1.8rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1.5rem;
    }

    .vm-text {
        color: #666;
        line-height: 1.8;
        font-size: 1.1rem;
    }

    .structure-section {
        padding: 4rem 0;
        background: white;
    }

    .org-chart {
        background: #f8f9ff;
        padding: 3rem;
        border-radius: 20px;
        margin-top: 2rem;
        text-align: center;
    }

    .position-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        margin: 1rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        display: inline-block;
        min-width: 250px;
    }

    .position-title {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .position-name {
        color: #1e40af;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2.5rem;
        }
        
        .vm-grid {
            grid-template-columns: 1fr;
        }
        
        .position-card {
            display: block;
            margin: 1rem 0;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-title" data-aos="fade-up">Tentang Kami</h1>
        <p class="page-subtitle" data-aos="fade-up" data-aos-delay="200">
            Mengenal lebih dekat Inspektorat Kota Tasikmalaya dan komitmen kami dalam mengawal kinerja berintegritas
        </p>
    </div>
</section>

<!-- About Content -->
<section class="content-section">
    <div class="container">
        <div class="row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center;">
            <div data-aos="fade-right">
                <h2 style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 1.5rem;">
                    Inspektorat Kota Tasikmalaya
                </h2>
                <p style="color: #666; line-height: 1.8; margin-bottom: 1.5rem; font-size: 1.1rem;">
                    Inspektorat Kota Tasikmalaya merupakan unsur pengawas penyelenggaraan pemerintahan daerah yang dipimpin oleh Inspektur yang berkedudukan di bawah dan bertanggung jawab kepada Walikota.
                </p>
                <p style="color: #666; line-height: 1.8; margin-bottom: 1.5rem; font-size: 1.1rem;">
                    Dalam menjalankan tugasnya, Inspektorat berkomitmen untuk mewujudkan tata kelola pemerintahan yang baik, bersih, dan akuntabel melalui fungsi pengawasan intern yang profesional dan obyektif.
                </p>
                <a href="{{ route('kontak') }}" class="btn">
                    <i class="fas fa-phone"></i> Hubungi Kami
                </a>
            </div>
            <div data-aos="fade-left">
                <div style="position: relative; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);">
                    <img src="{{ asset('images/gedung-inspektorat.jpg') }}" alt="Gedung Inspektorat" style="width: 100%; height: auto; display: block;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission -->
<section class="vision-mission">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <h2 style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 1rem;">
                Visi & Misi
            </h2>
            <p style="color: #666; font-size: 1.2rem; max-width: 600px; margin: 0 auto;">
                Landasan fundamental dalam menjalankan tugas dan fungsi pengawasan
            </p>
        </div>

        <div class="vm-grid">
            <div class="vm-card" data-aos="fade-up" data-aos-delay="100">
                <div class="vm-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3 class="vm-title">Visi</h3>
                <p class="vm-text">
                    "TASIKMALAYA SEBAGAI KOTA INDUSTRI, JASA DAN PERDAGANGAN YANG RELIGIUS, INOVATIF, MAJU DAN BERKELANJUTAN"
                </p>
            </div>

            <div class="vm-card" data-aos="fade-up" data-aos-delay="200">
                <div class="vm-icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3 class="vm-title">Misi</h3>
                <div class="vm-text" style="text-align: left;">
                    <ol style="padding-left: 1.5rem; line-height: 2;">
                        <li>MEWUJUDKAN SUMBER DAYA MANUSIA YANG BERKUALITAS DAN KEHIDUPAN SOSIAL MASYARAKAT YANG RELIGIUS DAN BERBUDAYA</li>
                        <li>MEWUJUDKAN EKONOMI DAERAH YANG BERKEADILAN, KUAT DAN BERDAYA SAING BERBASIS INDUSTRI, JASA DAN PERDAGANGAN</li>
                        <li>MEWUJUDKAN TATA KELOLA PEMERINTAHAN YANG BAIK DAN BERSIH</li>
                        <li>MEWUJUDKAN INFRASTRUKTUR DAERAH YANG BERKUALITAS DAN MERATA</li>
                        <li>MEWUJUDKAN PEMBANGUNAN YANG BERKELANJUTAN</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Organizational Structure -->
<section class="structure-section">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <h2 style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 1rem;">
                Struktur Organisasi
            </h2>
            <p style="color: #666; font-size: 1.2rem; max-width: 600px; margin: 0 auto;">
                Susunan kepemimpinan dan struktur organisasi Inspektorat Kota Tasikmalaya
            </p>
        </div>

        <div class="org-chart" data-aos="fade-up" data-aos-delay="200">
            <div class="position-card">
                <div class="position-title">Inspektur</div>
                <div class="position-name">-</div>
            </div>

            <div style="margin: 2rem 0;">
                <div class="position-card">
                    <div class="position-title">Sekretaris</div>
                    <div class="position-name">-</div>
                </div>
            </div>

            <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 1rem;">
                <div class="position-card">
                    <div class="position-title">Inspektur Pembantu Wilayah I</div>
                    <div class="position-name">-</div>
                </div>
                <div class="position-card">
                    <div class="position-title">Inspektur Pembantu Wilayah II</div>
                    <div class="position-name">-</div>
                </div>
                <div class="position-card">
                    <div class="position-title">Inspektur Pembantu Wilayah III</div>
                    <div class="position-name">-</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values -->
<section class="content-section" style="background: #f8f9ff;">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <h2 style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 1rem;">
                Nilai-Nilai Berakhlak
            </h2>
          
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
            <div style="background: white; padding: 2rem; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);" data-aos="fade-up" data-aos-delay="100">
                <i class="fas fa-handshake" style="font-size: 2.5rem; color: #1e40af; margin-bottom: 1rem;"></i>
                <h4 style="font-weight: 600; color: #2c3e50; margin-bottom: 1rem;">Integritas</h4>
                <p style="color: #666;">Konsisten dalam menjalankan tugas dengan jujur dan bertanggung jawab</p>
            </div>

            <div style="background: white; padding: 2rem; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);" data-aos="fade-up" data-aos-delay="200">
                <i class="fas fa-users" style="font-size: 2.5rem; color: #1e40af; margin-bottom: 1rem;"></i>
                <h4 style="font-weight: 600; color: #2c3e50; margin-bottom: 1rem;">Profesional</h4>
                <p style="color: #666;">Kompeten, objektif, dan mengutamakan kualitas dalam setiap kegiatan</p>
            </div>

            <div style="background: white; padding: 2rem; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);" data-aos="fade-up" data-aos-delay="300">
                <i class="fas fa-balance-scale" style="font-size: 2.5rem; color: #1e40af; margin-bottom: 1rem;"></i>
                <h4 style="font-weight: 600; color: #2c3e50; margin-bottom: 1rem;">Independen</h4>
                <p style="color: #666;">Bebas dari pengaruh dan tekanan dalam melaksanakan pengawasan</p>
            </div>

            <div style="background: white; padding: 2rem; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);" data-aos="fade-up" data-aos-delay="400">
                <i class="fas fa-lightbulb" style="font-size: 2.5rem; color: #1e40af; margin-bottom: 1rem;"></i>
                <h4 style="font-weight: 600; color: #2c3e50; margin-bottom: 1rem;">Inovatif</h4>
                <p style="color: #666;">Terus mengembangkan metode dan pendekatan pengawasan yang modern</p>
            </div>
        </div>
    </div>
</section>
@endsection
