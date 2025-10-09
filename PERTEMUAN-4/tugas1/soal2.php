<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soal 2 - Pecahan Uang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Soal 2 - Pecahan Uang</h3>
                    </div>
                    <div class="card-body">
                        <a href="index.php" class="btn btn-secondary mb-3">Kembali</a>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="tabungan" class="form-label">Jumlah Tabungan (Rp)</label>
                                <input type="number" class="form-control" id="tabungan" name="tabungan"
                                    value="<?php echo isset($_POST['tabungan']) ? $_POST['tabungan'] : '1575250'; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Hitung Pecahan</button>
                        </form>

                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $tabungan = $_POST['tabungan'];

                            // Validasi input
                            $errors = [];

                            if (!is_numeric($tabungan) || $tabungan <= 0) {
                                $errors[] = "Jumlah tabungan harus berupa angka positif.";
                            }

                            if ($tabungan != floor($tabungan)) {
                                $errors[] = "Jumlah tabungan harus berupa bilangan bulat (tidak ada desimal).";
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
                                $seratus = 100000;
                                $limapuluh = 50000;
                                $duapuluh = 20000;
                                $limaribu = 5000;
                                $seratusperak = 100;
                                $limapuluhperak = 50;

                                $jumlahPecahanSeratus = $tabungan % $seratus;
                                $jumlahPecahanLimaPuluh = $jumlahPecahanSeratus % $limapuluh;
                                $jumlahPecahanDuaPuluh = $jumlahPecahanLimaPuluh % $duapuluh;
                                $jumlahPecahanLimaRibu = $jumlahPecahanDuaPuluh % $limaribu;
                                $jumlahPecahanSeratusPerak = $jumlahPecahanLimaRibu % $seratusperak;
                                $jumlahPecahanLimaPuluhPerak = $jumlahPecahanSeratusPerak % $limapuluhperak;
                            ?>
                                <hr>
                                <div class="alert alert-success mt-3">
                                    <h5>Hasil Pecahan Uang:</h5>
                                    <p><strong>Tabungan:</strong> Rp<?php echo number_format($tabungan, 0, ',', '.'); ?></p>
                                    <hr>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Pecahan</th>
                                                <th>Jumlah Lembar/Koin</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Rp 100.000</td>
                                                <td><?php echo floor($tabungan / $seratus); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Rp 50.000</td>
                                                <td><?php echo floor($jumlahPecahanSeratus / $limapuluh); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Rp 20.000</td>
                                                <td><?php echo floor($jumlahPecahanLimaPuluh / $duapuluh); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Rp 5.000</td>
                                                <td><?php echo floor($jumlahPecahanDuaPuluh / $limaribu); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Rp 100</td>
                                                <td><?php echo floor($jumlahPecahanLimaRibu / $seratusperak); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Rp 50</td>
                                                <td><?php echo floor($jumlahPecahanSeratusPerak / $limapuluhperak); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
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