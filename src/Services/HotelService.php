<?php

namespace App\Services;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Cache\ItemInterface;
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

    public function getAverage(Hotel $hotel)
    {
        $cache = new FilesystemAdapter();

        $reviewRepository = $this->em->getRepository(Review::class);

        $average = $cache->get("hotel_average_{$hotel->getUuid()}", function (ItemInterface $item) use ($reviewRepository, $hotel) {
            $item->expiresAfter(3600);
        
            return $reviewRepository->getAverage($hotel);
        });

        return $average;
    }
}