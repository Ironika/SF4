<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

use App\Entity\Collection;
use Symfony\Component\HttpFoundation\File\File;
use App\Application\Sonata\MediaBundle\Entity\Media;

class CollectionApiController extends FOSRestController
{
	/**
     * @Rest\Get("/api/collections", name="api_collection_list")
     */
    public function getCollectionsAction(Request $request)
    {
        $collections = $this->getDoctrine()->getManager()->getRepository(Collection::class)->findAll();
        
        $serializer = $this->get('jms_serializer');
		$collectionsJson = $serializer->serialize($collections, 'json');

        return new Response($collectionsJson);
    }

    /**
     * @Rest\Get("/api/collection/{id}" , name="api_collection")
     */
    public function getCollectionAction(Request $request)
    {
        $collection = $this->getDoctrine()->getManager()->getRepository(Collection::class)->find($request->get('id'));

        $serializer = $this->get('jms_serializer');
		$collectionJson = $serializer->serialize($collection, 'json');

        return new Response($collectionJson);
    }
}
