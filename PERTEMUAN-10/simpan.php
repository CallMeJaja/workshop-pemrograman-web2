<?php
include 'koneksi.php';
include 'blok.php';

$vNim = $_POST['nim'];
$vName = $_POST['name'];
$vProdi = $_POST['prodi'];
$vEmail = $_POST['email'];
$vNoHp = $_POST['no_hp'];
$vFoto = $_POST['foto']['name'];

$querySimpan = "INSERT INTO tbl_mahasiswa (nim, nama, prodi, email, nohp, foto) VALUES ('$vNim', '$vName', '$vProdi', '$vEmail', '$vNoHp', '$vFoto')";

if (mysqli_query($conn, $querySimpan)) {
    header("Location: index.php");
} else {
    echo "Error: " . $querySimpan . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
