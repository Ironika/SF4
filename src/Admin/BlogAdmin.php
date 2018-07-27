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
use App\Entity\Tag;

class BlogAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title', TextType::class);
        $formMapper->add('tags', EntityType::class, [
            'class' => Tag::class,
            'multiple' => true
        ]);
        $formMapper->add('content', TextareaType::class, array(
            'attr' => array(
                //'class' => 'tinymce',
                // 'data-theme' => 'bbcode'
               )
        ));
        $formMapper->add('media', ModelListType::class, array());
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
        $datagridMapper->add('content');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title');
        $listMapper->add('media', 'string', array('template' => '@SonataMedia/MediaAdmin/list_image.html.twig'));
        $listMapper->add('content');
        $listMapper->add('tags');
        $listMapper->add('createdAt');
    }
}

?>