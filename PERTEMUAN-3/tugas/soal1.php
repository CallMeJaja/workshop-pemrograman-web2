<?php
echo "<button onclick='history.back()'>Kembali</button>";
echo "<h3>Soal 1</h3>";

$saldo_awal = 1000000;
$bunga = 0.03;
$bulan = 11;

echo "Saldo Awal : {$saldo_awal} <br>";
echo "Bunga : " . ($bunga * 100) . "% <br>";
echo "Jangka Waktu : {$bulan} Bulan <br>";
echo "<hr><br>";
$saldo_akhir = (($saldo_awal * $bunga) * $bulan) + $saldo_awal;

echo "Saldo Akhir : Rp$saldo_akhir";
