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

### Core Features

- ✅ **Input Data Karyawan** - Form input nama, posisi, jam kerja, dan nilai project dengan dropdown selection
- ✅ **Perhitungan Otomatis** - Kalkulasi upah kerja, upah lembur (auto-calculated), dan fee project
- ✅ **Multi Posisi** - Mendukung 5 posisi dengan rate berbeda (Lead Dev, QA, DevOps, Backend, Frontend)
- ✅ **Multi Anggota** - Mendukung 5 anggota tim dengan nama lengkap
- ✅ **Format Rupiah** - Tampilan nilai mata uang yang rapi dengan `number_format()`
- ✅ **Rincian Detail** - Menampilkan breakdown komponen gaji secara lengkap dalam tabel

### UI/UX Features

- ✅ **Bootstrap 5 UI** - Interface modern dan profesional dengan gradient headers
- ✅ **Responsive Design** - Layout 3 kolom (desktop) dan 1 kolom (mobile)
- ✅ **Badge Posisi** - Visual indicator dengan warna untuk setiap posisi
- ✅ **Color-coded Sidebar** - Identitas mahasiswa dengan soft pastel colors
- ✅ **Sticky Sidebar** - Referensi ketentuan gaji selalu terlihat saat scroll
- ✅ **Bootstrap Icons** - Icon library untuk better visual communication

### Validation & Error Handling

- ✅ **Client-side Validation** - Bootstrap form validation dengan real-time feedback
- ✅ **Required Indicators** - Tanda asterisk (\*) merah pada field wajib
- ✅ **Error Messages** - Pesan error dengan icon dan styling yang jelas
- ✅ **Info Alerts** - Alert informasi untuk panduan pengguna
- ✅ **Validasi Harga Realistis** - Minimum harga project Rp 10 juta dengan pesan validasi

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

- **Desktop (≥992px)**: Layout 3 kolom
  - Kolom 1 (25%): Identitas Mahasiswa (sidebar kiri)
  - Kolom 2 (50%): Form Kalkulator & Hasil
  - Kolom 3 (25%): Referensi Gaji (sticky sidebar kanan)
- **Tablet & Mobile (<992px)**: Layout 1 kolom - Stacked vertical

### Visual Elements

#### 1. **Position Badges**

Setiap posisi memiliki badge warna berbeda:

- Lead Developer: `Red (danger)`
- QA Engineer: `Cyan (info)`
- DevOps Engineer: `Yellow (warning)`
- Backend Dev: `Blue (primary)`
- Frontend Dev: `Green (success)`

#### 2. **Form Validation UI**

- Required fields dengan asterisk merah (\*)
- Invalid feedback dengan icon exclamation
- Info alert biru untuk catatan jam kerja
- Bootstrap validation classes (is-invalid, is-valid)

#### 3. **Professional Slip Gaji**

- Card dengan border primary
- Badge untuk jam lembur (warning/secondary)
- Tabel bordered dengan hover effect
- Total upah highlighted dengan background success
- Info alert untuk catatan upah per jam

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

#### Client-side Validation (Real-time)

Sistem akan menampilkan feedback merah di bawah input jika:

- Field required kosong
- Jam kerja < 1
- Harga project < Rp 10.000.000

#### Visual Feedback

- **Invalid**: Border merah + icon exclamation + pesan error
- **Valid**: Border hijau (setelah input benar)
- **Required**: Asterisk merah (\*) di label

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

### Already Implemented ✅

- [x] **Styling CSS** - ✅ Bootstrap 5 dengan gradient headers
- [x] **Validasi** - ✅ Client-side
- [x] **Responsive Design** - ✅ Layout 3 kolom (desktop) & 1 kolom (mobile)
- [x] **Bootstrap Icons** - ✅ Icon library untuk visual elements
- [x] **Color-coded Badges** - ✅ Badge warna untuk setiap posisi
- [x] **Info Alerts** - ✅ Alert untuk panduan pengguna
- [x] **Required Indicators** - ✅ Asterisk merah pada field wajib
- [x] **Professional Slip Gaji** - ✅ Tabel dengan breakdown detail

