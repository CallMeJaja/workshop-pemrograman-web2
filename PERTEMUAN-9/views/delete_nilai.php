<?php
/**
 * Delete Data Nilai
 * Script untuk menghapus data nilai dari tbl_nilai
 */

require_once '../config/database.php';

// Get ID from URL
$id = isset($_GET['id']) ? $_GET['id'] : '';

if (!empty($id)) {
    $conn = getConnection();
    
    // Prepare Delete Statement
    $query = "DELETE FROM tbl_nilai WHERE id_nilai = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Success
        echo "<script>
                alert('Data nilai berhasil dihapus!');
                window.location.href = 'view_nilai.php';
              </script>";
    } else {
        // Failure
         echo "<script>
            alert('Gagal menghapus data: " . addslashes($conn->error) . "');
            window.location.href = 'view_nilai.php';
          </script>";
    }
    
    $stmt->close();
} else {
    // No ID provided
    echo "<script>
            alert('ID tidak valid!');
            window.location.href = 'view_nilai.php';
          </script>";
}
?>
