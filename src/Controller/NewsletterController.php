<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\SubscriberNewsletter;
use App\Entity\User;

class NewsletterController extends Controller
{
    /**
     * @Route("/newsletter", name="newsletter")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('about.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/newsletter/subscribe", name="newsletter_subscribe")
     */
    public function subscribeAction(Request $request) 
    {
        if($request->get('email')) {
            
            //check SubscriberNewsletter
            $subscriber = $this->getDoctrine()->getManager()->getRepository(SubscriberNewsletter::class)->findOneBy(array('email' => $request->get('email')));

            if($subscriber) {
                $this->addFlash('warning', $request->get('email') . ' have already been registered !'); 
                return $this->redirect($this->generateUrl('homepage'));
            }

            //check User
            $subscriber = $this->getDoctrine()->getManager()->getRepository(User::class)->findOneBy(array('email' => $request->get('email')));

            if($subscriber) {
                $this->addFlash('warning', $request->get('email') . ' have already been registered !'); 
                return $this->redirect($this->generateUrl('homepage'));
            }


            $subscriber = new SubscriberNewsletter($request->get('email'));
            
            $this->getDoctrine()->getManager()->persist($subscriber);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice', $request->get('email') . ' have been registered !'); 

            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('newsletter-subscribe.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
