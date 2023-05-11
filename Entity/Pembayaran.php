<?php

Namespace Entity {

    class Pembayaran
    {
        private int $idPembayaran;
        private Siswa $siswa;
        private Spp $spp;
        private string $tanggalBayar;
        private int $jumlahBayar;

        public function __construct(int $idPembayaran, Siswa $siswa, Spp $spp, string $tanggalBayar, int $jumlahBayar)
        {
            $this->idPembayaran = $idPembayaran;
            $this->siswa = $siswa;
            $this->spp = $spp;
            $this->tanggalBayar = $tanggalBayar;
            $this->jumlahBayar = $jumlahBayar;
        }

        public function getIdPembayaran(): int
        {
            return $this->idPembayaran;
        }

        public function getSiswa(): Siswa
        {
            return $this->siswa;
        }

        public function getSpp(): Spp
        {
            return $this->spp;
        }

        public function getTanggalBayar(): string
        {
            return $this->tanggalBayar;
        }

        public function getJumlahBayar(): int
        {
            return $this->jumlahBayar;
        }

        public function setSiswa(Siswa $siswa): void
        {
            $this->siswa = $siswa;
        }

        public function setSpp(Spp $spp): void
        {
            $this->spp = $spp;
        }

        public function setTanggalBayar(string $tanggalBayar): void
        {
            $this->tanggalBayar = $tanggalBayar;
        }

        public function setJumlahBayar(int $jumlahBayar): void
        {
            $this->jumlahBayar = $jumlahBayar;
        }
    }
}
