# Core: Komponen Inti dan Abstraksi Dasar

## Pendahuluan

Dalam pengembangan aplikasi berorientasi objek, diperlukan komponen inti (*core*) yang menyediakan fungsionalitas dasar yang dapat digunakan kembali di seluruh aplikasi [1]. Folder `core/` berisi class-class fundamental yang menjadi fondasi arsitektur aplikasi, termasuk base model untuk akses database dan sistem validasi input.

## Struktur File

| File | Class | Fungsi |
|------|-------|--------|
| `Model.php` | `Model` | Base class untuk semua model database |
| `Validator.php` | `Validator` | Validasi input dengan Fluent Interface |

---

## 1. Base Model (`Model.php`)

### Konsep Base Class

`Model.php` merupakan implementasi dari **Template Method Pattern** [2] yang menyediakan kerangka operasi database umum. Class turunan hanya perlu mendefinisikan `$table` dan method spesifik tambahan.

```php
class Model
{
    protected $conn;    // Koneksi mysqli
    protected $table;   // Nama tabel (didefinisikan subclass)
}
```

### Method-Method Umum

| Method | Return Type | Deskripsi |
|--------|-------------|-----------|
| `getAll($orderBy, $order)` | `array` | Ambil semua record |
| `getByColumn($column, $value)` | `array\|null` | Ambil by kolom tertentu |
| `exists($column, $value)` | `bool` | Cek keberadaan record |
| `deleteByColumn($column, $value)` | `bool` | Hapus by kolom |
| `getError()` | `string` | Ambil pesan error terakhir |

### Inheritance Hierarchy

```
              ┌─────────┐
              │  Model  │  (core/Model.php)
              │  [Base] │
              └────┬────┘
                   │
       ┌───────────┼───────────┬───────────┐
       │           │           │           │
  ┌────┴────┐ ┌────┴────┐ ┌────┴────┐ ┌────┴────┐
  │  Dosen  │ │Mahasiswa│ │  Matkul │ │  Nilai  │
  └─────────┘ └─────────┘ └─────────┘ └─────────┘
```

### Penggunaan Prepared Statements

Base Model menggunakan **Prepared Statements** secara konsisten untuk keamanan [3]:

```php
public function getByColumn($column, $value)
{
    $stmt = $this->conn->prepare(
        "SELECT * FROM {$this->table} WHERE {$column} = ?"
    );
    $stmt->bind_param("s", $value);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
```

### Keuntungan Desain

1. **Code Reuse**: Menghindari duplikasi query dasar di setiap model [4]
2. **Consistency**: Semua model mengikuti pola yang sama
3. **Maintainability**: Perubahan di base class otomatis berlaku untuk semua
4. **Extensibility**: Mudah menambah method baru

---

## 2. Validator (`Validator.php`)

### Fluent Interface Pattern

`Validator.php` mengimplementasikan **Fluent Interface** (atau Method Chaining) [5] yang memungkinkan penulisan validasi yang ekspresif dan mudah dibaca:

```php
$validator = new Validator($input);
$validator
    ->required('nama', 'Nama wajib diisi!')
    ->email('email', 'Format email tidak valid!')
    ->numeric('nilai', 'Nilai harus berupa angka!')
    ->min('nilai', 0, 'Nilai minimal 0!')
    ->max('nilai', 100, 'Nilai maksimal 100!');
```

### Rule Validasi yang Tersedia

| Method | Parameter | Deskripsi |
|--------|-----------|-----------|
| `required()` | field, message | Field tidak boleh kosong |
| `numeric()` | field, message | Harus berupa angka |
| `email()` | field, message | Format email valid |
| `min()` | field, min, message | Nilai minimum |
| `max()` | field, max, message | Nilai maksimum |

### Implementasi Method Chaining

Setiap method validasi mengembalikan `$this` untuk memungkinkan chaining:

