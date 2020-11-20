<?php

namespace App\Model;

class WitchManager extends AbstractManager
{

    const TABLE = 'question';

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

    public function updateCredibilityWhenFlamecountIsFull() {
        $this->pdo->exec("UPDATE " . self::TABLE . " SET credibility = 100 WHERE flame_count >= 5");
    }
    public function selectQuestions(): array
    {
        return $this->pdo->query('SELECT * FROM question')->fetchAll();
    }
    public function selectAnswers(): array
    {
        return $this->pdo->query('SELECT * FROM answer')->fetchAll();
    }
}
