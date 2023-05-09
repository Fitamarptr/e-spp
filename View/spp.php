<?php


require_once __DIR__ .  '/../layouts/header.php';
require_once __DIR__ . '/../Entity/Spp.php';
require_once __DIR__ . "/../Config/Database.php";
require_once __DIR__ . '/../Repository/SppRepository.php';
require_once __DIR__ . '/../Service/SppService.php';

use Service\SppServiceImpl;
use Repository\SppRepositoryImpl;
use Entity\Spp;


$connection = Config\Database::getConnection();
$sppRepository = new SppRepositoryImpl($connection);

$sppService = new SppServiceImpl($sppRepository);
$sppList = $sppService->showSpp();


//if (isset($_POST['delete'])) {
//    $id = $_POST['id'];
//    $result = $sppService->removeSpp($id);
//    if ($result) {
//        echo "Data with ID $id has been deleted successfully.";
//    } else {
//        echo "Failed to delete data with ID $id.";
//    }
//}
//
//if (isset($_GET['id'])) {
//    $id = $_GET['id'];
//}



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
                    <h1 class="h3 mb-0 text-gray-800">SPP</h1>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="col-lg-10 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <!-- <h6 class="m-0 font-weight-bold text-primary">SPP</h6> -->
                                <a href="addSpp.php" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah SPP
                                </a>
                                <form method="GET" class="float-right">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Cari SPP" name="keyword" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
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
                                        <th>Nominal</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Golongan</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($sppList as $number => $spp) {
                                        if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
                                            $keyword = strtolower($_GET['keyword']);
                                            $found = false;
                                            if (stripos(strtolower($spp->getId()), $keyword) !== false ||
                                                stripos(strtolower($spp->getSpp()), $keyword) !== false ||
                                                stripos(strtolower($spp->getBulan()), $keyword) !== false ||
                                                stripos(strtolower($spp->getTahun()), $keyword) !== false ||
                                                stripos(strtolower($spp->getGolongan()), $keyword) !== false) {
                                                $found = true;
                                            }
                                            if (!$found) {
                                                continue;
                                            }
                                        } ?>
                                        <tr>
                                            <td><?php echo $number + 1 ?></td>
                                            <td><?php echo $spp->getSpp() ?></td>
                                            <td><?php echo $spp->getBulan() ?></td>
                                            <td><?php echo $spp->getTahun() ?></td>
                                            <td><?php echo $spp->getGolongan() ?></td>
                                            <td>
                                                <form method="POST" action="removeSpp.php" style="display: inline-block">
                                                    <button class="btn btn-danger" name ="delete" onclick="return confirm('Anda yakin akan menghapus data siswa ini?')"><i class="fas fa-trash"></i> Hapus</button>
                                                    <input type="hidden" name="id" value="<?php echo $spp->getId(); ?>">
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