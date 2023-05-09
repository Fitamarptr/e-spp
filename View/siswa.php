    <?php


require_once __DIR__ .  '/../layouts/header.php';
require_once __DIR__ . '/../Entity/Siswa.php';
require_once __DIR__ . "/../Config/Database.php";
require_once __DIR__ . '/../Repository/SiswaRepository.php';
require_once __DIR__ . '/../Service/SiswaService.php';

use Service\SiswaServiceImpl;
use Repository\SiswaRepositoryImpl;
use Entity\Siswa;


$connection = Config\Database::getConnection();
$siswaRepository = new SiswaRepositoryImpl($connection);

$siswaService = new SiswaServiceImpl($siswaRepository);
$siswaList = $siswaService->showSiswa();



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
                    <h1 class="h3 mb-0 text-gray-800">Siswa</h1>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="col-lg-10 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <!-- <h6 class="m-0 font-weight-bold text-primary">SPP</h6> -->
                                <a href="addSiswa.php" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Siswa
                                </a>
                                <form method="GET" class="float-right">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Cari Siswa" name="keyword" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search"></i> Cari
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Siswa</th>
                                        <th>NIS</th>
                                        <th>Kelas</th>
                                        <th>Golongan</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($siswaList as $number => $siswa) {
                                        if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
                                            $keyword = strtolower($_GET['keyword']);
                                            $found = false;
                                            if (stripos(strtolower($siswa->getId()), $keyword) !== false ||
                                                stripos(strtolower($siswa->getSiswa()), $keyword) !== false ||
                                                stripos(strtolower($siswa->getNis()), $keyword) !== false ||
                                                stripos(strtolower($siswa->getKelas()), $keyword) !== false ||
                                                stripos(strtolower($siswa->getGolongan()), $keyword) !== false) {
                                                $found = true;
                                            }
                                            if (!$found) {
                                                continue;
                                            }
                                        } ?>
                                        <tr>
                                            <td><?php echo $number += 1 ?></td>
                                            <td><?php echo $siswa->getSiswa() ?></td>
                                            <td><?php echo $siswa->getNis() ?></td>
                                            <td><?php echo $siswa->getKelas() ?></td>
                                            <td><?php echo $siswa->getGolongan() ?></td>
                                            <td>
                                                <form method="POST" action="removeSiswa.php">
                                                    <button class="btn btn-danger" name ="delete"><i class="fas fa-trash"></i> Hapus</button>
                                                    <input type="hidden" name="id" value="<?php echo $siswa->getId(); ?>">
                                                </form>
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