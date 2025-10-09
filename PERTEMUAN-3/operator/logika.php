<?php
echo '<button onclick="history.back()">Kembali</button>';

echo "<h4>Operator Logika</h4>";
echo "<hr>";

$a = true;
$b = false;

$c = $a && $b;
printf("$b && $b = %b", $a, $b, $c);
echo "<hr>";

$c = $a || $b;
printf("$a || $b = %b", $a, $b, $c);
echo "<hr>";

$c = !$a;
printf("!$a = %b", $a, $c);
echo "<hr>";
