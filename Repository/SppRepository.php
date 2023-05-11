<?php

namespace Repository {

    use Entity\Spp;

    interface SppRepository
    {

        function save(Spp $spp): void;

        function remove(int $number): bool;

        function findAll(): array;

        function update(Spp $spp): bool;

        function findById(int $id): ?Spp;

    }

    class SppRepositoryImpl implements SppRepository {

        public array $spp = array();

        public \PDO  $connection;

        public function __construct(\PDO $connection)
        {
            $this->connection = $connection;
        }


        function save(Spp $spp): void
        {
            $this->spp[] = $spp;

            $sql = "INSERT INTO spp(spp,tahun,golongan) VALUES (?,?,?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$spp->getSpp(),$spp->getTahun(), $spp->getGolongan()]);
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
                $spp->setTahun($row['tahun']);
                $spp->setGolongan($row['golongan']);
                $sppList[] = $spp;
            }

            return $sppList;
        }
        function update(Spp $spp): bool
        {
            $sql = "UPDATE spp SET spp = ?, tahun = ?, golongan = ? WHERE id_spp = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$spp->getSpp(),$spp->getTahun(), $spp->getGolongan(), $spp->getId()]);

            // Check if the update was successful
            if ($statement->rowCount() == 1) {
                return true;
            } else {
                return false;
            }
        }

        function findById(int $id): ?Spp
        {
            $sql = "SELECT * FROM spp WHERE id_spp = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$id]);

            $row = $statement->fetch(\PDO::FETCH_ASSOC);

            if (!$row) {
                return null;
            }

            $spp = new Spp($row['spp']);
            $spp->setId($row['id_spp']);
            $spp->setTahun($row['tahun']);
            $spp->setGolongan($row['golongan']);

            return $spp;
        }



    }



}