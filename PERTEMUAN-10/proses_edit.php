<?php
include 'blok.php';
include 'koneksi.php';

$namaFile = $_FILES['fileFoto']['name'];
$lokasiSementara = $_FILES['fileFoto']['tmp_name'];
$lokasiTujuan = "folderFoto/" . $namaFile;
$uploaded = move_uploaded_file($lokasiSementara, $lokasiTujuan);

$vNim = $_POST['nim'];
$vName = $_POST['nama'];
$vProdi = $_POST['prodi'];
$vEmail = $_POST['email'];
$vNoHp = $_POST['no_hp'];
$vFoto = $lokasiTujuan;

if ($uploaded) {

    $queryUpdate = "UPDATE tbl_mahasiswa SET 
nama='$vName', 
prodi='$vProdi', 
email='$vEmail', 
nohp='$vNoHp', 
foto='$vFoto'
WHERE nim='$vNim'";

    if (mysqli_query($conn, $queryUpdate)) {
        header("Location: index.php");
    } else {
        echo "Edit Data Gagal!: " . mysqli_error($conn);
    }
} else {
    echo "Upload gagal!";
    echo "<br><a href='edit.php?nim=$vNim'>Kembali</a>";
}
mysqli_close($conn);
