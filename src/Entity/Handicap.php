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
    private $info_complementaires;

    /**
     * @ORM\ManyToOne(targetEntity=TypeHandicap::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeHandicap;


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

    public function getInfoComplementaires(): ?string
    {
        return $this->info_complementaires;
    }

    public function setInfoComplementaires(?string $info_complementaires): self
    {
        $this->info_complementaires = $info_complementaires;

        return $this;
    }
}
