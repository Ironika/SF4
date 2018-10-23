<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\CategoryProduct;

/**
 * @ORM\Entity
 * @ORM\Table(name="type")
 */
class Type {

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
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="CategoryProduct", mappedBy="type", cascade="persist")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $categories;

    public function __construct() {
        $this->categories = new ArrayCollection();
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
        $this->slug = strtolower( preg_replace( array( '/[^-a-zA-Z0-9\s]/', '/[\s]/' ), array( '', '-' ), $name ) );
        return $this;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function getCategories() {
        return $this->categories;
    }

    public function setCategories($categories) {
        $this->categories = $categories;
        return $this->categories;
    }

    public function addCategory($category) { 
        if(!$this->categories->contains($category)) {
            $category->setType($this);
            $this->categories[] = $category;
        }
        return $this;
    }

    public function removeCategory(CategoryProduct $category) {
        if($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }
        return $this;
    }
}