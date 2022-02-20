<?php

namespace App\Entity;

use App\Repository\MarquesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarquesRepository::class)
 */
class Marques
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
    private $lib_marque;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descr_marque;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $resume_marque;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $logo_marque;

    /**
     * @ORM\OneToMany(targetEntity=Modeles::class, mappedBy="marque")
     */
    private $modeles;

    public function __construct()
    {
        $this->modeles = new ArrayCollection();
        $this->modeles_branded = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibMarque(): ?string
    {
        return $this->lib_marque;
    }

    public function setLibMarque(string $lib_marque): self
    {
        $this->lib_marque = $lib_marque;

        return $this;
    }

    public function getDescrMarque(): ?string
    {
        return $this->descr_marque;
    }

    public function setDescrMarque(?string $descr_marque): self
    {
        $this->descr_marque = $descr_marque;

        return $this;
    }

    public function getResumeMarque(): ?string
    {
        return $this->resume_marque;
    }

    public function setResumeMarque(?string $resume_marque): self
    {
        $this->resume_marque = $resume_marque;

        return $this;
    }

    public function getLogoMarque(): ?string
    {
        return $this->logo_marque;
    }

    public function setLogoMarque(?string $logo_marque): self
    {
        $this->logo_marque = $logo_marque;

        return $this;
    }

    /**
     * @return Collection|Modeles[]
     */
    public function getModeles(): Collection
    {
        return $this->modeles;
    }

    public function __toString() {
        return (string) $this->lib_marque;
    }

}
