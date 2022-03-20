<?php

namespace App\Entity;

class PublicFigureEntity
{
    private $id;
    private $name;
    private $birthDate;
    private $deathDate;
    private $wikipedia;
    private $twitter;
    private $note;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setBirthDate(\DateTime $birthDate)
    {
        if ($birthDate && $birthDate instanceof \DateTime) {
            $this->birthDate = $birthDate;
        } elseif ($birthDate && !($birthDate instanceof \DateTime)) {
            throw new \Exception('Invalid type.');
        }
    }

    public function getBirthDate(): ?\DateTime
    {
        return $this->birthDate;
    }

    public function setDeathDate($deathDate)
    {
        if ($deathDate && $deathDate instanceof \DateTime) {
            $this->deathDate = $deathDate;
        } elseif ($deathDate && !($deathDate instanceof \DateTime)) {
            throw new \Exception('Invalid type.');
        }
    }

    public function getDeathDate(): ?\DateTime
    {
        return $this->deathDate;
    }

    public function setWikipedia(string $wikipedia)
    {
        $this->wikipedia = $wikipedia;
    }

    public function getWikipedia(): ?string
    {
        return $this->wikipedia;
    }

    public function setTwitter(string $twitter)
    {
        $this->twitter = $twitter;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setNote(string $note)
    {
        $this->note = $note;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }
}
