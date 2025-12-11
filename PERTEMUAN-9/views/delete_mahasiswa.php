<?php
/**
 * Delete Mahasiswa
 * Script untuk menghapus data mahasiswa dari tbl_mahasiswa
 */

require_once '../config/database.php';

// Get ID from URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $nim = $_GET['id'];
    $conn = getConnection();

    // Prepare Delete Statement
    $query = "DELETE FROM tbl_mahasiswa WHERE nim = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nim);

    if ($stmt->execute()) {
        // Success
        echo "<script>
                alert('Data mahasiswa berhasil dihapus!');
                window.location.href = 'view_mahasiswa.php';
              </script>";
    } else {
        // Failure
        $errorMsg = $conn->error;
        if (strpos($errorMsg, 'Constraint') !== false || strpos($errorMsg, 'foreign key') !== false) {
             echo "<script>
                alert('Gagal menghapus! Data mahasiswa ini masih memiliki nilai. Hapus data nilai terlebih dahulu.');
                window.location.href = 'view_mahasiswa.php';
              </script>";
        } else {
             echo "<script>
                alert('Gagal menghapus data: " . addslashes($errorMsg) . "');
                window.location.href = 'view_mahasiswa.php';
              </script>";
        }
    }
    
    $stmt->close();
} else {
    // No ID provided
    echo "<script>
            alert('ID tidak valid!');
            window.location.href = 'view_mahasiswa.php';
          </script>";
}
?>
