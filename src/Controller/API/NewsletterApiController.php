<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

use App\Entity\SubscriberNewsletter;
use App\Entity\User;

class NewsletterApiController extends FOSRestController
{
	/**
     * @Rest\Post("/api/newsletter", name="api_newsletter")
     */
    public function subscribeAction(Request $request)
    {       
        //check SubscriberNewsletter
        $subscriber = $this->getDoctrine()->getManager()->getRepository(SubscriberNewsletter::class)->findOneBy(array('email' => $request->get('email')));

        $serializer = $this->get('jms_serializer');

        if($subscriber)
            return new Response($serializer->serialize('error', 'json'));

        //check User
        $subscriber = $this->getDoctrine()->getManager()->getRepository(User::class)->findOneBy(array('email' => $request->get('email')));

        if($subscriber)
            return new Response($serializer->serialize('error', 'json'));

        $subscriber = new SubscriberNewsletter($request->get('email'));
        
        $this->getDoctrine()->getManager()->persist($subscriber);
        $this->getDoctrine()->getManager()->flush();
        
		$subscriberJson = $serializer->serialize($subscriber, 'json');

        return new Response($serializer->serialize('success', 'json'));
    }
}
