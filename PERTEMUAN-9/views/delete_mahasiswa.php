<?php
/**
 * Script Hapus Data Mahasiswa
 * Menghapus data mahasiswa berdasarkan NIM. Menangani error Constraint.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../config/database.php';

// Validasi ID parameter
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $nim = $_GET['id'];
    $conn = getConnection();

    // Eksekusi penghapusan
    $stmt = $conn->prepare("DELETE FROM tbl_mahasiswa WHERE nim = ?");
    $stmt->bind_param("s", $nim);

    if ($stmt->execute()) {
        $_SESSION['flash_message'] = [
            'type' => 'success',
            'message' => 'Data mahasiswa berhasil dihapus.'
        ];
    } else {
        // Penanganan Error Constraint
        $errorMsg = $conn->error;
        if (strpos($errorMsg, 'Constraint') !== false || strpos($errorMsg, 'foreign key') !== false) {
             $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Gagal menghapus! Mahasiswa ini masih memiliki data Nilai yang aktif.'
             ];
        } else {
             $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Gagal menghapus data: ' . $errorMsg
             ];
        }
    }
    
    $stmt->close();
    header('Location: view_mahasiswa.php');
    exit;
} else {
    $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Parameter ID tidak valid!'];
    header('Location: view_mahasiswa.php');
    exit;
}
?>
