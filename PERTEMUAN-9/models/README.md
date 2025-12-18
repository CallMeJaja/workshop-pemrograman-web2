# Models: Lapisan Akses Data dalam Arsitektur MVC

## Pendahuluan

Dalam pengembangan aplikasi berbasis database, pemisahan antara logika bisnis dan akses data merupakan aspek fundamental yang mendukung *maintainability* dan *testability* aplikasi [1]. Folder `models/` dalam proyek ini mengimplementasikan lapisan **Model** dari arsitektur MVC yang bertanggung jawab untuk mengelola interaksi dengan database.

## Konsep Model dalam MVC

Model merepresentasikan data dan aturan bisnis dalam aplikasi [2]. Dalam konteks web development, Model bertugas untuk:
- Mengenkapsulasi akses ke database
- Menyediakan abstraksi data untuk Controller
- Menerapkan validasi pada level data
- Menangani relasi antar entitas

Fowler [3] mendefinisikan Model sebagai komponen yang "knows nothing about the user interface" dan fokus sepenuhnya pada pengelolaan data domain.

## Struktur File dalam Folder Models

| File | Tabel Database | Deskripsi |
|------|----------------|-----------|
| `Model.php` | (Base Class) | Class induk yang menyediakan operasi dasar CRUD |
| `User.php` | `tbl_users` | Manajemen data pengguna dan autentikasi |
| `Dosen.php` | `tbl_dosen` | Manajemen data dosen |
| `Mahasiswa.php` | `tbl_mahasiswa` | Manajemen data mahasiswa |
| `Matkul.php` | `tbl_matkul` | Manajemen data mata kuliah |
| `Nilai.php` | `tbl_nilai` | Manajemen data nilai dengan relasi |

## Pola Desain: Active Record Pattern

Model dalam proyek ini mengimplementasikan variasi dari **Active Record Pattern** [4], di mana setiap instance objek model merepresentasikan satu baris dalam tabel database. Pattern ini menyediakan:

1. **CRUD Operations**: Create, Read, Update, Delete
2. **Domain Logic**: Logika bisnis terkait entitas
3. **Finder Methods**: Metode untuk mencari data

### Base Model Class

Class `Model.php` yang berada di folder `core/` menyediakan implementasi dasar yang diwarisi oleh semua model:

```php
class Model
{
    protected $conn;    // Koneksi database
    protected $table;   // Nama tabel

    // Operasi dasar
    public function getAll($orderBy, $order);
    public function getByColumn($column, $value);
    public function exists($column, $value);
    public function deleteByColumn($column, $value);
    public function getError();
}
```

## Implementasi Model

### 1. Model Dosen

`Dosen.php` menangani operasi CRUD untuk data dosen dengan primary key `nidn`:

```php
class Dosen extends Model
{
    protected $table = 'tbl_dosen';

    public function isNidnExists($nidn);   // Cek duplikasi NIDN
    public function getByNidn($nidn);       // Ambil by NIDN
    public function create($data);          // Insert dosen baru
    public function update($nidn, $data);   // Update data
    public function delete($nidn);          // Hapus dosen
    public function getAllOrdered();        // Daftar terurut
}
```

### 2. Model Mahasiswa

`Mahasiswa.php` memiliki struktur serupa dengan primary key `nim`:

| Method | Fungsi |
|--------|--------|
| `isNimExists()` | Validasi keunikan NIM |
| `getByNim()` | Retrieve by primary key |
| `create()` | Insert mahasiswa baru |
| `update()` | Update data mahasiswa |
| `delete()` | Hapus mahasiswa |

### 3. Model Mata Kuliah

`Matkul.php` mengelola mata kuliah dengan relasi ke dosen pengampu:

```php
public function getByKode($kodeMatkul);
public function getByNidn($nidn);           // Matkul by dosen
public function getNidnByKode($kodeMatkul); // Get dosen pengampu
public function getAllWithDosen();          // Join dengan data dosen
```

### 4. Model Nilai

`Nilai.php` mengimplementasikan model yang paling kompleks dengan multiple relations:

```php
public function getAllWithRelations()
{
    // JOIN dengan tbl_mahasiswa, tbl_matkul, dan tbl_dosen
    $query = "SELECT n.*, m.nama as nama_mahasiswa,
              mk.namaMatkul, d.nama as nama_dosen
              FROM tbl_nilai n
              LEFT JOIN tbl_mahasiswa m ON n.nim = m.nim
              LEFT JOIN tbl_matkul mk ON n.kodeMatkul = mk.kodeMatkul
              LEFT JOIN tbl_dosen d ON n.nidn = d.nidn";
}
```

### 5. Konversi Nilai Otomatis

