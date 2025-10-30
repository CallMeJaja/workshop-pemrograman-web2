<?php
$hobi = ['Membaca', 'Menulis', 'Ngeblog'];

$hobi[3] = 'Coding';

$hobi[] = 'Bermain Game';
$hobi[1] = 'Mengetik';
$hobi[-1] = 'Dagang';

foreach ($hobi as $h) {
    echo $h . '<br>';
}
