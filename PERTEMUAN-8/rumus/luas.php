<?php
function luasBalok($panjang, $lebar, $tinggi)
{
    return 2 * (($panjang * $lebar) + ($panjang * $tinggi) + ($lebar * $tinggi));
}
