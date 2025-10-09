<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soal 4 - Pecahan Uang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Soal 4 - Pecahan Uang</h3>
                    </div>
                    <div class="card-body">
                        <a href="index.php" class="btn btn-secondary mb-3">Kembali</a>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="input_uang" class="form-label">Jumlah Uang (Rp)</label>
                                <input type="number" class="form-control" id="input_uang" name="input_uang"
                                    value="<?php echo isset($_POST['input_uang']) ? $_POST['input_uang'] : '78000'; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Hitung Pecahan</button>
                        </form>

                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $input_uang = $_POST['input_uang'];

                            // Validasi input
                            $errors = [];

                            if (!is_numeric($input_uang) || $input_uang <= 0) {
                                $errors[] = "Jumlah uang harus berupa angka positif.";
                            }

                            if ($input_uang != floor($input_uang)) {
                                $errors[] = "Jumlah uang harus berupa bilangan bulat (tidak ada desimal).";
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
                                $sepuluh = 10000;
                                $limaribu = 5000;
                                $duaribu = 2000;
                                $seribu = 1000;
                                $limaratusperak = 500;

                                $jumlahPecahanSeratus = $input_uang % $seratus;
                                $jumlahPecahanLimaPuluh = $jumlahPecahanSeratus % $limapuluh;
                                $jumlahPecahanDuaPuluh = $jumlahPecahanLimaPuluh % $duapuluh;
                                $jumlahPecahanSepuluh = $jumlahPecahanDuaPuluh % $sepuluh;
                                $jumlahPecahanLimaRibu = $jumlahPecahanSepuluh % $limaribu;
                                $jumlahPecahanDuaRibu = $jumlahPecahanLimaRibu % $duaribu;
                                $jumlahPecahanSeribu = $jumlahPecahanDuaRibu % $seribu;
                                $jumlahPecahanLimaRatusPerak = $jumlahPecahanSeribu % $limaratusperak;
                            ?>
                                <hr>
                                <div class="alert alert-success mt-3">
                                    <h5>Hasil Pecahan Uang:</h5>
                                    <p><strong>Input Uang:</strong> Rp<?php echo number_format($input_uang, 0, ',', '.'); ?></p>
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
                                                <td><?php echo floor($input_uang / $seratus); ?></td>
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
                                                <td>Rp 10.000</td>
                                                <td><?php echo floor($jumlahPecahanDuaPuluh / $sepuluh); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Rp 5.000</td>
                                                <td><?php echo floor($jumlahPecahanSepuluh / $limaribu); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Rp 2.000</td>
                                                <td><?php echo floor($jumlahPecahanLimaRibu / $duaribu); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Rp 1.000</td>
                                                <td><?php echo floor($jumlahPecahanDuaRibu / $seribu); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Rp 500</td>
                                                <td><?php echo floor($jumlahPecahanSeribu / $limaratusperak); ?></td>
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