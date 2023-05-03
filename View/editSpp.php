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

    if (isset($_POST['update'])) {

        $spp = new Spp($_POST['spp']);
        $spp->setBulan($_POST['bulan']);
        $spp->setStatus($_POST['status']);


        $result = $sppService->updateSpp($spp);
        if ($result) {
            echo "Data with ID $id has been updated successfully.";
        } else {
            echo "Failed to update data with ID $id.";
        }
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
                                    <form method="POST" action="">

                                        <div class="form-group">
                                            <label for="bulan">Bulan</label>
                                            <input type="text" name="bulan" value="<?php echo $spp->getBulan(); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="status" class="form-label">Status</label>
                                            <input type="text" name="status" value="<?php echo $spp->getStatus(); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="nominal">Nominal</label>
                                            <input type="number" name="spp" value="<?php echo $spp->getSpp(); ?>">
                                        </div>
                                        <input type="hidden" name="id" value="<?php echo $spp->getId(); ?>">
                                        <button type="submit" class="btn btn-primary" name="update">Update SPP</button>
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
