<?php

namespace App\Entity;

use App\Repository\MoteursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MoteursRepository::class)
 */
class Moteurs
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
    private $cylindree;

    /**
     * @ORM\Column(type="float", length=5, nullable=true)
     */
    private $puissance_ch;

    /**
     * @ORM\Column(type="float", length=5, nullable=true)
     */
    private $couple_nm;

    /**
     * @ORM\OneToMany(targetEntity=Modeles::class, mappedBy="moteur")
     */
    private $modeles;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $RegimeMoteurPuissance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $RegimeMoteurCouple;

    public function __construct()
    {
        $this->modeles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCylindree(): ?int
    {
        return $this->cylindree;
    }

    public function setCylindree(int $cylindree): self
    {
        $this->cylindree = $cylindree;

        return $this;
    }

    public function getPuissanceCh(): ?string
    {
        return $this->puissance_ch;
    }

    public function setPuissanceCh(?string $puissance_ch): self
    {
        $this->puissance_ch = $puissance_ch;

        return $this;
    }

    public function getCoupleNm(): ?string
    {
        return $this->couple_nm;
    }

    public function setCoupleNm(?string $couple_nm): self
    {
        $this->couple_nm = $couple_nm;

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
            $modele->setMoteur($this);
        }

        return $this;
    }

    public function removeModele(Modeles $modele): self
    {
        if ($this->modeles->removeElement($modele)) {
            // set the owning side to null (unless already changed)
            if ($modele->getMoteur() === $this) {
                $modele->setMoteur(null);
            }
        }

        return $this;
    }

    public function getRegimeMoteurPuissance(): ?int
    {
        return $this->RegimeMoteurPuissance;
    }

    public function setRegimeMoteurPuissance($RegimeMoteurPuissance)
    {
        $this->RegimeMoteurPuissance = $RegimeMoteurPuissance;

        return $this;
    }

    public function getRegimeMoteurCouple(): ?int
    {
        return $this->RegimeMoteurCouple;
    }

    public function setRegimeMoteurCouple($RegimeMoteurCouple)
    {
        $this->RegimeMoteurCouple = $RegimeMoteurCouple;

        return $this;
    }

    public function __toString() {
        return (string) $this->cylindree. ' ('. $this->puissance_ch . 'ch)';
    }
}
