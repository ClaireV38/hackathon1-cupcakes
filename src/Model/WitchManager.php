<?php

namespace App\Model;

class WitchManager extends AbstractManager
{

    const TABLE = 'witch';

    public function __construct()
    {
         parent::__construct(self::TABLE);
    }

    public function insert(string $name, string $address, int $score, string $imgPath)
    {
        $query = "INSERT INTO " . self::TABLE . " (name, localisation, credibility, image, create_at) VALUES
        (:name, :localisation, :credibility, :image, NOW());";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':name', $name, \PDO::PARAM_STR);
        $statement->bindValue(':localisation', $address, \PDO::PARAM_STR);
        $statement->bindValue(':credibility', $score, \PDO::PARAM_INT);
        $statement->bindValue(':image', $imgPath, \PDO::PARAM_STR);
        return $statement->execute();
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

    public function updateCredibilityWhenFlamecountIsFull() {
        $this->pdo->exec("UPDATE " . self::TABLE . " SET credibility = 100 WHERE flame_count >= 5");
    }
}
