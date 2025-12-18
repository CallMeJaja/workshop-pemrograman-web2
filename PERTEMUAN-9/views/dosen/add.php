<?php
require_once '../../controllers/DosenController.php';
require_once '../../helpers/auth.php';

// Cek login dan akses - hanya dosen
requireLogin();
requireRole('dosen');

$controller = new DosenController();
$error = '';
$pageTitle = 'Tambah Data Dosen - SIAKAD Kampus';

// Proses form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $controller->store($_POST);
    
    if ($result['success']) {
        setFlash('success', $result['message']);
        header('Location: index.php');
        exit;
    } else {
        $error = implode('<br>', $result['errors']);
    }
}

require_once '../../includes/header.php';
?>

<!-- Header Halaman -->
<div class="bg-primary text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-0">
                    <i class="bi bi-person-plus me-2"></i>Tambah Dosen
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 mt-2">
                        <li class="breadcrumb-item"><a href="../../index.php" class="text-white-50">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="index.php" class="text-white-50">Data Dosen</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Tambah Baru</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Konten Utama -->
<main class="container mb-5">
    <div class="row justify-center">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Form Input Dosen</h5>
                </div>
                <div class="card-body">
                    
                    <?php if ($error): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i><?= $error ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="" method="POST" class="needs-validation" novalidate>
                        <?= csrfField() ?>
                        <div class="mb-3">
                            <label for="nidn" class="form-label">NIDN (Nomor Induk Dosen Nasional)</label>
                            <input type="text" class="form-control" id="nidn" name="nidn" required placeholder="Masukkan NIDN (hanya angka)" value="<?= isset($_POST['nidn']) ? htmlspecialchars($_POST['nidn']) : '' ?>" pattern="[0-9]+" title="NIDN harus berupa angka">
                            <div class="form-text">Wajib angka, pastikan NIDN unik.</div>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" required placeholder="Contoh: Dr. Budi Santoso, M.Kom" value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '' ?>">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="email@kampus.ac.id" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="index.php" class="btn btn-secondary me-md-2">
                                <i class="bi bi-arrow-left me-1"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i>Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once '../../includes/footer.php'; ?>
