<?php
/**
 * Auth Helper
 * Helper functions untuk autentikasi dan role-based access control.
 */

/**
 * Cek apakah user sudah login
 * @return bool
 */
function isLoggedIn()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

/**
 * Ambil role user yang sedang login
 * @return string|null
 */
function getRole()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return $_SESSION['role'] ?? null;
}

/**
 * Ambil username user yang sedang login
 * @return string|null
 */
function getUsername()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return $_SESSION['username'] ?? null;
}

/**
 * Cek apakah user adalah dosen
 * @return bool
 */
function isDosen()
{
    return getRole() === 'dosen';
}

/**
 * Cek apakah user adalah mahasiswa
 * @return bool
 */
function isMahasiswa()
{
    return getRole() === 'mahasiswa';
}

/**
 * Redirect ke halaman login jika belum login
 */
function requireLogin()
{
    if (!isLoggedIn()) {
        header('Location: /index.php?modul=auth');
        exit;
    }
}

/**
 * Redirect jika role tidak sesuai
 * @param string|array $allowedRoles Role yang diizinkan
 */
function requireRole($allowedRoles)
{
    requireLogin();
    
    if (is_string($allowedRoles)) {
        $allowedRoles = [$allowedRoles];
    }
    
    $currentRole = getRole();
    if (!in_array($currentRole, $allowedRoles)) {
        // Set flash message
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['flash_message'] = [
            'type' => 'error',
            'message' => 'Anda tidak memiliki akses ke halaman tersebut.'
        ];
        header('Location: /index.php?modul=dashboard');
        exit;
    }
}

/**
 * Cek apakah user bisa mengakses modul tertentu
 * @param string $modul Nama modul
 * @return bool
 */
function canAccess($modul)
{
    if (!isLoggedIn()) {
        return false;
    }
    
    $role = getRole();
    
    // Dosen bisa akses semua
    if ($role === 'dosen') {
        return true;
    }
    
    // Mahasiswa hanya bisa akses modul tertentu
    if ($role === 'mahasiswa') {
        $allowedModules = ['dashboard', 'mahasiswa', 'matkul'];
        return in_array($modul, $allowedModules);
    }
    
    return false;
}

/**
 * Cek apakah user bisa melakukan operasi CRUD
 * @return bool
 */
function canCRUD()
{
    return isDosen();
}
