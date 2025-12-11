<?php
/**
 * Script Hapus Data Dosen
 * Menghapus data dosen berdasarkan ID. Menangani error Constraint/Foreign Key.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../config/database.php';

// Validasi ID dari parameter URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $nidn = $_GET['id'];
    $conn = getConnection();

    // Eksekusi penghapusan
    $stmt = $conn->prepare("DELETE FROM tbl_dosen WHERE nidn = ?");
    $stmt->bind_param("s", $nidn);

    if ($stmt->execute()) {
        $_SESSION['flash_message'] = [
            'type' => 'success',
            'message' => 'Data dosen berhasil dihapus secara permanen.'
        ];
    } else {
        // Penanganan Error (Constraint Database)
        $errorMsg = $conn->error;
        if (strpos($errorMsg, 'Constraint') !== false || strpos($errorMsg, 'foreign key') !== false) {
             $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Gagal menghapus! Dosen ini masih memiliki data Mata Kuliah atau Nilai aktif.'
             ];
        } else {
             $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Gagal menghapus data: ' . $errorMsg
             ];
        }
    }
    
    $stmt->close();
    header('Location: view_dosen.php');
    exit;
} else {
    // ID tidak valid
    $_SESSION['flash_message'] = [
        'type' => 'error',
        'message' => 'Parameter ID tidak valid!'
    ];
    header('Location: view_dosen.php');
    exit;
}
?>
