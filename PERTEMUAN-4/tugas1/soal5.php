<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soal 5 - Selisih Waktu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Soal 5 - Selisih Waktu</h3>
                    </div>
                    <div class="card-body">
                        <a href="index.php" class="btn btn-secondary mb-3">Kembali</a>

                        <form method="POST" action="">
                            <h5 class="mb-3">Waktu Awal</h5>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="jam_awal" class="form-label">Jam</label>
                                    <input type="number" class="form-control" id="jam_awal" name="jam_awal"
                                        value="<?php echo isset($_POST['jam_awal']) ? $_POST['jam_awal'] : '10'; ?>"
                                        min="0" max="23" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="menit_awal" class="form-label">Menit</label>
                                    <input type="number" class="form-control" id="menit_awal" name="menit_awal"
                                        value="<?php echo isset($_POST['menit_awal']) ? $_POST['menit_awal'] : '34'; ?>"
                                        min="0" max="59" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="detik_awal" class="form-label">Detik</label>
                                    <input type="number" class="form-control" id="detik_awal" name="detik_awal"
                                        value="<?php echo isset($_POST['detik_awal']) ? $_POST['detik_awal'] : '45'; ?>"
                                        min="0" max="59" required>
                                </div>
                            </div>

                            <h5 class="mb-3">Waktu Akhir</h5>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="jam_akhir" class="form-label">Jam</label>
                                    <input type="number" class="form-control" id="jam_akhir" name="jam_akhir"
                                        value="<?php echo isset($_POST['jam_akhir']) ? $_POST['jam_akhir'] : '12'; ?>"
                                        min="0" max="23" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="menit_akhir" class="form-label">Menit</label>
                                    <input type="number" class="form-control" id="menit_akhir" name="menit_akhir"
                                        value="<?php echo isset($_POST['menit_akhir']) ? $_POST['menit_akhir'] : '25'; ?>"
                                        min="0" max="59" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="detik_akhir" class="form-label">Detik</label>
                                    <input type="number" class="form-control" id="detik_akhir" name="detik_akhir"
                                        value="<?php echo isset($_POST['detik_akhir']) ? $_POST['detik_akhir'] : '31'; ?>"
                                        min="0" max="59" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Hitung Selisih</button>
                        </form>

                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $jam_awal = $_POST['jam_awal'];
                            $menit_awal = $_POST['menit_awal'];
                            $detik_awal = $_POST['detik_awal'];

                            $jam_akhir = $_POST['jam_akhir'];
                            $menit_akhir = $_POST['menit_akhir'];
                            $detik_akhir = $_POST['detik_akhir'];

                            // Validasi input
                            $errors = [];

                            if (!is_numeric($jam_awal) || $jam_awal < 0 || $jam_awal > 23 || $jam_awal != floor($jam_awal)) {
                                $errors[] = "Jam awal harus berupa bilangan bulat antara 0-23.";
                            }

                            if (!is_numeric($menit_awal) || $menit_awal < 0 || $menit_awal > 59 || $menit_awal != floor($menit_awal)) {
                                $errors[] = "Menit awal harus berupa bilangan bulat antara 0-59.";
                            }

                            if (!is_numeric($detik_awal) || $detik_awal < 0 || $detik_awal > 59 || $detik_awal != floor($detik_awal)) {
                                $errors[] = "Detik awal harus berupa bilangan bulat antara 0-59.";
                            }

                            if (!is_numeric($jam_akhir) || $jam_akhir < 0 || $jam_akhir > 23 || $jam_akhir != floor($jam_akhir)) {
                                $errors[] = "Jam akhir harus berupa bilangan bulat antara 0-23.";
                            }

                            if (!is_numeric($menit_akhir) || $menit_akhir < 0 || $menit_akhir > 59 || $menit_akhir != floor($menit_akhir)) {
                                $errors[] = "Menit akhir harus berupa bilangan bulat antara 0-59.";
                            }

                            if (!is_numeric($detik_akhir) || $detik_akhir < 0 || $detik_akhir > 59 || $detik_akhir != floor($detik_akhir)) {
                                $errors[] = "Detik akhir harus berupa bilangan bulat antara 0-59.";
                            }

                            $satuan_detik_jam = 3600;
                            $satuan_detik_menit = 60;

                            $total_detik_awal = ($jam_awal * $satuan_detik_jam) + ($menit_awal * $satuan_detik_menit) + $detik_awal;
                            $total_detik_akhir = ($jam_akhir * $satuan_detik_jam) + ($menit_akhir * $satuan_detik_menit) + $detik_akhir;

                            if (empty($errors) && $total_detik_akhir <= $total_detik_awal) {
                                $errors[] = "Waktu akhir harus lebih besar dari waktu awal.";
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
                                $total_detik = $total_detik_akhir - $total_detik_awal;

                                $jam = floor($total_detik / $satuan_detik_jam);
                                $sisa_detik = $total_detik % $satuan_detik_jam;
                                $menit = floor($sisa_detik / $satuan_detik_menit);
                                $detik = $sisa_detik % $satuan_detik_menit;
                            ?>
                                <hr>
                                <div class="alert alert-success mt-3">
                                    <h5>Hasil Perhitungan:</h5>
                                    <p><strong>Waktu Awal:</strong> <?php echo $jam_awal; ?>:<?php echo $menit_awal; ?>:<?php echo $detik_awal; ?></p>
                                    <p><strong>Waktu Akhir:</strong> <?php echo $jam_akhir; ?>:<?php echo $menit_akhir; ?>:<?php echo $detik_akhir; ?></p>
                                    <hr>
                                    <p><strong>Selisih Waktu:</strong> <?php echo $jam; ?> Jam, <?php echo $menit; ?> Menit, <?php echo $detik; ?> Detik</p>
                                    <p><strong>Total Detik:</strong> <?php echo number_format($total_detik, 0, ',', '.'); ?> detik</p>
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