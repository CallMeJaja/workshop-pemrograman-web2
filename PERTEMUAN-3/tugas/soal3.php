<?php
echo "<button onclick='history.back()'>Kembali</button>";
echo "<h3>Soal 3</h3>";

$input_detik = 4216;
$jam = floor($input_detik / 3600);
$sisa_detik = $input_detik % 3600;
$menit = floor($sisa_detik / 60);
$detik = $sisa_detik % 60;
echo "Input Detik : $input_detik detik";
echo "<hr><br>";
echo "Hasil Konversi : {$jam} Jam, {$menit} Menit, {$detik} Detik";
