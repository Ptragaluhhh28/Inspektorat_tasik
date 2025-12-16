@extends("layouts.app")

@section("title", "Produk Hukum - Inspektorat Kota Tasikmalaya")

@push("styles")
<style>
    .page-header {
        background: linear-gradient(135deg, rgba(8, 131, 149, 0.9), rgba(115, 200, 210, 0.9));
        background-size: cover;
        color: white;
        padding: 6rem 0 4rem;
        text-align: center;
        
    }
    .page-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }
    .content-section {
        padding: 4rem 0;
    }
    .content-card {
        background: white;
        border-radius: 16px;
        padding: 3rem;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
        margin-bottom: 3rem;
        text-align: center;
    }
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 2rem;
    }
</style>
@endpush

@section("content")
<section class="page-header">
    <div class="container">
        <h1 class="page-title" data-aos="fade-up">Produk Hukum</h1>
        <p style="font-size: 1.2rem; opacity: 0.9;" data-aos="fade-up" data-aos-delay="200">
            Produk Hukum Inspektorat Kota Tasikmalaya
        </p>
    </div>
</section>

<section class="content-section">
    <div class="container">
        <div class="content-card" data-aos="fade-up">
            <h2 class="section-title">Produk Hukum</h2>
            <p>Halaman Produk Hukum akan segera hadir.</p>
        </div>
    </div>
</section>
@endsection
