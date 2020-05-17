<?php

namespace App\Controller\API\V1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Hotel;
use App\Entity\Review;
use App\Entity\HotelChain;
use App\Services\HotelService;
use Symfony\Component\HttpFoundation\Response;

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
     * @Route("average", name="api_get_hotel_average")
     */
    public function getAverage(Request $request)
    {
        $average = $this->hotelService->getAverage(
            $request->get('hotelId')
        );

        return new JsonResponse(compact('average'));
    }

    /**
     * @Route("reviews", name="api_get_review_list")
     */
    public function getReviews(Request $request)
    {
        $reviews = $this->getDoctrine()->getRepository(Review::class)
                    ->getReviews($request->get('hotelId'));

        return new JsonResponse($reviews);
    }

    /**
     * @Route("", name="api_get_hotel_list")
     */
    public function getHotels(Request $request)
    {
        $hotels = $this->getDoctrine()->getRepository(Hotel::class)->findAll();

        return new JsonResponse($hotels);
    }
}