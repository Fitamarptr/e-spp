<?php

require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../Entity/Tagihan.php';
require_once __DIR__ . '/../Config/Database.php';
require_once __DIR__ . '/../Repository/TagihanRepository.php';
require_once __DIR__ . '/../Service/TagihanService.php';

use Service\TagihanServiceImpl;
use Repository\TagihanRepositoryImpl;

$connection = Config\Database::getConnection();
$tagihanRepository = new TagihanRepositoryImpl($connection);
$tagihanService = new TagihanServiceImpl($tagihanRepository);
$tagihanList = $tagihanService->showTagihan();

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
                    <div class="col-lg-10 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <!-- <h6 class="m-0 font-weight-bold text-primary">SPP</h6> -->
                                <a href="addTagihan.php" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Tagihan
                                </a>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">No Tagihan</th>
                                        <th scope="col">NIS</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Nominal</th>
                                        <th scope="col">Golongan</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($tagihanList as $number => $tagihan) { ?>
                                        <tr>
                                            <th scope="row"><?php echo $number + 1 ?></th>
                                            <td><?php echo $tagihan->getTagihan() ?></td>
                                            <td><?php echo $tagihan->getNis() ?></td>
                                            <td><?php echo $tagihan->getSiswa() ?></td>
                                            <td><?php echo $tagihan->getKelas() ?></td>
                                            <td><?php echo $tagihan->getSpp() ?></td>
                                            <td><?php echo $tagihan->getGolongan() ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<?php require '../layouts/footer.php'; ?>