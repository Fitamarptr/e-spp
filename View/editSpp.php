<?php
require __DIR__ . '/../layouts/header.php';
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

// ambil ID SPP dari parameter GET
$id = $_GET['id'];

// ambil data SPP dari repository
$spp = $sppService->getSppById($id);

// jika form di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ambil data dari form
    $sppValue = $_POST['spp'];
    $tahunValue = $_POST['tahun'];
    $golonganValue = $_POST['golongan'];

    // update data SPP
    $sppService->updateSpp($id, $sppValue, $tahunValue, $golonganValue);

    echo '<div class="alert alert-success" role="alert">Berhasil Mengedit!</div>';
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
                        <h1 class="h3 mb-0 text-gray-800">SPP</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Update Data Spp</h6>
                                </div>
                                <div class=" card-header py-3 d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="spp.php" class="btn btn-primary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="form-group">
                                            <label>Nominal:</label>
                                            <input type="text" class="form-control" name="spp" value="<?php echo $spp->getSpp(); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun Ajaran:</label>
                                            <input type="text" class="form-control" name="tahun" value="<?php echo $spp->getTahun(); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Golongan:</label>
                                            <input type="text" class="form-control" name="golongan" value="<?php echo $spp->getGolongan(); ?>">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
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
