<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

// use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
// use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

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

        $serializer = $this->get('jms_serializer');
 
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $username]);
 
        if (!$user) {
            return new Response($serializer->serialize('User not found', 'json'));
        }
 
        $isValid = $this->get('security.password_encoder')
            ->isPasswordValid($user, $password);
 
        if (!$isValid) {
            return new Response($serializer->serialize('Invalid Credential', 'json'));
        }

        // $token = new UsernamePasswordToken($user, null, "main", $user->getRoles());
        // $this->container->get("security.token_storage")->setToken($token);
        // $this->get('session')->set('_security_main', serialize($token));
        // $event = new InteractiveLoginEvent($request, $token);
        // $this->container->get("event_dispatcher")->dispatch("security.interactive_login", $event);

        // $this->container->get('fos_user.security.login_manager')->loginUser('main', $user, null);
        
        $userJson = $serializer->serialize($user, 'json');

        return new Response($userJson);
    }

    /**
     * @Rest\Post("/api/register", name="api_register")
     */
    public function RegisterAction(Request $request)
    {
        $userManager = $this->get('fos_user.user_manager');

        $email = $request->get('email');
        $username = $request->get('username');
        $password = $request->get('password');

        $email_exist = $userManager->findUserByEmail($email);
        $username_exist = $userManager->findUserByUsername($username);

        if($email_exist){
            return new Response($serializer->serialize('Email already exist', 'json'));
        }

        if($username_exist){
            return new Response($serializer->serialize('Username already exist', 'json'));
        }

        $user = $userManager->createUser();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setEnabled(true); 
        $user->setPlainPassword($password);
        $userManager->updateUser($user, true);
        
        $serializer = $this->get('jms_serializer');
        $userJson = $serializer->serialize($user, 'json');

        return new Response($userJson);
    }

}
