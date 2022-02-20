<?php

namespace App\Entity;

use App\Repository\ThemesFAQRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ThemesFAQRepository::class)
 */
class ThemesFAQ
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
    private $theme_question;

    /**
     * @ORM\OneToMany(targetEntity=FAQ::class, mappedBy="theme_FAQ")
     */
    private $fAQs;

    public function __construct()
    {
        $this->fAQs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getThemeQuestion(): ?string
    {
        return $this->theme_question;
    }

    public function setThemeQuestion(string $theme_question): self
    {
        $this->theme_question = $theme_question;

        return $this;
    }

    /**
     * @return Collection|FAQ[]
     */
    public function getFAQs(): Collection
    {
        return $this->fAQs;
    }

    public function addFAQ(FAQ $fAQ): self
    {
        if (!$this->fAQs->contains($fAQ)) {
            $this->fAQs[] = $fAQ;
            $fAQ->setThemeFAQ($this);
        }

        return $this;
    }

    public function removeFAQ(FAQ $fAQ): self
    {
        if ($this->fAQs->removeElement($fAQ)) {
            // set the owning side to null (unless already changed)
            if ($fAQ->getThemeFAQ() === $this) {
                $fAQ->setThemeFAQ(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return (string) $this->theme_question;
    }
}
