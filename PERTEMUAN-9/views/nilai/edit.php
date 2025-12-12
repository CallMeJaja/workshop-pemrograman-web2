<?php
/**
 * Halaman Edit Nilai
 * Menggunakan arsitektur MVC.
 */

require_once '../../controllers/NilaiController.php';

$controller = new NilaiController();
$error = '';
$id_nilai = $_GET['id'] ?? '';

// Validasi parameter ID
if (empty($id_nilai)) {
    setFlash('error', 'ID Nilai tidak ditemukan!');
    header('Location: index.php');
    exit;
}

// Ambil data nilai
$editData = $controller->edit($id_nilai);

if (!$editData) {
    setFlash('error', 'Data tidak ditemukan!');
    header('Location: index.php');
    exit;
}

$data = $editData['nilai'];
$mahasiswaList = $editData['mahasiswa'];
$matkulList = $editData['matkul'];
$dosenList = $editData['dosen'];
$pageTitle = $editData['pageTitle'];

// Proses Update Form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $controller->update($id_nilai, $_POST);
    
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
<div class="bg-warning py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-0">
                    <i class="bi bi-pencil-square me-2"></i>Edit Data Nilai
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 mt-2">
                        <li class="breadcrumb-item"><a href="../../index.php" class="text-dark">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="index.php" class="text-dark">Data Nilai</a></li>
                        <li class="breadcrumb-item active text-dark" aria-current="page">Edit Data</li>
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
                    <h5 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Form Edit Nilai</h5>
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
                            <label for="nim" class="form-label">Mahasiswa</label>
                            <select class="form-select" id="nim" name="nim" required>
                                <option value="" disabled>Pilih Mahasiswa</option>
                                <?php
                                $currentMhs = isset($_POST['nim']) ? $_POST['nim'] : $data['nim'];
                                foreach ($mahasiswaList as $mhs) {
                                    $selected = ($currentMhs == $mhs['nim']) ? 'selected' : '';
                                    echo "<option value='" . htmlspecialchars($mhs['nim']) . "' $selected>" . htmlspecialchars($mhs['nama']) . " (" . htmlspecialchars($mhs['nim']) . ")</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="kodeMatkul" class="form-label">Mata Kuliah</label>
                            <select class="form-select" id="kodeMatkul" name="kodeMatkul" required>
                                <option value="" disabled>Pilih Mata Kuliah</option>
                                <?php
                                $currentMk = isset($_POST['kodeMatkul']) ? $_POST['kodeMatkul'] : $data['kodeMatkul'];
                                foreach ($matkulList as $mk) {
                                    $selected = ($currentMk == $mk['kodeMatkul']) ? 'selected' : '';
                                    echo "<option value='" . htmlspecialchars($mk['kodeMatkul']) . "' $selected>" . htmlspecialchars($mk['namaMatkul']) . " (" . htmlspecialchars($mk['kodeMatkul']) . ")</option>";
                                }
                                ?>
                            </select>
                            <div class="form-text">Dosen pengampu akan otomatis terisi sesuai mata kuliah (Tersimpan: <?= isset($data['nidn']) ? htmlspecialchars($data['nidn']) : 'Belum ada' ?>)</div>
                        </div>

                        <div class="mb-4">
                            <label for="nilai" class="form-label">Nilai Akhir (0-100)</label>
                            <input type="number" class="form-control" id="nilai" name="nilai" required min="0" max="100" value="<?= htmlspecialchars(isset($_POST['nilai']) ? $_POST['nilai'] : $data['nilai']) ?>">
                            <div class="form-text">Nilai Huruf (A, B, C, D, E) akan dikonversi otomatis.</div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="index.php" class="btn btn-secondary me-md-2">
                                <i class="bi bi-arrow-left me-1"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-warning text-dark fw-bold">
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
