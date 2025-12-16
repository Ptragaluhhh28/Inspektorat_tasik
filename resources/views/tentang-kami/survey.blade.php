@extends('layouts.app')

@section('title', 'Survey - Inspektorat Kota Tasikmalaya')

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

    .survey-container {
        padding: 4rem 0;
    }

    .survey-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin: 3rem 0;
    }

    .survey-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
        position: relative;
        overflow: hidden;
    }

    .survey-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
    }

    .survey-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    .survey-icon {
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

    .survey-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2c3e50;
        text-align: center;
        margin-bottom: 1rem;
    }

    .survey-description {
        color: #666;
        line-height: 1.7;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .survey-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-top: 1rem;
        border-top: 1px solid #f0f0f0;
    }

    .survey-duration {
        color: #666;
        font-size: 0.9rem;
    }

    .survey-status {
        padding: 0.3rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .status-active {
        background: #d4edda;
        color: #155724;
    }

    .status-coming {
        background: #fff3cd;
        color: #856404;
    }

    .status-closed {
        background: #f8d7da;
        color: #721c24;
    }

    .survey-btn {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
        padding: 0.8rem 2rem;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: block;
        text-align: center;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    .survey-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(30, 64, 175, 0.3);
        color: white;
        text-decoration: none;
    }

    .survey-btn:disabled {
        background: #ccc;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .results-section {
        background: #E9F8F9;
        padding: 4rem 0;
        border-radius: 20px;
        margin: 4rem 0;
    }

    .results-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .result-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .result-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .result-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
        text-align: center;
    }

    .result-chart {
        height: 200px;
        background: linear-gradient(135deg, #E9F8F9, #e9ecef);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        font-size: 1rem;
        border: 2px dashed #dee2e6;
        margin-bottom: 1rem;
    }

    .result-summary {
        color: #666;
        text-align: center;
        font-size: 0.9rem;
    }

    .form-section {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        margin: 3rem 0;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .form-title {
        font-size: 2rem;
        font-weight: 600;
        color: #2c3e50;
        text-align: center;
        margin-bottom: 2rem;
    }

    .form-group {
        margin-bottom: 2rem;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .form-control {
        width: 100%;
        padding: 1rem;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #1e40af;
        box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
    }

    .form-control.textarea {
        min-height: 120px;
        resize: vertical;
    }

    .rating-group {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .rating-option {
        flex: 1;
        min-width: 120px;
    }

    .rating-option input[type="radio"] {
        display: none;
    }

    .rating-option label {
        display: block;
        padding: 1rem;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .rating-option input[type="radio"]:checked + label {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
        border-color: #1e40af;
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
        
        .survey-grid {
            grid-template-columns: 1fr;
        }
        
        .survey-card {
            padding: 2rem;
        }
        
        .rating-group {
            flex-direction: column;
        }
        
        .rating-option {
            min-width: auto;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-title" data-aos="fade-up">Survey</h1>
        <p style="font-size: 1.2rem; opacity: 0.9; max-width: 600px; margin: 0 auto;" data-aos="fade-up" data-aos-delay="200">
            Survey kepuasan dan evaluasi kinerja Inspektorat Kota Tasikmalaya
        </p>
    </div>
</section>

<!-- Introduction -->
<section class="survey-container">
    <div class="container">
        <div class="intro-section" data-aos="fade-up">
            <div class="intro-content">
                <h2 class="intro-title">Survey Kepuasan Masyarakat</h2>
                <p class="intro-text">
                    Inspektorat Kota Tasikmalaya mengundang partisipasi masyarakat untuk memberikan penilaian dan masukan terhadap kinerja pelayanan kami. Survey ini bertujuan untuk meningkatkan kualitas layanan dan transparansi dalam pelaksanaan tugas pengawasan internal pemerintah daerah.
                </p>
            </div>
        </div>

        <!-- Active Surveys -->
        <h2 class="section-title" data-aos="fade-up">Survey Aktif</h2>
        <div class="survey-grid">
            <div class="survey-card" data-aos="fade-up" data-aos-delay="100">
                <div class="survey-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h3 class="survey-title">Survey Kepuasan Layanan Inspektorat 2024</h3>
                <p class="survey-description">
                    Evaluasi tingkat kepuasan masyarakat terhadap pelayanan dan kinerja Inspektorat Kota Tasikmalaya selama tahun 2024.
                </p>
                <div class="survey-meta">
                    <span class="survey-duration">Durasi: 5-7 menit</span>
                    <span class="survey-status status-active">Aktif</span>
                </div>
                <button class="survey-btn" onclick="openSurvey('kepuasan')">Ikuti Survey</button>
            </div>
            
            <div class="survey-card" data-aos="fade-up" data-aos-delay="200">
                <div class="survey-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="survey-title">Evaluasi Efektivitas Pengawasan</h3>
                <p class="survey-description">
                    Penilaian terhadap efektivitas pelaksanaan fungsi pengawasan internal dan dampaknya terhadap perbaikan tata kelola pemerintahan.
                </p>
                <div class="survey-meta">
                    <span class="survey-duration">Durasi: 8-10 menit</span>
                    <span class="survey-status status-active">Aktif</span>
                </div>
                <button class="survey-btn" onclick="openSurvey('efektivitas')">Ikuti Survey</button>
            </div>
            
            <div class="survey-card" data-aos="fade-up" data-aos-delay="300">
                <div class="survey-icon">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <h3 class="survey-title">Saran dan Masukan Perbaikan</h3>
                <p class="survey-description">
                    Kumpulkan saran dan masukan konstruktif dari masyarakat untuk perbaikan dan pengembangan layanan Inspektorat.
                </p>
                <div class="survey-meta">
                    <span class="survey-duration">Durasi: 3-5 menit</span>
                    <span class="survey-status status-active">Aktif</span>
                </div>
                <button class="survey-btn" onclick="openSurvey('saran')">Ikuti Survey</button>
            </div>
            
            <div class="survey-card" data-aos="fade-up" data-aos-delay="400">
                <div class="survey-icon">
                    <i class="fas fa-calendar"></i>
                </div>
                <h3 class="survey-title">Survey Tahunan Transparansi</h3>
                <p class="survey-description">
                    Evaluasi tahunan mengenai tingkat transparansi dan akuntabilitas dalam pelaksanaan tugas Inspektorat.
                </p>
                <div class="survey-meta">
                    <span class="survey-duration">Durasi: 6-8 menit</span>
                    <span class="survey-status status-coming">Segera Dibuka</span>
                </div>
                <button class="survey-btn" disabled>Segera Hadir</button>
            </div>
        </div>

        <!-- Survey Form Section (Hidden by default) -->
        <div class="form-section" id="survey-form" style="display: none;">
            <h3 class="form-title" id="form-title">Survey Kepuasan Layanan</h3>
            <form id="satisfaction-survey" onsubmit="submitSurvey(event)">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap (Opsional)</label>
                    <input type="text" class="form-control" name="name" placeholder="Masukkan nama Anda">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Email (Opsional)</label>
                    <input type="email" class="form-control" name="email" placeholder="email@example.com">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Status Anda *</label>
                    <select class="form-control" name="status" required>
                        <option value="">Pilih Status</option>
                        <option value="masyarakat">Masyarakat Umum</option>
                        <option value="pegawai">Pegawai Pemerintah</option>
                        <option value="swasta">Sektor Swasta</option>
                        <option value="akademisi">Akademisi</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Bagaimana tingkat kepuasan Anda terhadap pelayanan Inspektorat? *</label>
                    <div class="rating-group">
                        <div class="rating-option">
                            <input type="radio" id="very-satisfied" name="satisfaction" value="5" required>
                            <label for="very-satisfied">Sangat Puas</label>
                        </div>
                        <div class="rating-option">
                            <input type="radio" id="satisfied" name="satisfaction" value="4" required>
                            <label for="satisfied">Puas</label>
                        </div>
                        <div class="rating-option">
                            <input type="radio" id="neutral" name="satisfaction" value="3" required>
                            <label for="neutral">Netral</label>
                        </div>
                        <div class="rating-option">
                            <input type="radio" id="dissatisfied" name="satisfaction" value="2" required>
                            <label for="dissatisfied">Tidak Puas</label>
                        </div>
                        <div class="rating-option">
                            <input type="radio" id="very-dissatisfied" name="satisfaction" value="1" required>
                            <label for="very-dissatisfied">Sangat Tidak Puas</label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Bagaimana penilaian Anda terhadap transparansi informasi? *</label>
                    <div class="rating-group">
                        <div class="rating-option">
                            <input type="radio" id="very-transparent" name="transparency" value="5" required>
                            <label for="very-transparent">Sangat Transparan</label>
                        </div>
                        <div class="rating-option">
                            <input type="radio" id="transparent" name="transparency" value="4" required>
                            <label for="transparent">Transparan</label>
                        </div>
                        <div class="rating-option">
                            <input type="radio" id="neutral-trans" name="transparency" value="3" required>
                            <label for="neutral-trans">Netral</label>
                        </div>
                        <div class="rating-option">
                            <input type="radio" id="not-transparent" name="transparency" value="2" required>
                            <label for="not-transparent">Kurang Transparan</label>
                        </div>
                        <div class="rating-option">
                            <input type="radio" id="very-not-transparent" name="transparency" value="1" required>
                            <label for="very-not-transparent">Tidak Transparan</label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Saran dan Masukan</label>
                    <textarea class="form-control textarea" name="feedback" placeholder="Berikan saran dan masukan Anda untuk perbaikan layanan Inspektorat..."></textarea>
                </div>
                
                <button type="submit" class="survey-btn">Kirim Survey</button>
            </form>
        </div>

        <!-- Survey Results -->
        <div class="results-section">
            <div class="container">
                <h2 class="section-title" data-aos="fade-up">Hasil Survey Terdahulu</h2>
                <div class="results-grid">
                    <div class="result-card" data-aos="fade-up" data-aos-delay="100">
                        <h4 class="result-title">Tingkat Kepuasan 2023</h4>
                        <div class="result-chart">
                            <i class="fas fa-chart-pie" style="font-size: 2rem; margin-right: 1rem; color: #1e40af;"></i>
                            Rata-rata: 4.2/5.0
                        </div>
                        <p class="result-summary">Berdasarkan 347 responden</p>
                    </div>
                    
                    <div class="result-card" data-aos="fade-up" data-aos-delay="200">
                        <h4 class="result-title">Efektivitas Pengawasan</h4>
                        <div class="result-chart">
                            <i class="fas fa-chart-bar" style="font-size: 2rem; margin-right: 1rem; color: #1e40af;"></i>
                            Efektif: 78%
                        </div>
                        <p class="result-summary">Peningkatan 12% dari tahun sebelumnya</p>
                    </div>
                    
                    <div class="result-card" data-aos="fade-up" data-aos-delay="300">
                        <h4 class="result-title">Transparansi Informasi</h4>
                        <div class="result-chart">
                            <i class="fas fa-chart-line" style="font-size: 2rem; margin-right: 1rem; color: #1e40af;"></i>
                            Skor: 4.1/5.0
                        </div>
                        <p class="result-summary">Tingkat transparansi dinilai baik</p>
                    </div>
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

    // Open survey form
    function openSurvey(type) {
        const formSection = document.getElementById('survey-form');
        const formTitle = document.getElementById('form-title');
        
        let title = '';
        switch(type) {
            case 'kepuasan':
                title = 'Survey Kepuasan Layanan Inspektorat 2024';
                break;
            case 'efektivitas':
                title = 'Evaluasi Efektivitas Pengawasan';
                break;
            case 'saran':
                title = 'Saran dan Masukan Perbaikan';
                break;
            default:
                title = 'Survey Inspektorat';
        }
        
        formTitle.textContent = title;
        formSection.style.display = 'block';
        formSection.scrollIntoView({ behavior: 'smooth' });
    }

    // Submit survey
    function submitSurvey(event) {
        event.preventDefault();
        
        // Get form data
        const formData = new FormData(event.target);
        const data = Object.fromEntries(formData.entries());
        
        // Simple validation
        if (!data.satisfaction || !data.transparency || !data.status) {
            alert('Mohon lengkapi semua field yang wajib diisi.');
            return;
        }
        
        // Simulate form submission
        const submitBtn = event.target.querySelector('.survey-btn');
        const originalText = submitBtn.textContent;
        
        submitBtn.textContent = 'Mengirim...';
        submitBtn.disabled = true;
        
        setTimeout(() => {
            alert('Terima kasih! Survey Anda telah berhasil dikirim.');
            event.target.reset();
            document.getElementById('survey-form').style.display = 'none';
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        }, 2000);
    }

    // Smooth scroll for internal links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
@endpush
