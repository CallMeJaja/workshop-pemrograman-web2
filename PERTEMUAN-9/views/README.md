# Views: Lapisan Presentasi dan Antarmuka Pengguna

## Pendahuluan

Dalam arsitektur MVC, **View** bertanggung jawab untuk menampilkan data kepada pengguna [1]. Folder `views/` berisi semua file presentasi yang menangani rendering HTML dan interaksi visual. View menerima data dari Controller dan menampilkannya dalam format yang user-friendly.

## Konsep View dalam MVC

Menurut Fowler [2], View seharusnya:
- **Passive**: Hanya menampilkan data, tidak memproses logika bisnis
- **Stateless**: Tidak menyimpan state aplikasi
- **Decoupled**: Tidak bergantung langsung pada Model atau database

## Struktur Folder

```
views/
├── auth/           # Halaman autentikasi
│   └── index.php   # Form login
├── dashboard/      # Halaman dashboard
│   └── index.php   # Dashboard utama
├── dosen/          # CRUD Data Dosen
│   ├── index.php   # Daftar dosen
│   ├── add.php     # Tambah dosen
│   ├── edit.php    # Edit dosen
│   └── delete.php  # Hapus dosen
├── mahasiswa/      # CRUD Data Mahasiswa
│   ├── index.php   # Daftar mahasiswa
│   ├── add.php     # Tambah mahasiswa
│   ├── edit.php    # Edit mahasiswa
│   └── delete.php  # Hapus mahasiswa
├── matkul/         # CRUD Data Mata Kuliah
│   ├── index.php   # Daftar matkul
│   ├── add.php     # Tambah matkul
│   ├── edit.php    # Edit matkul
│   └── delete.php  # Hapus matkul
└── nilai/          # CRUD Data Nilai
    ├── index.php   # Daftar nilai
    ├── add.php     # Input nilai
    ├── edit.php    # Edit nilai
    └── delete.php  # Hapus nilai
```

## Modul-Modul View

### 1. Auth Module

Menangani autentikasi pengguna dengan form login responsif.

| File | Fungsi |
|------|--------|
| `index.php` | Form login dengan validasi |

### 2. Dashboard Module

Menampilkan ringkasan data dan statistik sistem.

### 3. CRUD Modules (Dosen, Mahasiswa, Matkul, Nilai)

Setiap modul CRUD memiliki 4 file standar:

| File | HTTP Method | Fungsi |
|------|-------------|--------|
| `index.php` | GET | Menampilkan daftar data |
| `add.php` | GET/POST | Form & proses tambah data |
| `edit.php` | GET/POST | Form & proses edit data |
| `delete.php` | POST | Proses hapus data |

## Pola Desain View

### Template Inheritance

Setiap view menggunakan header dan footer dari `includes/`:

```php
<?php
$pageTitle = 'Data Dosen - SIAKAD';
require_once __DIR__ . '/../includes/header.php';
?>

<main class="container my-4">
    <!-- Konten halaman -->
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
```

### Role-Based UI

View menyesuaikan tampilan berdasarkan role pengguna [3]:

```php
<?php if (isDosen()): ?>
    <a href="add.php" class="btn btn-primary">
        <i class="bi bi-plus"></i> Tambah Data
    </a>
<?php endif; ?>
```

### Bootstrap Components

View menggunakan komponen Bootstrap 5 [4]:
- **Cards**: Container untuk konten
- **Tables**: Menampilkan data tabular
- **Forms**: Input data dengan validasi
- **Alerts**: Feedback messages
- **Badges**: Status indicators

## Keamanan View

### 1. XSS Prevention

Semua output di-escape dengan `htmlspecialchars()` [5]:

```php
<td><?= htmlspecialchars($dosen['nama']) ?></td>
```

### 2. CSRF Protection

Setiap form menyertakan CSRF token:

```php
<form method="POST">
    <?= csrfField() ?>
    <!-- form fields -->
</form>
```

### 3. Access Control

View memeriksa izin akses sebelum rendering [6]:

```php
<?php
requireLogin();
requireRole('dosen');
?>
```

## Kesimpulan

Folder `views/` mengimplementasikan lapisan presentasi yang terstruktur dan aman. Dengan menggunakan template inheritance, role-based UI, dan praktik keamanan standar, aplikasi memberikan pengalaman pengguna yang konsisten dan terlindungi.

---

## Referensi

[1] E. Gamma et al., *Design Patterns*. Addison-Wesley, 1994.

[2] M. Fowler, *Patterns of Enterprise Application Architecture*. Addison-Wesley, 2002.

[3] D. Ferraiolo et al., "RBAC Standard," *ACM TISSEC*, vol. 4, no. 3, 2001.

[4] Bootstrap Team, "Bootstrap 5 Documentation," getbootstrap.com, 2023.

[5] OWASP, "XSS Prevention Cheat Sheet," 2023.

[6] OWASP, "Authorization Cheat Sheet," 2023.

---

*Dokumentasi untuk Workshop Pemrograman Web 2 - Pertemuan 9*
