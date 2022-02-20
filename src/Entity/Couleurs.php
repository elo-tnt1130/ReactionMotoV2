<?php

namespace App\Entity;

use App\Repository\CouleursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CouleursRepository::class)
 */
class Couleurs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lib_couleur;

    /**
     * @ORM\ManyToMany(targetEntity=Modeles::class, mappedBy="couleurs")
     */
    private $modeles;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $img_color;

    public function __construct()
    {
        $this->modeles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibCouleur(): ?string
    {
        return $this->lib_couleur;
    }

    public function setLibCouleur(string $lib_couleur): self
    {
        $this->lib_couleur = $lib_couleur;

        return $this;
    }

    /**
     * @return Collection|Modeles[]
     */
    public function getModeles(): Collection
    {
        return $this->modeles;
    }

    public function addModele(Modeles $modele): self
    {
        if (!$this->modeles->contains($modele)) {
            $this->modeles[] = $modele;
            $modele->addCouleur($this);
        }

        return $this;
    }

    public function removeModele(Modeles $modele): self
    {
        if ($this->modeles->removeElement($modele)) {
            $modele->removeCouleur($this);
        }

        return $this;
    }

    public function getImgColor(): ?string
    {
        return $this->img_color;
    }

    public function setImgColor(?string $img_color): self
    {
        $this->img_color = $img_color;

        return $this;
    }

    public function __toString() {
        return (string) $this->lib_couleur;
    }
}
