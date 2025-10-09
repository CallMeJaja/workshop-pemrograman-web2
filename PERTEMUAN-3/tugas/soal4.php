<?php
echo "<button onclick='history.back()'>Kembali</button>";
echo "<h3>Soal 4</h3>";

$input_uang = 78000;
$seratus = 100000;
$limapuluh = 50000;
$duapuluh = 20000;
$sepuluh = 10000;
$limaribu = 5000;
$duaribu = 2000;
$seribu = 1000;
$limaratusperak = 500;

$jumlahPecahanSeratus = $input_uang % $seratus;
$jumlahPecahanLimaPuluh = $jumlahPecahanSeratus % $limapuluh;
$jumlahPecahanDuaPuluh = $jumlahPecahanLimaPuluh % $duapuluh;
$jumlahPecahanSepuluh = $jumlahPecahanDuaPuluh % $sepuluh;
$jumlahPecahanLimaRibu = $jumlahPecahanSepuluh % $limaribu;
$jumlahPecahanDuaRibu = $jumlahPecahanLimaRibu % $duaribu;
$jumlahPecahanSeribu = $jumlahPecahanDuaRibu % $seribu;
$jumlahPecahanLimaRatusPerak = $jumlahPecahanSeribu % $limaratusperak;

echo "Input Uang : Rp$input_uang";
echo "<br><hr>";
echo "Jumlah Pecahan 100.000 : " . floor($input_uang / $seratus) . "<br>";
echo "Jumlah Pecahan 50.000 : " . floor($jumlahPecahanSeratus / $limapuluh) . "<br>";
echo "Jumlah Pecahan 20.000 : " . floor($jumlahPecahanLimaPuluh / $duapuluh) . "<br>";
echo "Jumlah Pecahan 10.000 : " . floor($jumlahPecahanDuaPuluh / $sepuluh) . "<br>";
echo "Jumlah Pecahan 5.000 : " . floor($jumlahPecahanSepuluh / $limaribu) . "<br>";
echo "Jumlah Pecahan 2.000 : " . floor($jumlahPecahanLimaRibu / $duaribu) . "<br>";
echo "Jumlah Pecahan 1.000 : " . floor($jumlahPecahanDuaRibu / $seribu) . "<br>";
echo "Jumlah Pecahan 500 : " . floor($jumlahPecahanSeribu / $limaratusperak) . "<br>";
