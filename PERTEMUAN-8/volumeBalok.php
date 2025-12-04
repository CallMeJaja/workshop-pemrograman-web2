<?php
include('komponen/header.php');
require('komponen/navbar.php');

require('rumus/luas.php');
require('rumus/volume.php');

$a = 10;
$b = 5;
$c = 8;

$luas = luasBalok($a, $b, $c);
echo "Luas Balok : " . $luas;
echo "<br>";

$volume = volumeBalok($a, $b, $c);
echo "Volume Balok = " . $volume;
echo "<br>";

include('komponen/footer.php');
