<?php

namespace App\Entity;

use App\Repository\HandicapRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HandicapRepository::class)
 */
class Handicap
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $tx_incapacite_perm;

    /**
     * @ORM\Column(type="integer")
     */
    private $num_aggir;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $infosComplementaires;

    /**
     * @ORM\ManyToOne(targetEntity=TypeHandicap::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeHandicap;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="handicap")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $categorieCPAM;

    private $categorieHandicap;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTxIncapacitePerm(): ?int
    {
        return $this->tx_incapacite_perm;
    }

    public function setTxIncapacitePerm(int $tx_incapacite_perm): self
    {
        $this->tx_incapacite_perm = $tx_incapacite_perm;

        return $this;
    }

    public function getNumAggir(): ?int
    {
        return $this->num_aggir;
    }

    public function setNumAggir(int $num_aggir): self
    {
        $this->num_aggir = $num_aggir;

        return $this;
    }

    public function getTypeHandicap(): ?TypeHandicap
    {
        return $this->typeHandicap;
    }

    public function setTypeHandicap(?TypeHandicap $typeHandicap): self
    {
        $this->typeHandicap = $typeHandicap;

        return $this;
    }

    public function getInfosComplementaires(): ?string
    {
        return $this->infosComplementaires;
    }

    public function setInfosComplementaires(?string $infosComplementaires): self
    {
        $this->infosComplementaires = $infosComplementaires;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCategorieCPAM(): ?int
    {
        return $this->categorieCPAM;
    }

    public function setCategorieCPAM(?int $categorieCPAM): self
    {
        $this->categorieCPAM = $categorieCPAM;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategorieHandicap()
    {
        return $this->categorieHandicap;
    }

    /**
     * @param mixed $categorieHandicap
     */
    public function setCategorieHandicap($categorieHandicap): void
    {
        $this->categorieHandicap = $categorieHandicap;
    }


}
