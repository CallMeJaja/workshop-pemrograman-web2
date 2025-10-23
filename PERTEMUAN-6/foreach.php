<?php
$listMahasiswa = ["Eza", "Amar", "Bagas", ["Test1", "Test2"]];
foreach ($listMahasiswa as $data) {
    echo "Nama Mahasiswa: $data <br>";
    foreach ($data as $subData) {
        echo "$subData <br>";
    }
}
