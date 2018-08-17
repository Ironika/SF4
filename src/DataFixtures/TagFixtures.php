<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tag1 = new Tag();
        $tag1->setName('Tag1');

        $tag2 = new Tag();
        $tag2->setName('Tag2');

        $tag3 = new Tag();
        $tag3->setName("Tag3");


        $manager->persist($tag1);
        $manager->persist($tag2);
        $manager->persist($tag3);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('tag1', $tag1);
        $this->addReference('tag2', $tag2);
        $this->addReference('tag3', $tag3);
    }
}