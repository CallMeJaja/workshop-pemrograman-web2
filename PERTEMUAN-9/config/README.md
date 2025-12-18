# Config: Konfigurasi dan Manajemen Koneksi Database

## Pendahuluan

Konfigurasi aplikasi merupakan komponen kritis yang memisahkan parameter deployment dari kode aplikasi [1]. Folder `config/` menyimpan file-file konfigurasi yang mengatur koneksi ke sumber daya eksternal, terutama database. Pemisahan konfigurasi ini memungkinkan aplikasi untuk di-deploy ke berbagai environment (development, staging, production) tanpa mengubah kode sumber [2].

## Struktur File

| File | Fungsi |
|------|--------|
| `database.php` | Konfigurasi koneksi MySQL/MariaDB |

## Konfigurasi Database

### Konstanta Koneksi

File `database.php` mendefinisikan konstanta-konstanta yang diperlukan untuk koneksi database menggunakan `define()`:

```php
define('DB_HOST', 'localhost');      // Server database
define('DB_NAME', 'kampus');         // Nama database
define('DB_USER', 'root');           // Username
define('DB_PASS', '');               // Password
define('DB_CHARSET', 'utf8mb4');     // Character encoding
```

Penggunaan konstanta memberikan beberapa keuntungan [3]:
- **Immutability**: Nilai tidak dapat diubah setelah didefinisikan
- **Global Scope**: Dapat diakses dari seluruh aplikasi
- **Performance**: Lebih cepat dibanding variabel biasa

### Character Encoding: UTF8MB4

Aplikasi menggunakan `utf8mb4` sebagai character set default. Menurut dokumentasi MySQL [4], `utf8mb4` adalah encoding UTF-8 yang lengkap, mendukung:
- Full Unicode support (termasuk emoji)
- 4-byte characters
- Backward compatible dengan utf8

## Singleton Pattern untuk Koneksi

Fungsi `getConnection()` mengimplementasikan **Singleton Pattern** [5] untuk memastikan hanya satu koneksi database yang dibuat selama siklus request:

```php
function getConnection()
{
    static $conn = null;  // Static variable persist across calls

    if ($conn === null) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $conn->set_charset(DB_CHARSET);
    }

    return $conn;
}
```

### Keuntungan Singleton Pattern

| Aspek | Penjelasan |
|-------|------------|
| **Resource Efficiency** | Menghindari multiple koneksi yang tidak perlu |
| **Performance** | Reuse koneksi existing lebih cepat |
| **Consistency** | Semua bagian aplikasi menggunakan koneksi yang sama |
| **Connection Pooling Friendly** | Kompatibel dengan connection pooling [6] |

## Error Handling

Koneksi database dilindungi dengan exception handling:

```php
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}
```

Menurut Zandstra [7], penanganan error yang baik harus:
1. **Fail Fast**: Segera hentikan eksekusi jika koneksi gagal
2. **Informative**: Berikan pesan error yang berguna untuk debugging
3. **Secure**: Jangan tampilkan detail sensitif ke end-user

## Penutupan Koneksi

Fungsi `closeConnection()` disediakan untuk menutup koneksi secara eksplisit:

```php
function closeConnection()
{
    $conn = getConnection();
    if ($conn) {
        $conn->close();
    }
}
```

> **Catatan**: PHP secara otomatis menutup koneksi di akhir script, namun explicit closing merupakan good practice terutama untuk long-running scripts [8].

## Best Practices Keamanan

### 1. Kredensial Tidak Di-Hardcode (Rekomendasi)

Untuk production environment, disarankan menggunakan environment variables [9]:

```php
// Rekomendasi untuk production
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'kampus');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
```

### 2. File .gitignore

Untuk keamanan, file konfigurasi dengan kredensial sensitif sebaiknya tidak di-commit ke repository:

```gitignore
# Contoh .gitignore
config/database.php
```

Gunakan file template seperti `database.example.php` sebagai referensi.

## Diagram Arsitektur Koneksi

```
┌─────────────────┐
│   Application   │
│    (index.php)  │
└────────┬────────┘
         │ require_once
         ▼
┌─────────────────┐
│   database.php  │
│  ┌───────────┐  │
│  │ Constants │  │
│  │ DB_HOST   │  │
│  │ DB_NAME   │  │
│  │ DB_USER   │  │
│  │ DB_PASS   │  │
│  └───────────┘  │
│                 │
│ getConnection() │──────┐
└─────────────────┘      │
                         │ mysqli
                         ▼
                  ┌─────────────┐
                  │   MySQL /   │
                  │  MariaDB    │
                  │   Server    │
                  └─────────────┘
```

## Kesimpulan

Folder `config/` menyediakan lapisan abstraksi untuk parameter koneksi database. Dengan menggunakan konstanta dan Singleton Pattern, aplikasi dapat mengelola koneksi database secara efisien dan aman. Untuk deployment ke production, disarankan untuk mengadopsi environment variables dan memastikan file konfigurasi tidak ter-expose ke public.

---

## Referensi

[1] M. Fowler, "Configuration," martinfowler.com, 2012. [Online]. Available: https://martinfowler.com/bliki/Configuration.html

[2] A. Wiggins, "The Twelve-Factor App: III. Config," 12factor.net, 2017. [Online]. Available: https://12factor.net/config

[3] PHP Documentation, "Constants," php.net, 2023. [Online]. Available: https://www.php.net/manual/en/language.constants.php

[4] MySQL Documentation, "The utf8mb4 Character Set," dev.mysql.com, 2023. [Online]. Available: https://dev.mysql.com/doc/refman/8.0/en/charset-unicode-utf8mb4.html

[5] E. Gamma, R. Helm, R. Johnson, and J. Vlissides, *Design Patterns: Elements of Reusable Object-Oriented Software*. Boston, MA, USA: Addison-Wesley, 1994.

[6] Oracle Corporation, "Connection Pooling with PHP," oracle.com, 2020. [Online]. Available: https://www.oracle.com/technical-resources/articles/php/underground-php-oracle-connection-pool.html

[7] M. Zandstra, *PHP 8 Objects, Patterns, and Practice*, 6th ed. New York, NY, USA: Apress, 2021.

[8] PHP Documentation, "Persistent Database Connections," php.net, 2023. [Online]. Available: https://www.php.net/manual/en/features.persistent-connections.php

[9] OWASP Foundation, "Configuration and Deployment Management," OWASP, 2023. [Online]. Available: https://cheatsheetseries.owasp.org/cheatsheets/Configuration_and_Deployment_Cheat_Sheet.html

---

*Dokumentasi ini dibuat untuk Workshop Pemrograman Web 2 - Pertemuan 9*
