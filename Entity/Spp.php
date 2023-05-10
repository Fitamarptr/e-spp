<?php


namespace Entity {

    class Spp
    {
        private int $Id;
        private int $spp;
        private string $tahun;
        private int $golongan;


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

        public function getTahun(): string
        {
            return $this->tahun;
        }

        public function setTahun(string $tahun): void
        {
            $this->tahun = $tahun;
        }

        public function getGolongan(): int
        {
            return $this->golongan;
        }

        public function setGolongan(int $golongan): void
        {
            $this->golongan = $golongan;
        }







    }
}