<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Gaji Berdasarkan Golongan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0 text-center">Kalkulator Gaji Berdasarkan Golongan</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="jamKerja" class="form-label">Jam Kerja <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="jamKerja" name="jamKerja"
                                    placeholder="Masukkan jam kerja" required min="0">
                                <div class="form-text">Upah lembur per jam: Rp 3.000 (di atas 48 jam)</div>
                            </div>

                            <div class="mb-3">
                                <label for="golongan" class="form-label">Pilih Golongan <span class="text-danger">*</span></label>
                                <select name="golongan" id="golongan" class="form-select" required>
                                    <option value="" disabled selected>Pilih Golongan</option>
                                    <option value="A">Golongan A - Rp 4.000/jam</option>
                                    <option value="B">Golongan B - Rp 5.000/jam</option>
                                    <option value="C">Golongan C - Rp 6.000/jam</option>
                                    <option value="D">Golongan D - Rp 7.000/jam</option>
                                </select>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    Hitung Gaji
                                </button>
                            </div>
                        </form>

                        <?php
                        if (isset($_POST['submit'])) {
                            $upahPerJam = 0;
                            $upahLemburPerJam = 3000;
                            $totalJamLembur = 0;
                            $gajiSeminggu = 0;
                            $gajiLembur = 0;

                            $jamKerja = (int)$_POST['jamKerja'];
                            $golongan = $_POST['golongan'];

                            if ($jamKerja < 0) {
                                echo '<div class="alert alert-danger mt-3" role="alert">Jam kerja tidak valid</div>';
                                exit;
                            }

                            switch ($golongan) {
                                case "A":
                                    $upahPerJam = 4000;
                                    break;
                                case "B":
                                    $upahPerJam = 5000;
                                    break;
                                case "C":
                                    $upahPerJam = 6000;
                                    break;
                                case "D":
                                    $upahPerJam = 7000;
                                    break;
                            }

                            if ($jamKerja > 48) {
                                $totalJamLembur = $jamKerja - 48;
                                $gajiLembur = $totalJamLembur * $upahLemburPerJam;
                                $gajiSeminggu = (48 * $upahPerJam) + $gajiLembur;
                            } else {
                                $gajiSeminggu = $jamKerja * $upahPerJam;
                            }
                            $jamNormal = $jamKerja > 48 ? 48 : $jamKerja;
                            $totalGaji = $gajiSeminggu;
                        ?>
                            <div class="alert alert-success mt-3" role="alert">
                                <h5 class="alert-heading">Rincian Perhitungan Gaji</h5>
                                <hr>

                                <!-- Informasi Karyawan -->
                                <div class="mb-3">
                                    <h6 class="text-primary">Informasi Karyawan</h6>
                                    <table class="table table-sm table-borderless mb-0">
                                        <tr>
                                            <td width="50%">Golongan</td>
                                            <td><strong><?php echo $golongan; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Upah Per Jam</td>
                                            <td><strong>Rp <?php echo number_format($upahPerJam, 0, ',', '.'); ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Total Jam Kerja</td>
                                            <td><strong><?php echo $jamKerja; ?> jam</strong></td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- Detail Jam Kerja -->
                                <div class="mb-3">
                                    <h6 class="text-primary">Detail Jam Kerja</h6>
                                    <table class="table table-sm table-borderless mb-0">
                                        <tr>
                                            <td width="50%">Jam Kerja Normal</td>
                                            <td><strong><?php echo $jamNormal; ?> jam</strong></td>
                                        </tr>
                                        <?php if ($jamKerja > 48): ?>
                                        <tr>
                                            <td>Jam Lembur</td>
                                            <td><strong class="text-warning"><?php echo $totalJamLembur; ?> jam</strong></td>
                                        </tr>
                                        <?php else: ?>
                                        <tr>
                                            <td>Jam Lembur</td>
                                            <td><strong>0 jam</strong></td>
                                        </tr>
                                        <?php endif; ?>
                                    </table>
                                </div>

                                <!-- Perhitungan Gaji -->
                                <div class="mb-3">
                                    <h6 class="text-primary">Perhitungan Gaji</h6>
                                    <table class="table table-sm table-borderless mb-0">
                                        <tr>
                                            <td width="50%">Gaji Normal</td>
                                            <td>Rp <?php echo number_format($jamNormal * $upahPerJam, 0, ',', '.'); ?></td>
                                        </tr>
                                        <?php if ($jamKerja > 48): ?>
                                        <tr>
                                            <td>Gaji Lembur (<?php echo $totalJamLembur; ?> jam × Rp <?php echo number_format($upahLemburPerJam, 0, ',', '.'); ?>)</td>
                                            <td>Rp <?php echo number_format($gajiLembur, 0, ',', '.'); ?></td>
                                        </tr>
                                        <?php endif; ?>
                                    </table>
                                </div>

                                <hr>
                                <!-- Total Gaji -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Total Gaji yang Diterima:</h5>
                                    <h4 class="mb-0 text-success"><strong>Rp <?php echo number_format($totalGaji, 0, ',', '.'); ?></strong></h4>
                                </div>
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
