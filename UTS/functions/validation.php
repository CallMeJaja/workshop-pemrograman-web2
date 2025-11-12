<?php

/**
 * Validasi input form
 * @param array $post Data dari $_POST
 * @return array Array berisi error messages (kosong jika valid)
 */
function validateInput($post)
{
    $errors = [];
    $anggota = getAnggotaTim();
    $posisi = getPosisi();

    // Validasi nama anggota
    if (empty($post['anggota'])) {
        $errors[] = "Nama anggota harus dipilih.";
    } elseif (!in_array($post['anggota'], $anggota)) {
        $errors[] = "Nama anggota tidak valid.";
    }

    // Validasi posisi
    if (empty($post['role'])) {
        $errors[] = "Posisi harus dipilih.";
    } elseif (!array_key_exists($post['role'], $posisi)) {
        $errors[] = "Posisi tidak valid.";
    }

    // Validasi jam kerja
    if (!is_numeric($post['jam_kerja']) || $post['jam_kerja'] <= 0) {
        $errors[] = "Jam kerja harus berupa angka positif.";
    } elseif ($post['jam_kerja'] > MAX_JAM_PER_BULAN) {
        $errors[] = "Jam kerja tidak realistis (maksimal " . MAX_JAM_PER_BULAN . " jam/bulan).";
    }

    // Validasi harga project
    if (!is_numeric($post['harga_project']) || $post['harga_project'] < MIN_HARGA_PROJECT) {
        $errors[] = "Harga project minimal Rp " . number_format(MIN_HARGA_PROJECT, 0, ',', '.') . " (realistis untuk project software).";
    }

    return $errors;
}

/**
 * Sanitize input untuk keamanan
 * @param array $post Data dari $_POST
 * @return array Data yang sudah di-sanitize
 */
function sanitizeInput($post)
{
    return [
        'anggota' => htmlspecialchars(trim($post['anggota'] ?? ''), ENT_QUOTES, 'UTF-8'),
        'role' => htmlspecialchars(trim($post['role'] ?? ''), ENT_QUOTES, 'UTF-8'),
        'jam_kerja' => filter_var($post['jam_kerja'] ?? 0, FILTER_VALIDATE_INT),
        'harga_project' => filter_var($post['harga_project'] ?? 0, FILTER_VALIDATE_INT)
    ];
}
