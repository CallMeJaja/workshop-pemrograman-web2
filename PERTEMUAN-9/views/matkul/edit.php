<?php
/**
 * Halaman Edit Mata Kuliah
 * Menggunakan arsitektur MVC.
 */

require_once '../../controllers/MatkulController.php';

$controller = new MatkulController();
$error = '';
$kode_mk_param = $_GET['id'] ?? '';

// Validasi parameter ID
if (empty($kode_mk_param)) {
    setFlash('error', 'Kode Mata Kuliah tidak ditemukan!');
    header('Location: index.php');
    exit;
}

// Ambil data mata kuliah
$editData = $controller->edit($kode_mk_param);

if (!$editData) {
    setFlash('error', 'Mata kuliah tidak ditemukan!');
    header('Location: index.php');
    exit;
}

$data = $editData['matkul'];
$dosenList = $editData['dosen'];
$pageTitle = $editData['pageTitle'];

// Proses Update Form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $controller->update($kode_mk_param, $_POST);
    
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
                    <i class="bi bi-pencil-square me-2"></i>Edit Mata Kuliah
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 mt-2">
                        <li class="breadcrumb-item"><a href="../../index.php" class="text-white-50">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="index.php" class="text-white-50">Data Mata Kuliah</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Edit Data</li>
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
                    <h5 class="mb-0"><i class="bi bi-book me-2"></i>Form Edit Mata Kuliah</h5>
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
                            <input type="text" class="form-control bg-light" id="kodeMatkul" name="kodeMatkul" value="<?= htmlspecialchars($data['kodeMatkul']) ?>" readonly>
                            <div class="form-text">Kode MK tidak dapat diubah.</div>
                        </div>

                        <div class="mb-3">
                            <label for="namaMatkul" class="form-label">Nama Mata Kuliah</label>
                            <input type="text" class="form-control" id="namaMatkul" name="namaMatkul" required value="<?= htmlspecialchars(isset($_POST['namaMatkul']) ? $_POST['namaMatkul'] : $data['namaMatkul']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="sks" class="form-label">Jumlah SKS</label>
                            <input type="number" class="form-control" id="sks" name="sks" required min="1" max="6" value="<?= htmlspecialchars(isset($_POST['sks']) ? $_POST['sks'] : $data['sks']) ?>">
                        </div>

                        <div class="mb-4">
                            <label for="nidn" class="form-label">Dosen Pengampu</label>
                            <select class="form-select" id="nidn" name="nidn" required>
                                <option value="" disabled>Pilih Dosen</option>
                                <?php
                                $currentDosen = isset($_POST['nidn']) ? $_POST['nidn'] : $data['nidn'];
                                foreach ($dosenList as $dosen) {
                                    $selected = ($currentDosen == $dosen['nidn']) ? 'selected' : '';
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
                                <i class="bi bi-save me-1"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once '../../includes/footer.php'; ?>
