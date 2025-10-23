<form action="#" method="POST">
    <label for="">Input Angka</label>
    <input type="number" name="angka" id="angka" required>
    <br>
    <button type="submit" name="submit">Submit</button>
</form>

<?php
if (isset($_POST['submit'])) {
    for ($i = 1; $i <= $_POST['angka']; $i++) {
        for ($j = 1; $j <= $i; $j++) {
            echo "$j ";
        }
        echo "<br>";
    }
}
