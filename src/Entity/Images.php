<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImagesRepository::class)
 */
class Images
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $lib_img;

    /**
     * @ORM\ManyToOne(targetEntity=Services::class, inversedBy="images")
     */
    private $services;

        /**
     * @ORM\ManyToOne(targetEntity=Services::class, inversedBy="images")
     */
    private $pages;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descr_img;

    public function __construct()
    {
        // $this->pages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibImg(): ?string
    {
        return $this->lib_img;
    }

    public function setLibImg(?string $lib_img): self
    {
        $this->lib_img = $lib_img;

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

    public function getDescrImg(): ?string
    {
        return $this->descr_img;
    }

    public function setDescrImg(?string $descr_img): self
    {
        $this->descr_img = $descr_img;

        return $this;
    }

    public function __toString() {
        return (string) $this->lib_img;
    }

    public function getPages(): ?Pages
    {
        return $this->pages_id;
    }

    public function setPages(?Pages $pages): self
    {
        $this->pages_id = $pages;

        return $this;
    }

}
