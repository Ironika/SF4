<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\CategoryProduct;
use App\Entity\Product;
use App\Entity\Slide;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $categories = $this->getDoctrine()->getManager()->getRepository(CategoryProduct::class)->findAll();

        $slides = $this->getDoctrine()->getManager()->getRepository(Slide::class)->findAll();

        $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder()->select('p')->from(Product::class, 'p')->orderBy('p.createdAt', 'DESC')->setMaxResults(10);
        $products = $qb->getQuery()->getResult();

        return $this->render('home.html.twig', array(
            'categories' => $categories,
            'products' => $products,
            'slides' => $slides
        ));
    }
}
