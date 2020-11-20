<?php

namespace App\Model;

class WitchManager extends AbstractManager
{
    const TABLE = 'witch';

    public function __construct()
    {
         parent::__construct(self::TABLE);
    }

    public function selectAllByLastUpdated() {
        $statement = $this->pdo->query("SELECT * FROM " . self::TABLE . " ORDER BY credibility ASC");
        return $statement->fetchAll();
    }

    public function selectFlameCount($id) {
        $statement = $this->pdo->prepare("SELECT flame_count FROM " . self::TABLE . " WHERE id = :id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }
}
