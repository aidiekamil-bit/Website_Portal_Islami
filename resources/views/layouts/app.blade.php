<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Islami')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --islamic-green: #0F5132;
            --islamic-emerald: #198754;
            --islamic-gold: #D4AF37;
            --soft-green-bg: #F8FAF8;
            --card-border: #E0EBE3;
            --text-dark: #1A3323;
        }

        body {
            background-color: var(--soft-green-bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar-islamic {
            background-color: #FFFFFF;
            border-bottom: 1px solid var(--card-border);
            padding: 12px 0;
            box-shadow: 0 2px 10px rgba(15, 81, 50, 0.04);
        }

        .brand-logo-icon {
            width: 42px;
            height: 42px;
            background-color: var(--islamic-green);
            color: var(--islamic-gold);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .brand-title {
            font-weight: 700;
            font-size: 1.3rem;
            color: var(--islamic-green);
            line-height: 1.1;
        }

        .brand-subtitle {
            font-size: 0.65rem;
            letter-spacing: 1.5px;
            color: var(--islamic-emerald);
            font-weight: 700;
        }

        .nav-link-islamic {
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.95rem;
            padding: 8px 16px !important;
            border-radius: 20px;
            transition: all 0.2s ease;
        }

        .nav-link-islamic:hover, .nav-link-islamic.active {
            color: var(--islamic-green) !important;
            background-color: #E8F3EC;
        }

        main { flex: 1; }

        .footer-islamic {
            background-color: var(--islamic-green);
            color: #FFFFFF;
            padding: 20px 0;
            margin-top: auto;
            border-top: 3px solid var(--islamic-gold);
        }

        /* FLOATING AUDIO PLAYER GLOBAL */
        .floating-audio-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #11261D;
            color: #FFFFFF;
            padding: 12px 24px;
            box-shadow: 0 -6px 25px rgba(0, 0, 0, 0.3);
            z-index: 1050;
            display: none;
            flex-direction: column;
            gap: 8px;
            border-top: 2px solid var(--islamic-gold);
            animation: slideUp 0.3s ease-out;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes slideUp {
            from { transform: translateY(100%); }
            to { transform: translateY(0); }
        }

        .floating-controls {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .floating-btn {
            background: transparent;
            border: none;
            color: #FFFFFF;
            font-size: 1.2rem;
            cursor: pointer;
            transition: color 0.2s, transform 0.1s;
        }

        .floating-btn:hover {
            color: var(--islamic-gold);
            transform: scale(1.1);
        }

        .floating-main-play {
            width: 42px;
            height: 42px;
            background-color: #198754;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.4);
        }

        .floating-main-play:hover {
            background-color: #218838;
            color: #FFFFFF;
        }

        .floating-range {
            flex-grow: 1;
            accent-color: #198754;
            height: 5px;
            cursor: pointer;
        }

        /* KETIKA MINIMIZED (Dilipat) */
        .floating-audio-bar.minimized {
            padding: 6px 20px;
            background: #11261D;
            width: 100%;
            max-width: 100%;
            left: 0;
            right: 0;
            bottom: 0;
            transform: none;
            border-radius: 0;
            border-top: 2px solid var(--islamic-gold);
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.3);
        }

        .floating-audio-bar.minimized .floating-main-row {
            display: none !important;
        }

        .floating-audio-bar.minimized .floating-progress-row {
            margin-top: 0;
            gap: 15px;
            justify-content: space-between;
        }

        .floating-audio-bar.minimized .audio-time {
            display: inline-block;
            font-size: 0.75rem;
        }

        .floating-audio-bar.minimized .floating-range {
            flex-grow: 1;
            max-width: none;
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-islamic sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-3" href="{{ url('/') }}">
                <div class="brand-logo-icon"><i class="fa-solid fa-mosque"></i></div>
                <div>
                    <div class="brand-title">Portal Islami</div>
                    <div class="brand-subtitle">AL-QUR'AN & JADWAL SHOLAT</div>
                </div>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-2 mt-3 mt-lg-0">
                    <!-- Navigasi Beranda -->
                    <li class="nav-item">
                        <a class="nav-link nav-link-islamic {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                            <i class="fa-solid fa-house me-1" style="color: var(--islamic-gold);"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-islamic {{ Request::routeIs('quran.*') ? 'active' : '' }}" href="{{ route('quran.index') }}">
                            <i class="fa-solid fa-book-quran me-1" style="color: var(--islamic-gold);"></i> Al-Qur'an
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-islamic {{ Request::routeIs('doa.*') ? 'active' : '' }}" href="{{ route('doa.index') }}">
                            <i class="fa-solid fa-hands-praying me-1" style="color: var(--islamic-gold);"></i> Doa Harian
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-islamic {{ Request::routeIs('jadwal.*') ? 'active' : '' }}" href="{{ route('jadwal.index') }}">
                            <i class="fa-solid fa-clock me-1" style="color: var(--islamic-gold);"></i> Jadwal Sholat
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-islamic text-center">
        <div class="container">
            <p class="mb-0 small">&copy; {{ date('Y') }} Portal Islami. Created by M.Aidiel Kamil</p>
        </div>
    </footer>

    <!-- Floating Audio Bar -->
    <div class="floating-audio-bar" id="floatingAudioBar">
        <!-- Baris 1: Kontrol Utama -->
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 floating-main-row">
            <div class="d-flex align-items-center gap-2">
                <div class="bg-success text-white rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                    <i class="fa-solid fa-headphones"></i>
                </div>
                <div>
                    <h6 class="mb-0 fw-bold text-truncate text-white" id="floatSurahTitle" style="max-width: 180px;">Surah</h6>
                    <small class="text-white-50" style="font-size: 0.75rem;">Full Surah Audio</small>
                </div>
            </div>

            <div class="floating-controls">
                <button class="floating-btn" onclick="globalPrevSurah()" title="Surah Sebelumnya"><i class="fa-solid fa-backward-step"></i></button>
                <button class="floating-btn" onclick="skipFloatingAudio(-5)" title="Mundur 5 Detik"><i class="fa-solid fa-rotate-left"></i></button>
                
                <button class="floating-btn floating-main-play" id="floatingPlayBtn" onclick="toggleGlobalFullAudio()">
                    <i class="fa-solid fa-play" id="floatingPlayIcon"></i>
                </button>
                
                <button class="floating-btn" onclick="skipFloatingAudio(5)" title="Maju 5 Detik"><i class="fa-solid fa-rotate-right"></i></button>
                <button class="floating-btn" onclick="globalNextSurah()" title="Surah Selanjutnya"><i class="fa-solid fa-forward-step"></i></button>
                <button class="floating-btn" onclick="globalToggleMute()" id="globalMuteBtn" title="Volume"><i class="fa-solid fa-volume-high"></i></button>
            </div>

            <div class="d-flex align-items-center gap-2">
                <button class="floating-btn text-white-50 fs-5" onclick="closeFloatingPlayer()" title="Tutup Player"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>

        <!-- Baris 2: Progress Bar & Tombol Minimize/Maximize -->
        <div class="d-flex align-items-center gap-2 w-100 px-1 floating-progress-row">
            <span class="audio-time text-white-50 font-monospace small" id="floatCurrentTime">00:00</span>
            <input type="range" class="floating-range" id="floatingRange" value="0" min="0" max="100" oninput="seekFloatingAudio(this.value)">
            <span class="audio-time text-white-50 font-monospace small" id="floatDuration">00:00</span>
            
            <button class="floating-btn text-white-50 fs-6 ms-auto" onclick="toggleMinimizePlayer()" title="Lipat / Perbesar">
                <i class="fa-solid fa-chevron-down" id="minimizeIcon"></i>
            </button>
        </div>
    </div>

    <!-- Elemen Audio Global -->
    <audio id="globalFullAudio" 
           onloadedmetadata="initFloatingTime(); restoreAudioProgress();" 
           ontimeupdate="updateFloatingProgress(); saveAudioProgress();" 
           onended="onFloatingEnded()"></audio>

    <!-- Global Audio Script -->
    <script>
        const globalFullAudio = document.getElementById('globalFullAudio');
        const floatingBar = document.getElementById('floatingAudioBar');
        const floatingPlayIcon = document.getElementById('floatingPlayIcon');
        const floatCurrentTime = document.getElementById('floatCurrentTime');
        const floatDuration = document.getElementById('floatDuration');
        const floatingRange = document.getElementById('floatingRange');
        const floatSurahTitle = document.getElementById('floatSurahTitle');

        let currentSurahNomor = null;

        function initAudioPlayerState() {
            const savedSrc = localStorage.getItem('eq_audio_src');
            const savedTime = localStorage.getItem('eq_audio_time');
            const savedTitle = localStorage.getItem('eq_audio_title');
            const savedNomor = localStorage.getItem('eq_audio_nomor');
            const savedPlaying = localStorage.getItem('eq_audio_playing');

            const bar = document.getElementById('floatingAudioBar');
            const titleEl = document.getElementById('floatSurahTitle');
            const playIconEl = document.getElementById('floatingPlayIcon');

            if (savedSrc) {
                if (globalFullAudio.src !== savedSrc) {
                    globalFullAudio.src = savedSrc;
                }
                if (titleEl) titleEl.innerText = savedTitle || 'Surah';
                currentSurahNomor = savedNomor ? parseInt(savedNomor) : null;
                
                if (bar) {
                    bar.style.display = 'flex';
                }

                if (savedTime && !isNaN(savedTime) && Math.abs(globalFullAudio.currentTime - parseFloat(savedTime)) > 1) {
                    globalFullAudio.currentTime = parseFloat(savedTime);
                }

                if (savedPlaying === 'true') {
                    globalFullAudio.play().then(() => {
                        if (playIconEl) playIconEl.className = 'fa-solid fa-pause';
                    }).catch(e => console.log("Autoplay prevented:", e));
                }
            } else {
                if (bar) bar.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', initAudioPlayerState);
        document.addEventListener('turbo:load', initAudioPlayerState);

        function formatTime(seconds) {
            if (isNaN(seconds)) return "00:00";
            const mins = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${mins < 10 ? '0' : ''}${mins}:${secs < 10 ? '0' : ''}${secs}`;
        }

        function playGlobalFullAudio(nomor, nama, audioUrls, qariKey) {
            currentSurahNomor = parseInt(nomor);
            const audioSrc = audioUrls[qariKey] || audioUrls['05'];

            document.querySelectorAll('.ayat-audio-element').forEach(aud => aud.pause());

            globalFullAudio.src = audioSrc;
            globalFullAudio.currentTime = 0;
            floatSurahTitle.innerText = nama;
            globalFullAudio.play();

            floatingBar.style.display = 'flex';
            floatingPlayIcon.className = 'fa-solid fa-pause';

            localStorage.setItem('eq_audio_src', audioSrc);
            localStorage.setItem('eq_audio_title', nama);
            localStorage.setItem('eq_audio_nomor', currentSurahNomor);
            localStorage.setItem('eq_audio_urls', JSON.stringify(audioUrls));
            localStorage.setItem('eq_audio_playing', 'true');
        }

        function toggleGlobalFullAudio() {
            if (globalFullAudio.paused) {
                globalFullAudio.play();
                floatingPlayIcon.className = 'fa-solid fa-pause';
                localStorage.setItem('eq_audio_playing', 'true');
            } else {
                globalFullAudio.pause();
                floatingPlayIcon.className = 'fa-solid fa-play';
                localStorage.setItem('eq_audio_playing', 'false');
            }
        }

        function initFloatingTime() {
            if (floatDuration) {
                floatDuration.innerText = formatTime(globalFullAudio.duration);
            }
        }

        function updateFloatingProgress() {
            if (globalFullAudio && floatingRange && globalFullAudio.duration) {
                const percentage = (globalFullAudio.currentTime / globalFullAudio.duration) * 100;
                floatingRange.value = percentage || 0;
                if (floatCurrentTime) {
                    floatCurrentTime.innerText = formatTime(globalFullAudio.currentTime);
                }
                localStorage.setItem('eq_audio_time', globalFullAudio.currentTime);
            }
        }

        function seekFloatingAudio(value) {
            if (globalFullAudio && globalFullAudio.duration) {
                globalFullAudio.currentTime = (value / 100) * globalFullAudio.duration;
            }
        }

        function skipFloatingAudio(seconds) {
            if (globalFullAudio) {
                globalFullAudio.currentTime = Math.min(Math.max(globalFullAudio.currentTime + seconds, 0), globalFullAudio.duration);
            }
        }

        function globalToggleMute() {
            globalFullAudio.muted = !globalFullAudio.muted;
            const muteBtn = document.getElementById('globalMuteBtn');
            muteBtn.innerHTML = globalFullAudio.muted ? '<i class="fa-solid fa-volume-xmark text-danger"></i>' : '<i class="fa-solid fa-volume-high"></i>';
        }

        function closeFloatingPlayer() {
            globalFullAudio.pause();
            globalFullAudio.currentTime = 0;
            floatingBar.style.display = 'none';
            floatingPlayIcon.className = 'fa-solid fa-play';
            localStorage.clear();
        }

        function onFloatingEnded() {
            floatingPlayIcon.className = 'fa-solid fa-play';
            localStorage.setItem('eq_audio_playing', 'false');
            globalNextSurah();
        }

        async function globalNextSurah() {
            let activeNomor = currentSurahNomor || parseInt(localStorage.getItem('eq_audio_nomor')) || 1;
            
            if (activeNomor < 114) {
                let nextNomor = activeNomor + 1;
                currentSurahNomor = nextNomor;
                localStorage.setItem('eq_audio_nomor', nextNomor);

                try {
                    let response = await fetch(`https://equran.id/api/v2/surat/${nextNomor}`);
                    let json = await response.json();
                    
                    if (json.code === 200 && json.data) {
                        let surahData = json.data;
                        let audioUrls = surahData.audioFull;
                        let qariKey = document.getElementById('qariSelector') ? document.getElementById('qariSelector').value : '05';
                        let audioSrc = audioUrls[qariKey] || audioUrls['05'];
                        
                        globalFullAudio.src = audioSrc;
                        globalFullAudio.currentTime = 0;
                        globalFullAudio.play();
                        
                        floatSurahTitle.innerText = surahData.namaLatin;
                        floatingBar.style.display = 'flex';
                        floatingPlayIcon.className = 'fa-solid fa-pause';
                        
                        localStorage.setItem('eq_audio_src', audioSrc);
                        localStorage.setItem('eq_audio_title', surahData.namaLatin);
                        localStorage.setItem('eq_audio_urls', JSON.stringify(audioUrls));
                        localStorage.setItem('eq_audio_playing', 'true');
                    }
                } catch (error) {
                    console.error("Gagal memuat surah berikutnya:", error);
                }
            } else {
                alert("Ini adalah surah terakhir (Surah Al-Nas).");
            }
        }

        async function globalPrevSurah() {
            let activeNomor = currentSurahNomor || parseInt(localStorage.getItem('eq_audio_nomor')) || 1;
            
            if (activeNomor > 1) {
                let prevNomor = activeNomor - 1;
                currentSurahNomor = prevNomor;
                localStorage.setItem('eq_audio_nomor', prevNomor);

                try {
                    let response = await fetch(`https://equran.id/api/v2/surat/${prevNomor}`);
                    let json = await response.json();
                    
                    if (json.code === 200 && json.data) {
                        let surahData = json.data;
                        let audioUrls = surahData.audioFull;
                        let qariKey = document.getElementById('qariSelector') ? document.getElementById('qariSelector').value : '05';
                        let audioSrc = audioUrls[qariKey] || audioUrls['05'];
                        
                        globalFullAudio.src = audioSrc;
                        globalFullAudio.currentTime = 0;
                        globalFullAudio.play();
                        
                        floatSurahTitle.innerText = surahData.namaLatin;
                        floatingBar.style.display = 'flex';
                        floatingPlayIcon.className = 'fa-solid fa-pause';
                        
                        localStorage.setItem('eq_audio_src', audioSrc);
                        localStorage.setItem('eq_audio_title', surahData.namaLatin);
                        localStorage.setItem('eq_audio_urls', JSON.stringify(audioUrls));
                        localStorage.setItem('eq_audio_playing', 'true');
                    }
                } catch (error) {
                    console.error("Gagal memuat surah sebelumnya:", error);
                }
            } else {
                alert("Ini adalah surah pertama (Surah Al-Fatihah).");
            }
        }

        let isMinimized = false;
        function toggleMinimizePlayer() {
            const floatingBar = document.getElementById('floatingAudioBar');
            const minimizeIcon = document.getElementById('minimizeIcon');
            isMinimized = !isMinimized;
            
            if (isMinimized) {
                floatingBar.classList.add('minimized');
                minimizeIcon.className = 'fa-solid fa-expand';
            } else {
                floatingBar.classList.remove('minimized');
                minimizeIcon.className = 'fa-solid fa-chevron-down';
            }
        }

        function saveAudioProgress() {
            if (globalFullAudio && !isNaN(globalFullAudio.currentTime)) {
                localStorage.setItem('eq_audio_time', globalFullAudio.currentTime);
            }
        }

        function restoreAudioProgress() {
            const savedTime = localStorage.getItem('eq_audio_time');
            if (savedTime && !isNaN(globalFullAudio.duration)) {
                globalFullAudio.currentTime = parseFloat(savedTime);
            }
        }
    </script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>