<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\OrderProducts;
use App\Entity\Address;

/**
 * @ORM\Entity
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $state;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="orders")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="OrderProduct", mappedBy="order", orphanRemoval=true)
     * @ORM\JoinColumn(nullable=true)
     */
    protected $orderProducts;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;


    public function __construct()
    {
       $this->state = 'IN_WAITING';
       $this->$orderProducts = new ArrayCollection();
       $this->createdAt = new \Datetime('now');
    }

    public function getId() {
        return $this->id;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
        return $this;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

    public function getOrderProducts() {
        return $this->orderProducts;
    }

    public function setOrderProducts($orderProducts) {
        $this->orderProducts = $orderProducts;
        return $this;
    }

    public function addOrderProduct(OrderProduct $orderProduct) {
        if(!$this->orderProducts->contains($orderProduct)) {
            $this->orderProducts[] = $orderProduct;
        }
        return $this;
    }

    public function removeOrderProduct(OrderProduct $orderProduct) {
        if($this->orderProducts->contains($orderProduct)) {
            $this->orderProducts->removeElement($orderProduct);
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