<?php

namespace App\Entity;

class UserEntity
{
    private $id;
    private $login;
    private $email;
    private $isAdmin;
    private $lastLoginDatetime;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setLogin(string $login)
    {
        $this->login = $login;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setIsAdmin(bool $isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    public function isAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setLastLoginDatetime($lastLoginDatetime)
    {
        if ($lastLoginDatetime && $lastLoginDatetime instanceof \DateTime) {
            $this->lastLoginDatetime = $lastLoginDatetime;
        } elseif ($lastLoginDatetime && !($lastLoginDatetime instanceof \DateTime)) {
            throw new \Exception('Invalid type.');
        }
    }

    public function getLastLoginDatetime(): ?\DateTime
    {
        return $this->lastLoginDatetime;
    }
}
