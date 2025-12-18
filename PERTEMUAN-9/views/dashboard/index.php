<?php
/**
 * Dashboard View
 * Menampilkan konten berbeda berdasarkan role user yang login.
 */

require_once __DIR__ . '/../../helpers/auth.php';
require_once __DIR__ . '/../../config/database.php';

// Pastikan user sudah login
requireLogin();

$role = getRole();
$username = getUsername();

// Ambil statistik dari database
$conn = getConnection();
$dosenCount = $conn->query("SELECT COUNT(*) as total FROM tbl_dosen")->fetch_assoc()['total'];
$mhsCount = $conn->query("SELECT COUNT(*) as total FROM tbl_mahasiswa")->fetch_assoc()['total'];
$mkCount = $conn->query("SELECT COUNT(*) as total FROM tbl_matkul")->fetch_assoc()['total'];
$nilaiCount = $conn->query("SELECT COUNT(*) as total FROM tbl_nilai")->fetch_assoc()['total'];

$pageTitle = 'Dashboard - SIAKAD Kampus';
require_once __DIR__ . '/../../includes/header.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-3">
                    <i class="bi bi-speedometer2 me-3"></i>Dashboard
                </h1>
                <p class="lead mb-1">
                    Selamat datang, <strong><?= htmlspecialchars($username) ?></strong>!
                </p>
                <p class="opacity-75 mb-0">
                    <?php if ($role === 'dosen'): ?>
                        <span class="badge bg-warning text-dark fs-6">
                            <i class="bi bi-person-badge me-1"></i>Dosen
                        </span>
                        <span class="ms-2">Anda memiliki akses penuh ke semua modul.</span>
                    <?php else: ?>
                        <span class="badge bg-success fs-6">
                            <i class="bi bi-mortarboard me-1"></i>Mahasiswa
                        </span>
                        <span class="ms-2">Anda dapat melihat data Mahasiswa dan Mata Kuliah.</span>
                    <?php endif; ?>
                </p>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <?php if ($role === 'dosen'): ?>
                    <i class="bi bi-person-badge" style="font-size: 8rem; opacity: 0.3;"></i>
                <?php else: ?>
                    <i class="bi bi-mortarboard" style="font-size: 8rem; opacity: 0.3;"></i>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Konten Utama -->
<main class="container mb-5">
    <!-- Statistik Cards -->
    <?php if ($role === 'dosen'): ?>
        <!-- Dosen: Tampilkan semua statistik -->
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
    <?php else: ?>
        <!-- Mahasiswa: Tampilkan statistik terbatas -->
        <div class="row g-4 mb-5 justify-content-center">
            <div class="col-6 col-lg-4">
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
            <div class="col-6 col-lg-4">
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
        </div>
    <?php endif; ?>

    <!-- Menu Section -->
    <h2 class="mb-4">
        <i class="bi bi-grid-3x3-gap-fill me-2"></i>Menu Utama
    </h2>
    <div class="row g-4">
        <?php if ($role === 'dosen'): ?>
            <!-- Dosen: Tampilkan semua menu -->
            <!-- Card Dosen -->
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100 border-0 menu-card">
                    <div class="card-body text-center">
                        <i class="bi bi-person-badge text-primary display-4 mb-3"></i>
                        <h5 class="card-title fw-bold">Data Dosen</h5>
                        <p class="card-text text-muted">Manajemen data dosen pengajar dan informasinya.</p>
                        <a href="/views/dosen/index.php" class="btn btn-outline-primary stretched-link w-100">
                            <i class="bi bi-arrow-right me-1"></i>Kelola
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Mahasiswa -->
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100 border-0 menu-card">
                    <div class="card-body text-center">
                        <i class="bi bi-people text-success display-4 mb-3"></i>
                        <h5 class="card-title fw-bold">Data Mahasiswa</h5>
                        <p class="card-text text-muted">Kelola data mahasiswa, termasuk tambah, edit, dan hapus.</p>
                        <a href="/views/mahasiswa/index.php" class="btn btn-outline-success stretched-link w-100">
                            <i class="bi bi-arrow-right me-1"></i>Kelola
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Mata Kuliah -->
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100 border-0 menu-card">
                    <div class="card-body text-center">
                        <i class="bi bi-book text-info display-4 mb-3"></i>
                        <h5 class="card-title fw-bold">Mata Kuliah</h5>
                        <p class="card-text text-muted">Daftar mata kuliah yang tersedia beserta SKS-nya.</p>
                        <a href="/views/matkul/index.php" class="btn btn-outline-info stretched-link w-100">
                            <i class="bi bi-arrow-right me-1"></i>Kelola
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Nilai -->
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100 border-0 menu-card">
                    <div class="card-body text-center">
                        <i class="bi bi-card-checklist text-warning display-4 mb-3"></i>
                        <h5 class="card-title fw-bold">Data Nilai</h5>
                        <p class="card-text text-muted">Input dan kelola nilai mahasiswa per mata kuliah.</p>
                        <a href="/views/nilai/index.php" class="btn btn-outline-warning text-dark stretched-link w-100">
                            <i class="bi bi-arrow-right me-1"></i>Kelola
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Mahasiswa: Hanya tampilkan menu Mahasiswa dan Matkul -->
            <!-- Card Mahasiswa -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100 border-0 menu-card">
                    <div class="card-body text-center">
                        <i class="bi bi-people text-success display-4 mb-3"></i>
                        <h5 class="card-title fw-bold">Data Mahasiswa</h5>
                        <p class="card-text text-muted">Lihat daftar mahasiswa yang terdaftar.</p>
                        <a href="/views/mahasiswa/index.php" class="btn btn-outline-success stretched-link w-100">
                            <i class="bi bi-eye me-1"></i>Lihat Data
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Mata Kuliah -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100 border-0 menu-card">
                    <div class="card-body text-center">
                        <i class="bi bi-book text-info display-4 mb-3"></i>
                        <h5 class="card-title fw-bold">Mata Kuliah</h5>
                        <p class="card-text text-muted">Lihat daftar mata kuliah yang tersedia.</p>
                        <a href="/views/matkul/index.php" class="btn btn-outline-info stretched-link w-100">
                            <i class="bi bi-eye me-1"></i>Lihat Data
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($role === 'mahasiswa'): ?>
        <!-- Info untuk mahasiswa -->
        <div class="alert alert-info mt-4">
            <i class="bi bi-info-circle me-2"></i>
            <strong>Informasi:</strong> Sebagai mahasiswa, Anda hanya dapat melihat data tanpa kemampuan untuk menambah, mengubah, atau menghapus data.
        </div>
    <?php endif; ?>
</main>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
