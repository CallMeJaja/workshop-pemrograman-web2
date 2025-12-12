<?php
/**
 * CSRF Protection Helper
 * Melindungi form dari serangan Cross-Site Request Forgery.
 */

/**
 * Generate CSRF token
 * @return string Token CSRF
 */
function generateCsrfToken()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verifikasi CSRF token
 * @param string $token Token yang akan diverifikasi
 * @return bool
 */
function verifyCsrfToken($token)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Generate hidden input field untuk CSRF token
 * @return string HTML input hidden
 */
function csrfField()
{
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars(generateCsrfToken()) . '">';
}

/**
 * Regenerate CSRF token (setelah form submit yang berhasil)
 */
function regenerateCsrfToken()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
