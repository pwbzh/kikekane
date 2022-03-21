<?php

namespace App\Repository;

use App\Entity\UserEntity;

class UserRepository
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    private function setInstanceFromRow(array $row)
    {
        $user = new UserEntity();
        $user->setId($row[0]);
        $user->setLogin($row[1]);
        $user->setEmail($row[2]);
        $user->setIsAdmin($row[3]);
        $user->setLastLoginDatetime($row[4] ? new \DateTime($row[4]) : null);

        return $user;
    }

    public function findAll(): array
    {
        $sqlRequest = 'SELECT id, login, email, is_admin, last_login_datetime FROM user ORDER BY login';

        $sth = $this->database->prepare($sqlRequest);
        $sth->execute();

        $users = array();

        while ($row = $sth->fetch(\PDO::FETCH_NUM, \PDO::FETCH_ORI_NEXT)) {
            $users[$row[0]] = $this->setInstanceFromRow($row);
        }

        return $users;
    }

    public function findGameUsers(int $gameId): array
    {
        $sqlRequest = 'SELECT id, login, email, is_admin, last_login_datetime FROM user WHERE id IN (SELECT user_id FROM game_user WHERE game_id = :game_id) ORDER BY login';

        $sth = $this->database->prepare($sqlRequest);
        $sth->bindParam('game_id', $gameId, \PDO::PARAM_INT);
        $sth->execute();

        $users = array();

        while ($row = $sth->fetch(\PDO::FETCH_NUM, \PDO::FETCH_ORI_NEXT)) {
            $users[$row[0]] = $this->setInstanceFromRow($row);
        }

        return $users;
    }
}
