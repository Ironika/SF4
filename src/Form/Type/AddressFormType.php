<?php
 
namespace App\Form\Type;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
 
class AddressFormType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options)
   {
      $builder->add('street');
      $builder->add('streetAdd');
      $builder->add('city');
      $builder->add('zipcode');
      $builder->add('state');
      $builder->add('country');
   }
 
   public function getBlockPrefix()
   {
       return 'app_address';
   }
}