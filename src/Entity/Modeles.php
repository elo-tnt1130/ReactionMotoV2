<?php

namespace App\Entity;

use App\Repository\ModelesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModelesRepository::class)
 */
class Modeles
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
    private $lib_modele;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descr_neuf;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_moto;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $longueur_neuf;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $largeur_neuf;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hauteur_selle_neuf;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $conso_neuf;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $fiche_technique_neuf;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $img1_moto;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $img2_moto;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $img3_moto;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $img4_moto;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descr_occasion;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $lien_occasion;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $travaux_occasion;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $kilometrage_occasion;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $equipements_occasion;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $check_occasion;

    /**
     * @ORM\ManyToOne(targetEntity=Marques::class, inversedBy="modeles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $marque;

    /**
     * @ORM\ManyToOne(targetEntity=Moteurs::class, inversedBy="modeles")
     * @ORM\JoinColumn(nullable=true)
     */
    private $moteur;

    /**
     * @ORM\ManyToOne(targetEntity=Permis::class, inversedBy="modeles")
     * @ORM\JoinColumn(nullable=true)
     */
    private $permis;

    /**
     * @ORM\ManyToMany(targetEntity=Couleurs::class, inversedBy="modeles")
     */
    private $couleurs;

    /**
     * @ORM\ManyToMany(targetEntity=AidesConduite::class, inversedBy="modeles")
     */
    private $aides_conduite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $poids_neuf;

    public function __construct()
    {
        $this->couleurs = new ArrayCollection();

        $this->aides_conduite = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibModele(): ?string
    {
        return $this->lib_modele;
    }

    public function setLibModele(string $lib_modele): self
    {
        $this->lib_modele = $lib_modele;

        return $this;
    }

    public function getDescrNeuf(): ?string
    {
        return $this->descr_neuf;
    }

    public function setDescrNeuf(?string $descr_neuf): self
    {
        $this->descr_neuf = $descr_neuf;

        return $this;
    }

    public function getPrixMoto(): ?float
    {
        return $this->prix_moto;
    }

    public function setPrixMoto(float $prix_moto): self
    {
        $this->prix_moto = $prix_moto;

        return $this;
    }

    public function getLongueurNeuf(): ?int
    {
        return $this->longueur_neuf;
    }

    public function setLongueurNeuf(?int $longueur_neuf): self
    {
        $this->longueur_neuf = $longueur_neuf;

        return $this;
    }

    public function getLargeurNeuf(): ?int
    {
        return $this->largeur_neuf;
    }

    public function setLargeurNeuf(?int $largeur_neuf): self
    {
        $this->largeur_neuf = $largeur_neuf;

        return $this;
    }

    public function getHauteurSelleNeuf(): ?int
    {
        return $this->hauteur_selle_neuf;
    }

    public function setHauteurSelleNeuf(?int $hauteur_selle_neuf): self
    {
        $this->hauteur_selle_neuf = $hauteur_selle_neuf;

        return $this;
    }

    public function getConsoNeuf(): ?float
    {
        return $this->conso_neuf;
    }

    public function setConsoNeuf(?float $conso_neuf): self
    {
        $this->conso_neuf = $conso_neuf;

        return $this;
    }

    public function getFicheTechniqueNeuf(): ?string
    {
        return $this->fiche_technique_neuf;
    }

    public function setFicheTechniqueNeuf(?string $fiche_technique_neuf): self
    {
        $this->fiche_technique_neuf = $fiche_technique_neuf;

        return $this;
    }

    public function getImg1Moto(): ?string
    {
        return $this->img1_moto;
    }

    public function setImg1Moto(?string $img1_moto): self
    {
        $this->img1_moto = $img1_moto;

        return $this;
    }

    public function getImg2Moto(): ?string
    {
        return $this->img2_moto;
    }

    public function setImg2Moto(?string $img2_moto): self
    {
        $this->img2_moto = $img2_moto;

        return $this;
    }

    public function getImg3Moto(): ?string
    {
        return $this->img3_moto;
    }

    public function setImg3Moto(?string $img3_moto): self
    {
        $this->img3_moto = $img3_moto;

        return $this;
    }

    public function getImg4Moto(): ?string
    {
        return $this->img4_moto;
    }

    public function setImg4Moto(?string $img4_moto): self
    {
        $this->img4_moto = $img4_moto;

        return $this;
    }

    public function getDescrOccasion(): ?string
    {
        return $this->descr_occasion;
    }

    public function setDescrOccasion(?string $descr_occasion): self
    {
        $this->descr_occasion = $descr_occasion;

        return $this;
    }

    public function getLienOccasion(): ?string
    {
        return $this->lien_occasion;
    }

    public function setLienOccasion(string $lien_occasion): self
    {
        $this->lien_occasion = $lien_occasion;

        return $this;
    }

    public function getTravauxOccasion(): ?string
    {
        return $this->travaux_occasion;
    }

    public function setTravauxOccasion(?string $travaux_occasion): self
    {
        $this->travaux_occasion = $travaux_occasion;

        return $this;
    }

    public function getKilometrageOccasion(): ?string
    {
        return $this->kilometrage_occasion;
    }

    public function setKilometrageOccasion(?string $kilometrage_occasion): self
    {
        $this->kilometrage_occasion = $kilometrage_occasion;

        return $this;
    }

    public function getEquipementsOccasion(): ?string
    {
        return $this->equipements_occasion;
    }

    public function setEquipementsOccasion(?string $equipements_occasion): self
    {
        $this->equipements_occasion = $equipements_occasion;

        return $this;
    }

    public function getCheckOccasion(): ?bool
    {
        return $this->check_occasion;
    }

    public function setCheckOccasion(?bool $check_occasion): self
    {
        $this->check_occasion = $check_occasion;

        return $this;
    }

    public function getMarque(): ?Marques
    {
        return $this->marque;
    }

    public function setMarque(?Marques $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getMoteur(): ?Moteurs
    {
        return $this->moteur;
    }

    public function setMoteur(?Moteurs $moteur): self
    {
        $this->moteur = $moteur;

        return $this;
    }

    public function getPermis(): ?Permis
    {
        return $this->permis;
    }

    public function setPermis(?Permis $permis): self
    {
        $this->permis = $permis;

        return $this;
    }

    /**
     * @return Collection|Couleurs[]
     */
    public function getCouleurs(): Collection
    {
        return $this->couleurs;
    }

    public function addCouleur(Couleurs $couleur): self
    {
        if (!$this->couleurs->contains($couleur)) {
            $this->couleurs[] = $couleur;
        }

        return $this;
    }

    public function removeCouleur(Couleurs $couleur): self
    {
        $this->couleurs->removeElement($couleur);

        return $this;
    }

    /**
     * @return Collection|AidesConduite[]
     */
    public function getAidesConduite(): Collection
    {
        return $this->aides_conduite;
    }

    public function addAidesConduite(AidesConduite $aidesConduite): self
    {
        if (!$this->aides_conduite->contains($aidesConduite)) {
            $this->aides_conduite[] = $aidesConduite;
        }

        return $this;
    }

    public function removeAidesConduite(AidesConduite $aidesConduite): self
    {
        $this->aides_conduite->removeElement($aidesConduite);

        return $this;
    }

    public function getPoidsNeuf(): ?int
    {
        return $this->poids_neuf;
    }

    public function setPoidsNeuf(?int $poids_neuf): self
    {
        $this->poids_neuf = $poids_neuf;

        return $this;
    }


}
