<?php

namespace App\Entity;

use App\Repository\EventoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventoRepository::class)]
class Evento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaInicio = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fechaFin = null;

    /**
     * @var Collection<int, Actividad>
     */
    #[ORM\OneToMany(targetEntity: Actividad::class, mappedBy: 'evento')]
    private Collection $actividad;

    /**
     * @var Collection<int, Actividad>
     */
    #[ORM\OneToMany(targetEntity: Actividad::class, mappedBy: 'evento')]
    private Collection $actividades;

    public function __construct()
    {
        $this->actividad = new ArrayCollection();
        $this->actividades = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTimeInterface $fechaInicio): static
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFin(): ?string
    {
        return $this->fechaFin;
    }

    public function setFechaFin(?string $fechaFin): static
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * @return Collection<int, Actividad>
     */
    public function getActividad(): Collection
    {
        return $this->actividad;
    }

    public function addActividad(Actividad $actividad): static
    {
        if (!$this->actividad->contains($actividad)) {
            $this->actividad->add($actividad);
            $actividad->setEvento($this);
        }

        return $this;
    }

    public function removeActividad(Actividad $actividad): static
    {
        if ($this->actividad->removeElement($actividad)) {
            // set the owning side to null (unless already changed)
            if ($actividad->getEvento() === $this) {
                $actividad->setEvento(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Actividad>
     */
    public function getActividades(): Collection
    {
        return $this->actividades;
    }

    public function addActividade(Actividad $actividade): static
    {
        if (!$this->actividades->contains($actividade)) {
            $this->actividades->add($actividade);
            $actividade->setEvento($this);
        }

        return $this;
    }

    public function removeActividade(Actividad $actividade): static
    {
        if ($this->actividades->removeElement($actividade)) {
            // set the owning side to null (unless already changed)
            if ($actividade->getEvento() === $this) {
                $actividade->setEvento(null);
            }
        }

        return $this;
    }
}
