<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 * @ORM\Table(name="`address`")
 */
class Address
{
    /**
     * @ORM\Column(type="string")
     */
    protected $street;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $streetAdd;

    /**
     * @ORM\Column(type="string")
     */
    protected $city;

    /**
     * @ORM\Column(type="string")
     */
    protected $country;

    /**
     * @ORM\Column(type="string")
     */
    protected $zipcode;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $state;

    public function __toString(){
        return $this->street;
    }

    public function getStreet() {
        return $this->street;
    }

    public function setStreet($street) {
        $this->street = $street;
        return $this;
    }

    public function getStreetAdd() {
        return $this->streetAdd;
    }

    public function setStreetAdd($streetAdd) {
        $this->streetAdd = $streetAdd;
        return $this;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    public function getZipcode() {
        return $this->zipcode;
    }

    public function setZipcode($zipcode) {
        $this->zipcode = $zipcode;
        return $this;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
        return $this;
    }
}