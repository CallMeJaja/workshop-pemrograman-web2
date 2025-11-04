<?php
function countdownRocket($n, $message = "🚀 Meluncur...")
{
    if ($n < 0) {
        echo "<strong style='color: red; font-size: 20px;'>$message</strong><br>";
        return;
    }
    echo "<span style='font-size: 18px; font-weight: bold;'>$n</span><br>";
    countdownRocket($n - 1, $message);
}

$startNumber = 100;
echo "<h2>Countdown Rocket</h2>";
echo "<div style='text-align: center; padding: 20px;'>";
countdownRocket($startNumber);
echo "</div>";
