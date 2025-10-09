<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Form KTP Dinamis PHP</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <div class="form-group">
                <label for="nik">NIK:</label>
                <input type="text" name="nik" id="nik" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" name="nama" id="naman" required>
            </div>
            <div class="form-group">
                <label for="tempat-lahir">Tempat Lahir:</label>
                <input type="text" name="tempat-lahir" id="tempat-lahir" required>
            </div>
            <div class="form-group">
                <label for="tanggal-lahir">Tanggal Lahir:</label>
                <input type="date" name="tanggal-lahir" id="tanggal-lahir" required>
            </div>
            <div class="form-group">
                <label for="jenis-kelamin">Jenis Kelamin:</label>
                <select name="jenis-kelamin" id="jenis-kelamin" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Alamat Lengkap:</label>
                <div class="alamat-row">
                    <div class="alamat-col">
                        <label for="alamat">Alamat:</label>
                        <input type="text" name="alamat" id="alamat" required style="margin-bottom: 20px;">
                        <label for="kel-desa">Kel/Desa:</label>
                        <input type="text" name="kel-desa" id="kel-desa" required>
                    </div>
                    <div class="alamat-col">
                        <label for="rt-rw">RT/RW:</label>
                        <input type="text" name="rt-rw" id="rt-rw" required style="margin-bottom: 20px;">
                        <label for="kecamatan">Kecamatan:</label>
                        <input type="text" name="kecamatan" id="kecamatan" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="agama">Agama:</label>
                <select name="agama" id="agama" required>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status Perkawinan:</label>
                <select name="status" id="status" required>
                    <option value="Belum Kawin">Belum Kawin</option>
                    <option value="Kawin">Kawin</option>
                    <option value="Cerai Hidup">Cerai Hidup</option>
                    <option value="Cerai Mati">Cerai Mati</option>
                </select>
            </div>
            <div class="form-group">
                <label for="pekerjaan">Pekerjaan:</label>
                <input type="text" name="pekerjaan" id="pekerjaan" required>
            </div>
            <div class="form-group">
                <label for="kewarganegaraan">Kewarganegaraan:</label>
                <input type="text" name="kewarganegaraan" id="kewarganegaraan" required>
            </div>
            <div class="form-group">
                <label for="berlaku-hingga">Berlaku Hingga:</label>
                <input type="text" name="berlaku-hingga" id="berlaku-hingga" value="Seumur Hidup">
            </div>

            <button type="submit">Cetak KTP</button>
        </form>
    </div>

    <?php
    $nik = $_POST['nik'] ?? '-';
    $nama = $_POST['nama'] ?? '-';
    $tempat_lahir = $_POST['tempat-lahir'] ?? '-';
    $tanggal_lahir = $_POST['tanggal-lahir'] ?? '-';
    $jenis_kelamin = $_POST['jenis-kelamin'] ?? '-';
    $alamat = $_POST['alamat'] ?? '-';
    $rt_rw = $_POST['rt-rw'] ?? '-';
    $kel_desa = $_POST['kel-desa'] ?? '-';
    $kecamatan = $_POST['kecamatan'] ?? '-';
    $agama = $_POST['agama'] ?? '-';
    $status_perkawinan = $_POST['status'] ?? '-';
    $pekerjaan = $_POST['pekerjaan'] ?? '-';
    $kewarganegaraan = $_POST['kewarganegaraan'] ?? '-';
    $berlaku_hingga = $_POST['berlaku-hingga'] ?? 'Seumur Hidup';

    ?>

    <div class="wrapper-card">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <div class="card-title">PROVINSI JAWA BARAT</div>
                    <div class="card-subtitle">KABUPATEN PURWAKARTA</div>
                </div>
                <div class="card-body">
                    <div class="card-info">
                        <div class="info-row" style="font-family: 'Courier New', Courier, monospace; font-weight: bold">
                            <span class="info-label">NIK</span>:
                            <span id="card-nik"><?php echo $nik ?></span>
                        </div>
                        <div class="info row">
                            <span class="info-label">Nama</span>:
                            <span id="card-nama"><?php echo $nama; ?></span>
                        </div>
                        <div class="info-row">
                            <div class="span info-label">Tempat/Tgl Lahir</div>:
                            <span id="card-tempat-lahir"><?php echo $tempat_lahir; ?></span>
                            <span id="card-tanggal-lahir"><?php echo $tanggal_lahir; ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Jenis Kelamin</span>:
                            <span id="card-jenis-kelamin"><?php echo $jenis_kelamin; ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Alamat</span>:
                            <span id="card-alamat"><?php echo $alamat; ?></span>
                        </div>
                        <div class="alamat-detail">
                            <div class="info-row">
                                <span class="info-label">RT/RW</span>:
                                <span id="card-rt-rw"><?php echo $rt_rw; ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Kel/Desa</span>:
                                <span id="card-kel-desa"><?php echo $kel_desa; ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Kecamatan</span>:
                                <span id="card-kecamatan"><?php echo $kecamatan; ?></span>
                            </div>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Agama</span>:
                            <span id="card-agama"><?php echo $agama; ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status Perkawinan</span>:
                            <span id="card-status-perkawinan"><?php echo $status_perkawinan; ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Pekerjaan</span>:
                            <span id="card-pekerjaan"><?php echo $pekerjaan; ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Kewarganegaraan</span>:
                            <span id="card-kewarganegaraan"><?php echo $kewarganegaraan; ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Berlaku Hingga</span>:
                            <span id="card-berlaku-hingga"><?php echo $berlaku_hingga; ?></span>
                        </div>
                    </div>
                    <div class="card-photo-section">
                        <div class="photo-placeholder">
                            <span style="color: #aaa; font-size: 0.9rem">Foto</span>
                        </div>
                        <div class="signature-section">
                            PURWAKARTA <br />
                            <span id="card-tl" style="font-weight:bold;">-</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>