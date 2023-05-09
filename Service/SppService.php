<?php

namespace Service {

    use Entity\Spp;
    use Repository\SppRepository;

    interface SppService
    {
        function showSpp(): array;
        function addSpp(int $spp, string $bulan, int $tahun, int $golongan): void;
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

            return $sppList;
        }

        public function addSpp(int $spp, string $bulan, int $tahun, int $golongan): void
        {
            $newSpp = new Spp($spp);
            $newSpp->setBulan($bulan);
            $newSpp->setTahun($tahun);
            $newSpp->setGolongan($golongan);
            $this->sppRepository->save($newSpp);
        }

        public function removeSpp(int $number): bool
        {
            return $this->sppRepository->remove($number);
        }

        public function sortSppByNominalDesc(): array
        {
            $sppList = $this->sppRepository->findAll();
            usort($sppList, function ($a, $b) {
                return $b->getSpp() <=> $a->getSpp();
            });

            return $sppList;
        }

        public function updateSpp(int $id, int $spp, string $bulan, int $tahun, int $golongan): bool
        {
            $sppToUpdate = $this->sppRepository->findById($id);

            if ($sppToUpdate == null) {
                return false;
            }

            $sppToUpdate->setSpp($spp);
            $sppToUpdate->setBulan($bulan);
            $sppToUpdate->setTahun($tahun);
            $sppToUpdate->setGolongan($golongan);

            $this->sppRepository->update($sppToUpdate);

            return true;
        }




    }
}