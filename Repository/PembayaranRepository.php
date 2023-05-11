<?php

Namespace Repository {
    use Entity\Pembayaran;
    use PDO;

    interface PembayaranRepository
    {
        public function findById(int $id): ?Pembayaran;
        public function save(Pembayaran $pembayaran): void;
        public function update(Pembayaran $pembayaran): void;
        public function delete(Pembayaran $pembayaran): void;
        public function findAll(): array;
    }

    class PembayaranRepositoryImpl implements PembayaranRepository {
        private PDO $connection;

        public function __construct(PDO $connection)
        {
            $this->connection = $connection;
        }

        public function findById(int $id): ?Pembayaran
        {
            $query = "SELECT pembayaran.*, siswa.siswa, siswa.nis, siswa.kelas, spp.spp, spp.golongan
                  FROM pembayaran
                  INNER JOIN siswa ON pembayaran.id_siswa = siswa.id_siswa
                  INNER JOIN spp ON pembayaran.id_spp = spp.id_spp
                  WHERE pembayaran.id_pembayaran = :id";
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                return null;
            }

            $pembayaran = new Pembayaran();
            $pembayaran->setIdPembayaran($result['id_pembayaran']);
            $pembayaran->setIdSiswa($result['id_siswa']);
            $pembayaran->setIdSpp($result['id_spp']);
            $pembayaran->setTanggalBayar(new DateTime($result['tanggal_bayar']));
            $pembayaran->setJumlahBayar($result['jumlah_bayar']);
            $pembayaran->setSiswa($result['siswa']);
            $pembayaran->setNis($result['nis']);
            $pembayaran->setKelas($result['kelas']);
            $pembayaran->setSpp($result['spp']);
            $pembayaran->setGolongan($result['golongan']);

            return $pembayaran;
        }

        public function save(Pembayaran $pembayaran): void
        {
            $query = "INSERT INTO pembayaran (id_siswa, id_spp, tanggal_bayar, jumlah_bayar)
                  VALUES (:id_siswa, :id_spp, :tanggal_bayar, :jumlah_bayar)";
            $statement = $this->connection->prepare($query);
            $statement->bindValue(':id_siswa', $pembayaran->getIdSiswa());
            $statement->bindValue(':id_spp', $pembayaran->getIdSpp());
            $statement->bindValue(':tanggal_bayar', $pembayaran->getTanggalBayar()->format('Y-m-d'));
            $statement->bindValue(':jumlah_bayar', $pembayaran->getJumlahBayar());
            $statement->execute();

            $pembayaran->setIdPembayaran($this->connection->lastInsertId());
        }

        public function update(Pembayaran $pembayaran): void
        {
            $query = "UPDATE pembayaran
                  SET id_siswa = :id_siswa, id_spp = :id_spp, tanggal_bayar = :tanggal_bayar, jumlah_bayar = :jumlah_bayar
                  WHERE id_pembayaran = :id_pembayaran";
            $statement = $this->connection->prepare($query);
            $statement->bindValue(':id_siswa', $pembayaran->getIdSiswa());
            $statement->bindValue(':id_spp', $pembayaran->getIdSpp());
            $statement->bindValue(':tanggal_bayar', $pembayaran->getTanggalBayar()->format('Y-m-d'));
            $statement->bindValue(':jumlah_bayar', $pembayaran->getJumlahBayar());
            $statement->bindValue(':id_pembayaran', $pembayaran->getIdPembayaran());
            $statement->execute();
        }

        public function delete(Pembayaran $pembayaran): void
        {
            $query = "DELETE FROM pembayaran WHERE id_pembayaran = :id_pembayaran";
            $statement = $this->connection->prepare($query);
            $statement->bindValue(':id_pembayaran', $pembayaran->getIdPembayaran());
            $statement->execute();
        }

        public function findAll(): array
        {
            $query = "SELECT pembayaran.*, siswa.siswa, siswa.nis, siswa.kelas, spp.spp, spp.golongan
                  FROM pembayaran
                  INNER JOIN siswa ON pembayaran.id_siswa = siswa.id_siswa
                  INNER JOIN spp ON pembayaran.id_spp = spp.id_spp";
            $statement = $this->connection->prepare($query);
            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $pembayaranArray = array();

            foreach ($result as $row) {
                $pembayaran = new Pembayaran();
                $pembayaran->setIdPembayaran($row['id_pembayaran']);
                $pembayaran->setIdSiswa($row['id_siswa']);
                $pembayaran->setIdSpp($row['id_spp']);
                $pembayaran->setTanggalBayar(new DateTime($row['tanggal_bayar']));
                $pembayaran->setJumlahBayar($row['jumlah_bayar']);
                $pembayaran->setSiswa($row['siswa']);
                $pembayaran->setNis($row['nis']);
                $pembayaran->setKelas($row['kelas']);
                $pembayaran->setSpp($row['spp']);
                $pembayaran->setGolongan($row['golongan']);

                $pembayaranArray[] = $pembayaran;
            }

            return $pembayaranArray;
        }
    }
}