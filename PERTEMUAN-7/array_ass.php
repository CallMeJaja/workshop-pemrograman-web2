<?php
$mahasiswa = [
    "nama" => "Budi Santoso",
    "nim" => "123456789",
    "domisili" => "Jakarta",
    "jurusan" => "Teknik Informatika",
    "matkul" => [
        "Pemrograman Web",
        "Basis Data",
        "Jaringan Komputer"
    ],
    1 => ["Pramuka", "Sepak Bola", ["Futsal", "Basket", [
        "nama" => "Volly",
        "level" => "Pemula"
    ]]],
];

echo "<h2>" . $mahasiswa["nama"] . "</h2>";
echo "<p>NIM: " . $mahasiswa["nim"] . "</p>";
echo "<p>Domisili: " . $mahasiswa["domisili"] . "</p>";
echo "<p>Jurusan: " . $mahasiswa["jurusan"] . "</p>";
echo "<p>Matkul ke-1: " . $mahasiswa["matkul"][0] . "</p>";
echo "<p>Matkul ke-2: " . $mahasiswa["matkul"][1] . "</p>";
echo "<p>Matkul ke-3: " . $mahasiswa["matkul"][2] . "</p>";
echo "<p>Ekstrakulikuler: " . $mahasiswa[1] . "</p>";
echo "Level Volly: " . $mahasiswa[1][2][2]["level"] . "<br>";
echo "<hr>";

echo "<pre>";
print_r($mahasiswa);
echo "</pre>";
echo "<hr>";
