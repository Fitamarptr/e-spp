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

            $this->spp[] = $spp;

            $sql = "INSERT INTO spp(spp,bulan,status) VALUES (?,?,?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$spp->getSpp(), $spp->getBulan(), $spp->getStatus()]);
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
                $spp->setID($row['id_spp']);
                $spp->setBulan($row['bulan']);
                $spp->setStatus($row['status']);
                $sppList[] = $spp;
            }

            return $sppList;
        }


        public function updateSpp(Spp $spp): bool
        {
            $sql = "UPDATE spp SET spp = :spp, bulan = :bulan, status = :status WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':spp', $spp->getSpp(), PDO::PARAM_INT);
            $stmt->bindValue(':bulan', $spp->getBulan(), PDO::PARAM_STR);
            $stmt->bindValue(':status', $spp->getStatus(), PDO::PARAM_STR);
            $stmt->bindValue(':id', $spp->getID(), PDO::PARAM_INT);
            return $stmt->execute();
        }


    }



}
