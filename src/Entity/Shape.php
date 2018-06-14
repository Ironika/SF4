<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Product;
use App\Entity\CategoryProduct;

/**
 * @ORM\Entity
 * @ORM\Table(name="shape")
 */
class Shape {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * 
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="shapes")
     */
    private $products;

    public function __construct() { 
        $this->products = new ArrayCollection();
    }

    public function __toString() {
        $string = '';
        if($this->name)
            $string = $this->name;

        return $string;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getProducts() {
        return $this->products;
    }

    public function setProducts($products) {
        $this->products = $products;
        return $this;
    }

    public function addProduct(Product $product) {
        if(!$this->products->contains($product)) {
            $this->products[] = $product; 
        }
        return $this;
    }

    public function removeProduct(Product $product) {
        if($this->products->contains($product)) {
            $this->products->removeElement($product);
        }
        return $this;
    }
}