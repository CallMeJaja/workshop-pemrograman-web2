<?php
require_once '../../controllers/MatkulController.php';
require_once '../../helpers/auth.php';

// Cek login dan akses
requireLogin();
if (!canAccess('matkul')) {
    $_SESSION['flash_message'] = [
        'type' => 'error',
        'message' => 'Anda tidak memiliki akses ke halaman tersebut.'
    ];
    header('Location: /index.php?modul=dashboard');
    exit;
}

$controller = new MatkulController();
$data = $controller->index();
$pageTitle = $data['pageTitle'];
$matkulList = $data['matkul'];

// Cek apakah user bisa CRUD
$canEdit = canCRUD();

require_once '../../includes/header.php';
?>

<!-- Header Halaman -->
<div class="bg-info text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-0">
                    <i class="bi bi-book me-2"></i>Data Mata Kuliah
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 mt-2">
                        <li class="breadcrumb-item"><a href="/index.php?modul=dashboard" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Data Mata Kuliah</li>
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
                        <i class="bi bi-table me-2"></i>Tabel Data Mata Kuliah
                    </h5>
                </div>
                <?php if ($canEdit): ?>
                    <div class="col-auto">
                        <a href="add.php" class="btn btn-info text-white fw-bold">
                            <i class="bi bi-plus me-1"></i>Tambah Data Mata Kuliah
                        </a>
                    </div>
                <?php endif; ?>
                <div class="col-auto">
                    <span class="badge bg-info fs-6">
                        Total: <?= count($matkulList) ?> data
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php if (count($matkulList) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="bg-info text-white">
                            <tr>
                                <th scope="col" class="text-center" style="width: 60px;">No</th>
                                <th scope="col">Kode MK</th>
                                <th scope="col">Nama Mata Kuliah</th>
                                <th scope="col" class="text-center">SKS</th>
                                <th scope="col">Dosen Pengampu</th>
                                <?php if ($canEdit): ?>
                                    <th scope="col">Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($matkulList as $row):
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
                                    <?php if ($canEdit): ?>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="edit.php?id=<?= htmlspecialchars($row['kodeMatkul']) ?>" class="btn btn-sm btn-outline-primary" title="Ubah Data">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal" 
                                                    data-id="<?= htmlspecialchars($row['kodeMatkul']) ?>"
                                                    data-nama="<?= htmlspecialchars($row['namaMatkul']) ?>"
                                                    title="Hapus Data">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
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
            <a href="/index.php?modul=dashboard" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Dashboard
            </a>
        </div>
    </div>
</main>

<?php if ($canEdit): ?>
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
                <p>Apakah Anda yakin ingin menghapus mata kuliah <strong id="deleteName"></strong>?</p>
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
<?php endif; ?>

<?php require_once '../../includes/footer.php'; ?>