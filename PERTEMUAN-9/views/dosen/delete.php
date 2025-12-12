<?php
/**
 * Script Hapus Data Dosen
 * Menggunakan arsitektur MVC.
 */

require_once '../../controllers/DosenController.php';

$controller = new DosenController();

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
    setFlash('error', 'NIDN tidak valid!');
    header('Location: index.php');
    exit;
}
?>
