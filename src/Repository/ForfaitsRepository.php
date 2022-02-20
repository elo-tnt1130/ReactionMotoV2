<?php

namespace App\Repository;

use App\Entity\Forfaits;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Forfaits|null find($id, $lockMode = null, $lockVersion = null)
 * @method Forfaits|null findOneBy(array $criteria, array $orderBy = null)
 * @method Forfaits[]    findAll()
 * @method Forfaits[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForfaitsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Forfaits::class);
    }


    /**
     * findOneBySomeField
     *
     * SELECT forfaits.* 
     * FROM forfaits, services
     * WHERE forfaits.services_id = services.id
     */
    public function findByServices($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.services = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Forfaits[] Returns an array of Forfaits objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Forfaits
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

