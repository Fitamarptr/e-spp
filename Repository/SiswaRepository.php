<?php

Namespace Repository {

    use Entity\Siswa;

    interface SiswaRepository
    {

        public function add(Siswa $siswa): void;

        public function findAll(): array;

        public function remove(int $number): bool;
    }


    class SiswaRepositoryImpl implements SiswaRepository
    {

        public array $siswa = array();

        public \PDO  $connection;

        public function __construct(\PDO $connection)
        {
            $this->connection = $connection;
        }


        public function add(Siswa $siswa): void
        {
            $this->siswa[] = $siswa ;


            $sql = "INSERT INTO siswa(siswa,nis,kelas,id_spp) VALUES (?,?,?,?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$siswa->getSiswa(), $siswa->getNis(), $siswa->getKelas(), $siswa->getIdSpp()]);
        }

        public function findAll(): array
        {
            $sql = "SELECT s.id_siswa, s.siswa, s.nis, s.kelas, sp.golongan
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



//        private \PDO  $connection;
//
//        public function __construct(\PDO $connection)
//        {
//            $this->connection = $connection;
//        }
//
//
//        public function add(Siswa $siswa): void
//        {
//            $this->siswa[] = $siswa ;
//
//            $sql = "INSERT INTO siswa(siswa,nis,kelas,id_spp) VALUES (?,?,?,?)";
//            $statement = $this->connection->prepare($sql);
//            $statement->execute([$siswa->getSiswa(), $siswa->getNis(), $siswa->getKelas(), $siswa->getIdSpp()]);
//        }
//
//        public function findAll(): array
//        {
//            $sql = "SELECT siswa.id_siswa, siswa.siswa, siswa.nis, siswa.kelas, spp.golongan
//                    FROM siswa
//                    INNER JOIN spp ON siswa.id_spp = spp.id_spp";
//            $statement = $this->connection->prepare($sql);
//            $statement->execute();
//
//            $siswaList = array();
//            while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
//                $siswa = new Siswa($row['siswa']);
//                $siswa->setId($row['id_siswa']);
//                $siswa->setNis($row['nis']);
//                $siswa->setKelas($row['kelas']);
//                $siswa->setGolongan($row['golongan']);
//                $siswaList[] = $siswa;
//            }
//
//            return $siswaList;
//        }
//
//        public function remove(int $number): bool
//        {
//            $sql = "SELECT id_siswa FROM siswa WHERE id_siswa = ?";
//            $statement = $this->connection->prepare($sql);
//            $statement->execute([$number]);
//
//            if ($statement->fetch()) {
//                // siswa ada
//                $sql = "DELETE FROM siswa WHERE id_siswa = ?";
//                $statement = $this->connection->prepare($sql);
//                $statement->execute([$number]);
//                return $statement->rowCount() > 0;
//            } else {
//                return false;
//            }
//            return false;
//        }
    }
}



