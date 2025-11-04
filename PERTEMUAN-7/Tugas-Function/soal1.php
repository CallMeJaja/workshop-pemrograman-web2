<?php
function tampilkanBiodata($mahasiswa)
{
    echo "<h2>Daftar Mahasiswa</h2>";
    foreach ($mahasiswa as $mhs) {
        echo "<strong>NIM:</strong> " . $mhs['NIM'] . "<br>";
        echo "<strong>Nama:</strong> " . $mhs['Nama'] . "<br>";
        echo "<strong>Program Studi:</strong> " . $mhs['Program Studi'] . "<br>";
        echo "<hr>";
    }
}

$mahasiswa = [
    [
        'NIM' => '04001',
        'Nama' => 'Reza',
        'Program Studi' => 'Teknologi Rekayasa Perangkat Lunak'
    ],
    [
        'NIM' => '04002',
        'Nama' => 'Dhafi',
        'Program Studi' => 'Teknologi Rekayasa Perangkat Lunak'
    ],
    [
        'NIM' => '04003',
        'Nama' => 'Satrio',
        'Program Studi' => 'Teknologi Rekayasa Perangkat Lunak'
    ],
    [
        'NIM' => '03001',
        'Nama' => 'Teuku',
        'Program Studi' => 'Teknologi Rekayasa Mekatronika'
    ],
    [
        'NIM' => '03002',
        'Nama' => 'Jauza',
        'Program Studi' => 'Teknologi Rekayasa Mekatronika'
    ]
];

tampilkanBiodata($mahasiswa);
