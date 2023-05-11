<?php


require_once __DIR__ . "/../Entity/Spp.php";
require_once __DIR__ . "/../Entity/Siswa.php";
require_once __DIR__ . "/../Repository/SppRepository.php";
require_once __DIR__ . "/../Repository/SiswaRepository.php";
require_once __DIR__ . "/../Service/SppService.php";
require_once __DIR__ . "/../Service/SiswaService.php";
require_once __DIR__ . "/../Config/Database.php";

use Entity\Spp;
use Entity\Siswa;
use Service\SppServiceImpl;
use Service\SiswaServiceImpl;
use Repository\SppRepositoryImpl;
use Repository\SiswaRepositoryImpl;

function testAddSiswa(): void
{
    $connection = Config\Database::getConnection();
    $sppRepository = new SppRepositoryImpl($connection);
    $siswaRepository = new SiswaRepositoryImpl($connection);

    $sppService = new SppServiceImpl($sppRepository);
    $siswaService = new SiswaServiceImpl($siswaRepository, $sppService);

    $nama_siswa = 'John Doe';
    $nomor_induk = '123456';
    $kelas = 'XII-1';
    $id_spp = 1;

    // Simulate add siswa
   $siswaService->addSiswa($nama_siswa, $nomor_induk, $kelas, $id_spp);

}

testAddSiswa();