### Future Enhancements 🚀

- [ ] **Database Integration** - Simpan history perhitungan gaji (MySQL/PostgreSQL)
- [ ] **Export PDF** - Cetak slip gaji menggunakan library TCPDF/FPDF/DomPDF
- [ ] **Export Excel** - Export data menggunakan PHPSpreadsheet
- [ ] **Data Visualization** - Grafik perbandingan gaji antar posisi (Chart.js/ApexCharts)
- [ ] **PPh21 Calculator** - Implementasi perhitungan pajak sesuai aturan perpajakan Indonesia
- [ ] **Session/Login** - Multi-user dengan autentikasi (login system)
- [ ] **CRUD Anggota** - Tambah/edit/hapus anggota tim via admin panel
- [ ] **CRUD Posisi** - Kelola data posisi dan rate
- [ ] **Monthly Report** - Rekap gaji seluruh tim per bulan dengan filter
- [ ] **Dark Mode** - Toggle tema gelap/terang dengan localStorage
- [ ] **Print Functionality** - CSS @media print untuk print preview yang optimal
- [ ] **Auto-format Currency Input** - Format ribuan otomatis saat user mengetik
- [ ] **Email Notification** - Kirim slip gaji via email (PHPMailer)
- [ ] **Multi-language** - Bahasa Indonesia & English
- [ ] **Absensi Integration** - Link dengan sistem absensi untuk auto-fill jam kerja
- [ ] **Project Management** - Kelola multiple projects dengan timeline
- [ ] **Employee Dashboard** - Dashboard untuk melihat riwayat gaji pribadi
- [ ] **Admin Dashboard** - Dashboard analytics untuk HR/Finance
- [ ] **API Integration** - RESTful API untuk integrasi dengan sistem lain
- [ ] **Progressive Web App (PWA)** - Installable web app
- [ ] **Real-time Calculation** - AJAX untuk kalkulasi tanpa page reload

---

## 📋 Checklist Pengerjaan

### Backend Development ✅

- [x] Setup structure project
- [x] Buat array data anggota (5 orang)
- [x] Buat array data posisi (5 posisi) dengan detail lengkap
- [x] Buat fungsi `hitungJamLembur()`
- [x] Buat fungsi `hitungUpahJamKerja()`
- [x] Buat fungsi `hitungUpahLembur()`
- [x] Buat fungsi `hitungUpahFee()`
- [x] Buat fungsi `hitungTotalUpah()`
- [x] Implementasi perhitungan otomatis
- [x] Format output rupiah dengan `number_format()`
- [x] Error handling dengan conditional

### Frontend Development ✅

- [x] Buat form input (nama, posisi, jam kerja, harga project)
- [x] Display hasil perhitungan dalam tabel
- [x] Styling CSS/Bootstrap (Bootstrap 5.3)
- [x] Responsive design (3 kolom desktop, 1 kolom mobile)
- [x] Badge posisi dengan color coding
- [x] Sticky sidebar referensi
- [x] Slip gaji profesional dengan tabel bordered
- [x] Validasi client-side dengan Bootstrap validation
- [x] Required indicators (asterisk merah)
- [x] Error messages dengan icon
- [x] Info alerts untuk panduan
- [x] Gradient headers untuk semua card
- [x] Color-coded identity sidebar
- [x] Bootstrap Icons integration

### Documentation ✅

- [x] README.md lengkap dengan:
  - [x] Deskripsi project
  - [x] Fitur-fitur
  - [x] Data tim & posisi
  - [x] Teknologi yang digunakan
  - [x] Struktur project
  - [x] UI/UX features detail
  - [x] Panduan harga project
  - [x] Cara menjalankan
  - [x] Cara menggunakan
  - [x] Contoh perhitungan (3 skenario)
  - [x] Penjelasan fungsi PHP
  - [x] Future enhancements
  - [x] Checklist pengerjaan
  - [x] Known issues
  - [x] Kontak & referensi

