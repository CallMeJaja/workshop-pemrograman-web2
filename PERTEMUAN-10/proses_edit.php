<?php
include 'blok.php';
include 'koneksi.php';
$vNim = $_POST['nim'];
$vName = $_POST['nama'];
$vProdi = $_POST['prodi'];
$vEmail = $_POST['email'];
$vNoHp = $_POST['no_hp'];

$queryUpdate = "UPDATE tbl_mahasiswa SET 
nama='$vName', 
prodi='$vProdi', 
email='$vEmail', 
nohp='$vNoHp' 
WHERE nim='$vNim'";

if (mysqli_query($conn, $queryUpdate)) {
    header("Location: index.php");
} else {
    echo "Edit Data Gagal!: " . mysqli_error($conn);
}
mysqli_close($conn);
