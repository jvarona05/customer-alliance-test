<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Hotel;
use App\Entity\Review;
use App\Services\Paginator;

class HotelService
{
    private $paginator;

    private $em;    

    public function __construct(EntityManagerInterface $em, Paginator $paginator) 
    {
        $this->paginator = $paginator;

        $this->em = $em;
    }

    public function getAverage(string $hotelUuid) : float
    {
        $hotelRepository = $this->em->getRepository(Hotel::class); 

        if (!$hotelRepository->findOneBy(['uuid' => $hotelUuid])) 
            throw new \Exception('Hotel not found.');

        return (float)$hotelRepository->getAverage($hotelUuid);
    }

    public function getReviews(Request $request) : array
    {
        $reviewsQueryBuilder = $this->em->getRepository(Review::class)
            ->getReviewsQueryBuilder($request->get('hotelId'));
        
        $paginator = $this->paginator->paginate(
            $reviewsQueryBuilder, 
            $request->get('page', 1), 
            2
        );
        
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