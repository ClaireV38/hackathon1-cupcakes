<?php

namespace App\Model;

class InquisitorManager extends AbstractManager
{
    public const TABLE = 'inquisitor';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * select one inquisitor by matricul
     * @param int $matricul
     * @return array
     */
    public function selectInquisitorByMatricul(int $matricul): array
    {
        $query = "SELECT * FROM " . self::TABLE . " WHERE matricul=:matricul";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue("matricul", $matricul, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }

}