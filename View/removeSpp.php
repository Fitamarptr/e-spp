<?php


require __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../Entity/Spp.php';
require_once __DIR__ . "/../Config/Database.php";
require_once __DIR__ . '/../Repository/SppRepository.php';
require_once __DIR__ . '/../Service/SppService.php';


use Service\SppServiceImpl;
use Repository\SppRepositoryImpl;



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connection = Config\Database::getConnection();
    $id = $_POST['id'];
    $sppRepository = new SppRepositoryImpl($connection);
    $sppService = new SppServiceImpl($sppRepository);
    $success = $sppService->removeSpp($id);
    if ($success) {
        // Jika berhasil dihapus
        header("Location: spp.php"); // Redirect ke halaman awal
        exit();
    } else {
        // Jika gagal dihapus
        echo "Gagal menghapus data";
    }
}
