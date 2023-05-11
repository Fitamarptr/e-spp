<?php

Namespace Repository {

    use Entity\Tagihan;

    interface TagihanRepository
    {

        public function add(Tagihan $tagihan): void;

        public function findAll(): array;

        public function remove(int $id_tagihan): bool;
    }


    class TagihanRepositoryImpl implements TagihanRepository
    {

        public array $tagihan = array();

        public \PDO  $connection;

        public function __construct(\PDO $connection)
        {
            $this->connection = $connection;
        }


        public function add(Tagihan $tagihan): void
        {

            $this->tagihan[] = $tagihan ;


            $sql = "INSERT INTO tagihan(tagihan, status, id_siswa, id_spp) VALUES (?,?,?,?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$tagihan->getTagihan(),$tagihan->getStatus(), $tagihan->getIdSiswa(), $tagihan->getIdSpp()]);
        }

        public function findAll(): array
        {
                $sql = "SELECT spp.tahun ,t.id_tagihan, t.tagihan, s.nis, s.siswa, s.kelas, spp.spp, spp.golongan, t.status
                FROM tagihan t
                JOIN siswa s ON t.id_siswa = s.id_siswa
                JOIN spp ON t.id_spp = spp.id_spp";
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            $tagihanList = array();
            while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
                $tagihan = new Tagihan($row['tagihan']);
                $tagihan->setIdTagihan($row['id_tagihan']);
                $tagihan->setTahun($row['tahun']);
                $tagihan->setNis($row['nis']);
                $tagihan->setSiswa($row['siswa']);
                $tagihan->setKelas($row['kelas']);
                $tagihan->setSpp($row['spp']);
                $tagihan->setGolongan($row['golongan']);
                $tagihan->setStatus($row['status']);
                $tagihanList[] = $tagihan;
            }

            return $tagihanList;
        }

        public function remove(int $number): bool
        {
            $sql = "SELECT id_tagihan FROM tagihan WHERE id_tagihan = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$number]);

            if ($statement->fetch()) {
                // tagihan ada
                $sql = "DELETE FROM tagihan WHERE id_tagihan = ?";
                $statement = $this->connection->prepare($sql);
                $statement->execute([$number]);
                return $statement->rowCount() > 0;
            } else {
                return false;
            }
            return false;
        }

        public function findTagihanByNoTagihan(string $tagihan): ?Tagihan
        {
            $sql = "SELECT spp.tahun, t.id_tagihan, t.tagihan, s.nis, s.siswa, s.kelas, spp.spp, spp.golongan, t.status
            FROM tagihan t
            JOIN siswa s ON t.id_siswa = s.id_siswa
            JOIN spp ON t.id_spp = spp.id_spp
            WHERE t.tagihan = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$tagihan]);

            if ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
                $tagihan = new Tagihan($row['tagihan']);
                $tagihan->setIdTagihan($row['id_tagihan']);
                $tagihan->setTahun($row['tahun']);
                $tagihan->setNis($row['nis']);
                $tagihan->setSiswa($row['siswa']);
                $tagihan->setKelas($row['kelas']);
                $tagihan->setSpp($row['spp']);
                $tagihan->setGolongan($row['golongan']);
                $tagihan->setStatus($row['status']);
                return $tagihan;
            }

            return null;
        }

    }
}