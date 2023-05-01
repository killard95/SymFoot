<?php

namespace App\Repository;

use App\Entity\Equipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Equipe>
 *
 * @method Equipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Equipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Equipe[]    findAll()
 * @method Equipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Equipe::class);
    }

    public function save(Equipe $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Equipe $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getRenommee()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT SUM(joueur.renommee) As renommee, equipe.nom
            FROM equipe
            INNER JOIN joueur ON joueur.entity_equipe_id = equipe.id
            GROUP BY equipe.nom
            ';
            $stmt = $conn->prepare($sql);
            $result = $stmt->executeQuery();

            return $result->fetchFirstColumn();
    }

    public function getBudget()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT (SUM(joueur.salaire) + SUM(manager.salaire)) AS budget, equipe.nom
            FROM equipe
            INNER JOIN joueur ON joueur.entity_equipe_id = equipe.id
            INNER JOIN manager ON manager.entity_equipe_id = equipe.id
            GROUP BY equipe.nom
            ';
            $stmt = $conn->prepare($sql);
            $result = $stmt->executeQuery();

            return $result->fetchFirstColumn();
    }

//    /**
//     * @return Equipe[] Returns an array of Equipe objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Equipe
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
