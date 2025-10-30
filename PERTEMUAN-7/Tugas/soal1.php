<?php
$angka = [4, 7, 2, 8, 9];
$jumlah = 0;
$rataRata = 0;

foreach ($angka as $nilai) {
    $jumlah += $nilai;
};

echo "Hasil dari penjumlahan: ";
foreach ($angka as $index => $nilai) {
    echo $nilai;
    if ($index < count($angka) - 1) {
        echo " + ";
    }
}
echo " adalah " . $jumlah . "<br>";
$rataRata = $jumlah / count($angka);
echo "Rata-rata: " . $rataRata;
