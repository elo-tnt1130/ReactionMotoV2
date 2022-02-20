<?php

namespace App\Entity;

use App\Repository\EtsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtsRepository::class)
 */
class Ets
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $texte_accueil;

    /**
     * @ORM\Column(type="string", length=14)
     */
    private $tel_ets;

    /**
     * @ORM\Column(type="string", length=14, nullable=true)
     */
    private $fax_ets;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $mail1_ets;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $mail2_ets;

    /**
     * @ORM\Column(type="text")
     */
    private $horaires;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $adresse_ets;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $cp_ets;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $ville_ets;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexteAccueil(): ?string
    {
        return $this->texte_accueil;
    }

    public function setTexteAccueil(string $texte_accueil): self
    {
        $this->texte_accueil = $texte_accueil;

        return $this;
    }

    public function getTelEts(): ?string
    {
        return $this->tel_ets;
    }

    public function setTelEts(string $tel_ets): self
    {
        $this->tel_ets = $tel_ets;

        return $this;
    }

    public function getFaxEts(): ?string
    {
        return $this->fax_ets;
    }

    public function setFaxEts(?string $fax_ets): self
    {
        $this->fax_ets = $fax_ets;

        return $this;
    }

    public function getMail1Ets(): ?string
    {
        return $this->mail1_ets;
    }

    public function setMail1Ets(string $mail1_ets): self
    {
        $this->mail1_ets = $mail1_ets;

        return $this;
    }

    public function getMail2Ets(): ?string
    {
        return $this->mail2_ets;
    }

    public function setMail2Ets(?string $mail2_ets): self
    {
        $this->mail2_ets = $mail2_ets;

        return $this;
    }

    public function getHoraires(): ?string
    {
        return $this->horaires;
    }

    public function setHoraires(string $horaires): self
    {
        $this->horaires = $horaires;

        return $this;
    }

    public function getAdresseEts(): ?string
    {
        return $this->adresse_ets;
    }

    public function setAdresseEts(string $adresse_ets): self
    {
        $this->adresse_ets = $adresse_ets;

        return $this;
    }

    public function getCpEts(): ?string
    {
        return $this->cp_ets;
    }

    public function setCpEts(string $cp_ets): self
    {
        $this->cp_ets = $cp_ets;

        return $this;
    }

    public function getVilleEts(): ?string
    {
        return $this->ville_ets;
    }

    public function setVilleEts(string $ville_ets): self
    {
        $this->ville_ets = $ville_ets;

        return $this;
    }
}
