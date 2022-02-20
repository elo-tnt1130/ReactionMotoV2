<?php

namespace App\Repository;

use App\Entity\OldActus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OldActus|null find($id, $lockMode = null, $lockVersion = null)
 * @method OldActus|null findOneBy(array $criteria, array $orderBy = null)
 * @method OldActus[]    findAll()
 * @method OldActus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OldActusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OldActus::class);
    }

    // /**
    //  * @return OldActus[] Returns an array of OldActus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OldActus
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
