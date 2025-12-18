<?php
session_start();
if (isset($_SESSION['username'])) {
    echo "<script>alert('Anda harus login terlebih dahulu.');</script>";
    header("Location: login.php");
    exit();
}
