<?php

namespace App\Repository;

class GameRepository
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function findAll(): array
    {
        $sqlRequest = 'SELECT * FROM game';

        $sth = $this->database->prepare($sqlRequest);
        $sth->execute();

        return $sth->fetchAll();
    }
}
