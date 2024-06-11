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

    /**
     * @var Collection<int, Ponente>
     */
    #[ORM\OneToMany(targetEntity: Ponente::class, mappedBy: 'detalleActividad')]
    private Collection $ponentes;

    /**
     * @var Collection<int, Grupo>
     */
    #[ORM\ManyToMany(targetEntity: Grupo::class, inversedBy: 'detalleActividades')]
    private Collection $grupos;

    #[ORM\ManyToOne(inversedBy: 'actividades')]
    private ?Espacio $espacio = null;

    public function __construct()
    {
        $this->alumnoDetalleActividads = new ArrayCollection();
        $this->ponentes = new ArrayCollection();
        $this->grupos = new ArrayCollection();
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

    /**
     * @return Collection<int, Ponente>
     */
    public function getPonentes(): Collection
    {
        return $this->ponentes;
    }

    public function addPonente(Ponente $ponente): static
    {
        if (!$this->ponentes->contains($ponente)) {
            $this->ponentes->add($ponente);
            $ponente->setDetalleActividad($this);
        }

        return $this;
    }

    public function removePonente(Ponente $ponente): static
    {
        if ($this->ponentes->removeElement($ponente)) {
            // set the owning side to null (unless already changed)
            if ($ponente->getDetalleActividad() === $this) {
                $ponente->setDetalleActividad(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Grupo>
     */
    public function getGrupos(): Collection
    {
        return $this->grupos;
    }

    public function addGrupo(Grupo $grupo): static
    {
        if (!$this->grupos->contains($grupo)) {
            $this->grupos->add($grupo);
        }

        return $this;
    }

    public function removeGrupo(Grupo $grupo): static
    {
        $this->grupos->removeElement($grupo);

        return $this;
    }

    public function getEspacio(): ?Espacio
    {
        return $this->espacio;
    }

    public function setEspacio(?Espacio $espacio): static
    {
        $this->espacio = $espacio;

        return $this;
    }
}
