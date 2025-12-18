<?php
include 'koneksi.php';
session_start();

if (isset($_SESSION['login_user'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT id FROM tbl_user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['login_user'] = $username;
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Login Gagal: Username atau Password salah.'); window.location.href = 'login.php';</script>";
    }
}
