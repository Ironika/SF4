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
}
