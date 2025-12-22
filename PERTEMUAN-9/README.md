# SIAKAD Kampus: Sistem Informasi Akademik

Aplikasi web untuk manajemen data akademik kampus yang dikembangkan menggunakan PHP Native dan Bootstrap 5. Project ini merupakan bagian dari materi Workshop Pemrograman Web 2 - Pertemuan 9.

## Pendahuluan

Sistem Informasi Akademik (SIAKAD) merupakan aplikasi yang mengelola data akademik institusi pendidikan tinggi [1]. Aplikasi ini mengimplementasikan arsitektur **Model-View-Controller (MVC)** yang memisahkan logika bisnis, presentasi, dan akses data [2].

---

## 📋 Fitur Utama

| Modul | Deskripsi | Akses Dosen | Akses Mahasiswa |
|-------|-----------|:-----------:|:---------------:|
| Dashboard | Ringkasan statistik data | ✅ | ✅ |
| Data Dosen | CRUD data dosen + Foto | ✅ Full CRUD | ❌ |
| Data Mahasiswa | CRUD data mahasiswa + Foto | ✅ Full CRUD | ✅ View Only |
| Mata Kuliah | CRUD data matkul | ✅ Full CRUD | ✅ View Only |
| Data Nilai | Input dan kelola nilai | ✅ Full CRUD | ❌ |

---

## ⚙️ Persyaratan Sistem

- Web Server (XAMPP, Laragon, atau PHP built-in server)
- PHP 7.4 atau lebih baru
- MySQL / MariaDB 10.x

---

## 🚀 Cara Instalasi

1. **Download/Clone Project**
   
   **Opsi A: Download ZIP (Rekomendasi)**
   - Download file [`TUGAS_PART13_UPLOAD_FOTO_WEB_REZA.zip`](https://github.com/CallMeJaja/workshop-pemrograman-web2/blob/master/PERTEMUAN-9/TUGAS_PART13_UPLOAD_FOTO_WEB_REZA.zip) yang sudah disediakan
   - Extract ke folder `htdocs` (XAMPP) atau folder web server Anda
   
   **Opsi B: Clone Repository**
   ```bash
   git clone https://github.com/CallMeJaja/workshop-pemrograman-web2.git
   cd workshop-pemrograman-web2/PERTEMUAN-9
   ```

2. **Buat Database**
   ```sql
   CREATE DATABASE kampus;
   ```

3. **Import Database**
   ```bash
   mysql -u root -p kampus < dump-kampus-202512221803.sql
   ```

4. **Konfigurasi Koneksi** (`config/database.php`)
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'kampus');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   ```

5. **Jalankan Aplikasi**
   ```bash
   php -S localhost:80
   ```
   Akses: `http://localhost/`

---

## 🔐 Akun Demo

| Username | Password | Role |
|----------|----------|------|
| 1011 | dosen123 | Dosen |
| 2024021 | mhs123 | Mahasiswa |

---

## 📂 Struktur Folder

```
PERTEMUAN-9/
├── config/             # Konfigurasi database
│   └── database.php
├── controllers/        # Logic bisnis (MVC Controller)
│   ├── AuthController.php
│   ├── DosenController.php
│   ├── MahasiswaController.php
│   ├── MatkulController.php
│   └── NilaiController.php
├── core/               # Class inti aplikasi
│   ├── Model.php       # Base model
│   └── Validator.php   # Validasi input
├── helpers/            # Fungsi utilitas
│   ├── auth.php        # RBAC helper
│   ├── csrf.php        # CSRF protection
│   ├── flash.php       # Flash messages
│   └── upload.php      # File upload handler
├── includes/           # Layout templates
│   ├── header.php
│   └── footer.php
├── models/             # Akses database (MVC Model)
│   ├── User.php
│   ├── Dosen.php
│   ├── Mahasiswa.php
│   ├── Matkul.php
│   └── Nilai.php
├── views/              # Antarmuka pengguna (MVC View)
│   ├── auth/
│   ├── dashboard/
│   ├── dosen/
│   ├── mahasiswa/
│   ├── matkul/
│   └── nilai/
├── upload/             # Folder upload file
│   └── profile/
│       ├── dosen/      # Foto profil dosen
│       └── mahasiswa/  # Foto profil mahasiswa
├── index.php           # Entry point (Front Controller)
└── dump-kampus-*.sql   # Database dump
```

---

## 🔄 Sistem Routing (Front Controller)

Aplikasi menggunakan **Front Controller Pattern** [3] dengan `index.php` sebagai entry point tunggal.

### URL Structure

```
index.php?modul={modul}&fitur={fitur}
```

### Daftar Routes

| URL | Controller | Method |
|-----|------------|--------|
| `?modul=auth` | AuthController | index() |
| `?modul=auth&fitur=login` | AuthController | login() |
| `?modul=auth&fitur=logout` | AuthController | logout() |
| `?modul=dashboard` | - | views/dashboard/index.php |
| `?modul=dosen&fitur=*` | DosenController | {fitur}() |
| `?modul=mahasiswa&fitur=*` | MahasiswaController | {fitur}() |
| `?modul=matkul&fitur=*` | MatkulController | {fitur}() |
| `?modul=nilai&fitur=*` | NilaiController | {fitur}() |

### Flow Diagram

