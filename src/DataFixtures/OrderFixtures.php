<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\OrderProduct;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OrderFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $orderProduct1 = new OrderProduct();
        $orderProduct1->setProduct($this->getReference('product1'));
        $orderProduct1->setSize($this->getReference('size1'));
        $orderProduct1->setMaterial($this->getReference('material1'));
        $orderProduct1->setShape($this->getReference('shape1'));
        $orderProduct1->setQuantity(1);

        $orderProduct2 = new OrderProduct();
        $orderProduct2->setProduct($this->getReference('product2'));
        $orderProduct2->setSize($this->getReference('size2'));
        $orderProduct2->setMaterial($this->getReference('material2'));
        $orderProduct2->setShape($this->getReference('shape2'));
        $orderProduct2->setQuantity(2);

        $order1 = new Order();
        $order1->setUser($this->getReference('customer1'));
        $order1->addOrderProduct($orderProduct1);
        $order1->addOrderProduct($orderProduct2);
        $order1->getTotal();

        // -------- ORDER 2

        $orderProduct3 = new OrderProduct();
        $orderProduct3->setProduct($this->getReference('product3'));
        $orderProduct3->setSize($this->getReference('size1'));
        $orderProduct3->setMaterial($this->getReference('material1'));
        $orderProduct3->setShape($this->getReference('shape1'));
        $orderProduct3->setQuantity(1);

        $orderProduct4 = new OrderProduct();
        $orderProduct4->setProduct($this->getReference('product4'));
        $orderProduct4->setSize($this->getReference('size2'));
        $orderProduct4->setMaterial($this->getReference('material2'));
        $orderProduct4->setShape($this->getReference('shape2'));
        $orderProduct4->setQuantity(2);

        $order2 = new Order();
        $order2->setUser($this->getReference('customer1'));
        $order2->setState('DONE');
        $order2->addOrderProduct($orderProduct3);
        $order2->addOrderProduct($orderProduct4);
        $order2->getTotal();

        // -------- ORDER 3

        $orderProduct5 = new OrderProduct();
        $orderProduct5->setProduct($this->getReference('product5'));
        $orderProduct5->setSize($this->getReference('size2'));
        $orderProduct5->setMaterial($this->getReference('material2'));
        $orderProduct5->setShape($this->getReference('shape2'));
        $orderProduct5->setQuantity(3);

        $order3 = new Order();
        $order3->setUser($this->getReference('customer2'));
        $order3->addOrderProduct($orderProduct5);
        $order3->getTotal();

        $manager->persist($order1);
        $manager->persist($order2);
        $manager->persist($order3);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('order1', $order1);
        $this->addReference('order2', $order2);
        $this->addReference('order3', $order3);
    }

    public function getDependencies()
    {
        return array(
            ProductFixtures::class,
            UserFixtures::class,
        );
    }
}