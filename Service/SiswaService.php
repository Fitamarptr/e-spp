<?php


namespace Service {
    require_once __DIR__ . '/../Entity/Siswa.php';
    use Entity\Siswa;
    use Repository\SiswaRepository;

    interface SiswaService
    {
        function showSiswa(): array;
        
        public function addSiswa(string $siswa, int $nis, string $kelas, int $id_spp): void;
        
        function removeSiswa(int $number): bool;
        
        public function updateSiswa(int $id, string $siswa, int $nis, string $kelas, string $tahun, int $golongan): bool;
        
        public function getSiswaById(int $id): ?Siswa;
        
        public function findByIdSpp(int $idSpp): array;
    }

    class SiswaServiceImpl implements SiswaService
    {
        private SiswaRepository $siswaRepository;

        public function __construct(SiswaRepository $siswaRepository)
        {
            $this->siswaRepository = $siswaRepository;
        }

        public function showSiswa(): array
        {
            $siswaList = $this->siswaRepository->findAll();

            return $siswaList;
        }

        public function addSiswa(string $siswa, int $nis, string $kelas, int $id_spp): void
        {
            // Retrieve the golongan from the database based on the id_spp
            $sql = "SELECT golongan FROM spp WHERE id_spp = ?";
            $statement = $this->siswaRepository->connection->prepare($sql);
            $statement->execute([$id_spp]);
            $result = $statement->fetch(\PDO::FETCH_ASSOC);

            if (!$result) {
                throw new \Exception("SPP with id $id_spp not found");
            }

            // Check if the golongan is already set in the Siswa object
            $golongan = '';
            $existingSiswa = $this->siswaRepository->findByIdSpp($id_spp);
            if ($existingSiswa) {
                $golongan = $existingSiswa->getGolongan();
            } else {
                $golongan = $result['golongan']; // Use the retrieved golongan from the spp table
            }

            // Create a new Siswa object with the retrieved data
            $newSiswa = new Siswa($siswa);
            $newSiswa->setNis($nis);
            $newSiswa->setKelas($kelas);
            $newSiswa->setIdSpp($id_spp);
            $newSiswa->setGolongan($golongan);

            $this->siswaRepository->add($newSiswa);
        }


        public function updateSiswa(int $id, string $siswa, int $nis, string $kelas, string $tahun, int $golongan): bool
        {
            // Retrieve the golongan from the database based on the id_spp
            $sql = "SELECT golongan FROM spp WHERE golongan = ?";
            $statement = $this->siswaRepository->connection->prepare($sql);
            $statement->execute([$golongan]);
            $result = $statement->fetch(\PDO::FETCH_ASSOC);

            if (!$result) {
                throw new \Exception("SPP with id_spp $golongan not found");
            }

            $updateSiswa = new Siswa($siswa);
            $updateSiswa->setId($id);
            $updateSiswa->setNis($nis);
            $updateSiswa->setKelas($kelas);
            $updateSiswa->setTahun($tahun);
//            $updateSiswa->setIdSpp($id_spp);
            $updateSiswa->setGolongan($result['golongan']);

            return $this->siswaRepository->update($updateSiswa);
        }


        public function getSiswaById(int $id): ?Siswa
        {
            $siswa = $this->siswaRepository->findById($id);
            return $siswa;
        }
        
        public function removeSiswa(int $number): bool
        {
            return $this->siswaRepository->remove($number);
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
