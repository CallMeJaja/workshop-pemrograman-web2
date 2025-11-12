<?php

/**
 * Menghitung jam lembur
 * @param int $jam_kerja Total jam kerja dalam sebulan
 * @return int Jam lembur
 */
function hitungJamLembur($jam_kerja)
{
    if ($jam_kerja > JAM_IDEAL_PER_BULAN) {
        return $jam_kerja - JAM_IDEAL_PER_BULAN;
    } else {
        return 0;
    }
}

/**
 * Menghitung upah dari jam kerja normal
 * @param int $jam_kerja Total jam kerja
 * @param int $upah_per_jam Upah per jam sesuai posisi
 * @return int Total upah jam kerja
 */
function hitungUpahJamKerja($jam_kerja, $upah_per_jam)
{
    // Jika ada lembur, jam kerja normal maksimal 160 jam
    return hitungJamLembur($jam_kerja) > 0
        ? JAM_IDEAL_PER_BULAN * $upah_per_jam
        : $jam_kerja * $upah_per_jam;
}

/**
 * Menghitung upah lembur
 * @param int $jam_kerja Total jam kerja
 * @param int $upah_per_jam Upah per jam sesuai posisi
 * @param float $persen_lembur Persentase upah lembur
 * @return int Total upah lembur
 */
function hitungUpahLembur($jam_kerja, $upah_per_jam, $persen_lembur)
{
    $jam_lembur = hitungJamLembur($jam_kerja);

    if ($jam_lembur > 0) {
        $upah_lembur_per_jam = $upah_per_jam * ($persen_lembur / 100);
        return $jam_lembur * $upah_lembur_per_jam;
    } else {
        return 0;
    }
}

/**
 * Menghitung fee dari project
 * @param int $harga_project Harga project
 * @param float $persen_fee Persentase fee
 * @return int Total fee project
 */
function hitungUpahFee($harga_project, $persen_fee)
{
    return $harga_project * ($persen_fee / 100);
}

/**
 * Menghitung total upah
 * @param int $upah_jam_kerja Upah dari jam kerja
 * @param int $upah_lembur Upah dari lembur
 * @param int $upah_fee Fee dari project
 * @return int Total upah
 */
function hitungTotalUpah($upah_jam_kerja, $upah_lembur, $upah_fee)
{
    return $upah_jam_kerja + $upah_lembur + $upah_fee;
}

/**
 * Format angka ke format Rupiah
 * @param int $amount Jumlah uang
 * @return string Format Rupiah
 */
function formatRupiah($amount)
{
    return 'Rp' . number_format($amount, 0, ',', '.');
}

/**
 * Proses perhitungan lengkap
 * @param array $data Data input (nama, role, jam_kerja, harga_project)
 * @return array Hasil perhitungan lengkap
 */
function prosesHitungGaji($data)
{
    $posisi = getPosisi();
    $role = $data['role'];

    // Ambil detail posisi
    $upah_per_jam = $posisi[$role]['upah_per_jam'];
    $persen_lembur = $posisi[$role]['persen_lembur'];
    $persen_fee = $posisi[$role]['persen_fee'];
    $badge_color = $posisi[$role]['badge_color'];

    // Hitung semua komponen
    $jam_lembur = hitungJamLembur($data['jam_kerja']);
    $upah_jam_kerja = hitungUpahJamKerja($data['jam_kerja'], $upah_per_jam);
    $upah_lembur = hitungUpahLembur($data['jam_kerja'], $upah_per_jam, $persen_lembur);
    $upah_fee = hitungUpahFee($data['harga_project'], $persen_fee);
    $total_upah = hitungTotalUpah($upah_jam_kerja, $upah_lembur, $upah_fee);

    return [
        'nama' => $data['anggota'],
        'role' => $role,
        'jam_kerja' => $data['jam_kerja'],
        'jam_lembur' => $jam_lembur,
        'harga_project' => $data['harga_project'],
        'upah_per_jam' => $upah_per_jam,
        'persen_lembur' => $persen_lembur,
        'persen_fee' => $persen_fee,
        'badge_color' => $badge_color,
        'upah_jam_kerja' => $upah_jam_kerja,
        'upah_lembur' => $upah_lembur,
        'upah_fee' => $upah_fee,
        'total_upah' => $total_upah
    ];
}
