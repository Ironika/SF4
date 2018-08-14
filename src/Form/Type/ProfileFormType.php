<?php
 
namespace App\Form\Type;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use App\Form\Type\AddressFormType;
use App\Entity\AddressDelivery;
use App\Entity\AddressBilling;

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