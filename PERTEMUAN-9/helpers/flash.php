<?php
/**
 * Flash Message Helper
 * Mengelola pesan flash yang ditampilkan sekali.
 */

/**
 * Set flash message ke session
 * @param string $type Tipe pesan (success, error, warning, info)
 * @param string $message Isi pesan
 */
function setFlash($type, $message)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['flash_message'] = ['type' => $type, 'message' => $message];
}

/**
 * Ambil flash message dari session
 * @return array|null
 */
function getFlash()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['flash_message'])) {
        $flash = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        return $flash;
    }
    return null;
}

/**
 * Tampilkan flash message sebagai HTML alert
 */
function showFlash()
{
    $flash = getFlash();
    if ($flash) {
        $class = $flash['type'] === 'success' ? 'alert-success' : 'alert-danger';
        if ($flash['type'] === 'warning') {
            $class = 'alert-warning';
        } elseif ($flash['type'] === 'info') {
            $class = 'alert-info';
        }
        echo "<div class='alert {$class} alert-dismissible fade show' role='alert'>";
        echo "<i class='bi bi-" . ($flash['type'] === 'success' ? 'check-circle' : 'exclamation-triangle') . " me-2'></i>";
        echo htmlspecialchars($flash['message']);
        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
        echo "</div>";
    }
}
