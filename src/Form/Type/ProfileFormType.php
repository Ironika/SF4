<?php
 
namespace App\Form\Type;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use App\Form\Type\AddressFormType;
use App\Entity\AddressDelivery;
use App\Entity\AddressBilling;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ProfileFormType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options)
   {
      $builder->add('firstName');
      $builder->add('lastName');
      $builder->add('addressDelivery', AddressFormType::class, array(
        'data_class' => AddressDelivery::class
      ));
      $builder->add('addressBilling', AddressFormType::class, array(
        'data_class' => AddressBilling::class
      ));
      $builder->add('haveSubscribeNewsletter', CheckboxType::class, array(
          'label'    => 'Subscribe to the newsletter?',
          'required' => false,
      ));
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