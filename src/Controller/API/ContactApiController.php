<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class ContactApiController extends FOSRestController
{
	/**
     * @Rest\Post("/api/contact", name="api_contact")
     */
    public function contactAction(Request $request, \Swift_Mailer $mailer)
    {
        $serializer = $this->get('jms_serializer');
        
        $message = (new \Swift_Message('Contact Ineluctable'))
        ->setFrom($request->get('email'))
        ->setTo('kekeoh91@gmail.com')
        ->setBody(
            $this->renderView(
                'Mail/contact.html.twig',
                array('msg' => $request->get('msg'))
            ),
            'text/html'
        );
        $mailer->send($message);

        return new Response($serializer->serialize('success', 'json'));
    }
}
