<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

use App\Entity\Order;
use App\Entity\OrderProduct;
use App\Entity\User;
use App\Entity\Product;
use App\Entity\Size;
use App\Entity\Shape;
use App\Entity\Material;
use Doctrine\Common\Collections\ArrayCollection;

class OrderApiController extends FOSRestController
{

    /**
     * @Rest\Get("/api/user/{id}/orders" , name="api_user_order")
     */
    public function getUserOrdersAction(Request $request)
    {
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($request->get('id'));

        foreach ($user->getOrders() as $order) {
            foreach ($order->getOrderProducts() as $key => $orderProduct) {
                $medias = $orderProduct->getProduct()->getGallery()->getGalleryHasMedias();
                foreach ($medias as $key => $value) {
                    $media = $value->getMedia();
                    $orderProduct->getProduct()->addMedia($media);
                }
            }
        }

        $serializer = $this->get('jms_serializer');
        $ordersJson = $serializer->serialize($user->getOrders(), 'json');

        return new Response($ordersJson);
    }

    /**
     * @Rest\Get("/api/order/{id}" , name="api_order")
     */
    public function getOrderAction(Request $request)
    {
        $order = $this->getDoctrine()->getManager()->getRepository(Order::class)->find($request->get('id'));

        foreach ($order->getOrderProducts() as $key => $orderProduct) {
            $medias = $orderProduct->getProduct()->getGallery()->getGalleryHasMedias();
            foreach ($medias as $key => $value) {
                $media = $value->getMedia();
                $orderProduct->getProduct()->addMedia($media);
            }
        }

        $serializer = $this->get('jms_serializer');
		$orderJson = $serializer->serialize($order, 'json');

        return new Response($orderJson);
    }

    /**
     * @Rest\Post("/api/order" , name="api_order_add")
     */
    public function postOrderProductAction(Request $request)
    {
        $orderDatas = $request->get('order');
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($orderDatas['user']);

        $order = new Order();
        $order->setUser($user);
        $order->setState('PAID');
        $order->setTotal($orderDatas['total']);

        foreach ($orderDatas['orderProducts'] as $orderProductData) {
            $orderProduct = new OrderProduct();

            $product = $this->getDoctrine()->getManager()->getRepository(Product::class)->find($orderProductData['product']['id']);
            $orderProduct->setProduct($product);

            $size = $this->getDoctrine()->getManager()->getRepository(Size::class)->find($orderProductData['size']['value']);
            $orderProduct->setSize($size);

            $material = $this->getDoctrine()->getManager()->getRepository(Material::class)->find($orderProductData['material']['value']);
            $orderProduct->setMaterial($material);

            $shape = $this->getDoctrine()->getManager()->getRepository(Shape::class)->find($orderProductData['shape']['value']);
            $orderProduct->setShape($shape);

            $orderProduct->setQuantity($orderProductData['quantity']);
            $order->addOrderProduct($orderProduct);
        }

        $this->getDoctrine()->getManager()->persist($order);
        $this->getDoctrine()->getManager()->flush();

        $serializer = $this->get('jms_serializer');
        $orderJson = $serializer->serialize($order, 'json');

        return new Response($orderJson);
    }
}
