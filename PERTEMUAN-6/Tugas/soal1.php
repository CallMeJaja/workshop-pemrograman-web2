<form action="#" method="POST">
    <label for="Angka1">Input Angka 1</label>
    <input type="number" name="Angka1" id="Angka1" required>
    <br>
    <label for="Angka2">Input Angka 2</label>
    <input type="number" name="Angka2" id="Angka2"
        required>
    <br>
    <button type="submit" name="submit">Submit</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $angka1 = $_POST['Angka1'];
    $angka2 = $_POST['Angka2'];

    echo "<h3>Hasil Perulangan dari $angka1 sampai $angka2 adalah :</h3>";
    if ($angka1 <= $angka2) {
        for ($i = $angka1; $i <= $angka2; $i++) {
            echo "Ini baris ke-$i <br>";
        }
    } else {
        for ($i = $angka1; $i >= $angka2; $i--) {
            echo "Ini baris ke-$i <br>";
        }
    }
}
