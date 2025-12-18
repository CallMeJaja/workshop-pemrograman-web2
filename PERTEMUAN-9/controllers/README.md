# Controllers: Pengelolaan Logika Bisnis dalam Arsitektur MVC

## Pendahuluan

Dalam pengembangan aplikasi web modern, pemisahan antara logika bisnis, tampilan, dan data merupakan praktik terbaik yang umum digunakan [1]. Pola arsitektur **Model-View-Controller (MVC)** pertama kali diperkenalkan oleh Trygve Reenskaug di Xerox PARC pada tahun 1979 dan telah menjadi standar dalam pengembangan perangkat lunak berorientasi objek [2]. Folder `controllers/` dalam proyek ini berisi implementasi lapisan **Controller** yang berfungsi sebagai perantara antara Model dan View.

## Konsep Controller dalam MVC

Controller bertanggung jawab untuk menerima input dari pengguna, memprosesnya menggunakan Model, dan menentukan View mana yang akan ditampilkan [3]. Dalam konteks aplikasi PHP, Controller bertugas menangani *HTTP request*, memvalidasi data, memanggil operasi pada Model, dan mengembalikan respons yang sesuai kepada pengguna.

Menurut Fowler [4], Controller memiliki tiga tanggung jawab utama:
1. Menerima dan menginterpretasikan input pengguna
2. Berkomunikasi dengan Model untuk mengambil atau memodifikasi data
3. Menyeleksi View yang tepat untuk menampilkan hasil

## Struktur File dalam Folder Controllers

Folder ini terdiri dari lima file controller utama yang mengelola entitas berbeda dalam sistem:

| File | Deskripsi | Entitas yang Dikelola |
|------|-----------|----------------------|
| `AuthController.php` | Menangani autentikasi dan manajemen sesi pengguna | User Session |
| `DosenController.php` | Operasi CRUD untuk data dosen | Dosen |
| `MahasiswaController.php` | Operasi CRUD untuk data mahasiswa | Mahasiswa |
| `MatkulController.php` | Operasi CRUD untuk mata kuliah | Mata Kuliah |
| `NilaiController.php` | Operasi CRUD untuk data nilai | Nilai |

## Implementasi Pola Controller

### 1. AuthController

`AuthController` menangani proses autentikasi menggunakan mekanisme *session-based authentication* [5]. Controller ini menyediakan fungsi:

- **`index()`**: Menampilkan halaman login
- **`login()`**: Memproses kredensial dan membuat sesi
- **`logout()`**: Menghapus sesi pengguna
- **`checkLogin()`**: *Middleware* untuk proteksi route

```php
public function login()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user = $this->userModel->login($username, $password);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            // Redirect berdasarkan role
        }
    }
}
```

### 2. CRUD Controllers (Dosen, Mahasiswa, Matkul, Nilai)

Keempat controller lainnya mengimplementasikan pola **CRUD (Create, Read, Update, Delete)** yang merupakan operasi dasar dalam manajemen data [6]. Setiap controller memiliki method standar:

| Method | HTTP Action | Fungsi |
|--------|-------------|--------|
| `index()` | GET | Menampilkan daftar data |
| `create()` | GET | Menampilkan form tambah |
| `store()` | POST | Menyimpan data baru |
| `edit()` | GET | Menampilkan form edit |
| `update()` | POST | Memperbarui data |
| `destroy()` | POST | Menghapus data |

### 3. Validasi Input

Setiap controller menggunakan class `Validator` untuk memastikan integritas data sebelum disimpan ke database [7]. Validasi mencakup:

- **Required fields**: Memastikan field wajib tidak kosong
- **Numeric validation**: Memastikan format angka
- **Email validation**: Memastikan format email valid
- **Range validation**: Memastikan nilai dalam rentang tertentu

```php
$validator = new Validator($input);
$validator
    ->required('nama', 'Nama wajib diisi!')
    ->email('email', 'Format email tidak valid!')
    ->numeric('nilai', 'Nilai harus berupa angka!');
```

### 4. Proteksi CSRF

