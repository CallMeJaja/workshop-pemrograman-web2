<?php

/**
 * Konfigurasi Database
 * Mengatur koneksi ke database MySQL
 */

// Kredensial Database
define('DB_HOST', 'localhost');
define('DB_NAME', 'kampus');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

/**
 * Membuat koneksi ke database
 * @return mysqli|null
 */
function getConnection()
{
    static $conn = null;

    if ($conn === null) {
        try {
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if ($conn->connect_error) {
                throw new Exception("Connection failed: " . $conn->connect_error);
            }

            $conn->set_charset(DB_CHARSET);
        } catch (Exception $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }

    return $conn;
}

/**
 * Menutup koneksi database
 */
function closeConnection()
{
    $conn = getConnection();
    if ($conn) {
        $conn->close();
    }
}
