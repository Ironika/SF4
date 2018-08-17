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
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Entity\User;
use App\Entity\OrderProduct;
use App\Form\Type\OrderProductFormType;

class OrderAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('state', ChoiceType::class, array(
            'choices'  => array(
                'PROCESSING' => 'PROCESSING',
                'DONE' => 'DONE'
            )
        ));
        $formMapper->add('user', EntityType::class, [
                'class' => User::class
        ]);
        $formMapper->add('orderProducts', CollectionType::class, array(
            'entry_type' => OrderProductFormType::class,
            'allow_add' => true,
            'allow_delete' => true
        ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('uniqId');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('uniqId');
        $listMapper->add('createdAt');
        $listMapper->add('state');
        $listMapper->add('total');
        $listMapper->add('orderProducts');
        $listMapper->add('user');
    }
}

?>