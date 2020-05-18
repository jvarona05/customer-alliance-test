<?php

namespace App\Controller\API\V1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Services\HotelService;
use App\Entity\HotelChain;
use App\Entity\Review;
use App\Entity\Hotel;

/**
 * @Route("/hotels/")
 */
class HotelController extends AbstractController
{
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
     * @Route("average", name="api_get_hotel_average")
     */
    public function getAverage(Request $request, HotelService $hotelService)
    {
        $average = $hotelService->getAverage($request->get('hotelId'));

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
}