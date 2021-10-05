<?php

namespace App\Entity;

use App\Repository\TypeHandicapRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeHandicapRepository::class)
 */
class TypeHandicap
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
     * @ORM\ManyToOne(targetEntity=CategorieHandicap::class, inversedBy="typeHan")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorieHandicap;

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

    public function getCategorieHandicap(): ?CategorieHandicap
    {
        return $this->categorieHandicap;
    }

    public function setCategorieHandicap(?CategorieHandicap $categorieHandicap): self
    {
        $this->categorieHandicap = $categorieHandicap;

        return $this;
    }
}
