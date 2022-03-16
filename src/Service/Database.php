<?php

namespace App\Service;

class Database
{
    private $databaseHost;
    private $databaseName;
    private $databaseUser;
    private $databasePassword;

    public function __construct($databaseHost, $databaseName, $databaseUser, $databasePassword)
    {
        $this->databaseHost = $databaseHost;
        $this->databaseName = $databaseName;
        $this->databaseUser = $databaseUser;
        $this->databasePassword = $databasePassword;
    }

    public function getDatabase(): \PDO
    {
        return new \PDO(
            'mysql:host='.$this->databaseHost.';dbname='.$this->databaseName.';charset=utf8',
            $this->databaseUser,
            $this->databasePassword
        );
    }
}
