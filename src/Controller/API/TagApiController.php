<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

use App\Entity\Tag;

class TagApiController extends FOSRestController
{
	/**
     * @Rest\Get("/api/tags", name="api_tag_list")
     */
    public function getTagsAction(Request $request)
    {
        $tags = $this->getDoctrine()->getManager()->getRepository(Tag::class)->findAll();
        
        $serializer = $this->get('jms_serializer');
		$tagsJson = $serializer->serialize($tags, 'json');

        return new Response($tagsJson);
    }

    /**
     * @Rest\Get("/api/tag/{id}" , name="api_tag")
     */
    public function getTagAction(Request $request)
    {
        $tag = $this->getDoctrine()->getManager()->getRepository(Tag::class)->find($request->get('id'));

        $serializer = $this->get('jms_serializer');
		$tagJson = $serializer->serialize($tag, 'json');

        return new Response($tagJson);
    }
}
