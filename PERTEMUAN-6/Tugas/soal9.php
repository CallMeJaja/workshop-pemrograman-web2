<form action="#" method="post">
    <label for="">Saldo Awal</label>
    <input type="number" name="saldo_awal" id="saldo_awal" value="1000000" required>
    <br>
    <label for="">Jangka Waktu (bulan)</label>
    <input type="number" name="jangka_waktu" id="jangka_waktu" value="12" min="1" required>
    <br>
    <button type="submit" name="submit">Submit</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $saldo_awal = (float) $_POST['saldo_awal'];
    $jangka_waktu = (int) $_POST['jangka_waktu'];
    $saldo = $saldo_awal;
    $admin_fee = 9000;

    echo "<h3>Rincian:</h3>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Bulan</th><th>Saldo Awal</th><th>Bunga (%)</th><th>Bunga (Rp)</th><th>Biaya Admin (Rp)</th><th>Saldo Akhir</th></tr>";

    for ($bulan = 1; $bulan <= $jangka_waktu; $bulan++) {
        $saldo_awal_bulan = $saldo;
        $bunga_tahunan = ($saldo_awal_bulan < 1100000) ? 0.03 : 0.04;
        $bunga_bulan = $saldo * $bunga_tahunan;
        $saldo += $bunga_bulan;
        $saldo -= $admin_fee;


        echo "<tr>";
        echo "<td>{$bulan}</td>";
        echo "<td>Rp " . number_format($saldo_awal_bulan, 0, ',', '.') . "</td>";
        echo "<td>" . ($bunga_tahunan * 100) . "%</td>";
        echo "<td>Rp " . number_format($bunga_bulan, 0, ',', '.') . "</td>";
        echo "<td>Rp " . number_format($admin_fee, 0, ',', '.') . "</td>";
        echo "<td>Rp " . number_format($saldo, 0, ',', '.') . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<p>Saldo akhir setelah {$jangka_waktu} bulan: <strong>Rp " . number_format($saldo, 0, ',', '.') . "</strong></p>";
}
