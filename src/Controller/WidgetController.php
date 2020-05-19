<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Hotel;

class WidgetController extends AbstractController
{
    /**
     * Embedded javascript file for hotel average widget
     * 
     * @Route("/widget/{uuid}.js", methods={"GET"}, name="widget_js")
     * 
     * @SWG\Tag(name="Widget")
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returns JS file that insert an iframe and render the widget"
     * )
     */
    public function jsWidget(Hotel $hotel, Request $request)
    {
        return $this->render('widget/hotel.js.twig', [
            'domain' => $request->getSchemeAndHttpHost(),
            'hotel' => $hotel,
        ]);
    }

    /**
     * Hotel average widget HTML
     * 
     * @Route("/widget/{uuid}", methods={"GET"}, name="widget_html")
     * 
     * @SWG\Tag(name="Widget")
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returns Widget HTML that render hotel average score"
     * )
     */
    public function htmlWidget(Hotel $hotel, Request $request)
    {
        return $this->render('widget/hotel.html.twig', [
            'domain' => $request->getSchemeAndHttpHost(),
            'hotel' => $hotel,
        ]);
    }
}
