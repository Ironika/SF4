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

    /**
     * @Rest\Post("/api/shape/add", name="api_shape_add")
     */
    public function postShapeAction(Request $request)
    {
        $shape = new Shape();
        $shape->setName($request->request->get('name'));

        $this->getDoctrine()->getManager()->persist($shape);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Shape Saved !"
        );

        $serializer = $this->get('jms_serializer');
		$response = $serializer->serialize($response, 'json');

        return new Response($response);
    }

    /**
     * @Rest\Put("/api/shape/{id}", name="api_shape_update")
     */
    public function putShapeAction(Request $request)
    {
        $shape = $this->getDoctrine()->getManager()->getRepository(Shape::class)->find($request->get('id'));
        
        $shape->setName($request->request->get('name'));

        $this->getDoctrine()->getManager()->persist($shape);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Shape updated !"
        );

        $serializer = $this->get('jms_serializer');
		$response = $serializer->serialize($response, 'json');

        return new Response($response);
    }

   	/**
     * @Rest\Delete("/api/shape/{id}", name="api_shape_delete")
     */
    public function deleteShapeAction(Request $request)
    {
        $shape = $this->getDoctrine()->getManager()->getRepository(Shape::class)->find($request->get('id'));

        $this->getDoctrine()->getManager()->remove($shape);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Shape deleted !"
        );

        $serializer = $this->get('jms_serializer');
		$response = $serializer->serialize($response, 'json');

        return new Response($response);
    }

}
