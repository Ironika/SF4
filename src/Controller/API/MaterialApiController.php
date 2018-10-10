<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

use App\Entity\Material;

class MaterialApiController extends FOSRestController
{
	/**
     * @Rest\Get("/api/materials", name="api_material_list")
     */
    public function getMaterialsAction(Request $request)
    {
        $materials = $this->getDoctrine()->getManager()->getRepository(Material::class)->findAll();
        
        $serializer = $this->get('jms_serializer');
		$materialsJson = $serializer->serialize($materials, 'json');

        return new Response($materialsJson);
    }

    /**
     * @Rest\Get("/api/material/{id}" , name="api_material")
     */
    public function getMaterialAction(Request $request)
    {
        $material = $this->getDoctrine()->getManager()->getRepository(Material::class)->find($request->get('id'));

        $serializer = $this->get('jms_serializer');
		$materialJson = $serializer->serialize($material, 'json');

        return new Response($materialJson);
    }
}
