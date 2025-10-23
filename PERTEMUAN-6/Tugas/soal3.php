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
    $jumlahAngkaGenap = 0;
    $totalBilanganGenap = 0;

    for ($i = $angka1; $i <= $angka2; $i++) {
        if ($i % 2 == 0) {
            $jumlahAngkaGenap++;
            $totalBilanganGenap += $i;
        }
    }

    echo "Total Jumlah Bilangan Genap antara $angka1 dan $angka2 adalah : $totalBilanganGenap <br>";
    echo "Jumlah Angka Genap antara $angka1 dan $angka2 adalah : $jumlahAngkaGenap";
}
