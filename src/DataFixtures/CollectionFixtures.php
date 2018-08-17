<?php

namespace App\DataFixtures;

use App\Entity\Collection;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CollectionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $collection1 = new Collection();
        $collection1->setName('Collection1');

        $collection2 = new Collection();
        $collection2->setName('Collection2');

        $collection3 = new Collection();
        $collection3->setName("Collection3");


        $manager->persist($collection1);
        $manager->persist($collection2);
        $manager->persist($collection3);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('collection1', $collection1);
        $this->addReference('collection2', $collection2);
        $this->addReference('collection3', $collection3);
    }
}