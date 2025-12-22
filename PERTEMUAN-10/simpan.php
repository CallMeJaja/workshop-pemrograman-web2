<?php
include 'koneksi.php';
include 'blok.php';

$namaFile = $_FILES['fileFoto']['name'];
$lokasiSementara = $_FILES['fileFoto']['tmp_name'];
$lokasiTujuan = "folderFoto/" . $namaFile;
$uploaded = move_uploaded_file($lokasiSementara, $lokasiTujuan);

if ($uploaded) {
    $vNim = $_POST['nim'];
    $vName = $_POST['name'];
    $vProdi = $_POST['prodi'];
    $vEmail = $_POST['email'];
    $vNoHp = $_POST['no_hp'];
    $vFoto = $lokasiTujuan;

    $querySimpan = "INSERT INTO tbl_mahasiswa (nim, nama, prodi, email, nohp, foto) VALUES ('$vNim', '$vName', '$vProdi', '$vEmail', '$vNoHp', '$vFoto')";

    if (mysqli_query($conn, $querySimpan)) {
        header("Location: index.php");
    } else {
        echo "Error: " . $querySimpan . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Upload gagal!";
    echo "<br><a href='tambah.php'>Kembali</a>";
}
mysqli_close($conn);
