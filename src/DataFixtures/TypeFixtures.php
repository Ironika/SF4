<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TypeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $type1 = new Type();
        $type1->setName('Jewels');
        $type1->addCategory($this->getReference('category1'));
        $type1->addCategory($this->getReference('category2'));
        $type1->addCategory($this->getReference('category3'));
        $type1->addCategory($this->getReference('category4'));
        $type1->addCategory($this->getReference('category5'));
        $type1->addCategory($this->getReference('category6'));

        $type2 = new Type();
        $type2->setName('Accessory');

        $type3 = new Type();
        $type3->setName('Decorations');


        $manager->persist($type1);
        $manager->persist($type2);
        $manager->persist($type3);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('type1', $type1);
        $this->addReference('type2', $type2);
        $this->addReference('type3', $type3);
    }

    public function getDependencies()
    {
        return array(
            CategoryFixtures::class,
        );
    }
}