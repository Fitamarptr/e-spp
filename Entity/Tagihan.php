<?php

Namespace Entity {

    class Tagihan {
        private int $id_tagihan;
        private string $tagihan;
        private int $id_siswa;
        private int $id_spp;
        private int $nis;
        private string $siswa;
        private string $kelas;
        private int $spp;
        private int $golongan;


        public function __construct($tagihan)
        {
            $this->tagihan = $tagihan;
        }


        public function getIdTagihan() {
            return $this->id_tagihan;
        }

        public function setIdTagihan(int $id_tagihan): void
        {
            $this->id_tagihan = $id_tagihan;
        }



        public function getTagihan()
        {
            return $this->tagihan;
        }

        public function setTagihan($tagihan): void
        {
            $this->tagihan = $tagihan;
        }

        public function getIdSiswa() {
            return $this->id_siswa;
        }

        public function setIdSiswa($id_siswa) {
            $this->id_siswa = $id_siswa;
        }

        public function getIdSpp() {
            return $this->id_spp;
        }

        public function setIdSpp($id_spp) {
            $this->id_spp = $id_spp;
        }

        public function getNis(): int
        {
            return $this->nis;
        }

        public function setNis(int $nis): void
        {
            $this->nis = $nis;
        }

        public function getSiswa(): string
        {
            return $this->siswa;
        }

        public function setSiswa(string $siswa): void
        {
            $this->siswa = $siswa;
        }

        public function getKelas(): string
        {
            return $this->kelas;
        }

        public function setKelas(string $kelas): void
        {
            $this->kelas = $kelas;
        }

        public function getSpp(): int
        {
            return $this->spp;
        }

        public function setSpp(int $spp): void
        {
            $this->spp = $spp;
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