```
HTTP Request
     │
     ▼
┌─────────────┐
│  index.php  │ ──► Parse modul & fitur
└──────┬──────┘
       │
  ┌────┴────┐
  │ Auth?   │
  └────┬────┘
   Yes │   No
       │    └──► checkLogin() ──► Load Controller
       ▼
  AuthController
```

---

## 🗄️ Database Schema

### Entity Relationship Diagram

```
┌─────────────────┐
│    tbl_user     │
│─────────────────│
│ PK: id          │
│    username     │
│    password     │
│    role         │
└─────────────────┘

┌─────────────────┐         ┌─────────────────┐
│   tbl_dosen     │         │  tbl_mahasiswa  │
│─────────────────│         │─────────────────│
│ PK: nidn        │◄──┐     │ PK: nim         │◄──┐
│    nama         │   │     │    nama         │   │
│    prodi        │   │     │    prodi        │   │
│    email        │   │     │    angkatan     │   │
└────────┬────────┘   │     │    email        │   │
         │            │     └────────┬────────┘   │
         ▼            │              │            │
┌─────────────────┐   │              │            │
│   tbl_matkul    │   │              │            │
│─────────────────│   │              │            │
│ PK: kodeMatkul  │◄──┼──────────────┼────────┐   │
│    namaMatkul   │   │              │        │   │
│    sks          │   │              │        │   │
│ FK: nidn ───────┼───┘              │        │   │
└────────┬────────┘                  │        │   │
         │     ┌─────────────────┐   │        │   │
         └────►│    tbl_nilai    │   │        │   │
               │ FK: kodeMatkul  │   │        │   │
               │ FK: nim ────────┼───┘        │   │
               │ FK: nidn ───────┼────────────┘   │
               │ PK: id_nilai    │                │
               │    nilai        │                │
               │    nilaiHuruf   │                │
               └─────────────────┘
```

### Tabel Database

#### tbl_user
| Column | Type | Constraint |
|--------|------|------------|
| id | INT(11) | PK, AUTO_INCREMENT |
| username | VARCHAR(100) | UNIQUE |
| password | VARCHAR(100) | NOT NULL |
| role | VARCHAR(100) | 'dosen'/'mahasiswa' |

#### tbl_dosen
| Column | Type | Constraint |
|--------|------|------------|
| nidn | INT(11) | PK |
| nama | VARCHAR(120) | - |
| prodi | VARCHAR(120) | - |
| email | CHAR(50) | - |
| foto | VARCHAR(255) | Nullable |

#### tbl_mahasiswa
| Column | Type | Constraint |
|--------|------|------------|
| nim | INT(11) | PK |
| nama | VARCHAR(120) | - |
| prodi | VARCHAR(120) | - |
| angkatan | INT(11) | - |
| email | CHAR(50) | - |
| foto | VARCHAR(255) | Nullable |

#### tbl_matkul
| Column | Type | Constraint |
|--------|------|------------|
| kodeMatkul | VARCHAR(10) | PK |
| namaMatkul | VARCHAR(120) | - |
| sks | INT(11) | - |
| nidn | INT(11) | FK → tbl_dosen |

#### tbl_nilai
| Column | Type | Constraint |
|--------|------|------------|
| id_nilai | INT(11) | PK, AUTO_INCREMENT |
| nilai | DOUBLE | 0-100 |
| nilaiHuruf | CHAR(1) | A-E |
| kodeMatkul | VARCHAR(10) | FK → tbl_matkul |
| nim | INT(11) | FK → tbl_mahasiswa |
| nidn | INT(11) | FK → tbl_dosen |

### Konversi Nilai

| Rentang | Grade | Predikat |
|---------|-------|----------|
| 85-100 | A | Sangat Baik |
| 75-84 | B | Baik |
| 60-74 | C | Cukup |
| 50-59 | D | Kurang |
| 0-49 | E | Sangat Kurang |

---

## 🔒 Keamanan

| Fitur | Implementasi |
|-------|--------------|
| Authentication | Session-based login [4] |
| Authorization | Role-Based Access Control [5] |
| CSRF Protection | Synchronizer Token Pattern [6] |
| SQL Injection | Prepared Statements [7] |
| XSS Prevention | htmlspecialchars() output [8] |
| File Upload | MIME validation + unique filename |

---

## 📖 Referensi

[1] Kementerian Pendidikan dan Kebudayaan, "Pedoman Sistem Informasi Akademik," Jakarta, 2020.

[2] T. Reenskaug, "Models-Views-Controllers," Xerox PARC, Tech. Note, Dec. 1979.

[3] M. Fowler, *Patterns of Enterprise Application Architecture*. Boston: Addison-Wesley, 2002.

[4] F. Johansson, "Session Management in Web Applications," *IEEE Security & Privacy*, vol. 12, no. 5, 2014.

[5] D. F. Ferraiolo et al., "Proposed NIST Standard for Role-Based Access Control," *ACM TISSEC*, vol. 4, no. 3, 2001.

[6] OWASP Foundation, "CSRF Prevention Cheat Sheet," 2023. [Online]. Available: https://cheatsheetseries.owasp.org/

[7] OWASP Foundation, "SQL Injection Prevention Cheat Sheet," 2023.

[8] OWASP Foundation, "XSS Prevention Cheat Sheet," 2023.

---

## 👨‍💻 Author

**Reza Asriano Maulana** (202404021)  
Workshop Pemrograman Web 2

---

*© 2025 - Dibuat untuk keperluan pembelajaran*
