<?php

namespace App\Controller\API\V1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Services\HotelService;
use App\Entity\Review;
use App\Entity\Hotel;

/**
 * @Route("/hotels/")
 */
class HotelController extends AbstractController
{
    private $hotelService;

    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    /**
     * @Route("", methods={"GET"}, name="api_get_hotel_list")
     */
    public function getHotels(Request $request)
    {
        $hotels = $this->getDoctrine()->getRepository(Hotel::class)->findAll();

        return new JsonResponse($hotels);
    }

    /**
     * @Route("{uuid}/average", methods={"GET"}, name="api_get_hotel_average")
     */
    public function getAverage(Hotel $hotel)
    {
        $average = $this->hotelService->getAverage($hotel);

        return new JsonResponse(compact('average'));
    }

    /**
     * @Route("{uuid}/reviews", methods={"GET"}, name="api_get_review_list")
     */
    public function getReviews(Hotel $hotel, Request $request)
    {
        $reviews = $this->hotelService->getReviews($hotel, $request);

        return new JsonResponse($reviews);
    }
}