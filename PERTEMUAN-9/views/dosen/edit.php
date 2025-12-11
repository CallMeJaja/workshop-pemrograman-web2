<?php
/**
 * Halaman Edit Data Dosen
 * Memproses perubahan data dosen. NIDN bersifat read-only.
 */

$pageTitle = 'Edit Data Dosen - SIAKAD Kampus';
require_once '../../config/database.php';

// Pastikan session aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = '';
$data = null;
$nidn_param = $_GET['id'] ?? '';

// Validasi parameter ID
if (empty($nidn_param)) {
    $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'NIDN tidak ditemukan!'];
    header('Location: index.php');
    exit;
}

$conn = getConnection();

// Ambil data dosen eksisting
$stmt = $conn->prepare("SELECT * FROM tbl_dosen WHERE nidn = ?");
$stmt->bind_param("s", $nidn_param);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Data dosen tidak ditemukan!'];
    header('Location: index.php');
    exit;
}

$data = $result->fetch_assoc();

// Proses Update Form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama  = $_POST['nama'];
    $email = $_POST['email'];

    // Validasi data input
    if (empty($nama) || empty($email)) {
        $error = 'Semua field wajib diisi!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid!';
    } else {
        // Eksekusi update data
        $stmtUpdate = $conn->prepare("UPDATE tbl_dosen SET nama = ?, email = ? WHERE nidn = ?");
        $stmtUpdate->bind_param("sss", $nama, $email, $nidn_param);

        if ($stmtUpdate->execute()) {
             $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Data dosen berhasil diperbarui!'
             ];
             header('Location: index.php');
            exit;
        } else {
            $error = 'Gagal memperbarui data: ' . $conn->error;
        }
    }
}

require_once '../../includes/header.php';
?>

<!-- Header Halaman -->
<div class="bg-primary text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-0">
                    <i class="bi bi-pencil-square me-2"></i>Edit Dosen
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 mt-2">
                        <li class="breadcrumb-item"><a href="../../index.php" class="text-white-50">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="index.php" class="text-white-50">Data Dosen</a></li>
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
                    <h5 class="mb-0"><i class="bi bi-person-lines-fill me-2"></i>Form Edit Dosen</h5>
                </div>
                <div class="card-body">
                    
                    <?php if ($error): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i><?= $error ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="" method="POST" class="needs-validation" novalidate>
                        <!-- Hidden Old NIDN -->
                        <input type="hidden" name="nidn_old" value="<?= htmlspecialchars($data['nidn']) ?>">

                        <div class="mb-3">
                            <label for="nidn" class="form-label">NIDN</label>
                            <input type="text" class="form-control bg-light" id="nidn" name="nidn" value="<?= htmlspecialchars($data['nidn']) ?>" readonly>
                            <div class="form-text">NIDN tidak dapat diubah.</div>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" required value="<?= htmlspecialchars(isset($_POST['nama']) ? $_POST['nama'] : $data['nama']) ?>">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : $data['email']) ?>">
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="index.php" class="btn btn-secondary me-md-2">
                                <i class="bi bi-arrow-left me-1"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
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
