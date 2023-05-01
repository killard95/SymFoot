<?php

namespace App\Repository;

use App\Entity\Joueur;
use App\Entity\Equipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
// use Doctrine\ORM\EntityManager;


/**
 * @extends ServiceEntityRepository<Joueur>
 *
 * @method Joueur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Joueur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Joueur[]    findAll()
 * @method Joueur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JoueurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Joueur::class);
    }

    public function save(Joueur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Joueur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getNomEquipe()  
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT equipe.nom FROM joueur
            INNER JOIN equipe ON equipe.id = joueur.entity_equipe_id
            WHERE equipe.id = joueur.entity_equipe_id
            ';
            $stmt = $conn->prepare($sql);
            $result = $stmt->executeQuery();

            return $result->fetchFirstColumn();
    }

    public function getAvant()  
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM joueur
            INNER JOIN equipe ON equipe.id = joueur.entity_equipe_id
            WHERE poste LIKE "Avant"
            ';
            $stmt = $conn->prepare($sql);
            $result = $stmt->executeQuery();

            return $result->fetchAll();
    }

    public function getMilieu()  
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM joueur
            INNER JOIN equipe ON equipe.id = joueur.entity_equipe_id
            WHERE poste LIKE "Milieu"
            ';
            $stmt = $conn->prepare($sql);
            $result = $stmt->executeQuery();

            return $result->fetchAll();
    }

    public function getArriere()  
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM joueur
            INNER JOIN equipe ON equipe.id = joueur.entity_equipe_id
            WHERE poste LIKE "Arriere"
            ';
            $stmt = $conn->prepare($sql);
            $result = $stmt->executeQuery();

            return $result->fetchAll();
    }
    public function getGoal()  
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT  joueur.nom, joueur.poste, joueur.vitesse, joueur.dribble, joueur.tir, joueur.renommee, joueur.salaire, joueur.arret FROM joueur
            INNER JOIN equipe ON equipe.id = joueur.entity_equipe_id
            WHERE poste LIKE "Goal"
            ';
            $stmt = $conn->prepare($sql);
            $result = $stmt->executeQuery();

            return $result->fetchAll();
    }

//    /**
//     * @return Joueur[] Returns an array of Joueur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Joueur
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
