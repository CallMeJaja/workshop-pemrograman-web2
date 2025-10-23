<form action="#" method="POST">
    <label for="angka1">Input Angka 1</label>
    <input type="number" name="angka1" id="angka1" required>
    <br>
    <label for="angka2">Input Angka 2</label>
    <input type="number" name="angka2" id="angka2" required>
    <br>
    <button type="submit" name="submit">Submit</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $angka1 = $_POST['angka1'];
    $angka2 = $_POST['angka2'];

    echo "<h3>Hasil Perulangan dari $angka1 sampai $angka2 adalah :</h3>";
    $angka1 = (int)$angka1;
    $angka2 = (int)$angka2;

    if ($angka1 == $angka2) {
        $i = $angka1;
        if ($i % 2 == 0) {
            echo "Ini adalah bilangan genap: $i <br>";
        } else {
            echo "Ini adalah bilangan ganjil: $i <br>";
        }
    } elseif ($angka1 < $angka2) {
        for ($i = $angka1; $i <= $angka2; $i++) {
            if ($i % 2 == 0) {
                echo "Ini adalah bilangan genap: $i <br>";
            } else {
                echo "Ini adalah bilangan ganjil: $i <br>";
            }
        }
    } else {
        for ($i = $angka1; $i >= $angka2; $i--) {
            if ($i % 2 == 0) {
                echo "Ini adalah bilangan genap: $i <br>";
            } else {
                echo "Ini adalah bilangan ganjil: $i <br>";
            }
        }
    }
}
