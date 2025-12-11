<?php
/**
 * Edit Data Dosen
 * Form untuk mengubah data dosen di tbl_dosen
 */

$pageTitle = 'Edit Data Dosen - SIAKAD Kampus';
require_once '../config/database.php';
require_once '../includes/header.php';

$error = '';
$success = '';
$data = null;

// Get ID from URL
$nidn_param = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($nidn_param)) {
    echo "<script>alert('ID tidak ditemukan!'); window.location.href='view_dosen.php';</script>";
    exit;
}

$conn = getConnection();

// Fetch Data
$query = "SELECT * FROM tbl_dosen WHERE nidn = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $nidn_param);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='view_dosen.php';</script>";
    exit;
}

$data = $result->fetch_assoc();

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nidn_old = $_POST['nidn_old']; // Keep track of old ID if needed, but here we use it for Where clause if we allowed ID change. 
    // Since we are making NIDN readonly (usually good practice), use nidn_old or just use the readonly value.
    // However, if we want to follow strict security, we use the param or hidden field.
    
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $email = $_POST['email'];

    // Validasi Input
    if (empty($nama) || empty($prodi) || empty($email)) {
        $error = 'Nama, Prodi, dan Email harus diisi!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid!';
    } else {
        // Update data
        // NIDN is Primary Key and usually not editable, so using WHERE nidn = ? with the original value
        $updateQuery = "UPDATE tbl_dosen SET nama = ?, prodi = ?, email = ? WHERE nidn = ?";
        $stmtUpdate = $conn->prepare($updateQuery);
        $stmtUpdate->bind_param("ssss", $nama, $prodi, $email, $nidn_param);

        if ($stmtUpdate->execute()) {
             echo "<script>
                    alert('Data dosen berhasil diperbarui!');
                    window.location.href = 'view_dosen.php';
                  </script>";
            exit;
        } else {
            $error = 'Gagal memperbarui data: ' . $conn->error;
        }
    }
}
?>

<!-- Page Header -->
<div class="bg-primary text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-0">
                    <i class="bi bi-pencil-square me-2"></i>Edit Dosen
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 mt-2">
                        <li class="breadcrumb-item"><a href="../index.php" class="text-white-50">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="view_dosen.php" class="text-white-50">Data Dosen</a></li>
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

                        <div class="mb-4">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : $data['email']) ?>">
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="view_dosen.php" class="btn btn-secondary me-md-2">
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

<?php require_once '../includes/footer.php'; ?>
