<?php


require __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../Entity/Tagihan.php';
require_once __DIR__ . "/../Config/Database.php";
require_once __DIR__ . '/../Repository/TagihanRepository.php';
require_once __DIR__ . '/../Service/TagihanService.php';


use Service\SiswaServiceImpl;
use Repository\SiswaRepositoryImpl;



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connection = Config\Database::getConnection();
    $id = $_POST['id'];
    $tagihanRepository = new \Repository\TagihanRepositoryImpl($connection);
    $tagihanService = new \Service\TagihanServiceImpl($tagihanRepository);
    $success = $tagihanService->removeTagihan($id);
    if ($success) {
        // Jika berhasil dihapus
        header("Location: tagihan.php"); // Redirect ke halaman awal
        exit();
    } else {
        // Jika gagal dihapus
        echo "Gagal menghapus data";
    }
}