Model `Nilai` menyediakan method static untuk konversi nilai angka ke huruf berdasarkan standar penilaian [5]:

```php
public static function convertToGrade($nilai)
{
    if ($nilai >= 85) return 'A';  // Sangat Baik
    if ($nilai >= 75) return 'B';  // Baik
    if ($nilai >= 60) return 'C';  // Cukup
    if ($nilai >= 50) return 'D';  // Kurang
    return 'E';                     // Sangat Kurang
}
```

| Rentang Nilai | Grade | Predikat |
|---------------|-------|----------|
| 85 - 100 | A | Sangat Baik |
| 75 - 84 | B | Baik |
| 60 - 74 | C | Cukup |
| 50 - 59 | D | Kurang |
| 0 - 49 | E | Sangat Kurang |

## Keamanan: Prepared Statements

Semua operasi database menggunakan **Prepared Statements** untuk mencegah serangan SQL Injection [6]:

```php
// Aman dari SQL Injection
$stmt = $this->conn->prepare("SELECT * FROM tbl_dosen WHERE nidn = ?");
$stmt->bind_param("s", $nidn);
$stmt->execute();
```

Menurut OWASP [7], parameterized queries merupakan pertahanan utama terhadap injection attacks.

## Diagram Entity Relationship

```
┌─────────────┐     ┌─────────────┐     ┌─────────────┐
│  tbl_dosen  │     │  tbl_matkul │     │ tbl_mahasis │
│             │     │             │     │     wa      │
│ PK: nidn    │◄────┤ FK: nidn    │     │ PK: nim     │
│    nama     │     │ PK: kodeMK  │     │    nama     │
│    email    │     │    namaMK   │     │    prodi    │
└─────────────┘     │    sks      │     │    email    │
                    └──────┬──────┘     └──────┬──────┘
                           │                   │
                    ┌──────┴───────────────────┴──────┐
                    │           tbl_nilai             │
                    │ PK: id_nilai                    │
                    │ FK: nim, kodeMatkul, nidn       │
                    │    nilai, nilaiHuruf            │
                    └─────────────────────────────────┘
```

## Best Practices yang Diterapkan

1. **Single Responsibility Principle**: Setiap Model hanya menangani satu entitas [8]
2. **DRY (Don't Repeat Yourself)**: Operasi umum di-abstract ke Base Model [9]
3. **Data Encapsulation**: Akses database hanya melalui method Model
4. **Error Handling**: Method `getError()` untuk debugging

## Kesimpulan

Implementasi Model dalam proyek ini mengikuti standar industri untuk pengelolaan akses data. Dengan menggunakan inheritance dari Base Model dan Prepared Statements, aplikasi menjadi lebih aman, terstruktur, dan mudah dikembangkan. Pola Active Record yang digunakan memberikan keseimbangan antara kesederhanaan dan fleksibilitas untuk aplikasi skala kecil hingga menengah [10].

---

## Referensi

[1] C. Larman, *Applying UML and Patterns: An Introduction to Object-Oriented Analysis and Design and Iterative Development*, 3rd ed. Upper Saddle River, NJ, USA: Prentice Hall, 2004.

[2] E. Gamma, R. Helm, R. Johnson, and J. Vlissides, *Design Patterns: Elements of Reusable Object-Oriented Software*. Boston, MA, USA: Addison-Wesley, 1994.

[3] M. Fowler, *Patterns of Enterprise Application Architecture*. Boston, MA, USA: Addison-Wesley, 2002.

[4] M. Fowler, "Active Record," martinfowler.com, 2003. [Online]. Available: https://www.martinfowler.com/eaaCatalog/activeRecord.html

[5] Kementerian Pendidikan dan Kebudayaan, "Pedoman Penilaian Hasil Belajar," Jakarta, Indonesia, 2020.

[6] B. Sullivan and V. Liu, *Web Application Security: A Beginner's Guide*. New York, NY, USA: McGraw-Hill, 2012.

[7] OWASP Foundation, "SQL Injection Prevention Cheat Sheet," OWASP, 2023. [Online]. Available: https://cheatsheetseries.owasp.org/cheatsheets/SQL_Injection_Prevention_Cheat_Sheet.html

[8] R. C. Martin, *Clean Code: A Handbook of Agile Software Craftsmanship*. Upper Saddle River, NJ, USA: Prentice Hall, 2008.

[9] A. Hunt and D. Thomas, *The Pragmatic Programmer: From Journeyman to Master*. Boston, MA, USA: Addison-Wesley, 1999.

[10] C. S. Horstmann, *Object-Oriented Design and Patterns*, 2nd ed. Hoboken, NJ, USA: Wiley, 2006.

---

*Dokumentasi ini dibuat untuk Workshop Pemrograman Web 2 - Pertemuan 9*
