<?php

namespace App\Entity;

use App\Repository\PermisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PermisRepository::class)
 */
class Permis
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $lib_permis;

    /**
     * @ORM\OneToMany(targetEntity=Modeles::class, mappedBy="permis")
     */
    private $modeles;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $symbole_permis;

    public function __construct()
    {
        $this->modeles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibPermis(): ?string
    {
        return $this->lib_permis;
    }

    public function setLibPermis(string $lib_permis): self
    {
        $this->lib_permis = $lib_permis;

        return $this;
    }

    /**
     * @return Collection|Modeles[]
     */
    public function getModeles(): Collection
    {
        return $this->modeles;
    }

    // public function addModele(Modeles $modele): self
    // {
    //     if (!$this->modeles->contains($modele)) {
    //         $this->modeles[] = $modele;
    //         $modele->setPermis($this);
    //     }

    //     return $this;
    // }

    // public function removeModele(Modeles $modele): self
    // {
    //     if ($this->modeles->removeElement($modele)) {
    //         // set the owning side to null (unless already changed)
    //         if ($modele->getPermis() === $this) {
    //             $modele->setPermis(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getSymbolePermis(): ?string
    {
        return $this->symbole_permis;
    }

    public function setSymbolePermis(?string $symbole_permis): self
    {
        $this->symbole_permis = $symbole_permis;

        return $this;
    }

    public function __toString() {
        return (string) $this->lib_permis;
    }
}
