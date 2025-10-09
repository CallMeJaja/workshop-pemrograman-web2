<?php
echo '<button onclick="history.back()">Kembali</button>';
echo "<h4>Tipe data string</h4>";

$namaDepan = "Reza";
$namaBelakang = "Asriano";

$namaLengkap = "{$namaDepan} {$namaBelakang}";
$namaLengkap2 = $namaDepan . " " . $namaBelakang;

echo "Nama Depan : $namaDepan <br>";
echo "Nama Belakang : $namaBelakang <br>";

echo "Nama Lengkap : $namaLengkap <br>";
echo "Nama Lengkap 2 : $namaLengkap2 <br>";
