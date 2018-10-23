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
        $category1->setName('Bracelets');

        $category2 = new CategoryProduct();
        $category2->setName('Colliers');

        $category3 = new CategoryProduct();
        $category3->setName("Boucles d'Oreille");

        $category4 = new CategoryProduct();
        $category4->setName("Broches");

        $category5 = new CategoryProduct();
        $category5->setName("Raz-de-Cou");

        $category6 = new CategoryProduct();
        $category6->setName("Bagues");

        $manager->persist($category1);
        $manager->persist($category2);
        $manager->persist($category3);
        $manager->persist($category4);
        $manager->persist($category5);
        $manager->persist($category6);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('category1', $category1);
        $this->addReference('category2', $category2);
        $this->addReference('category3', $category3);
        $this->addReference('category4', $category4);
        $this->addReference('category5', $category5);
        $this->addReference('category6', $category6);
    }
}