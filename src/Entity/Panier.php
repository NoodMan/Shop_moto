<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PanierRepository::class)
 */
class Panier
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
    private $date_p;

    /**
     * @ORM\Column(type="integer")
     */
    private $total;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\OneToMany(targetEntity=MotoPanier::class, mappedBy="panier")
     */
    private $motoPaniers;

    /**
     * @ORM\OneToOne(targetEntity=panier::class, cascade={"persist", "remove"})
     */
    private $commande;

    /**
     * @ORM\OneToMany(targetEntity=Panier::class, mappedBy="user")
     */
    private $paniers;

    public function __construct()
    {
        $this->motoPaniers = new ArrayCollection();
        $this->paniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateP(): ?\DateTimeInterface
    {
        return $this->date_p;
    }

    public function setDateP(\DateTimeInterface $date_p): self
    {
        $this->date_p = $date_p;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * @return Collection<int, MotoPanier>
     */
    public function getMotoPaniers(): Collection
    {
        return $this->motoPaniers;
    }

    public function addMotoPanier(MotoPanier $motoPanier): self
    {
        if (!$this->motoPaniers->contains($motoPanier)) {
            $this->motoPaniers[] = $motoPanier;
            $motoPanier->setPanier($this);
        }

        return $this;
    }

    public function removeMotoPanier(MotoPanier $motoPanier): self
    {
        if ($this->motoPaniers->removeElement($motoPanier)) {
            // set the owning side to null (unless already changed)
            if ($motoPanier->getPanier() === $this) {
                $motoPanier->setPanier(null);
            }
        }

        return $this;
    }

    public function getCommande(): ?panier
    {
        return $this->commande;
    }

    public function setCommande(?panier $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * @return Collection<int, Panier>
     */
    public function getPaniers(): Collection
    {
        return $this->paniers;
    }

    public function addPanier(Panier $panier): self
    {
        if (!$this->paniers->contains($panier)) {
            $this->paniers[] = $panier;
            $panier->setUser($this);
        }

        return $this;
    }

    public function removePanier(Panier $panier): self
    {
        if ($this->paniers->removeElement($panier)) {
            // set the owning side to null (unless already changed)
            if ($panier->getUser() === $this) {
                $panier->setUser(null);
            }
        }

        return $this;
    }
}
