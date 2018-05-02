<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\CategoryProduct;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product {


    // afin que ça entre en BDD
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="CategoryProduct", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    private $img;

    /**
     * @ORM\Column(type="integer")
     */
    private $size;

    /**
     * @ORM\Column(type="float")
     */

    private $price;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    public function getId() {
        return $this->id;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory(CategoryProduct $category) {
        $this->category = $category;
        $category->addProduct($this);
        return $this;
    }

    public function getImg() {
        return $this->img;
    }

    public function setImg($img) {
        $this->img = $img;
        return $this;
    }

    public function getSize() {
        return $this->size;
    }

    public function setSize($size) {
        $this->size = $size;
        return $this;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }
}
