<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Blog;
use App\Entity\Product;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="search")
     */
    public function indexAction(Request $request)
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

        return $this->render('search.html.twig', array(
        	'search' => $request->get('search'),
            'blogs' => $blogs,
            'products' => $products
        ));
    }
}
