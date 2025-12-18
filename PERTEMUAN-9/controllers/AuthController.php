<?php
require_once __DIR__ . '/../models/User.php';

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index()
    {
        // Jika sudah login, redirect ke dashboard
        if ($this->isLoggedIn()) {
            header('Location: index.php?modul=dashboard');
            exit;
        }
        require_once __DIR__ . '/../views/auth/index.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Validasi input kosong
            if (empty($username) || empty($password)) {
                $error = "Username dan password harus diisi!";
                require_once __DIR__ . '/../views/auth/index.php';
                return;
            }

            // Coba login
            $user = $this->userModel->login($username, $password);

            if ($user) {
                // Set session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['logged_in'] = true;

                // Redirect berdasarkan role
                if ($user['role'] === 'dosen') {
                    header('Location: index.php?modul=dashboard&role=dosen');
                } else {
                    header('Location: index.php?modul=dashboard&role=mahasiswa');
                }
                exit;
            } else {
                $error = "Username atau password salah!";
                require_once __DIR__ . '/../views/auth/index.php';
            }
        } else {
            $this->index();
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: index.php?modul=auth&fitur=index&logout=1');
        exit;
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    // Panggil ini di setiap halaman yang butuh login
    public static function checkLogin()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            header('Location: index.php?modul=auth');
            exit;
        }
    }
}
