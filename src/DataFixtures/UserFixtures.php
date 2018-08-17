<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setEmail('admin@admin.com');
        $admin->setEnabled(true);
        $admin->setPlainPassword('admin');
        $admin->setUsername('admin');
        $admin->setSuperAdmin(true);

        $customer1 = new User();
        $customer1->setEmail('customer1@customer1.com');
        $customer1->setEnabled(true);
        $customer1->setPlainPassword('customer1');
        $customer1->setUsername('customer1');

        $customer2 = new User();
        $customer2->setEmail('customer2@customer2.com');
        $customer2->setEnabled(true);
        $customer2->setPlainPassword('customer2');
        $customer2->setUsername('customer2');


        $manager->persist($admin);
        $manager->persist($customer1);
        $manager->persist($customer2);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('admin', $admin);
        $this->addReference('customer1', $customer1);
        $this->addReference('customer2', $customer2);
    }
}