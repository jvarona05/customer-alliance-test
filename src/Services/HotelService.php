<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Hotel;

class HotelService
{
    private $hotelRepository;

    public function __construct(EntityManagerInterface $em) 
    {
        $this->hotelRepository = $em->getRepository(Hotel::class);    
    }

    public function getAverage(int $hotelId)
    {
        if (!$this->hotelRepository->find($hotelId)) 
            throw new \Exception('Hotel not found.');

        return $this->hotelRepository->getAverage($hotelId);
    }
}