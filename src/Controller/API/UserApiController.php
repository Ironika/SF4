<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

use App\Entity\User;

class UserApiController extends FOSRestController
{
	/**
     * @Rest\Get("/api/user", name="api_user")
     */
    public function getUserAction(Request $request)
    {
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($request->get('id'));
        
        $serializer = $this->get('jms_serializer');
		$userJson = $serializer->serialize($user, 'json');

        return new Response($userJson);
    }

    /**
     * @Rest\Post("/api/login", name="api_login")
     */
    public function loginAction(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
 
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $username]);
 
        if (!$user) {
            throw $this->createNotFoundException();
        }
 
        $isValid = $this->get('security.password_encoder')
            ->isPasswordValid($user, $password);
 
        if (!$isValid) {
            throw new BadCredentialsException();
        }

        $serializer = $this->get('jms_serializer');
        $userJson = $serializer->serialize($user, 'json');

        return new Response($userJson);
    }
}
