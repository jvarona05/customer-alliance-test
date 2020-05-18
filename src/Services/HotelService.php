<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Services\Paginator;
use App\Entity\Review;
use App\Entity\Hotel;

class HotelService
{
    private $paginator;

    private $em;    

    public function __construct(EntityManagerInterface $em, Paginator $paginator) 
    {
        $this->paginator = $paginator;

        $this->em = $em;
    }

    public function getReviews(Hotel $hotel, Request $request) : array
    {
        $query = $this->em->getRepository(Review::class)->getReviewsQueryBuilder($hotel);
        $currentPage = $request->get('page', 1);
        $pageSize = 5;
        
        $paginator = $this->paginator->paginate($query, $currentPage, $pageSize);
        
        $reviews = [];
        foreach ($paginator as $pageItem) {
            $reviews[] = [
                'id' => $pageItem->getId(),
                'score' => $pageItem->getScore(),
                'comment' => $pageItem->getComment()
            ];
        }

        return $reviews;
    }
}