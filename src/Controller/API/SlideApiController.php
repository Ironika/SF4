<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

use App\Entity\Slide;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\File\File;
use App\Application\Sonata\MediaBundle\Entity\Media;

class SlideApiController extends FOSRestController
{
	/**
     * @Rest\Get("/api/slides", name="api_slide_list")
     */
    public function getSlidesAction(Request $request)
    {
        $slides = $this->getDoctrine()->getManager()->getRepository(Slide::class)->findAll();
        
        $serializer = $this->get('jms_serializer');
		$slidesJson = $serializer->serialize($slides, 'json');

        return new Response($slidesJson);
    }

    /**
     * @Rest\Get("/api/slide/{id}" , name="api_slide")
     */
    public function getSlideAction(Request $request)
    {
        $slide = $this->getDoctrine()->getManager()->getRepository(Slide::class)->find($request->get('id'));

        $serializer = $this->get('jms_serializer');
		$slideJson = $serializer->serialize($slide, 'json');

        return new Response($slideJson);
    }

    /**
     * @Rest\Post("/api/slide/add", name="api_slide_add")
     */
    public function postSlideAction(Request $request)
    {
        $slide = new Slide();
        $slide->setTitle($request->request->get('title'));

    	$product = $this->getDoctrine()->getManager()->getRepository(Product::class)->findOneBy(array('slug' => $request->request->get('slug')));
    	$slide->setProduct($request->request->get('product'));

        $mediaFile = new File($request->request->get('filepath'));
        $slide->setMedia($this->createMedia($mediaFile, $request->request->get('title') . '.jpg'));

        $this->getDoctrine()->getManager()->persist($slide);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Slide Saved !"
        );

        $serializer = $this->get('jms_serializer');
		$response = $serializer->serialize($response, 'json');

        return new Response($response);
    }

    /**
     * @Rest\Put("/api/slide/{id}", name="api_slide_update")
     */
    public function putSlideAction(Request $request)
    {
        $slide = $this->getDoctrine()->getManager()->getRepository(Slide::class)->find($request->get('id'));
        
        $slide->setTitle($request->request->get('title'));

        $this->getDoctrine()->getManager()->persist($slide);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Slide updated !"
        );

        $serializer = $this->get('jms_serializer');
		$response = $serializer->serialize($response, 'json');

        return new Response($response);
    }

   	/**
     * @Rest\Delete("/api/slide/{id}", name="api_slide_delete")
     */
    public function deleteSlideAction(Request $request)
    {
        $slide = $this->getDoctrine()->getManager()->getRepository(Slide::class)->find($request->get('id'));

        $this->getDoctrine()->getManager()->remove($slide);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Slide deleted !"
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
