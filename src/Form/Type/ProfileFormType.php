<?php
 
namespace App\Form\Type;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Address;
use App\Form\Type\AddressFormType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
 
class ProfileFormType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options)
   {
      $builder->add('firstName');
      $builder->add('lastName');
      // $builder->add(
      //   $builder->create('address', FormType::class, array('by_reference' => false))
      //         ->add('address', TextType::class)
      //         ->add('city', TextType::class)
      //         ->add('zipcode', TextType::class)
      //         ->add('country', TextType::class)
      // );
      // $builder->add('address',CollectionType::class,array(
      //   'entry_type'=> AddressFormType::class,
      //   'allow_add'=>true,
      //   'allow_delete'=>true
      // ));
   }
 
   public function getParent()
   {
       return 'FOS\UserBundle\Form\Type\ProfileFormType';
 
   }
 
   public function getBlockPrefix()
   {
       return 'app_user_profile';
   }
}