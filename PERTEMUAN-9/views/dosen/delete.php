<?php
/**
 * Script Hapus Data Dosen
 * Menghapus data dosen berdasarkan NIDN. Mengelola foreign key constraint.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../../config/database.php';

// Cek parameter ID
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $conn = getConnection();
    
    // Eksekusi penghapusan
    $stmt = $conn->prepare("DELETE FROM tbl_dosen WHERE nidn = ?");
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        $_SESSION['flash_message'] = [
            'type' => 'success',
            'message' => 'Data dosen berhasil dihapus.'
        ];
    } else {
        // Cek error constraint
        $errorMsg = $conn->error;
        if (strpos($errorMsg, 'Constraint') !== false || strpos($errorMsg, 'foreign key') !== false) {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Gagal menghapus! Dosen ini masih menjadi pengampu mata kuliah atau wali.'
            ];
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Gagal menghapus data: ' . $errorMsg
            ];
        }
    }
    
    $stmt->close();
    header('Location: index.php');
    exit;
} else {
    $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'NIDN tidak valid!'];
    header('Location: index.php');
    exit;
}
?>
