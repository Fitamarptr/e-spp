<?php

namespace Repository {

    use Entity\Spp;

    interface SppRepository
    {

        function save(Spp $spp): void;

        function remove(int $number): bool;

        function findAll(): array;

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
            $this->spp[] = $spp;

            $sql = "INSERT INTO spp(spp,bulan,tahun,golongan) VALUES (?,?,?,?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$spp->getSpp(), $spp->getBulan(), $spp->getTahun(), $spp->getGolongan()]);
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
                $spp->setGolongan($row['golongan']);
                $sppList[] = $spp;
            }

            return $sppList;
        }




    }



}