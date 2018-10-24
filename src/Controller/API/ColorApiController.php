<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

use App\Entity\Color;

class ColorApiController extends FOSRestController
{
	/**
     * @Rest\Get("/api/colors", name="api_color_list")
     */
    public function getColorsAction(Request $request)
    {
        $colors = $this->getDoctrine()->getManager()->getRepository(Color::class)->findAll();
        
        $serializer = $this->get('jms_serializer');
		$colorsJson = $serializer->serialize($colors, 'json');

        return new Response($colorsJson);
    }

    /**
     * @Rest\Get("/api/color/{id}" , name="api_color")
     */
    public function getColorAction(Request $request)
    {
        $color = $this->getDoctrine()->getManager()->getRepository(Color::class)->find($request->get('id'));

        $serializer = $this->get('jms_serializer');
		$colorJson = $serializer->serialize($color, 'json');

        return new Response($colorJson);
    }
}
