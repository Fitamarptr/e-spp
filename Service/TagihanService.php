<?php

namespace Service{

require_once __DIR__ . '/../Entity/Tagihan.php';
use Entity\Tagihan;
use Repository\TagihanRepository;

    interface TagihanService {
        public function addTagihan(string $tagihan,int $id_siswa, int $id_spp): void;
        public function showTagihan(): array;
        public function removeTagihan(int $id_tagihan): bool;
    }

    class TagihanServiceImpl implements TagihanService
    {
        private TagihanRepository $tagihanRepository;

        public function __construct(TagihanRepository $tagihanRepository)
        {
            $this->tagihanRepository = $tagihanRepository;
        }

        public function addTagihan(string $tagihan,int $id_siswa, int $id_spp): void
        {
            // Retrieve the golongan,nominal from the database based on the id_spp
            $sql = "SELECT spp,golongan,tahun FROM spp WHERE id_spp = ?";
            $statement = $this->tagihanRepository->connection->prepare($sql);
            $statement->execute([$id_spp]);
            $result = $statement->fetch(\PDO::FETCH_ASSOC);

            if (!$result) {
                throw new \Exception("SPP with id $id_spp not found");
            }

            // Retrieve the nis,nama,kelas from the database based on the id_siswa
            $sql2 = "SELECT siswa,nis,kelas FROM siswa WHERE id_siswa = ?";
            $statement2 = $this->tagihanRepository->connection->prepare($sql2);
            $statement2->execute([$id_siswa]);
            $result2 = $statement2->fetch(\PDO::FETCH_ASSOC);

            if (!$result2) {
                throw new \Exception("Siswa with id $id_siswa not found");
            }
            // Create a new tagihan object with the retrieved data
            $newTagihan = new Tagihan($tagihan);
            $newTagihan->setIdSpp($id_spp);
            $newTagihan->setSpp($result['spp']);
            $newTagihan->setGolongan($result['golongan']);
            $newTagihan->setTahun($result['tahun']);
            $newTagihan->setIdSiswa($id_siswa);
            $newTagihan->setSiswa($result2['siswa']);
            $newTagihan->setNis($result2['nis']);
            $newTagihan->setKelas($result2['kelas']);

            $this->tagihanRepository->add($newTagihan);
        }

        public function showTagihan(): array
        {
            return $this->tagihanRepository->findAll();
        }

        public function removeTagihan(int $number): bool
        {
            return $this->tagihanRepository->remove($number);
        }

        public function bayarTagihan(string $tagihan): void
        {
            $sql = "UPDATE tagihan SET status = 'terbayar' WHERE id_tagihan = ?";
            $statement = $this->tagihanRepository->connection->prepare($sql);
            $statement->execute([$tagihan]);
        }

        public function showTagihanByNoTagihan(string $noTagihan): ?Tagihan
        {
            return $this->tagihanRepository->findTagihanByNoTagihan($noTagihan);
        }

    }
}