<?php

namespace models;

class User extends BaseModel
{
    protected string $username;

    protected string $email;

    protected $icon;

    protected $createdDt;


    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon($icon): void
    {
        $this->icon = $icon;
    }

    public function getCreatedDt()
    {
        return $this->createdDt;
    }

    public function setCreatedDt($createdDt): void
    {
        $this->createdDt = $createdDt;
    }

    public static function getTableName(): string
    {
        return 'users';
    }
}
