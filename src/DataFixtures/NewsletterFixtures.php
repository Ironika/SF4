<?php

namespace App\DataFixtures;

use App\Entity\Newsletter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class NewsletterFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $newsletter1 = new Newsletter();
        $newsletter1->setTitle('Check our new Products !');
        $newsletter1->setContent("<p>Hey ! We got some new stuffs ! Take a look on our last products !</p> <p>See you soon on&nbsp;<a href='http://symfony4.fr/'>Ineluctable</a>&nbsp;!</p>");
        $newsletter1->AddProduct($this->getReference('product1'));
        $newsletter1->AddProduct($this->getReference('product2'));
        $newsletter1->AddProduct($this->getReference('product3'));
        $newsletter1->AddProduct($this->getReference('product4'));

        $newsletter2 = new Newsletter();
        $newsletter2->setTitle('Check our new Stuffs !');
        $newsletter2->setContent("<p>Hey ! We got some new stuffs ! Take a look on our last products !</p> <p>See you soon on&nbsp;<a href='http://symfony4.fr/'>Ineluctable</a>&nbsp;!</p>");
        $newsletter2->AddProduct($this->getReference('product4'));
        $newsletter2->AddProduct($this->getReference('product5'));
        $newsletter2->AddProduct($this->getReference('product2'));
        $newsletter2->AddProduct($this->getReference('product1'));

        $manager->persist($newsletter1);
        $manager->persist($newsletter2);

        $manager->flush();

        $this->addReference('newsletter1', $newsletter1);
        $this->addReference('newsletter2', $newsletter2);
    }

    public function getDependencies()
    {
        return array(
            ProductFixtures::class,
        );
    }
}