Semua operasi yang mengubah data diproteksi dengan **CSRF Token** (*Cross-Site Request Forgery*) [8]. Token diverifikasi sebelum operasi dilakukan:

```php
if (!verifyCsrfToken($input['csrf_token'])) {
    return ['success' => false, 'errors' => ['Token tidak valid!']];
}
```

## Pola Desain yang Digunakan

### Dependency Injection

Controller menggunakan *Constructor Dependency Injection* untuk menginstansiasi Model [9]:

```php
public function __construct()
{
    $this->conn = getConnection();
    $this->model = new Dosen($this->conn);
}
```

### Repository Pattern

Model berfungsi sebagai *Repository* yang mengabstraksi akses data dari Controller [10], memungkinkan Controller fokus pada logika bisnis tanpa perlu mengetahui detail implementasi database.

## Diagram Alur Data

```
┌─────────────┐     ┌─────────────┐     ┌─────────────┐
│   Request   │────▶│ Controller  │────▶│    Model    │
│   (User)    │     │             │     │  (Database) │
└─────────────┘     └──────┬──────┘     └──────┬──────┘
                           │                   │
                           ▼                   │
                    ┌─────────────┐            │
                    │    View     │◀───────────┘
                    │  (Response) │
                    └─────────────┘
```

## Penanganan Error

Controller mengimplementasikan penanganan error yang konsisten dengan mengembalikan array asosiatif:

```php
// Sukses
return ['success' => true, 'message' => 'Data berhasil disimpan!'];

// Gagal
return ['success' => false, 'errors' => ['Pesan error...']];
```

## Kesimpulan

Implementasi Controller dalam proyek ini mengikuti praktik terbaik dalam pengembangan aplikasi web MVC. Dengan memisahkan logika bisnis ke dalam Controller, aplikasi menjadi lebih mudah dipelihara, diuji, dan dikembangkan. Setiap Controller memiliki tanggung jawab yang jelas dan terdefinisi dengan baik, sesuai dengan prinsip *Single Responsibility Principle* (SRP) [11].

---

## Referensi

[1] E. Gamma, R. Helm, R. Johnson, and J. Vlissides, *Design Patterns: Elements of Reusable Object-Oriented Software*. Boston, MA, USA: Addison-Wesley, 1994.

[2] T. Reenskaug, "Models-Views-Controllers," Xerox PARC, Tech. Note, Dec. 1979.

[3] M. Fowler, *Patterns of Enterprise Application Architecture*. Boston, MA, USA: Addison-Wesley, 2002.

[4] M. Fowler, "GUI Architectures," martinfowler.com, Jul. 2006. [Online]. Available: https://martinfowler.com/eaaDev/uiArchs.html

[5] F. Johansson, "Session Management in Web Applications," *IEEE Security & Privacy*, vol. 12, no. 5, pp. 38-44, Sep.-Oct. 2014.

[6] J. Martin, *Managing the Data-base Environment*. Upper Saddle River, NJ, USA: Prentice-Hall, 1983.

[7] OWASP Foundation, "Input Validation Cheat Sheet," OWASP, 2023. [Online]. Available: https://cheatsheetseries.owasp.org/cheatsheets/Input_Validation_Cheat_Sheet.html

[8] OWASP Foundation, "Cross-Site Request Forgery Prevention Cheat Sheet," OWASP, 2023. [Online]. Available: https://cheatsheetseries.owasp.org/cheatsheets/Cross-Site_Request_Forgery_Prevention_Cheat_Sheet.html

[9] R. C. Martin, *Clean Code: A Handbook of Agile Software Craftsmanship*. Upper Saddle River, NJ, USA: Prentice Hall, 2008.

[10] E. Evans, *Domain-Driven Design: Tackling Complexity in the Heart of Software*. Boston, MA, USA: Addison-Wesley, 2003.

[11] R. C. Martin, "The Single Responsibility Principle," in *Agile Software Development, Principles, Patterns, and Practices*. Upper Saddle River, NJ, USA: Prentice Hall, 2002, ch. 8, pp. 95-98.

---

*Dokumentasi ini dibuat untuk Workshop Pemrograman Web 2 - Pertemuan 9*
