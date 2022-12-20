<?php

namespace App\Entity;

use App\Repository\MotoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MotoRepository::class)
 */
class Moto
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
    private $Titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Description;

    /**
     * @ORM\Column(type="integer")
     */
    private $KM;

    /**
     * @ORM\Column(type="integer")
     */
    private $Prix;

    /**
     * @ORM\Column(type="date")
     */
    private $DateImat;

    /**
     * @ORM\Column(type="integer")
     */
    private $Puissance;

    /**
     * @ORM\ManyToOne(targetEntity=Photo::class, inversedBy="motos")
     */
    private $photo;

    /**
     * @ORM\OneToMany(targetEntity=Moto::class, mappedBy="marque")
     */
    private $motos;

    /**
     * @ORM\OneToMany(targetEntity=MotoPanier::class, mappedBy="moto")
     */
    private $motoPaniers;

    public function __construct()
    {
        $this->motos = new ArrayCollection();
        $this->motoPaniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getKM(): ?int
    {
        return $this->KM;
    }

    public function setKM(int $KM): self
    {
        $this->KM = $KM;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->Prix;
    }

    public function setPrix(int $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getDateImat(): ?\DateTimeInterface
    {
        return $this->DateImat;
    }

    public function setDateImat(\DateTimeInterface $DateImat): self
    {
        $this->DateImat = $DateImat;

        return $this;
    }

    public function getPuissance(): ?int
    {
        return $this->Puissance;
    }

    public function setPuissance(int $Puissance): self
    {
        $this->Puissance = $Puissance;

        return $this;
    }

    public function getPhoto(): ?photo
    {
        return $this->photo;
    }

    public function setPhoto(?photo $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, Moto>
     */
    public function getMotos(): Collection
    {
        return $this->motos;
    }

    public function addMoto(Moto $moto): self
    {
        if (!$this->motos->contains($moto)) {
            $this->motos[] = $moto;
            $moto->setMarque($this);
        }

        return $this;
    }

    public function removeMoto(Moto $moto): self
    {
        if ($this->motos->removeElement($moto)) {
            // set the owning side to null (unless already changed)
            if ($moto->getMarque() === $this) {
                $moto->setMarque(null);
            }
        }

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
            $motoPanier->setMoto($this);
        }

        return $this;
    }

    public function removeMotoPanier(MotoPanier $motoPanier): self
    {
        if ($this->motoPaniers->removeElement($motoPanier)) {
            // set the owning side to null (unless already changed)
            if ($motoPanier->getMoto() === $this) {
                $motoPanier->setMoto(null);
            }
        }

        return $this;
    }
}
