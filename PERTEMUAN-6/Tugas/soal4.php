<form action="#" method="POST">
    <label for="kolom">Masukkan Jumlah Kolom</label>
    <input type="number" name="kolom" id="kolom" required>
    <br>
    <label for="baris">Masukkan Jumlah Baris</label>
    <input type="number" name="baris" id="baris" required>
    <br>
    <button type="submit" name="submit">Submit</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $kolom = $_POST['kolom'];
    $baris = $_POST['baris'];

    echo "<h3>Hasil Perulangan dengan $kolom kolom dan $baris baris adalah :</h3>";

    echo "<table border='1' cellpadding='10'>";
    echo "<tr>";
    for ($i = 1; $i <= $kolom; $i++) {
        echo "<th>Kolom $i</th>";
    }
    echo "</tr>";
    for ($j = 1; $j <= $baris; $j++) {
        echo "<tr>";
        for ($k = 1; $k <= $kolom; $k++) {
            echo "<td>Baris $j, Kolom $k</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
