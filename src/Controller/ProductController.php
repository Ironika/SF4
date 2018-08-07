<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use App\Entity\CategoryProduct;
use App\Entity\Size;
use App\Entity\Shape;
use App\Entity\Material;

class ProductController extends Controller
{
    /**
     * @Route("/products", name="products")
     */
    public function indexAction(Request $request)
    {
        $categories = $this->getDoctrine()->getManager()->getRepository(CategoryProduct::class)->findAll();
        $shapes = $this->getDoctrine()->getManager()->getRepository(Shape::class)->findAll();
        $materials = $this->getDoctrine()->getManager()->getRepository(Material::class)->findAll();

        $current_category = null;
        if($request->query->get('current_category')) {
            $current_category = $this->getDoctrine()->getManager()->getRepository(CategoryProduct::class)->findOneBy(array('name' => $request->query->get('current_category')));
        }

        $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder()->select('p')->from(Product::class, 'p');

        if($request->request->get('material') && $request->request->get('material') !== 'all')
            $qb->join('p.materials', 'm')->where('m.id = :material')->setParameter('material', $request->request->get('material'));
        if($request->request->get('shape') && $request->request->get('shape') !== 'all')
            $qb->join('p.shapes', 's')->where('s.id = :shape')->setParameter('shape', $request->request->get('shape'));

        $products = $qb->getQuery()->getResult();

        // replace this example code with whatever you need
        return $this->render('products.html.twig', array(
            'categories' => $categories,
            'products' => $products,
            'current_category' => $current_category,
            'shapes' => $shapes,
            'materials' => $materials
        ));
    }

    /**
     * @Route("/product/{slug}", name="product_detail")
     */
    public function showAction(Request $request)
    {
        $product = $this->getDoctrine()->getManager()->getRepository(Product::class)->findOneBy(array('slug' => $request->get('slug')));
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
