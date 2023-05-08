<?php

Namespace Entity {

    class Tagihan {
        private $id_tagihan;
        private $tagihan;
        private $id_siswa;
        private $id_spp;


        public function __construct($tagihan)
        {
            $this->tagihan = $tagihan;
        }


        public function getIdTagihan() {
            return $this->id_tagihan;
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
    }

}
