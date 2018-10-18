<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

use App\Entity\AddressDelivery;
use App\Entity\AddressBilling;

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
    public function registerAction(Request $request)
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

    /**
     * @Rest\Put("/api/user/update", name="api_user_update")
     */
    public function updateAction(Request $request)
    {
        $userDatas = $request->get('user');

        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($userDatas['id']);

        $user->setEmail($userDatas['email']);
        $user->setHaveSubscribeNewsletter($userDatas['have_subscribe_newsletter']);

        if($userDatas['address_delivery'] && count($userDatas['address_delivery']) > 0) {
            if($user->getAddressDelivery()) {
                $user->getAddressDelivery()->setFirstName($userDatas['address_delivery']['first_name']);
                $user->getAddressDelivery()->setLastName($userDatas['address_delivery']['last_name']);
                $user->getAddressDelivery()->setStreet($userDatas['address_delivery']['street']);
                $user->getAddressDelivery()->setStreetAdd($userDatas['address_delivery']['street_add']);
                $user->getAddressDelivery()->setCity($userDatas['address_delivery']['city']);
                $user->getAddressDelivery()->setCountry($userDatas['address_delivery']['country']);
                $user->getAddressDelivery()->setZipcode($userDatas['address_delivery']['zipcode']);
                $user->getAddressDelivery()->setState($userDatas['address_delivery']['state']);
            } else {
                $addressDelivery = new AddressDelivery();
                $addressDelivery->setFirstName($userDatas['address_delivery']['first_name']);
                $addressDelivery->setLastName($userDatas['address_delivery']['last_name']);
                $addressDelivery->setStreet($userDatas['address_delivery']['street']);
                $addressDelivery->setStreetAdd($userDatas['address_delivery']['street_add']);
                $addressDelivery->setCity($userDatas['address_delivery']['city']);
                $addressDelivery->setCountry($userDatas['address_delivery']['country']);
                $addressDelivery->setZipcode($userDatas['address_delivery']['zipcode']);
                $addressDelivery->setState($userDatas['address_delivery']['state']);

                $user->setAddressDelivery($addressDelivery);
            }
        }

        if($userDatas['address_billing'] && count($userDatas['address_billing']) > 0) {
            if($user->getAddressBilling()) {
                $user->getAddressBilling()->setFirstName($userDatas['address_billing']['first_name']);
                $user->getAddressBilling()->setLastName($userDatas['address_billing']['last_name']);
                $user->getAddressBilling()->setStreet($userDatas['address_billing']['street']);
                $user->getAddressBilling()->setStreetAdd($userDatas['address_billing']['street_add']);
                $user->getAddressBilling()->setCity($userDatas['address_billing']['city']);
                $user->getAddressBilling()->setCountry($userDatas['address_billing']['country']);
                $user->getAddressBilling()->setZipcode($userDatas['address_billing']['zipcode']);
                $user->getAddressBilling()->setState($userDatas['address_billing']['state']);
            } else {
                $addressBilling = new AddressBilling();
                $addressBilling->setFirstName($userDatas['address_billing']['first_name']);
                $addressBilling->setLastName($userDatas['address_billing']['last_name']);
                $addressBilling->setStreet($userDatas['address_billing']['street']);
                $addressBilling->setStreetAdd($userDatas['address_billing']['street_add']);
                $addressBilling->setCity($userDatas['address_billing']['city']);
                $addressBilling->setCountry($userDatas['address_billing']['country']);
                $addressBilling->setZipcode($userDatas['address_billing']['zipcode']);
                $addressBilling->setState($userDatas['address_billing']['state']);

                $user->setAddressBilling($addressBilling);
            }
        }

        $this->getDoctrine()->getManager()->persist($user);
        $this->getDoctrine()->getManager()->flush();
        
        $serializer = $this->get('jms_serializer');
        $userJson = $serializer->serialize($user, 'json');

        return new Response($userJson);
    }

}
