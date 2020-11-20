<?php

namespace App\Model;

class BountyManager extends AbstractManager
{
    const TABLE = 'bounty';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function addVote(int $inquisitorId, int $witchId)
    {
        $statement = $this->pdo->prepare("SELECT id FROM inquisitor WHERE registrationNumber = :inquisitorId");
        $statement->bindValue('inquisitorId', $inquisitorId, \PDO::PARAM_INT);
        $statement->execute();
        $inquisitor = $statement->fetch();

        $statement = $this->pdo->prepare("UPDATE witch SET flame_count = flame_count + 1 WHERE id = :witchId");
        $statement->bindValue('witchId', $witchId, \PDO::PARAM_INT);
        $statement->execute();

        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (inquisitor_id, witch_id, has_voted)
        VALUES (:inquisitorId, :witchId, '1')");
        $statement->bindValue('inquisitorId', $inquisitor['id'], \PDO::PARAM_INT);
        $statement->bindValue('witchId', $witchId, \PDO::PARAM_INT);
        $statement->execute();
    }
}
