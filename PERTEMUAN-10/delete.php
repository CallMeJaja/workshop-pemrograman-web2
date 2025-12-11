<?php
include 'koneksi.php';

$vNim = $_GET['nim'];
$sql = "DELETE FROM tbl_mahasiswa WHERE nim = '$vNim'";

if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
} else {
    echo "Hapus Data Gagal!: " . mysqli_error($conn);
}

mysqli_close($conn);
