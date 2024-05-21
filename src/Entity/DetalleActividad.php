<?php

namespace App\Entity;

use App\Repository\DetalleActividadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetalleActividadRepository::class)]
class DetalleActividad
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

    #[ORM\ManyToOne(inversedBy: 'detalleActividades')]
    private ?Actividad $actividad = null;

    /**
     * @var Collection<int, AlumnoDetalleActividad>
     */
    #[ORM\OneToMany(targetEntity: AlumnoDetalleActividad::class, mappedBy: 'detalleActividad')]
    private Collection $alumnoDetalleActividads;

    public function __construct()
    {
        $this->alumnoDetalleActividads = new ArrayCollection();
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

    public function setFechaHoraFin(?\DateTimeInterface $fechaHoraFin): static
    {
        $this->fechaHoraFin = $fechaHoraFin;

        return $this;
    }

    public function getActividad(): ?Actividad
    {
        return $this->actividad;
    }

    public function setActividad(?Actividad $actividad): static
    {
        $this->actividad = $actividad;

        return $this;
    }

    /**
     * @return Collection<int, AlumnoDetalleActividad>
     */
    public function getAlumnoDetalleActividads(): Collection
    {
        return $this->alumnoDetalleActividads;
    }

    public function addAlumnoDetalleActividad(AlumnoDetalleActividad $alumnoDetalleActividad): static
    {
        if (!$this->alumnoDetalleActividads->contains($alumnoDetalleActividad)) {
            $this->alumnoDetalleActividads->add($alumnoDetalleActividad);
            $alumnoDetalleActividad->setDetalleActividad($this);
        }

        return $this;
    }

    public function removeAlumnoDetalleActividad(AlumnoDetalleActividad $alumnoDetalleActividad): static
    {
        if ($this->alumnoDetalleActividads->removeElement($alumnoDetalleActividad)) {
            // set the owning side to null (unless already changed)
            if ($alumnoDetalleActividad->getDetalleActividad() === $this) {
                $alumnoDetalleActividad->setDetalleActividad(null);
            }
        }

        return $this;
    }
}
