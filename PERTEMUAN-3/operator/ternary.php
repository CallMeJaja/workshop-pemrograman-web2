<?php
echo '<button onclick="history.back()">Kembali</button>';
echo "<h4>Operator Ternary</h4>";
echo "<hr>";

$suka = true;
$jawab = $suka ? "Iya" : "Tidak";
echo $jawab;
echo "<hr>";
echo "<br>";

$nilai = 9;
echo $nilai > 8 ? 'Sangat Baik' : 'Baik';
echo "<hr>";
echo "<br>";

$score = 6;
$predikat = $score > 8 ? 'Sangat Baik' : ($score >= 7 && $score <= 8 ? 'Baik' : ($score <= 6 && $score > 5 ? 'Sedang' : 'Kurang'));
echo $predikat;
