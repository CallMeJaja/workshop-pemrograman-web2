<?php
session_start();

unset($_SESSION['username']);

session_destroy();
echo "<script>alert('Anda telah logout.'); window.location='login.php';</script>";
