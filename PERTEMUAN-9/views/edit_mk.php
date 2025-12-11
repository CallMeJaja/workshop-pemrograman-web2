<?php
/**
 * Edit Data Mata Kuliah
 * Form untuk mengubah data mata kuliah di tbl_matkul
 */

$pageTitle = 'Edit Data Mata Kuliah - SIAKAD Kampus';
require_once '../config/database.php';
require_once '../includes/header.php';

$error = '';
$success = '';
$data = null;

// Get ID from URL
// Check both 'id' (standard) and 'kode' (legacy support if any)
$kode_param = isset($_GET['id']) ? $_GET['id'] : (isset($_GET['kode']) ? $_GET['kode'] : '');

if (empty($kode_param)) {
    echo "<script>alert('Kode MK tidak ditemukan!'); window.location.href='view_mk.php';</script>";
    exit;
}

$conn = getConnection();

// Fetch Data MK
$query = "SELECT * FROM tbl_matkul WHERE kodeMatkul = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $kode_param);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='view_mk.php';</script>";
    exit;
}

$data = $result->fetch_assoc();

// Fetch Dosen Data for Dropdown
$dosenQuery = "SELECT nidn, nama FROM tbl_dosen ORDER BY nama ASC";
$dosenResult = $conn->query($dosenQuery);

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namaMatkul = $_POST['namaMatkul'];
    $sks = $_POST['sks'];
    $nidn = $_POST['nidn'];

    // Validasi Input
    if (empty($namaMatkul) || empty($sks) || empty($nidn)) {
        $error = 'Semua field harus diisi!';
    } elseif (!is_numeric($sks) || $sks < 1 || $sks > 6) {
        $error = 'SKS harus berupa angka antara 1 sampai 6!';
    } else {
        // Update data
        $updateQuery = "UPDATE tbl_matkul SET namaMatkul = ?, sks = ?, nidn = ? WHERE kodeMatkul = ?";
        $stmtUpdate = $conn->prepare($updateQuery);
        $stmtUpdate->bind_param("siss", $namaMatkul, $sks, $nidn, $kode_param);

        if ($stmtUpdate->execute()) {
             echo "<script>
                    alert('Data mata kuliah berhasil diperbarui!');
                    window.location.href = 'view_mk.php';
                  </script>";
            exit;
        } else {
            $error = 'Gagal memperbarui data: ' . $conn->error;
        }
    }
}
?>

<!-- Page Header -->
<div class="bg-info text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-0">
                    <i class="bi bi-pencil-square me-2"></i>Edit Mata Kuliah
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 mt-2">
                        <li class="breadcrumb-item"><a href="../index.php" class="text-white-50">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="view_mk.php" class="text-white-50">Data Mata Kuliah</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Edit Data</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
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
                                if ($dosenResult->num_rows > 0) {
                                    $currentDosen = isset($_POST['nidn']) ? $_POST['nidn'] : $data['nidn'];
                                    while ($dosen = $dosenResult->fetch_assoc()) {
                                        $selected = ($currentDosen == $dosen['nidn']) ? 'selected' : '';
                                        echo "<option value='" . $dosen['nidn'] . "' $selected>" . $dosen['nama'] . " (" . $dosen['nidn'] . ")</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="view_mk.php" class="btn btn-secondary me-md-2">
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

<?php require_once '../includes/footer.php'; ?>
