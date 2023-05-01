<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
// use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column]
    private ?int $budget = null;

    #[ORM\Column(nullable: true)]
    private ?int $renommee = null;

    #[ORM\Column(nullable: true)]
    private ?int $points = null;

    #[ORM\OneToMany(mappedBy: 'entityEquipe', targetEntity: Joueur::class)]
    private Collection $joueurs;

    #[ORM\OneToMany(mappedBy: 'entityEquipe', targetEntity: Manager::class)]
    private Collection $managers;

    #[ORM\OneToOne(mappedBy: 'equipe1', cascade: ['persist', 'remove'])]
    private ?Rencontre $rencontre = null;

    // public function __construct($nom, $ville){
    //     $this->nom = $nom;
    //     $this->ville = $ville;
    //     $this->joueurs = new ArrayCollection();
    //     $this->managers = new ArrayCollection();
    // }

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

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function setBudget(int $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getRenommee(): ?int
    {
        return $this->renommee;
    }

    public function setRenommee(?int $renommee): self
    {
        $this->renommee = $renommee;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(?int $points): self
    {
        $this->points = $points;

        return $this;
    }

    /**
     * @return Collection<int, Joueur>
     */
    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    public function addJoueur(Joueur $joueur): self
    {
        if (!$this->joueurs->contains($joueur)) {
            $this->joueurs->add($joueur);
            $joueur->setEntityEquipe($this);
        }

        return $this;
    }

    public function removeJoueur(Joueur $joueur): self
    {
        if ($this->joueurs->removeElement($joueur)) {
            // set the owning side to null (unless already changed)
            if ($joueur->getEntityEquipe() === $this) {
                $joueur->setEntityEquipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Manager>
     */
    public function getManagers(): Collection
    {
        return $this->managers;
    }

    public function addManager(Manager $manager): self
    {
        if (!$this->managers->contains($manager)) {
            $this->managers->add($manager);
            $manager->setEntityEquipe($this);
        }

        return $this;
    }

    public function removeManager(Manager $manager): self
    {
        if ($this->managers->removeElement($manager)) {
            // set the owning side to null (unless already changed)
            if ($manager->getEntityEquipe() === $this) {
                $manager->setEntityEquipe(null);
            }
        }

        return $this;
    }

    public function getRencontre(): ?Rencontre
    {
        return $this->rencontre;
    }

    public function setRencontre(?Rencontre $rencontre): self
    {
        // unset the owning side of the relation if necessary
        if ($rencontre === null && $this->rencontre !== null) {
            $this->rencontre->setEquipe1(null);
        }

        // set the owning side of the relation if necessary
        if ($rencontre !== null && $rencontre->getEquipe1() !== $this) {
            $rencontre->setEquipe1($this);
        }

        $this->rencontre = $rencontre;

        return $this;
    }
}
