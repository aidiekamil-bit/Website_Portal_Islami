<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JadwalSholatController extends Controller
{
    public function index(Request $request)
    {
        $selectedProvinsi = $request->get('provinsi');
        $kabkota = $request->get('kabkota');
        $bulan = (int) $request->get('bulan', date('n'));
        $tahun = (int) $request->get('tahun', date('Y'));

        // 1. Ambil Daftar Provinsi dari API resmi EQuran.id v2 (/api/v2/shalat/provinsi)
        $daftarProvinsi = [];
        try {
            $resProv = Http::get("https://equran.id/api/v2/shalat/provinsi");
            if ($resProv->successful()) {
                $daftarProvinsi = $resProv->json()['data'] ?? [];
            }
        } catch (\Exception $e) {}

        // Fallback jika API kosong
        if (empty($daftarProvinsi)) {
            $daftarProvinsi = ['Aceh', 'Sumatera Utara', 'Sumatera Barat', 'Riau', 'Jambi', 'Sumatera Selatan', 'Bengkulu', 'Lampung', 'DKI Jakarta', 'Jawa Barat', 'Jawa Tengah', 'DI Yogyakarta', 'Jawa Timur', 'Bali', 'Banten'];
        }

        // 2. Ambil Daftar Kabupaten/Kota Berdasarkan Provinsi (/api/v2/shalat/kabkota)
        $daftarKota = [];
        if ($selectedProvinsi) {
            try {
                $resKota = Http::post("https://equran.id/api/v2/shalat/kabkota", [
                    'provinsi' => $selectedProvinsi
                ]);
                if ($resKota->successful()) {
                    $daftarKota = $resKota->json()['data'] ?? [];
                }
            } catch (\Exception $e) {}
        }

        // 3. Ambil Jadwal Sholat Bulanan (/api/v2/shalat)
        $jadwal = [];
        $jadwalHariIni = null;

        if ($selectedProvinsi && $kabkota) {
            try {
                $resJadwal = Http::post("https://equran.id/api/v2/shalat", [
                    'provinsi' => $selectedProvinsi,
                    'kabkota'  => $kabkota,
                    'bulan'    => $bulan,
                    'tahun'    => $tahun,
                ]);

                if ($resJadwal->successful()) {
                    $json = $resJadwal->json();
                    $rawJadwal = $json['data']['jadwal'] ?? ($json['jadwal'] ?? []);
                    $todayNumber = (int) date('j');

                    foreach ($rawJadwal as $item) {
                        $itemData = [
                            'tanggal' => $item['tanggal'] ?? '-',
                            'hari'    => $item['hari'] ?? '',
                            'imsak'   => $item['imsak'] ?? '-',
                            'subuh'   => $item['subuh'] ?? '-',
                            'dzuhur'  => $item['dzuhur'] ?? '-',
                            'ashar'   => $item['ashar'] ?? '-',
                            'maghrib' => $item['maghrib'] ?? '-',
                            'isya'    => $item['isya'] ?? '-',
                        ];

                        $jadwal[] = $itemData;

                        // Cocokan tanggal hari ini
                        $tglInt = (int) ($item['tanggal'] ?? 0);
                        if ($bulan === (int)date('n') && $tahun === (int)date('Y')) {
                            if ($tglInt === $todayNumber) {
                                $jadwalHariIni = $itemData;
                            }
                        }
                    }
                }
            } catch (\Exception $e) {}
        }

        if (!$jadwalHariIni && !empty($jadwal)) {
            $jadwalHariIni = $jadwal[0];
        }

        return view('jadwal.index', compact(
            'selectedProvinsi',
            'kabkota',
            'bulan',
            'tahun',
            'daftarProvinsi',
            'daftarKota',
            'jadwalHariIni',
            'jadwal'
        ));
    }

    public function getKotaByProvinsi(Request $request)
    {
        $provinsi = $request->get('provinsi');

        if (!$provinsi) {
            return response()->json([]);
        }

        try {
            $response = Http::post("https://equran.id/api/v2/shalat/kabkota", [
                'provinsi' => $provinsi
            ]);

            if ($response->successful()) {
                $data = $response->json()['data'] ?? [];
                return response()->json($data);
            }
        } catch (\Exception $e) {}

        return response()->json([]);
    }
}