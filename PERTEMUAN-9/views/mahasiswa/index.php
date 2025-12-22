<?php
require_once '../../controllers/MahasiswaController.php';
require_once '../../helpers/auth.php';

// Cek login dan akses
requireLogin();
if (!canAccess('mahasiswa')) {
    $_SESSION['flash_message'] = [
        'type' => 'error',
        'message' => 'Anda tidak memiliki akses ke halaman tersebut.'
    ];
    header('Location: /index.php?modul=dashboard');
    exit;
}

$controller = new MahasiswaController();
$data = $controller->index();
$pageTitle = $data['pageTitle'];
$mahasiswaList = $data['mahasiswa'];

// Cek apakah user bisa CRUD
$canEdit = canCRUD();

require_once '../../includes/header.php';
?>

<!-- Header Halaman -->
<div class="bg-success text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-0">
                    <i class="bi bi-people me-2"></i>Data Mahasiswa
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 mt-2">
                        <li class="breadcrumb-item"><a href="/index.php?modul=dashboard" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Data Mahasiswa</li>
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
                        <i class="bi bi-table me-2"></i>Tabel Data Mahasiswa
                    </h5>
                </div>
                <?php if ($canEdit): ?>
                    <div class="col-auto">
                        <a href="add.php" class="btn btn-success text-white fw-bold">
                            <i class="bi bi-plus me-1"></i>Tambah Data Mahasiswa
                        </a>
                    </div>
                <?php endif; ?>
                <div class="col-auto">
                    <span class="badge bg-success fs-6">
                        Total: <?= count($mahasiswaList) ?> mahasiswa
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php if (count($mahasiswaList) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="bg-success text-white">
                            <tr>
                                <th scope="col" class="text-center" style="width: 60px;">No</th>
                                <th scope="col">Foto</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Program Studi</th>
                                <th scope="col" class="text-center">Angkatan</th>
                                <th scope="col">Email</th>
                                <?php if ($canEdit): ?>
                                    <th scope="col">Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($mahasiswaList as $row):
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td>
                                        <?php if (!empty($row['foto'])): ?>
                                            <img src="../../upload/profile/mahasiswa/<?= htmlspecialchars($row['foto']) ?>" 
                                                 alt="Foto <?= htmlspecialchars($row['nama']) ?>" 
                                                 class="rounded-circle" 
                                                 style="width: 45px; height: 45px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" 
                                                 style="width: 45px; height: 45px; font-size: 18px;">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-dark"><?= htmlspecialchars($row['nim']) ?></span>
                                    </td>
                                    <td>
                                        <i class="bi bi-person-circle me-2 text-success"></i>
                                        <?= htmlspecialchars($row['nama']) ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            <?= htmlspecialchars($row['prodi'] ?? '-') ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?= htmlspecialchars($row['angkatan'] ?? '-') ?>
                                    </td>
                                    <td>
                                        <small class="text-muted"><?= htmlspecialchars($row['email'] ?? '-') ?></small>
                                    </td>
                                    <?php if ($canEdit): ?>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="edit.php?id=<?= htmlspecialchars($row['nim']) ?>" class="btn btn-sm btn-outline-primary" title="Ubah Data">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal" 
                                                    data-id="<?= htmlspecialchars($row['nim']) ?>"
                                                    data-nama="<?= htmlspecialchars($row['nama']) ?>"
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
                    Tidak ada data mahasiswa yang tersedia.
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
                <p>Apakah Anda yakin ingin menghapus mahasiswa <strong id="deleteName"></strong>?</p>
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