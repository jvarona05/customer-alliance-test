<?php

namespace App\Controller\API\V1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use App\Entity\HotelChain;
use App\Entity\Review;
use App\Entity\Hotel;

/**
 * @Route("/hotels_chain/")
 */
class HotelChainController extends AbstractController
{
    /**
     * Get Hotel Chain
     * 
     * Returns Hotel Chain
     * 
     * @Route("{id}", methods={"GET"}, name="api_get_hotel_chain")
     * 
     * @SWG\Tag(name="Hotel Chains")
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returns An Hotel Chain"
     * )
     * 
     * @SWG\Response(
     *     response=404,
     *     description="Hotel Chain not Found"
     * )
     */
    public function getHotelChain(HotelChain $hotelChain)
    {
        return new JsonResponse($hotelChain);
    }

    /**
     * Get All Hotel Chains
     * 
     * Array of Hotel Chains in the system
     * 
     * @Route("{id}/hotels", methods={"GET"}, name="api_get_hotels_from_hotel_chain")
     * 
     * @SWG\Tag(name="Hotel Chains")
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returns an array of hotel chains"
     * )
     */
    public function getHotels(HotelChain $hotelChain)
    {
        $hotels = $hotelChain->getHotels()->getValues();

        return new JsonResponse($hotels);
    }
}