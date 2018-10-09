<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

use App\Entity\OrderProduct;
use Doctrine\Common\Collections\ArrayCollection;

class OrderProductApiController extends FOSRestController
{
	/**
     * @Rest\Get("/api/orderproducts", name="api_orderproduct_list")
     */
    public function getOrderProductsAction(Request $request)
    {
        $orderProducts = $this->getDoctrine()->getManager()->getRepository(OrderProduct::class)->findAll();
        $productsWithMedia = array();

        foreach ($orderProducts as $key => $orderProduct) {
        	$medias = $orderProduct->getProduct()->getGallery()->getGalleryHasMedias();
        	foreach ($medias as $key => $value) {
        		$media = $value->getMedia();
				$orderProduct->getProduct()->addMedia($media);
        	}
        	$productsWithMedia[] = $orderProduct;
        }
        
        $serializer = $this->get('jms_serializer');
		$productsJson = $serializer->serialize($productsWithMedia, 'json');

        return new Response($productsJson);
    }

    /**
     * @Rest\Get("/api/orderproduct/{id}" , name="api_orderproduct")
     */
    public function getOrderProductAction(Request $request)
    {
        $orderProduct = $this->getDoctrine()->getManager()->getRepository(OrderProduct::class)->find($request->get('id'));

        $medias = $orderProduct->getProduct()->getGallery()->getGalleryHasMedias();
        foreach ($medias as $key => $value) {
            $media = $value->getMedia();
            $orderProduct->getProduct()->addMedia($media);
        }

        $serializer = $this->get('jms_serializer');
		$productJson = $serializer->serialize($orderProduct, 'json');

        return new Response($productJson);
    }

    /**
     * @Rest\Post("/api/orderproduct" , name="api_orderproduct_add")
     */
    public function postOrderProductAction(Request $request)
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

        $serializer = $this->get('jms_serializer');
        $productJson = $serializer->serialize($orderProduct, 'json');

        return new Response($productJson);
    }
}
