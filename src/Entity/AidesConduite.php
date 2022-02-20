<?php

namespace App\Entity;

use App\Repository\AidesConduiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AidesConduiteRepository::class)
 */
class AidesConduite
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
    private $lib_aide_conduite;

    /**
     * @ORM\ManyToMany(targetEntity=Modeles::class, mappedBy="aides_conduite")
     */
    private $modeles;

    public function __construct()
    {
        $this->modeles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibAideConduite(): ?string
    {
        return $this->lib_aide_conduite;
    }

    public function setLibAideConduite(string $lib_aide_conduite): self
    {
        $this->lib_aide_conduite = $lib_aide_conduite;

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
            $modele->addAidesConduite($this);
        }

        return $this;
    }

    public function removeModele(Modeles $modele): self
    {
        if ($this->modeles->removeElement($modele)) {
            $modele->removeAidesConduite($this);
        }

        return $this;
    }

    public function __toString() {
        return (string) $this->lib_aide_conduite;
    }
}
