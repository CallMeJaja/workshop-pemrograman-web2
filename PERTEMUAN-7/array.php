<?php
$hobi = ['Membaca', 'Menulis', 'Ngeblog'];

$hobi[3] = 'Coding';

$hobi[] = 'Olahraga';

foreach ($hobi as $h) {
    echo $h . '<br>';
}
