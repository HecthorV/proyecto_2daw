<?php

namespace App\Entity;

use App\Repository\AlumnoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlumnoRepository::class)]
class Alumno
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $correo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaNacimiento = null;

    /**
     * @var Collection<int, AlumnoDetalleActividad>
     */
    #[ORM\OneToMany(targetEntity: AlumnoDetalleActividad::class, mappedBy: 'alumno')]
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

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): static
    {
        $this->correo = $correo;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(\DateTimeInterface $fechaNacimiento): static
    {
        $this->fechaNacimiento = $fechaNacimiento;

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
            $alumnoDetalleActividad->setAlumno($this);
        }

        return $this;
    }

    public function removeAlumnoDetalleActividad(AlumnoDetalleActividad $alumnoDetalleActividad): static
    {
        if ($this->alumnoDetalleActividads->removeElement($alumnoDetalleActividad)) {
            // set the owning side to null (unless already changed)
            if ($alumnoDetalleActividad->getAlumno() === $this) {
                $alumnoDetalleActividad->setAlumno(null);
            }
        }

        return $this;
    }
}
