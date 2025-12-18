<?php
session_start();
if (isset($_SESSION['login_user'])) {
    echo "<script>alert('Anda sudah login.'); window.location.href = 'index.php';</script>";
    exit();
}
?>

<h3>Form Login Sederhana</h3>
<form action="proses_login.php" method="post">
    <table>
        <tr>
            <td>Username</td>
            <td><input type="text" name="username" required></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" required></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Login"></td>
        </tr>
    </table>
</form>