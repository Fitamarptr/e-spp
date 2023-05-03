<?php

namespace Service {

    use Entity\Spp;
    use Repository\SppRepository;

    interface SppService
    {
        function showSpp(): array;
        function addSpp(int $spp, string $bulan, string $status): void;
        function removeSpp(int $number): bool;


    }

    class SppServiceImpl implements SppService
    {
        private SppRepository $sppRepository;

        public function __construct(SppRepository $sppRepository)
        {
            $this->sppRepository = $sppRepository;
        }

        public function showSpp(): array
        {
            $sppList = $this->sppRepository->findAll();
           // foreach ($sppList as $number => $spp) {
           //     $number += 1;
            //    echo "$number. " . $spp->getSpp() . ", " . $spp->getBulan() . ", " . $spp->getStatus() . PHP_EOL;
           // }

            return $sppList;
        }

        public function addSpp(int $spp, string $bulan, string $status): void
        {
            $newSpp = new Spp($spp);
            $newSpp->setBulan($bulan);
            $newSpp->setStatus($status);
            $this->sppRepository->save($newSpp);
        }

        public function removeSpp(int $number): bool
        {
            return $this->sppRepository->remove($number);
        }

        public function updateSpp(array $data): bool
        {
            $spp = new Spp($data['spp']);
            $spp->setID($data['id']);
            $spp->setBulan($data['bulan']);
            $spp->setStatus($data['status']);
            return $this->sppRepository->updateSpp($spp);
        }


//        public function findSppById(int $id): ?array
//        {
//            $spp = $this->sppRepository->findById($id);
//
//            if (!$spp) {
//                return null;
//            }
//
//            return [
//                'id_spp' => $spp->getId(),
//                'spp' => $spp->getSpp(),
//                'bulan' => $spp->getBulan(),
//                'status' => $spp->getStatus(),
//            ];
//        }




//        public function getSppById(int $id): ?Spp
//        {
//            return $this->sppRepository->findById($id);
//        }
//
//
//        public function updateSpp(int $id, string $spp, string $bulan, string $status): void
//        {
//            $existingSpp = $this->sppRepository->findById($id);
//            if ($existingSpp) {
//                $updatedSpp = new Spp($id, $spp, $bulan, $status);
//                $this->sppRepository->update($id, $updatedSpp);
//                echo "SUKSES MENGEDIT Spp" . PHP_EOL;
//            } else {
//                echo "GAGAL MENGEDIT Spp: Spp tidak ditemukan" . PHP_EOL;
//            }
//        }


    }
}
