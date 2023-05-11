<?php

Namespace Repository {

    use Entity\Siswa;

    interface SiswaRepository
    {

        public function add(Siswa $siswa): void;

        public function findAll(): array;

        public function remove(int $number): bool;

        public function update(Siswa $siswa): bool;

        public function findById(int $id): ?Siswa;
    }


    class SiswaRepositoryImpl implements SiswaRepository
    {

        public array $siswa = array();

        public \PDO  $connection;

        public function __construct(\PDO $connection)
        {
            $this->connection = $connection;
        }


//        public function add(Siswa $siswa): void
//        {
//            $this->siswa[] = $siswa ;
//
//
//            $sql = "INSERT INTO siswa(siswa,nis,kelas,id_spp) VALUES (?,?,?,?)";
//            $statement = $this->connection->prepare($sql);
//            $statement->execute([$siswa->getSiswa(), $siswa->getNis(), $siswa->getKelas(), $siswa->getIdSpp()]);
//        }

        public function add(Siswa $siswa): void
        {
            // Check if id_spp and golongan are valid
            $sql = "SELECT golongan FROM spp WHERE id_spp = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$siswa->getIdSpp()]);
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            if (!$result) {
                throw new \Exception("SPP with id_spp {$siswa->getIdSpp()} not found");
            }

            $siswa->setGolongan($result['golongan']);
            $this->siswa[] = $siswa;

            // Insert into siswa table
            $sql = "INSERT INTO siswa(siswa, nis, kelas, id_spp, golongan) VALUES (?, ?, ?, ?, ?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$siswa->getSiswa(), $siswa->getNis(), $siswa->getKelas(), $siswa->getIdSpp(), $siswa->getGolongan()]);
        }


        public function findAll(): array
        {
            $sql = "SELECT s.id_siswa, s.siswa, s.nis, s.kelas, sp.tahun, sp.golongan
            FROM siswa s
            JOIN spp sp ON s.id_spp = sp.id_spp";
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            $siswaList = array();
            while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
                $siswa = new Siswa($row['siswa']);
                $siswa->setId($row['id_siswa']);
                $siswa->setNis($row['nis']);
                $siswa->setKelas($row['kelas']);
                $siswa->setTahun($row['tahun']);
                $siswa->setGolongan($row['golongan']);
                $siswaList[] = $siswa;
            }

            return $siswaList;
        }

        public function remove(int $number): bool
        {
            $sql = "SELECT id_siswa FROM siswa WHERE id_siswa = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$number]);

            if ($statement->fetch()) {
                // siswa ada
                $sql = "DELETE FROM siswa WHERE id_siswa = ?";
                $statement = $this->connection->prepare($sql);
                $statement->execute([$number]);
                return $statement->rowCount() > 0;
            } else {
                return false;
            }
            return false;
        }

        public function update(Siswa $siswa): bool
        {
            $sql = "UPDATE siswa s
            JOIN spp sp ON s.id_spp = sp.id_spp
            SET s.siswa = ?, s.nis = ?, s.kelas = ?, s.golongan = ?
            WHERE s.id_siswa = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$siswa->getSiswa(), $siswa->getNis(), $siswa->getKelas(),$siswa->getGolongan(), $siswa->getId()]);

            return $statement->rowCount() > 0;
        }


        public function findById(int $id): ?Siswa
        {
            $sql = "SELECT s.id_siswa, s.siswa, s.nis, s.kelas, sp.tahun, sp.golongan, sp.id_spp
            FROM siswa s
            JOIN spp sp ON s.id_spp = sp.id_spp
            WHERE s.id_siswa = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$id]);

            $result = $statement->fetch(\PDO::FETCH_ASSOC);

            if (!$result) {
                return null;
            }

            $siswa = new Siswa($result['siswa']);
            $siswa->setId($result['id_siswa']);
            $siswa->setNis($result['nis']);
            $siswa->setKelas($result['kelas']);
            $siswa->setTahun($result['tahun']);
            $siswa->setGolongan($result['golongan']);
            $siswa->setIdSpp($result['id_spp']);

            return $siswa;
        }

        public function findByIdSpp(int $idSpp): array
        {
            $sql = "SELECT * FROM siswa WHERE id_spp = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$idSpp]);
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);

            $siswaArray = [];
            foreach ($results as $result) {
                $siswa = new Siswa($result['siswa']);
                $siswa->setIdSiswa($result['id_siswa']);
                $siswa->setNis($result['nis']);
                $siswa->setKelas($result['kelas']);
                $siswa->setIdSpp($result['id_spp']);
                $siswa->setGolongan($result['golongan']);
                $siswaArray[] = $siswa;
            }

            return $siswaArray;
        }



    }
}



