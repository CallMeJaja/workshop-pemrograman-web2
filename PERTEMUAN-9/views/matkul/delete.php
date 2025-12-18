<?php
require_once '../../controllers/MatkulController.php';
require_once '../../helpers/auth.php';

// Cek login dan akses - hanya dosen
requireLogin();
requireRole('dosen');

$controller = new MatkulController();

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
    setFlash('error', 'Kode MK tidak valid!');
    header('Location: index.php');
    exit;
}
?>
