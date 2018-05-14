<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Product;
use App\Entity\CategoryProduct;

/**
 * @ORM\Entity
 * @ORM\Table(name="size")
 */
class Size {

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
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="sizes")
     */
    private $products;

    /**
     * @ORM\ManyToOne(targetEntity="CategoryProduct", inversedBy="sizes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;


    public function __construct() { 
        $this->products = new ArrayCollection();
    }

    public function __toString() {
        $string = '';
        if($this->name && $this->category)
            $string = $this->category . " : " . $this->name;

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

    public function getCategory() {
        return $this->category;
    }

    public function setCategory(CategoryProduct $category) {
        $this->category = $category;
        $category->addSize($this);
        return $this;
    }
}