<?php
$angka = [3, 10, 4, 2, 8, 15, 7, 6, 12, 9];

echo "<h2> Program Sorting Angka Terkecil ke Terbesar </h2>";
echo "<h3> Metode 1 Pake Algoritma Bubble Sort </h3>";
for ($i = 0; $i < count($angka); $i++) {
    for ($j = $i + 1; $j < count($angka); $j++) {
        if ($angka[$i] > $angka[$j]) {
            $temp = $angka[$i];
            $angka[$i] = $angka[$j];
            $angka[$j] = $temp;
        }
    }
}

echo "<h4>Hasil Pengurutan: </h4><pre>";
for ($i = 0; $i < count($angka); $i++) {
    echo $angka[$i];
    if ($i < count($angka) - 1) {
        echo ", ";
    }
}
echo "</pre>";

echo "<h3> Metode 2 Pake Function Bawaan PHP </h3>";
sort($angka);
echo "<h4>Hasil Pengurutan: </h4><pre>";
for ($i = 0; $i < count($angka); $i++) {
    echo $angka[$i];
    if ($i < count($angka) - 1) {
        echo ", ";
    }
}
echo "</pre>";
