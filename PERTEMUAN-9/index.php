<?php

/**
 * Index - Halaman Utama
 * Main dashboard with navigation to all data views
 */

$pageTitle = 'Beranda - SIAKAD Kampus';
require_once 'config/database.php';
require_once 'includes/header.php';

// Get counts from database
$conn = getConnection();

$dosenCount = $conn->query("SELECT COUNT(*) as total FROM tbl_dosen")->fetch_assoc()['total'];
$mhsCount = $conn->query("SELECT COUNT(*) as total FROM tbl_mahasiswa")->fetch_assoc()['total'];
$mkCount = $conn->query("SELECT COUNT(*) as total FROM tbl_matkul")->fetch_assoc()['total'];
$nilaiCount = $conn->query("SELECT COUNT(*) as total FROM tbl_nilai")->fetch_assoc()['total'];
?>

<!-- Hero Section -->
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

<!-- Main Content -->
<main class="container mb-5">
    <!-- Statistics Cards -->
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
        <!-- Data Dosen -->
        <div class="col-md-6 col-lg-3">
            <div class="card menu-card h-100">
                <div class="card-body text-center py-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-person-badge text-primary" style="font-size: 2.5rem;"></i>
                    </div>
                    <h5 class="card-title">Data Dosen</h5>
                    <p class="card-text text-muted small">Lihat dan kelola data dosen kampus</p>
                    <a href="views/view_dosen.php" class="btn btn-primary">
                        <i class="bi bi-eye me-1"></i>Lihat Data
                    </a>
                </div>
            </div>
        </div>

        <!-- Data Mata Kuliah -->
        <div class="col-md-6 col-lg-3">
            <div class="card menu-card h-100">
                <div class="card-body text-center py-4">
                    <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-book text-info" style="font-size: 2.5rem;"></i>
                    </div>
                    <h5 class="card-title">Data Mata Kuliah</h5>
                    <p class="card-text text-muted small">Lihat dan kelola data mata kuliah</p>
                    <a href="views/view_mk.php" class="btn btn-info text-white">
                        <i class="bi bi-eye me-1"></i>Lihat Data
                    </a>
                </div>
            </div>
        </div>

        <!-- Data Mahasiswa -->
        <div class="col-md-6 col-lg-3">
            <div class="card menu-card h-100">
                <div class="card-body text-center py-4">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-people text-success" style="font-size: 2.5rem;"></i>
                    </div>
                    <h5 class="card-title">Data Mahasiswa</h5>
                    <p class="card-text text-muted small">Lihat dan kelola data mahasiswa</p>
                    <a href="views/view_mahasiswa.php" class="btn btn-success">
                        <i class="bi bi-eye me-1"></i>Lihat Data
                    </a>
                </div>
            </div>
        </div>

        <!-- Data Nilai -->
        <div class="col-md-6 col-lg-3">
            <div class="card menu-card h-100">
                <div class="card-body text-center py-4">
                    <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-card-checklist text-warning" style="font-size: 2.5rem;"></i>
                    </div>
                    <h5 class="card-title">Data Nilai</h5>
                    <p class="card-text text-muted small">Lihat dan kelola data nilai mahasiswa</p>
                    <a href="views/view_nilai.php" class="btn btn-warning">
                        <i class="bi bi-eye me-1"></i>Lihat Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>