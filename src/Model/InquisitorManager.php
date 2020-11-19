<?php

namespace App\Model;

class InquisitorManager extends AbstractManager
{
    const TABLE = 'inquisitor';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function addInquisitor($inquisitor)
    {
        $query = 'INSERT INTO ' . self::TABLE . ' (name, registrationNumber, password)
        VALUES (:name, :registrationNumber, :password)';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $inquisitor['name'], \PDO::PARAM_STR);
        $statement->bindValue('registrationNumber', $inquisitor['registrationNumber'], \PDO::PARAM_INT);
        $statement->bindValue('password', password_hash($inquisitor['password'], PASSWORD_DEFAULT), \PDO::PARAM_STR);
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }
}
