<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
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
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\OneToMany(targetEntity=ContactUrgence::class, mappedBy="user")
     */
    private $contactUrgence;

    /**
     * @ORM\OneToMany(targetEntity=Handicap::class, mappedBy="user")
     */
    private $handicap;

    public function __construct()
    {
        $this->contactUrgence = new ArrayCollection();
        $this->handicap = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return Collection|ContactUrgence[]
     */
    public function getContactUrgence(): Collection
    {
        return $this->contactUrgence;
    }

    public function addContactUrgence(ContactUrgence $contactUrgence): self
    {
        if (!$this->contactUrgence->contains($contactUrgence)) {
            $this->contactUrgence[] = $contactUrgence;
            $contactUrgence->setUser($this);
        }

        return $this;
    }

    public function removeContactUrgence(ContactUrgence $contactUrgence): self
    {
        if ($this->contactUrgence->removeElement($contactUrgence)) {
            // set the owning side to null (unless already changed)
            if ($contactUrgence->getUser() === $this) {
                $contactUrgence->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Handicap[]
     */
    public function getHandicap(): Collection
    {
        return $this->handicap;
    }

    public function addHandicap(Handicap $handicap): self
    {
        if (!$this->handicap->contains($handicap)) {
            $this->handicap[] = $handicap;
            $handicap->setUser($this);
        }

        return $this;
    }

    public function removeHandicap(Handicap $handicap): self
    {
        if ($this->handicap->removeElement($handicap)) {
            // set the owning side to null (unless already changed)
            if ($handicap->getUser() === $this) {
                $handicap->setUser(null);
            }
        }

        return $this;
    }
}
