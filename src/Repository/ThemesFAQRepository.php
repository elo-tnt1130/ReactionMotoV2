<?php

namespace App\Repository;

use App\Entity\ThemesFAQ;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ThemesFAQ|null find($id, $lockMode = null, $lockVersion = null)
 * @method ThemesFAQ|null findOneBy(array $criteria, array $orderBy = null)
 * @method ThemesFAQ[]    findAll()
 * @method ThemesFAQ[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThemesFAQRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ThemesFAQ::class);
    }

    // /**
    //  * @return ThemesFAQ[] Returns an array of ThemesFAQ objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ThemesFAQ
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
