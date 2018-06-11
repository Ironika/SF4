<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function indexAction(Request $request, \Swift_Mailer $mailer)
    {
        if($request->get('email') && $request->get('msg')) {
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
            
            $this->addFlash(
               'notice',
                'Your mail have been sent!'
            ); 
        }

        return $this->render('contact.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
