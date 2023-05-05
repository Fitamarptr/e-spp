<?php

namespace Repository {

    use Entity\Spp;

    interface SppRepository
    {

        function save(Spp $spp): void;

        function remove(int $number): bool;

        function findAll(): array;

//        function update(int $id, Spp $newSpp): bool;
//
//        public function findById(int $id): ?Spp;

    }

    class SppRepositoryImpl implements SppRepository {

        public array $spp = array();

        private \PDO  $connection;

        public function __construct(\PDO $connection)
        {
            $this->connection = $connection;
        }


        function save(Spp $spp): void
        {
            // $number = sizeof($this->todolist) + 1;
            // $this->todolist[$number] = $todolist;

            $no_tagihan = $this->generateNoTagihan($spp->getSpp(), $spp->getTahun(), $spp->getBulan());
            $spp->setNoTagihan($no_tagihan);
            $this->spp[] = $spp;

            $sql = "INSERT INTO spp(spp,bulan,tahun,no_tagihan) VALUES (?,?,?,?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$spp->getSpp(), $spp->getBulan(), $spp->getTahun(), $spp->getNoTagihan()]);
        }

        function remove(int $number): bool
        {

            $sql = "SELECT id_spp FROM spp WHERE id_spp = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$number]);

            if ($statement->fetch()){
                // spp ada
                $sql = "DELETE FROM spp WHERE id_spp = ?";
                $statement = $this->connection->prepare($sql);
                $statement->execute([$number]);
                return true;
            } else {
                return false;
            }

            return false;
        }

        function findAll(): array
        {
            $sql = "SELECT * FROM spp";
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            $sppList = array();
            while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
                $spp = new Spp($row['spp']);
                $spp->setId($row['id_spp']);
                $spp->setBulan($row['bulan']);
                $spp->setTahun($row['tahun']);
                $spp->setNoTagihan($row['no_tagihan']);
                $sppList[] = $spp;
            }

            return $sppList;
        }

        private function generateNoTagihan(int $spp, int $tahun, string $bulan): string
        {
            $bulanInt = date_parse($bulan)['month'];
            // generate no_tagihan from spp, tahun, and bulan
            $no_tagihan = "INV" . str_pad($spp, 4, '0', STR_PAD_LEFT) . $tahun  . strtoupper(substr($bulan, 0, 3));

//            $no_tagihan = 'INV' . str_pad($spp, 4, '0', STR_PAD_LEFT) . $tahun . str_pad($bulanInt, 2, '0', STR_PAD_LEFT);

            return $no_tagihan;
        }


    }



}