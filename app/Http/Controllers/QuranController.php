<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class QuranController extends Controller
{
    public function index(Request $request)
    {
        try {
            $response = Http::get('https://equran.id/api/v2/surat');
            $suratList = $response->json()['data'] ?? [];

            // Fitur Pencarian Surah
            if ($request->has('search') && !empty($request->search)) {
                $search = strtolower($request->search);
                $suratList = array_filter($suratList, function ($surah) use ($search) {
                    return str_contains(strtolower($surah['namaLatin']), $search) ||
                           str_contains(strtolower($surah['arti']), $search);
                });
            }

            // Memanggil file resources/views/quran.blade.php
            return view('quran', compact('suratList'));
        } catch (\Exception $e) {
            return view('quran', [
                'suratList' => [],
                'error' => 'Gagal mengambil data dari server: ' . $e->getMessage()
            ]);
        }
    }

    public function show(string $nomor)
    {
        try {
            // 1. Ambil detail surah yang sedang dibuka
            $response = Http::get('https://equran.id/api/v2/surat/' . $nomor);
            $quran = $response->json()['data'] ?? null;

            if (!$quran) {
                return redirect()->route('quran.index')->with('error', 'Surah tidak ditemukan');
            }

            // 2. Ambil data Tafsir per ayat dari equran.id
            $responseTafsir = Http::get('https://equran.id/api/v2/tafsir/' . $nomor);
            $tafsirData = $responseTafsir->json()['data']['tafsir'] ?? [];

            // 3. Petakan/gabungkan data tafsir ke dalam masing-masing ayat
            if (!empty($quran['ayat']) && !empty($tafsirData)) {
                $tafsirMap = collect($tafsirData)->keyBy('ayat');

                foreach ($quran['ayat'] as &$item) {
                    $nomorAyat = $item['nomorAyat'];
                    if (isset($tafsirMap[$nomorAyat])) {
                        $item['tafsir_teks'] = $tafsirMap[$nomorAyat]['teks'];
                    }
                }
            }

            // 4. Ambil daftar seluruh surah untuk Dropdown Pilih Surah
            $allSuratResponse = Http::get('https://equran.id/api/v2/surat');
            $allSurah = $allSuratResponse->json()['data'] ?? [];

            // 5. Tentukan surah sebelumnya dan selanjutnya (Navigasi Kiri/Kanan)
            $prevSurah = $quran['suratSebelumnya'] ?? null;
            $nextSurah = $quran['suratSelanjutnya'] ?? null;

            return view('detail', compact('quran', 'allSurah', 'prevSurah', 'nextSurah'));
        } catch (\Exception $e) {
            return redirect()->route('quran.index')->with('error', 'Gagal memuat detail surah');
        }
    }
}