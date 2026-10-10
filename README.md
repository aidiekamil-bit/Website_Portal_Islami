# Portal Islami - Website Integrasi API eQuran.id

Aplikasi web berbasis Laravel yang menyajikan layanan Islami interaktif (Al-Qur'an, Doa Harian, dan Jadwal Sholat) dengan memanfaatkan data dari **eQuran.id API v2**. Proyek ini dibuat untuk memenuhi tugas praktikum Pemrograman Web / Rekayasa Perangkat Lunak.

---

## 🛠️ Tech Stack
- **Framework**: Laravel 13
- **Frontend**: Bootstrap 5, FontAwesome, Google Fonts (Amiri)
- **Library/Tools**: Hotwire Turbo, Axios/Fetch, eQuran.id API v2

---

## 🚀 Fitur Utama
1. **Al-Qur'an Digital**: 
   - Daftar surah lengkap dengan fitur pencarian cepat.
   - Detail surah, teks Arab (Font Amiri), teks Latin, dan terjemahan Indonesia.
   - Pemutar audio per ayat dengan kontrol interaktif & pemutar *Audio Full* pilihan Qari.
   - Pengantar/Deskripsi Surah dan **Modal Tafsir Kemenag** per ayat.
2. **Doa Harian**: Daftar doa lengkap dengan teks Arab, latin, terjemahan, serta kategori sumber doa.
3. **Jadwal Sholat**: 
   - Pemilihan wilayah (Provinsi & Kabupaten/Kota) secara dinamis menggunakan AJAX.
   - Hitung mundur (*countdown*) waktu sholat berikutnya.
   - *Live highlight* otomatis untuk jadwal sholat yang sedang berlangsung (*Berlangsung*) dan berikutnya (*Berikutnya*).

---

## 📋 Laporan Singkat (Jawaban LKPD)

1. **Mengapa layanan pilihanmu sesuai dengan tujuan website?**
   - Layanan Al-Qur'an, Doa, dan Jadwal Sholat dipilih karena ketiganya merupakan kebutuhan ibadah harian yang paling esensial bagi umat Islam, sehingga sangat tepat untuk membangun portal Islami yang interaktif.

2. **Bagaimana request diproses hingga informasi tampil?**
   - *Request* dikirimkan dari browser melalui *route* Laravel menuju Controller. Di dalam Controller, Laravel menggunakan `Http facade` untuk mengambil data JSON dari API `eQuran.id` (baik data surah maupun endpoint tafsir terpisah). Data tersebut kemudian diproses dan dikirim ke *view* Blade untuk dirender ke antarmuka pengguna.

3. **Masalah apa yang ditemukan saat pengujian, dan bagaimana perbaikannya?**
   - Kendala awal adalah data tafsir per ayat tidak muncul karena endpoint API `eQuran.id` v2 memisahkan data surah dan data tafsir. Perbaikannya adalah dengan menambahkan pemanggilan API tafsir kedua di dalam Controller lalu memetakannya berdasarkan nomor ayat agar sinkron saat ditampilkan di dalam modal pop-up.

---

## 📸 Bukti Pengujian (Testing)
Di GCR dalam bentuk PDF