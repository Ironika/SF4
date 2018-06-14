<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use App\Entity\CategoryProduct;
use App\Entity\Size;
use App\Entity\Shape;

class ProductController extends Controller
{
    /**
     * @Route("/products", name="products")
     */
    public function indexAction(Request $request)
    {
        $categories = $this->getDoctrine()->getManager()->getRepository(CategoryProduct::class)->findAll();
        $products = $this->getDoctrine()->getManager()->getRepository(Product::class)->findAll();

        $current_category = null;
        if($request->query->get('current_category')) {
            $current_category = $this->getDoctrine()->getManager()->getRepository(CategoryProduct::class)->findOneBy(array('name' => $request->query->get('current_category')));
        }

        // replace this example code with whatever you need
        return $this->render('products.html.twig', array(
            'categories' => $categories,
            'products' => $products,
            'current_category' => $current_category
        ));
    }

    /**
     * @Route("/product/{id}", name="product_detail")
     */
    public function showAction(Request $request)
    {
        $product = $this->getDoctrine()->getManager()->getRepository(Product::class)->find($request->get('id'));
        $products = $this->getDoctrine()->getManager()->getRepository(Product::class)->findBy(array('collection' => $product->getCollection()));

        // replace this example code with whatever you need
        return $this->render('product-detail.html.twig', array(
            'product' => $product,
            'products' => $products
        ));
    }

    // /**
    //  * @Route("/modal/product/{id}", name="modal_product_detail")
    //  */
    // public function modalAction(Request $request)
    // {
    //     $product = $this->getDoctrine()->getManager()->getRepository(Product::class)->find($request->get('id'));

    //     // replace this example code with whatever you need
    //     return $this->render('modal-product.html.twig', array(
    //         'product' => $product,
    //     ));
    // }
}
