<?php

namespace App\DataFixtures;

use App\Entity\SubscriberNewsletter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SubscriberNewsletterFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $subscriberNewsletter1 = new SubscriberNewsletter('kekeoh91@gmail.com');
        $subscriberNewsletter2 = new SubscriberNewsletter('mayumi-chan@hotmail.fr');

        $manager->persist($subscriberNewsletter1);
        $manager->persist($subscriberNewsletter2);

        $manager->flush();

        $this->addReference('subscriberNewsletter1', $subscriberNewsletter1);
        $this->addReference('subscriberNewsletter2', $subscriberNewsletter2);
    }
}