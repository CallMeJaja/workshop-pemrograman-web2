<?php
/**
 * Script Hapus Data Mahasiswa
 * Menggunakan arsitektur MVC.
 */

require_once '../../controllers/MahasiswaController.php';

$controller = new MahasiswaController();

// Cek parameter ID
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $result = $controller->destroy($id);
    
    if ($result['success']) {
        setFlash('success', $result['message']);
    } else {
        setFlash('error', implode('<br>', $result['errors']));
    }
    
    header('Location: index.php');
    exit;
} else {
    setFlash('error', 'NIM tidak valid!');
    header('Location: index.php');
    exit;
}
?>
