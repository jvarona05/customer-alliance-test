<?php

namespace App\Controller\API\V1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\HotelChain;
use App\Entity\Review;
use App\Entity\Hotel;

/**
 * @Route("/hotels_chain/")
 */
class HotelChainController extends AbstractController
{
    /**
     * @Route("{id}", name="api_get_hotel_chain")
     */
    public function getHotelChain(HotelChain $hotelChain)
    {
        return new JsonResponse($hotelChain);
    }
}