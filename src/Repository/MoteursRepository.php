<?php

namespace App\Repository;

use App\Entity\Moteurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Moteurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Moteurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Moteurs[]    findAll()
 * @method Moteurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoteursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Moteurs::class);
    }

    // /**
    //  * @return Moteurs[] Returns an array of Moteurs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Moteurs
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
