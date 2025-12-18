# Helpers: Fungsi Utilitas dan Keamanan Aplikasi

## Pendahuluan

Dalam pengembangan aplikasi web, terdapat kebutuhan akan fungsi-fungsi umum yang dapat digunakan di berbagai bagian aplikasi [1]. Folder `helpers/` menyimpan koleksi *utility functions* yang menyediakan fungsionalitas lintas-modul, termasuk autentikasi, proteksi keamanan, dan manajemen pesan. Pendekatan ini mengikuti prinsip **DRY (Don't Repeat Yourself)** yang menghindari duplikasi kode [2].

## Struktur File

| File | Fungsi | Kategori |
|------|--------|----------|
| `auth.php` | Role-Based Access Control | Autentikasi |
| `csrf.php` | Proteksi Cross-Site Request Forgery | Keamanan |
| `flash.php` | Session-based Flash Messages | UI/UX |

---

## 1. Auth Helper (`auth.php`)

### Konsep Role-Based Access Control (RBAC)

File `auth.php` mengimplementasikan sistem **RBAC** yang mengontrol akses pengguna berdasarkan peran (role) mereka [3]. Dalam konteks aplikasi ini, terdapat dua role:

| Role | Deskripsi | Hak Akses |
|------|-----------|-----------|
| `dosen` | Tenaga pengajar | Full CRUD, akses semua modul |
| `mahasiswa` | Peserta didik | Read-only, modul terbatas |

### Fungsi-Fungsi Autentikasi

```php
// Status Login
function isLoggedIn();      // Cek apakah user sudah login
function getRole();         // Ambil role user saat ini  
function getUsername();     // Ambil username

// Role Checking
function isDosen();         // True jika role = dosen
function isMahasiswa();     // True jika role = mahasiswa

// Access Control
function requireLogin();    // Redirect jika belum login
function requireRole($roles); // Redirect jika role tidak sesuai
function canAccess($modul); // Cek akses ke modul tertentu
function canCRUD();         // Cek apakah bisa melakukan CRUD
```

### Implementasi RBAC

```php
function requireRole($allowedRoles)
{
    requireLogin();  // Pastikan sudah login
    
    $currentRole = getRole();
    if (!in_array($currentRole, $allowedRoles)) {
        // Set flash message dan redirect
        header('Location: /index.php?modul=dashboard');
        exit;
    }
}
```

### Matriks Akses Modul

Berdasarkan implementasi `canAccess()`:

| Modul | Dosen | Mahasiswa |
|-------|:-----:|:---------:|
| Dashboard | ✅ | ✅ |
| Data Dosen | ✅ | ❌ |
| Data Mahasiswa | ✅ | ✅ (Read) |
| Mata Kuliah | ✅ | ✅ (Read) |
| Data Nilai | ✅ | ❌ |

---

## 2. CSRF Helper (`csrf.php`)

### Apa itu CSRF?

**Cross-Site Request Forgery (CSRF)** adalah serangan yang memaksa pengguna yang sudah terautentikasi untuk menjalankan aksi tidak diinginkan pada aplikasi web [4]. OWASP mengkategorikan CSRF sebagai salah satu risiko keamanan web paling kritis [5].

### Mekanisme Proteksi

CSRF protection bekerja dengan mekanisme **Synchronizer Token Pattern** [6]:

```
1. Server generate token unik per session
2. Token disisipkan di setiap form (hidden input)
3. Saat form submit, server verifikasi token
4. Jika token tidak valid, request ditolak
```

### Diagram Alur CSRF Protection

```
┌─────────────┐         ┌─────────────┐
│   Browser   │         │   Server    │
└──────┬──────┘         └──────┬──────┘
       │                       │
       │  1. Request Page      │
       │──────────────────────►│
       │                       │
       │  2. Response + Token  │
       │◄──────────────────────│
       │                       │
       │  3. Submit Form       │
       │     + Token           │
       │──────────────────────►│
       │                       │
       │  4. Verify Token      │
       │     If valid: Process │
       │     If invalid: Reject│
       │                       │
```

### Fungsi-Fungsi CSRF

```php
// Generate token baru
function generateCsrfToken();

// Verifikasi token dari request
function verifyCsrfToken($token);

// Generate HTML hidden input
function csrfField();
// Output: <input type="hidden" name="csrf_token" value="...">

// Regenerate setelah form berhasil
function regenerateCsrfToken();
```

### Implementasi Token Generation

```php
function generateCsrfToken()
{
    if (empty($_SESSION['csrf_token'])) {
        // Gunakan random_bytes untuk keamanan kriptografis
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
```

Fungsi `random_bytes()` menghasilkan byte acak yang aman secara kriptografis [7], berbeda dengan `rand()` atau `mt_rand()` yang dapat diprediksi.

### Timing-Safe Comparison

Verifikasi menggunakan `hash_equals()` untuk mencegah **timing attacks** [8]:

```php
function verifyCsrfToken($token)
{
    // hash_equals mencegah timing attack
    return hash_equals($_SESSION['csrf_token'], $token);
}
```

---

## 3. Flash Helper (`flash.php`)

### Konsep Flash Messages

**Flash messages** adalah pesan notifikasi yang hanya ditampilkan sekali setelah aksi tertentu [9]. Pesan disimpan di session dan otomatis dihapus setelah ditampilkan.

### Tipe Pesan

| Type | Penggunaan | Bootstrap Class |
|------|------------|-----------------|
| `success` | Operasi berhasil | `alert-success` |
| `error` | Operasi gagal | `alert-danger` |
| `warning` | Peringatan | `alert-warning` |
| `info` | Informasi umum | `alert-info` |

### Fungsi-Fungsi Flash

```php
// Set pesan ke session
function setFlash($type, $message);

// Ambil dan hapus pesan dari session
function getFlash();

// Tampilkan sebagai HTML Bootstrap Alert
function showFlash();
```

### Alur Flash Message

```
┌─────────────┐    ┌─────────────┐    ┌─────────────┐
│  Controller │───►│   Session   │───►│    View     │
│  setFlash() │    │   Storage   │    │ showFlash() │
└─────────────┘    └─────────────┘    └─────────────┘
                          │
                   Pesan dihapus
                   setelah ditampilkan
```

### Output HTML

Fungsi `showFlash()` menghasilkan Bootstrap Alert:

```html
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-2"></i>
    Data berhasil disimpan!
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
```

---

## Best Practices yang Diterapkan

### 1. Session Safety

Semua helper memeriksa status session sebelum mengaksesnya:

```php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
```

### 2. Output Escaping

Flash messages menggunakan `htmlspecialchars()` untuk mencegah XSS [10]:

```php
echo htmlspecialchars($flash['message']);
```

### 3. Stateless Functions

Helper functions bersifat **stateless** (tidak menyimpan state internal), membuatnya mudah untuk ditest dan diprediksi [11].

## Kesimpulan

Folder `helpers/` menyediakan fondasi keamanan dan utilitas untuk aplikasi SIAKAD. Dengan mengimplementasikan RBAC, CSRF protection, dan flash messages, aplikasi memiliki lapisan keamanan yang kuat dan user experience yang baik. Semua implementasi mengikuti rekomendasi keamanan dari OWASP dan best practices PHP modern.

---

## Referensi

[1] A. Hunt and D. Thomas, *The Pragmatic Programmer: From Journeyman to Master*. Boston, MA, USA: Addison-Wesley, 1999.

[2] R. C. Martin, *Clean Code: A Handbook of Agile Software Craftsmanship*. Upper Saddle River, NJ, USA: Prentice Hall, 2008.

[3] D. F. Ferraiolo, R. Sandhu, S. Gavrila, D. R. Kuhn, and R. Chandramouli, "Proposed NIST Standard for Role-Based Access Control," *ACM Transactions on Information and System Security*, vol. 4, no. 3, pp. 224-274, Aug. 2001.

[4] B. Sullivan and V. Liu, *Web Application Security: A Beginner's Guide*. New York, NY, USA: McGraw-Hill, 2012.

[5] OWASP Foundation, "OWASP Top Ten 2021," OWASP, 2021. [Online]. Available: https://owasp.org/Top10/

[6] OWASP Foundation, "Cross-Site Request Forgery Prevention Cheat Sheet," OWASP, 2023. [Online]. Available: https://cheatsheetseries.owasp.org/cheatsheets/Cross-Site_Request_Forgery_Prevention_Cheat_Sheet.html

[7] PHP Documentation, "random_bytes," php.net, 2023. [Online]. Available: https://www.php.net/manual/en/function.random-bytes.php

[8] C. Percival, "Timing Attacks on Password Hashes," Tarsnap, 2014. [Online]. Available: https://www.tarsnap.com/scrypt/scrypt.pdf

[9] Ruby on Rails Guides, "Action Controller Overview: The Flash," rubyonrails.org, 2023. [Online]. Available: https://guides.rubyonrails.org/action_controller_overview.html#the-flash

[10] OWASP Foundation, "XSS Prevention Cheat Sheet," OWASP, 2023. [Online]. Available: https://cheatsheetseries.owasp.org/cheatsheets/Cross_Site_Scripting_Prevention_Cheat_Sheet.html

[11] E. Elliott, "What is Functional Programming?," *Medium*, Aug. 2017. [Online]. Available: https://medium.com/javascript-scene/master-the-javascript-interview-what-is-functional-programming-7f218c68b3a0

---

*Dokumentasi ini dibuat untuk Workshop Pemrograman Web 2 - Pertemuan 9*
