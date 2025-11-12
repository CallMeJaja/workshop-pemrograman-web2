<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Gaji Anggota Tim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid mt-5 px-4">
        <div class="row">
            <div class="col-lg-3">
                <div class="card mb-4">
                    <div class="card-header text-white text-center py-3" style="background-color: #1F2937;">
                        <h5 class="mb-0">Identitas Mahasiswa</h5>
                    </div>
                    <div class="card-body">

                        <div class="mb-2 p-2 rounded" style="background-color: #E3F2FD; border-left: 4px solid #2196F3;">
                            <small class="text-muted d-block mb-2 ">NAMA:</small>
                            <span class="text-dark fw-medium">Reza Asriano Maulana</span>
                        </div>

                        <div class="mb-2 p-2 rounded" style="background-color: #E0F7FA; border-left: 4px solid #00BCD4;">
                            <small class="text-muted d-block mb-2">NIM:</small>
                            <span class="text-dark fw-medium">202404021</span>
                        </div>

                        <div class="mb-2">
                            <div class="mb-2 p-2 rounded" style="background-color: #FFF9C4; border-left: 4px solid #FBC02D;">
                                <small class="text-muted d-block mb-2">MATA KULIAH:</small>
                                <span class="text-dark fw-medium">Workshop Pemrograman Web 2</span>
                            </div>
                        </div>

                        <div class="mb-2 p-2 rounded" style="background-color: #E8F5E9; border-left: 4px solid #4CAF50;">
                            <small class="text-muted d-block mb-2">PRODI:</small>
                            <span class="text-dark fw-medium">Teknologi Rekayasa Perangkat Lunak</span>
                        </div>

                        <div class="mb-2 p-2 rounded" style="background-color: #FFEBEE; border-left: 4px solid #F44336;">
                            <small class="text-muted d-block mb-2">SEMESTER:</small>
                            <span class="text-dark fw-medium">3 (Tiga)</span>

                        </div>

                        <div class="mb-2 p-2 rounded" style="background-color: #ECEFF1; border-left: 4px solid #607D8B;">
                            <small class="text-muted d-block mb-2">DOSEN PENGAMPU:</small>
                            <span class="text-dark fw-medium">Ricak Agus Setiawan, S.T., M.SI.</span>

                        </div>
                        <div class="mb-2 p-2 rounded" style="background-color: #FFF8E1; border-left: 4px solid #FFA000;">
                            <small class="text-muted d-block mb-2">INSTITUSI:</small>
                            <span class="text-dark fw-medium">Politeknik Enjinering Indorama</span>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white py-3 px-4">
                        <h5 class="mb-0 fw-semibold text-center">Kalkulator Gaji Anggota Tim</h5>
                    </div>

                    <div class="card-body">

                        <?php
                        $anggota = [
                            "Reza Asriano Maulana",
                            "Satrio Ilham Syahputra",
                            "Dhafi Ebsan Yurizal",
                            "Helgi Nur Allamsyah",
                            "Fikri Ramdani"
                        ];

                        $posisi = [
                            'Lead Developer' => [
                                'upah_per_jam' => 450000,
                                'persen_lembur' => 18,
                                'persen_fee' => 5
                            ],
                            'QA Engineer' => [
                                'upah_per_jam' => 250000,
                                'persen_lembur' => 12,
                                'persen_fee' => 1
                            ],
                            'DevOps Engineer' => [
                                'upah_per_jam' => 350000,
                                'persen_lembur' => 10,
                                'persen_fee' => 2.5
                            ],
                            'Backend Dev' => [
                                'upah_per_jam' => 300000,
                                'persen_lembur' => 15,
                                'persen_fee' => 3
                            ],
                            'Frontend Dev' => [
                                'upah_per_jam' => 300000,
                                'persen_lembur' => 15,
                                'persen_fee' => 3
                            ]
                        ];

                        function hitungUpahJamKerja($jam_kerja, $upah_per_jam)
                        {
                            return hitungJamLembur($jam_kerja) > 0
                                ? 160 * $upah_per_jam
                                : $jam_kerja * $upah_per_jam;
                        }

                        function hitungUpahLembur($jam_kerja, $upah_per_jam, $persen_lembur)
                        {
                            $jam_lembur = hitungJamLembur($jam_kerja);
                            if ($jam_lembur > 0) {
                                $upah_lembur_per_jam = $upah_per_jam * ($persen_lembur / 100);
                                return $jam_lembur * $upah_lembur_per_jam;
                            } else {
                                return 0;
                            }
                        }

                        function hitungJamLembur($jam_kerja)
                        {
                            if ($jam_kerja > 160) {
                                return $jam_kerja - 160;
                            } else {
                                return 0;
                            }
                        }

                        function hitungUpahFee($harga_project, $persen_fee)
                        {
                            return $harga_project * ($persen_fee / 100);
                        }

                        function hitungTotalUpah($upah_jam_kerja, $upah_lembur, $upah_fee)
                        {
                            return $upah_jam_kerja + $upah_lembur + $upah_fee;
                        }
                        ?>

                        <form method="POST" action="" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="anggota" class="form-label">Nama Anggota <span class="text-danger">*</span></label>
                                <select name="anggota" id="anggota" class="form-select" required>
                                    <option value="">Pilih Anggota</option>
                                    <?php foreach ($anggota as $a) : ?>
                                        <option value="<?= $a ?>" <?= (isset($_POST['anggota']) && $_POST['anggota'] == $a) ? 'selected' : '' ?>><?= $a ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i>
                                    Silakan pilih nama anggota.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Posisi <span class="text-danger">*</span></label>
                                <select name="role" id="role" class="form-select" required>
                                    <option value="">Pilih Posisi</option>
                                    <?php foreach ($posisi as $p => $details) : ?>
                                        <option value="<?= $p ?>" <?= (isset($_POST['role']) && $_POST['role'] == $p) ? 'selected' : '' ?>><?= $p ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i>
                                    Silakan pilih posisi.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="jam_kerja" class="form-label">Jam Kerja <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="jam_kerja" id="jam_kerja"
                                    value="<?php echo isset($_POST['jam_kerja']) ? $_POST['jam_kerja'] : ''; ?>"
                                    placeholder="Contoh: 180" min="1" required>
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i>
                                    Jam kerja harus berupa angka positif (minimal 1 jam).
                                </div>
                                <div class="alert alert-info mt-2 mb-0">
                                    <small><strong>Catatan:</strong> Jam kerja ideal 160 jam/bulan (40 jam/minggu). Kelebihan dihitung sebagai lembur.</small>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="harga_project" class="form-label">Harga Project (Rp) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="harga_project" id="harga_project"
                                    value="<?php echo isset($_POST['harga_project']) ? $_POST['harga_project'] : ''; ?>"
                                    placeholder="Minimal Rp 10.000.000" min="10000000" required>
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i>
                                    Harga Project Minimum: Rp 10.000.000 | Rekomendasi: Rp 50.000.000 - Rp 1.000.000.000
                                </div>
                                <small class="form-text text-muted"></small>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary me-2">Hitung Gaji</button>
                            <button type="reset" onclick="window.location.href=window.location.pathname; return false;" class="btn btn-secondary">Reset</button>
                        </form>

                        <?php
                        if (isset($_POST['submit'])) {
                            $nama = $_POST['anggota'];
                            $role = $_POST['role'];
                            $jam_kerja = $_POST['jam_kerja'];
                            $harga_project = $_POST['harga_project'];


                            $upah_per_jam = $posisi[$role]['upah_per_jam'];
                            $persen_lembur = $posisi[$role]['persen_lembur'];
                            $persen_fee = $posisi[$role]['persen_fee'];
                            $upah_jam_kerja = hitungUpahJamKerja($jam_kerja, $upah_per_jam);
                            $upah_lembur = hitungUpahLembur($jam_kerja, $upah_per_jam, $persen_lembur);
                            $upah_fee = hitungUpahFee($harga_project, $persen_fee);
                            $total_upah = hitungTotalUpah($upah_jam_kerja, $upah_lembur, $upah_fee);

                            // Badge color mapping
                            $badge_colors = [
                                'Lead Developer' => 'danger',
                                'QA Engineer' => 'info',
                                'DevOps Engineer' => 'warning text-dark',
                                'Backend Dev' => 'primary',
                                'Frontend Dev' => 'success'
                            ];
                            $badge_color = $badge_colors[$role] ?? 'secondary';
                        ?>
                            <hr>
                            <div class="card border-primary mt-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="bi bi-file-earmark-text"></i> Slip Gaji Karyawan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <p class="mb-2"><strong>Nama Anggota:</strong><br><?= $nama ?></p>
                                            <p class="mb-2"><strong>Posisi:</strong><br>
                                                <span class="badge bg-<?= $badge_color ?> fs-6"><?= $role ?></span>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-2"><strong>Jam Kerja:</strong> <?= $jam_kerja ?> jam</p>
                                            <p class="mb-2"><strong>Jam Lembur:</strong>
                                                <?php
                                                $jam_lembur = hitungJamLembur($jam_kerja);
                                                echo $jam_lembur > 0
                                                    ? '<span class="badge bg-warning text-dark">' . $jam_lembur . ' jam</span>'
                                                    : '<span class="badge bg-secondary">0 jam</span>';
                                                ?>
                                            </p>
                                            <p class="mb-2"><strong>Harga Project:</strong> Rp<?= number_format($harga_project, 0, ',', '.') ?></p>
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
                                                    <td class="text-end">Rp<?= number_format($upah_jam_kerja, 0, ',', '.') ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Upah dari Jam Lembur (<?= $persen_lembur ?>%)</td>
                                                    <td class="text-end">Rp<?= number_format($upah_lembur, 0, ',', '.') ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Upah dari Fee Project (<?= $persen_fee ?>%)</td>
                                                    <td class="text-end">Rp<?= number_format($upah_fee, 0, ',', '.') ?></td>
                                                </tr>
                                                <tr class="table-success">
                                                    <th>TOTAL UPAH</th>
                                                    <th class="text-end">Rp<?= number_format($total_upah, 0, ',', '.') ?></th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="alert alert-info mb-0 mt-3">
                                        <small>
                                            <strong>Catatan:</strong>
                                            Upah per jam untuk <?= $role ?>: Rp<?= number_format($upah_per_jam, 0, ',', '.') ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Sidebar Referensi -->
            <div class="col-lg-3">
                <div class="card sticky-top" style="top: 20px;">
                    <div class="card-header text-dark py-3 text-center" style="background-color: #FFF9C4; border-bottom: 3px solid #FBC02D;">
                        <h4 class="mb-0 fw-semibold">Referensi Ketentuan Gaji</h4>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-3">Upah per Jam Berdasarkan Posisi</h6>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-hover mb-0 ">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Posisi</th>
                                        <th class="text-end">Upah/Jam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Lead Developer</td>
                                        <td class="text-end">Rp 450.000</td>
                                    </tr>
                                    <tr>
                                        <td>QA Engineer</td>
                                        <td class="text-end">Rp 250.000</td>
                                    </tr>
                                    <tr>
                                        <td>DevOps Engineer</td>
                                        <td class="text-end">Rp 350.000</td>
                                    </tr>
                                    <tr>
                                        <td>Backend Dev</td>
                                        <td class="text-end">Rp 300.000</td>
                                    </tr>
                                    <tr>
                                        <td>Frontend Dev</td>
                                        <td class="text-end">Rp 300.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h6 class="mb-3">Persentase Bonus</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0 ">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Posisi</th>
                                        <th class="text-center">Lembur</th>
                                        <th class="text-center">Fee</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Lead Developer</td>
                                        <td class="text-center">18%</td>
                                        <td class="text-center">5%</td>
                                    </tr>
                                    <tr>
                                        <td>QA Engineer</td>
                                        <td class="text-center">12%</td>
                                        <td class="text-center">1%</td>
                                    </tr>
                                    <tr>
                                        <td>DevOps Engineer</td>
                                        <td class="text-center">10%</td>
                                        <td class="text-center">2.5%</td>
                                    </tr>
                                    <tr>
                                        <td>Backend Dev</td>
                                        <td class="text-center">15%</td>
                                        <td class="text-center">3%</td>
                                    </tr>
                                    <tr>
                                        <td>Frontend Dev</td>
                                        <td class="text-center">15%</td>
                                        <td class="text-center">3%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Bootstrap validation
        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>

</html>