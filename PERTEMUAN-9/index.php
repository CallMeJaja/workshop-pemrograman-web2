<?php

/**
 * Halaman Utama (Dashboard)
 * Menampilkan statistik ringkas dan navigasi ke modul data master.
 */

$pageTitle = 'Beranda - SIAKAD Kampus';
require_once 'config/database.php';
require_once 'includes/header.php';

// Ambil jumlah data dari database
$conn = getConnection();

$dosenCount = $conn->query("SELECT COUNT(*) as total FROM tbl_dosen")->fetch_assoc()['total'];
$mhsCount = $conn->query("SELECT COUNT(*) as total FROM tbl_mahasiswa")->fetch_assoc()['total'];
$mkCount = $conn->query("SELECT COUNT(*) as total FROM tbl_matkul")->fetch_assoc()['total'];
$nilaiCount = $conn->query("SELECT COUNT(*) as total FROM tbl_nilai")->fetch_assoc()['total'];
?>

<!-- Bagian Hero -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3">
                    <i class="bi bi-mortarboard-fill me-3"></i>Selamat Datang
                </h1>
                <p class="lead mb-0">Sistem Informasi Akademik Kampus</p>
                <p class="opacity-75">Kelola data dosen, mahasiswa, mata kuliah, dan nilai dengan mudah.</p>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <i class="bi bi-database-fill-gear" style="font-size: 8rem; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</section>

<!-- Konten Utama -->
<main class="container mb-5">
    <!-- Kartu Statistik -->
    <div class="row g-4 mb-5">
        <div class="col-6 col-lg-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-person-badge fs-1 me-3"></i>
                    <div>
                        <h3 class="card-title mb-0"><?= $dosenCount ?></h3>
                        <p class="card-text mb-0">Dosen</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-people fs-1 me-3"></i>
                    <div>
                        <h3 class="card-title mb-0"><?= $mhsCount ?></h3>
                        <p class="card-text mb-0">Mahasiswa</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-book fs-1 me-3"></i>
                    <div>
                        <h3 class="card-title mb-0"><?= $mkCount ?></h3>
                        <p class="card-text mb-0">Mata Kuliah</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card bg-warning text-white h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-card-checklist fs-1 me-3"></i>
                    <div>
                        <h3 class="card-title mb-0"><?= $nilaiCount ?></h3>
                        <p class="card-text mb-0">Data Nilai</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Section -->
    <h2 class="mb-4">
        <i class="bi bi-grid-3x3-gap-fill me-2"></i>Menu Utama
    </h2>
    <div class="row g-4">
        <!-- Card Dosen -->
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-person-badge text-primary display-4 mb-3"></i>
                        <h5 class="card-title fw-bold">Data Dosen</h5>
                        <p class="card-text text-muted">Manajemen data dosen pengajar dan informasinya.</p>
                        <a href="views/dosen/index.php" class="btn btn-outline-primary stretched-link w-100">
                            <i class="bi bi-arrow-right me-1"></i>Kelola
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Card Mahasiswa -->
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-people text-success display-4 mb-3"></i>
                        <h5 class="card-title fw-bold">Data Mahasiswa</h5>
                        <p class="card-text text-muted">Kelola data mahasiswa, termasuk tambah, edit, dan hapus.</p>
                        <a href="views/mahasiswa/index.php" class="btn btn-outline-success stretched-link w-100">
                            <i class="bi bi-arrow-right me-1"></i>Kelola
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Card Mata Kuliah -->
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-book text-info display-4 mb-3"></i>
                        <h5 class="card-title fw-bold">Mata Kuliah</h5>
                        <p class="card-text text-muted">Daftar mata kuliah yang tersedia beserta SKS-nya.</p>
                        <a href="views/matkul/index.php" class="btn btn-outline-info stretched-link w-100">
                            <i class="bi bi-arrow-right me-1"></i>Kelola
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Nilai -->
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-card-checklist text-warning display-4 mb-3"></i>
                        <h5 class="card-title fw-bold">Data Nilai</h5>
                        <p class="card-text text-muted">Input dan kelola nilai mahasiswa per mata kuliah.</p>
                        <a href="views/nilai/index.php" class="btn btn-outline-warning text-dark stretched-link w-100">
                            <i class="bi bi-arrow-right me-1"></i>Kelola
                        </a>
                    </div>
                </div>
            </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>