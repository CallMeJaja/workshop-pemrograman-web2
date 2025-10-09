<?php
echo "<button onclick='history.back()'>Kembali</button>";
echo "<h3>Soal 5</h3>";

$jam_awal = 10;
$menit_awal = 34;
$detik_awal = 45;

echo "Waktu Awal : $jam_awal:$menit_awal:$detik_awal";

$jam_akhir = 12;
$menit_akhir = 25;
$detik_akhir = 31;
echo "<br>";
echo "Waktu Akhir : $jam_akhir:$menit_akhir:$detik_akhir";
echo "<hr><br>";

$satuan_detik_jam = 3600;
$satuan_detik_menit = 60;
$satuan_detik = 60;

$total_detik_awal = ($jam_awal * $satuan_detik_jam) + ($menit_awal * $satuan_detik_menit) + $detik_awal;
$total_detik_akhir = ($jam_akhir * $satuan_detik_jam) + ($menit_akhir * $satuan_detik_menit) + $detik_akhir;
$total_detik = $total_detik_akhir - $total_detik_awal;
$jam = floor($total_detik / $satuan_detik_jam);
$sisa_detik = $total_detik % $satuan_detik_jam;
$menit = floor(
    $sisa_detik / $satuan_detik_menit
);
$detik = $sisa_detik % $satuan_detik_menit;
echo "Selisih Waktu : {$jam} Jam, {$menit} Menit, {$detik} Detik";
echo "<br>";
echo "Total Detik : $total_detik detik";
