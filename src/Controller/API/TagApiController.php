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

    /**
     * @Rest\Post("/api/tag/add", name="api_tag_add")
     */
    public function postTagAction(Request $request)
    {
        $tag = new Tag();
        $tag->setName($request->request->get('name'));

        $this->getDoctrine()->getManager()->persist($tag);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Tag Saved !"
        );

        $serializer = $this->get('jms_serializer');
		$response = $serializer->serialize($response, 'json');

        return new Response($response);
    }

    /**
     * @Rest\Put("/api/tag/{id}", name="api_tag_update")
     */
    public function putTagAction(Request $request)
    {
        $tag = $this->getDoctrine()->getManager()->getRepository(Tag::class)->find($request->get('id'));
        
        $tag->setName($request->request->get('name'));

        $this->getDoctrine()->getManager()->persist($tag);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Tag updated !"
        );

        $serializer = $this->get('jms_serializer');
		$response = $serializer->serialize($response, 'json');

        return new Response($response);
    }

   	/**
     * @Rest\Delete("/api/tag/{id}", name="api_tag_delete")
     */
    public function deleteTagAction(Request $request)
    {
        $tag = $this->getDoctrine()->getManager()->getRepository(Tag::class)->find($request->get('id'));

        $this->getDoctrine()->getManager()->remove($tag);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Tag deleted !"
        );

        $serializer = $this->get('jms_serializer');
		$response = $serializer->serialize($response, 'json');

        return new Response($response);
    }

}
