<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Formulir Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0 text-center">Hasil Formulir Pendaftaran</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            // Ambil data dari form
                            $nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
                            $ttl = isset($_POST['ttl']) ? trim($_POST['ttl']) : '';
                            $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
                            $bulan = isset($_POST['bulan']) ? $_POST['bulan'] : '';
                            $tahun = isset($_POST['tahun']) ? $_POST['tahun'] : '';
                            $alamat = isset($_POST['alamat']) ? trim($_POST['alamat']) : '';
                            $jenis_kelamin = isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : '';
                            $nilai_un = isset($_POST['nilai_un']) ? $_POST['nilai_un'] : '';

                            // Validasi input
                            $errors = [];

                            if (empty($nama)) {
                                $errors[] = "Nama lengkap harus diisi.";
                            } elseif (strlen($nama) < 3) {
                                $errors[] = "Nama lengkap minimal 3 karakter.";
                            }

                            if (empty($ttl)) {
                                $errors[] = "Tempat lahir harus diisi.";
                            }

                            if (empty($tanggal) || empty($bulan) || empty($tahun)) {
                                $errors[] = "Tanggal lahir harus diisi lengkap (tanggal, bulan, dan tahun).";
                            }

                            if (empty($alamat)) {
                                $errors[] = "Alamat rumah harus diisi.";
                            } elseif (strlen($alamat) < 10) {
                                $errors[] = "Alamat rumah minimal 10 karakter.";
                            }

                            if (empty($jenis_kelamin)) {
                                $errors[] = "Jenis kelamin harus dipilih.";
                            }

                            if ($nilai_un === '') {
                                $errors[] = "Nilai UN harus diisi.";
                            } elseif (!is_numeric($nilai_un)) {
                                $errors[] = "Nilai UN harus berupa angka.";
                            } elseif ($nilai_un < 0 || $nilai_un > 100) {
                                $errors[] = "Nilai UN harus berada dalam rentang 0-100.";
                            }

                            // Jika ada error, tampilkan pesan error
                            if (!empty($errors)) {
                        ?>
                                <div class="alert alert-danger" role="alert">
                                    <h5 class="alert-heading"><i class="bi bi-exclamation-triangle-fill"></i> Error Validasi Input!</h5>
                                    <p>Terdapat kesalahan dalam pengisian formulir:</p>
                                    <ul class="mb-0">
                                        <?php foreach ($errors as $error): ?>
                                            <li><?php echo htmlspecialchars($error); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <a href="index.php" class="btn btn-primary">
                                    <i class="bi bi-arrow-left"></i> Kembali ke Formulir
                                </a>
                            <?php
                            } else {
                                // Jika tidak ada error, tampilkan hasil
                                $tgl_lahir = $tanggal . " " . $bulan . " " . $tahun;
                            ?>
                                <div class="alert alert-success" role="alert">
                                    <h5 class="alert-heading"><i class="bi bi-check-circle-fill"></i> Pendaftaran Berhasil!</h5>
                                    <p>Data pendaftaran Anda telah diterima dengan detail sebagai berikut:</p>
                                </div>

                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th width="30%" class="table-light">Nama Lengkap</th>
                                            <td><?php echo htmlspecialchars($nama); ?></td>
                                        </tr>
                                        <tr>
                                            <th class="table-light">Tempat Lahir</th>
                                            <td><?php echo htmlspecialchars($ttl); ?></td>
                                        </tr>
                                        <tr>
                                            <th class="table-light">Tanggal Lahir</th>
                                            <td><?php echo htmlspecialchars($tgl_lahir); ?></td>
                                        </tr>
                                        <tr>
                                            <th class="table-light">Alamat Rumah</th>
                                            <td><?php echo nl2br(htmlspecialchars($alamat)); ?></td>
                                        </tr>
                                        <tr>
                                            <th class="table-light">Jenis Kelamin</th>
                                            <td><?php echo htmlspecialchars($jenis_kelamin); ?></td>
                                        </tr>
                                        <tr>
                                            <th class="table-light">Nilai UN</th>
                                            <td>
                                                <strong><?php echo number_format($nilai_un, 2, ',', '.'); ?></strong>
                                                <?php
                                                if ($nilai_un >= 80) {
                                                    echo '<span class="badge bg-success ms-2">Sangat Baik</span>';
                                                } elseif ($nilai_un >= 70) {
                                                    echo '<span class="badge bg-info ms-2">Baik</span>';
                                                } elseif ($nilai_un >= 60) {
                                                    echo '<span class="badge bg-warning ms-2">Cukup</span>';
                                                } else {
                                                    echo '<span class="badge bg-danger ms-2">Kurang</span>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="d-grid gap-2">
                                    <a href="index.php" class="btn btn-primary">
                                        <i class="bi bi-arrow-left"></i> Kembali ke Formulir
                                    </a>
                                </div>
                            <?php
                            }
                        } else {
                            // Jika diakses langsung tanpa POST
                            ?>
                            <div class="alert alert-warning" role="alert">
                                <h5 class="alert-heading"><i class="bi bi-exclamation-triangle-fill"></i> Akses Tidak Valid!</h5>
                                <p>Halaman ini hanya dapat diakses melalui pengisian formulir.</p>
                            </div>
                            <a href="index.php" class="btn btn-primary">
                                <i class="bi bi-arrow-left"></i> Kembali ke Formulir
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>