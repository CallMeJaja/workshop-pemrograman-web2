<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan POST</title>
</head>

<body>
    <form action="" method="POST">
        <label for="">Nama</label><br>
        <input type="text" name="nama"> <Br>
        <label for="">Email</label><br>
        <input type="email" name="email"><br>
        <label for="">Umur</label>
        <input type="number" name="umur"><br>
        <input type="submit" name="simpan" value="OK">
    </form>

    <?php
    echo "Nama : " . $_POST['nama'];
    echo "<br>";
    echo "Email : " . $_POST['email'];
    echo "<br>";
    echo "Umur Anda : " . $_POST['umur'] . ' tahun';
    echo "<br>";
    echo "SUBMIT : " . $_POST['simpan'];
    ?>
</body>

</html>