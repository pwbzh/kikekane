<?php

namespace App\Repository;

use App\Entity\GameEntity;

class GameRepository
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    private function setInstanceFromRow(array $row)
    {
        $game = new GameEntity();
        $game->setId($row[0]);
        $game->setLabel($row[1]);
        $game->setYear(new \DateTime($row[2]));
        $game->setOpenBets($row[3]);

        return $game;
    }

    public function findAll(): array
    {
        $sqlRequest = 'SELECT id, label, year, open_bets FROM game';

        $sth = $this->database->prepare($sqlRequest);
        $sth->execute();

        $games = array();

        while ($row = $sth->fetch(\PDO::FETCH_NUM, \PDO::FETCH_ORI_NEXT)) {
            $games[$row[0]] = $this->setInstanceFromRow($row);
        }

        return $games;
    }

    public function find($gameId): ?GameEntity
    {
        $sqlRequest = 'SELECT id, label, year, open_bets FROM game WHERE id = :game_id';

        $sth = $this->database->prepare($sqlRequest);
        $sth->bindParam('game_id', $gameId, \PDO::PARAM_INT);
        $sth->execute();

        while ($row = $sth->fetch(\PDO::FETCH_NUM, \PDO::FETCH_ORI_NEXT)) {
            return $this->setInstanceFromRow($row);
        }

        return null;
    }
}
