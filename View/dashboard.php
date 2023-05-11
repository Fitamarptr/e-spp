<?php

require_once __DIR__ .  '/../layouts/header.php';
require_once __DIR__ . '/../Entity/Spp.php';
require_once __DIR__ . "/../Config/Database.php";
require_once __DIR__ . '/../Repository/SppRepository.php';
require_once __DIR__ . '/../Service/SppService.php';
require_once __DIR__ . '/../Config/Database.php';


$connection = Config\Database::getConnection();


$query = "SELECT COUNT(*) as total_tagihan FROM tagihan";
$stmt = $connection->query($query);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$total_tagihan = $result['total_tagihan'];

// mengambil jumlah siswa
$query = "SELECT COUNT(*) as total_siswa FROM siswa";
$stmt = $connection->query($query);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$total_siswa = $result['total_siswa'];
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
                        <h1 class="h3 mb-0 text-gray-800">Selamat datang <?php echo $_SESSION['role']; ?></h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <?php if ($_SESSION['role'] == 'admin') { ?>
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Total Tagihan</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-nominal"><?php echo $total_tagihan; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php  if ($_SESSION['role'] == 'staff' || $_SESSION['role'] == 'admin' ) { ?>
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Jumlah Siswa</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="jumlah_siswa"><?php echo $total_siswa; ?></span></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>


        </div>
        <!-- End of Main Content -->

        <?php require '../layouts/footer.php'; ?>


