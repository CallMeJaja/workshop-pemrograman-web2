<?php
/**
 * Halaman Manajemen Data Dosen
 * Menampilkan daftar dosen dengan opsi tambah, edit, dan hapus.
 */

$pageTitle = 'Data Dosen - SIAKAD Kampus';
require_once '../../config/database.php';
require_once '../../includes/header.php';

// Ambil data dosen urut berdasarkan NIDN
$conn = getConnection();
$result = $conn->query("SELECT * FROM tbl_dosen ORDER BY nidn ASC");
?>

<!-- Header Halaman -->
<div class="bg-primary text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-0">
                    <i class="bi bi-person-badge me-2"></i>Data Dosen
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 mt-2">
                        <li class="breadcrumb-item"><a href="../../index.php" class="text-white-50">Beranda</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Data Dosen</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Konten Utama -->
<main class="container mb-5">
    <div class="card">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">
                        <i class="bi bi-table me-2"></i>Tabel Data Dosen
                    </h5>
                </div>
                <div class="col-auto">
                    <a href="add.php" class="btn btn-primary fw-bold">
                        <i class="bi bi-plus me-1"></i>Tambah Data Dosen
                    </a>
                </div>
                <div class="col-auto">
                    <span class="badge bg-primary fs-6">
                        Total: <?= $result->num_rows ?> dosen
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php if ($result->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center" style="width: 60px;">No</th>
                                <th scope="col">NIDN</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Email</th>
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
                                        <span class="badge bg-dark"><?= htmlspecialchars($row['nidn']) ?></span>
                                    </td>
                                    <td>
                                        <i class="bi bi-person-circle me-2 text-primary"></i>
                                        <?= htmlspecialchars($row['nama']) ?>
                                    </td>
                                    <td>
                                        <a href="mailto:<?= htmlspecialchars($row['email']) ?>" class="text-decoration-none">
                                            <i class="bi bi-envelope me-1"></i>
                                            <?= htmlspecialchars($row['email']) ?>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="edit.php?id=<?= htmlspecialchars($row['nidn']) ?>" class="btn btn-sm btn-outline-primary" title="Ubah Data">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal" 
                                                data-id="<?= htmlspecialchars($row['nidn']) ?>"
                                                data-nama="<?= htmlspecialchars($row['nama']) ?>"
                                                title="Hapus Data">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    Tidak ada data dosen yang tersedia.
                </div>
            <?php endif; ?>
        </div>
        <div class="card-footer bg-white">
            <a href="../../index.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</main>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data dosen <strong id="deleteName"></strong>?</p>
                <div class="alert alert-warning small mb-0">
                    <i class="bi bi-info-circle me-1"></i>
                    Data yang dihapus tidak dapat dikembalikan.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Hapus Data</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var nama = button.getAttribute('data-nama');
            
            var namaEl = deleteModal.querySelector('#deleteName');
            var confirmBtn = deleteModal.querySelector('#confirmDeleteBtn');
            
            namaEl.textContent = nama;
            confirmBtn.setAttribute('href', 'delete.php?id=' + id);
        });
    });
</script>

<?php require_once '../../includes/footer.php'; ?>