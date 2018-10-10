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
}
