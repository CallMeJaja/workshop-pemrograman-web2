# Mata Kuliah Views: Manajemen Data Mata Kuliah

## Pendahuluan

Modul Mata Kuliah mengelola data perkuliahan yang ditawarkan oleh institusi [1]. Setiap mata kuliah memiliki relasi dengan Dosen sebagai pengampu.

## Struktur File

| File | Method | Fungsi |
|------|--------|--------|
| `index.php` | GET | Daftar mata kuliah |
| `add.php` | GET/POST | Tambah matkul |
| `edit.php` | GET/POST | Edit matkul |
| `delete.php` | POST | Hapus matkul |

## Field Data Mata Kuliah

| Field | Type | Validasi |
|-------|------|----------|
| Kode MK | String | Required, Unique |
| Nama MK | String | Required |
| SKS | Integer | Required, Numeric |
| NIDN Pengampu | FK | Required, Exists in tbl_dosen |

## Relasi Database

```
┌─────────────┐       ┌─────────────┐
│  tbl_dosen  │       │ tbl_matkul  │
│             │       │             │
│ PK: nidn    │◄──────┤ FK: nidn    │
│    nama     │       │ PK: kodeMK  │
│    email    │       │    namaMK   │
└─────────────┘       │    sks      │
                      └─────────────┘
```

## Fitur Khusus

### Dropdown Dosen Pengampu

Form add/edit menampilkan dropdown dosen dari database:

```php
<select name="nidn" required>
    <?php foreach ($dosen as $d): ?>
        <option value="<?= $d['nidn'] ?>">
            <?= htmlspecialchars($d['nama']) ?>
        </option>
    <?php endforeach; ?>
</select>
```

### Display Nama Dosen

Index menampilkan nama dosen (bukan NIDN) untuk readability:

```php
<td><?= htmlspecialchars($mk['nama_dosen']) ?></td>
```

## Akses Role-Based

| Fitur | Dosen | Mahasiswa |
|-------|:-----:|:---------:|
| Lihat daftar | ✅ | ✅ |
| CRUD | ✅ | ❌ |

## Constraint Handling

Delete matkul akan gagal jika masih ada data nilai terkait [2].

---

## Referensi

[1] Kemendikbud, "Pedoman Kurikulum Pendidikan Tinggi," 2020.

[2] E. F. Codd, "Relational Database Constraints," *CACM*, 1970.

---

*Dokumentasi untuk Workshop Pemrograman Web 2*
