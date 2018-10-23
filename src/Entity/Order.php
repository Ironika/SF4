<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use App\Entity\OrderProducts;
use App\Entity\Address;
use App\Entity\User;

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
    protected $uniqId;

    /**
     * @ORM\Column(type="string")
     */
    protected $state;

    /**
     * @ORM\Column(type="float")
     */
    protected $total;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="orders")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="OrderProduct", mappedBy="order", orphanRemoval=true, cascade="persist")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $orderProducts;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
       $this->state = 'PROCESSING';
       $this->orderProducts = new ArrayCollection();
       $this->createdAt = new \Datetime('now');
       $this->uniqId = uniqid();
    }

    public function __toString(){
        return $this->getUniqId();
    }

    public function getId() {
        return $this->id;
    }

    public function getUniqId() {
        return $this->uniqId;
    }

    public function getState() {
        return $this->state;
    }

    public function setState(String $state) {
        $this->state = $state;
        return $this;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser(User $user) {
        $user->addOrder($this);
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

    public function addOrderProduct($orderProduct) { 
        if(!$this->orderProducts->contains($orderProduct)) {
            $orderProduct->setOrder($this);
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

    public function getTotal() {
        $this->total = 0;
        foreach ($this->orderProducts as $orderProduct) {
            $this->total += $orderProduct->getProduct()->getPrice() * $orderProduct->getQuantity();
        }
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
        return $this;
    }

}