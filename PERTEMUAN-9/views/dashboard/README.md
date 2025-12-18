# Dashboard Views: Halaman Utama dan Ringkasan Data

## Pendahuluan

Dashboard merupakan halaman utama yang menyajikan ringkasan informasi penting kepada pengguna [1]. Folder `views/dashboard/` berisi halaman yang menampilkan statistik dan overview dari seluruh data dalam sistem SIAKAD.

## Struktur File

| File | Fungsi |
|------|--------|
| `index.php` | Halaman dashboard utama |

## Komponen Dashboard

### 1. Statistik Cards

Menampilkan ringkasan jumlah data dalam bentuk cards:

| Card | Ikon | Data |
|------|------|------|
| Total Dosen | `bi-person-badge` | Jumlah dosen |
| Total Mahasiswa | `bi-people` | Jumlah mahasiswa |
| Total Mata Kuliah | `bi-book` | Jumlah matkul |
| Total Nilai | `bi-card-checklist` | Jumlah record nilai |

### 2. Hero Section

Banner informatif dengan gradient background:

```css
.hero-section {
    background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
}
```

### 3. Quick Access Menu

Grid cards untuk navigasi cepat ke modul-modul CRUD.

## Role-Based Display

### Dosen

- Akses ke semua statistik
- Menu lengkap (Dosen, Mahasiswa, Matkul, Nilai)

### Mahasiswa

- Statistik relevan saja
- Menu terbatas (Mahasiswa, Matkul)

## Visualisasi Data

Dashboard dapat menampilkan data dalam format:
- **Summary Cards**: Angka besar dengan ikon
- **Tables**: Data terbaru
- **Quick Links**: Shortcut ke halaman penting

## Best Practices

| Aspek | Implementasi |
|-------|--------------|
| Performance | Query count optimized [2] |
| UX | Above-the-fold statistics [3] |
| Responsive | Bootstrap grid system |

---

## Referensi

[1] S. Few, *Information Dashboard Design*. O'Reilly, 2006.

[2] M. Fowler, *Patterns of Enterprise Application Architecture*. Addison-Wesley, 2002.

[3] J. Nielsen, *Designing Web Usability*. New Riders, 1999.

---

*Dokumentasi untuk Workshop Pemrograman Web 2*
