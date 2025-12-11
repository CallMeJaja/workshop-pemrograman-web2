<?php
/**
 * Edit Data Nilai
 * Form untuk mengubah data nilai di tbl_nilai
 */

$pageTitle = 'Edit Data Nilai - SIAKAD Kampus';
require_once '../config/database.php';
require_once '../includes/header.php';

$error = '';
$success = '';
$data = null;

// Get ID from URL
$id_nilai = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($id_nilai)) {
    echo "<script>alert('ID tidak ditemukan!'); window.location.href='view_nilai.php';</script>";
    exit;
}

$conn = getConnection();

// Fetch Data Nilai
$query = "SELECT * FROM tbl_nilai WHERE id_nilai = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_nilai);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='view_nilai.php';</script>";
    exit;
}

$data = $result->fetch_assoc();

// Fetch Data for Dropdowns
$mhsQuery = "SELECT nim, nama FROM tbl_mahasiswa ORDER BY nama ASC";
$mhsResult = $conn->query($mhsQuery);

$mkQuery = "SELECT kodeMatkul, namaMatkul FROM tbl_matkul ORDER BY namaMatkul ASC";
$mkResult = $conn->query($mkQuery);

$dosenQuery = "SELECT nidn, nama FROM tbl_dosen ORDER BY nama ASC";
$dosenResult = $conn->query($dosenQuery);

// Function to calculate grade letter
function calculateGrade($score) {
    if ($score >= 80) return 'A';
    if ($score >= 70) return 'B';
    if ($score >= 60) return 'C';
    if ($score >= 50) return 'D';
    return 'E';
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $kodeMatkul = $_POST['kodeMatkul'];
    $nidn = $_POST['nidn'];
    $nilai = $_POST['nilai'];

    // Validasi Input
    if (empty($nim) || empty($kodeMatkul) || empty($nidn) || $nilai === '') {
        $error = 'Semua field harus diisi!';
    } elseif (!is_numeric($nilai) || $nilai < 0 || $nilai > 100) {
        $error = 'Nilai harus berupa angka antara 0 sampai 100!';
    } else {
         // Calculate Grade Letter
         $nilaiHuruf = calculateGrade($nilai);

        // Update data
        $updateQuery = "UPDATE tbl_nilai SET nim = ?, kodeMatkul = ?, nidn = ?, nilai = ?, nilaiHuruf = ? WHERE id_nilai = ?";
        $stmtUpdate = $conn->prepare($updateQuery);
        $stmtUpdate->bind_param("sssisi", $nim, $kodeMatkul, $nidn, $nilai, $nilaiHuruf, $id_nilai);

        if ($stmtUpdate->execute()) {
             echo "<script>
                    alert('Data nilai berhasil diperbarui! Grade: $nilaiHuruf');
                    window.location.href = 'view_nilai.php';
                  </script>";
            exit;
        } else {
            $error = 'Gagal memperbarui data: ' . $conn->error;
        }
    }
}
?>

<!-- Page Header -->
<div class="bg-warning text-dark py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-0">
                    <i class="bi bi-pencil-square me-2"></i>Edit Data Nilai
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 mt-2">
                        <li class="breadcrumb-item"><a href="../index.php" class="text-dark">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="view_nilai.php" class="text-dark">Data Nilai</a></li>
                        <li class="breadcrumb-item active text-dark" aria-current="page">Edit Data</li>
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
                        <div class="mb-3">
                            <label for="nim" class="form-label">Mahasiswa</label>
                            <select class="form-select" id="nim" name="nim" required>
                                <option value="" disabled>Pilih Mahasiswa</option>
                                <?php
                                if ($mhsResult->num_rows > 0) {
                                    $currentMhs = isset($_POST['nim']) ? $_POST['nim'] : $data['nim'];
                                    while ($mhs = $mhsResult->fetch_assoc()) {
                                        $selected = ($currentMhs == $mhs['nim']) ? 'selected' : '';
                                        echo "<option value='" . $mhs['nim'] . "' $selected>" . $mhs['nama'] . " (" . $mhs['nim'] . ")</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="kodeMatkul" class="form-label">Mata Kuliah</label>
                            <select class="form-select" id="kodeMatkul" name="kodeMatkul" required>
                                <option value="" disabled>Pilih Mata Kuliah</option>
                                <?php
                                if ($mkResult->num_rows > 0) {
                                    $currentMk = isset($_POST['kodeMatkul']) ? $_POST['kodeMatkul'] : $data['kodeMatkul'];
                                    while ($mk = $mkResult->fetch_assoc()) {
                                        $selected = ($currentMk == $mk['kodeMatkul']) ? 'selected' : '';
                                        echo "<option value='" . $mk['kodeMatkul'] . "' $selected>" . $mk['namaMatkul'] . " (" . $mk['kodeMatkul'] . ")</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
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

                        <div class="mb-4">
                            <label for="nilai" class="form-label">Nilai Akhir (0-100)</label>
                            <input type="number" class="form-control" id="nilai" name="nilai" required min="0" max="100" value="<?= htmlspecialchars(isset($_POST['nilai']) ? $_POST['nilai'] : $data['nilai']) ?>">
                            <div class="form-text">Nilai Huruf (A, B, C, D, E) akan dikonversi otomatis.</div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="view_nilai.php" class="btn btn-secondary me-md-2">
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

<?php require_once '../includes/footer.php'; ?>
