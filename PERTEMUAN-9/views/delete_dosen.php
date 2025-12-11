<?php
/**
 * Delete Dosen
 * Script untuk menghapus data dosen dari tbl_dosen
 */

require_once '../config/database.php';

// Get ID from URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $nidn = $_GET['id'];
    $conn = getConnection();

    // Check availability first (optional but good for UX or ensuring record exists)
    // Note: If enforced FK constraints exist, delete might fail if children exist.
    
    // Prepare Delete Statement
    $query = "DELETE FROM tbl_dosen WHERE nidn = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nidn);

    if ($stmt->execute()) {
        // Success
        echo "<script>
                alert('Data dosen berhasil dihapus!');
                window.location.href = 'view_dosen.php';
              </script>";
    } else {
        // Failure (likely constraint violation)
        $errorMsg = $conn->error;
        // Check for integrity constraint violation
        if (strpos($errorMsg, 'Constraint') !== false || strpos($errorMsg, 'foreign key') !== false) {
             echo "<script>
                alert('Gagal menghapus! Data dosen ini sedang digunakan di tabel lain (Mata Kuliah/Nilai). Hapus data terkait terlebih dahulu.');
                window.location.href = 'view_dosen.php';
              </script>";
        } else {
             echo "<script>
                alert('Gagal menghapus data: " . addslashes($errorMsg) . "');
                window.location.href = 'view_dosen.php';
              </script>";
        }
    }
    
    $stmt->close();
} else {
    // No ID provided
    echo "<script>
            alert('ID tidak valid!');
            window.location.href = 'view_dosen.php';
          </script>";
}
?>
