<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class DoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $search = $request->query('search');

    // Mengambil data API dengan cache 24 jam (1440 menit)
    $doaList = Cache::remember('equran_doa_v3', 1440, function () {
        try {
            $response = Http::withoutVerifying()->get('https://equran.id/api/doa');
            
            if ($response->successful()) {
                $data = $response->json();
                
                // Jika data terbungkus dalam key 'data' atau 'data doa'
                if (isset($data['data']) && is_array($data['data'])) {
                    return $data['data'];
                }
                
                if (is_array($data)) {
                    return $data;
                }
            }
        } catch (\Exception $e) {
            // Abaikan error jika API gagal
        }

        // Data cadangan (fallback) jika API gagal diakses
        return [
            [
                'nama' => 'Doa Sebelum Makan',
                'ar' => 'بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ',
                'tr' => 'Bismillahir rahmanir rahim',
                'idn' => 'Dengan menyebut nama Allah Yang Maha Pemurah lagi Maha Penyayang.',
                'tentang' => 'HR. Abu Dawud & Tirmidzi'
            ]
        ];
    });

    // Konversi objek menjadi array jika data berupa object
    $doaList = json_decode(json_encode($doaList), true);

    // Filter Pencarian
    if ($search) {
        $keyword = strtolower($search);
        $doaList = array_filter($doaList, function ($item) use ($keyword) {
            $nama = strtolower($item['nama'] ?? $item['doa'] ?? $item['judul'] ?? $item['title'] ?? '');
            $terjemahan = strtolower($item['idn'] ?? $item['artinya'] ?? $item['terjemahan'] ?? $item['translation'] ?? '');

            return str_contains($nama, $keyword) || str_contains($terjemahan, $keyword);
        });
    }

    return view('doa.index', [
        'doaList' => $doaList,
        'search'  => $search
    ]);
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
