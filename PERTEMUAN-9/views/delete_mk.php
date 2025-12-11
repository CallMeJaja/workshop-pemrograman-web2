<?php
/**
 * Delete Mata Kuliah
 * Script untuk menghapus data mata kuliah dari tbl_matkul
 */

require_once '../config/database.php';

// Get ID from URL
$id = isset($_GET['id']) ? $_GET['id'] : '';

if (!empty($id)) {
    $conn = getConnection();
    
    // Prepare Delete Statement
    $query = "DELETE FROM tbl_matkul WHERE kodeMatkul = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        // Success
        echo "<script>
                alert('Data mata kuliah berhasil dihapus!');
                window.location.href = 'view_mk.php';
              </script>";
    } else {
        // Failure
        $errorMsg = $conn->error;
        if (strpos($errorMsg, 'Constraint') !== false || strpos($errorMsg, 'foreign key') !== false) {
             echo "<script>
                alert('Gagal menghapus! Mata kuliah ini masih memiliki data nilai. Hapus data nilai terlebih dahulu.');
                window.location.href = 'view_mk.php';
              </script>";
        } else {
             echo "<script>
                alert('Gagal menghapus data: " . addslashes($errorMsg) . "');
                window.location.href = 'view_mk.php';
              </script>";
        }
    }
    
    $stmt->close();
} else {
    // No ID provided
    echo "<script>
            alert('Kode MK tidak valid!');
            window.location.href = 'view_mk.php';
          </script>";
}
?>
