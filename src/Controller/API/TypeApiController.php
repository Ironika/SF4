<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

use App\Entity\Type;

class TypeApiController extends FOSRestController
{
	/**
     * @Rest\Get("/api/types", name="api_type_list")
     */
    public function getTypesAction(Request $request)
    {
        $types = $this->getDoctrine()->getManager()->getRepository(Type::class)->findAll();
        
        $serializer = $this->get('jms_serializer');
		$typesJson = $serializer->serialize($types, 'json');

        return new Response($typesJson);
    }

    /**
     * @Rest\Get("/api/type/{id}" , name="api_type")
     */
    public function getTypeAction(Request $request)
    {
        $type = $this->getDoctrine()->getManager()->getRepository(Type::class)->find($request->get('id'));

        $serializer = $this->get('jms_serializer');
		$typeJson = $serializer->serialize($type, 'json');

        return new Response($typeJson);
    }
}
