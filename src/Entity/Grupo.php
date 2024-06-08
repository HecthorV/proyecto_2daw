<?php

namespace App\Entity;

use App\Repository\GrupoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GrupoRepository::class)]
class Grupo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $curso = null;

    #[ORM\Column(length: 2)]
    private ?string $letra = null;

    #[ORM\ManyToOne(inversedBy: 'grupos')]
    private ?NivelEducativo $nivelEducativo = null;

    /**
     * @var Collection<int, UserGrupo>
     */
    #[ORM\OneToMany(targetEntity: UserGrupo::class, mappedBy: 'grupo')]
    private Collection $userGrupos;

    /**
     * @var Collection<int, DetalleActividad>
     */
    #[ORM\ManyToMany(targetEntity: DetalleActividad::class, mappedBy: 'grupos')]
    private Collection $detalleActividades;

    public function __construct()
    {
        $this->userGrupos = new ArrayCollection();
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

    public function getCurso(): ?int
    {
        return $this->curso;
    }

    public function setCurso(int $curso): static
    {
        $this->curso = $curso;

        return $this;
    }

    public function getLetra(): ?string
    {
        return $this->letra;
    }

    public function setLetra(string $letra): static
    {
        $this->letra = $letra;

        return $this;
    }

    public function getNivelEducativo(): ?NivelEducativo
    {
        return $this->nivelEducativo;
    }

    public function setNivelEducativo(?NivelEducativo $nivelEducativo): static
    {
        $this->nivelEducativo = $nivelEducativo;

        return $this;
    }

    /**
     * @return Collection<int, UserGrupo>
     */
    public function getUserGrupos(): Collection
    {
        return $this->userGrupos;
    }

    public function addUserGrupo(UserGrupo $userGrupo): static
    {
        if (!$this->userGrupos->contains($userGrupo)) {
            $this->userGrupos->add($userGrupo);
            $userGrupo->setGrupo($this);
        }

        return $this;
    }

    public function removeUserGrupo(UserGrupo $userGrupo): static
    {
        if ($this->userGrupos->removeElement($userGrupo)) {
            // set the owning side to null (unless already changed)
            if ($userGrupo->getGrupo() === $this) {
                $userGrupo->setGrupo(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nombre ?? 'Grupo sin nombre';
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
            $detalleActividade->addGrupo($this);
        }

        return $this;
    }

    public function removeDetalleActividade(DetalleActividad $detalleActividade): static
    {
        if ($this->detalleActividades->removeElement($detalleActividade)) {
            $detalleActividade->removeGrupo($this);
        }

        return $this;
    }
}
