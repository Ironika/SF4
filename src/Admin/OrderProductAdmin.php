<?php 

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
// use Symfony\Component\Form\Extension\Core\Type\CollectionType;
// use Sonata\AdminBundle\Form\Type\CollectionType;
use Sonata\CoreBundle\Form\Type\CollectionType;
use App\Entity\Product;
use App\Entity\Size;
use App\Entity\Shape;
use App\Entity\Material;

class OrderProductAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('product', EntityType::class, [
                'class' => Product::class
        ]);
        $formMapper->add('quantity');
        $formMapper->add('size', EntityType::class, [
                'class' => Size::class,
                'required' => false
        ]);
        $formMapper->add('shape', EntityType::class, [
                'class' => Shape::class,
                'required' => false
        ]);
        $formMapper->add('material', EntityType::class, [
                'class' => Material::class,
                'required' => false
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->add('product');
        $listMapper->add('quantity');
        $listMapper->add('size');
        $listMapper->add('shape');
        $listMapper->add('material');
        $listMapper->add('order');
    }
}

?>