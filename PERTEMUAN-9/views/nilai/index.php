<?php
/**
 * Halaman Manajemen Data Nilai
 * Menggunakan arsitektur MVC.
 */

require_once '../../controllers/NilaiController.php';

$controller = new NilaiController();
$data = $controller->index();
$pageTitle = $data['pageTitle'];
$nilaiList = $data['nilai'];

require_once '../../includes/header.php';
?>

<div class="bg-warning py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-0">
                    <i class="bi bi-card-checklist me-2"></i>Data Nilai
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 mt-2">
                        <li class="breadcrumb-item"><a href="../../index.php" class="text-dark">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Nilai</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

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
                    <a href="add.php" class="btn btn-warning text-dark fw-bold">
                        <i class="bi bi-plus me-1"></i>Input Nilai Baru
                    </a>
                </div>
                <div class="col-auto">
                    <span class="badge bg-warning text-dark fs-6">
                        Total: <?= count($nilaiList) ?> data
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php if (count($nilaiList) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="bg-warning text-dark">
                            <tr>
                                <th scope="col" class="text-center" style="width: 60px;">No</th>
                                <th scope="col">Mahasiswa</th>
                                <th scope="col">Mata Kuliah</th>
                                <th scope="col">Dosen Pengampu</th>
                                <th scope="col" class="text-center">Nilai</th>
                                <th scope="col" class="text-center">Grade</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($nilaiList as $row):
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td>
                                        <i class="bi bi-person me-2"></i>
                                        <?= htmlspecialchars($row['nama_mahasiswa']) ?>
                                    </td>
                                    <td>
                                        <i class="bi bi-book me-2"></i>
                                        <?= htmlspecialchars($row['namaMatkul']) ?>
                                    </td>
                                    <td>
                                        <small class="text-muted"><?= htmlspecialchars($row['nama_dosen']) ?></small>
                                    </td>
                                    <td class="text-center fw-bold">
                                        <?= htmlspecialchars($row['nilai']) ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge <?= NilaiController::getGradeColor($row['nilaiHuruf']) ?> rounded-pill" style="width: 30px;">
                                            <?= htmlspecialchars($row['nilaiHuruf']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="edit.php?id=<?= htmlspecialchars($row['id_nilai']) ?>" class="btn btn-sm btn-outline-primary" title="Ubah Data">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                data-id="<?= htmlspecialchars($row['id_nilai']) ?>"
                                                data-nama="<?= htmlspecialchars($row['nama_mahasiswa']) ?> - <?= htmlspecialchars($row['namaMatkul']) ?>"
                                                title="Hapus Data">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

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
                    Belum ada data nilai yang diinput.
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
                <p>Apakah Anda yakin ingin menghapus data nilai untuk <strong id="deleteName"></strong>?</p>
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