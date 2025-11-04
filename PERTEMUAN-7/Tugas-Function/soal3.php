<?php
function hitungPecahan($jumlah, $pecahan): array
{
    $hasil = [];
    $sisa = $jumlah;

    foreach ($pecahan as $nilai) {
        $hasil[$nilai] = floor($sisa / $nilai);
        $sisa = $sisa % $nilai;
    }

    return $hasil;
}

function tampilkanPecahan($jumlah, $pecahan)
{
    $hasil = hitungPecahan($jumlah, $pecahan);

    echo "<h2>Tabungan Sebesar Rp " . number_format($jumlah, 0, ',', '.') . "</h2>";

    foreach ($hasil as $nilai => $jumlahLembar) {
        $jenis = $nilai < 1000 ? "koin" : "lembar";
        echo "Jumlah Pecahan " . number_format($nilai, 0, ',', '.') . " : " . $jumlahLembar . " " . $jenis . "<br>";
    }
}

$jumlahTabungan =  1575250;
$pecahanUang = [100000, 50000, 20000, 5000, 100, 50];

tampilkanPecahan($jumlahTabungan, $pecahanUang);
