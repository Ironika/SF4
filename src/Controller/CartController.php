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

        $user = $this->getUser(); 
        $orderProduct->setUser($user);  

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
