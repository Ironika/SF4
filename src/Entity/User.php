<?php
// src/AppBundle/Entity/User.php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Order;
use App\Entity\AddressDelivery;
use App\Entity\AddressBilling;

/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $lastName;

    /**
     * @ORM\OneToOne(targetEntity="AddressDelivery", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $addressDelivery;

    /**
     * @ORM\OneToOne(targetEntity="AddressBilling", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $addressBilling;

    /**
     * @ORM\OneToMany(targetEntity="Order", mappedBy="user", orphanRemoval=true)
     * @ORM\JoinColumn(nullable=true)
     */
    protected $orders;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;


    public function __construct()
    {
        parent::__construct();
        $this->createdAt = new \Datetime('now');
        // your own logic
    }

    public function __toString() {
        $string = '';
        if($this->id)
            $string = $this->id;

        return $string;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstname) {
        $this->firstName = $firstname;
        return $this;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastname) {
        $this->lastName = $lastname;
        return $this;
    }

    public function getFullName() {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getAddressDelivery() {
        return $this->addressDelivery;
    }

    public function setAddressDelivery($addressDelivery) {
        $this->addressDelivery = $addressDelivery;
        return $this;
    }

    public function getAddressBilling() {
        return $this->addressBilling;
    }

    public function setAddressBilling($addressBilling) {
        $this->addressBilling = $addressBilling;
        return $this;
    }

    public function getOrders() {
        return $this->orders;
    }

    public function setOrders($orders) {
        $this->orders = $orders;
        return $this;
    }

    public function addOrder(Order $order) {
        if(!$this->orders->contains($order)) {
            $this->orders[] = $order;
        }
        return $this;
    }

    public function removeOrder(Order $order) {
        if($this->orders->contains($order)) {
            $this->orders->removeElement($order);
        }
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

}