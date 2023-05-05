<?php


namespace Entity {

    class Spp
    {
        private int $Id;
        private int $spp;
        private string $bulan;
        private int $tahun;
        private string $no_tagihan;


        public function __construct(int $spp)
        {
            $this->spp = $spp;
        }

        public function getId(): int
        {
            return $this->Id;
        }


        public function setId(int $Id): void
        {
            $this->Id = $Id;
        }

        public function getSpp(): int
        {
            return $this->spp;
        }

        public function setSpp(int $spp): void
        {
            $this->spp = $spp;
        }


        public function getBulan(): string
        {
            return $this->bulan;
        }

        public function setBulan(string $bulan): void
        {
            $this->bulan = $bulan;
        }

        public function getTahun(): int
        {
            return $this->tahun;
        }

        public function setTahun(int $tahun): void
        {
            $this->tahun = $tahun;
        }

        public function getNoTagihan(): string
        {
            return $this->no_tagihan;
        }

        public function setNoTagihan(string $no_tagihan): void
        {
            $this->no_tagihan = $no_tagihan;
        }





    }
}