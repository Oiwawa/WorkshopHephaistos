<?php

namespace App\Repository;

use App\Entity\CategorieHandicap;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategorieHandicap|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieHandicap|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieHandicap[]    findAll()
 * @method CategorieHandicap[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieHandicapRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieHandicap::class);
    }

    // /**
    //  * @return CategorieHandicap[] Returns an array of CategorieHandicap objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategorieHandicap
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
