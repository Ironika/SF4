<?php

namespace App\DataFixtures;

use App\Entity\Color;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ColorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $color1 = new Color();
        $color1->setName('Black & White');

        $color2 = new Color();
        $color2->setName('Black');

        $color3 = new Color();
        $color3->setName('Moon');

        $color4 = new Color();
        $color4->setName('Moon Crater');

        $color5 = new Color();
        $color5->setName('Red');

        $manager->persist($color1);
        $manager->persist($color2);
        $manager->persist($color3);
        $manager->persist($color4);
        $manager->persist($color5);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('color1', $color1);
        $this->addReference('color2', $color2);
        $this->addReference('color3', $color3);
        $this->addReference('color4', $color4);
        $this->addReference('color5', $color5);
    }
}