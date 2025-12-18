<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    echo "<script>alert('Anda harus login terlebih dahulu.'); window.location.href = 'login.php';</script>";
    exit();
}
include 'koneksi.php';
include 'blok.php';
session_destroy();
echo "<script>alert('Anda telah logout.'); window.location.href = 'login.php';</script>";
