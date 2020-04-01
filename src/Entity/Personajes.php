<?php

namespace App\Entity;

class Personajes
{
    private $nombre;

    private $login;

    public function getNombre(): ?string
    {
        return $this->nombre;
    }
    public function setNombre(?Usuarios $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getLogin(): ?Usuarios
    {
        return $this->login;
    }

    public function setLogin(?Usuarios $login): self
    {
        $this->login = $login;

        return $this;
    }
}
