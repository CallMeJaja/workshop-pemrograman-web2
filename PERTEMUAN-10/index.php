<?php

include 'koneksi.php';
include 'blok.php';

$sql = "SELECT * FROM tbl_mahasiswa";
$hasil_query = mysqli_query($conn, $sql);

if (!$hasil_query) {
    die("Query failed: " . mysqli_error($conn));
}

?>
<h1>Data Mahasiswa</h1>
<a href="tambah.php">Tambah Data</a>
<button onclick="window.location.href='logout.php'">Logout</button>
<br>
<br>
<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <td>Foto</td>
            <th>NIM</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Email</th>
            <th>No. HP</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($hasil_query)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td><img src='" . $row['foto'] . "' width='100px' height='100px1' alt='Foto'></td>";
            echo "<td>" . $row['nim'] . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['prodi'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['nohp'] . "</td>";
            echo "<td>
                    <a href='edit.php?nim=" . $row['nim'] . "'>Edit</a> | 
                    <a href='delete.php?nim=" . $row['nim'] . "' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\">Hapus</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>