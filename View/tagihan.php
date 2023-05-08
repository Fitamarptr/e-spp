<?php

require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../Entity/Siswa.php';
require_once __DIR__ . '/../Entity/Tagihan.php';
require_once __DIR__ . "/../Config/Database.php";
require_once __DIR__ . '/../Repository/SiswaRepository.php';
require_once __DIR__ . '/../Repository/TagihanRepository.php';
require_once __DIR__ . '/../Service/SiswaService.php';
require_once __DIR__ . '/../Service/TagihanService.php';

use Service\SiswaServiceImpl;
use Service\TagihanServiceImpl;
use Repository\SiswaRepositoryImpl;
use Repository\TagihanRepositoryImpl;
use Entity\Siswa;
use Entity\Tagihan;

$connection = Config\Database::getConnection();
$siswaRepository = new SiswaRepositoryImpl($connection);
$tagihanRepository = new TagihanRepositoryImpl($connection);

$siswaService = new SiswaServiceImpl($siswaRepository);
$tagihanService = new TagihanServiceImpl($tagihanRepository);

$siswaList = $siswaService->showSiswa();
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
                                        <th scope="col">NISN</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Bulan</th>
                                        <th scope="col">Nominal</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($tagihanList as $key => $tagihan) { ?>
                                        <tr>
                                            <th scope="row"><?php echo $key + 1 ?></th>
                                            <td><?php echo $tagihan->getSiswa()->getNisn() ?></td>
                                            <td><?php echo $tagihan->getSiswa()->getNama() ?></td>
                                            <td><?php echo $tagihan->getSiswa()->getKelas() ?></td>
                                            <td><?php echo $tagihan->getBulan() ?></td>
                                            <td><?php echo $tagihan->getNominal() ?></td>
                                            <td>
                                                <a href="editTagihan.php?id=<?php echo $tagihan->getId() ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="../Process/deleteTagihanProcess.php?id=<?php echo $tagihan->getId() ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus tagihan ini?');">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </td>
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