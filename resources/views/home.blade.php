@extends('layouts.app')

@section('title', 'Beranda - Portal Islami')

@section('content')
<!-- Import Font Amiri dari Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap" rel="stylesheet">

<style>
    :root {
        --islamic-dark: #0A3A2A;
        --islamic-primary: #125B42;
        --islamic-emerald: #198754;
        --islamic-soft-bg: #F3F8F5;
        --islamic-gold: #D4AF37;
        --card-border: #E0EBE3;
    }

    /* HERO BERANDA */
    .home-hero {
        background: linear-gradient(135deg, var(--islamic-dark) 0%, var(--islamic-primary) 100%);
        color: #FFFFFF;
        padding: 50px 0 70px 0;
        border-radius: 0 0 36px 36px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(10, 58, 42, 0.12);
    }

    .home-hero::after {
        content: "\f64f";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        right: -20px;
        bottom: -40px;
        font-size: 14rem;
        color: rgba(255, 255, 255, 0.03);
        pointer-events: none;
    }

    .hero-badge-home {
        background-color: rgba(212, 175, 55, 0.15);
        color: var(--islamic-gold);
        border: 1px solid rgba(212, 175, 55, 0.3);
        font-weight: 600;
        font-size: 0.82rem;
        letter-spacing: 0.5px;
    }

    /* QUICK MENU CARDS */
    .menu-card {
        background: #FFFFFF;
        border: 1px solid var(--card-border);
        border-radius: 20px;
        padding: 24px;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(15, 81, 50, 0.03);
    }

    .menu-card:hover {
        transform: translateY(-5px);
        border-color: var(--islamic-emerald);
        box-shadow: 0 12px 30px rgba(18, 91, 66, 0.1);
    }

    .menu-icon-box {
        width: 56px;
        height: 56px;
        background: var(--islamic-soft-bg);
        color: var(--islamic-emerald);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
        border: 1px solid var(--card-border);
        transition: all 0.3s;
    }

    .menu-card:hover .menu-icon-box {
        background: var(--islamic-primary);
        color: #FFFFFF;
        border-color: var(--islamic-primary);
    }

    /* QUOTE CARD */
    .quote-card {
        background: linear-gradient(135deg, #FFFFFF, #F8FAF8);
        border: 1px solid var(--card-border);
        border-left: 5px solid var(--islamic-gold);
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }

    /* Ukuran font Arab dikecilkan agar lebih proporsional */
    .quote-arabic {
        font-family: 'Amiri', 'Traditional Arabic', serif;
        font-size: 1.5rem;
        color: var(--islamic-primary);
        line-height: 2;
        font-weight: 700;
        text-align: right;
    }

    @media (max-width: 767.98px) {
        .quote-arabic {
            font-size: 1.3rem;
        }
    }
</style>

<!-- HERO SECTION -->
<div class="home-hero text-center text-lg-start">
    <div class="container px-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge hero-badge-home px-3 py-2 rounded-pill mb-3">
                    <i class="fa-solid fa-moon me-1"></i> Selamat Datang di Portal Islami
                </span>
                <h1 class="fw-bold text-white mb-2 display-6">
                    Teman Setia Ibadah & Belajar Islam Harian
                </h1>
                <p class="text-white-50 mb-0 fs-6" style="max-width: 600px;">
                    Jelajahi kemudahan membaca Al-Qur'an digital, menghafal doa-doa pilihan, dan memantau jadwal sholat akurat langsung dalam satu genggaman.
                </p>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <div class="display-1 text-white opacity-25">
                    <i class="fa-solid fa-kaaba"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- KONTEN UTAMA -->
<div class="container px-3 py-5">
    
    <!-- SECTION MENU UTAMA (QUICK ACCESS) -->
    <div class="mb-5">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="fw-bold mb-0" style="color: var(--islamic-dark);">
                <i class="fa-solid fa-compass text-success me-2"></i> Menu Utama
            </h5>
            <span class="text-muted small">Pilih fitur yang ingin diakses</span>
        </div>

        <div class="row g-4">
            <!-- Menu Al-Quran -->
            <div class="col-md-4">
                <a href="{{ route('quran.index') }}" class="menu-card">
                    <div>
                        <div class="menu-icon-box">
                            <i class="fa-solid fa-book-quran"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Al-Qur'an Digital</h5>
                        <p class="text-muted small mb-0" style="line-height: 1.6;">
                            Baca lengkap 30 Juz, terjemahan bahasa Indonesia, audio murottal merdu per surah, dan pencarian cepat.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-top border-secondary border-opacity-10 d-flex align-items-center text-success fw-semibold small">
                        <span>Buka Al-Qur'an</span> <i class="fa-solid fa-arrow-right ms-auto"></i>
                    </div>
                </a>
            </div>

            <!-- Menu Doa Harian -->
            <div class="col-md-4">
                <a href="{{ route('doa.index') }}" class="menu-card">
                    <div>
                        <div class="menu-icon-box">
                            <i class="fa-solid fa-hands-praying"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Doa & Dzikir</h5>
                        <p class="text-muted small mb-0" style="line-height: 1.6;">
                            Kumpulan panduan doa harian bersumber dari Al-Qur'an dan Sunnah lengkap dengan dalil dan fitur salin.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-top border-secondary border-opacity-10 d-flex align-items-center text-success fw-semibold small">
                        <span>Jelajahi Doa</span> <i class="fa-solid fa-arrow-right ms-auto"></i>
                    </div>
                </a>
            </div>

            <!-- Menu Jadwal Sholat -->
            <div class="col-md-4">
                <a href="{{ route('jadwal.index') }}" class="menu-card">
                    <div>
                        <div class="menu-icon-box">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Jadwal Sholat</h5>
                        <p class="text-muted small mb-0" style="line-height: 1.6;">
                            Pantau waktu sholat harian akurat berdasarkan wilayah provinsi dan kabupaten/kota di seluruh Indonesia.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-top border-secondary border-opacity-10 d-flex align-items-center text-success fw-semibold small">
                        <span>Cek Jadwal</span> <i class="fa-solid fa-arrow-right ms-auto"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- SECTION INSPIRASI / QUOTE ISLAMI -->
    <div class="row">
        <div class="col-12">
            <div class="quote-card">
                <div class="row align-items-center">
                    <div class="col-lg-7 mb-3 mb-lg-0">
                        <span class="badge bg-success bg-opacity-10 text-success fw-semibold px-3 py-1 rounded-pill mb-2">
                            <i class="fa-solid fa-quote-left me-1"></i> Inspirasi Hari Ini
                        </span>
                        <h6 class="fw-bold text-dark mb-1">QS. Al-Baqarah Ayat 152</h6>
                        <p class="text-muted small mb-0">
                            "Maka ingatlah kepada-Ku, Aku pun akan ingat kepadamu. Bersyukurlah kepada-Ku, dan janganlah kamu ingkar kepada-Ku."
                        </p>
                    </div>
                    <div class="col-lg-5 text-lg-end">
                        <div class="quote-arabic">
                            فَاذْكُرُونِي أَذْكُرْكُمْ وَاشْكُرُوا لِي وَلَا تَكْفُرُونِ
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection