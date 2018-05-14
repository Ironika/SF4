<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\OrderProduct;
use App\Entity\Product;

class CartController extends Controller
{
    /**
     * @Route("/cart", name="cart")
     */
    public function indexAction(Request $request)
    {
        // $this->get('session')->clear();
        $cm = $this->get('cart_manager');
        $orderProducts = array();
        $items = $cm->getItems();

        $subTotal = 0;

        foreach ($items as $key => $value) {
            $orderProduct = $this->getDoctrine()->getManager()->getRepository(OrderProduct::class)->find($key);
            $orderProduct->setQuantity($value);
            $orderProducts[] = $orderProduct;
            $subTotal += $orderProduct->getProduct()->getPrice() * $orderProduct->getQuantity();
        }

        // replace this example code with whatever you need
        return $this->render('shoping-cart.html.twig', array(
            'orderProducts' => $orderProducts,
            'subTotal' => $subTotal
        ));
    }

    /**
     * @Route("/cart/add/{id}", name="cart_add")
     */
    public function addAction(Request $request)
    {
        $product = $this->getDoctrine()->getManager()->getRepository(Product::class)->find($request->get('id'));

        $orderProduct = new OrderProduct();
        $orderProduct->setProduct($product);

        $this->getDoctrine()->getManager()->persist($orderProduct);
        $this->getDoctrine()->getManager()->flush();

        $cm = $this->get('cart_manager');
        $cm->addItem($orderProduct->getId());

        $response = new Response('ok');

        return $response;
    }

    /**
     * @Route("/cart/remove/{id}", name="cart_remove")
     */
    public function removeAction(Request $request)
    {
        $cm = $this->get('cart_manager');
        $cm->removeItem($request->get('id'));

        return $this->redirect($this->generateUrl('cart'));
    }
}
