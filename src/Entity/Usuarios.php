<?php

namespace App\Entity;

class Usuarios
{
    private $login;

    private $password;

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }
    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
