<?php
/**
 * Script Hapus Mata Kuliah
 * Menghapus mata kuliah berdasarkan Kode MK.
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
    $stmt = $conn->prepare("DELETE FROM tbl_matkul WHERE kode_mk = ?");
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        $_SESSION['flash_message'] = [
            'type' => 'success',
            'message' => 'Data mata kuliah berhasil dihapus.'
        ];
    } else {
        // Cek error constraint
        $errorMsg = $conn->error;
        if (strpos($errorMsg, 'Constraint') !== false || strpos($errorMsg, 'foreign key') !== false) {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Gagal menghapus! Mata kuliah ini masih memiliki data Nilai.'
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
    $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Kode MK tidak valid!'];
    header('Location: index.php');
    exit;
}
?>
