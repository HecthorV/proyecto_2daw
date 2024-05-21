<?php

namespace App\Entity;

use App\Repository\RecursoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecursoRepository::class)]
class Recurso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    /**
     * @var Collection<int, Espacio>
     */
    #[ORM\ManyToMany(targetEntity: Espacio::class, mappedBy: 'espacio_recurso')]
    private Collection $espacios;

    public function __construct()
    {
        $this->espacios = new ArrayCollection();
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

    /**
     * @return Collection<int, Espacio>
     */
    public function getEspacios(): Collection
    {
        return $this->espacios;
    }

    public function addEspacio(Espacio $espacio): static
    {
        if (!$this->espacios->contains($espacio)) {
            $this->espacios->add($espacio);
            $espacio->addRecurso($this);
        }

        return $this;
    }

    public function removeEspacio(Espacio $espacio): static
    {
        if ($this->espacios->removeElement($espacio)) {
            $espacio->removeRecurso($this);
        }

        return $this;
    }
}
