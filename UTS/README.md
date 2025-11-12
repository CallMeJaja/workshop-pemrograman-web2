# 💼 Sistem Perhitungan Gaji Tim Software

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

> **UTS Tipe D** - Sistem perhitungan gaji karyawan tim software berbasis web menggunakan PHP Native

---

## 📖 Deskripsi Project

Aplikasi web sederhana untuk menghitung gaji bulanan anggota tim software development berdasarkan jam kerja, jam lembur, posisi, dan nilai project yang dikerjakan. Sistem ini dirancang untuk memudahkan perhitungan komponen gaji yang kompleks dengan berbagai persentase berdasarkan posisi.

---

## ✨ Fitur Utama

- ✅ **Input Data Karyawan** - Form input nama, posisi, jam kerja, dan nilai project
- ✅ **Perhitungan Otomatis** - Kalkulasi upah kerja, upah lembur (auto-calculated), dan fee project
- ✅ **Multi Posisi** - Mendukung 5 posisi dengan rate berbeda
- ✅ **Multi Anggota** - Mendukung 5 anggota tim
- ✅ **Format Rupiah** - Tampilan nilai mata uang yang rapi dengan `number_format()`
- ✅ **Validasi Input** - Server-side & client-side validation
- ✅ **Rincian Detail** - Menampilkan breakdown komponen gaji secara lengkap
- ✅ **Bootstrap UI** - Interface modern dan profesional dengan Bootstrap 5
- ✅ **Responsive Design** - Layout 2 kolom (desktop) dan 1 kolom (mobile)
- ✅ **Badge Posisi** - Visual indicator dengan warna untuk setiap posisi
- ✅ **Sticky Sidebar** - Referensi ketentuan gaji selalu terlihat
- ✅ **Error Handling** - Alert untuk input tidak valid
- ✅ **Validasi Harga Realistis** - Minimum harga project Rp 10 juta

---

## 🎯 Studi Kasus

### **Perhitungan Gaji Tim Software**

Setiap anggota tim memiliki:

- **Upah per jam** sesuai posisi
- **Upah lembur** (persentase dari upah per jam × jam lembur)
- **Fee project** (persentase dari nilai project)

**Jam Kerja Ideal**: 40 jam/minggu × 4 minggu = **160 jam/bulan**

**Logic Jam Lembur**:

- Jika jam kerja ≤ 160: Tidak ada lembur
- Jika jam kerja > 160: Jam lembur = jam kerja - 160
- Upah jam kerja normal maksimal 160 jam (jika ada lembur)

---

## 👥 Data Tim

### Anggota Tim (5 Orang)

1. Reza Asriano Maulana
2. Satrio Ilham Syahputra
3. Helgi Nur Allamsyah
4. Dhafi Ebsan Yurizal
5. Fikri Ramdani

### Posisi & Rate

| Posisi          | Upah per Jam | Upah Lembur | Fee Project |
| --------------- | ------------ | ----------- | ----------- |
| Lead Developer  | Rp 450.000   | 18%         | 5%          |
| QA Engineer     | Rp 250.000   | 12%         | 1%          |
| DevOps Engineer | Rp 350.000   | 10%         | 2.5%        |
| Backend Dev     | Rp 300.000   | 15%         | 3%          |
| Frontend Dev    | Rp 300.000   | 15%         | 3%          |

---

## 🔧 Teknologi yang Digunakan

- **PHP** 7.4+
- **HTML5** - Struktur halaman
- **Bootstrap 5.3** - Framework CSS untuk UI/UX
- **JavaScript** - Bootstrap JS untuk komponen interaktif

---

## 📁 Struktur Project

```
UTS/
├── index.php          # Aplikasi utama
├── README.md          # Dokumentasi project
├── requirement.md     # Spesifikasi kebutuhan UTS
└── .gitignore         # Git ignore file
```

---

## 🎨 UI/UX Features

### Layout Responsif

- **Desktop (≥992px)**: Layout 2 kolom - Form & Hasil (kiri) | Referensi Gaji (kanan)
- **Tablet & Mobile (<992px)**: Layout 1 kolom - Stacked vertical

### Visual Elements

- **Color-coded Badges**: Setiap posisi memiliki badge warna berbeda
  - Lead Developer: `Red`
  - QA Engineer: `Cyan`
  - DevOps Engineer: `Yellow`
  - Backend Dev: `Blue`
  - Frontend Dev: `Green`
