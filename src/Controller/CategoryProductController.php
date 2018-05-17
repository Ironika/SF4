<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\CategoryProduct;

class CategoryProductController extends Controller
{
    /**
     * @Route("/category/list", name="contact")
     */
    public function listAction(Request $request)
    {
        $categories = $this->getDoctrine()->getManager()->getRepository(CategoryProduct::class)->findAll();
        // replace this example code with whatever you need
        return $this->render('categories-list.html.twig', array(
            'categories' => $categories
        ));
    }
}
