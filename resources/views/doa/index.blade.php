@extends('layouts.app')

@section('title', 'Panduan Doa & Dzikir - Portal Islami')

@section('styles')
<!-- Import Font Arabic Khas Al-Qur'an -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Scheherazade+New:wght@400;700&display=swap" rel="stylesheet">

<style>
    :root {
        --islamic-gold: #D4AF37;
        --islamic-green: #0F5132;
        --islamic-emerald: #198754;
    }

    .doa-hero-card {
        background: linear-gradient(135deg, #11261D, #198754);
        color: #ffffff;
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(15, 81, 50, 0.15);
        border: 1px solid var(--islamic-gold);
    }

    .hajat-pills {
        display: flex;
        gap: 0.6rem;
        overflow-x: auto;
        padding-bottom: 0.8rem;
        margin-bottom: 1.5rem;
        scrollbar-width: thin;
    }

    .pill-btn {
        background: #FFFFFF;
        border: 1px solid #E0EBE3;
        padding: 0.5rem 1.2rem;
        border-radius: 30px;
        font-size: 0.88rem;
        font-weight: 600;
        color: #576d65;
        white-space: nowrap;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
    }

    .pill-btn.active, .pill-btn:hover {
        background: var(--islamic-green);
        color: #ffffff;
        border-color: var(--islamic-green);
    }

    .search-box-islamic {
        display: flex;
        gap: 0.75rem;
        background: #FFFFFF;
        padding: 0.5rem;
        border-radius: 16px;
        border: 1px solid #E0EBE3;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        margin-bottom: 2rem;
    }

    .search-input-islamic {
        flex: 1;
        padding: 0.6rem 1rem;
        border: none;
        background: transparent;
        font-size: 0.95rem;
        outline: none;
    }

    /* KARTU DOA PUTIH ELEGAN */
    .doa-card-custom {
        background: #FFFFFF;
        border: 1px solid #E0EBE3;
        border-radius: 16px;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        box-shadow: 0 6px 20px rgba(15, 81, 50, 0.04);
        transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .doa-card-custom:hover {
        transform: translateY(-3px);
        border-color: #198754;
        box-shadow: 0 10px 25px rgba(15, 81, 50, 0.08);
    }

    .badge-kategori-ref {
        background: #E8F3EC;
        color: #0F5132;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.35rem 0.8rem;
        border-radius: 20px;
        display: inline-block;
        border: 1px solid #C3E6CB;
    }

    .doa-title-ref {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1A3323;
        line-height: 1.4;
        margin-bottom: 0.75rem;
    }

    .doa-desc-ref {
        color: #576d65;
        font-size: 0.88rem;
        line-height: 1.6;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .tag-pill-ref {
        background: #F8FAF8;
        color: #576d65;
        font-size: 0.72rem;
        font-weight: 600;
        padding: 0.2rem 0.6rem;
        border-radius: 12px;
        border: 1px solid #E0EBE3;
    }

    .btn-baca-ref {
        background-color: #198754;
        color: #FFFFFF;
        font-weight: 600;
        font-size: 0.9rem;
        border: none;
        border-radius: 12px;
        padding: 0.6rem 1rem;
        transition: background-color 0.2s;
    }

    .btn-baca-ref:hover {
        background-color: #157347;
        color: #FFFFFF;
    }

    .btn-share-ref {
        background: #F8FAF8;
        border: 1px solid #E0EBE3;
        color: #1A3323;
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s, color 0.2s;
    }

    .btn-share-ref:hover {
        background: #E8F3EC;
        color: #0F5132;
        border-color: #C3E6CB;
    }

    /* FONT ARAB STYLE AL-QUR'AN */
    .quran-arabic-text {
        font-family: 'Amiri', 'Scheherazade New', 'Traditional Arabic', 'LPMQ Isep Misbah', serif;
        font-size: 2.2rem;
        line-height: 2.3;
        font-weight: 700;
        color: #0F5132;
        direction: rtl;
        text-align: right;
        word-spacing: 2px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="doa-hero-card">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-2"><i class="fa-solid fa-hands-praying me-2" style="color: var(--islamic-gold);"></i> Kumpulan Doa & Dzikir Harian</h2>
                <p class="mb-0 text-white-50">Temukan panduan doa lengkap bersumber dari Al-Qur'an dan Sunnah untuk menemani setiap aktivitas ibadah harian Anda.</p>
            </div>
        </div>
    </div>

   <!-- Filter Hajat Pills -->
<div class="fw-bold small text-uppercase mb-2" style="color: var(--islamic-green); letter-spacing: 1px;">
    <i class="fa-solid fa-filter me-1"></i> Filter Berdasarkan Hajat:
</div>
<div class="hajat-pills">
    <button class="pill-btn active" onclick="filterHajat('semua', this)"><i class="fa-solid fa-border-all"></i> Semua Doa</button>
    <button class="pill-btn" onclick="filterHajat('rezeki', this)"><i class="fa-solid fa-coins"></i> Kelancaran Rezeki</button>
    <button class="pill-btn" onclick="filterHajat('kesehatan', this)"><i class="fa-solid fa-heart-pulse"></i> Kesembuhan & Kesehatan</button>
    <button class="pill-btn" onclick="filterHajat('keselamatan', this)"><i class="fa-solid fa-shield-halved"></i> Perlindungan & Selamat</button>
    <button class="pill-btn" onclick="filterHajat('keluarga', this)"><i class="fa-solid fa-users"></i> Orang Tua & Keluarga</button>
    <button class="pill-btn" onclick="filterHajat('ilmu', this)"><i class="fa-solid fa-graduation-cap"></i> Kelancaran Belajar</button>
</div>

    <!-- Search Box -->
    <form action="{{ route('doa.index') }}" method="GET" class="search-box-islamic">
        <input 
            type="text" 
            name="search" 
            class="search-input-islamic" 
            placeholder="Cari doa harian (contoh: bangun tidur, rezeki, orang tua)..."
            value="{{ $search ?? '' }}"
        >
       
    </form>

    <!-- Doa Grid -->
    <div class="row g-4" id="doaGrid">
        @forelse ($doaList as $index =>$doa)
         @php
    $item = is_array($doa) ? $doa : (array)$doa;
    $judul = $item['nama'] ?? ($item['doa'] ?? 'Doa Harian');
    $arab = $item['ar'] ?? ($item['arab'] ?? '');
    $latin = $item['tr'] ?? ($item['latin'] ?? '');
    $terjemahan = $item['idn'] ?? ($item['terjemahan'] ?? '');
    
    $dalil = 'Diriwayatkan dari Hadits Shahih bersumber dari Hisnul Muslim.';
    if (isset($item['dalil']) && $item['dalil'] != '') {
        $dalil = $item['dalil'];
    } elseif (isset($item['sumber']) && $item['sumber'] != '') {
        $dalil = $item['sumber'];
    } elseif (isset($item['tentang']) && $item['tentang'] != '') {
        $dalil = $item['tentang'];
    } elseif (isset($item['keterangan']) && $item['keterangan'] != '') {
        $dalil = $item['keterangan'];
    }

    $cardId = 'card-' . $index;
    $lowerJudul = strtolower($judul);
    
    // Default kategori jika tidak cocok dengan hajat spesifik
    $kategoriTag = 'Umum & Harian';
    $kategoriSlug = 'semua';

    if (str_contains($lowerJudul, 'rezeki') || str_contains($lowerJudul, 'hutang') || str_contains($lowerJudul, 'kaya')) {
        $kategoriSlug = 'rezeki';
        $kategoriTag = 'Kelancaran Rezeki';
    } elseif (str_contains($lowerJudul, 'sakit') || str_contains($lowerJudul, 'sehat') || str_contains($lowerJudul, 'demam') || str_contains($lowerJudul, 'kesembuhan')) {
        $kategoriSlug = 'kesehatan';
        $kategoriTag = 'Kesembuhan & Kesehatan';
    } elseif (str_contains($lowerJudul, 'lindung') || str_contains($lowerJudul, 'selamat') || str_contains($lowerJudul, 'keamanan') || str_contains($lowerJudul, 'buruk')) {
        $kategoriSlug = 'keselamatan';
        $kategoriTag = 'Perlindungan & Selamat';
    } elseif (str_contains($lowerJudul, 'orang tua') || str_contains($lowerJudul, 'ibu') || str_contains($lowerJudul, 'bapak') || str_contains($lowerJudul, 'keluarga')) {
        $kategoriSlug = 'keluarga';
        $kategoriTag = 'Orang Tua & Keluarga';
    } elseif (str_contains($lowerJudul, 'ilmu') || str_contains($lowerJudul, 'belajar') || str_contains($lowerJudul, 'paham')) {
        $kategoriSlug = 'ilmu';
        $kategoriTag = 'Kelancaran Belajar';
    }
@endphp
            <div class="col-md-6 col-lg-4 doa-wrapper" data-category="{{ $kategoriSlug }}">
                <div class="doa-card-custom" id="{{ $cardId }}">
                    <div>
                        <!-- Badge Kategori -->
                        <div class="mb-3">
                            <span class="badge-kategori-ref">{{ $kategoriTag }}</span>
                        </div>

                        <!-- Judul Doa -->
                        <h5 class="doa-title-ref">{{ $judul }}</h5>

                        <!-- Dalil pada Kartu -->
                        <div class="doa-desc-ref">
                            {{ $dalil }}
                        </div>

                        <!-- Tag Kecil -->
                        <div class="d-flex gap-1 mb-3 flex-wrap">
                            <span class="tag-pill-ref">harian</span>
                            <span class="tag-pill-ref">dzikir</span>
                        </div>
                    </div>

                    <!-- Tombol Baca & Share -->
                    <div class="d-flex align-items-center gap-2 pt-3 border-top border-secondary border-opacity-25">
                        <button 
                            type="button"
                            class="btn btn-baca-ref flex-grow-1 btn-action-baca" 
                            data-judul="{{ $judul }}"
                            data-arab="{{ $arab }}"
                            data-latin="{{ $latin }}"
                            data-terjemahan="{{ $terjemahan }}"
                            data-dalil="{{ $dalil }}"
                        >
                            <i class="fa-solid fa-book-open me-2"></i> Baca
                        </button>

                        <button 
                            type="button"
                            class="btn-share-ref btn-action-share" 
                            title="Salin / Bagikan" 
                            data-judul="{{ $judul }}"
                            data-arab="{{ $arab }}"
                            data-terjemahan="{{ $terjemahan }}"
                            data-dalil="{{ $dalil }}"
                        >
                            <i class="fa-solid fa-share-nodes"></i>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="p-5 bg-white text-dark rounded-4 border border-secondary">
                    <h4 class="text-muted mb-0">Doa tidak ditemukan.</h4>
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Modal Detail Doa -->
<div class="modal fade" id="detailDoaModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-white text-dark border-0 shadow-lg" style="border-radius: 16px;">
            <div class="modal-header border-bottom" style="border-color: #E0EBE3 !important;">
                <h5 class="modal-title fw-bold" id="modalJudul" style="color: var(--islamic-green);"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Teks Arab Khas Al-Qur'an -->
                <div class="quran-arabic-text mb-4" id="modalArab"></div>
                
                <!-- Teks Latin -->
                <p class="fst-italic mb-3 fw-semibold" id="modalLatin" style="color: #198754; font-size: 1.05rem;"></p>
                
                <!-- Teks Terjemahan/Artinya -->
                <p class="text-muted mb-3" id="modalTerjemahan" style="line-height: 1.7; font-size: 0.95rem;"></p>
                
                <!-- Teks Dalil / Sumber Hadits -->
                <div class="p-3 bg-light rounded-3 border text-secondary small mb-4" style="border-color: #E0EBE3 !important;">
                    <i class="fa-solid fa-book-bookmark text-success me-1"></i> <span id="modalDalilContent"></span>
                </div>

                <!-- Tombol Aksi Modal -->
                <div class="d-flex justify-content-end gap-2 pt-3 border-top" style="border-color: #E0EBE3 !important;">
                    <button type="button" class="btn btn-outline-success btn-sm rounded-3 px-3 fw-semibold" id="btnModalSalin">
                        <i class="fa-solid fa-copy me-1"></i> Salin Teks
                    </button>
                    <button type="button" class="btn btn-success btn-sm rounded-3 px-3 fw-semibold" id="btnModalShare">
                        <i class="fa-solid fa-share-nodes me-1"></i> Bagikan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let currentDoaData = {};

    function initDoaPage() {
        const searchInput = document.querySelector('.search-input-islamic');
        const searchForm = document.querySelector('.search-box-islamic');
        const doaCards = document.querySelectorAll('.doa-wrapper');
        const pillBtns = document.querySelectorAll('.pill-btn');

        if (!searchInput) return;

        if (searchForm) {
            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
            });
        }

        let activeCategory = 'semua';

        function filterDoaList() {
            // Ubah input menjadi huruf kecil dan hilangkan spasi berlebih
            const query = searchInput.value.toLowerCase().trim();

            doaCards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');
                const titleText = card.querySelector('.doa-title-ref') ? card.querySelector('.doa-title-ref').innerText.toLowerCase() : '';
                const descText = card.querySelector('.doa-desc-ref') ? card.querySelector('.doa-desc-ref').innerText.toLowerCase() : '';

                const matchesCategory = (activeCategory === 'semua' || cardCategory === activeCategory);
                
                // Pencarian fleksibel: mendeteksi huruf besar/kecil dan kecocokan sebagian kata (substring)
                const matchesSearch = query === '' || titleText.includes(query) || descText.includes(query);

                if (matchesCategory && matchesSearch) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('input', filterDoaList);

        pillBtns.forEach(btn => {
            btn.onclick = function() {
                pillBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const onclickAttr = this.getAttribute('onclick');
                if (onclickAttr) {
                    const match = onclickAttr.match(/'([^']+)'/);
                    if (match && match[1]) {
                        activeCategory = match[1];
                        filterDoaList();
                    }
                }
            };
        });

        document.querySelectorAll('.btn-action-baca').forEach(function(button) {
            button.onclick = function() {
                const judul = this.getAttribute('data-judul') || '';
                const arab = this.getAttribute('data-arab') || '';
                const latin = this.getAttribute('data-latin') || '';
                const terjemahan = this.getAttribute('data-terjemahan') || '';
                const dalil = this.getAttribute('data-dalil') || '';

                currentDoaData = { judul, arab, latin, terjemahan, dalil };

                document.getElementById('modalJudul').innerText = judul;
                document.getElementById('modalArab').innerText = arab;
                document.getElementById('modalLatin').innerText = latin;
                document.getElementById('modalTerjemahan').innerText = terjemahan ? "Artinya: " + terjemahan : "";
                document.getElementById('modalDalilContent').innerText = "Dalil / Keterangan: " + dalil;

                const detailModal = new bootstrap.Modal(document.getElementById('detailDoaModal'));
                detailModal.show();
            };
        });

        document.querySelectorAll('.btn-action-share').forEach(function(button) {
            button.onclick = function() {
                const judul = this.getAttribute('data-judul') || '';
                const arab = this.getAttribute('data-arab') || '';
                const terjemahan = this.getAttribute('data-terjemahan') || '';
                const dalil = this.getAttribute('data-dalil') || '';
                shareDoa(judul, arab, terjemahan, dalil);
            };
        });

        const btnModalSalin = document.getElementById('btnModalSalin');
        if (btnModalSalin) {
            btnModalSalin.onclick = function() {
                copyDoaText(currentDoaData.judul, currentDoaData.arab, currentDoaData.terjemahan, currentDoaData.dalil);
            };
        }

        const btnModalShare = document.getElementById('btnModalShare');
        if (btnModalShare) {
            btnModalShare.onclick = function() {
                shareDoa(currentDoaData.judul, currentDoaData.arab, currentDoaData.terjemahan, currentDoaData.dalil);
            };
        }
    }

    document.addEventListener('DOMContentLoaded', initDoaPage);
    document.addEventListener('turbo:load', initDoaPage);

    function copyDoaText(judul, arab, terjemahan, dalil) {
        let textToCopy = `${judul}\n\n${arab}\n\nArtinya:\n"${terjemahan}"`;
        if (dalil) {
            textToCopy += `\n\nDalil / Keterangan:\n${dalil}`;
        }
        textToCopy += `\n\nDikutip dari Portal Islami`;

        navigator.clipboard.writeText(textToCopy).then(() => {
            alert('Teks doa beserta dalil berhasil disalin!');
        }).catch(err => {
            console.error('Gagal menyalin: ', err);
        });
    }

    function shareDoa(judul, arab, terjemahan, dalil) {
        let textToShare = `${judul}\n\n${arab}\n\nArtinya:\n"${terjemahan}"`;
        if (dalil) {
            textToShare += `\n\nDalil / Keterangan:\n${dalil}`;
        }
        textToShare += `\n\nDikutip dari Portal Islami`;

        if (navigator.share) {
            navigator.share({
                title: judul,
                text: textToShare,
                url: window.location.href
            }).catch(() => {});
        } else {
            copyDoaText(judul, arab, terjemahan, dalil);
        }
    }

    function filterHajat(kategori, btn) {
        document.querySelectorAll('.pill-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const searchInput = document.querySelector('.search-input-islamic');
        const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
        const cards = document.querySelectorAll('.doa-wrapper');

        cards.forEach(card => {
            const cardCategory = card.getAttribute('data-category');
            const titleText = card.querySelector('.doa-title-ref') ? card.querySelector('.doa-title-ref').innerText.toLowerCase() : '';
            const descText = card.querySelector('.doa-desc-ref') ? card.querySelector('.doa-desc-ref').innerText.toLowerCase() : '';

            const matchesCategory = (kategori === 'semua' || cardCategory === kategori);
            const matchesSearch = query === '' || titleText.includes(query) || descText.includes(query);

            if (matchesCategory && matchesSearch) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
@endsection
