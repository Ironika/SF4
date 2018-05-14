<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Tag;
use App\Entity\Blog;
use App\Entity\Product;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

class BlogController extends Controller
{
    /**
     * @Route("/blog", name="blog")
     */
    public function indexAction(Request $request)
    {
        $tags = $this->getDoctrine()->getManager()->getRepository(Tag::class)->findAll();

        $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder()->select('p')->from(Product::class, 'p')->orderBy('p.createdAt', 'DESC')->setMaxResults(3);
        $products = $qb->getQuery()->getResult();

        $page = 1;
        if($request->get('page'))
            $page = $request->get('page');

        if($request->get('tag')) 
            $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder()->select('b')->from(Blog::class, 'b')->join('b.tags', 't')->where('t.id = :tag')->orderBy('b.createdAt', 'DESC')->setParameter('tag', $request->get('tag'));
        else
            $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder()->select('b')->from(Blog::class, 'b')->orderBy('b.createdAt', 'DESC');

        $adapter = new DoctrineORMAdapter($qb);
        $pagerfanta = new Pagerfanta($adapter);
     
        try {
            $blogs = $pagerfanta
                ->setMaxPerPage(2)
                ->setCurrentPage($page)
                ->getCurrentPageResults()
            ;
        } catch (\Pagerfanta\Exception\NotValidCurrentPageException $e) {
            throw $this->createNotFoundException("Page not found");
        }

        return $this->render('blog.html.twig', array(
            'tags' => $tags,
            'blogs' => $blogs,
            'pager' => $pagerfanta,
            'products' => $products
        ));
    }

    /**
     * @Route("/blog/{id}", name="blog_detail")
     */
    public function showAction(Request $request)
    {
        $blog = $this->getDoctrine()->getManager()->getRepository(Blog::class)->find($request->get('id'));
        $tags = $this->getDoctrine()->getManager()->getRepository(Tag::class)->findAll();
        $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder()->select('p')->from(Product::class, 'p')->orderBy('p.createdAt', 'DESC')->setMaxResults(3);
        $products = $qb->getQuery()->getResult();

        return $this->render('blog-detail.html.twig', array(
            'blog' => $blog,
            'tags' => $tags,
            'products' => $products
        ));
    }
}
