<?php

namespace App\Entity;

use App\Repository\CategorieHandicapRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieHandicapRepository::class)
 */
class CategorieHandicap
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=TypeHandicap::class, mappedBy="categorieHandicap")
     */
    private $typeHan;

    public function __construct()
    {
        $this->typeHan = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|TypeHandicap[]
     */
    public function getTypeHan(): Collection
    {
        return $this->typeHan;
    }

    public function addTypeHan(TypeHandicap $typeHan): self
    {
        if (!$this->typeHan->contains($typeHan)) {
            $this->typeHan[] = $typeHan;
            $typeHan->setCategorieHandicap($this);
        }

        return $this;
    }

    public function removeTypeHan(TypeHandicap $typeHan): self
    {
        if ($this->typeHan->removeElement($typeHan)) {
            // set the owning side to null (unless already changed)
            if ($typeHan->getCategorieHandicap() === $this) {
                $typeHan->setCategorieHandicap(null);
            }
        }

        return $this;
    }
}
