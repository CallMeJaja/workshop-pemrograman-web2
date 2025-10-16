<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Berat Badan Ideal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0 text-center">Kalkulator Berat Badan Ideal</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="tinggi_badan" class="form-label">Tinggi Badan (cm) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan"
                                    placeholder="Masukkan tinggi badan" required>
                                <div class="form-text">Tinggi badan dalam centimeter (100-250 cm)</div>
                            </div>

                            <div class="mb-3">
                                <label for="berat_badan" class="form-label">Berat Badan (kg) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="berat_badan" name="berat_badan"
                                    placeholder="Masukkan berat badan" required>
                                <div class="form-text">Berat badan dalam kilogram (20-200 kg)</div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" name="hitung" class="btn btn-primary">
                                    Hitung Berat Badan Ideal
                                </button>
                            </div>
                        </form>

                        <?php
                        if (isset($_POST['hitung'])) {
                            $tinggi_badan = (int)$_POST['tinggi_badan'];
                            $berat_badan = (int)$_POST['berat_badan'];
                            $beratBadanIdeal = ($tinggi_badan - 100) - (0.1 * ($tinggi_badan - 100));

                            if ($tinggi_badan < 0 || $berat_badan < 0) {
                                echo '<div class="alert alert-danger mt-3" role="alert">Tinggi badan dan berat badan harus bernilai positif.</div>';
                                exit;
                            }

                            $selisih = abs($berat_badan - $beratBadanIdeal);

                            if ($berat_badan != $beratBadanIdeal) {
                                $status = $berat_badan > $beratBadanIdeal ? 'kelebihan' : 'kekurangan';
                                $alertType = 'warning';
                                $message = 'Berat badan Anda tidak ideal.';
                            } else {
                                $alertType = 'success';
                                $message = 'Berat badan Anda ideal!';
                            }
                        ?>
                            <div class="alert alert-<?php echo $alertType; ?> mt-3" role="alert">
                                <h5 class="alert-heading">Hasil Perhitungan</h5>
                                <hr>
                                <p class="mb-1"><strong>Tinggi Badan:</strong> <?php echo $tinggi_badan; ?> cm</p>
                                <p class="mb-1"><strong>Berat Badan Saat Ini:</strong> <?php echo $berat_badan; ?> kg</p>
                                <p class="mb-1"><strong>Berat Badan Ideal:</strong> <?php echo number_format($beratBadanIdeal, 1, ',', '.'); ?> kg</p>
                                <hr>
                                <p class="mb-0"><strong>Status:</strong> <?php echo $message; ?></p>
                                <?php if ($berat_badan != $beratBadanIdeal): ?>
                                    <p class="mb-0"><strong>Selisih:</strong> <?php echo $status; ?> <?php echo number_format($selisih, 1, ',', '.'); ?> kg</p>
                                <?php endif; ?>
                            </div>
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