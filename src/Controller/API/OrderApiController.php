<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

use App\Entity\Order;
use Doctrine\Common\Collections\ArrayCollection;

class OrderApiController extends FOSRestController
{
    /**
     * @Rest\Get("/api/order/{id}" , name="api_order")
     */
    public function getOrderProductAction(Request $request)
    {
        $order = $this->getDoctrine()->getManager()->getRepository(Order::class)->find($request->get('id'));

        $productsWithMedia = array();

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
}
