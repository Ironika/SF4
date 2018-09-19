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

    /**
     * @Rest\Post("/api/collection/add", name="api_collection_add")
     */
    public function postCollectionAction(Request $request)
    {
        $collection = new Collection();
        $collection->setName($request->request->get('name'));

        $collectionFile = new File($request->request->get('filepath'));
        $collection->setMedia($this->createMedia($collectionFile, $request->request->get('name') . '.jpg'));

        $this->getDoctrine()->getManager()->persist($collection);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Collection Saved !"
        );

        $serializer = $this->get('jms_serializer');
		$response = $serializer->serialize($response, 'json');

        return new Response($response);
    }

    /**
     * @Rest\Put("/api/collection/{id}", name="api_collection_update")
     */
    public function putCollectionAction(Request $request)
    {
        $collection = $this->getDoctrine()->getManager()->getRepository(Collection::class)->find($request->get('id'));
        
        $collection->setName($request->request->get('name'));

        $this->getDoctrine()->getManager()->persist($collection);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Collection updated !"
        );

        $serializer = $this->get('jms_serializer');
		$response = $serializer->serialize($response, 'json');

        return new Response($response);
    }

   	/**
     * @Rest\Delete("/api/collection/{id}", name="api_collection_delete")
     */
    public function deleteCollectionAction(Request $request)
    {
        $collection = $this->getDoctrine()->getManager()->getRepository(Collection::class)->find($request->get('id'));

        $this->getDoctrine()->getManager()->remove($collection);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Collection deleted !"
        );

        $serializer = $this->get('jms_serializer');
		$response = $serializer->serialize($response, 'json');

        return new Response($response);
    }

    public function createMedia($file, $filename)
    {
        $mediaManager = $this->container->get('sonata.media.manager.media');

        $media = $mediaManager->create();
        $media->setEnabled(true);
        $media->setBinaryContent($file);
        $media->setName($filename);
        $media->setContext('default');
        $media->setProviderName('sonata.media.provider.image');
        $media->setProviderStatus(1);

        $mediaManager->save($media);

        return $media;
    }

}
