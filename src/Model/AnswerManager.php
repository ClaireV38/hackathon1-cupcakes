<?php

namespace App\Model;

class AnswerManager extends AbstractManager
{

    const TABLE = 'answer';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectAnswersByQuestionId(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE question_id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
