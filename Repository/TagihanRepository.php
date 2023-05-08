<?php

namespace Repository{

use Entity\Tagihan;
use PDO;


    interface TagihanRepository {
        public function addTagihan(Tagihan $tagihan);
        public function findTagihanById($id);
        public function updateTagihan(Tagihan $tagihan);
        public function deleteTagihanById($id);
        public function showTagihan();
    }

    class TagihanRepositoryImpl implements TagihanRepository
        {
            private $connection;

            public function __construct(PDO $connection) {
                $this->connection = $connection;
            }

            public function addTagihan(Tagihan $tagihan) {
                $statement = $this->connection->prepare(
                    "INSERT INTO tagihan (no_tagihan, id_siswa, id_spp) VALUES (:no_tagihan, :id_siswa, :id_spp)"
                );

                $statement->execute([
                    ':tagihan' => $tagihan->getTagihan(),
                    ':id_siswa' => $tagihan->getIdSiswa(),
                    ':id_spp' => $tagihan->getIdSpp()
                ]);
            }

            public function findTagihanById($id) {
                $statement = $this->connection->prepare(
                    "SELECT * FROM tagihan WHERE id_tagihan = :id_tagihan"
                );

                $statement->execute([':id_tagihan' => $id]);

                $result = $statement->fetch(PDO::FETCH_ASSOC);

                if (!$result) {
                    return null;
                }

                $tagihan = new Tagihan($result['tagihan']);
                $tagihan->setIdTagihan($result['id_tagihan']);
                $tagihan->setIdSiswa($result['id_siswa']);
                $tagihan->setIdSpp($result['id_spp']);

                return $tagihan;
            }

            public function updateTagihan(Tagihan $tagihan) {
                $statement = $this->connection->prepare(
                    "UPDATE tagihan SET tagihan = :tagihan, id_siswa = :id_siswa, id_spp = :id_spp WHERE id_tagihan = :id_tagihan"
                );

                $statement->execute([
                    ':tagihan' => $tagihan->getTagihan(),
                    ':id_siswa' => $tagihan->getIdSiswa(),
                    ':id_spp' => $tagihan->getIdSpp(),
                    ':id_tagihan' => $tagihan->getIdTagihan()
                ]);
            }

            public function deleteTagihanById($id) {
                $statement = $this->connection->prepare(
                    "DELETE FROM tagihan WHERE id_tagihan = :id_tagihan"
                );

                $statement->execute([':id_tagihan' => $id]);
            }

        public function showTagihan() {
            $statement = $this->connection->prepare("
        SELECT tagihan.*, siswa.siswa, spp.spp
        FROM tagihan
        INNER JOIN siswa ON tagihan.id_siswa = siswa.id_siswa
        INNER JOIN spp ON tagihan.id_spp = spp.id_spp
    ");

            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            $tagihanList = [];

            foreach ($result as $row) {
                $tagihan = new Tagihan($row['tagihan']);
                $tagihan->setIdTagihan($row['id_tagihan']);
                $tagihan->setIdSiswa($row['id_siswa']);
                $tagihan->setIdSpp($row['id_spp']);
                $tagihan->setNamaSiswa($row['nama_siswa']);
                $tagihan->setNominalSpp($row['nominal']);

                $tagihanList[] = $tagihan;
            }

            return $tagihanList;
        }



    }

    }