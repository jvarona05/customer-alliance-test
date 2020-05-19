<?php

namespace App\Controller\API\V1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
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
     * Get All Hotels
     * 
     * Array of Hotels in the system
     * 
     * @Route("", methods={"GET"}, name="api_get_hotel_list")
     * 
     * @SWG\Tag(name="Hotels")
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returns an array of hotels"
     * )
     */
    public function getHotels(Request $request)
    {
        $hotels = $this->getDoctrine()->getRepository(Hotel::class)->findAll();

        return new JsonResponse($hotels);
    }

    /**
     * Get Hotel Average Score
     * 
     * Average of all the hotel's reviews
     * 
     * @Route("{uuid}/average", methods={"GET"}, name="api_get_hotel_average")
     * 
     * @SWG\Tag(name="Hotels")
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returns a JSON with the average"
     * )
     * 
     * @SWG\Response(
     *     response=404,
     *     description="Hotel not Found"
     * )
     */
    public function getAverage(Hotel $hotel)
    {
        $average = $this->hotelService->getAverage($hotel);

        return new JsonResponse(compact('average'));
    }

    /**
     * Get Reviews Paginated
     * 
     * Returns Hotel Reviews With Pagination
     * 
     * @Route("{uuid}/reviews", methods={"GET"}, name="api_get_review_list")
     * 
     * @SWG\Tag(name="Hotels")
     * 
     * @SWG\Parameter(
     *     name="page",
     *     in="query",
     *     type="string",
     *     description="The current page in the pagination"
     * )
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returns an array of hotel reviews"
     * )
     * 
     * @SWG\Response(
     *     response=404,
     *     description="Hotel not Found"
     * )
     */
    public function getReviews(Hotel $hotel, Request $request)
    {
        $reviews = $this->hotelService->getReviews($hotel, $request);

        return new JsonResponse($reviews);
    }
}