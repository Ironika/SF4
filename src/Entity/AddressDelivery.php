<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Model\Address;

/**
 * @ORM\Entity
 * @ORM\Table(name="`address_delivery`")
 */
class AddressDelivery extends Address
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function getId() {
        return $this->id;
    }
}