<?php
echo '<button onclick="history.back()">Kembali</button>';

echo "<h4>Pembulatan Desimal</h4>";
echo "<hr>";

$angka = 8.111;

echo "Nilai awal: $angka <br>";
echo "floor($angka) = " . floor($angka) . "<br>";
echo "ceil($angka) = " . ceil($angka) . "<br>";
echo "round($angka) = " . round($angka) . "<br>";
echo "(int)$angka = " . (int)$angka . " (truncate)<br>";
