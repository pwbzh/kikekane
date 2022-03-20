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
        $this->birthDate = $birthDate;
    }

    public function getBirthDate(): ?\DateTime
    {
        return $this->birthDate;
    }

    public function setDeathDate(?\DateTime $deathDate)
    {
        $this->deathDate = $deathDate;
    }

    public function getDeathDate(): ?\DateTime
    {
        return $this->deathDate;
    }

    public function getAge(): ?int
    {
        $endDate = date('Y-m-d');

        if ($this->deathDate) {
            $endDate = $this->deathDate->format('Y-m-d');
        }

        return date_diff(date_create($this->birthDate->format('Y-m-d')), date_create($endDate))->format('%y');
    }

    public function setWikipedia(?string $wikipedia)
    {
        $this->wikipedia = $wikipedia;
    }

    public function getWikipedia(): ?string
    {
        return $this->wikipedia;
    }

    public function setTwitter(?string $twitter)
    {
        $this->twitter = $twitter;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setNote(?string $note)
    {
        $this->note = $note;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }
}
