<?php

namespace App\DataFixtures;

use App\Entity\Manager;
use App\Entity\Equipe;
use App\Entity\Joueur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use \Faker\Factory;

class ManagerFixtures extends Fixture
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $om): void
    {
        // $product = new Product();
        // $om->persist($product);
        for ($i = 0; $i < 20; $i++) {
            $this->createAll($om);
            $om->flush();
        }
    }

    private function createAll(EntityManager $em)
    {
        $manageRole = ["Directeur Général", "Directeur Sportif", "Directeur des Médias", "Entraineur", "Suppléant"];
        $equipe = $this->getEquipe();
        for ($i = 0; $i < 5; $i++) {
            $avant = $this->getAvant($equipe);
            $em->persist($avant);
        }
        for ($i = 0; $i < 7; $i++) {
            $milieu = $this->getMilieu($equipe);
            $arriere = $this->getArriere($equipe);
            $em->persist($milieu);
            $em->persist($arriere);
        }
        for ($i = 0; $i < 3; $i++) {
            $goal = $this->getGoal($equipe);
            $em->persist($goal);
        }

        for ($i = 0; $i < 5; $i++) {
            $role =  $this->faker->randomElement($manageRole);
            $manager = $this->getManager($equipe,  $role);
            $em->persist($manager);
            unset($manageRole[array_search($role, $manageRole)]);
        }

        $em->persist($equipe);
    }

    private function getManager(Equipe $equipe, $role)
    {
        return new Manager(
            $equipe,
            $this->faker->name(),
            $role,
            $this->faker->numberBetween(12500, 34800)
        );
    }




    private function getAvant(Equipe $equipe)
    {
        return new Joueur(
            $equipe,
            $this->faker->name($gender = 'male'),
            $poste = "Avant",
            $this->vitesse($poste),
            $this->dribble($poste),
            $this->tir($poste),
            $this->goal($poste),
            $this->faker->numberBetween(20, 100),
            $this->faker->numberBetween(150000, 1000000),
        );
    }
    private function getMilieu(Equipe $equipe)
    {
        return new Joueur(
            $equipe,
            $this->faker->name($gender = 'male'),
            $poste = "Milieu",
            $this->vitesse($poste),
            $this->dribble($poste),
            $this->tir($poste),
            $this->goal($poste),
            $this->faker->numberBetween(20, 100),
            $this->faker->numberBetween(150000, 1000000),
        );
    }

    private function getArriere(Equipe $equipe)
    {
        return new Joueur(
            $equipe,
            $this->faker->name($gender = 'male'),
            $poste = "Arrière",
            $this->vitesse($poste),
            $this->dribble($poste),
            $this->tir($poste),
            $this->goal($poste),
            $this->faker->numberBetween(20, 100),
            $this->faker->numberBetween(150000, 1000000),
        );
    }

    private function getGoal(Equipe $equipe)
    {
        return new Joueur(
            $equipe,
            $this->faker->name($gender = 'male'),
            $poste = "Goal",
            $this->vitesse($poste),
            $this->dribble($poste),
            $this->tir($poste),
            $this->goal($poste),
            $renomGoal = $this->faker->numberBetween(20, 100),
            $this->faker->numberBetween(150000, 1000000),
        );
    }


    public function goal($poste)
    {
        if ($poste == "Goal") {
            return $this->faker->numberBetween(50, 100);
        }
    }

    public function vitesse($poste)
    {
        if ($poste == "Avant") {
            return $this->faker->numberBetween(70, 100);
        } else if ($poste == "Milieu") {
            return $this->faker->numberBetween(50, 80);
        } else if ($poste == "Arrière") {
            return $this->faker->numberBetween(40, 70);
        } else if ($poste == "Goal") {
            return $this->faker->numberBetween(20, 50);
        }
    }

    public function dribble($poste)
    {
        if ($poste == "Avant") {
            return $this->faker->numberBetween(70, 100);
        } else if ($poste == "Milieu") {
            return $this->faker->numberBetween(50, 80);
        } else if ($poste == "Arrière") {
            return $this->faker->numberBetween(40, 70);
        } else {
            return $this->faker->numberBetween(20, 50);
        }
    }

    public function tir($poste)
    {
        if ($poste == "Avant") {
            return $this->faker->numberBetween(70, 100);
        } else if ($poste == "Milieu") {
            return $this->faker->numberBetween(50, 80);
        } else if ($poste == "Arrière") {
            return $this->faker->numberBetween(40, 70);
        } else {
            return $this->faker->numberBetween(20, 50);
        }
    }

    public function getRenom($renomGoal){
        $renom = $renomGoal;
        return $renom;
    }

    private function getEquipe()
    {
        $ville = $this->faker->city();
        return new Equipe(
            $this->faker->randomElement(["Football club de ", "Olympique de ", "Association sportive de ", "Association carritative de ", "Racing club de ", "Stade de "]) . $ville,
            $ville,
        );
    }
}
