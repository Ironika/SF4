<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

use App\Entity\Shape;

class ShapeApiController extends FOSRestController
{
	/**
     * @Rest\Get("/api/shapes", name="api_shape_list")
     */
    public function getShapesAction(Request $request)
    {
        $shapes = $this->getDoctrine()->getManager()->getRepository(Shape::class)->findAll();
        
        $serializer = $this->get('jms_serializer');
		$shapesJson = $serializer->serialize($shapes, 'json');

        return new Response($shapesJson);
    }

    /**
     * @Rest\Get("/api/shape/{id}" , name="api_shape")
     */
    public function getShapeAction(Request $request)
    {
        $shape = $this->getDoctrine()->getManager()->getRepository(Shape::class)->find($request->get('id'));

        $serializer = $this->get('jms_serializer');
		$shapeJson = $serializer->serialize($shape, 'json');

        return new Response($shapeJson);
    }
}
