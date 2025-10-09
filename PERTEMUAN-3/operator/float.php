<?php
echo '<button onclick="history.back()">Kembali</button>';
echo "<h4>Tipe data float</h4>";

$nilaiMatematika = 5.1;
$nilaiIPA = 6.7;
$nilaiBahasaIndonesia = 9.3;

$rataRata = ($nilaiMatematika + $nilaiIPA + $nilaiBahasaIndonesia) / 3;

echo "Nilai Matematika : $nilaiMatematika <br>";
echo "Nilai IPA : $nilaiIPA <br>";
echo "Nilai Bahasa Indonesia : $nilaiBahasaIndonesia <br>";
echo "Rata-rata : $rataRata <br>";
