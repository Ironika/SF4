<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

use App\Entity\Blog;
use App\Entity\Product;

class SearchApiController extends FOSRestController
{
	/**
     * @Rest\Get("/api/search", name="api_search")
     */
    public function getSearchAction(Request $request)
    {
        $repoBlogs = $this->getDoctrine()->getManager()->getRepository(Blog::class);
        $queryBlogs = $repoBlogs->createQueryBuilder('b')
            ->where('b.title LIKE :title')
            ->setParameter('title', '%' . $request->get('search') .'%')
            ->getQuery();
        $blogs = $queryBlogs->getResult();

        $repoProducts = $this->getDoctrine()->getManager()->getRepository(Product::class);
        $queryProducts = $repoProducts->createQueryBuilder('p')
            ->where('p.name LIKE :title')
            ->setParameter('title', '%' . $request->get('search') .'%')
            ->getQuery();
        $products = $queryProducts->getResult();

        $productsWithMedia = array();

        foreach ($products as $key => $product) {
            $medias = $product->getGallery()->getGalleryHasMedias();
            foreach ($medias as $key => $value) {
                $media = $value->getMedia();
                $product->addMedia($media);
            }
            $productsWithMedia[] = $product;
        }

        $total = $this->getTotal($blogs) + $this->getTotal($productsWithMedia);

        $results = [$blogs, $productsWithMedia, $total];
        
        $serializer = $this->get('jms_serializer');
		$resultsJson = $serializer->serialize($results, 'json');

        return new Response($resultsJson);
    }

    private function getTotal($array) {
        $total = 0;
        foreach ($array as $value) {
            $total++;
        }
        return $total;
    }
}
