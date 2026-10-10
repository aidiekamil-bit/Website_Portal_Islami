@extends('layouts.app')

@section('title', 'Daftar Surah Al-Qur\'an')

@section('content')
<!-- Import Font Amiri dari Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap" rel="stylesheet">

<style>
    :root {
        --islamic-dark: #0A3A2A;
        --islamic-primary: #125B42;
        --islamic-soft-bg: #F3F8F5;
        --islamic-gold: #D4AF37;
        --text-dark: #1F2937;
        --border-color: #E2EFE7;
    }

    main {
        padding-top: 0 !important;
        margin-top: 0 !important;
    }

    /* HERO BANNER */
    .quran-hero {
        background: linear-gradient(135deg, var(--islamic-dark) 0%, var(--islamic-primary) 100%);
        color: #FFFFFF;
        padding: 30px 0 60px 0;
        border-radius: 0 0 32px 32px;
        position: relative;
    }

    .hero-badge {
        background-color: rgba(255, 255, 255, 0.15) !important;
        color: #FFFFFF !important;
        font-weight: 600;
        letter-spacing: 0.5px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.8rem;
    }

    /* FLOATING SEARCH CARD */
    .search-card-wrapper {
        margin-top: -38px;
        position: relative;
        z-index: 10;
    }

    .custom-input-group {
        background: #FFFFFF;
        border-radius: 20px;
        padding: 6px 12px;
        box-shadow: 0 10px 30px rgba(10, 58, 42, 0.08);
        border: 1px solid var(--border-color);
    }

    .custom-input-group .form-control {
        box-shadow: none !important;
        font-size: 0.95rem;
    }

    /* CUSTOM DROPDOWN JUZ INTERAKTIF */
    .juz-dropdown-btn {
        background: var(--islamic-soft-bg);
        border: 1px solid var(--border-color);
        color: var(--islamic-primary);
        font-weight: 600;
        font-size: 0.9rem;
        padding: 8px 16px;
        border-radius: 14px;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        cursor: pointer;
    }

    .juz-dropdown-btn:hover, .juz-dropdown-btn:focus {
        background: #E6F0EA;
        color: var(--islamic-primary);
        border-color: var(--islamic-primary);
    }

    .custom-juz-menu {
        max-height: 280px;
        overflow-y: auto;
        border-radius: 16px;
        border: 1px solid var(--border-color);
        box-shadow: 0 12px 28px rgba(10, 58, 42, 0.12);
        padding: 8px;
        width: 100%;
        min-width: 200px;
    }

    .custom-juz-item {
        border-radius: 10px;
        font-size: 0.88rem;
        font-weight: 600;
        color: var(--text-dark);
        padding: 8px 14px;
        transition: all 0.15s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .custom-juz-item:hover, .custom-juz-item.active {
        background-color: var(--islamic-primary);
        color: #FFFFFF !important;
    }

    .divider-line {
        border-left: 1px solid var(--border-color);
        height: 28px;
    }

    /* FILTER PILLS */
    .filter-pill {
        border: 1px solid var(--border-color);
        background: #FFFFFF;
        color: var(--text-dark);
        border-radius: 30px;
        padding: 6px 18px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .filter-pill.active, .filter-pill:hover {
        background-color: var(--islamic-primary);
        color: #FFFFFF;
        border-color: var(--islamic-primary);
    }

    /* SURAH CARD STYLING */
    .surah-card {
        background-color: #FFFFFF;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 16px 20px;
        transition: all 0.25s ease-in-out;
        text-decoration: none;
        color: inherit;
        display: block;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
    }

    .surah-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 22px rgba(18, 91, 66, 0.1);
        border-color: var(--islamic-primary);
    }

    .surah-number {
        width: 42px;
        height: 42px;
        background-color: var(--islamic-soft-bg);
        color: var(--islamic-primary);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.95rem;
        border: 1px solid rgba(18, 91, 66, 0.12);
        flex-shrink: 0;
    }

    .arabic-font {
        font-family: 'Amiri', 'Traditional Arabic', serif;
        font-size: 1.7rem;
        line-height: 1.4;
        color: var(--islamic-primary);
        font-weight: 700;
        text-align: right;
    }

    .revelation-badge {
        font-size: 0.68rem;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 6px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    .badge-makkiyah {
        background-color: #FFF8E1;
        color: #8F6B00;
    }

    .badge-madaniyah {
        background-color: #E8F5E9;
        color: #0F5132;
    }

    @media (max-width: 767.98px) {
        .quran-hero {
            padding: 25px 0 45px 0;
            border-radius: 0 0 24px 24px;
        }
        .divider-line {
            display: none;
        }
        .arabic-font {
            font-size: 1.5rem;
        }
        .surah-card {
            padding: 14px 16px;
        }
    }
</style>

<!-- HERO SECTION -->
<div class="quran-hero text-center">
    <div class="container px-3">
        <span class="hero-badge px-3 py-1 rounded-pill mb-2">
            <i class="fa-solid fa-book-quran" style="color: var(--islamic-gold);"></i> AL-QUR'AN KAREEM
        </span>
        <h2 class="fw-bold text-white mt-2 mb-1">
            Daftar Surah Al-Qur'an
        </h2>
        <p class="text-white-50 small mb-0">
            Baca dan pelajari firman Allah SWT dengan terjemahan Bahasa Indonesia.
        </p>
    </div>
</div>

<!-- CONTAINER UTAMA -->
<div class="container px-3 pb-5">

    <!-- SEARCH & FILTER FLOATING SECTION -->
    <div class="row justify-content-center search-card-wrapper mb-4">
        <div class="col-lg-10">
            <div class="custom-input-group">
                <div class="row g-2 align-items-center">
                    <!-- Input Pencarian -->
                    <div class="col-12 col-md-7">
                        <div class="input-group border-0">
                            <span class="input-group-text bg-transparent border-0 text-muted ps-2">
                                <i class="fa-solid fa-magnifying-glass text-success"></i>
                            </span>
                            <input type="text" id="searchInput" class="form-control border-0 ps-2" placeholder="Cari nama surah atau arti (contoh: Al-Fatihah)...">
                        </div>
                    </div>

                    <!-- Pemisah Vertikal (Hanya tampil di Desktop) -->
                    <div class="col-auto d-none d-md-block px-0">
                        <div class="divider-line"></div>
                    </div>

                    <!-- Custom Dropdown Filter Juz -->
                    <div class="col-12 col-md">
                        <div class="dropdown">
                            <button class="btn juz-dropdown-btn dropdown-toggle border-0" type="button" id="juzDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                <span><i class="fa-solid fa-layer-group me-2" style="color: var(--islamic-gold);"></i> <span id="selectedJuzText">Semua Juz (1–30)</span></span>
                            </button>
                            <ul class="dropdown-menu custom-juz-menu" aria-labelledby="juzDropdownBtn" id="juzMenuList">
                                <li>
                                    <a class="dropdown-item custom-juz-item active" data-value="all" href="#">
                                        <span>Semua Juz</span>
                                        <i class="fa-solid fa-check small d-none"></i>
                                    </a>
                                </li>
                                @for($i = 1; $i <= 30; $i++)
                                    <li>
                                        <a class="dropdown-item custom-juz-item" data-value="{{ $i }}" href="#">
                                            <span>Juz {{ $i }}</span>
                                        </a>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FILTER QUICK PILLS -->
            <div class="d-flex justify-content-center gap-2 mt-3 flex-wrap">
                <button class="filter-pill active" data-type="all">Semua Jenis</button>
                <button class="filter-pill" data-type="makkiyah">Makkiyah</button>
                <button class="filter-pill" data-type="madaniyah">Madaniyah</button>
            </div>
        </div>
    </div>

    @if(isset($error))
        <div class="alert alert-danger text-center rounded-4 mb-4 shadow-sm">
            <i class="fa-solid fa-circle-exclamation me-1"></i> {{ $error }}
        </div>
    @endif

    <!-- GRID DAFTAR SURAH -->
    <div class="row g-3" id="surahGrid">
        @forelse($suratList as $surah)
           @php
    $rawTempat = strtolower($surah['tempatTurun'] ?? $surah['tempat_turun'] ?? 'mekah');
    $isMadaniyah = str_contains($rawTempat, 'madin') || str_contains($rawTempat, 'madan');
    $typeKey = $isMadaniyah ? 'madaniyah' : 'makkiyah';
    $labelDisplay = $isMadaniyah ? 'Madaniyah' : 'Makkiyah';
@endphp
            <div class="col-12 col-md-6 col-lg-4 surah-item" 
                 data-name="{{ strtolower($surah['namaLatin'] ?? $surah['nama_latin'] ?? '') }}" 
                 data-meaning="{{ strtolower($surah['arti'] ?? '') }}"
                 data-number="{{ $surah['nomor'] }}"
                 data-type="{{ $typeKey }}">
                
                <a href="{{ route('quran.show', $surah['nomor']) }}" class="surah-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3 overflow-hidden">
                            <div class="surah-number">
                                {{ $surah['nomor'] }}
                            </div>
                            <div class="text-truncate">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <h6 class="fw-bold mb-0 text-truncate" style="color: var(--text-dark);">
                                        {{ $surah['namaLatin'] ?? $surah['nama_latin'] ?? '' }}
                                    </h6>
                                    <span class="revelation-badge {{ $typeKey == 'madaniyah' ? 'badge-madaniyah' : 'badge-makkiyah' }}">
                                        {{ $labelDisplay }}
                                    </span>
                                </div>
                                <p class="text-muted small mb-0 text-truncate" style="font-size: 0.85rem;">
                                    {{ $surah['arti'] ?? '' }} • {{ $surah['jumlahAyat'] ?? $surah['jumlah_ayat'] ?? 0 }} Ayat
                                </p>
                            </div>
                        </div>

                        <div class="arabic-font ms-2 text-end flex-shrink-0">
                            {{ $surah['nama'] ?? '' }}
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Surah tidak ditemukan.</p>
            </div>
        @endforelse
    </div>

    <!-- EMPTY STATE -->
    <div id="noResults" class="text-center py-5 d-none">
        <i class="fa-solid fa-magnifying-glass fs-1 text-muted mb-3 opacity-50"></i>
        <h5 class="fw-bold text-secondary">Surah Tidak Ditemukan</h5>
        <p class="text-muted small">Coba kata kunci pencarian lain atau sesuaikan filter Juz / Jenis Surah.</p>
    </div>
</div>

<script>
function initQuranFilter() {
    const searchInput = document.getElementById('searchInput');
    const juzMenuItems = document.querySelectorAll('.custom-juz-item');
    const selectedJuzText = document.getElementById('selectedJuzText');
    const filterPills = document.querySelectorAll('.filter-pill');
    const items = document.querySelectorAll('.surah-item');
    const noResults = document.getElementById('noResults');

    if (!searchInput) return;

    let selectedJuz = 'all';
    let currentType = 'all';

    const juzSurahMap = {
        1: [1, 2], 2: [2], 3: [2, 3], 4: [3, 4], 5: [4],
        6: [4, 5], 7: [5, 6], 8: [6, 7], 9: [7, 8], 10: [8, 9],
        11: [9, 10, 11], 12: [11, 12], 13: [12, 13, 14], 14: [15, 16], 15: [17, 18],
        16: [18, 19, 20], 17: [21, 22], 18: [23, 24, 25], 19: [25, 26, 27], 20: [27, 28, 29],
        21: [29, 30, 31, 32, 33], 22: [33, 34, 35, 36], 23: [36, 37, 38, 39], 24: [39, 40, 41], 25: [41, 42, 43, 44, 45],
        26: [46, 47, 48, 49, 50, 51], 27: [51, 52, 53, 54, 55, 56, 57], 28: [58, 59, 60, 61, 62, 63, 64, 65, 66],
        29: [67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77],
        30: [78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114]
    };

    // Fungsi untuk membersihkan spasi dan tanda hubung agar pencarian fleksibel
    function cleanString(str) {
        return str.toLowerCase().replace(/[-\s]/g, '');
    }

    function filterSurah() {
        const rawQuery = searchInput.value.trim();
        const query = cleanString(rawQuery);
        let visibleCount = 0;

        items.forEach(item => {
            const rawName = item.dataset.name;
            const rawMeaning = item.dataset.meaning;
            
            const name = cleanString(rawName);
            const meaning = cleanString(rawMeaning);

            const num = parseInt(item.dataset.number);
            const type = item.dataset.type;

            // Bisa mendeteksi meski diketik tanpa spasi/tanda hubung (contoh: 'annaba' atau 'alfatihah')
            const matchesSearch = query === '' || name.includes(query) || meaning.includes(query) || rawName.toLowerCase().includes(rawQuery.toLowerCase());
            let matchesJuz = true;
            let matchesType = (currentType === 'all' || type === currentType);

            if (selectedJuz !== 'all') {
                const allowedSurahs = juzSurahMap[selectedJuz] || [];
                matchesJuz = allowedSurahs.includes(num);
            }

            if (matchesSearch && matchesJuz && matchesType) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        if (visibleCount === 0) {
            noResults.classList.remove('d-none');
        } else {
            noResults.classList.add('d-none');
        }
    }

    juzMenuItems.forEach(menuItem => {
        menuItem.addEventListener('click', function (e) {
            e.preventDefault();
            juzMenuItems.forEach(item => item.classList.remove('active'));
            this.classList.add('active');

            selectedJuz = this.dataset.value;
            selectedJuzText.innerText = selectedJuz === 'all' ? 'Semua Juz (1–30)' : `Juz ${selectedJuz}`;
            
            filterSurah();
        });
    });

    filterPills.forEach(pill => {
        pill.addEventListener('click', function () {
            filterPills.forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            currentType = this.dataset.type;
            filterSurah();
        });
    });

    searchInput.addEventListener('input', filterSurah);
}

document.addEventListener('DOMContentLoaded', initQuranFilter);
document.addEventListener('turbo:load', initQuranFilter);
</script>
@endsection