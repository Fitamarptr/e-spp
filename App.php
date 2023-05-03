<?php

require_once __DIR__ . '/Entity/Spp.php';
require_once __DIR__ . '/Helper/InputHelper.php';
require_once __DIR__ . '/Repository/SppRepository.php';
require_once __DIR__ . '/Service/SppService.php';
require_once __DIR__ . '/View/SppView.php';
require_once __DIR__ . "/Config/Database.php";

use Repository\SppRepositoryImpl;
use Service\SppServiceImpl;
use View\SppView;

echo "Aplikasi E-SPP" . PHP_EOL;

$connection = Config\Database::getConnection();
$sppRepository = new SppRepositoryImpl($connection);
$sppService = new SppServiceImpl($sppRepository);
$sppView = new SppView($sppService);

$sppView->showSpp();


//        function update(int $id, Spp $newSpp): bool
//        {
//
//            $sql = "SELECT id_spp FROM spp WHERE id_spp = ?";
//            $statement = $this->connection->prepare($sql);
//            $statement->execute([$id]);
//
//            if ($statement->fetch()){
//                // Update data di dalam array
//                $this->spp[$id] = $newSpp;
//
//                // Update data di dalam database
//                $sql = "UPDATE spp SET spp = ?, bulan = ?, status = ? WHERE id_spp = ?";
//                $statement = $this->connection->prepare($sql);
//                $statement->execute([$newSpp->getSpp(), $newSpp->getBulan(), $newSpp->getStatus(), $id]);
//
//                return true;
//            } else {
//                // Jika id tidak ditemukan di dalam database
//                return false;
//            }
//        }
//
//        public function findById(int $id): ?Spp
//        {
//            $sql = "SELECT * FROM spp WHERE id_spp = ?";
//            $statement = $this->connection->prepare($sql);
//            $statement->execute([$id]);
//
//            if ($row = $statement->fetch()) {
//                return new Spp($row['id_spp'], $row['spp'], $row['bulan'], $row['status']);
//            }
//
//            return null;
//        }


