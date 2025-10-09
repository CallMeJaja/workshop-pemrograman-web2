<?php
echo "<button onclick='history.back()'>Kembali</button>";
echo "<h3>Soal 2</h3>";

$tabungan = 1575250;
$seratus = 100000;
$limapuluh = 50000;
$duapuluh = 20000;
$limaribu = 5000;
$seratusperak = 100;
$limapuluhperak = 50;

$jumlahPecahanSeratus = floor($tabungan % $seratus);
$jumlahPecahanLimaPuluh = floor($jumlahPecahanSeratus % $limapuluh);
$jumlahPecahanDuaPuluh = floor($jumlahPecahanLimaPuluh % $duapuluh);
$jumlahPecahanLimaRibu = floor($jumlahPecahanDuaPuluh % $limaribu);
$jumlahPecahanSeratusPerak = floor($jumlahPecahanLimaRibu % $seratusperak);
$jumlahPecahanLimaPuluhPerak = floor($jumlahPecahanSeratusPerak % $limapuluhperak);

echo "Tabungan : Rp$tabungan <br><hr>";
echo "Jumlah Pecahan 100.000 : " . floor($tabungan / $seratus) . "<br>";
echo "Jumlah Pecahan 50.000 : " . floor($jumlahPecahanSeratus / $limapuluh) . "<br>";
echo "Jumlah Pecahan 20.000 : " . floor($jumlahPecahanLimaPuluh / $duapuluh) . "<br>";
echo "Jumlah Pecahan 5.000 : " . floor($jumlahPecahanDuaPuluh / $limaribu) . "<br>";
echo "Jumlah Pecahan 100 : " . floor($jumlahPecahanLimaRibu / $seratusperak) . "<br>";
echo "Jumlah Pecahan 50 : " . floor($jumlahPecahanSeratusPerak / $limapuluhperak) . "<br>";
