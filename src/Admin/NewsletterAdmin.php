<?php 

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Product;
use Sonata\AdminBundle\Route\RouteCollection;

class NewsletterAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title', TextType::class);
        $formMapper->add('content', TextareaType::class, array(
            'required' => false,
            'label' => 'Content *'
        ));
        $formMapper->add('products', EntityType::class, [
            'class' => Product::class,
            'multiple' => true,
            'required' => false
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title');
        $listMapper->add('content');
        $listMapper->add('products');
        $listMapper->add('_action', 'actions', array(
                'actions' => array(
                    'Mail' => array(
                        'template' => 'CRUD/list__action_mail.html.twig'
                    )
                )
            )
        );
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('mail', $this->getRouterIdParameter().'/mail');
    }
}

?>