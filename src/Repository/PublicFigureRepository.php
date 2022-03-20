<?php

namespace App\Repository;

use App\Entity\PublicFigureEntity;

class PublicFigureRepository
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    private function setInstanceFromRow(array $row)
    {
        $publicFigure = new PublicFigureEntity();
        $publicFigure->setId($row[0]);
        $publicFigure->setName($row[1]);
        $publicFigure->setBirthDate(new \DateTime($row[2]));
        $publicFigure->setDeathDate($row[3] ? new \DateTime($row[3]) : null);
        $publicFigure->setWikipedia($row[4]);
        $publicFigure->setTwitter($row[5]);
        $publicFigure->setNote($row[6]);

        return $publicFigure;
    }

    public function findAll(): array
    {
        $sqlRequest = 'SELECT id, name, birth_date, death_date, wikipedia, twitter, note FROM public_figure';

        $sth = $this->database->prepare($sqlRequest);
        $sth->execute();

        $publicFigures = array();

        while ($row = $sth->fetch(\PDO::FETCH_NUM, \PDO::FETCH_ORI_NEXT)) {
            $publicFigures[$row[0]] = $this->setInstanceFromRow($row);
        }

        return $publicFigures;
    }
}
