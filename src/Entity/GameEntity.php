<?php

namespace App\Entity;

class GameEntity
{
    private $id;
    private $label;
    private $year;
    private $openBets;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setYear(\DateTime $year)
    {
        if ($year && $year instanceof \DateTime) {
            $this->year = $year;
        } elseif ($year && !($year instanceof \DateTime)) {
            throw new \Exception('Invalid type.');
        }
    }

    public function getYear(): ?\DateTime
    {
        return $this->year;
    }

    public function setOpenBets(bool $openBets)
    {
        $this->openBets = $openBets;
    }

    public function isOpenBets(): ?bool
    {
        return $this->openBets;
    }
}
