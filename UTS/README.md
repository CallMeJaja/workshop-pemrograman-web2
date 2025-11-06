# 💼 Sistem Perhitungan Gaji Tim Software

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

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
- ✅ **Validasi Input** - HTML5 validation untuk mencegah input tidak valid
- ✅ **Rincian Detail** - Menampilkan breakdown komponen gaji secara lengkap

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
3. Dhafi Ebsan Yurizal
4. Helgi Nur Allamsyah
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

- **PHP** 7.4+ (Native, no framework)
- **HTML5** - Struktur halaman
- **CSS3** - Styling (opsional)
- **JavaScript** - Validasi client-side (opsional)

---

## 📁 Struktur Project

```
UTS/
├── index.php           # Form input & perhitungan gaji
├── README.md           # Dokumentasi project
├── temp/
│   ├── TODO.md         # Daftar tugas pengerjaan
│   └── requirement.md  # Spesifikasi kebutuhan
└── Module/             # (Module UTS)
```

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

1. Pilih **Nama Anggota** dari dropdown (5 pilihan)
2. Pilih **Posisi** sesuai role (5 pilihan posisi)
3. Masukkan **Jam Kerja** total dalam 1 bulan (contoh: 180 jam)
   - Jam lembur akan **otomatis dihitung** jika > 160 jam
4. Masukkan **Harga Project** (contoh: 10000000)

### **Langkah 2: Submit**

Klik tombol **"Hitung Gaji"** untuk memproses perhitungan

### **Langkah 3: Lihat Hasil**

Sistem akan menampilkan:

- **Data Input:**
  - Nama Anggota
  - Posisi
  - Jam Kerja total
  - Jam Lembur (otomatis dari kelebihan 160 jam)
  - Harga Project
- **Rincian Upah:**
  - Upah dari Jam Kerja (maksimal 160 jam jika ada lembur)
  - Upah dari Jam Lembur (0 jika jam kerja ≤ 160)
  - Upah dari Fee Project
  - **Total Upah** (semua komponen)

---

## 💡 Contoh Perhitungan

### **Skenario 1: Dengan Lembur**

**Input:**

- **Nama**: Reza Asriano Maulana
- **Posisi**: Lead Developer
- **Jam Kerja Total**: 180 jam
- **Harga Project**: Rp 10.000.000

**Proses:**

```
1. Cek Jam Lembur:
   - Jam kerja (180) > 160 → Ada lembur!
   - Jam lembur = 180 - 160 = 20 jam

2. Upah Jam Kerja Normal:
   - Karena ada lembur, max 160 jam
   - Upah = 160 × Rp 450.000 = Rp 72.000.000

3. Upah Lembur:
   - Rate lembur = Rp 450.000 × 18% = Rp 81.000/jam
   - Upah lembur = 20 × Rp 81.000 = Rp 1.620.000

4. Fee Project:
   - Fee = Rp 10.000.000 × 5% = Rp 500.000

5. Total Upah:
   = Rp 72.000.000 + Rp 1.620.000 + Rp 500.000
   = Rp 74.120.000
```

---

### **Skenario 2: Tanpa Lembur**

**Input:**

- **Nama**: Satrio Ilham Syahputra
- **Posisi**: Backend Dev
- **Jam Kerja Total**: 150 jam
- **Harga Project**: Rp 5.000.000

**Proses:**

```
1. Cek Jam Lembur:
   - Jam kerja (150) ≤ 160 → Tidak ada lembur
   - Jam lembur = 0 jam

2. Upah Jam Kerja Normal:
   - Upah = 150 × Rp 300.000 = Rp 45.000.000

3. Upah Lembur:
   - Tidak ada lembur = Rp 0

4. Fee Project:
   - Fee = Rp 5.000.000 × 3% = Rp 150.000

5. Total Upah:
   = Rp 45.000.000 + Rp 0 + Rp 150.000
   = Rp 45.150.000
```

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

- Harga project: Rp 10.000.000
- Persen fee: 5%
- Hasil: `10000000 × 5% = Rp 500.000`

---

### **5. `hitungTotalUpah($upah_jam_kerja, $upah_lembur, $upah_fee)`**

Menghitung total gaji keseluruhan dari semua komponen.

**Rumus**: `upah_jam_kerja + upah_lembur + upah_fee`

**Contoh**: `72000000 + 1620000 + 500000 = Rp 74.120.000`

---

## 🎨 Pengembangan Lebih Lanjut

Beberapa ide untuk meningkatkan aplikasi:

- [ ] **Styling CSS** - Tambahkan desain UI yang lebih menarik (Bootstrap/Tailwind)
- [ ] **Validasi JavaScript** - Validasi form di client-side untuk UX lebih baik
- [ ] **Database** - Simpan history perhitungan gaji (MySQL/PostgreSQL)
- [ ] **Export PDF** - Cetak slip gaji menggunakan library TCPDF/FPDF
- [ ] **Grafik** - Visualisasi perbandingan gaji antar posisi (Chart.js)
- [ ] **PPh21** - Implementasi perhitungan pajak sesuai aturan perpajakan Indonesia
- [ ] **Session/Login** - Multi-user dengan autentikasi
- [ ] **Responsive Design** - Mobile-friendly interface
- [ ] **CRUD Anggota** - Tambah/edit/hapus anggota tim
- [ ] **Report Bulanan** - Rekap gaji seluruh tim per bulan

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
⬜ Styling CSS/Bootstrap  
⬜ Validasi input server-side (PHP)  
⬜ Responsive design  
⬜ Error handling yang lebih baik

---

## 🐛 Known Issues / Limitations

1. **UI/UX** - Masih sangat basic, belum ada styling CSS
2. **Validasi** - Hanya menggunakan HTML5 `required` dan `min` attribute
3. **Server-side Validation** - Belum ada validasi PHP untuk mencegah input invalid
4. **Data Persistence** - Data tidak tersimpan (hilang setelah refresh)
5. **Error Handling** - Belum ada handling untuk error (misal: posisi tidak dipilih)
6. **Responsive** - Belum dioptimasi untuk mobile devices

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
- [W3Schools PHP Tutorial](https://www.w3schools.com/php/)
- [MDN Web Docs](https://developer.mozilla.org/)

---

<div align="center">

**⭐ Jika project ini membantu, berikan star di GitHub! ⭐**

Made with ❤️ for UTS Pemrograman Web 2

</div>
