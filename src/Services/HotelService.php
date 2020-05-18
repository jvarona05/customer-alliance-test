<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Hotel;
use App\Entity\Review;
use App\Services\Paginator;

class HotelService
{
    private $em;

    private $paginator;

    private $hotelRepository;

    public function __construct(EntityManagerInterface $em, Paginator $paginator) 
    {
        $this->em = $em;
        $this->paginator = $paginator;
        $this->hotelRepository = $em->getRepository(Hotel::class);    
    }

    public function getAverage(int $hotelId)
    {
        if (!$this->hotelRepository->find($hotelId)) 
            throw new \Exception('Hotel not found.');

        return (float)$this->hotelRepository->getAverage($hotelId);
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