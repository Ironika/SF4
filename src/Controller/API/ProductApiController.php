<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

use App\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;

class ProductApiController extends FOSRestController
{
	/**
     * @Rest\Get("/api/products", name="api_product_list")
     */
    public function getProductsAction(Request $request)
    {
        $products = $this->getDoctrine()->getManager()->getRepository(Product::class)->findAll();
        $productsWithMedia = array();

        foreach ($products as $key => $product) {
        	$medias = $product->getGallery()->getGalleryHasMedias();
        	foreach ($medias as $key => $value) {
        		$media = $value->getMedia();
				$product->addMedia($media);
        	}
        	$productsWithMedia[] = $product;
        }
        
        $serializer = $this->get('jms_serializer');
		$productsJson = $serializer->serialize($productsWithMedia, 'json');

        return new Response($productsJson);
    }

    /**
     * @Rest\Get("/api/product/{slug}" , name="api_product")
     */
    public function getProductAction(Request $request)
    {
        $product = $this->getDoctrine()->getManager()->getRepository(Product::class)->findOneBy(array('slug' => $request->get('slug')));

        $medias = $product->getGallery()->getGalleryHasMedias();
        foreach ($medias as $key => $value) {
            $media = $value->getMedia();
            $product->addMedia($media);
        }

        $serializer = $this->get('jms_serializer');
		$productJson = $serializer->serialize($product, 'json');

        return new Response($productJson);
    }
}
