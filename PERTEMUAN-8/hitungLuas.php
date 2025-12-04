<?php
include('komponen/header.php');
include('komponen/navbar.php');

require('rumus/luas.php');

$a = 10;
$b = 5;
$c = 8;

$luas = luasBalok($a, $b, $c);
echo "Hasil Luas = " . $luas;
echo "<br>";

include('komponen/footer.php');
