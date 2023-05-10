<?php



require __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../Entity/Spp.php';
require_once __DIR__ . "/../Config/Database.php";
require_once __DIR__ . '/../Repository/SppRepository.php';
require_once __DIR__ . '/../Service/SppService.php';


use Service\SppServiceImpl;
use Repository\SppRepositoryImpl;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tahun = $_POST['tahun'];
    $golongan = $_POST['golongan'];

    $connection = Config\Database::getConnection();
    $sppRepository = new SppRepositoryImpl($connection);
    $sppService = new SppServiceImpl($sppRepository);

    switch ($golongan) {
        case "1":
            $nominal = 150000;
            break;
        case "2":
            $nominal = 250000;
            break;
        case "3":
            $nominal = 350000;
            break;
        case "4":
            $nominal = 450000;
            break;
        default:
            $nominal = $_POST['nominal'];
    }

    $sppService->addSpp($nominal, $tahun, $golongan);
    echo '<div class="alert alert-success" role="alert">Berhasil Menambah!</div>';
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
                                <h6 class="m-0 font-weight-bold text-primary">Tambah Data Spp</h6>
                            </div>
                            <div class=" card-header py-3 d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="spp.php" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label for="tahun" class="form-label">Tahun</label>
                                        <select name="tahun" id="tahun" class="form-control">
                                            <option value="2019/2020">2019/2020</option>
                                            <option value="2020/2021">2020/2021</option>
                                            <option value="2021/2022">2021/2022</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="golongan">Golongan</label>
                                        <select name="golongan" id="golongan" class="form-control">
                                            <option value="1">Golongan 1</option>
                                            <option value="2">Golongan 2</option>
                                            <option value="3">Golongan 3</option>
                                            <option value="4">Golongan 4</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nominal">Nominal</label>
                                        <input type="number" class="form-control" name="nominal">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="tambah_spp">Tambah SPP</button>
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