<?php

namespace App\Repository;

use App\Entity\AidesConduite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AidesConduite|null find($id, $lockMode = null, $lockVersion = null)
 * @method AidesConduite|null findOneBy(array $criteria, array $orderBy = null)
 * @method AidesConduite[]    findAll()
 * @method AidesConduite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AidesConduiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AidesConduite::class);
    }

    // /**
    //  * @return AidesConduite[] Returns an array of AidesConduite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AidesConduite
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
