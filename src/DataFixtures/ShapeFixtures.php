<?php

namespace App\DataFixtures;

use App\Entity\Shape;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ShapeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $shape1 = new Shape();
        $shape1->setName('Oval');

        $shape2 = new Shape();
        $shape2->setName('Round');

        $shape3 = new Shape();
        $shape3->setName('Drop');


        $manager->persist($shape1);
        $manager->persist($shape2);
        $manager->persist($shape3);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('shape1', $shape1);
        $this->addReference('shape2', $shape2);
        $this->addReference('shape3', $shape3);
    }
}