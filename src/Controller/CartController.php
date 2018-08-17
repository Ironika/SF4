<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\OrderProduct;
use App\Entity\Product;
use App\Entity\Size;
use App\Entity\Shape;
use App\Entity\Material;
use App\Entity\Order;
use Symfony\Component\Intl\Intl;

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

        $countries = Intl::getRegionBundle()->getCountryNames();

        foreach ($items as $key => $value) {
            $orderProduct = $this->getDoctrine()->getManager()->getRepository(OrderProduct::class)->find($value);
            $orderProducts[] = $orderProduct;
            $subTotal += $orderProduct->getProduct()->getPrice() * $orderProduct->getQuantity();
        }

        // replace this example code with whatever you need
        return $this->render('shoping-cart.html.twig', array(
            'orderProducts' => $orderProducts,
            'subTotal' => $subTotal,
            'countries' => $countries
        ));
    }

    /**
     * @Route("/cart/add", name="cart_add")
     */
    public function addAction(Request $request)
    {
        $orderProduct = new OrderProduct();

        $product = $this->getDoctrine()->getManager()->getRepository(Product::class)->find($request->get('product'));
        $orderProduct->setProduct($product);

        if($request->get('size')) {
            $size = $this->getDoctrine()->getManager()->getRepository(Size::class)->find($request->get('size'));
            if($size)
                $orderProduct->setSize($size);
        }
        if($request->get('shape')) {
            $shape = $this->getDoctrine()->getManager()->getRepository(Shape::class)->find($request->get('shape'));
            if($shape)
                $orderProduct->setShape($shape);
        }
        if($request->get('material')) {
            $material = $this->getDoctrine()->getManager()->getRepository(Material::class)->find($request->get('material'));
            if($material)
                $orderProduct->setMaterial($material);
        }
        if($request->get('quantity')) {
            $orderProduct->setQuantity($request->get('quantity'));
        }

        $this->getDoctrine()->getManager()->persist($orderProduct);
        $this->getDoctrine()->getManager()->flush();

        $cm = $this->get('cart_manager');
        $cm->addItem($orderProduct->getId(), $orderProduct->getQuantity());

        $response = new Response('ok');

        return $response;
    }

    /**
     * @Route("/cart/remove/{id}", name="cart_remove")
     */
    public function removeAction(Request $request)
    {
        $cm = $this->get('cart_manager');
        $cm->removeItem($request->get('id'), $request->get('quantity'));

        return $this->redirect($this->generateUrl('cart'));
    }

    /**
     * @Route("/cart/payment", name="cart_payment")
     */
    public function paymentAction(Request $request)
    {
        $user = $this->getUser();

        if(!$user)
            return $this->redirect($this->generateUrl('fos_user_profile_show'));

        $order = new Order();
        $cm = $this->get('cart_manager');
        $items = $cm->getItems();
        $orderProducts = array();

        foreach ($items as $key => $value) {
            $orderProduct = $this->getDoctrine()->getManager()->getRepository(OrderProduct::class)->find($value);
            $orderProduct->setOrder($order);
            $orderProducts[] = $orderProduct;
        }
        $order->setOrderProducts($orderProducts);
        $order->setUser($user);

        $this->getDoctrine()->getManager()->persist($order);
        $this->getDoctrine()->getManager()->flush();

        $this->get('session')->remove("cart_items");
        $this->get('session')->remove("cart_items_number");

        return $this->redirect($this->generateUrl('fos_user_profile_show'));
    }
}
