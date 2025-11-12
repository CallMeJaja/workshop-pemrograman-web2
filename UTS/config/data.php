<?php

/**
 * Mendapatkan daftar anggota tim
 * @return array
 */
function getAnggotaTim()
{
    return [
        "Reza Asriano Maulana",
        "Satrio Ilham Syahputra",
        "Dhafi Ebsan Yurizal",
        "Helgi Nur Allamsyah",
        "Fikri Ramdani"
    ];
}

/**
 * Mendapatkan data posisi dengan rate
 * @return array
 */
function getPosisi()
{
    return [
        'Lead Developer' => [
            'upah_per_jam' => 450000,
            'persen_lembur' => 18,
            'persen_fee' => 5,
            'badge_color' => 'danger'
        ],
        'QA Engineer' => [
            'upah_per_jam' => 250000,
            'persen_lembur' => 12,
            'persen_fee' => 1,
            'badge_color' => 'info'
        ],
        'DevOps Engineer' => [
            'upah_per_jam' => 350000,
            'persen_lembur' => 10,
            'persen_fee' => 2.5,
            'badge_color' => 'warning text-dark'
        ],
        'Backend Dev' => [
            'upah_per_jam' => 300000,
            'persen_lembur' => 15,
            'persen_fee' => 3,
            'badge_color' => 'primary'
        ],
        'Frontend Dev' => [
            'upah_per_jam' => 300000,
            'persen_lembur' => 15,
            'persen_fee' => 3,
            'badge_color' => 'success'
        ]
    ];
}
