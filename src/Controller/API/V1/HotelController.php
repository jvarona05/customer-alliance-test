<?php

namespace App\Controller\API\V1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Services\HotelService;
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
     * @Route("", name="api_get_hotel_list")
     */
    public function getHotels(Request $request)
    {
        $hotels = $this->getDoctrine()->getRepository(Hotel::class)->findAll();

        return new JsonResponse($hotels);
    }

    /**
     * NOTE poner que el url sea /{id}/average
     * @Route("{uuid}/average", name="api_get_hotel_average")
     */
    public function getAverage(Request $request)
    {
        $average = $this->hotelService->getAverage(
            $request->get('uuid')
        );

        return new JsonResponse(compact('average'));
    }

    /**
     * @Route("reviews", name="api_get_review_list")
     */
    public function getReviews(Request $request)
    {
        $reviews = $this->hotelService->getReviews($request);

        return new JsonResponse($reviews);
    }
}