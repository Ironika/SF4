<?php

namespace App\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use App\Entity\SubscriberNewsletter;
use App\Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CRUDController extends Controller
{
    public function mailAction(\Swift_Mailer $mailer)
    {
        $newsletter = $this->admin->getSubject();

        if (!$newsletter) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $newsletter->getId()));
        }

        // send mail to subscribers anonymes
        $subscribers = $this->getDoctrine()->getManager()->getRepository(SubscriberNewsletter::class)->findAll();
        foreach ($subscribers as $value) {
        	$message = (new \Swift_Message($newsletter->getTitle()))
	            ->setFrom('contact@ineluctable.fr')
	            ->setTo($value->getEmail())
	            ->setBody(
	                $this->renderView(
	                    'Mail/newsletter.html.twig',
	                    array(
	                    	'title' => $newsletter->getTitle(),
	                    	'content' => $newsletter->getContent(),
	                    	'products' => $newsletter->getProducts()
	                    )
	                ),
	                'text/html'
	        );
            $mailer->send($message);
        }

        // send mail to subscribers users
        $users = $this->getDoctrine()->getManager()->getRepository(User::class)->findBy(array('haveSubscribeNewsletter' => true));
        foreach ($users as $value) {
        	$message = (new \Swift_Message($newsletter->getTitle()))
	            ->setFrom('contact@ineluctable.fr')
	            ->setTo($value->getEmail())
	            ->setBody(
	                $this->renderView(
	                    'Mail/newsletter.html.twig',
	                    array(
	                    	'title' => $newsletter->getTitle(),
	                    	'content' => $newsletter->getContent(),
	                    	'products' => $newsletter->getProducts()
	                    )
	                ),
	                'text/html'
	        );
            $mailer->send($message);
        }

        $this->addFlash('sonata_flash_success', 'Newsletter have been sent');

        return new RedirectResponse($this->admin->generateUrl('list'));
    }
}