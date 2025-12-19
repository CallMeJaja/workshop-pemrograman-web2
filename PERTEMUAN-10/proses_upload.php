<?php
$namaFile = $_FILES['foto']['name'];
$ukuranFile = $_FILES['foto']['size'];
$lokasiSementara = $_FILES['foto']['tmp_name'];
$lokasiTujuan = "folderFoto/" . $namaFile;

// if ($ukuranFile > 2000000) {
//     echo "Ukuran File terlalu besar!";
//     echo "Ukuran maksimal 2MB";
//     echo "Ukuran File: " . $ukuranFile . " byte";
//     echo "<br><a href='upload.php'>Kembali</a>";
//     exit;
// }

$uploaded = move_uploaded_file($lokasiSementara, $lokasiTujuan);

if ($uploaded) {
    echo "Upload File berhasil!<br>";
    echo "Lokasi tujuan : " . $lokasiTujuan . "<br>";
} else {
    echo "Upload gagal!";
}
