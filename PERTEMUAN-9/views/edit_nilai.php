<?php
/**
 * Halaman Edit Data Nilai
 * Mengubah data nilai mahasiswa. Grade dihitung ulang otomatis.
 */

$pageTitle = 'Edit Data Nilai - SIAKAD Kampus';
require_once '../config/database.php';

// Pastikan session aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = '';
$data = null;
$id_nilai = $_GET['id'] ?? '';

// Validasi parameter ID
if (empty($id_nilai)) {
    $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'ID data tidak ditemukan!'];
    header('Location: view_nilai.php');
    exit;
}

$conn = getConnection();

// Ambil data nilai eksisting
$stmt = $conn->prepare("SELECT * FROM tbl_nilai WHERE id_nilai = ?");
$stmt->bind_param("i", $id_nilai);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Data tidak ditemukan!'];
    header('Location: view_nilai.php');
    exit;
}

$data = $result->fetch_assoc();

// Ambil data untuk dropdown
$mhsResult = $conn->query("SELECT nim, nama FROM tbl_mahasiswa ORDER BY nama ASC");
$mkResult  = $conn->query("SELECT kodeMatkul, namaMatkul FROM tbl_matkul ORDER BY namaMatkul ASC");

// Fungsi hitung Grade
function calculateGrade($score) {
    if ($score >= 80) return 'A';
    if ($score >= 70) return 'B';
    if ($score >= 60) return 'C';
    if ($score >= 50) return 'D';
    return 'E';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim        = $_POST['nim'];
    $kodeMatkul = $_POST['kodeMatkul'];
    $nilai      = $_POST['nilai'];

    // Validasi input
    if (empty($nim) || empty($kodeMatkul) || $nilai === '') {
        $error = 'Semua field wajib diisi!';
    } elseif (!is_numeric($nilai) || $nilai < 0 || $nilai > 100) {
        $error = 'Nilai harus berupa angka antara 0 sampai 100!';
    } else {
        // Cek dosen pengampu
        $checkDosen = $conn->prepare("SELECT nidn FROM tbl_matkul WHERE kodeMatkul = ?");
        $checkDosen->bind_param("s", $kodeMatkul);
        $checkDosen->execute();
        $resDosen = $checkDosen->get_result();
        
        if ($rowDosen = $resDosen->fetch_assoc()) {
            $nidn = $rowDosen['nidn'];
            
             // Hitung ulang Grade
             $nilaiHuruf = calculateGrade($nilai);
    
            // Update data
            $updateQuery = "UPDATE tbl_nilai SET nim = ?, kodeMatkul = ?, nidn = ?, nilai = ?, nilaiHuruf = ? WHERE id_nilai = ?";
            $stmtUpdate = $conn->prepare($updateQuery);
            $stmtUpdate->bind_param("sssisi", $nim, $kodeMatkul, $nidn, $nilai, $nilaiHuruf, $id_nilai);
    
            if ($stmtUpdate->execute()) {
                 $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => "Data nilai berhasil diperbarui! Grade: $nilaiHuruf"
                 ];
                 header('Location: view_nilai.php');
                exit;
            } else {
                $error = 'Gagal memperbarui data: ' . $conn->error;
            }
        } else {
            $error = 'Mata kuliah tidak valid atau tidak memiliki Dosen pengampu!';
        }
    }
}

require_once '../includes/header.php';
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
                            <div class="form-text">Dosen pengampu akan otomatis terisi sesuai mata kuliah (Tersimpan: <?= isset($data['nidn']) ? htmlspecialchars($data['nidn']) : 'Belum ada' ?>)</div>
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
