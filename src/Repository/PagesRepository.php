<?php

namespace App\Repository;

use App\Entity\Pages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pages|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pages|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pages[]    findAll()
 * @method Pages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pages::class);
    }


    public function findOneByTitle($value): ?Pages
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.lib_page = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }


    // /**
    //  * @return Pages[] Returns an array of Pages objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pages
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
