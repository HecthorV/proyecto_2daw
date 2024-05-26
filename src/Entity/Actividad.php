<?php

namespace App\Entity;

use App\Repository\ActividadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActividadRepository::class)]
class Actividad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaHoraInicio = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fechaHoraFin = null;

    #[ORM\Column]
    private ?bool $compuesta = null;

    #[ORM\ManyToOne(inversedBy: 'actividad')]
    #[ORM\Column(nullable: true)]
    private ?Evento $evento = null;

    /**
     * @var Collection<int, DetalleActividad>
     */
    #[ORM\OneToMany(targetEntity: DetalleActividad::class, mappedBy: 'actividad')]
    private Collection $detalleActividades;

    public function __construct()
    {
        $this->detalleActividades = new ArrayCollection();
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

    public function getFechaHoraInicio(): ?\DateTimeInterface
    {
        return $this->fechaHoraInicio;
    }

    public function setFechaHoraInicio(\DateTimeInterface $fechaHoraInicio): static
    {
        $this->fechaHoraInicio = $fechaHoraInicio;

        return $this;
    }

    public function getFechaHoraFin(): ?\DateTimeInterface
    {
        return $this->fechaHoraFin;
    }

    public function setFechaHoraFin(\DateTimeInterface $fechaHoraFin): static
    {
        $this->fechaHoraFin = $fechaHoraFin;

        return $this;
    }

    public function isCompuesta(): ?bool
    {
        return $this->compuesta;
    }

    public function setCompuesta(bool $compuesta): static
    {
        $this->compuesta = $compuesta;

        return $this;
    }

    public function getEvento(): ?Evento
    {
        return $this->evento;
    }

    public function setEvento(?Evento $evento): static
    {
        $this->evento = $evento;

        return $this;
    }

    /**
     * @return Collection<int, DetalleActividad>
     */
    public function getDetalleActividades(): Collection
    {
        return $this->detalleActividades;
    }

    public function addDetalleActividade(DetalleActividad $detalleActividade): static
    {
        if (!$this->detalleActividades->contains($detalleActividade)) {
            $this->detalleActividades->add($detalleActividade);
            $detalleActividade->setActividad($this);
        }

        return $this;
    }

    public function removeDetalleActividade(DetalleActividad $detalleActividade): static
    {
        if ($this->detalleActividades->removeElement($detalleActividade)) {
            // set the owning side to null (unless already changed)
            if ($detalleActividade->getActividad() === $this) {
                $detalleActividade->setActividad(null);
            }
        }

        return $this;
    }
}
