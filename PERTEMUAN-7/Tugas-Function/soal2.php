<?php
function beratBadanIdeal($tinggiBadan): float
{
  return ($tinggiBadan - 100) - (0.1 * ($tinggiBadan - 100));
}

function selisihBerat($beratBadan, $beratBadanIdeal): float
{
  return abs($beratBadan - $beratBadanIdeal);
}

function cekStatusBerat($beratBadan, $beratBadanIdeal)
{
  $selisih = selisihBerat($beratBadan, $beratBadanIdeal);

  if ($selisih == 0) {
    return "Berat badan Anda sudah ideal.";
  }

  $status = $beratBadan > $beratBadanIdeal ? "kelebihan" : "kekurangan";
  return "Anda $status berat badan sebesar " . round($selisih, 2) . " kg.";
}

$tinggi = 177;
$bb = 65;
$beratBadanIdeal = beratBadanIdeal($tinggi);

echo "<h2>Perhitungan Berat Badan Ideal</h2>";
echo "<strong>Tinggi Badan:</strong> " . $tinggi . " cm<br>";
echo "<strong>Berat Badan:</strong> " . $bb . " kg<br>";
echo "<strong>Berat Badan Ideal:</strong> " . round($beratBadanIdeal, 2) . " kg<br>";
echo "<hr>";
echo cekStatusBerat($bb, $beratBadanIdeal);
