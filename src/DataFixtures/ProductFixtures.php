<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $eclipse = new Product();
        $eclipse->setGallery($this->createGallery('eclipse'));
        $eclipse->setName('Eclipse');
        $eclipse->setPrice('49.99');
        $eclipse->setDescription("Au départ de l'Héliport de Paris, embarquez à bord d’un hélicoptère bimoteurs 5 ou 6 places,
            pour une découverte de l’ouest parisien vu du ciel.
            1H30 d’expérience avec 25 min de vol magique et sensationnelle pendant lesquelles vous profiterez
            du panorama : Rives ouest de la Seine, Parc des Princes, bois de Boulogne, hippodrome de Longchamp,
            parc de Saint-Cloud ainsi que Versailles et les jardins du Roi Soleil");
        
        $manager->persist($eclipe);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('admin', $admin);
        $this->addReference('customer1', $customer1);
        $this->addReference('customer2', $customer2);
    }

    protected function createGallery($name) {
        $gallery = new Gallery();
        $gallery->setName($name);
        $gallery->setEnabled(true);
        $gallery->setContext('default');
        $gallery->setDefaultFormat('big');

        return $gallery;
    }
}