<?php

namespace App\Entity;

class PersonajesDetalles
{
    private $nivel;

    private $clase;

    private $fuerza;

    private $destreza;

    private $inteligencia;

    private $saldo;

    private $exp;

    private $expreq;

    private $nombre;

    public function getNivel(): ?int
    {
        return $this->nivel;
    }

    public function setNivel(int $nivel): self
    {
        $this->nivel = $nivel;

        return $this;
    }

    public function getClase(): ?string
    {
        return $this->clase;
    }

    public function setClase(string $clase): self
    {
        $this->clase = $clase;

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

    public function getSaldo(): ?int
    {
        return $this->saldo;
    }

    public function setSaldo(int $saldo): self
    {
        $this->saldo = $saldo;

        return $this;
    }

    public function getExp(): ?int
    {
        return $this->exp;
    }

    public function setExp(int $exp): self
    {
        $this->exp = $exp;

        return $this;
    }

    public function getExpreq(): ?int
    {
        return $this->expreq;
    }

    public function setExpreq(int $expreq): self
    {
        $this->expreq = $expreq;

        return $this;
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
}
