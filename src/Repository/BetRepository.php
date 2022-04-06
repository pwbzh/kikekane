<?php

namespace App\Repository;

class BetRepository
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function find($gameId): ?array
    {
        $sqlRequest = 'SELECT user_id, public_figure_id FROM bet WHERE game_id = :game_id';

        $sth = $this->database->prepare($sqlRequest);
        $sth->bindParam('game_id', $gameId, \PDO::PARAM_INT);
        $sth->execute();

        $bets = null;

        while ($row = $sth->fetch(\PDO::FETCH_NUM, \PDO::FETCH_ORI_NEXT)) {
            if (!isset($bets[$row[0]])) {
                $bets[$row[0]] = null;
            }

            $bets[$row[0]][] = $row[1];
        }

        return $bets;
    }
}
