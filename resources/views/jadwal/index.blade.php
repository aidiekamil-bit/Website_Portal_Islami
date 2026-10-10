@extends('layouts.app')

@section('title', 'Jadwal Sholat Hari Ini & Bulanan')

@section('content')
<style>
    :root {
        --dark-green-bg: #0B4834;
        --card-green-bg: #135D45;
        --text-gold: #E5C158;
        --soft-bg: #F4F9F5;
        --border-color: #E2EFE7;
    }

    .hero-section {
        background-color: var(--dark-green-bg);
        color: #FFFFFF;
        padding: 30px 0 50px 0;
        border-radius: 0 0 24px 24px;
    }

    .hero-title {
        font-weight: 700;
        font-size: 1.8rem;
    }

    .countdown-card {
        background-color: var(--card-green-bg);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 16px;
        padding: 18px 20px;
    }

    .custom-card {
        background: #FFFFFF;
        border-radius: 16px;
        border: 1px solid var(--border-color);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
    }

    .table-custom thead {
        background-color: var(--dark-green-bg);
        color: #FFFFFF;
    }

    .table-custom th, .table-custom td {
        padding: 12px 10px;
        vertical-align: middle;
        white-space: nowrap;
    }

    .today-highlight {
        background-color: #E8F5E9 !important;
        font-weight: bold;
    }

    .empty-box {
        border: 2px dashed rgba(11, 72, 52, 0.3);
        border-radius: 20px;
        background-color: var(--soft-bg);
        padding: 50px 20px;
        text-align: center;
    }

    /* Styling Efek Highlight Waktu Sholat */
    .prayer-time-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }

    /* 🟢 HIGHLIGHT: Sholat yang Sedang Berlangsung */
    .prayer-ongoing {
        background-color: #E8F5E9 !important;
        border-color: #198754 !important;
        box-shadow: 0 4px 12px rgba(25, 135, 84, 0.15);
        transform: translateY(-2px);
    }
    .prayer-ongoing .badge-status {
        background-color: #198754;
        color: #FFFFFF;
    }

    /* 🟡 HIGHLIGHT: Sholat Berikutnya (Segera Masuk / Dimulai) */
    .prayer-next-highlight {
        background-color: #FFF9E6 !important;
        border-color: #D4AF37 !important;
        box-shadow: 0 6px 18px rgba(212, 175, 55, 0.25);
        transform: translateY(-4px);
        animation: pulseBorder 2s infinite;
    }
    .prayer-next-highlight .badge-status {
        background-color: #D4AF37;
        color: #0B4834;
    }

    /* Badge Teks Status Keterangan */
    .badge-status {
        font-size: 0.65rem;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 12px;
        display: inline-block;
        margin-top: 4px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    /* Animasi Denyut Emas untuk Sholat Berikutnya */
    @keyframes pulseBorder {
        0% { box-shadow: 0 0 0 0 rgba(212, 175, 55, 0.4); }
        70% { box-shadow: 0 0 0 8px rgba(212, 175, 55, 0); }
        100% { box-shadow: 0 0 0 0 rgba(212, 175, 55, 0); }
    }
</style>

<!-- HERO SECTION -->
<div class="hero-section">
    <div class="container px-3">
        <p class="text-white-50 mb-1 small">
            Lokasi saat ini: <span class="text-white fw-semibold">{{ !empty($kabkota) ? $kabkota . ', ' .$selectedProvinsi : 'Belum Dipilih' }}</span>
        </p>
        <p class="text-white-50 small mb-2">
            <i class="fa-regular fa-calendar me-1"></i> {{ date('l, d F Y') }}
        </p>

        <h1 class="hero-title mb-2">Jadwal Sholat Hari Ini</h1>
        <p class="text-white-50 small mb-3">
            <i class="fa-solid fa-location-dot me-1" style="color: var(--text-gold);"></i> 
            {{ !empty($kabkota) ? $kabkota . ', ' .$selectedProvinsi : 'Silakan pilih provinsi dan kabupaten/kota untuk melihat jadwal sholat.' }}
        </p>

        @if(!empty($jadwalHariIni))
        <div class="countdown-card"
             id="countdown-data"
             data-imsak="{{ $jadwalHariIni['imsak'] ?? '04:15' }}"
             data-subuh="{{ $jadwalHariIni['subuh'] ?? '04:25' }}"
             data-dzuhur="{{ $jadwalHariIni['dzuhur'] ?? '11:45' }}"
             data-ashar="{{ $jadwalHariIni['ashar'] ?? '15:00' }}"
             data-maghrib="{{ $jadwalHariIni['maghrib'] ?? '17:50' }}"
             data-isya="{{ $jadwalHariIni['isya'] ?? '19:00' }}">
            <p class="waktu-sholat-next text-white-50 small mb-1">Menuju Waktu Sholat Berikutnya</p>

            <div class="d-flex justify-content-between align-items-center">
                <h3 id="judul-next-sholat" class="waktu-sholat-next text-white fw-bold mb-0 fs-4">Menghitung...</h3>
                <div id="timer-countdown" class="timer-countdown fw-bold fs-3" style="color: var(--text-gold);">
                    - 00 : 00 : 00
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- CONTENT SECTION -->
<div class="container px-3 py-3" style="margin-top: -25px;">

    <!-- FILTER LOKASI & PERIODE -->
    <div class="custom-card p-4 mb-4">
        <h6 class="fw-bold mb-3" style="color: var(--dark-green-bg);">
            <i class="fa-solid fa-sliders me-1"></i> Filter Lokasi & Periode
        </h6>
        <form action="{{ route('jadwal.index') }}" method="GET" class="row g-2 g-md-3 align-items-end">
            <div class="col-12 col-md-3">
                <label class="form-label small fw-semibold text-secondary mb-1">Provinsi</label>
                <select name="provinsi" id="select-provinsi" class="form-select form-select-sm rounded-3 py-2" required>
                    <option value="">-- Pilih Provinsi --</option>
                    @if(!empty($daftarProvinsi))
                        @foreach($daftarProvinsi as $prov)
                            <option value="{{ $prov }}" {{ ($selectedProvinsi ?? '') == $prov ? 'selected' : '' }}>
                                {{ $prov }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="col-12 col-md-3">
                <label class="form-label small fw-semibold text-secondary mb-1">Kabupaten / Kota</label>
                <select name="kabkota" id="select-kabkota" class="form-select form-select-sm rounded-3 py-2" required>
                    <option value="">-- Pilih Kabupaten/Kota --</option>
                    @if(!empty($daftarKota))
                        @foreach($daftarKota as $item)
                            @php 
                                $namaKota = is_array($item) ? ($item['kabkota'] ?? reset($item)) :$item; 
                            @endphp
                            <option value="{{ $namaKota }}" {{ ($kabkota ?? '') == $namaKota ? 'selected' : '' }}>
                                {{ $namaKota }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="col-6 col-md-2">
                <label class="form-label small fw-semibold text-secondary mb-1">Bulan</label>
                <select name="bulan" class="form-select form-select-sm rounded-3 py-2">
                    @for($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ ((int)($bulan ?? date('n'))) == $m ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="col-6 col-md-2">
                <label class="form-label small fw-semibold text-secondary mb-1">Tahun</label>
                <input type="number" name="tahun" class="form-control form-control-sm rounded-3 py-2" value="{{ $tahun ?? date('Y') }}">
            </div>

            <div class="col-12 col-md-2 mt-3 mt-md-0">
                <button type="submit" class="btn text-white w-100 rounded-3 py-2 btn-sm fw-semibold" style="background-color: var(--dark-green-bg);">
                    <i class="fa-solid fa-magnifying-glass me-1"></i> Tampilkan
                </button>
            </div>
        </form>
    </div>

    <!-- TAMPILAN KETIKA BELUM MEMILIH LOKASI -->
    @if(empty($kabkota))
    <div class="empty-box my-4">
        <div class="mb-3" style="color: var(--dark-green-bg); font-size: 2.5rem;">
            <i class="fa-regular fa-clock"></i>
        </div>
        <h5 class="fw-bold" style="color: var(--dark-green-bg);">Pilih Lokasi Anda</h5>
        <p class="text-muted small mb-0">Pilih provinsi dan kabupaten/kota di atas untuk melihat jadwal sholat bulanan dan harian.</p>
    </div>
    @endif

    <!-- CARD RINCIAN HARI INI -->
    @if(!empty($jadwalHariIni))
    <div class="custom-card p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
           <h6 class="fw-bold mb-0" style="color: var(--dark-green-bg);">
    <i class="fa-solid fa-clock me-1"></i> Rincian Waktu Hari Ini ({{ date('d F Y') }})
</h6>
            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 small fw-semibold">
                {{ $kabkota }}
            </span>
        </div>

        <div class="row g-2 text-center">
            <!-- IMSAK -->
            <div class="col-4 col-md-2">
                <div class="p-2 p-md-3 rounded-3 bg-light prayer-time-card" id="card-imsak">
                    <small class="text-muted d-block mb-1" style="font-size: 0.75rem;"><i class="fa-regular fa-moon me-1"></i> Imsak</small>
                    <span class="fw-bold fs-6 fs-md-5 d-block" style="color: var(--dark-green-bg);">{{ $jadwalHariIni['imsak'] ?? '-' }}</span>
                    <span class="badge-status" id="badge-imsak" style="display: none;"></span>
                </div>
            </div>

            <!-- SUBUH -->
            <div class="col-4 col-md-2">
                <div class="p-2 p-md-3 rounded-3 bg-light prayer-time-card" id="card-subuh">
                    <small class="text-muted d-block mb-1" style="font-size: 0.75rem;"><i class="fa-solid fa-sun me-1"></i> Subuh</small>
                    <span class="fw-bold fs-6 fs-md-5 d-block" style="color: var(--dark-green-bg);">{{ $jadwalHariIni['subuh'] ?? '-' }}</span>
                    <span class="badge-status" id="badge-subuh" style="display: none;"></span>
                </div>
            </div>

            <!-- DZUHUR -->
            <div class="col-4 col-md-2">
                <div class="p-2 p-md-3 rounded-3 bg-light prayer-time-card" id="card-dzuhur">
                    <small class="text-muted d-block mb-1" style="font-size: 0.75rem;"><i class="fa-solid fa-sun me-1"></i> Dzuhur</small>
                    <span class="fw-bold fs-6 fs-md-5 d-block" style="color: var(--dark-green-bg);">{{ $jadwalHariIni['dzuhur'] ?? '-' }}</span>
                    <span class="badge-status" id="badge-dzuhur" style="display: none;"></span>
                </div>
            </div>

            <!-- ASHAR -->
            <div class="col-4 col-md-2">
                <div class="p-2 p-md-3 rounded-3 bg-light prayer-time-card" id="card-ashar">
                    <small class="text-muted d-block mb-1" style="font-size: 0.75rem;"><i class="fa-solid fa-sun me-1"></i> Ashar</small>
                    <span class="fw-bold fs-6 fs-md-5 d-block" style="color: var(--dark-green-bg);">{{ $jadwalHariIni['ashar'] ?? '-' }}</span>
                    <span class="badge-status" id="badge-ashar" style="display: none;"></span>
                </div>
            </div>

            <!-- MAGHRIB -->
            <div class="col-4 col-md-2">
                <div class="p-2 p-md-3 rounded-3 bg-light prayer-time-card" id="card-maghrib">
                    <small class="text-muted d-block mb-1" style="font-size: 0.75rem;"><i class="fa-solid fa-cloud-sun me-1"></i> Maghrib</small>
                    <span class="fw-bold fs-6 fs-md-5 d-block" style="color: var(--dark-green-bg);">{{ $jadwalHariIni['maghrib'] ?? '-' }}</span>
                    <span class="badge-status" id="badge-maghrib" style="display: none;"></span>
                </div>
            </div>

            <!-- ISYA -->
            <div class="col-4 col-md-2">
                <div class="p-2 p-md-3 rounded-3 bg-light prayer-time-card" id="card-isya">
                    <small class="text-muted d-block mb-1" style="font-size: 0.75rem;"><i class="fa-regular fa-moon me-1"></i> Isya</small>
                    <span class="fw-bold fs-6 fs-md-5 d-block" style="color: var(--dark-green-bg);">{{ $jadwalHariIni['isya'] ?? '-' }}</span>
                    <span class="badge-status" id="badge-isya" style="display: none;"></span>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- TABEL BULANAN -->
    @if(!empty($jadwal))
    <div class="custom-card overflow-hidden">
        <div class="p-3 text-center border-bottom bg-light">
            <h6 class="mb-0 fw-bold" style="color: var(--dark-green-bg);">
                Jadwal Sholat Sebulan Penuh - {{ DateTime::createFromFormat('!m', $bulan ?? date('n'))->format('F') }} {{ $tahun ?? date('Y') }}
            </h6>
        </div>
        <div class="table-responsive">
            <table class="table table-custom mb-0 text-center">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Imsak</th>
                        <th>Subuh</th>
                        <th>Dzuhur</th>
                        <th>Ashar</th>
                        <th>Maghrib</th>
                        <th>Isya</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwal as $row)
                        @php
                            $tglNum = (int) preg_replace('/[^0-9]/', '', explode('/',$row['tanggal'] ?? '')[0] ?? 0);
                            $isToday = ($tglNum === (int)date('j') && ($bulan ?? date('n')) == (int)date('n') && ($tahun ?? date('Y')) == (int)date('Y'));
                        @endphp
                        <tr class="{{ $isToday ? 'today-highlight' : '' }}">
                            <td class="fw-bold">
                                {{ $row['hari'] ?? '' }}, {{$row['tanggal'] ?? '-' }}
                                @if($isToday) <span class="badge bg-success ms-1" style="font-size: 0.65rem;">Hari Ini</span> @endif
                            </td>
                            <td>{{ $row['imsak'] ?? '-' }}</td>
                            <td class="fw-semibold text-success">{{ $row['subuh'] ?? '-' }}</td>
                            <td>{{ $row['dzuhur'] ?? '-' }}</td>
                            <td>{{ $row['ashar'] ?? '-' }}</td>
                            <td class="fw-semibold text-success">{{ $row['maghrib'] ?? '-' }}</td>
                            <td>{{ $row['isya'] ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

</div>

<!-- SCRIPT AJAX KOTA & COUNTDOWN DENGAN HIGHLIGHT -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function initJadwalPage() {
    $('#select-provinsi').off('change').on('change', function() {
        var provinsi = $(this).val();
        var $kabkota =$('#select-kabkota');
        
        $kabkota.html('<option value="">Memuat Kabupaten/Kota...</option>');
        
        if (provinsi) {
            $.ajax({
                url: "{{ route('api.get-kota') }}",
                type: "GET",
                data: { provinsi: provinsi },
                success: function(data) {
                    $kabkota.html('<option value="">-- Pilih Kabupaten/Kota --</option>');
                    if (data && data.length > 0) {
                        data.forEach(function(item) {
                            var namaKota = typeof item === 'object' ? (item.kabkota || item.nama || Object.values(item)[0]) : item;
                            $kabkota.append('<option value="' + namaKota + '">' + namaKota + '</option>');
                        });
                    } else {
                        $kabkota.append('<option value="">-- Kota tidak ditemukan --</option>');
                    }
                },
                error: function() {
                    $kabkota.html('<option value="">-- Gagal memuat data --</option>');
                }
            });
        } else {
            $kabkota.html('<option value="">-- Pilih Kabupaten/Kota --</option>');
        }
    });

    const cardData = document.getElementById('countdown-data');
    if (cardData) {
        const fullJadwal = {
            'imsak': cardData.dataset.imsak || '04:15',
            'subuh': cardData.dataset.subuh || '04:25',
            'dzuhur': cardData.dataset.dzuhur || '11:45',
            'ashar': cardData.dataset.ashar || '15:00',
            'maghrib': cardData.dataset.maghrib || '17:50',
            'isya': cardData.dataset.isya || '19:00'
        };

        const displayNames = {
            'imsak': 'Imsak',
            'subuh': 'Subuh',
            'dzuhur': 'Dzuhur',
            'ashar': 'Ashar',
            'maghrib': 'Maghrib',
            'isya': 'Isya'
        };

        function updateCountdown() {
            const now = new Date();
            let nextPrayer = null;
            let nextPrayerTime = null;
            let nextKey = null;
            let ongoingKey = null;

            const keys = Object.keys(fullJadwal);

            for (let i = 0; i < keys.length; i++) {
                const key = keys[i];
                const parts = fullJadwal[key].split(':');
                if (parts.length < 2) continue;

                const prayerDate = new Date();
                prayerDate.setHours(parseInt(parts[0]), parseInt(parts[1]), 0, 0);

                if (prayerDate > now) {
                    nextPrayer = displayNames[key];
                    nextPrayerTime = prayerDate;
                    nextKey = key;
                    if (i > 0) ongoingKey = keys[i - 1];
                    break;
                }
            }

            if (!nextPrayer) {
                nextPrayer = 'Subuh (Besok)';
                nextKey = 'subuh';
                ongoingKey = 'isya';
                const parts = fullJadwal['subuh'].split(':');
                nextPrayerTime = new Date();
                nextPrayerTime.setDate(nextPrayerTime.getDate() + 1);
                nextPrayerTime.setHours(parseInt(parts[0]), parseInt(parts[1]), 0, 0);
            }

            // Reset highlight dan badge
            document.querySelectorAll('.prayer-time-card').forEach(card => {
                card.classList.remove('prayer-ongoing', 'prayer-next-highlight');
            });
            document.querySelectorAll('.badge-status').forEach(badge => {
                badge.style.display = 'none';
                badge.textContent = '';
            });

            // Highlight Sedang Berlangsung (Hijau)
            if (ongoingKey) {
                const ongoingCard = document.getElementById('card-' + ongoingKey);
                const ongoingBadge = document.getElementById('badge-' + ongoingKey);
                if (ongoingCard) ongoingCard.classList.add('prayer-ongoing');
                if (ongoingBadge) {
                    ongoingBadge.textContent = 'Berlangsung';
                    ongoingBadge.style.display = 'inline-block';
                }
            }

            // Highlight Sholat Berikutnya (Emas)
            if (nextKey) {
                const nextCard = document.getElementById('card-' + nextKey);
                const nextBadge = document.getElementById('badge-' + nextKey);
                if (nextCard) nextCard.classList.add('prayer-next-highlight');
                if (nextBadge) {
                    nextBadge.textContent = 'Berikutnya';
                    nextBadge.style.display = 'inline-block';
                }
            }

            const diff = nextPrayerTime - now;
            const hoursLeft = Math.floor(diff / (1000 * 60 * 60)).toString().padStart(2, '0');
            const minutesLeft = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, '0');
            const secondsLeft = Math.floor((diff % (1000 * 60)) / 1000).toString().padStart(2, '0');

            const elTitle = document.getElementById('judul-next-sholat');
            const elTimer = document.getElementById('timer-countdown');

            if (elTitle) elTitle.textContent = `Menuju Waktu ${nextPrayer}`;
            if (elTimer) elTimer.textContent = `- ${hoursLeft} : ${minutesLeft} : ${secondsLeft}`;
        }

        if (window.sholatTimerInterval) {
            clearInterval(window.sholatTimerInterval);
        }
        window.sholatTimerInterval = setInterval(updateCountdown, 1000);
        updateCountdown();
    }
}

$(document).ready(initJadwalPage);$(document).on('turbo:load', initJadwalPage);
</script>
@endsection