<?php

namespace App\Repository;

use App\Entity\ContactUrgence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContactUrgence|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactUrgence|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactUrgence[]    findAll()
 * @method ContactUrgence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactUrgenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactUrgence::class);
    }

    // /**
    //  * @return ContactUrgence[] Returns an array of ContactUrgence objects
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
    public function findOneBySomeField($value): ?ContactUrgence
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
