<?php

namespace App\Entity;

class EquipoPlantillas
{
    private $idEquipo;

    private $nombre;

    private $slot;

    private $fuerza;

    private $destreza;

    private $inteligencia;

    private $coste;

    public function getIdEquipo(): ?int
    {
        return $this->idEquipo;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getSlot(): ?int
    {
        return $this->slot;
    }

    public function setSlot(int $slot): self
    {
        $this->slot = $slot;

        return $this;
    }

    public function getFuerza(): ?int
    {
        return $this->fuerza;
    }

    public function setFuerza(int $fuerza): self
    {
        $this->fuerza = $fuerza;

        return $this;
    }

    public function getDestreza(): ?int
    {
        return $this->destreza;
    }

    public function setDestreza(int $destreza): self
    {
        $this->destreza = $destreza;

        return $this;
    }

    public function getInteligencia(): ?int
    {
        return $this->inteligencia;
    }

    public function setInteligencia(int $inteligencia): self
    {
        $this->inteligencia = $inteligencia;

        return $this;
    }

    public function getCoste(): ?int
    {
        return $this->coste;
    }

    public function setCoste(int $coste): self
    {
        $this->coste = $coste;

        return $this;
    }
}
