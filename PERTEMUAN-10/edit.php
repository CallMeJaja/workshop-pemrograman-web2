<?php
include 'koneksi.php';
include 'blok.php';

$nim = $_GET['nim'];
$sql = "SELECT * FROM tbl_mahasiswa WHERE nim = '$nim'";
$data = mysqli_query($conn, $sql);
$mhs = mysqli_fetch_array($data);
?>

<h3>Form Edit Data</h3>
<button onclick="window.location.href='index.php'">Kembali</button>
<form action="proses_edit.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>NIM</td>
            <td><input type="number" name="nim" id="nim" value="<?= $mhs['nim']; ?>" readonly></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="nama" id="nama" value="<?= $mhs['nama']; ?>"></td>
        </tr>
        <tr>
            <td>Prodi</td>
            <td>
                <select name="prodi" id="p  rodi">
                    <option value="" selected disabled>--- Pilih Prodi---</option>
                    <option value="TRPL" <?= $mhs['prodi'] == 'TRPL' ? 'selected' : ''; ?>>TRPL</option>
                    <option value="TRM" <?= $mhs['prodi'] == 'TRM' ? 'selected' : ''; ?>>TRM</option>
                    <option value="TM" <?= $mhs['prodi'] == 'TM' ? 'selected' : ''; ?>>TM</option>
                    <option value="TL" <?= $mhs['prodi'] == 'TL' ? 'selected' : ''; ?>>TL</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="email" name="email" id="email" value="<?= $mhs['email']; ?>"></td>
        </tr>
        <tr>
            <td>No. HP</td>
            <td><input type="number" name="no_hp" id="no_hp" value="<?= $mhs['nohp']; ?>"></td>
        </tr>
        <tr>
            <td>Foto</td>
            <td>
                <img src="<?= $mhs['foto'] ?>" width="200px" height="auto" alt=" Foto">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="file" name="fileFoto" id="foto">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="Update" />
            </td>
        </tr>
    </table>
</form>