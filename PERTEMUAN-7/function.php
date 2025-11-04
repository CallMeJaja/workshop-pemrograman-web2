<?php
function sapaPengujung(string $nama, int $jml)
{
    echo "Halo, $nama Selamat datang di situs kami.";
    if ($jml > 10) {
        echo "<p>Kami memiliki hadiah eBook gratis karena anda mengunjungi situs kami lebih dari $jml kali!</p>";
    }
}

sapaPengujung("Reza", 12);

function test($a, $b)
{
    echo $a + $b;
}

echo test(1, 2);


function hitungLuasPersegiPanjang(float $panjang, float $lebar): float
{
    return $panjang * $lebar;
}

echo "<br>Luas Persegi Panjang: " . hitungLuasPersegiPanjang(5.5, 3.2);
