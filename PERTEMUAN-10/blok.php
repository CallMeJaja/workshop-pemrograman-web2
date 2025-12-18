<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    echo "<script>alert('Anda harus login terlebih dahulu.'); window.location.href = 'login.php';</script>";
    exit();
}
