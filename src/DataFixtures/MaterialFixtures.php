<?php

namespace App\DataFixtures;

use App\Entity\Material;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MaterialFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $material1 = new Material();
        $material1->setName('Moonstone');

        $material2 = new Material();
        $material2->setName('Labradorite');

        $material3 = new Material();
        $material3->setName('Opal');

        $material4 = new Material();
        $material4->setName('Black');

        $material5 = new Material();
        $material5->setName('Abalone Nacre');

        $manager->persist($material1);
        $manager->persist($material2);
        $manager->persist($material3);
        $manager->persist($material4);
        $manager->persist($material5);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('material1', $material1);
        $this->addReference('material2', $material2);
        $this->addReference('material3', $material3);
        $this->addReference('material4', $material4);
        $this->addReference('material5', $material5);
    }
}