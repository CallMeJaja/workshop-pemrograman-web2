<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0 text-center">Formulir Pendaftaran Mahasiswa Universitas Tertutup</h3>
                    </div>
                    <div class="card-body">
                        <form action="proses.php" method="POST">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Masukkan nama lengkap" required>
                            </div>

                            <div class="mb-3">
                                <label for="ttl" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="ttl" name="ttl"
                                    placeholder="Masukkan tempat lahir" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <select name="tanggal" class="form-select" required>
                                            <option value="">Tanggal</option>
                                            <?php
                                            for ($i = 1; $i <= 31; $i++) {
                                                echo "<option value='$i'>$i</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <select name="bulan" class="form-select" required>
                                            <option value="">Bulan</option>
                                            <?php
                                            $bulan = [
                                                1 => "Januari",
                                                2 => "Februari",
                                                3 => "Maret",
                                                4 => "April",
                                                5 => "Mei",
                                                6 => "Juni",
                                                7 => "Juli",
                                                8 => "Agustus",
                                                9 => "September",
                                                10 => "Oktober",
                                                11 => "November",
                                                12 => "Desember"
                                            ];
                                            foreach ($bulan as $key => $value) {
                                                echo "<option value='$value'>$value</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="tahun" class="form-select" required>
                                            <option value="">Tahun</option>
                                            <?php
                                            for ($i = 1990; $i <= 2010; $i++) {
                                                echo "<option value='$i'>$i</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Rumah <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3"
                                    placeholder="Masukkan alamat lengkap" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="pria" value="Pria" required>
                                        <label class="form-check-label" for="pria">Pria</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="wanita" value="Wanita" required>
                                        <label class="form-check-label" for="wanita">Wanita</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="nilai_un" class="form-label">Nilai UN <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="nilai_un" name="nilai_un"
                                    min="0" max="100" step="0.01" placeholder="0 - 100" required>
                                <div class="form-text">Masukkan nilai UN dengan rentang 0-100</div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    <i class="bi bi-send"></i> Kirim Pendaftaran
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>