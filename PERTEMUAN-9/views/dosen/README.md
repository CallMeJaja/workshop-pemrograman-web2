# Dosen Views: Manajemen Data Dosen

## Pendahuluan

Modul Dosen menyediakan antarmuka untuk mengelola data tenaga pengajar [1]. Folder ini mengimplementasikan operasi CRUD (Create, Read, Update, Delete) lengkap untuk entitas Dosen.

## Struktur File

| File | Method | Fungsi |
|------|--------|--------|
| `index.php` | GET | Menampilkan daftar dosen |
| `add.php` | GET/POST | Form & proses tambah dosen |
| `edit.php` | GET/POST | Form & proses edit dosen |
| `delete.php` | POST | Proses hapus dosen |

## Alur CRUD

```
┌─────────────┐     ┌─────────────┐     ┌─────────────┐
│  index.php  │────►│   add.php   │────►│  index.php  │
│  (List)     │     │  (Create)   │     │  (Updated)  │
└─────────────┘     └─────────────┘     └─────────────┘
       │
       ▼
┌─────────────┐     ┌─────────────┐
│  edit.php   │────►│  index.php  │
│  (Update)   │     │  (Updated)  │
└─────────────┘     └─────────────┘
       │
       ▼
┌─────────────┐     ┌─────────────┐
│ delete.php  │────►│  index.php  │
│  (Delete)   │     │  (Updated)  │
└─────────────┘     └─────────────┘
```

## Field Data Dosen

| Field | Type | Validasi |
|-------|------|----------|
| NIDN | String | Required, Numeric, Unique |
| Nama | String | Required |
| Email | String | Required, Email format |

## Fitur Halaman

### index.php (Daftar)

- Tabel responsif dengan Bootstrap
- Tombol Tambah, Edit, Hapus
- Badge untuk status/info

### add.php (Tambah)

- Form dengan validasi client-side
- CSRF token protection
- Error message display

### edit.php (Edit)

- Pre-filled form dengan data existing
- NIDN sebagai readonly (primary key)
- Validasi sama dengan add

### delete.php (Hapus)

- Konfirmasi JavaScript sebelum hapus
- Cek constraint (relasi dengan matkul)
- Redirect dengan flash message

## Keamanan

| Aspek | Implementasi |
|-------|--------------|
| CSRF | Token di setiap form [2] |
| XSS | htmlspecialchars() output [3] |
| Access | requireRole('dosen') [4] |

---

## Referensi

[1] J. Martin, *Managing the Database Environment*. Prentice-Hall, 1983.

[2] OWASP, "CSRF Prevention Cheat Sheet," 2023.

[3] OWASP, "XSS Prevention Cheat Sheet," 2023.

[4] D. Ferraiolo et al., "RBAC Standard," *ACM TISSEC*, 2001.

---

*Dokumentasi untuk Workshop Pemrograman Web 2*
