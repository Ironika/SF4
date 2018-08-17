<?php

namespace App\DataFixtures;

use App\Entity\Size;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SizeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $size1 = new Size();
        $size1->setName('xs');

        $size2 = new Size();
        $size2->setName('s');

        $size3 = new Size();
        $size3->setName('m');


        $manager->persist($size1);
        $manager->persist($size2);
        $manager->persist($size3);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('size1', $size1);
        $this->addReference('size2', $size2);
        $this->addReference('size3', $size3);
    }
}