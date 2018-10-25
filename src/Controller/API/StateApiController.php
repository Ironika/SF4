<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

use App\Entity\State;

class StateApiController extends FOSRestController
{
	/**
     * @Rest\Get("/api/states", name="api_state_list")
     */
    public function getStatesAction(Request $request)
    {
        $states = $this->getDoctrine()->getManager()->getRepository(State::class)->findAll();
        
        $serializer = $this->get('jms_serializer');
		$statesJson = $serializer->serialize($states, 'json');

        return new Response($statesJson);
    }

    /**
     * @Rest\Get("/api/state/{id}" , name="api_state")
     */
    public function getStateAction(Request $request)
    {
        $state = $this->getDoctrine()->getManager()->getRepository(State::class)->find($request->get('id'));

        $serializer = $this->get('jms_serializer');
		$stateJson = $serializer->serialize($state, 'json');

        return new Response($stateJson);
    }
}
