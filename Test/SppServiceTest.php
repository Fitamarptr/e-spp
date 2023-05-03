<?php

require_once __DIR__ . "/../Entity/Spp.php";
require_once __DIR__ . "/../Repository/SppRepository.php";
require_once __DIR__ . "/../Service/SppService.php";
require_once __DIR__ . "/../Service/SppService.php";
require_once __DIR__ . "/../Config/Database.php";


use Entity\Spp;
use Service\SppServiceImpl;
use Repository\SppRepositoryImpl;

function testShowSpp(): void
{
    $connection = Config\Database::getConnection();
    $sppRepository = new SppRepositoryImpl($connection);

    $sppService = new SppServiceImpl($sppRepository);
    $sppService->showSpp();

    $sppList = $sppService->showSpp();

}

function testAddSpp(): void
{
    $connection = Config\Database::getConnection();
    $sppRepository = new SppRepositoryImpl($connection);

    $sppService = new SppServiceImpl($sppRepository);
    $sppService->addSpp(150000, "Januari", "Terbayar");
    $sppService->addSpp(130000, "Febuari", "Terbayar");
    $sppService->addSpp(120000, "Januari", "Tidak Terbayar");

    $sppService->showSpp();
}

function testRemoveSpp(): void
{
    $connection = Config\Database::getConnection();
    $sppRepository = new SppRepositoryImpl($connection);

    $sppService = new SppServiceImpl($sppRepository);
//    $sppService->addSpp(150000, "Januari", "Terbayar");
//    $sppService->addSpp(130000, "Febuari", "Terbayar");
//    $sppService->addSpp(120000, "Januari", "Tidak Terbayar");

    $sppService->showSpp();

    $sppService->removeSpp(2);
    $sppService->showSpp();

//    $sppService->removeSpp(4);
//    $sppService->showSpp();
//
//    $sppService->removeSpp(2);
//    $sppService->showSpp();

//    $sppService->removeSpp(2);
//    $sppService->showSpp();
}

testShowSpp();