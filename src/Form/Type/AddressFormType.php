<?php
 
namespace App\Form\Type;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
 
class AddressFormType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options)
   {
      $builder->add('street');
      $builder->add('city');
      $builder->add('zipcode');
      $builder->add('country');
   }
 
   public function getBlockPrefix()
   {
       return 'app_address';
   }

   // public function configureOptions(OptionsResolver $resolver)
   //  {
   //      $resolver->setDefaults(array(
   //          'data_class' => Address::class,
   //      ));
   //  }
}