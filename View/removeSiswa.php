<?php


require __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../Entity/Siswa.php';
require_once __DIR__ . "/../Config/Database.php";
require_once __DIR__ . '/../Repository/SiswaRepository.php';
require_once __DIR__ . '/../Service/SiswaService.php';


use Service\SiswaServiceImpl;
use Repository\SiswaRepositoryImpl;



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connection = Config\Database::getConnection();
    $id = $_POST['id'];
    $siswaRepository = new SiswaRepositoryImpl($connection);
    $siswaService = new SiswaServiceImpl($siswaRepository);
    $success = $siswaService->removeSiswa($id);
    if ($success) {
        // Jika berhasil dihapus
        header("Location: siswa.php"); // Redirect ke halaman awal
        exit();
    } else {
        // Jika gagal dihapus
        echo "Gagal menghapus data";
    }
}
