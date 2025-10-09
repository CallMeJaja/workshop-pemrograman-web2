<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soal 1 - Kalkulator Bunga Tabungan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Soal 1 - Kalkulator Bunga Tabungan</h3>
                    </div>
                    <div class="card-body">
                        <a href="index.php" class="btn btn-secondary mb-3">Kembali</a>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="saldo_awal" class="form-label">Saldo Awal (Rp)</label>
                                <input type="number" class="form-control" id="saldo_awal" name="saldo_awal"
                                    value="<?php echo isset($_POST['saldo_awal']) ? $_POST['saldo_awal'] : '1000000'; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="bunga" class="form-label">Bunga (%)</label>
                                <input type="number" class="form-control" id="bunga" name="bunga" step="0.01"
                                    value="<?php echo isset($_POST['bunga']) ? $_POST['bunga'] : '3'; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="bulan" class="form-label">Jangka Waktu (Bulan)</label>
                                <input type="number" class="form-control" id="bulan" name="bulan"
                                    value="<?php echo isset($_POST['bulan']) ? $_POST['bulan'] : '11'; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Hitung</button>
                        </form>

                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $saldo_awal = $_POST['saldo_awal'];
                            $bunga_input = $_POST['bunga'];
                            $bulan = $_POST['bulan'];

                            // Validasi input
                            $errors = [];

                            if (!is_numeric($saldo_awal) || $saldo_awal <= 0) {
                                $errors[] = "Saldo awal harus berupa angka positif.";
                            }

                            if (!is_numeric($bunga_input) || $bunga_input <= 0) {
                                $errors[] = "Bunga harus berupa angka positif.";
                            }

                            if (!is_numeric($bulan) || $bulan <= 0 || $bulan != floor($bulan)) {
                                $errors[] = "Jangka waktu harus berupa bilangan bulat positif.";
                            }

                            if (!empty($errors)) {
                        ?>
                                <hr>
                                <div class="alert alert-danger mt-3" role="alert">
                                    <h5 class="alert-heading"><i class="bi bi-exclamation-triangle-fill"></i> Error Validasi Input!</h5>
                                    <ul class="mb-0">
                                        <?php foreach ($errors as $error): ?>
                                            <li><?php echo $error; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php
                            } else {
                                $bunga = $bunga_input / 100;
                                $saldo_akhir = (($saldo_awal * $bunga) * $bulan) + $saldo_awal;
                            ?>
                                <hr>
                                <div class="alert alert-success mt-3">
                                    <h5>Hasil Perhitungan:</h5>
                                    <p><strong>Saldo Awal:</strong> Rp<?php echo number_format($saldo_awal, 0, ',', '.'); ?></p>
                                    <p><strong>Bunga:</strong> <?php echo $bunga_input; ?>%</p>
                                    <p><strong>Jangka Waktu:</strong> <?php echo $bulan; ?> Bulan</p>
                                    <hr>
                                    <p><strong>Saldo Akhir:</strong> Rp<?php echo number_format($saldo_akhir, 0, ',', '.'); ?></p>
                                </div>
                        <?php
                            }
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