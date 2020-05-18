<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Hotel;

class WidgetController extends AbstractController
{
    /**
     * @Route("/widget/{uuid}.js", name="widget")
     */
    public function index(Hotel $hotel)
    {
        return $this->render('widget/hotel.js.twig', [
            'hotel' => $hotel,
        ]);
    }
}
