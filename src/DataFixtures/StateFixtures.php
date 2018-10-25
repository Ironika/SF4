<?php

namespace App\DataFixtures;

use App\Entity\State;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class StateFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $state1 = new State();
        $state1->setName('Promo');

        $state2 = new State();
        $state2->setName('News');

        $state3 = new State();
        $state3->setName('Tendance');


        $manager->persist($state1);
        $manager->persist($state2);
        $manager->persist($state3);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('state1', $state1);
        $this->addReference('state2', $state2);
        $this->addReference('state3', $state3);
    }
}