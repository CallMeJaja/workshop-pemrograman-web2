# Nilai Views: Manajemen Data Nilai Mahasiswa

## Pendahuluan

Modul Nilai mengelola pencatatan hasil belajar mahasiswa [1]. Modul ini memiliki relasi dengan tiga entitas: Mahasiswa, Mata Kuliah, dan Dosen.

## Struktur File

| File | Method | Fungsi |
|------|--------|--------|
| `index.php` | GET | Daftar nilai dengan relasi |
| `add.php` | GET/POST | Input nilai baru |
| `edit.php` | GET/POST | Edit nilai |
| `delete.php` | POST | Hapus nilai |

## Field Data Nilai

| Field | Type | Validasi |
|-------|------|----------|
| NIM | FK | Required, Exists |
| Kode MK | FK | Required, Exists |
| NIDN | FK | Auto-filled dari MK |
| Nilai | Integer | Required, 0-100 |
| Nilai Huruf | String | Auto-calculated |

## Relasi Database

```
┌───────────┐   ┌───────────┐   ┌───────────┐
│  Mahasiswa│   │   Nilai   │   │   Matkul  │
│           │   │           │   │           │
│ PK: nim   │◄──┤ FK: nim   │   │ PK: kodeMK│
└───────────┘   │ FK: kodeMK├──►│ FK: nidn  │
                │ FK: nidn  │   └─────┬─────┘
                │    nilai  │         │
                │ nilaiHuruf│   ┌─────▼─────┐
                └───────────┘   │   Dosen   │
                                │ PK: nidn  │
                                └───────────┘
```

## Fitur Khusus

### Auto-Calculate Nilai Huruf

```php
public static function convertToGrade($nilai)
{
    if ($nilai >= 85) return 'A';
    if ($nilai >= 75) return 'B';
    if ($nilai >= 60) return 'C';
    if ($nilai >= 50) return 'D';
    return 'E';
}
```

### Auto-Fill Dosen Pengampu

NIDN otomatis diisi berdasarkan mata kuliah yang dipilih [2].

### Grade Color Badge

```php
switch ($grade) {
    case 'A': return 'bg-success';
    case 'B': return 'bg-primary';
    case 'C': return 'bg-warning';
    case 'D': return 'bg-danger';
    case 'E': return 'bg-dark';
}
```

## Validasi

| Rule | Implementasi |
|------|--------------|
| Range | Nilai 0-100 |
| Required | Semua field wajib |
| Exists | FK harus valid |

## Akses

Hanya role **Dosen** yang dapat mengakses modul ini.

---

## Referensi

[1] Kemendikbud, "Pedoman Penilaian Hasil Belajar," 2020.

[2] M. Fowler, *Patterns of Enterprise Application Architecture*. 2002.

---

*Dokumentasi untuk Workshop Pemrograman Web 2*