- **Sticky Sidebar**: Tabel referensi tetap terlihat saat scroll (desktop)
- **Professional Slip Gaji**: Format tabel dengan breakdown detail
- **Alert System**: Error validation dengan Bootstrap alert

---

## 💰 Panduan Harga Project

Berdasarkan rate tim yang cukup tinggi, berikut rekomendasi harga project:

| Skala Project  | Harga Project                   | Durasi     | Tim       |
| -------------- | ------------------------------- | ---------- | --------- |
| **Small**      | Rp 10.000.000 - Rp 50.000.000   | 1-2 minggu | 1-2 orang |
| **Medium**     | Rp 50.000.000 - Rp 200.000.000  | 1-2 bulan  | 2-3 orang |
| **Large**      | Rp 200.000.000 - Rp 500.000.000 | 2-4 bulan  | 3-5 orang |
| **Enterprise** | > Rp 500.000.000                | 4+ bulan   | 5+ orang  |

**Validasi System:**

- Minimum harga project: **Rp 10.000.000**
- Rekomendasi: **Rp 50.000.000 - Rp 1.000.000.000**

**Contoh Realistis:**

- Harga Project: Rp 500.000.000
- Lead Dev Fee (5%): Rp 25.000.000
- Backend Dev Fee (3%): Rp 15.000.000

---

## 🚀 Cara Menjalankan

### **1. Persiapan**

Pastikan sudah terinstall:

- PHP 7.4 atau lebih tinggi
- Web browser (Chrome, Firefox, dll)

### **2. Clone/Download Project**

```bash
# Clone repository (jika menggunakan Git)
git clone https://github.com/CallMeJaja/workshop-pemrograman-web2.git

# Masuk ke direktori UTS
cd workshop-pemrograman-web2/UTS
```

### **3. Jalankan Server**

#### Opsi A: PHP Built-in Server (Recommended)

```bash
# Jalankan di port 8000
php -S localhost:8000

# Atau port lain jika 8000 sudah digunakan
php -S localhost:3000
```

#### Opsi B: XAMPP/LAMP

1. Copy folder `UTS` ke `htdocs` (XAMPP) atau `www` (LAMP)
2. Start Apache server
3. Akses via browser: `http://localhost/UTS/`

### **4. Buka di Browser**

```
http://localhost:8000
```

---

## 📝 Cara Menggunakan

### **Langkah 1: Input Data**

1. **Pilih Nama Anggota** dari dropdown (5 pilihan)
2. **Pilih Posisi** sesuai role (5 pilihan posisi)
3. **Masukkan Jam Kerja** total dalam 1 bulan
   - Minimum: 1 jam
   - Ideal: 160 jam/bulan (40 jam/minggu)
   - Contoh dengan lembur: 180 jam
   - **Jam lembur otomatis dihitung** jika > 160 jam
4. **Masukkan Harga Project**
   - Minimum: Rp 10.000.000
   - Rekomendasi: Rp 50.000.000 - Rp 1.000.000.000
   - Contoh: Rp 500.000.000

### **Langkah 2: Submit**

Klik tombol **"Hitung Gaji"** untuk memproses perhitungan

### **Langkah 3: Lihat Hasil**

Sistem akan menampilkan **Slip Gaji Karyawan** dengan:

- **Informasi Karyawan:**
  - Nama Anggota
  - Posisi (dengan badge berwarna)
  - Jam Kerja total
  - Jam Lembur (badge: kuning jika ada, abu-abu jika tidak ada)
  - Harga Project
- **Rincian Perhitungan Gaji (Tabel):**

  - Upah dari Jam Kerja (maksimal 160 jam jika ada lembur)
  - Upah dari Jam Lembur (0 jika jam kerja ≤ 160) + persentase
  - Upah dari Fee Project + persentase
  - **Total Upah** (highlight hijau)

- **Catatan:** Info upah per jam untuk posisi terpilih

### **Validasi & Error Handling**

Sistem akan menampilkan alert merah jika:

- Nama anggota belum dipilih
- Posisi belum dipilih
- Jam kerja tidak valid atau ≤ 0
- Harga project < Rp 10.000.000

---

## 💡 Contoh Perhitungan

### **Skenario 1: Dengan Lembur**

**Input:**

- Posisi: Lead Developer
- Jam Kerja: 180 jam
- Harga Project: Rp 500.000.000

**Proses:**

