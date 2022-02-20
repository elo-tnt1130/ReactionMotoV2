<?php

namespace App\Repository;

use App\Entity\Ets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ets|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ets|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ets[]    findAll()
 * @method Ets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ets::class);
    }

    /**
    * @return Ets[] Returns an array of Ets objects
    * SELECT e.* 
    * FROM ets e
    * WHERE e.id = id
    * ORBER BY e.id ASC
    */

    // public function findById($value)
    // {
    //     return $this->createQueryBuilder('e')
    //         ->andWhere('e.id = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('e.id', 'ASC')
    //         // ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }


    // /**
    //  * @return Ets[] Returns an array of Ets objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ets
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
