<?php
/**
 * Halaman Input Nilai
 * Memproses input nilai mahasiswa untuk mata kuliah tertentu.
 */

$pageTitle = 'Input Nilai - SIAKAD Kampus';
require_once '../../config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$conn = getConnection();
$error = '';

// Data dropdown
$mhsResult = $conn->query("SELECT nim, nama FROM tbl_mahasiswa ORDER BY nama ASC");
$mkResult = $conn->query("SELECT kodeMatkul, namaMatkul FROM tbl_matkul ORDER BY namaMatkul ASC");
$dosenResult = $conn->query("SELECT nidn, nama FROM tbl_dosen ORDER BY nama ASC");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim        = $_POST['nim'];
    $kodeMatkul = $_POST['kodeMatkul'];
    $nidn       = isset($_POST['nidn']) ? $_POST['nidn'] : null; // NIDN might need to be fetched via JS or separate selection, but let's assume hidden field or auto-select. Wait, add.php doesn't have NIDN input? Checking file content... it does not have NIDN input visible in form!! It says "Dosen pengampu akan otomatis terisi". That requires JS or backend lookup. For now, let's fix the column names.
    // Wait, add.php logic: INSERT INTO tbl_nilai ... VALUES ... $nidn. 
    // BUT the form doesn't send nidn. It says "Dosen pengampu akan otomatis terisi".
    // AND the previous code expected $_POST['nidn'].
    // If the form doesn't have it, $_POST['nidn'] is null/undefined.
    // Let's Add NIDN lookup based on KodeMatkul before insert.
    $nilai      = $_POST['nilai'];

    if (!empty($kodeMatkul)) {
        $stmtDosen = $conn->prepare("SELECT nidn FROM tbl_matkul WHERE kodeMatkul = ?");
        $stmtDosen->bind_param("s", $kodeMatkul);
        $stmtDosen->execute();
        $resDosen = $stmtDosen->get_result();
        if ($resDosen->num_rows > 0) {
            $d = $resDosen->fetch_assoc();
            $nidn = $d['nidn'];
        }
    }

    if (empty($nim) || empty($kodeMatkul) || empty($nidn) || $nilai === '') {
        $error = 'Semua field wajib diisi! Pastikan Mata Kuliah memiliki Dosen Pengampu.';
    } elseif (!is_numeric($nilai) || $nilai < 0 || $nilai > 100) {
        $error = 'Nilai harus berupa angka antara 0 - 100!';
    } else {
        $grade = '';
        if ($nilai >= 85) $grade = 'A';
        elseif ($nilai >= 75) $grade = 'B';
        elseif ($nilai >= 60) $grade = 'C';
        elseif ($nilai >= 50) $grade = 'D';
        else $grade = 'E';
        
        $nilaiHuruf = $grade;

        $stmt = $conn->prepare("INSERT INTO tbl_nilai (nim, kodeMatkul, nidn, nilai, nilaiHuruf) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssds", $nim, $kodeMatkul, $nidn, $nilai, $nilaiHuruf); // 'd' for double if nilai is decimal, otherwise 'i' or 'd' works. Assuming decimal/float.

        if ($stmt->execute()) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Nilai berhasil disimpan!'
            ];
            header('Location: index.php');
            exit;
        } else {
            $error = 'Terjadi kesalahan sistem: ' . $conn->error;
        }
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
                    <i class="bi bi-file-earmark-plus me-2"></i>Tambah Data Nilai
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 mt-2">
                        <li class="breadcrumb-item"><a href="../../index.php" class="text-dark">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="index.php" class="text-dark">Data Nilai</a></li>
                        <li class="breadcrumb-item active text-dark" aria-current="page">Tambah Baru</li>
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
                            <a href="index.php" class="btn btn-secondary me-md-2">
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

<?php require_once '../../includes/footer.php'; ?>
