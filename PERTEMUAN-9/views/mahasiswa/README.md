# Mahasiswa Views: Manajemen Data Mahasiswa

## Pendahuluan

Modul Mahasiswa menyediakan antarmuka untuk mengelola data peserta didik [1]. Folder ini mengimplementasikan operasi CRUD lengkap dengan akses berbeda untuk role Dosen dan Mahasiswa.

## Struktur File

| File | Method | Fungsi |
|------|--------|--------|
| `index.php` | GET | Menampilkan daftar mahasiswa |
| `add.php` | GET/POST | Form & proses tambah |
| `edit.php` | GET/POST | Form & proses edit |
| `delete.php` | POST | Proses hapus |

## Field Data Mahasiswa

| Field | Type | Validasi |
|-------|------|----------|
| NIM | String | Required, Numeric, Unique |
| Nama | String | Required |
| Program Studi | String | Required |
| Angkatan | Integer | Required |
| Email | String | Required, Email format |

## Akses Role-Based

| Fitur | Dosen | Mahasiswa |
|-------|:-----:|:---------:|
| Lihat daftar | ✅ | ✅ |
| Tambah data | ✅ | ❌ |
| Edit data | ✅ | ❌ |
| Hapus data | ✅ | ❌ |

## Implementasi UI

### Conditional Rendering

```php
<?php if (isDosen()): ?>
    <a href="add.php" class="btn btn-primary">
        <i class="bi bi-plus"></i> Tambah Mahasiswa
    </a>
<?php endif; ?>
```

### Tabel Data

```php
<table class="table table-striped">
    <thead>
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Angkatan</th>
            <?php if (isDosen()): ?>
                <th>Aksi</th>
            <?php endif; ?>
        </tr>
    </thead>
</table>
```

## Validasi

### Client-Side
- HTML5 required attribute
- Input type validation

### Server-Side
- Validator class untuk semua field
- Cek duplikasi NIM
- Constraint check saat delete

## Keamanan

- CSRF protection pada form
- XSS prevention dengan escaping
- Access control per halaman

---

## Referensi

[1] Kemendikbud, "Pedoman Pengelolaan Data Mahasiswa," 2020.

[2] OWASP, "Input Validation Cheat Sheet," 2023.

---

*Dokumentasi untuk Workshop Pemrograman Web 2*
