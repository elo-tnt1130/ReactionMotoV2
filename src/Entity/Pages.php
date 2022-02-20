<?php

namespace App\Entity;

use App\Repository\PagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PagesRepository::class)
 */
class Pages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $lib_page;

    /**
     * @ORM\Column(type="text")
     */
    private $bloc1;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $bloc2;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $bloc3;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $bloc4;

    /**
     * @ORM\ManyToOne(targetEntity=Services::class, inversedBy="pages")
     */
    private $services;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $metadescr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $metakw;

    public function __construct()
    {
        // $this->services = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibPage(): ?string
    {
        return $this->lib_page;
    }

    public function setLibPage(string $lib_page): self
    {
        $this->lib_page = $lib_page;

        return $this;
    }

    public function getBloc1(): ?string
    {
        return $this->bloc1;
    }

    public function setBloc1(string $bloc1): self
    {
        $this->bloc1 = $bloc1;

        return $this;
    }

    public function getBloc2(): ?string
    {
        return $this->bloc2;
    }

    public function setBloc2(?string $bloc2): self
    {
        $this->bloc2 = $bloc2;

        return $this;
    }

    public function getBloc3(): ?string
    {
        return $this->bloc3;
    }

    public function setBloc3(?string $bloc3): self
    {
        $this->bloc3 = $bloc3;

        return $this;
    }

    public function getBloc4(): ?string
    {
        return $this->bloc4;
    }

    public function setBloc4(?string $bloc4): self
    {
        $this->bloc4 = $bloc4;

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

    public function getMetadescr(): ?string
    {
        return $this->metadescr;
    }

    public function setMetadescr(?string $metadescr): self
    {
        $this->metadescr = $metadescr;

        return $this;
    }

    public function getMetakw(): ?string
    {
        return $this->metakw;
    }

    public function setMetakw(?string $metakw): self
    {
        $this->metakw = $metakw;

        return $this;
    }
}