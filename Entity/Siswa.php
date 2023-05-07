<?php

Namespace Entity {

    class Siswa
    {
        private int $id;
        private string $siswa;
        private int $nis;
        private string $kelas;
        private int $golongan;
        private int $id_spp;


        public function __construct(string $siswa)
        {
            $this->siswa = $siswa;
        }

        public function getId(): int
        {
            return $this->id;
        }

        public function setId(int $id): void
        {
            $this->id = $id;
        }

        public function getSiswa(): string
        {
            return $this->siswa;
        }

        public function setSiswa(string $siswa): void
        {
            $this->siswa = $siswa;
        }

        public function getNis(): int
        {
            return $this->nis;
        }

        public function setNis(int $nis): void
        {
            $this->nis = $nis;
        }

        public function getKelas() {
            return $this->kelas;
        }

        public function setKelas($kelas) {
            $this->kelas = $kelas;
        }

        public function getGolongan(): int
        {
            return $this->golongan;
        }

        public function setGolongan(int $golongan): void
        {
            $this->golongan = $golongan;
        }

        public function getIdSpp(): int
        {
            return $this->id_spp;
        }

        public function setIdSpp(int $id_spp): void
        {
            $this->id_spp = $id_spp;
        }





    }

}