<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soal 3 - Konversi Detik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Soal 3 - Konversi Detik</h3>
                    </div>
                    <div class="card-body">
                        <a href="index.php" class="btn btn-secondary mb-3">Kembali</a>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="input_detik" class="form-label">Input Detik</label>
                                <input type="number" class="form-control" id="input_detik" name="input_detik"
                                    value="<?php echo isset($_POST['input_detik']) ? $_POST['input_detik'] : '4216'; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Konversi</button>
                        </form>

                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $input_detik = $_POST['input_detik'];

                            // Validasi input
                            $errors = [];

                            if (!is_numeric($input_detik) || $input_detik < 0) {
                                $errors[] = "Input detik harus berupa angka non-negatif.";
                            }

                            if ($input_detik != floor($input_detik)) {
                                $errors[] = "Input detik harus berupa bilangan bulat (tidak ada desimal).";
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
                                $jam = floor($input_detik / 3600);
                                $sisa_detik = $input_detik % 3600;
                                $menit = floor($sisa_detik / 60);
                                $detik = $sisa_detik % 60;
                            ?>
                                <hr>
                                <div class="alert alert-success mt-3">
                                    <h5>Hasil Konversi:</h5>
                                    <p><strong>Input Detik:</strong> <?php echo number_format($input_detik, 0, ',', '.'); ?> detik</p>
                                    <hr>
                                    <p><strong>Hasil:</strong> <?php echo $jam; ?> Jam, <?php echo $menit; ?> Menit, <?php echo $detik; ?> Detik</p>
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