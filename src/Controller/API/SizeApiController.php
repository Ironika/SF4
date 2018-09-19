<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

use App\Entity\Size;

class SizeApiController extends FOSRestController
{
	/**
     * @Rest\Get("/api/sizes", name="api_size_list")
     */
    public function getSizesAction(Request $request)
    {
        $sizes = $this->getDoctrine()->getManager()->getRepository(Size::class)->findAll();
        
        $serializer = $this->get('jms_serializer');
		$sizesJson = $serializer->serialize($sizes, 'json');

        return new Response($sizesJson);
    }

    /**
     * @Rest\Get("/api/size/{id}" , name="api_size")
     */
    public function getSizeAction(Request $request)
    {
        $size = $this->getDoctrine()->getManager()->getRepository(Size::class)->find($request->get('id'));

        $serializer = $this->get('jms_serializer');
		$sizeJson = $serializer->serialize($size, 'json');

        return new Response($sizeJson);
    }

    /**
     * @Rest\Post("/api/size/add", name="api_size_add")
     */
    public function postSizeAction(Request $request)
    {
        $size = new Size();
        $size->setName($request->request->get('name'));

        $this->getDoctrine()->getManager()->persist($size);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Size Saved !"
        );

        $serializer = $this->get('jms_serializer');
		$response = $serializer->serialize($response, 'json');

        return new Response($response);
    }

    /**
     * @Rest\Put("/api/size/{id}", name="api_size_update")
     */
    public function putSizeAction(Request $request)
    {
        $size = $this->getDoctrine()->getManager()->getRepository(Size::class)->find($request->get('id'));
        
        $size->setName($request->request->get('name'));

        $this->getDoctrine()->getManager()->persist($size);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Size updated !"
        );

        $serializer = $this->get('jms_serializer');
		$response = $serializer->serialize($response, 'json');

        return new Response($response);
    }

   	/**
     * @Rest\Delete("/api/size/{id}", name="api_size_delete")
     */
    public function deleteSizeAction(Request $request)
    {
        $size = $this->getDoctrine()->getManager()->getRepository(Size::class)->find($request->get('id'));

        $this->getDoctrine()->getManager()->remove($size);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Size deleted !"
        );

        $serializer = $this->get('jms_serializer');
		$response = $serializer->serialize($response, 'json');

        return new Response($response);
    }

}
