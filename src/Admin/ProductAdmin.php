<?php 

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Size;
use App\Entity\Material;
use App\Entity\Collection;
use App\Entity\CategoryProduct;
use App\Entity\Shape;

class ProductAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextType::class);
        $formMapper->add('collection', EntityType::class, [
                'class' => Collection::class
            ]);
        $formMapper->add('sizes', EntityType::class, [
                'class' => Size::class,
                'multiple' => true
            ]);
        $formMapper->add('materials', EntityType::class, [
                'class' => Material::class,
                'multiple' => true
            ]);
        $formMapper->add('shapes',EntityType::class, [
                'class' => Shape::class,
                'multiple' => true
            ]);
        $formMapper->add('category',EntityType::class, [
                'class' => CategoryProduct::class
            ]);
        $formMapper->add('price', TextType::class);
        $formMapper->add('gallery', ModelListType::class);
        $formMapper->add('shortDescription', TextareaType::class, array(
            'attr' => array(
                'class' => 'tinymce',
                'data-theme' => 'bbcode'
               )
        ));
        $formMapper->add('description', TextareaType::class, array(
            'attr' => array(
                'class' => 'tinymce',
                'data-theme' => 'bbcode'
               )
        ));

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
        $listMapper->add('createdAt');
        $listMapper->add('category');
        $listMapper->add('collection');
        $listMapper->add('sizes');
        $listMapper->add('materials');
        $listMapper->add('shapes');
        $listMapper->add('shortDescription');
        $listMapper->add('description');
        $listMapper->add('price');
        $listMapper->add('gallery');
    }
}

?>