```php
public function required($field, $message = null)
{
    if (!isset($this->data[$field]) || trim($this->data[$field]) === '') {
        $this->errors[$field] = $message ?? "Field {$field} wajib diisi!";
    }
    return $this; // Enable method chaining
}
```

### Lifecycle Validasi

```
┌─────────────────┐
│  Input Data     │
│  (from $_POST)  │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│ new Validator() │
│   Constructor   │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│  Chain Methods  │
│ ->required()    │
│ ->email()       │
│ ->numeric()     │
└────────┬────────┘
         │
         ▼
    ┌────┴────┐
    │ fails() │
    └────┬────┘
         │
    ┌────┴────┐
    │         │
   Yes        No
    │         │
    ▼         ▼
┌───────┐  ┌───────┐
│Return │  │Process│
│Errors │  │ Data  │
└───────┘  └───────┘
```

### Error Handling Methods

| Method | Return | Deskripsi |
|--------|--------|-----------|
| `passes()` | `bool` | True jika tidak ada error |
| `fails()` | `bool` | True jika ada error |
| `getErrors()` | `array` | Semua error sebagai array |
| `getFirstError()` | `string\|null` | Error pertama saja |
| `getErrorsAsString()` | `string` | Errors joined dengan separator |

### Contoh Penggunaan di Controller

```php
public function store($input)
{
    $validator = new Validator($input);
    $validator
        ->required('nidn', 'NIDN wajib diisi!')
        ->required('nama', 'Nama wajib diisi!')
        ->numeric('nidn', 'NIDN harus berupa angka!');

    if ($validator->fails()) {
        return [
            'success' => false, 
            'errors' => $validator->getErrors()
        ];
    }

    // Lanjutkan proses jika valid
    return $this->model->create($input);
}
```

## Pola Desain yang Digunakan

### 1. Template Method Pattern

Base Model menyediakan algoritma umum (template) yang dapat di-customize oleh subclass [6].

### 2. Fluent Interface

Validator menggunakan method chaining untuk API yang ekspresif dan readable [5].

### 3. Single Responsibility Principle

Setiap class memiliki satu tanggung jawab yang jelas [7]:
- `Model`: Akses database
- `Validator`: Validasi input

## Kesimpulan

Folder `core/` menyediakan fondasi yang solid untuk aplikasi SIAKAD. Base Model menstandarkan akses database dengan keamanan built-in, sementara Validator menyediakan sistem validasi yang fleksibel dan ekspresif. Kedua komponen ini menerapkan prinsip OOP dan design patterns yang teruji untuk menghasilkan kode yang maintainable dan extensible.

---

## Referensi

[1] E. Gamma, R. Helm, R. Johnson, and J. Vlissides, *Design Patterns: Elements of Reusable Object-Oriented Software*. Boston, MA, USA: Addison-Wesley, 1994.

[2] R. C. Martin, *Agile Software Development, Principles, Patterns, and Practices*. Upper Saddle River, NJ, USA: Prentice Hall, 2002.

[3] OWASP Foundation, "SQL Injection Prevention Cheat Sheet," OWASP, 2023. [Online]. Available: https://cheatsheetseries.owasp.org/cheatsheets/SQL_Injection_Prevention_Cheat_Sheet.html

[4] A. Hunt and D. Thomas, *The Pragmatic Programmer: From Journeyman to Master*. Boston, MA, USA: Addison-Wesley, 1999.

[5] M. Fowler, "FluentInterface," martinfowler.com, Dec. 2005. [Online]. Available: https://www.martinfowler.com/bliki/FluentInterface.html

[6] E. Freeman, E. Robson, B. Bates, and K. Sierra, *Head First Design Patterns*, 2nd ed. Sebastopol, CA, USA: O'Reilly Media, 2020.

[7] R. C. Martin, *Clean Architecture: A Craftsman's Guide to Software Structure and Design*. Upper Saddle River, NJ, USA: Prentice Hall, 2017.

---

*Dokumentasi ini dibuat untuk Workshop Pemrograman Web 2 - Pertemuan 9*
