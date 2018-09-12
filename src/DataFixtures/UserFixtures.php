<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\AddressDelivery;
use App\Entity\AddressBilling;
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
        $admin->setHaveSubscribeNewsletter(false);

        // -------- Customer 1

        $addressDelivery1 = new AddressDelivery();
        $addressDelivery1->setStreet('32 rue des Pommes');
        $addressDelivery1->setCity('Lisses');
        $addressDelivery1->setCountry('France');
        $addressDelivery1->setZipcode('91300');

        $addressBilling1 = new AddressBilling();
        $addressBilling1->setStreet('45 rue des Peches');
        $addressBilling1->setCity('Mennecy');
        $addressBilling1->setCountry('France');
        $addressBilling1->setZipcode('91500');

        $customer1 = new User();
        $customer1->setEmail('customer1@customer1.com');
        $customer1->setEnabled(true);
        $customer1->setPlainPassword('customer1');
        $customer1->setUsername('customer1');
        $customer1->setFirstName('Jean Claude');
        $customer1->setLastName('Vandame');
        $customer1->setAddressDelivery($addressDelivery1);
        $customer1->setAddressBilling($addressBilling1);
        $customer1->setHaveSubscribeNewsletter(true);

        // -------- Customer 2

        $addressDelivery2 = new AddressDelivery();
        $addressDelivery2->setStreet('45 rue des Prunnes');
        $addressDelivery2->setCity('Vincennes');
        $addressDelivery2->setCountry('France');
        $addressDelivery2->setZipcode('92300');

        $addressBilling2 = new AddressBilling();
        $addressBilling2->setStreet('23 rue des Abricots');
        $addressBilling2->setCity('Paris');
        $addressBilling2->setCountry('France');
        $addressBilling2->setZipcode('75009');

        $customer2 = new User();
        $customer2->setEmail('customer2@customer2.com');
        $customer2->setEnabled(true);
        $customer2->setPlainPassword('customer2');
        $customer2->setUsername('customer2');
        $customer2->setFirstName('Coco');
        $customer2->setLastName("L'asticot");
        $customer2->setAddressDelivery($addressDelivery2);
        $customer2->setAddressBilling($addressBilling2);
        $customer2->setHaveSubscribeNewsletter(true);

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