<?php

/**
 * View Nilai
 * Menampilkan data nilai dari tbl_nilai dengan relasi ke tbl_mahasiswa, tbl_matkul, dan tbl_dosen
 */

$pageTitle = 'Data Nilai - SIAKAD Kampus';
require_once '../config/database.php';
require_once '../includes/header.php';

// Get all nilai data with related information
$conn = getConnection();
$query = "SELECT 
            n.id_nilai,
            n.nilai,
            n.nilaiHuruf,
            m.nim,
            m.nama as nama_mahasiswa,
            mk.kodeMatkul,
            mk.namaMatkul,
            mk.sks,
            d.nidn,
            d.nama as nama_dosen
          FROM tbl_nilai n
          LEFT JOIN tbl_mahasiswa m ON n.nim = m.nim
          LEFT JOIN tbl_matkul mk ON n.kodeMatkul = mk.kodeMatkul
          LEFT JOIN tbl_dosen d ON n.nidn = d.nidn
          ORDER BY n.id_nilai ASC";
$result = $conn->query($query);

// Function to get badge color based on grade
function getGradeBadge($grade)
{
    switch ($grade) {
        case 'A':
            return 'bg-success';
        case 'B':
            return 'bg-primary';
        case 'C':
            return 'bg-warning text-dark';
        case 'D':
            return 'bg-danger';
        case 'E':
            return 'bg-dark';
        default:
            return 'bg-secondary';
    }
}
?>

<!-- Page Header -->
<div class="bg-warning py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-0">
                    <i class="bi bi-card-checklist me-2"></i>Data Nilai
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 mt-2">
                        <li class="breadcrumb-item"><a href="../index.php" class="text-dark">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Nilai</li>
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
                        <i class="bi bi-table me-2"></i>Tabel Data Nilai Mahasiswa
                    </h5>
                </div>
                <div class="col-auto">
                    <a href="add_nilai.php" class="btn btn-warning text-dark fw-bold">
                        <i class="bi bi-plus me-1"></i>Tambah Data Nilai
                    </a>
                </div>
                <div class="col-auto">
                    <span class="badge bg-warning text-dark fs-6">
                        Total: <?= $result->num_rows ?> data
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php if ($result->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="bg-warning">
                            <tr>
                                <th scope="col" class="text-center" style="width: 60px;">No</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Nama Mahasiswa</th>
                                <th scope="col">Mata Kuliah</th>
                                <th scope="col" class="text-center">SKS</th>
                                <th scope="col" class="text-center">Nilai</th>
                                <th scope="col" class="text-center">Grade</th>
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
                                        <span class="badge bg-secondary"><?= htmlspecialchars($row['nim']) ?></span>
                                    </td>
                                    <td>
                                        <i class="bi bi-person-circle me-2 text-success"></i>
                                        <?= htmlspecialchars($row['nama_mahasiswa'] ?? 'N/A') ?>
                                    </td>
                                    <td>
                                        <small class="text-muted"><?= htmlspecialchars($row['kodeMatkul']) ?></small><br>
                                        <i class="bi bi-book me-1 text-info"></i>
                                        <?= htmlspecialchars($row['namaMatkul'] ?? 'N/A') ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info text-dark">
                                            <?= htmlspecialchars($row['sks'] ?? '-') ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <strong><?= number_format($row['nilai'], 1) ?></strong>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge <?= getGradeBadge($row['nilaiHuruf']) ?> fs-6 px-3">
                                            <?= htmlspecialchars($row['nilaiHuruf']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <i class="bi bi-person-check me-1 text-primary"></i>
                                        <?= htmlspecialchars($row['nama_dosen'] ?? 'N/A') ?>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="edit_nilai.php?id=<?= htmlspecialchars($row['id_nilai']) ?>" class="btn btn-sm btn-outline-primary" title="Ubah Data">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="delete_nilai.php?id=<?= htmlspecialchars($row['id_nilai']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data nilai ini?')" title="Hapus Data">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Legend -->
                <div class="mt-4 p-3 bg-light rounded">
                    <h6 class="mb-2"><i class="bi bi-info-circle me-2"></i>Keterangan Grade:</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-success">A = 80-100</span>
                        <span class="badge bg-primary">B = 70-79</span>
                        <span class="badge bg-warning text-dark">C = 60-69</span>
                        <span class="badge bg-danger">D = 50-59</span>
                        <span class="badge bg-dark">E = 0-49</span>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-info mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    Tidak ada data nilai yang tersedia.
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