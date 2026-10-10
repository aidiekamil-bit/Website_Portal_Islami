<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\DoaController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\JadwalSholatController;



Route::get('/', function () {
    return view('home'); // atau 'welcome'
});
Route::get('/api/get-kota', [JadwalSholatController::class, 'getKotaByProvinsi'])->name('api.get-kota');

// 1. Halaman Utama (Quote)
Route::resource('welcome', QuoteController::class);

// 2. Fitur Al-Qur'an
Route::resource('quran', QuranController::class);

// 3. Fitur Doa Harian
Route::prefix('doa')->name('doa.')->group(function () {
    Route::get('/', [DoaController::class, 'index'])->name('index');
    Route::get('/{id}', [DoaController::class, 'show'])->name('show');
});

// 4. Fitur Jadwal Sholat (Pengayaan)
Route::prefix('jadwal-sholat')->name('jadwal.')->group(function () {
    Route::get('/', [JadwalSholatController::class, 'index'])->name('index');
});

// 5. Fitur Tambahan (Quote & Produk Dummy)
Route::get('/quotes', [QuoteController::class, 'index']);

Route::get('/produk', function () {
    $products = [
        ["id" => 2, "nama" => "Buku Lima Sekawan", "harga" => 100000, "kategori" => "Buku Anak", "stok" => 100],
        ["id" => 3, "nama" => "Buku Enam Sekawan", "harga" => 150000, "kategori" => "Buku Anak", "stok" => false],
        ["id" => 4, "nama" => "Buku Tujuh Sekawan", "harga" => 200000, "kategori" => "Buku Anak", "stok" => 25],
        ["id" => 5, "nama" => "Buku Delapan Sekawan", "harga" => 250000, "kategori" => "Buku Anak", "stok" => 10],
        ["id" => 6, "nama" => "Buku Sembilan Sekawan", "harga" => 300000, "kategori" => "Buku Anak", "stok" => 5]
    ];
    return response()->json($products);
});

Route::get('/produk/{id}', function ($id) {
    $products = [
        2 => ["id" => 2, "nama" => "Buku Lima Sekawan", "harga" => 100000, "kategori" => "Buku Anak", "stok" => 100],
        3 => ["id" => 3, "nama" => "Buku Enam Sekawan", "harga" => 150000, "kategori" => "Buku Anak", "stok" => false],
        4 => ["id" => 4, "nama" => "Buku Tujuh Sekawan", "harga" => 200000, "kategori" => "Buku Anak", "stok" => 25],
        5 => ["id" => 5, "nama" => "Buku Delapan Sekawan", "harga" => 250000, "kategori" => "Buku Anak", "stok" => 10],
        6 => ["id" => 6, "nama" => "Buku Sembilan Sekawan", "harga" => 300000, "kategori" => "Buku Anak", "stok" => 5]
    ];

    if (array_key_exists($id, $products)) {
        return response()->json($products[$id]);
    }
    return response()->json(['message' => 'Produk tidak ditemukan'], 404);
});