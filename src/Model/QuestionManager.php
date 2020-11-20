<?php

namespace App\Model;

class QuestionManager extends AbstractManager
{

    const TABLE = 'question';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