---

## 🐛 Known Issues / Limitations

1. **Data Persistence** - Data tidak tersimpan (hilang setelah refresh page)
2. **No Database** - Belum menggunakan database untuk menyimpan riwayat
3. **No Export Feature** - Belum ada fitur export ke PDF/Excel
4. **No History** - Belum ada riwayat perhitungan gaji sebelumnya
5. **Print Styling** - Belum optimal untuk print preview (CSS @media print)
6. **Currency Input** - Belum ada auto-format ribuan saat user mengetik
7. **No Session** - Tidak ada sistem login/session management
8. **Static Data** - Data anggota & posisi masih hardcoded dalam PHP array
9. **No Email** - Belum ada fitur kirim slip gaji via email
10. **Single Calculation** - Hanya bisa hitung 1 karyawan per submit

---

## 👨‍💻 Pengembang

**Nama**: Reza Asriano Maulana  
**NIM**: 202404021  
**Mata Kuliah**: Workshop Pemrograman Web 2  
**Prodi**: Teknologi Rekayasa Perangkat Lunak  
**Semester**: 3 (Tiga)  
**Dosen Pengampu**: Ricak Agus Setiawan, S.T., M.SI.  
**Institusi**: Politeknik Enjinering Indorama  
**Tahun Akademik**: Ganjil 2025/2026

---

## 📄 Lisensi

Project ini dibuat untuk keperluan akademik (UTS) dan tidak dimaksudkan untuk penggunaan komersial tanpa izin.

---

## 📞 Kontak & Dukungan

Jika ada pertanyaan, saran, atau menemukan bug:

1. **GitHub Issues**: [Open Issue](https://github.com/CallMeJaja/workshop-pemrograman-web2/issues)
2. **Email**: [Contact via GitHub](https://github.com/CallMeJaja)
3. **Pull Requests**: Contributions are welcome!

---

## 📚 Referensi & Resources

### Official Documentation

- [PHP Official Documentation](https://www.php.net/docs.php)
- [Bootstrap 5.3 Documentation](https://getbootstrap.com/docs/5.3/getting-started/introduction/)
- [Bootstrap Icons](https://icons.getbootstrap.com/)
- [MDN Web Docs - HTML/CSS/JS](https://developer.mozilla.org/)

### Tutorials & Guides

- [W3Schools PHP Tutorial](https://www.w3schools.com/php/)
- [W3Schools Bootstrap 5 Tutorial](https://www.w3schools.com/bootstrap5/)
- [Bootstrap Form Validation](https://getbootstrap.com/docs/5.3/forms/validation/)

### PHP Functions Reference

- [number_format()](https://www.php.net/manual/en/function.number-format.php) - Format angka dengan thousand separator
- [isset()](https://www.php.net/manual/en/function.isset.php) - Check variabel sudah di-set
- [empty()](https://www.php.net/manual/en/function.empty.php) - Check variabel kosong

### UI/UX Inspiration

- [Bootstrap Examples](https://getbootstrap.com/docs/5.3/examples/)
- [Dribbble](https://dribbble.com/) - UI/UX design inspiration
- [Behance](https://www.behance.net/) - Web design showcase

---

<div align="center">

## ⭐ Star This Project!

**Jika project ini membantu Anda, berikan star di GitHub!**

[![GitHub stars](https://img.shields.io/github/stars/CallMeJaja/workshop-pemrograman-web2?style=social)](https://github.com/CallMeJaja/workshop-pemrograman-web2/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/CallMeJaja/workshop-pemrograman-web2?style=social)](https://github.com/CallMeJaja/workshop-pemrograman-web2/network/members)

---

Made with ❤️ and ☕ for **UTS Workshop Pemrograman Web 2**

**© 2025 Reza Asriano Maulana - Politeknik Enjinering Indorama**

</div>
