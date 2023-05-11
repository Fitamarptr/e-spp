<?php
require __DIR__ . '/../layouts/header.php';
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

// ambil ID SPP dari parameter GET
$id = $_GET['id'];

// ambil data SPP dari repository
$siswa = $siswaService->getSiswaById($id);

// jika form di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ambil data dari form input
    $siswa = $_POST['siswa'];
    $siswaNis = $_POST['nis'];
    $siswaKelas = $_POST['kelas'];
    $siswaTahun = $_POST['tahun'];
    $siswaGolongan = $_POST['golongan'];

    // simpan perubahan data siswa
    $siswaService->updateSiswa($id ,$siswa, $siswaNis, $siswaKelas, $siswaTahun, $siswaGolongan);

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
                                    <h6 class="m-0 font-weight-bold text-primary">Update Data Siswa</h6>
                                </div>
                                <div class=" card-header py-3 d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="siswa.php" class="btn btn-primary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="form-group">
                                            <label>Siswa</label>
                                            <input type="text" class="form-control" name="siswa" value="<?php echo $siswa->getSiswa(); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>NIS:</label>
                                            <input type="text" class="form-control" name="nis" value="<?php echo $siswa->getNis(); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Kelas:</label>
                                            <input type="text" class="form-control" name="kelas" value="<?php echo $siswa->getKelas(); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun Ajaran:</label>
                                            <input type="text" class="form-control" name="tahun" value="<?php echo $siswa->getTahun(); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Golongan:</label>
                                            <input type="text" class="form-control" name="golongan" value="<?php echo $siswa->getGolongan(); ?>">
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
