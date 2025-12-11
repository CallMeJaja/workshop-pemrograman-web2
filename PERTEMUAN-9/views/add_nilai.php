<?php
/**
 * Halaman Tambah Data Nilai
 * Memproses input nilai mahasiswa. Grade dihitung otomatis.
 */

$pageTitle = 'Tambah Data Nilai - SIAKAD Kampus';
require_once '../config/database.php';

// Pastikan session aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = '';

$conn = getConnection();

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
        // Otomatis ambil Dosen pengampu berdasarkan Mata Kuliah
        $checkDosen = $conn->prepare("SELECT nidn FROM tbl_matkul WHERE kodeMatkul = ?");
        $checkDosen->bind_param("s", $kodeMatkul);
        $checkDosen->execute();
        $resDosen = $checkDosen->get_result();
        
        if ($rowDosen = $resDosen->fetch_assoc()) {
            $nidn = $rowDosen['nidn'];
            
            // Hitung Grade Huruf
            $nilaiHuruf = calculateGrade($nilai);
    
            // Simpan data nilai
            $stmt = $conn->prepare("INSERT INTO tbl_nilai (nim, kodeMatkul, nidn, nilai, nilaiHuruf) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssis", $nim, $kodeMatkul, $nidn, $nilai, $nilaiHuruf);
    
            if ($stmt->execute()) {
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => "Data nilai berhasil ditambahkan! Grade: $nilaiHuruf"
                ];
                header('Location: view_nilai.php');
                exit;
            } else {
                $error = 'Terjadi kesalahan sistem: ' . $conn->error;
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
                    <i class="bi bi-file-earmark-plus me-2"></i>Tambah Data Nilai
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 mt-2">
                        <li class="breadcrumb-item"><a href="../index.php" class="text-dark">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="view_nilai.php" class="text-dark">Data Nilai</a></li>
                        <li class="breadcrumb-item active text-dark" aria-current="page">Tambah Baru</li>
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
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Form Input Nilai</h5>
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
                                <option value="" selected disabled>Pilih Mahasiswa</option>
                                <?php
                                $mhsResult->data_seek(0);
                                while ($mhs = $mhsResult->fetch_assoc()) {
                                    $selected = (isset($_POST['nim']) && $_POST['nim'] == $mhs['nim']) ? 'selected' : '';
                                    echo "<option value='" . $mhs['nim'] . "' $selected>" . $mhs['nama'] . " (" . $mhs['nim'] . ")</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="kodeMatkul" class="form-label">Mata Kuliah</label>
                            <select class="form-select" id="kodeMatkul" name="kodeMatkul" required>
                                <option value="" selected disabled>Pilih Mata Kuliah</option>
                                <?php
                                $mkResult->data_seek(0);
                                while ($mk = $mkResult->fetch_assoc()) {
                                    $selected = (isset($_POST['kodeMatkul']) && $_POST['kodeMatkul'] == $mk['kodeMatkul']) ? 'selected' : '';
                                    echo "<option value='" . $mk['kodeMatkul'] . "' $selected>" . $mk['namaMatkul'] . " (" . $mk['kodeMatkul'] . ")</option>";
                                }
                                ?>
                            </select>
                            <div class="form-text">Dosen pengampu akan otomatis terisi sesuai mata kuliah.</div>
                        </div>

                        <div class="mb-4">
                            <label for="nilai" class="form-label">Nilai Akhir (0-100)</label>
                            <input type="number" class="form-control" id="nilai" name="nilai" required min="0" max="100" placeholder="Contoh: 85" value="<?= isset($_POST['nilai']) ? htmlspecialchars($_POST['nilai']) : '' ?>">
                            <div class="form-text">Nilai Huruf (A, B, C, D, E) akan dikonversi otomatis.</div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="view_nilai.php" class="btn btn-secondary me-md-2">
                                <i class="bi bi-arrow-left me-1"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-warning text-dark fw-bold">
                                <i class="bi bi-save me-1"></i>Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once '../includes/footer.php'; ?>
