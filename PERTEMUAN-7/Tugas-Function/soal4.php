<?php

function hitungGaji($jamKerja)
{
    $upahPerJam = 2000;
    $upahLemburPerJam = 3000;
    $jamKerjaNormal = 48;

    if ($jamKerja < 0) {
        return ['error' => 'Jam kerja tidak valid'];
    }

    $totalJamLembur = 0;
    $gajiLembur = 0;

    if ($jamKerja > $jamKerjaNormal) {
        $totalJamLembur = $jamKerja - $jamKerjaNormal;
        $gajiLembur = $totalJamLembur * $upahLemburPerJam;
        $gajiSeminggu = ($jamKerjaNormal * $upahPerJam) + $gajiLembur;
    } else {
        $gajiSeminggu = $jamKerja * $upahPerJam;
    }

    return [
        'totalJamLembur' => $totalJamLembur,
        'gajiLembur' => $gajiLembur,
        'gajiSeminggu' => $gajiSeminggu
    ];
}

$jamKerja = 49;
$hasil = hitungGaji($jamKerja);

if (isset($hasil['error'])) {
    echo '<p><strong>Error:</strong> ' . $hasil['error'] . '</p>';
} else {
    echo '<h3>Perhitungan Gaji Karyawan</h3>';
    echo '<p>Jam Kerja: ' . $jamKerja . ' jam</p>';
    echo '<p>Total Jam Lembur: ' . $hasil['totalJamLembur'] . ' jam</p>';
    echo '<p>Gaji Lembur: Rp ' . number_format($hasil['gajiLembur'], 0, ',', '.') . '</p>';
    echo '<p><strong>Gaji Seminggu: Rp ' . number_format($hasil['gajiSeminggu'], 0, ',', '.') . '</strong></p>';
}
