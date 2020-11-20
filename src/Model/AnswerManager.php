<?php


namespace App\Model;


class AnswerManager extends AbstractManager
{
    const TABLE = 'answer';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}