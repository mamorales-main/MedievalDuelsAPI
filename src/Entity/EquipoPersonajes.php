<?php

namespace App\Entity;

class EquipoPersonajes
{
    private $slot;

    private $nombre;

    private $idEquipo;

    public function getSlot(): ?int
    {
        return $this->slot;
    }

    public function getNombre(): ?Personajes
    {
        return $this->nombre;
    }

    public function setNombre(?Personajes $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getIdEquipo(): ?EquipoPlantillas
    {
        return $this->idEquipo;
    }

    public function setIdEquipo(?EquipoPlantillas $idEquipo): self
    {
        $this->idEquipo = $idEquipo;

        return $this;
    }
}