1. **Hitung Jam Lembur:**

   - `180 - 160 = 20 jam lembur`

2. **Upah Jam Kerja:**

   - Rate: Rp 450.000/jam
   - Karena ada lembur, hanya 160 jam dihitung normal
   - `160 × 450.000 = Rp 72.000.000`

3. **Upah Lembur:**

   - Persen lembur: 18%
   - Upah lembur per jam: `450.000 × 18% = Rp 81.000`
   - `20 jam × 81.000 = Rp 1.620.000`

4. **Fee Project:**

   - Persen fee: 5%
   - `500.000.000 × 5% = Rp 25.000.000`

5. **Total Upah:**
   - `72.000.000 + 1.620.000 + 25.000.000 = Rp 98.620.000`

---

### **Skenario 2: Tanpa Lembur**

**Input:**

- Posisi: Backend Dev
- Jam Kerja: 150 jam
- Harga Project: Rp 100.000.000

**Proses:**

1. **Hitung Jam Lembur:**

   - `150 ≤ 160` → **Tidak ada lembur**

2. **Upah Jam Kerja:**

   - Rate: Rp 300.000/jam
   - `150 × 300.000 = Rp 45.000.000`

3. **Upah Lembur:**

   - `Rp 0` (tidak ada lembur)

4. **Fee Project:**

   - Persen fee: 3%
   - `100.000.000 × 3% = Rp 3.000.000`

5. **Total Upah:**
   - `45.000.000 + 0 + 3.000.000 = Rp 48.000.000`

---

### **Skenario 3: Project Besar (Enterprise)**

**Input:**

- Posisi: Lead Developer
- Jam Kerja: 200 jam
- Harga Project: Rp 1.000.000.000

**Proses:**

1. **Hitung Jam Lembur:**

   - `200 - 160 = 40 jam lembur`

2. **Upah Jam Kerja:**

   - `160 × 450.000 = Rp 72.000.000`

3. **Upah Lembur:**

   - `40 × 81.000 = Rp 3.240.000`

4. **Fee Project:**

   - `1.000.000.000 × 5% = Rp 50.000.000`

5. **Total Upah:**
   - `72.000.000 + 3.240.000 + 50.000.000 = Rp 125.240.000`

**💰 Insight:** Fee project sangat berpengaruh pada total upah, terutama untuk project besar!

---

## 🧮 Fungsi PHP yang Digunakan

### **1. `hitungJamLembur($jam_kerja)`**

Menghitung jam lembur otomatis dari total jam kerja.

**Logic**:

- Jika `$jam_kerja > 160` → return `$jam_kerja - 160`
- Jika `$jam_kerja ≤ 160` → return `0`

**Contoh**: `hitungJamLembur(180)` → `20 jam`

---

### **2. `hitungUpahJamKerja($jam_kerja, $upah_per_jam)`**

Menghitung upah berdasarkan jam kerja normal.

**Logic**:

- Jika ada lembur → max 160 jam normal
- Jika tidak ada lembur → sesuai jam kerja actual

**Rumus**:

```php
hitungJamLembur($jam_kerja) > 0
    ? 160 × $upah_per_jam
    : $jam_kerja × $upah_per_jam
```

**Contoh**:

- `hitungUpahJamKerja(180, 450000)` → `160 × 450000 = Rp 72.000.000`
- `hitungUpahJamKerja(150, 450000)` → `150 × 450000 = Rp 67.500.000`

---

### **3. `hitungUpahLembur($jam_kerja, $upah_per_jam, $persen_lembur)`**

Menghitung upah lembur berdasarkan persentase dari upah per jam.

**Rumus**:

```php
$jam_lembur = hitungJamLembur($jam_kerja);
$upah_lembur_per_jam = $upah_per_jam × ($persen_lembur / 100);
return $jam_lembur × $upah_lembur_per_jam;
```

**Contoh**:

- Jam lembur: 20 jam
- Upah per jam: Rp 450.000
- Persen lembur: 18%
- Hasil: `20 × (450000 × 18%) = 20 × 81000 = Rp 1.620.000`

---

### **4. `hitungUpahFee($harga_project, $persen_fee)`**

Menghitung fee project berdasarkan persentase dari nilai project.

**Rumus**: `harga_project × (persen_fee / 100)`

**Contoh**:

- Harga project: Rp 500.000.000
- Persen fee: 5%
- Hasil: `500.000.000 × 5% = Rp 25.000.000`

---

