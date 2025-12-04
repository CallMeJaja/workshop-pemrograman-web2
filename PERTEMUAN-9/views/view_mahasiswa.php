<?php

/**
 * View Mahasiswa
 * Menampilkan data mahasiswa dari tbl_mahasiswa
 */

$pageTitle = 'Data Mahasiswa - SIAKAD Kampus';
require_once '../config/database.php';
require_once '../includes/header.php';

// Get all mahasiswa data
$conn = getConnection();
$query = "SELECT * FROM tbl_mahasiswa ORDER BY nim ASC";
$result = $conn->query($query);
?>

<!-- Page Header -->
<div class="bg-success text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-0">
                    <i class="bi bi-people me-2"></i>Data Mahasiswa
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 mt-2">
                        <li class="breadcrumb-item"><a href="../index.php" class="text-white-50">Beranda</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Data Mahasiswa</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<main class="container mb-5">
    <div class="card">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">
                        <i class="bi bi-table me-2"></i>Tabel Data Mahasiswa
                    </h5>
                </div>
                <div class="col-auto">
                    <span class="badge bg-success fs-6">
                        Total: <?= $result->num_rows ?> data
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php if ($result->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="bg-success text-white">
                            <tr>
                                <th scope="col" class="text-center" style="width: 60px;">No</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Nama Mahasiswa</th>
                                <th scope="col">Program Studi</th>
                                <th scope="col" class="text-center">Angkatan</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = $result->fetch_assoc()):
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td>
                                        <span class="badge bg-secondary"><?= htmlspecialchars($row['nim']) ?></span>
                                    </td>
                                    <td>
                                        <i class="bi bi-person-circle me-2 text-success"></i>
                                        <?= htmlspecialchars($row['nama']) ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            <?= htmlspecialchars($row['prodi']) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning text-dark">
                                            <?= htmlspecialchars($row['angkatan']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="mailto:<?= htmlspecialchars($row['email']) ?>" class="text-decoration-none">
                                            <i class="bi bi-envelope me-1"></i>
                                            <?= htmlspecialchars($row['email']) ?>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    Tidak ada data mahasiswa yang tersedia.
                </div>
            <?php endif; ?>
        </div>
        <div class="card-footer bg-white">
            <a href="../index.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</main>

<?php require_once '../includes/footer.php'; ?>