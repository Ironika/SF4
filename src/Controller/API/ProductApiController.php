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

        $serializer = $this->get('jms_serializer');
		$productJson = $serializer->serialize($product, 'json');

        return new Response($productJson);
    }

    /**
     * @Rest\Post("/api/product/add", name="api_product_add")
     */
    public function postProductAction(Request $request)
    {
        $product = new Product();
        $product->setName($request->request->get('name'));
        $product->setPrice($request->request->get('price'));
        $product->setDescription($request->request->get('description'));
        $product->setCollection($request->request->get('collection'));
        $product->setCategory($request->request->get('category'));

        if($request->request->get('sizes')) {
        	foreach ($request->request->get('sizes') as $value) {
        		$size = $this->getDoctrine()->getManager()->getRepository(Size::class)->find($value);
        		$product->addSize($size);
        	}
        }

        if($request->request->get('materials')) {
        	foreach ($request->request->get('materials') as $value) {
        		$material = $this->getDoctrine()->getManager()->getRepository(Material::class)->find($value);
        		$product->addMaterial($material);
        	}
        }

        if($request->request->get('shapes')) {
        	foreach ($request->request->get('shapes') as $value) {
        		$shape = $this->getDoctrine()->getManager()->getRepository(Shape::class)->find($value);
        		$product->addShape($shape);
        	}
        }

        $gallery = $this->createGallery($request->request->get('name'));

        if($request->request->get('gallery')) {
        	foreach ($request->request->get('gallery') as $key => $value) {
        		$mediaFile = new File($value);
		        $media = $this->createMedia($mediaFile, $request->request->get('name') . $key . '.jpg');
		        $galleryHasMedia = $this->createGalleryHasMedia($media);
		        $gallery->addGalleryHasMedia($galleryHasMedia);
        	}
        }

        $product->setGallery($gallery);

        $this->getDoctrine()->getManager()->persist($product);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Product Saved !"
        );

        $serializer = $this->get('jms_serializer');
		$response = $serializer->serialize($response, 'json');

        return new Response($response);
    }

    /**
     * @Rest\Put("/api/product/{slug}", name="api_product_update")
     */
    public function putProductAction(Request $request)
    {
        $product = $this->getDoctrine()->getManager()->getRepository(Product::class)->findOneBy(array('slug' => $request->get('slug')));
        
        if($request->request->get('name'))
        	$product->setName($request->request->get('name'));
        if($request->request->get('price'))
        	$product->setPrice($request->request->get('price'));
        if($request->request->get('description'))
        	$product->setDescription($request->request->get('description'));
        if($request->request->get('collection'))
        	$product->setCollection($request->request->get('collection'));
        if($request->request->get('category'))
        	$product->setCategory($request->request->get('category'));

        if($request->request->get('sizes')) {
        	$product->setSizes(new arrayCollection());
        	foreach ($request->request->get('sizes') as $value) {
        		$size = $this->getDoctrine()->getManager()->getRepository(Size::class)->find($value);
        		$product->addSize($size);
        	}
        }

        if($request->request->get('materials')) {
        	$product->setMaterials(new arrayCollection());
        	foreach ($request->request->get('materials') as $value) {
        		$material = $this->getDoctrine()->getManager()->getRepository(Material::class)->find($value);
        		$product->addMaterial($material);
        	}
        }

        if($request->request->get('shapes')) {
        	$product->setShapes(new arrayCollection());
        	foreach ($request->request->get('materials') as $value) {
        		$shape = $this->getDoctrine()->getManager()->getRepository(Shape::class)->find($value);
        		$product->addShape($shape);
        	}
        }

        $this->getDoctrine()->getManager()->persist($product);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Product updated !"
        );

        $serializer = $this->get('jms_serializer');
		$response = $serializer->serialize($response, 'json');

        return new Response($response);
    }

   	/**
     * @Rest\Delete("/api/product/{slug}", name="api_product_delete")
     */
    public function deleteProductAction(Request $request)
    {
        $product = $this->getDoctrine()->getManager()->getRepository(Product::class)->findOneBy(array('slug' => $request->get('slug')));

        $this->getDoctrine()->getManager()->remove($product);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Product deleted !"
        );

        $serializer = $this->get('jms_serializer');
		$response = $serializer->serialize($response, 'json');

        return new Response($response);
    }

    public function createMedia($file, $filename)
    {
        $mediaManager = $this->container->get('sonata.media.manager.media');

        $media = $mediaManager->create();
        $media->setEnabled(true);
        $media->setBinaryContent($file);
        $media->setName($filename);
        $media->setContext('default');
        $media->setProviderName('sonata.media.provider.image');
        $media->setProviderStatus(1);

        $mediaManager->save($media);

        return $media;
    }

    public function createGalleryHasMedia($media){
        $galleryHasMedia = new GalleryHasMedia();
        $galleryHasMedia->setMedia($media);
        $galleryHasMedia->setEnabled(true);

        return $galleryHasMedia;
    }

    protected function createGallery($name) {
        $gallery = new Gallery();
        $gallery->setName($name);
        $gallery->setEnabled(true);
        $gallery->setContext('default');
        $gallery->setDefaultFormat('big');

        return $gallery;
    }

}
