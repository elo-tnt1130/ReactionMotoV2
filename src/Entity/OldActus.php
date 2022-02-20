<?php

namespace App\Entity;

use App\Repository\OldActusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OldActusRepository::class)
 */
class OldActus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lib_actu;

    /**
     * @ORM\Column(type="date")
     */
    private $date_actu;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $bloc_texte;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $img1_actu;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $img2_actu;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $img3_actu;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $video_actu;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $lien_fb_actu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibActu(): ?string
    {
        return $this->lib_actu;
    }

    public function setLibActu(string $lib_actu): self
    {
        $this->lib_actu = $lib_actu;

        return $this;
    }

    public function getDateActu(): ?\DateTimeInterface
    {
        return $this->date_actu;
    }

    public function setDateActu(\DateTimeInterface $date_actu): self
    {
        $this->date_actu = $date_actu;

        return $this;
    }

    public function getBlocTexte(): ?string
    {
        return $this->bloc_texte;
    }

    public function setBlocTexte(?string $bloc_texte): self
    {
        $this->bloc_texte = $bloc_texte;

        return $this;
    }

    public function getImg1Actu(): ?string
    {
        return $this->img1_actu;
    }

    public function setImg1Actu(?string $img1_actu): self
    {
        $this->img1_actu = $img1_actu;

        return $this;
    }

    public function getImg2Actu(): ?string
    {
        return $this->img2_actu;
    }

    public function setImg2Actu(?string $img2_actu): self
    {
        $this->img2_actu = $img2_actu;

        return $this;
    }

    public function getImg3Actu(): ?string
    {
        return $this->img3_actu;
    }

    public function setImg3Actu(?string $img3_actu): self
    {
        $this->img3_actu = $img3_actu;

        return $this;
    }

    public function getVideoActu(): ?string
    {
        return $this->video_actu;
    }

    public function setVideoActu(?string $video_actu): self
    {
        $this->video_actu = $video_actu;

        return $this;
    }

    public function getLienFbActu(): ?string
    {
        return $this->lien_fb_actu;
    }

    public function setLienFbActu(?string $lien_fb_actu): self
    {
        $this->lien_fb_actu = $lien_fb_actu;

        return $this;
    }
}
