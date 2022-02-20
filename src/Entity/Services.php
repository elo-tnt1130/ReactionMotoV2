<?php

namespace App\Entity;

use App\Repository\ServicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServicesRepository::class)
 */
class Services
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
    private $lib_service;

    /**
     * @ORM\OneToMany(targetEntity=Forfaits::class, mappedBy="services")
     */
    private $forfaits;

    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="services")
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity=Pages::class, mappedBy="services")
     */
    private $pages;

    public function __construct()
    {
        $this->forfaits = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->pages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibService(): ?string
    {
        return $this->lib_service;
    }

    public function setLibService(string $lib_service): self
    {
        $this->lib_service = $lib_service;

        return $this;
    }

    /**
     * @return Collection|Forfaits[]
     */
    public function getForfaits(): Collection
    {
        return $this->forfaits;
    }

    public function addForfait(Forfaits $forfait): self
    {
        if (!$this->forfaits->contains($forfait)) {
            $this->forfaits[] = $forfait;
            $forfait->setServices($this);
        }

        return $this;
    }

    public function removeForfait(Forfaits $forfait): self
    {
        if ($this->forfaits->removeElement($forfait)) {
            // set the owning side to null (unless already changed)
            if ($forfait->getServices() === $this) {
                $forfait->setServices(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Images[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setServices($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getServices() === $this) {
                $image->setServices(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return (string) $this->lib_service;
    }

    /**
     * @return Collection|Pages[]
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(Pages $page): self
    {
        if (!$this->pages->contains($page)) {
            $this->pages[] = $page;
            $page->setServices($this);
        }

        return $this;
    }

    public function removePage(Pages $page): self
    {
        if ($this->pages->removeElement($page)) {
            // set the owning side to null (unless already changed)
            if ($page->getServices() === $this) {
                $page->setServices(null);
            }
        }

        return $this;
    }
}
