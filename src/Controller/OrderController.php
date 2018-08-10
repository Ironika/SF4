<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Order;

class OrderController extends Controller
{
    /**
     * @Route("/profile/order/{orderNumber}", name="order")
     */
    public function showAction(Request $request)
    {
        $order = $this->getDoctrine()->getManager()->getRepository(Order::class)->findOneBy(array('uniqId' => $request->get('orderNumber')));

        return $this->render('order_detail.html.twig', array(
            'order' => $order
        ));
    }
}
