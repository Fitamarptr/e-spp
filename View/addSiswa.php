<?php



require __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../Entity/Spp.php';
require_once __DIR__ . "/../Config/Database.php";
require_once __DIR__ . '/../Repository/SiswaRepository.php';
require_once __DIR__ . '/../Service/SiswaService.php';





use Service\SiswaServiceImpl;
use Repository\SiswaRepositoryImpl;

if(isset($_POST['tambah_siswa'])) {
    $siswa = $_POST['siswa'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    $id_spp = $_POST['id_spp'];



    $connection = Config\Database::getConnection();
    $siswaRepository = new SiswaRepositoryImpl($connection);

    $siswaService = new SiswaServiceImpl($siswaRepository);
    $siswaService->addSiswa($siswa, $nis, $kelas, $id_spp);

    echo '<div class="alert alert-success" role="alert">Berhasil Menambah!</div>';
//    header("Location: spp.php");
//    exit();
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
                    <h1 class="h3 mb-0 text-gray-800">Siswa</h1>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Tambah Data Siswa</h6>
                            </div>
                            <div class=" card-header py-3 d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="siswa.php" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label for="bulan">Nama Siswa</label>
                                        <input type="text" class="form-control" name="siswa" id="siswa">
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun" class="form-label">NIS</label>
                                        <input type="number" name="nis" id="nis" max="9999999999" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nominal">Kelas</label>
                                        <input type="text" class="form-control" name="kelas">
                                    </div>
                                    <div class="form-group">
                                        <label for="id_spp">Id Spp</label>
                                        <input type="number" class="form-control" name="id_spp" id="id_spp">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="tambah_siswa">Tambah Siswa</button>
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