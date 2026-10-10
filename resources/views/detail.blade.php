@extends('layouts.app')

@section('title', $quran['namaLatin'] ?? 'Detail Surah')

@section('content')
<!-- Import Font Amiri dari Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

<style>
    .ayat-card {
        background-color: #FFFFFF;
        border: 1px solid #E2EFE7;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 20px;
        scroll-margin-top: 90px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
        transition: all 0.2s ease;
    }
    .ayat-card:hover {
        border-color: #C8E6C9;
        box-shadow: 0 6px 20px rgba(18, 91, 66, 0.05);
    }
    .arabic-header-title {
        font-family: 'Amiri', 'Traditional Arabic', serif;
        font-size: 2.2rem;
        font-weight: 700;
        vertical-align: middle;
        margin-left: 6px;
        color: #0B4834;
    }
    .ayat-arabic {
        font-family: 'Amiri', 'Traditional Arabic', serif;
        font-size: 2.0rem;
        line-height: 2.8;
        color: #0B4834;
        text-align: right;
        direction: rtl;
        font-weight: 400;
        word-spacing: 2px;
    }
    .ayat-number {
        width: 38px;
        height: 38px;
        background-color: #E8F5E9;
        color: #0B4834;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.85rem;
        border: 1px solid #C8E6C9;
        flex-shrink: 0;
    }
    .btn-back-custom {
        background-color: #0B4834;
        color: #FFFFFF;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 8px 18px;
        border-radius: 30px;
        border: none;
        box-shadow: 0 4px 12px rgba(11, 72, 52, 0.15);
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }
    .btn-back-custom:hover {
        background-color: #125B42;
        color: #FFFFFF;
        transform: translateY(-2px);
    }
    .btn-tafsir-sm {
        background-color: #F4F8F5;
        color: #0B4834;
        border: 1px solid #C8E6C9;
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-tafsir-sm:hover {
        background-color: #0B4834;
        color: #FFFFFF;
    }
    .equran-audio-player-sm {
        background: #F4F8F5;
        border: 1px solid #D1E7DD;
        border-radius: 30px;
        padding: 4px 10px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .equran-play-btn {
        width: 30px;
        height: 30px;
        background-color: #0B4834;
        color: #FFFFFF;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 0.75rem;
    }
    .audio-dynamic-content {
        display: none;
        align-items: center;
        gap: 8px;
    }
    .audio-progress-bar {
        width: 100px;
        accent-color: #0B4834;
        height: 4px;
        cursor: pointer;
    }
    .audio-time {
        font-size: 0.7rem;
        font-weight: 600;
        color: #555;
        font-family: monospace;
    }
    .qari-select {
        border-radius: 20px;
        border: 1px solid #C8E6C9;
        background-color: #F8FAF9;
        font-size: 0.85rem;
        font-weight: 600;
        color: #0B4834;
        padding: 6px 14px;
    }
    .quran-nav-bar {
        background: #FFFFFF;
        border: 1px solid #E2EFE7;
        border-radius: 30px;
        padding: 10px 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    }
    .nav-btn {
        text-decoration: none;
        color: #333;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .nav-select {
        border-radius: 20px;
        border: 1px solid #ddd;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 6px 14px;
    }

    /* Style Modal Tafsir Ala equran.id */
    .modal-tafsir .modal-content {
        border-radius: 20px;
        border: none;
    }
    .modal-tafsir .modal-header {
        background-color: #0B4834;
        color: #FFFFFF;
        border-radius: 20px 20px 0 0;
    }
    .modal-tafsir-arab {
        background-color: #F8FAF9;
        border-radius: 12px;
        padding: 15px;
        border: 1px solid #E2EFE7;
    }
</style>

<div class="container py-4">
    <!-- Tombol Kembali -->
    <div class="mb-3">
        <a href="{{ route('quran.index') }}" class="btn-back-custom">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Surah
        </a>
    </div>

    <!-- Navigasi Surah & Ayat -->
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4 quran-nav-bar">
        @if($prevSurah)
            <a href="{{ route('quran.show', $prevSurah['nomor']) }}" class="nav-btn">
                <i class="fa-solid fa-chevron-left"></i> <span class="d-none d-sm-inline">{{ $prevSurah['namaLatin'] }}</span>
            </a>
        @else
            <span class="text-muted small"><i class="fa-solid fa-chevron-left"></i> Awal</span>
        @endif

        <div class="d-flex gap-2 flex-grow-1 justify-content-center">
            <select class="form-select nav-select" onchange="window.location.href = this.value">
                @foreach($allSurah as $s)
                    <option value="{{ route('quran.show', $s['nomor']) }}" {{ $s['nomor'] ==$quran['nomor'] ? 'selected' : '' }}>
                        {{ $s['nomor'] }}. {{$s['namaLatin'] }}
                    </option>
                @endforeach
            </select>

            <select class="form-select nav-select" id="ayatSelect" onchange="scrollToAyat(this.value)">
                <option value="">Pilih Ayat</option>
                @if(isset($quran['ayat']) && is_array($quran['ayat']))
                    @foreach($quran['ayat'] as $item)
                        <option value="ayat-{{ $item['nomorAyat'] }}">Ayat {{ $item['nomorAyat'] }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        @if($nextSurah)
            <a href="{{ route('quran.show', $nextSurah['nomor']) }}" class="nav-btn">
                <span class="d-none d-sm-inline">{{ $nextSurah['namaLatin'] }}</span> <i class="fa-solid fa-chevron-right"></i>
            </a>
        @else
            <span class="text-muted small">Akhir <i class="fa-solid fa-chevron-right"></i></span>
        @endif
    </div>

    <!-- Header Detail Surah -->
    <div class="card p-4 text-center mb-4 border-0 shadow-sm rounded-4" id="surahContainer" data-surah-nomor="{{ $quran['nomor'] }}" style="background-color: #FFFFFF;">
        <span class="badge bg-success bg-opacity-10 text-success fw-bold px-3 py-2 rounded-pill mx-auto mb-2" style="width: fit-content; font-size: 0.75rem;">
            SURAH KE-{{ $quran['nomor'] }} • {{ strtoupper($quran['tempatTurun'] ?? 'MEKAH') }}
        </span>
        
        <h2 class="fw-bold my-2" style="color: #0F5132;">
            {{ $quran['namaLatin'] }} <span class="arabic-header-title">({{ $quran['nama'] }})</span>
        </h2>
        
        <p class="text-muted small mb-2">{{ $quran['arti'] }} • {{$quran['jumlahAyat'] }} Ayat</p>
        
        <!-- Pilihan Qari & Tombol Play Full Audio / Deskripsi -->
        <div class="d-flex flex-column align-items-center gap-2 mt-2">
            <div class="d-flex align-items-center justify-content-center gap-2 flex-wrap mb-1">
                <i class="fa-solid fa-user-gear text-success small"></i>
                <span class="small fw-semibold text-secondary">Pilih Qari:</span>
                <select id="qariSelector" class="form-select qari-select w-auto">
                    <option value="05" selected>Misyari Rasyid Al-Afasy</option>
                    <option value="01">Abdullah Al-Juhany</option>
                    <option value="02">Abdul Muhsin Al-Qasim</option>
                    <option value="03">Abdurrahman As-Sudais</option>
                    <option value="04">Ibrahim Al-Dossari</option>
                    <option value="06">Yasser Al-Dosari</option>
                </select>
            </div>

            <div class="d-flex gap-2 flex-wrap justify-content-center mt-1">
                @if(!empty($quran['audioFull']))
                    <button class="btn btn-outline-success rounded-pill px-4 py-2 fw-semibold" 
                            data-nomor="{{ $quran['nomor'] }}"
                            data-nama="{{ $quran['namaLatin'] }}"
                            data-audio='@json($quran['audioFull'])'
                            onclick="triggerGlobalAudio(this)">
                        <i class="fa-solid fa-play me-1"></i> Play Audio Full
                    </button>
                @endif

                @if(!empty($quran['deskripsi']))
                    <button class="btn btn-success rounded-pill px-4 py-2 fw-semibold" 
                            type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#deskripsiSurahCollapse" 
                            aria-expanded="false">
                        <i class="fa-solid fa-circle-info me-1"></i> Pengantar Surah
                    </button>
                @endif
            </div>

            <!-- Box Collapse Pengantar / Deskripsi Surah -->
            @if(!empty($quran['deskripsi']))
                <div class="collapse w-100 mt-3 text-start" id="deskripsiSurahCollapse">
                    <div class="p-3 rounded-3" style="background-color: #F8FAF9; border-left: 4px solid #0B4834;">
                        <h6 class="fw-bold text-success mb-2">
                            <i class="fa-solid fa-book-open me-1"></i> Tentang Surah {{ $quran['namaLatin'] }}
                        </h6>
                        <div class="text-secondary small" style="line-height: 1.8; text-align: justify;">
                            {!! $quran['deskripsi'] !!}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Daftar Ayat -->
    @if(isset($quran['ayat']) && is_array($quran['ayat']))
        @foreach($quran['ayat'] as $item)
            <div class="ayat-card" id="ayat-{{ $item['nomorAyat'] }}">
                <div class="d-flex justify-content-between align-items-center mb-3 gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="ayat-number">{{ $item['nomorAyat'] }}</div>
                        
                        <!-- Tombol Buka Modal Tafsir -->
                        <button class="btn btn-tafsir-sm" type="button" data-bs-toggle="modal" data-bs-target="#modalTafsir-{{ $item['nomorAyat'] }}">
                            <i class="fa-solid fa-book-open"></i> Tafsir
                        </button>
                    </div>

                    @if(!empty($item['audio']))
                        @php
                            $audioId = "audio-ayat-" . $item['nomorAyat'];
                        @endphp
                        <div class="equran-audio-player-sm" id="wrapper-{{ $audioId }}">
                            <button class="equran-play-btn" onclick="toggleAudio('{{ $audioId }}', this)">
                                <i class="fa-solid fa-play"></i>
                            </button>
                            
                            <div class="audio-dynamic-content" id="dynamic-{{ $audioId }}">
                                <input type="range" class="audio-progress-bar" id="progress-{{ $audioId }}" value="0" min="0" max="100" oninput="seekAudio('{{ $audioId }}', this.value)">
                                <span class="audio-time" id="time-{{ $audioId }}">00:00</span>
                            </div>

                            <audio id="{{ $audioId }}" 
                                   class="ayat-audio-element" 
                                   data-audio-ayat='@json($item['audio'])' 
                                   src="{{ $item['audio']['05'] ?? '' }}" 
                                   preload="metadata"
                                   onloadedmetadata="initAudioTime('{{ $audioId }}')"
                                   ontimeupdate="updateAudioProgress('{{ $audioId }}')"></audio>
                        </div>
                    @endif
                </div>

                <div class="ayat-arabic my-3">{{ $item['teksArab'] }}</div>
                <p class="text-muted fst-italic mb-2" style="font-size: 0.9rem;">{{ $item['teksLatin'] }}</p>
                <p class="mb-0 text-dark" style="font-size: 0.95rem; line-height: 1.6;">{{ $item['teksIndonesia'] }}</p>
            </div>

            <!-- MODAL TAFSIR PER AYAT -->
<div class="modal fade modal-tafsir" id="modalTafsir-{{ $item['nomorAyat'] }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center justify-content-between">
                <h5 class="modal-title fw-bold fs-6">
                    <i class="fa-solid fa-book-bookmark me-2"></i>Tafsir {{ $quran['namaLatin'] }} Ayat {{ $item['nomorAyat'] }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Teks Arab Ayat di Modal -->
                <div class="modal-tafsir-arab text-end mb-3">
                    <div class="ayat-arabic fs-3 mb-0">{{ $item['teksArab'] }}</div>
                </div>
                <!-- Isi Tafsir dari API equran.id -->
                <h6 class="fw-bold text-success mb-2"><i class="fa-solid fa-align-left me-1"></i> Penjelasan Tafsir:</h6>
                <p class="text-secondary" style="line-height: 1.8; text-align: justify; font-size: 0.95rem; white-space: pre-line;">
                    {{ $item['tafsir_teks'] ?? $item['tafsir']['kemenag']['long'] ?? $item['tafsir']['kemenag']['short'] ?? 'Tafsir untuk ayat ini belum tersedia.' }}
                </p>
            </div>
        </div>
    </div>
</div>
        @endforeach
    @endif
</div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById('surahContainer');
    if (container) {
        const currentSurahNomor = container.dataset.surahNomor;
        localStorage.setItem('eq_audio_nomor', currentSurahNomor);

        const savedPlaying = localStorage.getItem('eq_audio_playing');
        if (savedPlaying === 'true') {
            const playFullBtn = document.querySelector('button[data-audio]');
            if (playFullBtn) {
                const nomor = playFullBtn.dataset.nomor;
                const nama = playFullBtn.dataset.nama;
                const audioUrls = JSON.parse(playFullBtn.dataset.audio);
                const qariKey = document.getElementById('qariSelector') ? document.getElementById('qariSelector').value : '05';

                if (typeof playGlobalFullAudio === 'function') {
                    setTimeout(() => {
                        playGlobalFullAudio(nomor, nama, audioUrls, qariKey);
                    }, 300);
                }
            }
        }
    }
});

function scrollToAyat(elementId) {
    if (!elementId) return;
    const targetElement = document.getElementById(elementId);
    if (targetElement) {
        targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
        targetElement.style.transition = 'background-color 0.4s ease';
        targetElement.style.backgroundColor = '#E8F5E9';
        setTimeout(() => { targetElement.style.backgroundColor = '#FFFFFF'; }, 1200);
    }
}

function formatTime(seconds) {
    if (isNaN(seconds)) return "00:00";
    const mins = Math.floor(seconds / 60);
    const secs = Math.floor(seconds % 60);
    return `${mins < 10 ? '0' : ''}${mins}:${secs < 10 ? '0' : ''}${secs}`;
}

function triggerGlobalAudio(btn) {
    const nomor = btn.dataset.nomor;
    const nama = btn.dataset.nama;
    const audioUrls = JSON.parse(btn.dataset.audio);
    const qariKey = document.getElementById('qariSelector').value;

    if (typeof playGlobalFullAudio === 'function') {
        playGlobalFullAudio(nomor, nama, audioUrls, qariKey);
    }
}

function initAudioTime(audioId) {
    const audio = document.getElementById(audioId);
    const timeDisplay = document.getElementById('time-' + audioId);
    if (audio && timeDisplay) {
        timeDisplay.innerText = formatTime(audio.duration);
    }
}

function updateAudioProgress(audioId) {
    const audio = document.getElementById(audioId);
    const progressBar = document.getElementById('progress-' + audioId);
    const timeDisplay = document.getElementById('time-' + audioId);

    if (audio && progressBar) {
        const percentage = (audio.currentTime / audio.duration) * 100;
        progressBar.value = percentage || 0;
        if (timeDisplay) {
            timeDisplay.innerText = formatTime(audio.currentTime);
        }
    }
}

function seekAudio(audioId, value) {
    const audio = document.getElementById(audioId);
    if (audio && audio.duration) {
        audio.currentTime = (value / 100) * audio.duration;
    }
}

function toggleAudio(audioId, btnElement) {
    if (typeof globalFullAudio !== 'undefined') {
        globalFullAudio.pause();
        document.getElementById('floatingAudioBar').style.display = 'none';
    }

    const audioElement = document.getElementById(audioId);
    const icon = btnElement.querySelector('i');
    const dynamicContent = document.getElementById('dynamic-' + audioId);

    document.querySelectorAll('.ayat-audio-element').forEach(aud => {
        if (aud.id !== audioId) {
            aud.pause();
            const otherBtn = document.querySelector(`button[onclick*="${aud.id}"] i`);
            if (otherBtn) otherBtn.className = 'fa-solid fa-play';
            const otherDynamic = document.getElementById('dynamic-' + aud.id);
            if (otherDynamic) otherDynamic.style.display = 'none';
        }
    });

    if (audioElement.paused) {
        audioElement.play();
        icon.className = 'fa-solid fa-pause';
        if (dynamicContent) dynamicContent.style.display = 'flex';

        audioElement.onended = function() {
            icon.className = 'fa-solid fa-play';
            if (dynamicContent) dynamicContent.style.display = 'none';
            const progressBar = document.getElementById('progress-' + audioId);
            if (progressBar) progressBar.value = 0;
        };
    } else {
        audioElement.pause();
        icon.className = 'fa-solid fa-play';
        if (dynamicContent) dynamicContent.style.display = 'none';
    }
}
</script>
@endsection