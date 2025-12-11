<?php
/**
 * Halaman Tambah Data Dosen
 * Memproses penambahan data dosen baru dengan validasi duplikasi NIDN.
 */

$pageTitle = 'Tambah Data Dosen - SIAKAD Kampus';
require_once '../config/database.php';

// Pastikan session aktif untuk flash message
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nidn  = $_POST['nidn'];
    $nama  = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $email = $_POST['email'];

    // Validasi kelengkapan dan format data
    if (empty($nidn) || empty($nama) || empty($prodi) || empty($email)) {
        $error = 'Semua field wajib diisi!';
    } elseif (!is_numeric($nidn)) {
        $error = 'NIDN harus berupa angka!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid!';
    } else {
        $conn = getConnection();

        // Cek duplikasi NIDN
        $stmtCheck = $conn->prepare("SELECT nidn FROM tbl_dosen WHERE nidn = ?");
        $stmtCheck->bind_param("s", $nidn);
        $stmtCheck->execute();

        if ($stmtCheck->get_result()->num_rows > 0) {
            $error = 'NIDN sudah terdaftar dalam sistem!';
        } else {
            // Simpan data baru
            $stmt = $conn->prepare("INSERT INTO tbl_dosen (nidn, nama, prodi, email) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nidn, $nama, $prodi, $email);

            if ($stmt->execute()) {
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Data dosen berhasil ditambahkan!'
                ];
                header('Location: view_dosen.php');
                exit;
            } else {
                $error = 'Terjadi kesalahan sistem: ' . $conn->error;
            }
        }
    }
}

require_once '../includes/header.php';
?>

<!-- Page Header -->
<div class="bg-primary text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-0">
                    <i class="bi bi-person-plus me-2"></i>Tambah Dosen
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 mt-2">
                        <li class="breadcrumb-item"><a href="../index.php" class="text-white-50">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="view_dosen.php" class="text-white-50">Data Dosen</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Tambah Baru</li>
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
                        <div class="mb-3">
                            <label for="nidn" class="form-label">NIDN (Nomor Induk Dosen Nasional)</label>
                            <input type="text" class="form-control" id="nidn" name="nidn" required placeholder="Masukkan NIDN (hanya angka)" value="<?= isset($_POST['nidn']) ? htmlspecialchars($_POST['nidn']) : '' ?>" pattern="[0-9]+" title="NIDN harus berupa angka">
                            <div class="form-text">Wajib angka, pastikan NIDN unik.</div>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" required placeholder="Contoh: Dr. Budi Santoso, M.Kom" value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="prodi" class="form-label">Program Studi</label>
                            <select class="form-select" id="prodi" name="prodi" required>
                                <option value="" selected disabled>Pilih Program Studi</option>
                                <option value="Teknik Informatika" <?= (isset($_POST['prodi']) && $_POST['prodi'] == 'Teknik Informatika') ? 'selected' : '' ?>>Teknik Informatika</option>
                                <option value="Sistem Informasi" <?= (isset($_POST['prodi']) && $_POST['prodi'] == 'Sistem Informasi') ? 'selected' : '' ?>>Sistem Informasi</option>
                                <option value="Manajemen Informatika" <?= (isset($_POST['prodi']) && $_POST['prodi'] == 'Manajemen Informatika') ? 'selected' : '' ?>>Manajemen Informatika</option>
                                <option value="Komputerisasi Akuntansi" <?= (isset($_POST['prodi']) && $_POST['prodi'] == 'Komputerisasi Akuntansi') ? 'selected' : '' ?>>Komputerisasi Akuntansi</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="email@kampus.ac.id" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="view_dosen.php" class="btn btn-secondary me-md-2">
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

<?php require_once '../includes/footer.php'; ?>
