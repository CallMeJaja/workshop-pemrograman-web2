<form action="#" method="post">
    <label for="">Masukkan Jumlah Ayam</label>
    <input type="number" name="jumlah_ayam" id="jumlah_ayam" required>
    <br>
    <button type="submit" name="submit">Submit</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $jumlah_ayam = (int)$_POST['jumlah_ayam'];
    echo "Anak ayam turun $jumlah_ayam <br>";
    for ($i = $jumlah_ayam; $i >= 1; $i--) {
        $sisa = $i - 1;
        if ($sisa > 0) {
            echo "Anak ayam turun $i, mati satu tinggal $sisa <br>";
        } else {
            echo "Anak ayam turun $i, mati satu tinggal induknya <br>";
        }
    }
}
