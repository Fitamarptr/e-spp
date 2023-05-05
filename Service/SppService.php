<?php

namespace Service {

    use Entity\Spp;
    use Repository\SppRepository;

    interface SppService
    {
        function showSpp(): array;
        function addSpp(int $spp, string $bulan, int $tahun): void;
        function removeSpp(int $number): bool;
//        public function updateSpp(Spp $spp): bool;


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

        public function addSpp(int $spp, string $bulan, int $tahun): void
        {
            $newSpp = new Spp($spp);
            $newSpp->setBulan($bulan);
            $newSpp->setTahun($tahun);
            $this->sppRepository->save($newSpp);
        }

        public function removeSpp(int $number): bool
        {
            return $this->sppRepository->remove($number);
        }






    }
}