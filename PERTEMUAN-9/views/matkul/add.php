<?php
/**
 * Halaman Tambah Mata Kuliah
 * Menggunakan arsitektur MVC.
 */

require_once '../../controllers/MatkulController.php';

$controller = new MatkulController();
$error = '';
$createData = $controller->create();
$pageTitle = $createData['pageTitle'];
$dosenList = $createData['dosen'];

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
<div class="bg-info text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-0">
                    <i class="bi bi-journal-plus me-2"></i>Tambah Mata Kuliah
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 mt-2">
                        <li class="breadcrumb-item"><a href="../../index.php" class="text-white-50">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="index.php" class="text-white-50">Data Mata Kuliah</a></li>
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
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Form Input Mata Kuliah</h5>
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
                            <label for="kodeMatkul" class="form-label">Kode Mata Kuliah</label>
                            <input type="text" class="form-control" id="kodeMatkul" name="kodeMatkul" required placeholder="Contoh: MK001" value="<?= isset($_POST['kodeMatkul']) ? htmlspecialchars($_POST['kodeMatkul']) : '' ?>">
                            <div class="form-text">Pastikan kode unik.</div>
                        </div>

                        <div class="mb-3">
                            <label for="namaMatkul" class="form-label">Nama Mata Kuliah</label>
                            <input type="text" class="form-control" id="namaMatkul" name="namaMatkul" required placeholder="Contoh: Pemrograman Web" value="<?= isset($_POST['namaMatkul']) ? htmlspecialchars($_POST['namaMatkul']) : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="sks" class="form-label">Jumlah SKS</label>
                            <input type="number" class="form-control" id="sks" name="sks" required min="1" max="6" placeholder="1-6" value="<?= isset($_POST['sks']) ? htmlspecialchars($_POST['sks']) : '' ?>">
                        </div>

                        <div class="mb-4">
                            <label for="nidn" class="form-label">Dosen Pengampu</label>
                            <select class="form-select" id="nidn" name="nidn" required>
                                <option value="" selected disabled>Pilih Dosen</option>
                                <?php
                                foreach ($dosenList as $dosen) {
                                    $selected = (isset($_POST['nidn']) && $_POST['nidn'] == $dosen['nidn']) ? 'selected' : '';
                                    echo "<option value='" . htmlspecialchars($dosen['nidn']) . "' $selected>" . htmlspecialchars($dosen['nama']) . " (" . htmlspecialchars($dosen['nidn']) . ")</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="index.php" class="btn btn-secondary me-md-2">
                                <i class="bi bi-arrow-left me-1"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-info text-white">
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
