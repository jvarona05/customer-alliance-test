<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;
use App\Entity\Review;
use App\Entity\Hotel;

/**
 * @method Review|null find($id, $lockMode = null, $lockVersion = null)
 * @method Review|null findOneBy(array $criteria, array $orderBy = null)
 * @method Review[]    findAll()
 * @method Review[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    public function getAverage(Hotel $hotel) : float
    {
        $query = $this->createQueryBuilder('r')
            ->select("avg(r.score) as avg")
            ->andWhere('r.hotel = :hotel')
            ->setParameter('hotel', $hotel);
        
        $average = $query->getQuery()->getSingleScalarResult();

        return (float) $average;
    }

    public function getReviewsQueryBuilder(Hotel $hotel) : QueryBuilder
    {
        $query = $this->createQueryBuilder('r')
            ->andWhere('r.hotel = :hotel')
            ->setParameter('hotel', $hotel);

        
        return $query;
    }
}
