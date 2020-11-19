<?php

namespace App\Model;

class WitchManager extends AbstractManager
{
    const TABLE = 'witch';

    public function __construct()
    {
         parent::__construct(self::TABLE);
    }
}

