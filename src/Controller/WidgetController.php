<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Hotel;

class WidgetController extends AbstractController
{
    /**
     * @Route("/widget/{uuid}.js", name="widget_js")
     */
    public function asset(Hotel $hotel, Request $request)
    {
        return $this->render('widget/hotel.js.twig', [
            'domain' => $request->getHost(),
            'hotelUuid' => $hotel->getUuid(),
        ]);
    }

    /**
     * @Route("/widget/{uuid}", name="widget_html")
     */
    public function index(Hotel $hotel)
    {
        return $this->render('widget/hotel.html.twig', [
            'hotel' => $hotel,
        ]);
    }
}
