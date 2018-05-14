<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use App\Entity\CategoryProduct;

class ProductController extends Controller
{
    /**
     * @Route("/products", name="products")
     */
    public function indexAction(Request $request)
    {
        $categories = $this->getDoctrine()->getManager()->getRepository(CategoryProduct::class)->findAll();
        $products = $this->getDoctrine()->getManager()->getRepository(Product::class)->findAll();

        // replace this example code with whatever you need
        return $this->render('products.html.twig', array(
            'categories' => $categories,
            'products' => $products
        ));
    }

    /**
     * @Route("/product/{id}", name="product_detail")
     */
    public function showAction(Request $request)
    {
        $product = $this->getDoctrine()->getManager()->getRepository(Product::class)->find($request->get('id'));

        // replace this example code with whatever you need
        return $this->render('product-detail.html.twig', array(
            'product' => $product,
        ));
    }

    /**
     * @Route("/modal/product/{id}", name="modal_product_detail")
     */
    public function modalAction(Request $request)
    {
        $product = $this->getDoctrine()->getManager()->getRepository(Product::class)->find($request->get('id'));

        // replace this example code with whatever you need
        return $this->render('modal-product.html.twig', array(
            'product' => $product,
        ));
    }
}
