<?php

namespace App\Model;

class WitchManager extends AbstractManager
{

    const TABLE = 'question';

    public function __construct()
    {
         parent::__construct(self::TABLE);
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
