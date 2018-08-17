<?php

namespace App\DataFixtures;

use App\Entity\CategoryProduct;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category1 = new CategoryProduct();
        $category1->setName('Bracelet');

        $category2 = new CategoryProduct();
        $category2->setName('Collier');

        $category3 = new CategoryProduct();
        $category3->setName("Boucle d'oreille");


        $manager->persist($category1);
        $manager->persist($category2);
        $manager->persist($category3);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('category1', $category1);
        $this->addReference('category2', $category2);
        $this->addReference('category3', $category3);
    }
}