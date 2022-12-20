<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_c;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status_commande;

    /**
     * @ORM\Column(type="boolean")
     */
    private $retrait;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="commande")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="adresse")
     */
    private $com_adresse;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="adresse")
     */
    private $fac_adresse;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->com_adresse = new ArrayCollection();
        $this->fac_adresse = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateC(): ?\DateTimeInterface
    {
        return $this->date_c;
    }

    public function setDateC(\DateTimeInterface $date_c): self
    {
        $this->date_c = $date_c;

        return $this;
    }

    public function isStatusCommande(): ?bool
    {
        return $this->status_commande;
    }

    public function setStatusCommande(bool $status_commande): self
    {
        $this->status_commande = $status_commande;

        return $this;
    }

    public function isRetrait(): ?bool
    {
        return $this->retrait;
    }

    public function setRetrait(bool $retrait): self
    {
        $this->retrait = $retrait;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCommande($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCommande() === $this) {
                $user->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getComAdresse(): Collection
    {
        return $this->com_adresse;
    }

    public function addComAdresse(Commande $comAdresse): self
    {
        if (!$this->com_adresse->contains($comAdresse)) {
            $this->com_adresse[] = $comAdresse;
            $comAdresse->setAdresse($this);
        }

        return $this;
    }

    public function removeComAdresse(Commande $comAdresse): self
    {
        if ($this->com_adresse->removeElement($comAdresse)) {
            // set the owning side to null (unless already changed)
            if ($comAdresse->getAdresse() === $this) {
                $comAdresse->setAdresse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getFacAdresse(): Collection
    {
        return $this->fac_adresse;
    }

    public function addFacAdresse(Commande $facAdresse): self
    {
        if (!$this->fac_adresse->contains($facAdresse)) {
            $this->fac_adresse[] = $facAdresse;
            $facAdresse->setAdresse($this);
        }

        return $this;
    }

    public function removeFacAdresse(Commande $facAdresse): self
    {
        if ($this->fac_adresse->removeElement($facAdresse)) {
            // set the owning side to null (unless already changed)
            if ($facAdresse->getAdresse() === $this) {
                $facAdresse->setAdresse(null);
            }
        }

        return $this;
    }
}
