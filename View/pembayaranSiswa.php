<?php

session_start();
require_once __DIR__ . '/../Entity/Tagihan.php';
require_once __DIR__ . '/../Config/Database.php';
require_once __DIR__ . '/../Repository/TagihanRepository.php';
require_once __DIR__ . '/../Service/TagihanService.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
}



use Service\TagihanServiceImpl;
use Repository\TagihanRepositoryImpl;



$connection = Config\Database::getConnection();
$tagihanRepository = new TagihanRepositoryImpl($connection);
$tagihanService = new TagihanServiceImpl($tagihanRepository);
$tagihanList = $tagihanService->showTagihan();

if (isset($_POST['submit_bayar'])) {
    $idTagihan = $_POST['tagihan'];
    $tagihanService->bayarTagihan($idTagihan);
    echo '<div class="alert alert-success" role="alert">Berhasil Membayar!</div>';
}






?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>E-SPP - <?php echo $_SESSION['user']['role']; ?></title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../assets/css/styles.css" rel="stylesheet" />
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-light bg-light static-top">
    <div class="container">
        <a class="navbar-brand" href="pembayaranSiswa.php">E-SPP</a>
        <a class="btn btn-primary" href="../logout.php">Logout</a>
    </div>
</nav>
<!-- Masthead-->
<header class="masthead">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-xl-7">
                <div class="text-center text-white">
                    <!-- Page heading-->
                    <h1 class="mb-5">Selamat Datang di E-SPP!</h1>
                    <form method="POST" action="">
                        <div class="row">
                            <div class="col">
                                <input class="form-control form-control-lg" id="tagihan" type="tagihan" name="tagihan" placeholder="Masukkan No Tagihan di sini" data-sb-validations="required,email" />
                                <div class="invalid-feedback text-white" data-sb-feedback="nis:required">Membutuhkan Data NIS.</div>
                                <div class="invalid-feedback text-white" data-sb-feedback="nis:nis">NIS tidak ditemukan.</div>
                            </div>
                            <div class="col-auto"><button class="btn btn-primary btn-lg" name="submit" type="submit">Cari</button></div>
                        </div>
                    </form>
                    <?php if (isset($_POST['submit'])) {
                        $noTagihan = $_POST['tagihan'];
                        $tagihan = $tagihanService->showTagihanByNoTagihan($noTagihan);
                        if ($tagihan) { ?>
                            <h2>Data Tagihan</h2>
                            <p>No Tagihan: <?php echo $tagihan->getTagihan() ?></p>
                            <p>Tahun: <?php echo $tagihan->getTahun() ?></p>
                            <p>NIS: <?php echo $tagihan->getNis() ?></p>
                            <p>Siswa: <?php echo $tagihan->getSiswa() ?></p>
                            <p>Kelas: <?php echo $tagihan->getKelas() ?></p>
                            <p>SPP: <?php echo $tagihan->getSpp() ?></p>
                            <p>Golongan: <?php echo $tagihan->getGolongan() ?></p>
                            <?php if ($tagihan->getStatus() == "Tidak Terbayar") { ?>
                                <form method="POST" action="">
                                    <input type="hidden" name="tagihan" value="<?php echo $tagihan->getIdTagihan() ?>">
                                    <button class="btn btn-primary btn-lg" name="submit_bayar" type="submit">Bayar Tagihan</button>
                                </form>
                            <?php } ?>
                        <?php } else { ?>
                            <p>Tagihan tidak ditemukan.</p>
                        <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Footer-->
<footer class="footer bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-100 h-100 text-lg-start my-auto">
                <p class="text-muted text-center small mb-4 mb-lg-0">&copy; E-SPP 2023. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="../assets/js/script.js"></script>
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<!-- * *                               SB Forms JS                               * *-->
<!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
</html>
