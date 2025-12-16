@extends('layouts.app')

@section('title', 'Dukungan - Inspektorat Kota Tasikmalaya')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, rgba(30, 64, 175, 0.9), rgba(59, 130, 246, 0.9)),
        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 300"><polygon fill="%23ffffff15" points="0,0 1000,100 1000,300 0,200"/></svg>');
        
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

    .dukungan-container {
        padding: 4rem 0;
    }

    .support-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin: 3rem 0;
    }

    .support-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
    }

    .support-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    .support-icon {
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

    .support-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .support-description {
        color: #666;
        line-height: 1.7;
        margin-bottom: 2rem;
    }

    .support-btn {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
        padding: 0.8rem 2rem;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .support-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(30, 64, 175, 0.3);
        color: white;
        text-decoration: none;
    }

    .contact-section {
        background: #E9F8F9;
        padding: 4rem 0;
        border-radius: 20px;
        margin: 4rem 0;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }

    .contact-item {
        background: white;
        padding: 2rem;
        border-radius: 16px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .contact-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .contact-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-size: 1.5rem;
    }

    .contact-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .contact-info {
        color: #666;
        font-weight: 500;
    }

    .faq-section {
        margin: 4rem 0;
    }

    .faq-item {
        background: white;
        border-radius: 16px;
        margin-bottom: 1rem;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .faq-question {
        background: #E9F8F9;
        padding: 1.5rem 2rem;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
    }

    .faq-question:hover {
        background: #e9ecef;
    }

    .faq-question.active {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
    }

    .faq-question h4 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 600;
    }

    .faq-toggle {
        font-size: 1.2rem;
        transition: transform 0.3s ease;
    }

    .faq-question.active .faq-toggle {
        transform: rotate(180deg);
    }

    .faq-answer {
        padding: 0 2rem;
        max-height: 0;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .faq-answer.active {
        padding: 1.5rem 2rem;
        max-height: 200px;
    }

    .faq-answer p {
        margin: 0;
        color: #666;
        line-height: 1.6;
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

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        border-radius: 2px;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2.5rem;
        }
        
        .support-card {
            padding: 2rem;
        }
        
        .support-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-title" data-aos="fade-up">Dukungan</h1>
        <p style="font-size: 1.2rem; opacity: 0.9; max-width: 600px; margin: 0 auto;" data-aos="fade-up" data-aos-delay="200">
            Layanan dukungan dan bantuan untuk masyarakat dan instansi pemerintah
        </p>
    </div>
</section>

<!-- Introduction -->
<section class="dukungan-container">
    <div class="container">
        <div class="intro-section" data-aos="fade-up">
            <div class="intro-content">
                <h2 class="intro-title">Layanan Dukungan Inspektorat</h2>
                <p class="intro-text">
                    Inspektorat Kota Tasikmalaya berkomitmen untuk memberikan layanan dukungan terbaik kepada masyarakat dan instansi pemerintah. Kami menyediakan berbagai saluran komunikasi dan layanan konsultasi untuk mendukung terciptanya tata kelola pemerintahan yang baik.
                </p>
            </div>
        </div>

        <!-- Support Services -->
        <h2 class="section-title" data-aos="fade-up">Layanan Dukungan</h2>
        <div class="support-grid">
            <div class="support-card" data-aos="fade-up" data-aos-delay="100">
                <div class="support-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3 class="support-title">Konsultasi Pengawasan</h3>
                <p class="support-description">
                    Layanan konsultasi terkait sistem pengawasan internal, pengendalian intern, dan audit untuk SKPD di lingkungan Pemerintah Kota Tasikmalaya.
                </p>
                <a href="#contact" class="support-btn">Hubungi Kami</a>
            </div>
            
            <div class="support-card" data-aos="fade-up" data-aos-delay="200">
                <div class="support-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <h3 class="support-title">Pelaporan Pengaduan</h3>
                <p class="support-description">
                    Saluran pelaporan untuk pengaduan masyarakat terkait dugaan penyimpangan, korupsi, atau pelanggaran yang terjadi di lingkungan Pemerintah Kota Tasikmalaya.
                </p>
                <a href="#contact" class="support-btn">Laporkan</a>
            </div>
            
            <div class="support-card" data-aos="fade-up" data-aos-delay="300">
                <div class="support-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3 class="support-title">Pelatihan & Bimbingan</h3>
                <p class="support-description">
                    Program pelatihan dan bimbingan teknis mengenai SPIP, audit internal, pencegahan korupsi, dan tata kelola pemerintahan yang baik.
                </p>
                <a href="#contact" class="support-btn">Daftar Pelatihan</a>
            </div>
            
            <div class="support-card" data-aos="fade-up" data-aos-delay="400">
                <div class="support-icon">
                    <i class="fas fa-city"></i>
                </div>
                <h3 class="support-title">Whistleblowing System</h3>
                <p class="support-description">
                    Sistem pelaporan pelanggaran yang menjamin kerahasiaan identitas pelapor dan memberikan perlindungan hukum sesuai ketentuan yang berlaku.
                </p>
                <a href="#contact" class="support-btn">Sistem WBS</a>
            </div>
            
            <div class="support-card" data-aos="fade-up" data-aos-delay="500">
                <div class="support-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="support-title">Monitoring & Evaluasi</h3>
                <p class="support-description">
                    Bantuan dalam penyusunan sistem monitoring dan evaluasi kinerja, serta pendampingan implementasi indikator kinerja utama (IKU).
                </p>
                <a href="#contact" class="support-btn">Konsultasi Monev</a>
            </div>
            
            <div class="support-card" data-aos="fade-up" data-aos-delay="600">
                <div class="support-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <h3 class="support-title">Informasi Publik</h3>
                <p class="support-description">
                    Layanan informasi publik sesuai UU No. 14 Tahun 2008, termasuk laporan hasil pengawasan dan dokumen publik lainnya.
                </p>
                <a href="#contact" class="support-btn">Akses Informasi</a>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="contact-section" id="contact">
            <div class="container">
                <h2 class="section-title" data-aos="fade-up">Informasi Kontak</h2>
                <div class="contact-grid">
                    <div class="contact-item" data-aos="fade-up" data-aos-delay="100">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h4 class="contact-title">Telepon</h4>
                        <p class="contact-info">(0265) 331548</p>
                    </div>
                    
                    <div class="contact-item" data-aos="fade-up" data-aos-delay="200">
                        <div class="contact-icon">
                            <i class="fas fa-fax"></i>
                        </div>
                        <h4 class="contact-title">Fax</h4>
                        <p class="contact-info">(0265) 331549</p>
                    </div>
                    
                    <div class="contact-item" data-aos="fade-up" data-aos-delay="300">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h4 class="contact-title">Email</h4>
                        <p class="contact-info">inspektorat@tasikmalayakota.go.id</p>
                    </div>
                    
                    <div class="contact-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h4 class="contact-title">Alamat</h4>
                        <p class="contact-info">Jl. Letnan Harun No. 1, Sukamulya, Kec. Bungursari, Tasikmalaya, Jawa Barat 46151</p>
                    </div>
                    
                    <div class="contact-item" data-aos="fade-up" data-aos-delay="500">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h4 class="contact-title">Jam Layanan</h4>
                        <p class="contact-info">Senin - Jumat<br>08:00 - 16:00 WIB</p>
                    </div>
                    
                    <div class="contact-item" data-aos="fade-up" data-aos-delay="600">
                        <div class="contact-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4 class="contact-title">Hotline Pengaduan</h4>
                        <p class="contact-info">0858-9876-5432<br>(24 Jam)</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="faq-section">
            <h2 class="section-title" data-aos="fade-up">Pertanyaan yang Sering Diajukan</h2>
            
            <div class="faq-item" data-aos="fade-up" data-aos-delay="100">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <h4>Bagaimana cara melaporkan dugaan penyimpangan?</h4>
                    <span class="faq-toggle">▼</span>
                </div>
                <div class="faq-answer">
                    <p>Anda dapat melaporkan dugaan penyimpangan melalui berbagai saluran: datang langsung ke kantor Inspektorat, mengirim email ke inspektorat@tasikmalayakota.go.id, menghubungi hotline pengaduan 0858-9876-5432, atau menggunakan sistem whistleblowing online.</p>
                </div>
            </div>
            
            <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <h4>Apakah identitas pelapor akan dirahasiakan?</h4>
                    <span class="faq-toggle">▼</span>
                </div>
                <div class="faq-answer">
                    <p>Ya, identitas pelapor akan dijamin kerahasiaannya sesuai dengan peraturan perundang-undangan yang berlaku. Inspektorat juga menyediakan sistem pelaporan anonim untuk memberikan rasa aman kepada pelapor.</p>
                </div>
            </div>
            
            <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <h4>Berapa lama proses penanganan pengaduan?</h4>
                    <span class="faq-toggle">▼</span>
                </div>
                <div class="faq-answer">
                    <p>Proses penanganan pengaduan bervariasi tergantung kompleksitas kasus. Secara umum, konfirmasi penerimaan pengaduan diberikan dalam 3 hari kerja, dan penanganan substantif dilakukan sesuai dengan prosedur yang berlaku dengan tetap mengutamakan kecepatan dan ketelitian.</p>
                </div>
            </div>
            
            <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <h4>Siapa yang dapat mengajukan konsultasi SPIP?</h4>
                    <span class="faq-toggle">▼</span>
                </div>
                <div class="faq-answer">
                    <p>Seluruh SKPD di lingkungan Pemerintah Kota Tasikmalaya dapat mengajukan konsultasi terkait Sistem Pengendalian Intern Pemerintah (SPIP). Konsultasi dapat dilakukan melalui surat resmi atau dengan menghubungi langsung Inspektorat.</p>
                </div>
            </div>
            
            <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <h4>Bagaimana cara mendapat informasi hasil pengawasan?</h4>
                    <span class="faq-toggle">▼</span>
                </div>
                <div class="faq-answer">
                    <p>Informasi hasil pengawasan dapat diakses melalui layanan informasi publik sesuai UU No. 14 Tahun 2008. Anda dapat mengajukan permohonan informasi secara tertulis atau melalui email. Beberapa laporan juga dipublikasikan di website resmi.</p>
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

    // FAQ Toggle Function
    function toggleFAQ(element) {
        const answer = element.nextElementSibling;
        const toggle = element.querySelector('.faq-toggle');
        
        // Close all other FAQs
        document.querySelectorAll('.faq-question').forEach(q => {
            if (q !== element) {
                q.classList.remove('active');
                q.nextElementSibling.classList.remove('active');
            }
        });
        
        // Toggle current FAQ
        element.classList.toggle('active');
        answer.classList.toggle('active');
    }
</script>
@endpush
