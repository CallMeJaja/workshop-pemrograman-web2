<?php
include 'blok.php';
?>

<h3>Form Input Data</h3>
<form action="simpan.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>NIM</td>
            <td><input type="number" name="nim" id="nim"></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="name" id="name"></td>
        </tr>
        <tr>
            <td>Prodi</td>
            <td>
                <select name="prodi" id="prodi">
                    <option value="" selected disabled>--- Pilih Prodi---</option>
                    <option value="TRPL">TRPL</option>
                    <option value="TRM">TRM</option>
                    <option value="TM">TM</option>
                    <option value="TL">TL</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="email" name="email" id="email"></td>
        </tr>
        <tr>
            <td>No. HP</td>
            <td><input type="number" name="no_hp" id="no_hp"></td>
        </tr>
        <tr>
            <td>Foto</td>
            <td><input type="file" name="foto" id="foto"></td>
        </tr>
    </table>
    <input type="submit" value="Simpan" />
    <input type="reset" value="Batal" />
</form>
<button onclick="history.back()">Kembali</button>