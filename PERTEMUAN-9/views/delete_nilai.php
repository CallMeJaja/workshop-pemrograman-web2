<?php
/**
 * Script Hapus Data Nilai
 * Menghapus data nilai berdasarkan ID.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../config/database.php';

// Validasi ID parameter
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $conn = getConnection();
    
    // Eksekusi penghapusan
    $stmt = $conn->prepare("DELETE FROM tbl_nilai WHERE id_nilai = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['flash_message'] = [
            'type' => 'success',
            'message' => 'Data nilai berhasil dihapus.'
        ];
    } else {
        $_SESSION['flash_message'] = [
            'type' => 'error',
            'message' => 'Gagal menghapus data: ' . $conn->error
        ];
    }
    
    $stmt->close();
    header('Location: view_nilai.php');
    exit;
} else {
    $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'ID data tidak valid!'];
    header('Location: view_nilai.php');
    exit;
}
?>
