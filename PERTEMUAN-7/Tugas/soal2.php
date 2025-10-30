<?php
$angka = [3, 10, 4, 2, 8, 15, 7, 6, 12, 9];
$nilaiTerendah;
$nilaiTertinggi;

echo "<h2> Metode 1 Pake Looping </h2>";
for ($i = 0; $i < count($angka); $i++) {
    if ($i == 0) {
        $nilaiTerendah = $angka[$i];
        $nilaiTertinggi = $angka[$i];
    } else {
        if ($angka[$i] < $nilaiTerendah) {
            $nilaiTerendah = $angka[$i];
        }
        if ($angka[$i] > $nilaiTertinggi) {
            $nilaiTertinggi = $angka[$i];
        }
    }
}

echo "Nilai Terendah: " . $nilaiTerendah . "<br>";
echo "Nilai Tertinggi: " . $nilaiTertinggi;

echo "<h2> Metode 2 Pake Function Bawaan PHP </h2>";
$nilaiTerendah = min($angka);
$nilaiTertinggi = max($angka);

echo "Nilai Terendah: " . $nilaiTerendah . "<br>";
echo "Nilai Tertinggi: " . $nilaiTertinggi;
