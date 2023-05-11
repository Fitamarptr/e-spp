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
                    <div class="col-lg-15 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <!-- <h6 class="m-0 font-weight-bold text-primary">SPP</h6> -->
                                <a href="addTagihan.php" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Tagihan
                                </a>
                                <form method="GET" class="float-right">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Cari Tagihan" name="keyword" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
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
                                        <th scope="col">No</th>
                                        <th scope="col">No Tagihan</th>
                                        <th scope="col">Tahun Ajaran</th>
                                        <th scope="col">NIS</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Nominal</th>
                                        <th scope="col">Golongan</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($tagihanList as $number => $tagihan) {
                                        if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
                                            $keyword = strtolower($_GET['keyword']);
                                            $found = false;
                                            if (stripos(strtolower($tagihan->getIdTagihan()), $keyword) !== false ||
                                                stripos(strtolower($tagihan->getTagihan()), $keyword) !== false ||
                                                stripos(strtolower($tagihan->getTahun()), $keyword) !== false ||
                                                stripos(strtolower($tagihan->getNis()), $keyword) !== false ||
                                                stripos(strtolower($tagihan->getSiswa()), $keyword) !== false ||
                                                stripos(strtolower($tagihan->getKelas()), $keyword) !== false ||
                                                stripos(strtolower($tagihan->getSpp()), $keyword) !== false ||
                                                stripos(strtolower($tagihan->getGolongan()), $keyword) !== false ||
                                                stripos(strtolower($tagihan->getStatus()), $keyword) !== false) {
                                                $found = true;
                                            }
                                            if (!$found) {
                                                continue;
                                            }
                                        } ?>
                                        <tr>
                                            <td><?php echo $number + 1 ?></td>
                                            <td><?php echo $tagihan->getTagihan() ?></td>
                                            <td><?php echo $tagihan->getTahun() ?></td>
                                            <td><?php echo $tagihan->getNis() ?></td>
                                            <td><?php echo $tagihan->getSiswa() ?></td>
                                            <td><?php echo $tagihan->getKelas() ?></td>
                                            <td><?php echo $tagihan->getSpp() ?></td>
                                            <td><?php echo $tagihan->getGolongan() ?></td>
                                            <td><?php echo $tagihan->getStatus() ?></td>
                                            <td>
                                                <form method="POST" action="removeTagihan.php" style="display: inline-block">
                                                    <button class="btn btn-danger" name ="delete" onclick="return confirm('Anda yakin akan menghapus data siswa ini?"><i class="fas fa-trash"></i> Hapus</button>
                                                    <input type="hidden" name="id" value="<?php echo $tagihan->getIdTagihan(); ?>">
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