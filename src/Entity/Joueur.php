<?php

namespace App\Entity;

use App\Repository\JoueurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JoueurRepository::class)]
class Joueur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $poste = null;

    #[ORM\Column]
    private ?int $vitesse = null;

    #[ORM\Column]
    private ?int $dribble = null;
    
    #[ORM\Column]
    private ?int $tir = null;

    #[ORM\Column]
    private ?int $renommee = null;

    #[ORM\Column]
    private ?int $salaire = null;

    #[ORM\Column(nullable: true)]
    private ?int $arret = null;

    #[ORM\ManyToOne(inversedBy: 'joueurs')]
    private ?Equipe $entityEquipe = null;


    public function __construct(Equipe $entityEquipe, $nom, $poste, $vitesse, $dribble, $tir, $arret, $renommee, $salaire){
        $this->entityEquipe = $entityEquipe;
        $this->nom = $nom;
        $this->poste = $poste;
        $this->vitesse = $vitesse;
        $this->dribble = $dribble;
        $this->tir = $tir;
        $this->arret = $arret;
        $this->renommee = $renommee;
        $this->salaire = $salaire;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    public function getVitesse(): ?int
    {
        return $this->vitesse;
    }

    public function setVitesse(int $vitesse): self
    {
        $this->vitesse = $vitesse;

        return $this;
    }

    public function getDribble(): ?int
    {
        return $this->dribble;
    }

    public function setDribble(int $dribble): self
    {
        $this->dribble = $dribble;

        return $this;
    }

    public function getRenommee(): ?int
    {
        return $this->renommee;
    }

    public function setRenommee(int $renommee): self
    {
        $this->renommee = $renommee;

        return $this;
    }

    public function getSalaire(): ?int
    {
        return $this->salaire;
    }

    public function setSalaire(int $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getArret(): ?int
    {
        return $this->arret;
    }

    public function setArret(?int $arret): self
    {
        $this->arret = $arret;

        return $this;
    }

    public function getTir(): ?int
    {
        return $this->tir;
    }

    public function setTir(int $tir): self
    {
        $this->tir = $tir;

        return $this;
    }

    public function getEntityEquipe(): ?Equipe
    {
        return $this->entityEquipe;
    }

    public function setEntityEquipe(?Equipe $entityEquipe): self
    {
        $this->entityEquipe = $entityEquipe;

        return $this;
    }
}
