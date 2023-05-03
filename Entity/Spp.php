<?php


namespace Entity {

    class Spp
    {
        private int $id;
        private int $spp;
        private string $bulan;
        private string $status;

        public function __construct(int $spp)
        {
            $this->spp = $spp;
        }

        public function getSpp(): int
        {
            return $this->spp;
        }

        public function setSpp(int $spp): void
        {
            $this->spp = $spp;
        }

        public function getID(): int
        {
            return $this->id;
        }

        public function setID(int $id): void
        {
            $this->id = $id;
        }


        public function getBulan(): string
        {
            return $this->bulan;
        }

        public function setBulan(string $bulan): void
        {
            $this->bulan = $bulan;
        }

        public function getStatus(): string
        {
            return $this->status;
        }

        public function setStatus(string $status): void
        {
            $this->status = $status;
        }




    }
}