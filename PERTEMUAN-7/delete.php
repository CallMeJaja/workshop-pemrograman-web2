<?php
$hewan = ['Kucing', 'Anjing', 'Kelinci', 'Burung'];

unset($hewan[2]);

echo $hewan[0] . '<br>';
echo $hewan[1] . '<br>';
echo $hewan[3] . '<br>';
echo '<hr>';


echo '<pre>';
print_r($hewan);
echo '</pre>';
echo '<hr>';
