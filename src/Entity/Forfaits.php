<?php

namespace App\Entity;

use App\Repository\ForfaitsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ForfaitsRepository::class)
 */
class Forfaits
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $lib_forfait;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descr_forfait;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_forfait;

    /**
     * @ORM\ManyToOne(targetEntity=Services::class, inversedBy="forfaits")
     */
    private $services;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibForfait(): ?string
    {
        return $this->lib_forfait;
    }

    public function setLibForfait(string $lib_forfait): self
    {
        $this->lib_forfait = $lib_forfait;

        return $this;
    }

    public function getDescrForfait(): ?string
    {
        return $this->descr_forfait;
    }

    public function setDescrForfait(?string $descr_forfait): self
    {
        $this->descr_forfait = $descr_forfait;

        return $this;
    }

    public function getPrixForfait(): ?float
    {
        return $this->prix_forfait;
    }

    public function setPrixForfait(float $prix_forfait): self
    {
        $this->prix_forfait = $prix_forfait;

        return $this;
    }

    public function getServices(): ?Services
    {
        return $this->services;
    }

    public function setServices(?Services $services): self
    {
        $this->services = $services;

        return $this;
    }
}
