# Includes: Komponen UI Reusable dan Layout Template

## Pendahuluan

Folder `includes/` menyimpan komponen UI yang digunakan berulang di seluruh halaman aplikasi [1]. Pendekatan ini mengikuti prinsip **DRY (Don't Repeat Yourself)** dan memudahkan maintenance [2].

## Struktur File

| File | Fungsi |
|------|--------|
| `header.php` | Layout atas, navigasi, CSS dependencies |
| `footer.php` | Layout bawah, JS dependencies |

## Diagram Layout

```
┌─────────────────────────────────────────────────┐
│                  header.php                     │
│  <head> Meta, CSS </head>                       │
│  <nav> Navbar </nav>                            │
│  Toast Container                                │
├─────────────────────────────────────────────────┤
│              PAGE CONTENT                       │
├─────────────────────────────────────────────────┤
│                  footer.php                     │
│  <footer> Copyright </footer>                   │
│  Bootstrap JS                                   │
│  </body></html>                                 │
└─────────────────────────────────────────────────┘
```

---

## 1. Header (`header.php`)

### CSS Dependencies

| Library | Version | Fungsi |
|---------|---------|--------|
| Bootstrap CSS | 5.3.3 | Framework UI responsif [3] |
| Bootstrap Icons | 1.11.3 | Icon library |
| Custom Styles | inline | Styling khusus |

### Navigasi Dinamis (Role-Based)

```php
<?php if ($userRole === 'dosen'): ?>
    <!-- Menu lengkap: Dosen, Mahasiswa, Matkul, Nilai -->
<?php else: ?>
    <!-- Menu terbatas: Mahasiswa, Matkul -->
<?php endif; ?>
```

### Toast Notification System

Header menyediakan container untuk notifikasi terintegrasi dengan flash messages [4].

---

## 2. Footer (`footer.php`)

### Struktur

- Copyright info
- Branding SIAKAD
- Bootstrap JS Bundle

### Sticky Footer Pattern

```css
body { display: flex; flex-direction: column; min-height: 100vh; }
footer { margin-top: auto; }
```

---

## Penggunaan di View

```php
<?php
$pageTitle = 'Data Dosen - SIAKAD';
require_once __DIR__ . '/../includes/header.php';
?>
<!-- Konten halaman -->
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
```

## Kesimpulan

Folder `includes/` menyediakan komponen UI reusable untuk konsistensi tampilan dan kemudahan maintenance.

---

## Referensi

[1] J. Nielsen, *Designing Web Usability*. New Riders, 1999.

[2] A. Hunt and D. Thomas, *The Pragmatic Programmer*. Addison-Wesley, 1999.

[3] Bootstrap Team, "Bootstrap 5 Documentation," getbootstrap.com, 2023.

[4] Bootstrap Team, "Toasts," getbootstrap.com, 2023.

---

*Dokumentasi untuk Workshop Pemrograman Web 2 - Pertemuan 9*