### **5. `hitungTotalUpah($upah_jam_kerja, $upah_lembur, $upah_fee)`**

Menghitung total gaji keseluruhan dari semua komponen.

**Rumus**: `upah_jam_kerja + upah_lembur + upah_fee`

**Contoh**: `72.000.000 + 1.620.000 + 25.000.000 = Rp 98.620.000`

---

## 🎨 Pengembangan Lebih Lanjut

Beberapa ide untuk meningkatkan aplikasi:

- [x] **Styling CSS** - ✅ Bootstrap 5 sudah diimplementasikan
- [x] **Validasi** - ✅ Server-side validation sudah ada
- [x] **Responsive Design** - ✅ Layout 2 kolom (desktop) & 1 kolom (mobile)
- [ ] **Database** - Simpan history perhitungan gaji (MySQL/PostgreSQL)
- [ ] **Export PDF** - Cetak slip gaji menggunakan library TCPDF/FPDF
- [ ] **Grafik** - Visualisasi perbandingan gaji antar posisi (Chart.js)
- [ ] **PPh21** - Implementasi perhitungan pajak sesuai aturan perpajakan Indonesia
- [ ] **Session/Login** - Multi-user dengan autentikasi
- [ ] **CRUD Anggota** - Tambah/edit/hapus anggota tim
- [ ] **Report Bulanan** - Rekap gaji seluruh tim per bulan
- [ ] **Dark Mode** - Toggle tema gelap/terang
- [ ] **Print Function** - Cetak slip gaji langsung dari browser

---

## 📋 Checklist Pengerjaan

✅ Setup structure project  
✅ Buat array data anggota (5 orang)  
✅ Buat array data posisi (5 posisi)  
✅ Buat fungsi `hitungJamLembur()`  
✅ Buat fungsi `hitungUpahJamKerja()`  
✅ Buat fungsi `hitungUpahLembur()`  
✅ Buat fungsi `hitungUpahFee()`  
✅ Buat fungsi `hitungTotalUpah()`  
✅ Buat form input (nama, posisi, jam kerja, harga project)  
✅ Implementasi perhitungan otomatis  
✅ Format output rupiah dengan `number_format()`  
✅ Display hasil perhitungan  
✅ Styling CSS/Bootstrap (Bootstrap 5)  
✅ Validasi input server-side (PHP)  
✅ Responsive design (2 kolom desktop, 1 kolom mobile)  
✅ Error handling dengan alert  
✅ Badge posisi dengan color coding  
✅ Sticky sidebar referensi  
✅ Slip gaji profesional dengan tabel  
✅ Validasi minimum harga project (Rp 10 juta)  
✅ Hint & placeholder informatif  
✅ Responsive 2-column layout

---

## 🐛 Known Issues / Limitations

1. **Data Persistence** - Data tidak tersimpan (hilang setelah refresh)
2. **Database** - Belum menggunakan database untuk menyimpan data
3. **Export Feature** - Belum ada fitur export ke PDF/Excel
4. **Multi-language** - Hanya tersedia dalam Bahasa Indonesia
5. **History** - Belum ada riwayat perhitungan gaji
6. **Print Styling** - Belum optimal untuk print preview

---

## 👨‍💻 Pengembang

**Nama**: Reza Asriano Maulana  
**Mata Kuliah**: Workshop Pemrograman Web 2  
**Institusi**: Politeknik Enjinering Indorama  
**Semester**: 3 (Tiga)  
**Tahun** : Ganjil 2025/2026

---

## 📄 Lisensi

Project ini dibuat untuk keperluan akademik (UTS).

---

## 📞 Kontak & Dukungan

Jika ada pertanyaan atau issue:

1. Buka [GitHub Issues](https://github.com/CallMeJaja/workshop-pemrograman-web2/issues)
2. Atau hubungi langsung via GitHub

---

## 📚 Referensi

- [PHP Official Documentation](https://www.php.net/docs.php)
- [Bootstrap 5 Documentation](https://getbootstrap.com/docs/5.3/getting-started/introduction/)
- [W3Schools PHP Tutorial](https://www.w3schools.com/php/)
- [MDN Web Docs](https://developer.mozilla.org/)
- [PHP number_format()](https://www.php.net/manual/en/function.number-format.php)

---

<div align="center">

**⭐ Jika project ini membantu, berikan star di GitHub! ⭐**

Made with ❤️ for UTS Workshop Pemrograman Web 2

</div>
