<?php
echo '<button onclick="history.back()">Kembali</button>';


echo "<h4>Operator Relasi</h4>";

$a = 6;
$b = 2;

$c = $a > $b;
echo "$a > $b : $c <br>";

$c = $a < $b;
echo "$a < $b : $c <br>";

$c = $a >= $b;
echo "$a >= $b : $c <br>";
$c = $a <= $b;
echo "$a <= $b : $c <br>";

$c = $a == $b;
echo "$a == $b : $c <br>";

$c = $a != $b;
echo "$a != $b : $c <br>";
