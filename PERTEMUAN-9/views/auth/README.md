# Auth Views: Halaman Autentikasi Pengguna

## Pendahuluan

Modul autentikasi merupakan gerbang utama untuk mengakses sistem informasi [1]. Folder `views/auth/` menyediakan antarmuka untuk proses login pengguna ke aplikasi SIAKAD.

## Struktur File

| File | Fungsi |
|------|--------|
| `index.php` | Form login dengan validasi |

## Fitur Halaman Login

### 1. Form Login

Form login mengumpulkan kredensial pengguna:

```html
<form method="POST" action="index.php?modul=auth&fitur=login">
    <input type="text" name="username" required>
    <input type="password" name="password" required>
    <button type="submit">Login</button>
</form>
```

### 2. Validasi Client-Side

Menggunakan atribut HTML5 `required` untuk validasi dasar [2].

### 3. Error Handling

Menampilkan pesan error jika login gagal:

```php
<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
```

### 4. Role-Based Redirect

Setelah login berhasil, pengguna diarahkan ke dashboard sesuai role [3]:
- **Dosen** → Dashboard dengan akses penuh
- **Mahasiswa** → Dashboard dengan akses terbatas

## Keamanan

| Aspek | Implementasi |
|-------|--------------|
| XSS Prevention | `htmlspecialchars()` pada output |
| Session Hijacking | Session regeneration setelah login [4] |
| Brute Force | Validasi server-side |

## UI/UX

- Desain responsif dengan Bootstrap 5
- Card centered layout
- Password field dengan type="password"
- Feedback visual untuk error

---

## Referensi

[1] B. Sullivan and V. Liu, *Web Application Security*. McGraw-Hill, 2012.

[2] W3C, "HTML5 Forms Specification," w3.org, 2023.

[3] D. Ferraiolo et al., "RBAC Standard," *ACM TISSEC*, 2001.

[4] OWASP, "Session Management Cheat Sheet," 2023.

---

*Dokumentasi untuk Workshop Pemrograman Web 2*
