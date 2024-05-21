<?php

namespace App\Entity;

use App\Repository\NivelEducativoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NivelEducativoRepository::class)]
class NivelEducativo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $siglas = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    /**
     * @var Collection<int, Grupo>
     */
    #[ORM\OneToMany(targetEntity: Grupo::class, mappedBy: 'nivelEducativo')]
    private Collection $grupos;

    public function __construct()
    {
        $this->grupos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSiglas(): ?string
    {
        return $this->siglas;
    }

    public function setSiglas(string $siglas): static
    {
        $this->siglas = $siglas;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

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
            $grupo->setNivelEducativo($this);
        }

        return $this;
    }

    public function removeGrupo(Grupo $grupo): static
    {
        if ($this->grupos->removeElement($grupo)) {
            // set the owning side to null (unless already changed)
            if ($grupo->getNivelEducativo() === $this) {
                $grupo->setNivelEducativo(null);
            }
        }

        return $this;
    }
}
