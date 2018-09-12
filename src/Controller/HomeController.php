<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


use App\Entity\CategoryProduct;
use App\Entity\Product;
use App\Entity\Blog;
use App\Entity\Slide;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $instaManager = $this->get('instagram_manager');

        if(!$this->get('session')->get('instagram_token')) {
            $url = $this->generateUrl('instagram', array(), UrlGeneratorInterface::ABSOLUTE_URL);
            return $this->redirect('https://www.instagram.com/oauth/authorize/?client_id=16bef087e682469b9c722021d002f994&redirect_uri='. $url . '&response_type=code');
        }

        $instagramMedias = $instaManager->getMedias();

        $categories = $this->getDoctrine()->getManager()->getRepository(CategoryProduct::class)->findAll();

        $slides = $this->getDoctrine()->getManager()->getRepository(Slide::class)->findAll();

        $qb = $this->getDoctrine()->getManager()->createQueryBuilder()->select('p')->from(Product::class, 'p')->orderBy('p.createdAt', 'DESC')->setMaxResults(8);
        $products = $qb->getQuery()->getResult();

        $qb = $this->getDoctrine()->getManager()->createQueryBuilder()->select('b')->from(Blog::class, 'b')->orderBy('b.createdAt', 'DESC')->setMaxResults(3);
        $blogs = $qb->getQuery()->getResult();

        return $this->render('home.html.twig', array(
            'categories' => $categories,
            'products' => $products,
            'blogs' => $blogs,
            'slides' => $slides,
            'instagramMedias' => $instagramMedias
        ));
    }

    /**
     * @Route("/instagram", name="instagram")
     */
    public function InstagramAction(Request $request) {
        $instaManager = $this->get('instagram_manager');
        $url = $this->generateUrl('instagram', array(), UrlGeneratorInterface::ABSOLUTE_URL);
        $instaManager->getAccessToken($url, $request->query->get('code'));

        return $this->redirect($this->generateUrl('homepage'));
    }
}
