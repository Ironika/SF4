<?php
 
namespace App\Form\Type;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use App\Entity\Product;
use App\Entity\Size;
use App\Entity\Material;
use App\Entity\Shape;
 
class OrderProductFormType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options)
   {
      $builder->add('product', EntityType::class, [
         'class' => Product::class
      ]);
      $builder->add('quantity', IntegerType::class);
      $builder->add('size',EntityType::class, [
         'class' => Size::class,
         'required' => false
      ]);
      $builder->add('shape', EntityType::class, [
         'class' => Shape::class,
         'required' => false
      ]);
      $builder->add('material', EntityType::class, [
         'class' => Material::class,
         'required' => false
      ]);
   }
 
   public function getBlockPrefix()
   {
       return 'app_order_product';
   }
}