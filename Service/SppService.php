<?php

namespace Service {

    use Entity\Spp;
    use Repository\SppRepository;

    interface SppService
    {
        function showSpp(): array;
        function addSpp(int $spp,string $tahun, int $golongan): void;
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

        public function addSpp(int $spp, string $tahun, int $golongan): void
        {
            $newSpp = new Spp($spp);
            $newSpp->setTahun($tahun);
            $newSpp->setGolongan($golongan);
            $this->sppRepository->save($newSpp);
        }

        public function removeSpp(int $number): bool
        {
            return $this->sppRepository->remove($number);
        }
        public function updateSpp(int $id, string $spp, string $tahun, string $golongan): bool
        {
            $updatedSpp = new Spp($spp);
            $updatedSpp->setId($id);
            $updatedSpp->setTahun($tahun);
            $updatedSpp->setGolongan($golongan);

            return $this->sppRepository->update($updatedSpp);
        }


        public function getSppById(int $id): ?Spp
        {
            $spp = $this->sppRepository->findById($id);
            return $spp;
        }




    }
}