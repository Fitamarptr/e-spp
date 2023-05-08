<?php

require __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../Entity/Tagihan.php';
require_once __DIR__ . "/../Config/Database.php";
require_once __DIR__ . '/../Repository/TagihanRepository.php';
require_once __DIR__ . '/../Service/TagihanService.php';

use Service\TagihanServiceImpl;
use Repository\TagihanRepositoryImpl;
use Entity\Tagihan;

if(isset($_POST['tambah_tagihan'])) {
    $id_siswa = $_POST['id_siswa'];
    $id_spp = $_POST['id_spp'];
    $tagihan = generateRandomString(); // generate random string for tagihan

    $connection = Config\Database::getConnection();
    $tagihanRepository = new TagihanRepositoryImpl($connection);
    $tagihanService = new TagihanServiceImpl($tagihanRepository);

    $tagihanService->addTagihan($tagihan, $id_siswa, $id_spp); // add tagihan to database

    echo '<div class="alert alert-success" role="alert">Berhasil Menambah!</div>';
}

function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>


    </head>

    <body id="page-top">

    <!-- Page Wrapper -->
<div id="wrapper">

<?php require '../layouts/sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <?php require '../layouts/navbar.php'; ?>


            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Tagihan</h1>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Tambah Data Tagihan</h6>
                            </div>
                            <div class=" card-header py-3 d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="siswa.php" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label for="bulan">Id Siswa</label>
                                        <input type="text" class="form-control" name="id_siswa" id="id_siswa">
                                    </div>
                                    <div class="form-group">
                                        <label for="id_spp">Id Spp</label>
                                        <input type="number" class="form-control" name="id_spp" id="id_spp">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="tambah_tagihan">Tambah Tagihan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<?php require '../layouts/footer.php'; ?>