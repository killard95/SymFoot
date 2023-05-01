<?php

namespace App\Entity;

use App\Repository\ManagerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ManagerRepository::class)]
class Manager
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\Column]
    private ?int $salaire = null;

    #[ORM\ManyToOne(inversedBy: 'managers')]
    private ?Equipe $entityEquipe = null;

    public function __construct(Equipe $equipe, $nom, $role, $salaire){
        $this->entityEquipe = $equipe;
        $this->nom = $nom;
        $this->role = $role;
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

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

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
