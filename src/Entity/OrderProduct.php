<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\User;
use App\Entity\Product;
use App\Entity\Size;
use App\Entity\Shape;
use App\Entity\Material;

/**
 * @ORM\Entity
 * @ORM\Table(name="order_product")
 */
class OrderProduct {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="Size")
     * @ORM\JoinColumn(nullable=true)
     */
    private $size;

    /**
     * @ORM\ManyToOne(targetEntity="Material")
     * @ORM\JoinColumn(nullable=true)
     */
    private $material;

    /**
     * @ORM\ManyToOne(targetEntity="Shape")
     * @ORM\JoinColumn(nullable=true)
     */
    private $shape;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\Column(type="string")
     */
    private $state;

    public function __construct() {
        $this->createdAt = new \Datetime('now');
        $this->state = "IN_CART";
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

    public function getProduct() {
        return $this->product;
    }

    public function setProduct($product) {
        $this->product = $product;
        return $this;
    }

    public function getShape() {
        return $this->shape;
    }

    public function setShape(Shape $shape) {
        $this->shape = $shape;
        return $this;
    }

    public function getSize() {
        return $this->size;
    }

    public function setSize(Size $size) {
        $this->size = $size;
        return $this;
    }

    public function getMaterial() {
        return $this->material;
    }

    public function setMaterial(Material $material) {
        $this->material = $material;
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

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }
}
