# Aplikasi Kampus (Pertemuan 9)

Aplikasi web sederhana untuk manajemen data akademik kampus yang dikembangkan menggunakan PHP Native dan Bootstrap. Project ini merupakan bagian dari materi Workshop Pemrograman Web 2.

## 📋 Fitur Utama
- **Dashboard**: Ringkasan data akademik.
- **Manajemen Dosen**: Tambah, Ubah, Hapus, dan Lihat data dosen.
- **Manajemen Mahasiswa**: Kelola data mahasiswa lengkap.
- **Manajemen Mata Kuliah**: Pengaturan data mata kuliah.
- **Manajemen Nilai**: Input dan kelola nilai mahasiswa.

## ⚙️ Persyaratan Sistem
- Web Server (XAMPP, Laragon, atau sejenisnya)
- PHP 7.4 atau lebih baru
- MySQL / MariaDB

## 🚀 Cara Instalasi

1. **Simpan Project**
   Pastikan folder project ini berada di dalam direktori root server lokal Anda (misalnya `htdocs` untuk XAMPP atau `www` untuk Laragon).

2. **Buat Database**
   - Buka phpMyAdmin atau client database lainnya.
   - Buat database baru dengan nama `db_kampus`.

3. **Import Database**
   - Import file `db_kampus.sql` yang disertakan dalam root folder project ini ke database `db_kampus` yang baru saja dibuat.

4. **Konfigurasi Koneksi**
   - Cek file di dalam folder `config/` (biasanya `database.php` atau `koneksi.php`).
   - Pastikan username dan password database sesuai dengan konfigurasi lokal Anda.

5. **Jalankan Aplikasi**
   - Buka browser dan akses URL: `http://localhost/path/to/PERTEMUAN-9/`

## 📂 Struktur Folder
- `config/` : Berisi file konfigurasi koneksi database.
- `includes/` : Komponen partial seperti header, footer, dan navbar.
- `views/` : Halaman-halaman antarmuka pengguna (View).
- `index.php` : Titik masuk utama aplikasi (Routing sederhana).

---
*Dibuat untuk Workshop Pemrograman Web 2*
