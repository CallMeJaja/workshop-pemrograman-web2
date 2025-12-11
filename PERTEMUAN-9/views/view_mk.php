<?php

/**
 * View Mata Kuliah
 * Menampilkan data mata kuliah dari tbl_matkul dengan relasi ke tbl_dosen
 */

$pageTitle = 'Data Mata Kuliah - SIAKAD Kampus';
require_once '../config/database.php';
require_once '../includes/header.php';

// Get all mata kuliah data with dosen name
$conn = getConnection();
$query = "SELECT m.*, d.nama as nama_dosen 
          FROM tbl_matkul m 
          LEFT JOIN tbl_dosen d ON m.nidn = d.nidn 
          ORDER BY m.kodeMatkul ASC";
$result = $conn->query($query);
?>

<!-- Page Header -->
<div class="bg-info text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-0">
                    <i class="bi bi-book me-2"></i>Data Mata Kuliah
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 mt-2">
                        <li class="breadcrumb-item"><a href="../index.php" class="text-white-50">Beranda</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Data Mata Kuliah</li>
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
                        <i class="bi bi-table me-2"></i>Tabel Data Mata Kuliah
                    </h5>
                </div>
                <div class="col-auto">
                    <span class="badge bg-info fs-6">
                        Total: <?= $result->num_rows ?> data
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php if ($result->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="bg-info text-white">
                            <tr>
                                <th scope="col" class="text-center" style="width: 60px;">No</th>
                                <th scope="col">Kode MK</th>
                                <th scope="col">Nama Mata Kuliah</th>
                                <th scope="col" class="text-center">SKS</th>
                                <th scope="col">Dosen Pengampu</th>
                                <th scope="col">Aksi</th>
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
                                        <span class="badge bg-dark"><?= htmlspecialchars($row['kodeMatkul']) ?></span>
                                    </td>
                                    <td>
                                        <i class="bi bi-journal-text me-2 text-info"></i>
                                        <?= htmlspecialchars($row['namaMatkul']) ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success rounded-pill">
                                            <?= htmlspecialchars($row['sks']) ?> SKS
                                        </span>
                                    </td>
                                    <td>
                                        <i class="bi bi-person-check me-1 text-primary"></i>
                                        <?= htmlspecialchars($row['nama_dosen'] ?? 'N/A') ?>
                                        <small class="text-muted">(<?= htmlspecialchars($row['nidn']) ?>)</small>
                                    </td>
                                    <td>
                                        <a href="edit_mk.php?id=<?= htmlspecialchars($row['kodeMatkul']) ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil me-1"></i>
                                            Ubah
                                        </a>
                                        <a href="delete_mk.php?id=<?= htmlspecialchars($row['kodeMatkul']) ?>" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash me-1"></i>
                                            Hapus
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
                    Tidak ada data mata kuliah yang tersedia.
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