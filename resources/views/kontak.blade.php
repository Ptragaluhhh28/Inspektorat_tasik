@extends('layouts.app')

@section('title', 'Kontak - Inspektorat Kota Tasikmalaya')

@push('styles')
<!-- Google Maps CSS and Fonts -->
<style>
    .page-header {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        color: white;
        padding: 2rem 0;
        text-align: center;
        margin-bottom: 0;
    }

    .page-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .contact-container {
        padding: 1.5rem 0;
        margin-bottom: 0;
    }

    .contact-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 4rem;
        margin-bottom: 2rem;
        align-items: start;
    }

    .contact-info {
        padding: 1rem 0;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 1.5rem;
        padding: 2rem;
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(30, 64, 175, 0.1);
        height: 100%;
        min-height: 160px;
        overflow: hidden; /* Mencegah konten apa pun meluap */
        word-wrap: break-word;
    }

    .contact-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 48px rgba(30, 64, 175, 0.2);
        border-color: rgba(30, 64, 175, 0.3);
    }

    .contact-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.4rem;
        flex-shrink: 0;
        box-shadow: 0 4px 16px rgba(30, 64, 175, 0.3);
    }

    .contact-details {
        flex: 1;
        min-width: 0; /* Memungkinkan item fleksibel menyusut di bawah ukuran konten */
        overflow: hidden; /* Mencegah luapan */
    }

    .contact-details h4 {
        font-size: 1.4rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.8rem;
        border-bottom: 2px solid #1e40af;
        padding-bottom: 0.5rem;
        display: inline-block;
        word-wrap: break-word;
        max-width: 100%;
    }

    .contact-details p {
        color: #555;
        line-height: 1.7;
        margin: 0;
        font-size: 1rem;
        word-wrap: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
        max-width: 100%;
    }

    .contact-details a {
        color: #1e40af;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        border-bottom: 1px solid transparent;
        word-wrap: break-word;
        overflow-wrap: break-word;
        display: inline-block;
        max-width: 100%;
    }

    .contact-details a:hover {
        color: #3b82f6;
        border-bottom-color: #3b82f6;
    }

    /* Desain Responsif */
    @media (max-width: 768px) {
        .contact-info-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 3rem;
        }
        
        .contact-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .contact-item {
            padding: 1.5rem;
            min-height: 140px;
        }
        
        .contact-icon {
            width: 48px;
            height: 48px;
            font-size: 1.2rem;
        }
        
        .contact-details h4 {
            font-size: 1.2rem;
        }
    }

    .contact-form {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
    }

    .form-title {
        font-size: 2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
        text-align: center;
    }

    .form-subtitle {
        color: #666;
        text-align: center;
        margin-bottom: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 1rem 1.5rem;
        border: 2px solid #e8ecef;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #1e40af;
        box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }

    .form-btn {
        width: 100%;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .form-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 40px rgba(30, 64, 175, 0.3);
    }

    .map-section {
        background: #E9F8F9;
        padding: 1.5rem 0;
        margin-top: 0;
        margin-bottom: 0;
        border-radius: 20px;
    }

    .section-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1.5rem;
    }

    .map-container {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
        height: 400px;
        position: relative;
    }

    /* Hide Google Maps controls */
    .map-container iframe {
        position: relative;
    }

    /* Hide the "View larger map" link and other controls */
    .gm-style .gm-style-iw-chr {
        display: none !important;
    }

    .gm-style .gm-style-iw-tc {
        display: none !important;
    }

    /* Hide Google logo and terms */
    .map-container iframe::after {
        content: "";
        position: absolute;
        bottom: 0;
        right: 0;
        width: 100px;
        height: 20px;
        background: white;
        z-index: 1000;
    }

    #map {
        height: 100%;
        width: 100%;
        border-radius: 16px;
        position: relative;
    }

    /* Custom Zoom Controls */
    .custom-zoom-controls {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .zoom-btn {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.95);
        border: 2px solid rgba(0,0,0,0.15);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        color: #333;
        transition: all 0.2s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.15);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
    }

    .zoom-btn:hover {
        background: rgba(30, 64, 175, 0.1);
        color: #1e40af;
        border-color: #1e40af;
        transform: scale(1.05);
    }

    .zoom-btn:active {
        transform: scale(0.98);
        box-shadow: 0 1px 5px rgba(0,0,0,0.2);
    }

    .zoom-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background: rgba(255, 255, 255, 0.7);
    }

    /* Map Control Enhancements */
    .map-controls {
        position: absolute;
        bottom: 10px;
        left: 10px;
        z-index: 1000;
        display: flex;
        gap: 8px;
    }

    .map-control-btn {
        background: white;
        border: 2px solid rgba(0,0,0,0.2);
        border-radius: 6px;
        padding: 8px 12px;
        cursor: pointer;
        font-size: 12px;
        color: #333;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .map-control-btn:hover {
        background: #1e40af;
        color: white;
        border-color: #1e40af;
    }

    /* Google Maps Info Window Styles */
    .gm-style .gm-style-iw-c {
        border-radius: 8px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.15);
    }

    .gm-style .gm-style-iw-d {
        overflow: auto !important;
    }

    .popup-content {
        font-family: inherit;
        padding: 10px;
    }

    .popup-content h4 {
        margin: 0 0 8px 0;
        color: #1e40af;
        font-weight: 600;
    }

    .popup-content p {
        margin: 4px 0;
        font-size: 14px;
        color: #666;
    }

    /* Google Maps Controls */
    .gm-style .gm-style-cc {
        display: none;
    }

    .gm-style .gmnoprint {
        display: block;
    }

    .gm-style-mtc {
        display: none;
    }

    /* Fallback Map Styles */
    #map iframe {
        border-radius: 16px;
        width: 100% !important;
        height: 100% !important;
    }

    .map-error-container {
        position: relative;
        height: 100%;
        min-height: 400px;
    }



    .info-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        height: 100%;
    }

    .info-card h4 {
        color: #1e40af;
        margin-bottom: 1rem;
        font-size: 1.2rem;
    }

    .info-card i {
        margin-right: 0.5rem;
    }

    .info-card p {
        color: #666;
        margin-bottom: 1rem;
        line-height: 1.6;
    }

    /* Desain Responsif */
    @media (max-width: 768px) {
        .contact-info-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .contact-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .contact-item {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
            min-height: auto;
        }
        
        .contact-icon {
            margin: 0 auto;
        }
        
        .map-container {
            height: 350px;
        }
        
        .page-title {
            font-size: 2rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        /* Mobile map controls */
        .custom-zoom-controls {
            top: 15px;
            right: 15px;
        }
        
        .zoom-btn {
            width: 35px;
            height: 35px;
            font-size: 16px;
        }
        
        .map-controls {
            bottom: 15px;
            left: 15px;
            flex-wrap: wrap;
        }
        
        .map-control-btn {
            padding: 6px 8px;
            font-size: 11px;
        }
        
        .map-control-btn i {
            margin-right: 2px;
        }
    }
    
    @media (max-width: 480px) {
        .map-container {
            height: 280px;
        }
        
        .map-controls {
            flex-direction: column;
            gap: 4px;
        }
        
        .map-control-btn {
            padding: 4px 6px;
            font-size: 10px;
        }
    }

    .office-hours {
        margin-top: 0;
        margin-bottom: 0;
    }

    .hours-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .hours-card {
        background: white;
        border-radius: 16px;
        padding: 2.5rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .hours-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
    }

    .hours-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .hours-icon {
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

    .hours-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .hours-schedule {
        color: #666;
        line-height: 1.8;
    }

    .hours-schedule strong {
        color: #2c3e50;
    }

    .social-links {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-top: 3rem;
        flex-wrap: wrap;
        align-items: center;
    }

    .social-btn {
        width: 44px;
        height: 44px;
        background: white;
        border: 2px solid #e8ecef;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        text-decoration: none;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        outline: none;
        letter-spacing: 0;
        line-height: 1;
    }

    .social-btn:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.3);
    }

    .social-btn:active {
        transform: translateY(-1px);
        outline: none;
    }

    .social-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        color: white;
        text-decoration: none;
    }

    .social-btn.facebook:hover {
        background: #3b5998;
        border-color: #3b5998;
    }

    .social-btn.instagram:hover {
        background: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d);
        border-color: transparent;
    }

    .social-btn.youtube:hover {
        background: #ff0000;
        border-color: #ff0000;
    }

    .social-btn.twitter:hover {
        background: #1da1f2;
        border-color: #1da1f2;
    }

    .quick-contact {
        background: linear-gradient(135deg, #E9F8F9, #ffffff);
        border-radius: 20px;
        padding: 2.5rem 2rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        margin-top: 0;
        margin-bottom: 0;
        text-align: center;
        border: 1px solid rgba(30, 64, 175, 0.1);
    }

    .quick-contact h3 {
        font-size: 2.2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
        position: relative;
    }

    .quick-contact h3::after {
        content: '';
        position: absolute;
        bottom: -0.5rem;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(135deg, #1e40af, #5a6fd8);
        border-radius: 2px;
    }

    .quick-contact p {
        color: #666;
        margin-bottom: 2.5rem;
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .quick-buttons {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1.5rem;
        max-width: 600px;
        margin: 0 auto;
    }
    
    .quick-buttons-row {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        width: 100%;
    }
    
    .quick-buttons-row.second-row {
        justify-content: center;
    }

    .quick-btn {
        padding: 1.2rem 2rem;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        font-size: 1rem;
        min-width: 200px;
        flex: 0 0 auto;
    }

    .quick-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }

    .btn-whatsapp {
        background: linear-gradient(135deg, #25d366, #128c7e);
        color: white;
    }

    .btn-whatsapp:hover {
        background: linear-gradient(135deg, #128c7e, #25d366);
    }

    .btn-email {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
    }

    .btn-email:hover {
        background: linear-gradient(135deg, #c82333, #dc3545);
    }

    .btn-phone {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
    }

    .btn-phone:hover {
        background: linear-gradient(135deg, #0056b3, #007bff);
    }

    /* Responsive Design untuk Quick Contact */
    @media (max-width: 768px) {
        .quick-contact {
            padding: 2rem;
            margin-top: 2rem;
        }
        
        .quick-contact h3 {
            font-size: 1.8rem;
        }
        
        .quick-buttons {
            gap: 1rem;
        }
        
        .quick-buttons-row {
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }
        
        .quick-btn {
            padding: 1rem 1.5rem;
            width: 100%;
            max-width: 250px;
        }
        
        .social-links {
            gap: 0.8rem;
            margin-top: 2.5rem;
        }
        
        .social-btn {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
    }
    

    .quick-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        color: white;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2.5rem;
        }
        
        .documents-grid {
            grid-template-columns: 1fr;
        }
        
        .document-actions {
            flex-direction: column;
        }
        
        .timeline::before {
            left: 20px;
        }
        
        .timeline-item:nth-child(odd) .timeline-content,
        .timeline-item:nth-child(even) .timeline-content {
            width: calc(100% - 60px);
            margin-left: 60px;
            margin-right: 0;
            text-align: left;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        .timeline-dot {
            left: 20px;
        }
        
        /* Map responsive controls */
        #map {
            height: 350px !important;
        }
        
        .custom-zoom-controls {
            top: 8px;
            right: 8px;
        }
        
        .zoom-btn {
            width: 36px;
            height: 36px;
            font-size: 14px;
        }
        
        .map-controls {
            bottom: 8px;
            left: 8px;
            gap: 6px;
            flex-wrap: wrap;
        }
        
        .map-control-btn {
            padding: 8px 12px;
            font-size: 12px;
        }
    }
    
    @media (max-width: 480px) {
        #map {
            height: 300px !important;
        }
        
        .custom-zoom-controls {
            top: 5px;
            right: 5px;
        }
        
        .zoom-btn {
            width: 32px;
            height: 32px;
            font-size: 12px;
        }
        
        .map-controls {
            bottom: 5px;
            left: 5px;
            right: 5px;
        }
        
        .map-control-btn {
            flex: 1;
            padding: 6px 8px;
            font-size: 11px;
        }
        
        .social-links {
            gap: 0.6rem;
            margin-top: 2rem;
        }
        
        .social-btn {
            width: 36px;
            height: 36px;
            font-size: 0.9rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-title" data-aos="fade-up">Hubungi Kami</h1>
        <p style="font-size: 1.2rem; opacity: 0.9; max-width: 600px; margin: 0 auto;" data-aos="fade-up" data-aos-delay="200">
            Kami siap melayani dan menerima masukan dari masyarakat untuk peningkatan pelayanan publik
        </p>
    </div>
</section>

<!-- Contact Container -->
<section class="contact-container">
    <div class="container">
        <!-- Centered Contact Info Title -->
        <div class="text-center mb-5">
            <h2 class="section-title" data-aos="fade-up">Informasi Kontak</h2>
        </div>
        
        <!-- Contact Information Grid -->
        <div class="contact-info-grid">
            {{-- <div class="contact-item" data-aos="fade-up" data-aos-delay="100">
                <div class="contact-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="contact-details">
                    <h4>Alamat Kantor</h4>
                    <p>Jl. Letnan Harun No. 1, Sukamulya<br>
                    Kec. Bungursari<br>
                    Tasikmalaya, Jawa Barat 46151</p>
                </div>
            </div> --}}

            <div class="contact-item" data-aos="fade-up" data-aos-delay="200">
                <div class="contact-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <div class="contact-details">
                    <h4>Telepon</h4>
                    <p><a href="tel:+62265331548">(0265) 331-548</a></p>
                </div>
            </div>

            <div class="contact-item" data-aos="fade-up" data-aos-delay="300">
                <div class="contact-icon">
                    <i class="fas fa-fax"></i>
                </div>
                <div class="contact-details">
                    <h4>Fax</h4>
                    <p>(0265) 331-549<br>(0265) 331-466</p>
                </div>
            </div>

            <div class="contact-item" data-aos="fade-up" data-aos-delay="400">
                <div class="contact-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="contact-details">
                    <h4>Email</h4>
                    <p><a href="mailto:inspektorat@tasikmalayakota.go.id">inspektorat@tasikmalayakota.go.id</a><br>
                    <a href="mailto:pengaduan@tasikmalayakota.go.id">pengaduan@tasikmalayakota.go.id</a></p>
                </div>
            </div>

            <div class="contact-item" data-aos="fade-up" data-aos-delay="500">
                <div class="contact-icon">
                    <i class="fas fa-globe"></i>
                </div>
                <div class="contact-details">
                    <h4>Website</h4>
                    <p><a href="https://inspektorat.tasikmalayakota.go.id" target="_blank">inspektorat.tasikmalayakota.go.id</a></p>
                </div>
            </div>

            <div class="contact-item" data-aos="fade-up" data-aos-delay="600">
                <div class="contact-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="contact-details">
                    <h4>Jam Operasional</h4>
                    <p><strong>Senin - Kamis:</strong> 08:00 - 16:00 WIB<br>
                    <strong>Jumat:</strong> 08:00 - 16:30 WIB<br>
                    <strong>Sabtu - Minggu:</strong> Tutup</p>
                </div>
            </div>
        </div>
        
        <div class="contact-grid">
            <!-- Contact Form -->
            <div class="contact-form" data-aos="fade-up" data-aos-delay="200">
                <h3 class="form-title">Kirim Pesan</h3>
                <p class="form-subtitle">Silakan isi formulir di bawah ini untuk menghubungi kami</p>

                <form id="contactForm">
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" class="form-input" placeholder="Masukkan nama lengkap Anda" required>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="Masukkan alamat email Anda" required>
                    </div>

                    <div class="form-group">
                        <label for="telepon" class="form-label">Nomor Telepon</label>
                        <input type="tel" id="telepon" name="telepon" class="form-input" placeholder="Masukkan nomor telepon Anda">
                    </div>

                    <div class="form-group">
                        <label for="subjek" class="form-label">Subjek</label>
                        <select id="subjek" name="subjek" class="form-select" required>
                            <option value="">Pilih subjek pesan</option>
                            <option value="pengaduan">Pengaduan</option>
                            <option value="informasi">Permintaan Informasi</option>
                            <option value="saran">Saran dan Masukan</option>
                            <option value="kerjasama">Kerjasama</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pesan" class="form-label">Pesan</label>
                        <textarea id="pesan" name="pesan" class="form-textarea" placeholder="Tuliskan pesan Anda di sini..." required></textarea>
                    </div>

                    <button type="submit" class="form-btn">
                        <i class="fas fa-paper-plane"></i> Kirim Pesan
                    </button>
                </form>
            </div>
        </div>

        <!-- Office Hours - HIDDEN -->
        {{-- <div class="office-hours">
            <h2 class="section-title" data-aos="fade-up">Jam Pelayanan</h2>
            <div class="hours-grid">
                <div class="hours-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="hours-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="hours-title">Jam Kerja</h3>
                    <div class="hours-schedule">
                        <strong>Senin - Kamis:</strong><br>
                        08:00 - 16:00 WIB<br><br>
                        <strong>Jumat:</strong><br>
                        08:00 - 16:30 WIB
                    </div>
                </div>

                <div class="hours-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="hours-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h3 class="hours-title">Pelayanan Publik</h3>
                    <div class="hours-schedule">
                        <strong>Senin - Kamis:</strong><br>
                        08:00 - 15:00 WIB<br><br>
                        <strong>Jumat:</strong><br>
                        08:00 - 15:30 WIB
                    </div>
                </div>

                <div class="hours-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="hours-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="hours-title">Hotline Pengaduan</h3>
                    <div class="hours-schedule">
                        <strong>24 Jam:</strong><br>
                        Setiap hari<br><br>
                        <strong>Call Center:</strong><br>
                        0800-1-234-5678
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Quick Contact - HIDDEN -->
        {{-- <div class="quick-contact" data-aos="fade-up">
            <h3>Kontak Cepat</h3>
            <p>Hubungi kami melalui platform berikut untuk respon yang lebih cepat</p>
            <div class="quick-buttons">
                <div class="quick-buttons-row">
                    <a href="https://wa.me/6285123456789" class="quick-btn btn-whatsapp" target="_blank">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    <a href="mailto:inspektorat@tasikmalayakota.go.id" class="quick-btn btn-email">
                        <i class="fas fa-envelope"></i> Email
                    </a>
                </div>
                <div class="quick-buttons-row second-row">
                    <a href="tel:+62265331433" class="quick-btn btn-phone">
                        <i class="fas fa-phone"></i> Telepon
                    </a>
                </div>
            </div>

            <!-- Social Media Links -->
            <div class="social-links">
                <a href="#" class="social-btn facebook" target="_blank">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-btn instagram" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="social-btn youtube" target="_blank">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="#" class="social-btn twitter" target="_blank">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
        </div> --}}
    </div>
</section>

<!-- Map Section -->
<section class="map-section">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Lokasi Kantor</h2>
        <div class="map-container" data-aos="fade-up" data-aos-delay="200">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.2074418811544!2d108.21810787500382!3d-7.327418992669029!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f50b5b7b5b7b5%3A0x1234567890abcdef!2sJl.%20Letnan%20Harun%20No.1%2C%20Sukamulya%2C%20Kec.%20Bungursari%2C%20Kota%20Tasikmalaya%2C%20Jawa%20Barat%2046151!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                width="100%" 
                height="450" 
                style="border:0;border-radius:15px;pointer-events:auto;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"
                title="Lokasi Inspektorat Kota Tasikmalaya">
            </iframe>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Contact form handling
    document.addEventListener('DOMContentLoaded', function() {
        const contactForm = document.getElementById('contactForm');
        
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Get form data
                const formData = new FormData(this);
                const formObject = {};
                formData.forEach((value, key) => {
                    formObject[key] = value;
                });
                
                // Simple validation
                if (!formObject.nama || !formObject.email || !formObject.subjek || !formObject.pesan) {
                    showAlert('Mohon lengkapi semua field yang diperlukan', 'error');
                    return;
                }
                
                // Email validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(formObject.email)) {
                    showAlert('Format email tidak valid', 'error');
                    return;
                }
                
                // Submit form
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
                submitBtn.disabled = true;
                
                // Send to backend
                fetch('{{ route("kontak.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formObject)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert(data.message, 'success');
                        this.reset();
                    } else {
                        showAlert(data.message || 'Terjadi kesalahan saat mengirim pesan', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.', 'error');
                })
                .finally(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
            });
        }
    });

    // Alert function
    function showAlert(message, type = 'info') {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type}`;
        alertDiv.innerHTML = `
            <div class="alert-content">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'}"></i>
                <span>${message}</span>
                <button class="alert-close" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        document.body.appendChild(alertDiv);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (alertDiv.parentElement) {
                alertDiv.remove();
            }
        }, 5000);
    }
            
</script>
@endpush
