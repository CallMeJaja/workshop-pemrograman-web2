<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Gaji Mingguan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0 text-center">Kalkulator Gaji Mingguan</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="jamKerja" class="form-label">Jam Kerja <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="jamKerja" name="jamKerja"
                                    placeholder="Masukkan jam kerja" required min="0">
                                <div class="form-text">Upah per jam: Rp 2.000 | Upah lembur per jam: Rp 3.000 (di atas 48 jam)</div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    Hitung Gaji
                                </button>
                            </div>
                        </form>

                        <?php
                        $upahPerJam = 2000;
                        $upahLemburPerJam = 3000;
                        $totalJamLembur = 0;
                        $gajiSeminggu = 0;
                        $gajiLembur = 0;
                        if (isset($_POST['submit'])) {
                            $jamKerja = (int)$_POST['jamKerja'];

                            if ($jamKerja < 0) {
                                echo '<div class="alert alert-danger mt-3" role="alert">Jam kerja tidak valid</div>';
                                exit;
                            }

                            if ($jamKerja > 48) {
                                $totalJamLembur = $jamKerja - 48;
                                $gajiLembur = $totalJamLembur * $upahLemburPerJam;
                                $gajiSeminggu = (48 * $upahPerJam) + $gajiLembur;
                            } else {
                                $gajiSeminggu = $jamKerja * $upahPerJam;
                            }
                        ?>
                            <div class="alert alert-success mt-3" role="alert">
                                <h5 class="alert-heading">Hasil Perhitungan</h5>
                                <hr>
                                <p class="mb-1"><strong>Total Upah Seminggu:</strong> Rp <?php echo number_format($gajiSeminggu, 0, ',', '.'); ?></p>
                                <p class="mb-1"><strong>Total Upah Lembur:</strong> Rp <?php echo number_format($gajiLembur, 0, ',', '.'); ?></p>
                                <p class="mb-0"><strong>Total Gaji <?php echo $jamKerja; ?> Jam Kerja:</strong> Rp <?php echo number_format($gajiSeminggu + $gajiLembur, 0, ',', '.'); ?></p>
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