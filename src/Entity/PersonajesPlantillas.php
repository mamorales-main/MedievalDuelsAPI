<?php

namespace App\Entity;

class PersonajesPlantillas
{
    private $clase;

    private $nivel;

    private $fuerza;

    private $destreza;

    private $inteligencia;

    public function getClase(): ?string
    {
        return $this->clase;
    }

    public function getNivel(): ?int
    {
        return $this->nivel;
    }

    public function setNivel(int $nivel): self
    {
        $this->nivel = $nivel;

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
}
