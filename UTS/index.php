<?php
// Load semua dependencies
require_once 'config/constants.php';
require_once 'config/data.php';
require_once 'functions/validation.php';
require_once 'functions/calculation.php';

// Inisialisasi variabel
$anggota = getAnggotaTim();
$posisi = getPosisi();
$errors = [];
$result = null;

// Proses form jika di-submit
if (isset($_POST['submit'])) {
    // Sanitize input
    $data = sanitizeInput($_POST);

    // Validasi
    $errors = validateInput($_POST);

    // Jika valid, hitung gaji
    if (empty($errors)) {
        $result = prosesHitungGaji($data);
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Gaji Anggota Tim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid mt-5 px-4">
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Kalkulator Gaji Anggota Tim</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="anggota" class="form-label">Nama Anggota</label>
                                <select name="anggota" id="anggota" class="form-select" required>
                                    <option value="">Pilih Anggota</option>
                                    <?php foreach ($anggota as $a): ?>
                                        <option value="<?= $a ?>" <?= (isset($_POST['anggota']) && $_POST['anggota'] == $a) ? 'selected' : '' ?>>
                                            <?= $a ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Posisi</label>
                                <select name="role" id="role" class="form-select" required>
                                    <option value="">Pilih Posisi</option>
                                    <?php foreach ($posisi as $nama_posisi => $details): ?>
                                        <option value="<?= $nama_posisi ?>" <?= (isset($_POST['role']) && $_POST['role'] == $nama_posisi) ? 'selected' : '' ?>>
                                            <?= $nama_posisi ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="jam_kerja" class="form-label">Jam Kerja</label>
                                <input type="number" class="form-control" name="jam_kerja" id="jam_kerja"
                                    value="<?= $_POST['jam_kerja'] ?? '' ?>"
                                    min="1" max="<?= MAX_JAM_PER_BULAN ?>"
                                    placeholder="Contoh: 180" required>
                                <small class="text-muted">
                                    Jam kerja ideal: <?= JAM_IDEAL_PER_BULAN ?> jam/bulan (<?= JAM_IDEAL_PER_MINGGU ?> jam/minggu)
                                </small>
                                <div id="lembur-preview" class="small mt-1"></div>
                            </div>

                            <div class="mb-3">
                                <label for="harga_project" class="form-label">Harga Project (Rp)</label>
                                <input type="number" class="form-control" name="harga_project" id="harga_project"
                                    value="<?= $_POST['harga_project'] ?? '' ?>"
                                    min="<?= MIN_HARGA_PROJECT ?>"
                                    placeholder="Minimal Rp <?= number_format(MIN_HARGA_PROJECT, 0, ',', '.') ?>" required>
                                <small class="text-muted">
                                    Minimum: Rp <?= number_format(MIN_HARGA_PROJECT, 0, ',', '.') ?> | Rekomendasi: Rp 50.000.000 - Rp 1.000.000.000
                                </small>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary">Hitung Gaji</button>
                            <button type="reset" class="btn btn-secondary" onclick="window.location.href='index.php'">Reset</button>
                        </form>

                        <!-- Error Messages -->
                        <?php if (!empty($errors)): ?>
                            <hr>
                            <div class="alert alert-danger mt-3" role="alert">
                                <h5 class="alert-heading">Error Validasi Input</h5>
                                <ul class="mb-0">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Result -->
                        <?php if ($result): ?>
                            <hr>
                            <div class="card border-primary mt-3">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Slip Gaji Karyawan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <p class="mb-2"><strong>Nama Anggota:</strong><br><?= $result['nama'] ?></p>
                                            <p class="mb-2"><strong>Posisi:</strong><br>
                                                <span class="badge bg-<?= $result['badge_color'] ?> fs-6"><?= $result['role'] ?></span>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-2"><strong>Jam Kerja:</strong> <?= $result['jam_kerja'] ?> jam</p>
                                            <p class="mb-2"><strong>Jam Lembur:</strong>
                                                <?php if ($result['jam_lembur'] > 0): ?>
                                                    <span class="badge bg-warning text-dark"><?= $result['jam_lembur'] ?> jam</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">0 jam</span>
                                                <?php endif; ?>
                                            </p>
                                            <p class="mb-2"><strong>Harga Project:</strong> Rp<?= number_format($result['harga_project'], 0, ',', '.') ?></p>
                                        </div>
                                    </div>

                                    <hr>

                                    <h6 class="text-muted mb-3">Rincian Perhitungan Gaji:</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Komponen</th>
                                                    <th class="text-end">Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Upah dari Jam Kerja</td>
                                                    <td class="text-end">Rp<?= number_format($result['upah_jam_kerja'], 0, ',', '.') ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Upah dari Jam Lembur (<?= $result['persen_lembur'] ?>%)</td>
                                                    <td class="text-end">Rp<?= number_format($result['upah_lembur'], 0, ',', '.') ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Upah dari Fee Project (<?= $result['persen_fee'] ?>%)</td>
                                                    <td class="text-end">Rp<?= number_format($result['upah_fee'], 0, ',', '.') ?></td>
                                                </tr>
                                                <tr class="table-success">
                                                    <th>TOTAL UPAH</th>
                                                    <th class="text-end">Rp<?= number_format($result['total_upah'], 0, ',', '.') ?></th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="alert alert-info mb-0 mt-3">
                                        <small>
                                            <strong>Catatan:</strong>
                                            Upah per jam untuk <?= $result['role'] ?>: Rp<?= number_format($result['upah_per_jam'], 0, ',', '.') ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Sidebar Referensi -->
            <div class="col-lg-4">
                <div class="card sticky-top" style="top: 20px;">
                    <div class="card-header bg-warning">
                        <h5 class="mb-0">Referensi Ketentuan Gaji</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-3">Upah per Jam Berdasarkan Posisi</h6>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Posisi</th>
                                        <th class="text-end">Upah/Jam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($posisi as $nama_posisi => $details): ?>
                                        <tr>
                                            <td><?= $nama_posisi ?></td>
                                            <td class="text-end">Rp <?= number_format($details['upah_per_jam'], 0, ',', '.') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <h6 class="mb-3">Persentase Bonus</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Posisi</th>
                                        <th class="text-center">Lembur</th>
                                        <th class="text-center">Fee</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($posisi as $nama_posisi => $details): ?>
                                        <tr>
                                            <td><?= $nama_posisi ?></td>
                                            <td class="text-center"><?= $details['persen_lembur'] ?>%</td>
                                            <td class="text-center"><?= $details['persen_fee'] ?>%</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="alert alert-info mt-3 mb-0">
                            <small><strong>Catatan:</strong> Jam kerja ideal <?= JAM_IDEAL_PER_BULAN ?> jam/bulan. Kelebihan dihitung sebagai lembur.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>