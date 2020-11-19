<?php

namespace App\Model;

class BountyManager extends AbstractManager
{
    const TABLE = 'bounty';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function hasVoted(int $inquisitorId, int $witchId)
    {

    }
}