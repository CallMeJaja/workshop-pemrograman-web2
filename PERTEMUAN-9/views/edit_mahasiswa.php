<?php
/**
 * Halaman Edit Data Mahasiswa
 * Memproses perubahan data mahasiswa. NIM bersifat read-only.
 */

$pageTitle = 'Edit Data Mahasiswa - SIAKAD Kampus';
require_once '../config/database.php';

// Pastikan session aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = '';
$data = null;
$nim_param = $_GET['id'] ?? '';

// Validasi parameter ID
if (empty($nim_param)) {
    $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'ID data tidak ditemukan!'];
    header('Location: view_mahasiswa.php');
    exit;
}

$conn = getConnection();

// Ambil data mahasiswa eksisting
$stmt = $conn->prepare("SELECT * FROM tbl_mahasiswa WHERE nim = ?");
$stmt->bind_param("s", $nim_param);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Data mahasiswa tidak ditemukan!'];
    header('Location: view_mahasiswa.php');
    exit;
}

$data = $result->fetch_assoc();

// Proses Update Form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $angkatan = $_POST['angkatan'];
    $email = $_POST['email'];

    // Validasi data input
    if (empty($nama) || empty($prodi) || empty($angkatan) || empty($email)) {
        $error = 'Semua field wajib diisi!';
    } elseif (!is_numeric($angkatan) || strlen($angkatan) != 4) {
        $error = 'Tahun angkatan harus 4 digit angka!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid!';
    } else {
        // Eksekusi update
        $stmtUpdate = $conn->prepare("UPDATE tbl_mahasiswa SET nama = ?, prodi = ?, angkatan = ?, email = ? WHERE nim = ?");
        $stmtUpdate->bind_param("sssss", $nama, $prodi, $angkatan, $email, $nim_param);

        if ($stmtUpdate->execute()) {
             $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Data mahasiswa berhasil diperbarui!'
             ];
             header('Location: view_mahasiswa.php');
            exit;
        } else {
            $error = 'Gagal memperbarui data: ' . $conn->error;
        }
    }
}

require_once '../includes/header.php';
?>

<!-- Page Header -->
<div class="bg-success text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-0">
                    <i class="bi bi-pencil-square me-2"></i>Edit Mahasiswa
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 mt-2">
                        <li class="breadcrumb-item"><a href="../index.php" class="text-white-50">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="view_mahasiswa.php" class="text-white-50">Data Mahasiswa</a></li>
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
                    <h5 class="mb-0"><i class="bi bi-person-lines-fill me-2"></i>Form Edit Mahasiswa</h5>
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
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" class="form-control bg-light" id="nim" name="nim" value="<?= htmlspecialchars($data['nim']) ?>" readonly>
                            <div class="form-text">NIM tidak dapat diubah.</div>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" required value="<?= htmlspecialchars(isset($_POST['nama']) ? $_POST['nama'] : $data['nama']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="prodi" class="form-label">Program Studi</label>
                            <select class="form-select" id="prodi" name="prodi" required>
                                <option value="" disabled>Pilih Program Studi</option>
                                <?php
                                $prodiList = ['Teknik Informatika', 'Sistem Informasi', 'Manajemen Informatika', 'Komputerisasi Akuntansi'];
                                $currentProdi = isset($_POST['prodi']) ? $_POST['prodi'] : $data['prodi'];
                                foreach ($prodiList as $p) {
                                    $selected = ($currentProdi == $p) ? 'selected' : '';
                                    echo "<option value=\"$p\" $selected>$p</option>";
                                }
                                ?>
                            </select>
                        </div>

                         <div class="mb-3">
                            <label for="angkatan" class="form-label">Tahun Angkatan</label>
                            <input type="number" class="form-control" id="angkatan" name="angkatan" required min="2000" max="2099" value="<?= htmlspecialchars(isset($_POST['angkatan']) ? $_POST['angkatan'] : $data['angkatan']) ?>">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : $data['email']) ?>">
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="view_mahasiswa.php" class="btn btn-secondary me-md-2">
                                <i class="bi bi-arrow-left me-1"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-success">
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
