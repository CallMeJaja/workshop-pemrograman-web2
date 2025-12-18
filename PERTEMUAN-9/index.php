<?php

/**
 * Main Router - SIAKAD Kampus
 * Menangani semua routing aplikasi berdasarkan modul dan fitur.
 */

require_once 'config/database.php';
require_once __DIR__ . '/controllers/AuthController.php';

session_start();

$modul = $_GET['modul'] ?? 'auth';
$fitur = $_GET['fitur'] ?? 'index';

switch ($modul) {
    case 'auth':
        $controller = new AuthController();
        switch ($fitur) {
            case 'login':
                $controller->login();
                break;
            case 'logout':
                $controller->logout();
                break;
            default:
                $controller->index();
                break;
        }
        exit; 

    case 'dashboard':
        AuthController::checkLogin();
        require_once __DIR__ . '/views/dashboard/index.php';
        exit; 

    case 'mahasiswa':
        AuthController::checkLogin();
        require_once __DIR__ . '/controllers/MahasiswaController.php';
        $controller = new MahasiswaController();
        $controller->$fitur();
        exit;

    case 'dosen':
        AuthController::checkLogin();
        require_once __DIR__ . '/controllers/DosenController.php';
        $controller = new DosenController();
        $controller->$fitur();
        exit;

    case 'matkul':
        AuthController::checkLogin();
        require_once __DIR__ . '/controllers/MatkulController.php';
        $controller = new MatkulController();
        $controller->$fitur();
        exit;

    case 'nilai':
        AuthController::checkLogin();
        require_once __DIR__ . '/controllers/NilaiController.php';
        $controller = new NilaiController();
        $controller->$fitur();
        exit;

    default:
        header('Location: index.php?modul=auth');
        exit;
}