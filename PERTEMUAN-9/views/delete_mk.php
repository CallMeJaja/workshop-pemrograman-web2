<?php
/**
 * Script Hapus Data Mata Kuliah
 * Menghapus data MK berdasarkan Kode. Mengelola constraint database.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../config/database.php';

// Validasi parameter ID
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $conn = getConnection();
    
    // Eksekusi penghapusan
    $stmt = $conn->prepare("DELETE FROM tbl_matkul WHERE kodeMatkul = ?");
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        $_SESSION['flash_message'] = [
            'type' => 'success',
            'message' => 'Data mata kuliah berhasil dihapus.'
        ];
    } else {
        // Penanganan Error Constraint
        $errorMsg = $conn->error;
        if (strpos($errorMsg, 'Constraint') !== false || strpos($errorMsg, 'foreign key') !== false) {
             $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Gagal menghapus! Mata kuliah ini masih memiliki data Nilai yang aktif.'
             ];
        } else {
             $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Gagal menghapus data: ' . $errorMsg
             ];
        }
    }
    
    $stmt->close();
    header('Location: view_mk.php');
    exit;
} else {
    $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Kode MK tidak valid!'];
    header('Location: view_mk.php');
    exit;
}
?>
