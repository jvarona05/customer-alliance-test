<?php

namespace App\Repository;

use App\Entity\HotelChain;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ChainHotel|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChainHotel|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChainHotel[]    findAll()
 * @method ChainHotel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotelChainRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HotelChain::class);
    }

    // /**
    //  * @return ChainHotel[] Returns an array of ChainHotel objects
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
    public function findOneBySomeField($value): ?ChainHotel
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
