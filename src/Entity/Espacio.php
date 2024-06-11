<?php

namespace App\Entity;

use App\Repository\EspacioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspacioRepository::class)]
class Espacio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column]
    private ?int $aforo = null;

    /**
     * @var Collection<int, Recurso>
     */
    #[ORM\ManyToMany(targetEntity: Recurso::class, inversedBy: 'espacios')]
    private Collection $recursos;

    #[ORM\ManyToOne(inversedBy: 'espacios')]
    private ?Edificio $edificio = null;

    /**
     * @var Collection<int, DetalleActividad>
     */
    #[ORM\OneToMany(targetEntity: DetalleActividad::class, mappedBy: 'espacio')]
    private Collection $actividades;

    public function __construct()
    {
        $this->recursos = new ArrayCollection();
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

    public function getAforo(): ?int
    {
        return $this->aforo;
    }

    public function setAforo(int $aforo): static
    {
        $this->aforo = $aforo;

        return $this;
    }

    /**
     * @return Collection<int, Recurso>
     */
    public function getRecursos(): Collection
    {
        return $this->recursos;
    }

    public function addRecurso(Recurso $recurso): static
    {
        if (!$this->recursos->contains($recurso)) {
            $this->recursos->add($recurso);
        }

        return $this;
    }

    public function removeRecurso(Recurso $recurso): static
    {
        $this->recursos->removeElement($recurso);

        return $this;
    }

    public function getEdificio(): ?Edificio
    {
        return $this->edificio;
    }

    public function setEdificio(?Edificio $edificio): static
    {
        $this->edificio = $edificio;

        return $this;
    }

    /**
     * @return Collection<int, DetalleActividad>
     */
    public function getActividades(): Collection
    {
        return $this->actividades;
    }

    public function addActividade(DetalleActividad $actividade): static
    {
        if (!$this->actividades->contains($actividade)) {
            $this->actividades->add($actividade);
            $actividade->setEspacio($this);
        }

        return $this;
    }

    public function removeActividade(DetalleActividad $actividade): static
    {
        if ($this->actividades->removeElement($actividade)) {
            // set the owning side to null (unless already changed)
            if ($actividade->getEspacio() === $this) {
                $actividade->setEspacio(null);
            }
        }

        return $this;
    }
}
