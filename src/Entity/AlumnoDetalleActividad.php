<?php

namespace App\Entity;

use App\Repository\AlumnoDetalleActividadRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlumnoDetalleActividadRepository::class)]
class AlumnoDetalleActividad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'alumnoDetalleActividads')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Alumno $alumno = null;

    #[ORM\ManyToOne(inversedBy: 'alumnoDetalleActividads')]
    private ?DetalleActividad $detalleActividad = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlumno(): ?Alumno
    {
        return $this->alumno;
    }

    public function setAlumno(?Alumno $alumno): static
    {
        $this->alumno = $alumno;

        return $this;
    }

    public function getDetalleActividad(): ?DetalleActividad
    {
        return $this->detalleActividad;
    }

    public function setDetalleActividad(?DetalleActividad $detalleActividad): static
    {
        $this->detalleActividad = $detalleActividad;

        return $this;
    }
}
